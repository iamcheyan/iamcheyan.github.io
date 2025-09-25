#!/usr/bin/env python3
"""Generate static HTML pages from JSON content using template."""

from __future__ import annotations

import argparse
import json
import re
import subprocess
import sys
from html import escape
from pathlib import Path
from textwrap import indent

BASE_DIR = Path(__file__).parent
DATA_DIR = BASE_DIR / "data"
TEMPLATE_FILE = BASE_DIR / "index.template.html"

LANGUAGES = [
    {
        "code": "ja",
        "json": DATA_DIR / "content_jp.json",
        "output": BASE_DIR / "index.html",
        "language_attr": "ja",
    },
    {
        "code": "zh-cn",
        "json": DATA_DIR / "content_zh.json",
        "output": BASE_DIR / "index.zh-cn.html",
        "language_attr": "zh-CN",
    },
]


def load_content(path: Path) -> dict:
    with path.open(encoding="utf-8") as fp:
        return json.load(fp)


def load_template() -> str:
    """Load the HTML template file."""
    with TEMPLATE_FILE.open(encoding="utf-8") as fp:
        return fp.read()


def html_attr(value: str) -> str:
    return escape(value, quote=True)


def html_text(value: str) -> str:
    return escape(value)


def indent_html(html_snippet: str, prefix: str) -> str:
    if not html_snippet:
        return ""
    return indent(html_snippet.strip(), prefix, lambda _: True)


def replace_template_placeholders(template: str, data: dict, lang_config: dict) -> str:
    """Replace placeholders in template with actual data."""
    # 设置语言属性
    template = re.sub(r'<html lang="[^"]*"', f'<html lang="{lang_config["language_attr"]}"', template)
    
    # 替换页面标题
    template = re.sub(r'<title>.*?</title>', f'<title>{html_text(data.get("site_title", "IAM CHEYAN"))}</title>', template)
    
    # 替换语言切换链接
    ja_class = ' class="on"' if lang_config["code"] == "ja" else ""
    zh_class = ' class="on"' if lang_config["code"] == "zh-cn" else ""
    template = re.sub(r'href="/index\.html"[^>]*', f'href="/index.html"{ja_class}', template)
    template = re.sub(r'href="/index\.zh-cn\.html"[^>]*', f'href="/index.zh-cn.html"{zh_class}', template)
    
    # JavaScript代码已在模板中移除，无需额外处理
    
    # 替换各个ID的内容
    replacements = {
        'about-me-title': data.get("about", {}).get("me_title", ""),
        'about-me-content': data.get("about", {}).get("me_content", ""),
        'contact-title': data.get("titles", {}).get("contact_title", ""),
        'projects-books-title': data.get("titles", {}).get("projects_books_title", ""),
        'books-title': data.get("titles", {}).get("books_title", ""),
        'projects-title': data.get("titles", {}).get("projects_title", ""),
        'events-title': data.get("titles", {}).get("events_title", ""),
        'contact-twitter-label': data.get("contact", {}).get("twitter_label", ""),
        'contact-twitter': data.get("contact", {}).get("twitter", ""),
        'contact-email-label': data.get("contact", {}).get("email_label", ""),
        'contact-email': data.get("contact", {}).get("email", ""),
        'resume-download-btn': data.get("resume_download_text", ""),
        'github-project-link': data.get("github_project_link", ""),
        'video-title': data.get("video", {}).get("title", ""),
        'video-alt': data.get("video", {}).get("alt", ""),
    }
    
    for element_id, content in replacements.items():
        if content:
            # 定义包含HTML标签的字段，这些字段不需要HTML转义
            html_fields = ['about-me-title', 'about-me-content', 'contact-title', 'projects-books-title', 'books-title', 'projects-title', 'events-title', 'video-title']
            
            # 特殊处理 img 标签的 alt 属性
            if element_id == 'video-alt':
                template = re.sub(
                    rf'(<img[^>]*id="{element_id}"[^>]*alt=")[^"]*(")',
                    rf'\1{html_attr(content)}\2',
                    template
                )
            elif element_id in html_fields:
                # 对于包含HTML标签的内容，不进行转义
                # 处理自闭合标签和普通标签
                template = re.sub(
                    rf'(<[^>]*id="{element_id}"[^>]*>)(</[^>]*>)',
                    rf'\1{content}\2',
                    template
                )
                # 处理自闭合标签（如 <a> 标签）
                template = re.sub(
                    rf'(<[^>]*id="{element_id}"[^>]*>)(\s*</[^>]*>)',
                    rf'\1{content}\2',
                    template
                )
            else:
                # 对于纯文本内容，进行HTML转义
                # 处理自闭合标签和普通标签
                template = re.sub(
                    rf'(<[^>]*id="{element_id}"[^>]*>)(</[^>]*>)',
                    rf'\1{html_text(content)}\2',
                    template
                )
                # 处理自闭合标签（如 <a> 标签）
                template = re.sub(
                    rf'(<[^>]*id="{element_id}"[^>]*>)(\s*</[^>]*>)',
                    rf'\1{html_text(content)}\2',
                    template
                )
    
    # 替换链接属性
    twitter_link = data.get("contact", {}).get("twitter_link", "#")
    email_link = data.get("contact", {}).get("email_link", "#")
    github_project_url = data.get("github_project_url", "#")
    if twitter_link != "#":
        template = re.sub(r'(id="contact-twitter"[^>]*href=")[^"]*(")', rf'\1{html_attr(twitter_link)}\2', template)
    if email_link != "#":
        template = re.sub(r'(id="contact-email"[^>]*href=")[^"]*(")', rf'\1{html_attr(email_link)}\2', template)
    if github_project_url != "#":
        template = re.sub(r'href="#" id="github-project-link"', f'href="{html_attr(github_project_url)}" id="github-project-link"', template)
        # 同时更新链接文本
        github_link_text = data.get("github_project_link", "GitHub Repository")
        template = re.sub(r'(<a[^>]*id="github-project-link"[^>]*>)[^<]*(</a>)', rf'\1{html_text(github_link_text)}\2', template)
    
    # 生成并替换项目列表
    web_projects_html = render_web_projects(data.get("web_project_list", []))
    books_html = render_books(data.get("books", {}).get("list", []))
    projects_list_html = render_projects_list(data.get("projects", {}).get("list", []))
    projects_img_html = render_project_images(data.get("projects", {}).get("imgs", []))
    events_html = render_events(data.get("events", {}).get("years", []))
    
    if web_projects_html:
        _indent_web = indent_html(web_projects_html, "\t\t\t")
        template = re.sub(r'(<div class="c" id="web-project-items">)(</div>)', rf'\1\n{_indent_web}\n\t\t\2', template)
    if books_html:
        _indent_books = indent_html(books_html, "\t\t\t")
        template = re.sub(r'(<div class="c" id="project-items">)(</div>)', rf'\1\n{_indent_books}\n\t\t\2', template)
    if projects_list_html:
        _indent_proj_list = indent_html(projects_list_html, "\t\t\t")
        template = re.sub(r'(<ul class="b" id="projects-list">)(</ul>)', rf'\1\n{_indent_proj_list}\n\t\t\2', template)
    if projects_img_html:
        _indent_proj_img = indent_html(projects_img_html, "\t\t\t")
        template = re.sub(r'(<ul class="c" id="projects-img-list">)(</ul>)', rf'\1\n{_indent_proj_img}\n\t\t\2', template)
    if events_html:
        _indent_events = indent_html(events_html, "\t\t\t")
        template = re.sub(r'(<div class="b" id="events-list">)(</div>)', rf'\1\n{_indent_events}\n\t\t\2', template)
    
    # 替换书籍平台信息
    books_platforms = data.get("books", {}).get("platforms", "")
    if books_platforms:
        template = re.sub(r'(<p class="link" id="books-platforms">)(</p>)', rf'\1{html_text(books_platforms)}\2', template)
    
    return template


def render_books(books: list[dict]) -> str:
    parts: list[str] = []
    for book in books:
        title = html_text(book.get("title", ""))
        publisher = html_text(book.get("publisher", ""))
        isbn = html_text(book.get("isbn", ""))
        date = html_text(book.get("date", ""))
        link = html_attr(book.get("link", "#"))
        img = html_attr(book.get("img", ""))
        extra = book.get("extra", "") or ""
        parts.append(
            """
			<div class="b">
				<a class="img" href="{link}" target="_blank" title="{title}">
					<img src="{img}" class="img-responsive center-block" alt="{title}">
				</a>
				<div class="i">
					<h5><a title="{title}" target="_blank" href="{link}">{title}</a></h5>
					<span class="link">{publisher}<br>ISBN: {isbn}<br>出版时间：{date}<br>{extra}</span>
				</div>
			</div>""".format(
                link=link,
                title=title,
                img=img,
                publisher=publisher,
                isbn=isbn,
                date=date,
                extra=extra,
            ).strip("\n")
        )
    return "\n".join(parts)


def render_web_projects(items: list[dict]) -> str:
    parts: list[str] = []
    for item in items:
        title = html_text(item.get("title", ""))
        link = html_attr(item.get("link", "#"))
        img = html_attr(item.get("img", ""))
        extra = item.get("extra", "") or ""
        parts.append(
            """
			<div class="b">
				<a class="img" href="{link}" target="_blank" title="{title}">
					<img src="{img}" class="img-responsive center-block" alt="{title}">
				</a>
				<div class="i">
					<h5><a title="{title}" target="_blank" href="{link}">{title}</a></h5>
					<span class="link">{extra}</span>
				</div>
			</div>""".format(
                link=link, title=title, img=img, extra=extra
            ).strip("\n")
        )
    return "\n".join(parts)


def render_projects_list(items: list[dict]) -> str:
    parts: list[str] = []
    for item in items:
        title = html_text(item.get("title", ""))
        year = html_text(item.get("year", ""))
        info = html_text(item.get("info", ""))
        role = html_text(item.get("role", ""))
        link = item.get("link", "")
        if link:
            link_attr = html_attr(link)
            title_html = f"<a href=\"{link_attr}\" target=\"_blank\" title=\"{title}\">{year}&nbsp;&nbsp;{title}</a>"
        else:
            title_html = f"{year}&nbsp;&nbsp;{title}"
        parts.append(
            """
			<li class="l link">
				<span class="w0">{title_html}</span><i><span class="w1">{info}</span><span class="w2">{role}</span></i>
			</li>""".format(
                title_html=title_html, info=info, role=role
            ).strip("\n")
        )
    return "\n".join(parts)


def render_project_images(items: list[dict]) -> str:
    parts: list[str] = []
    for item in items:
        img = html_attr(item.get("img", ""))
        link = html_attr(item.get("link", "#"))
        alt = html_text(item.get("alt", ""))
        title = html_text(item.get("title", ""))
        parts.append(
            """
			<li>
				<a href="{link}" target="_blank"><img class="img" src="{img}" alt="{alt}" title="{title}"></a>
			</li>""".format(
                link=link, img=img, alt=alt, title=title
            ).strip("\n")
        )
    return "\n".join(parts)


def render_events(events: list[dict]) -> str:
    parts: list[str] = []
    for block in events:
        year = html_text(block.get("year", ""))
        items = block.get("items", [])
        parts.append(f"\t\t\t<h5>{year}</h5>")
        parts.append("\t\t\t<ul class=\"link\">")
        for item in items:
            text_value = html_text(item.get("text", ""))
            date_value = html_text(item.get("date", ""))
            link = item.get("link")
            if link:
                link_attr = html_attr(link)
                item_html = f"<a href=\"{link_attr}\" target=\"_blank\">{text_value}</a>（{date_value}）"
            else:
                item_html = f"{text_value}（{date_value}）"
            parts.append(f"\t\t\t\t<li>{item_html}</li>")
        parts.append("\t\t\t</ul>")
    return "\n".join(parts)


def render_page(lang_config: dict, data: dict) -> str:
    """Render page using template and data."""
    template = load_template()
    return replace_template_placeholders(template, data, lang_config)


def minify_html(html: str) -> str:
    """压缩HTML为单行，移除多余空白与换行。"""
    if not html:
        return ""
    # 移除HTML注释
    html = re.sub(r"<!--[\s\S]*?-->", "", html)
    # 折叠标签间空白
    html = re.sub(r">\s+<", "><", html)
    # 折叠连续空白为单个空格（保留文本中的必要空格）
    html = re.sub(r"\s{2,}", " ", html)
    # 移除换行与制表
    html = html.replace("\n", "").replace("\r", "").replace("\t", "")
    return html.strip()


def build_pages() -> None:
    for lang in LANGUAGES:
        content = load_content(lang["json"])
        html_output = render_page(lang, content)
        # 输出前进行压缩
        html_output = minify_html(html_output)
        lang["output"].write_text(html_output, encoding="utf-8")
        print(f"Generated {lang['output'].relative_to(BASE_DIR)}")


def auto_push() -> None:
    """自动执行推送脚本"""
    push_script = BASE_DIR / "scripts" / "push.py"
    if push_script.exists():
        print("🚀 自动推送到GitHub...")
        try:
            result = subprocess.run([sys.executable, str(push_script)], 
                                  cwd=BASE_DIR, 
                                  capture_output=True, 
                                  text=True)
            if result.returncode == 0:
                print("✅ 推送成功!")
                print(result.stdout)
            else:
                print("❌ 推送失败:")
                print(result.stderr)
        except Exception as e:
            print(f"❌ 执行推送脚本时出错: {e}")
    else:
        print("⚠️  推送脚本未找到，跳过自动推送")


def main() -> None:
    """主函数，支持命令行参数"""
    parser = argparse.ArgumentParser(
        description="生成静态HTML页面，可选择是否推送到GitHub"
    )
    parser.add_argument(
        "push",
        nargs="?",
        const="push",
        help="添加此参数将自动推送到GitHub（例如: python3 app.py push）"
    )
    
    args = parser.parse_args()
    should_push = args.push is not None
    
    # 构建页面
    build_pages()
    
    # 根据参数决定是否推送
    if should_push:
        auto_push()
    else:
        print("💡 提示: 使用 'python3 app.py push' 来自动推送到GitHub")


if __name__ == "__main__":
    main()
