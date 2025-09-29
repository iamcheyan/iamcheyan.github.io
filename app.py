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
from typing import Any, Tuple

try:
    from flask import Flask, request, redirect
    from flask import url_for, render_template_string
except Exception:  # Flask 可能尚未安装
    Flask = None  # type: ignore

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


def load_lang_content(lang_code: str) -> Tuple[Path, dict]:
    """根据语言代码加载 JSON 内容并返回(路径, 数据)。"""
    mapping = {cfg["code"]: cfg["json"] for cfg in LANGUAGES}
    if lang_code not in mapping:
        raise ValueError(f"Unsupported language code: {lang_code}")
    path = mapping[lang_code]
    return path, load_content(path)


def save_lang_content(lang_code: str, data: dict) -> None:
    """保存指定语言的数据到对应 JSON 文件。"""
    path, _ = load_lang_content(lang_code)
    path.write_text(
        json.dumps(data, ensure_ascii=False, indent=2), encoding="utf-8"
    )


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
    # 位置参数：端口（可选）
    parser.add_argument(
        "port",
        nargs="?",
        type=int,
        default=5001,
        help="后台管理端口（可选），默认 5001。例如: python3 app.py 5004"
    )
    # 开关参数：是否推送
    parser.add_argument(
        "--push",
        action="store_true",
        help="添加此开关将自动推送到GitHub（例如: python3 app.py --push 或 python3 app.py 5004 --push）"
    )
    
    args = parser.parse_args()
    should_push: bool = bool(args.push)
    admin_port: int = int(args.port)
    
    # 构建页面
    build_pages()
    
    # 根据参数决定是否推送
    if should_push:
        auto_push()
    else:
        print("💡 提示: 使用 'python3 app.py push' 来自动推送到GitHub")

    # 启动 Flask 后台
    start_admin_server(admin_port)


# ========================= Flask 后台（无登录，本地管理） =========================

def start_admin_server(port: int = 5001) -> None:
    """启动后台管理服务。"""
    if Flask is None:
        print("⚠️ 未安装 Flask，无法启动后台。请先执行: pip install flask\n")
        return

    app = Flask(__name__)

    def get_top_level_keys(data: dict) -> list[str]:
        return list(data.keys())

    def pretty_json(value: Any) -> str:
        return json.dumps(value, ensure_ascii=False, indent=2)

    @app.route("/")
    def admin_root() -> Any:  # type: ignore[override]
        return redirect(url_for("admin_index"))

    @app.route("/admin")
    def admin_index() -> str:
        # 直接跳转到“同时编辑整份 JSON”
        return redirect(url_for('admin_edit_full_bi'))

    # 可选：仪表盘（如需使用可访问 /admin/dashboard）
    @app.route("/admin/dashboard")
    def admin_dashboard() -> str:
        # 仪表盘：列出所有分类，并提供“同时编辑中日文”的入口
        try:
            _, zh = load_lang_content("zh-cn")
            _, ja = load_lang_content("ja")
        except Exception as e:
            return f"加载数据失败: {e}", 500

        # 以并集作为分类集合
        keys = sorted(set(list(zh.keys()) + list(ja.keys())))
        tpl = """
<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>内容后台 · 仪表盘</title>
  <style>
    :root { color-scheme: light dark; }
    body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", sans-serif; margin: 24px; background: var(--bg); color: var(--fg); }
    body.light { --bg: #ffffff; --fg: #0f172a; --card: #ffffff; --border: #e5e7eb; --muted:#6b7280; }
    body.dark  { --bg: #0b1220; --fg: #e5e7eb; --card: #0f172a; --border: #233240; --muted:#94a3b8; }
    a { text-decoration: none; color: #0b5ed7; }
    .card { border: 1px solid var(--border); background: var(--card); border-radius: 8px; padding: 16px; margin: 12px 0; }
    .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); grid-gap: 12px; }
    .muted { color: var(--muted); }
    .btn { display: inline-block; background: #0b5ed7; color: #fff; padding: 8px 12px; border-radius: 6px; }
    .row { margin: 8px 0; }
    .toolbar { display:flex; gap:8px; align-items:center; margin:8px 0 16px; }
    .toggle { background:#334155; color:#fff; border:0; padding:8px 12px; border-radius:6px; cursor:pointer; }
  </style>
  <script>
    (function(){
      const mode = localStorage.getItem('adminTheme') || 'light';
      document.addEventListener('DOMContentLoaded', function(){ document.body.classList.add(mode); });
    })();
  </script>
  </head>
<body>
  <h2>内容后台 · 仪表盘</h2>
  <p class="muted">点击分类进入“同时编辑 JA & ZH-CN”的页面。</p>

  <div class="toolbar">
    <a class="btn" href="{{ url_for('admin_edit_full_bi') }}">同时编辑整份 JSON（JA & ZH-CN）</a>
    <button class="toggle" onclick="(function(){const b=document.body;const next=b.classList.contains('dark')?'light':'dark';b.classList.remove('light','dark');b.classList.add(next);localStorage.setItem('adminTheme',next);})();">明/暗切换</button>
  </div>

  <div class="grid">
    {% for k in keys %}
      <div class="card">
        <div><strong>{{ k }}</strong></div>
        <div class="row">
          <a class="btn" href="{{ url_for('admin_edit_section_bi', section=k) }}">同时编辑 JA & ZH-CN</a>
        </div>
      </div>
    {% endfor %}
  </div>
</body>
</html>
        """
        return render_template_string(tpl, keys=keys)

    @app.route("/admin/<lang_code>")
    def admin_lang(lang_code: str) -> str:
        try:
            _, data = load_lang_content(lang_code)
        except Exception as e:
            return f"加载语言失败: {e}", 400

        keys = get_top_level_keys(data)
        tpl = """
<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>后台管理 - {{ lang_code }}</title>
  <style>
    body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", sans-serif; margin: 24px; }
    a { text-decoration: none; color: #0b5ed7; }
    .card { border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; margin: 12px 0; }
    .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); grid-gap: 12px; }
    .muted { color: #6b7280; }
    .btn { display: inline-block; background: #0b5ed7; color: #fff; padding: 8px 12px; border-radius: 6px; }
  </style>
</head>
<body>
  <div style="margin-bottom:12px"><a href="{{ url_for('admin_index') }}">← 返回</a></div>
  <h2>语言：{{ lang_code }}</h2>
  <p class="muted">选择要编辑的分类（顶级键）。</p>
  <p><a class="btn" href="{{ url_for('admin_edit_full', lang_code=lang_code) }}">编辑整份 JSON</a></p>
  <div class="grid">
    {% for k in keys %}
      <div class="card">
        <div><strong>{{ k }}</strong></div>
        <div style="margin-top:8px"><a class="btn" href="{{ url_for('admin_edit_section', lang_code=lang_code, section=k) }}">编辑</a></div>
      </div>
    {% endfor %}
  </div>
</body>
</html>
        """
        return render_template_string(tpl, lang_code=lang_code, keys=keys)

    @app.route("/admin/<lang_code>/edit", methods=["GET", "POST"])
    def admin_edit_full(lang_code: str) -> str:
        path, data = load_lang_content(lang_code)
        if request.method == "POST":
            raw = request.form.get("payload", "")
            try:
                parsed = json.loads(raw)
                if not isinstance(parsed, dict):
                    return "提交的数据必须是 JSON 对象", 400
            except Exception as e:
                return f"JSON 解析失败: {e}", 400

            save_lang_content(lang_code, parsed)
            build_pages()
            return redirect(url_for("admin_lang", lang_code=lang_code))

        tpl = """
<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>编辑 JSON - {{ lang_code }}</title>
  <style>
    body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", sans-serif; margin: 24px; }
    textarea { width: 100%; height: 70vh; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; font-size: 13px; }
    .row { margin: 12px 0; }
    .btn { background: #16a34a; color: #fff; padding: 10px 14px; border: 0; border-radius: 6px; cursor: pointer; }
  </style>
</head>
<body>
  <div style="margin-bottom:12px"><a href="{{ url_for('admin_lang', lang_code=lang_code) }}">← 返回</a></div>
  <h3>编辑整份 JSON（{{ lang_code }}）</h3>
  <form method="post">
    <div class="row">
      <textarea name="payload">{{ content }}</textarea>
    </div>
    <div class="row">
      <button class="btn" type="submit">保存并重新生成页面</button>
    </div>
    <div class="row">文件：{{ path }}</div>
  </form>
</body>
</html>
        """
        return render_template_string(
            tpl, lang_code=lang_code, content=pretty_json(data), path=str(path)
        )

    @app.route("/admin/<lang_code>/edit/<section>", methods=["GET", "POST"])
    def admin_edit_section(lang_code: str, section: str) -> str:
        path, data = load_lang_content(lang_code)
        if request.method == "POST":
            raw = request.form.get("payload", "")
            try:
                parsed = json.loads(raw)
            except Exception as e:
                return f"JSON 解析失败: {e}", 400

            data[section] = parsed
            save_lang_content(lang_code, data)
            build_pages()
            return redirect(url_for("admin_lang", lang_code=lang_code))

        current = data.get(section, None)
        if current is None:
            current = ""

        tpl = """
<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>编辑 {{ section }} - {{ lang_code }}</title>
  <style>
    body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", sans-serif; margin: 24px; }
    textarea { width: 100%; height: 70vh; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; font-size: 13px; }
    .row { margin: 12px 0; }
    .btn { background: #16a34a; color: #fff; padding: 10px 14px; border: 0; border-radius: 6px; cursor: pointer; }
    .muted { color: #6b7280; }
  </style>
</head>
<body>
  <div style="margin-bottom:12px"><a href="{{ url_for('admin_lang', lang_code=lang_code) }}">← 返回</a></div>
  <h3>编辑：{{ section }}（{{ lang_code }}）</h3>
  <p class="muted">此处编辑的是该分类对应的 JSON 片段，可为对象、数组或字符串。</p>
  <form method="post">
    <div class="row">
      <textarea name="payload">{{ content }}</textarea>
    </div>
    <div class="row">
      <button class="btn" type="submit">保存并重新生成页面</button>
    </div>
    <div class="row">文件：{{ path }}</div>
  </form>
</body>
</html>
        """
        return render_template_string(
            tpl,
            lang_code=lang_code,
            section=section,
            content=pretty_json(current),
            path=str(path),
        )

    @app.route("/admin/edit/<section>", methods=["GET", "POST"])
    def admin_edit_section_bi(section: str) -> str:
        zh_path, zh_data = load_lang_content("zh-cn")
        ja_path, ja_data = load_lang_content("ja")

        if request.method == "POST":
            raw_ja = request.form.get("payload_ja", "")
            raw_zh = request.form.get("payload_zh", "")
            try:
                parsed_ja = json.loads(raw_ja) if raw_ja.strip() else None
                parsed_zh = json.loads(raw_zh) if raw_zh.strip() else None
            except Exception as e:
                return f"JSON 解析失败: {e}", 400

            if parsed_ja is not None:
                ja_data[section] = parsed_ja
                save_lang_content("ja", ja_data)
            if parsed_zh is not None:
                zh_data[section] = parsed_zh
                save_lang_content("zh-cn", zh_data)

            build_pages()
            return redirect(url_for("admin_index"))

        current_ja = ja_data.get(section, "")
        current_zh = zh_data.get(section, "")
        tpl = """
<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>同时编辑 · {{ section }}</title>
  <style>
    :root { color-scheme: light dark; }
    body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", sans-serif; margin: 24px; background: var(--bg); color: var(--fg); }
    body.light { --bg: #ffffff; --fg: #0f172a; --card: #ffffff; --border: #e5e7eb; }
    body.dark  { --bg: #0b1220; --fg: #e5e7eb; --card: #0f172a; --border: #233240; }
    .grid { display: grid; grid-template-columns: minmax(0,1fr) minmax(0,1fr); grid-gap: 16px; align-items: stretch; }
    .editor { border:1px solid var(--border); border-radius:8px; background: var(--card); min-width:0; }
    .editor-head { display:flex; justify-content:space-between; align-items:center; padding:8px 12px; border-bottom:1px solid var(--border); }
    .editor-body { height: 70vh; overflow:auto; }
    .row { margin: 12px 0; }
    .btn { background: #16a34a; color: #fff; padding: 10px 14px; border: 0; border-radius: 6px; cursor: pointer; }
    .toggle { background:#334155; color:#fff; border:0; padding:8px 12px; border-radius:6px; cursor:pointer; }
    /* 简易代码高亮风格 */
    .CodeMirror.cm-s-custom { background: var(--card); color: var(--fg); height:100%; }
    .cm-s-custom .cm-string   { color: #16a34a; }
    .cm-s-custom .cm-number   { color: #f59e0b; }
    .cm-s-custom .cm-atom     { color: #38bdf8; }
    .cm-s-custom .cm-property { color: #60a5fa; }
    .cm-s-custom .cm-punctuation { color: #e5e7eb; }
    .cm-s-custom .CodeMirror-linenumber { color:#94a3b8; }
    .CodeMirror-gutters { background: var(--card); border-right:1px solid var(--border); }
  </style>
  <!-- 引入 CodeMirror （CDN，本地使用也可） -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.65.16/lib/codemirror.min.css">
  <script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.16/lib/codemirror.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.16/mode/javascript/javascript.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.16/addon/edit/closebrackets.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.16/addon/edit/matchbrackets.js"></script>
  <script>
    (function(){
      const mode = localStorage.getItem('adminTheme') || 'light';
      document.addEventListener('DOMContentLoaded', function(){ document.body.classList.add(mode); });
    })();
  </script>
</head>
<body>
  <div style="margin-bottom:12px"><a href="{{ url_for('admin_index') }}">← 返回仪表盘</a></div>
  <h3>同时编辑分类：{{ section }}</h3>
  <div class="row"><button class="toggle" onclick="(function(){const b=document.body;const next=b.classList.contains('dark')?'light':'dark';b.classList.remove('light','dark');b.classList.add(next);localStorage.setItem('adminTheme',next);})();">明/暗切换</button></div>
  <form method="post" id="biForm">
    <div class="grid">
      <div class="editor">
        <div class="editor-head"><strong>JA（日文）</strong></div>
        <div class="editor-body"><textarea id="editor_ja" name="payload_ja">{{ ja_content }}</textarea></div>
        <div class="row" style="padding:8px 12px">文件：{{ ja_path }}</div>
      </div>
      <div class="editor">
        <div class="editor-head"><strong>ZH-CN（中文）</strong></div>
        <div class="editor-body"><textarea id="editor_zh" name="payload_zh">{{ zh_content }}</textarea></div>
        <div class="row" style="padding:8px 12px">文件：{{ zh_path }}</div>
      </div>
    </div>
    <div class="row">
      <button class="btn" type="submit">保存两种语言并重新生成页面</button>
    </div>
  </form>
  <script>
    function setupEditor(id){
      var cm = CodeMirror.fromTextArea(document.getElementById(id), {
        mode: {name: 'javascript', json: true},
        lineNumbers: true,
        indentUnit: 2,
        tabSize: 2,
        smartIndent: true,
        autoCloseBrackets: true,
        matchBrackets: true,
        lineWrapping: true,
        theme: 'custom'
      });
      cm.on('change', function(){ cm.save(); });
      return cm;
    }
    var cmJA = setupEditor('editor_ja');
    var cmZH = setupEditor('editor_zh');
  </script>
</body>
</html>
        """
        return render_template_string(
            tpl,
            section=section,
            ja_content=pretty_json(current_ja),
            zh_content=pretty_json(current_zh),
            ja_path=str(ja_path),
            zh_path=str(zh_path),
        )

    @app.route("/admin/edit-full", methods=["GET", "POST"])
    def admin_edit_full_bi() -> str:
        zh_path, zh_data = load_lang_content("zh-cn")
        ja_path, ja_data = load_lang_content("ja")
        # 以顶级键并集作为分块
        keys = sorted(set(list(zh_data.keys()) + list(ja_data.keys())))
        if request.method == "POST":
            # 增量更新每个分块，避免一次性粘贴整份
            next_ja = dict(ja_data)
            next_zh = dict(zh_data)
            try:
                for k in keys:
                    sj = request.form.get(f"payload_ja__{k}")
                    sz = request.form.get(f"payload_zh__{k}")
                    if sj is not None and sj.strip() != "":
                        next_ja[k] = json.loads(sj)
                    if sz is not None and sz.strip() != "":
                        next_zh[k] = json.loads(sz)
            except Exception as e:
                return f"JSON 解析失败: {e}", 400

            save_lang_content("ja", next_ja)
            save_lang_content("zh-cn", next_zh)
            build_pages()
            return redirect(url_for("admin_index"))

        tpl = """
<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>同时编辑整份 JSON</title>
  <style>
    :root { color-scheme: light dark; }
    body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", sans-serif; margin: 24px; background: var(--bg); color: var(--fg); }
    body.light { --bg: #ffffff; --fg: #0f172a; --card: #ffffff; --border: #e5e7eb; }
    body.dark  { --bg: #0b1220; --fg: #e5e7eb; --card: #0f172a; --border: #233240; }
    .grid { display: grid; grid-template-columns: minmax(0,1fr) minmax(0,1fr); grid-gap: 16px; }
    .editor { border:1px solid var(--border); border-radius:8px; background: var(--card); min-width:0; }
    .editor-head { display:flex; justify-content:space-between; align-items:center; padding:8px 12px; border-bottom:1px solid var(--border); }
    .editor-body { height: 70vh; overflow:auto; }
    .row { margin: 12px 0; }
    .btn { background: #16a34a; color: #fff; padding: 10px 14px; border: 0; border-radius: 6px; cursor: pointer; }
    .toggle { background:#334155; color:#fff; border:0; padding:8px 12px; border-radius:6px; cursor:pointer; }
    .CodeMirror.cm-s-custom { background: var(--card); color: var(--fg); height:100%; }
    .cm-s-custom .cm-string   { color: #16a34a; }
    .cm-s-custom .cm-number   { color: #f59e0b; }
    .cm-s-custom .cm-atom     { color: #38bdf8; }
    .cm-s-custom .cm-property { color: #60a5fa; }
    .cm-s-custom .CodeMirror-linenumber { color:#94a3b8; }
    .CodeMirror-gutters { background: var(--card); border-right:1px solid var(--border); }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.65.16/lib/codemirror.min.css">
  <script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.16/lib/codemirror.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.16/mode/javascript/javascript.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.16/addon/edit/closebrackets.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.16/addon/edit/matchbrackets.js"></script>
  <script>
    (function(){
      const mode = localStorage.getItem('adminTheme') || 'light';
      document.addEventListener('DOMContentLoaded', function(){ document.body.classList.add(mode); });
    })();
  </script>
</head>
<body>
  <div style="margin-bottom:12px"><a href="{{ url_for('admin_dashboard') }}">← 返回分类仪表盘</a></div>
  <h3>同时编辑整份 JSON（分块展示）</h3>
  <div class="row"><button class="toggle" onclick="(function(){const b=document.body;const next=b.classList.contains('dark')?'light':'dark';b.classList.remove('light','dark');b.classList.add(next);localStorage.setItem('adminTheme',next);})();">明/暗切换</button></div>
  <form method="post" id="fullForm">
    {% for k in keys %}
      <div class="card" style="border:1px solid var(--border); border-radius:8px; padding:12px; margin:16px 0; background: var(--card);">
        <h4 style="margin:0 0 8px 0">{{ k }}</h4>
        <div class="grid">
          <div class="editor">
            <div class="editor-head"><strong>JA（日文）</strong></div>
            <div class="editor-body"><textarea id="editor_full_ja__{{ k }}" name="payload_ja__{{ k }}">{{ sections_ja[k] }}</textarea></div>
          </div>
          <div class="editor">
            <div class="editor-head"><strong>ZH-CN（中文）</strong></div>
            <div class="editor-body"><textarea id="editor_full_zh__{{ k }}" name="payload_zh__{{ k }}">{{ sections_zh[k] }}</textarea></div>
          </div>
        </div>
      </div>
    {% endfor %}
    <div class="row">
      <button class="btn" type="submit">保存两种语言并重新生成页面</button>
    </div>
  </form>
  <script>
    function setupEditor(id){
      var cm = CodeMirror.fromTextArea(document.getElementById(id), {
        mode: {name: 'javascript', json: true},
        lineNumbers: true,
        indentUnit: 2,
        tabSize: 2,
        smartIndent: true,
        autoCloseBrackets: true,
        matchBrackets: true,
        lineWrapping: true,
        theme: 'custom'
      });
      cm.on('change', function(){ cm.save(); });
      return cm;
    }
    function syncScrollPair(a,b){
      let lock=false;
      a.on('scroll', function(){ if(lock) return; lock=true; const ia=a.getScrollInfo(); const rb=b.getScrollInfo(); const r=ia.top/(ia.height-ia.clientHeight||1); b.scrollTo(null, r*(rb.height-rb.clientHeight)); lock=false; });
    }
    (function(){
      var keys = {{ keys|tojson }};
      keys.forEach(function(k){
        var cmJA = setupEditor('editor_full_ja__'+k);
        var cmZH = setupEditor('editor_full_zh__'+k);
        syncScrollPair(cmJA, cmZH);
        syncScrollPair(cmZH, cmJA);
      });
    })();
  </script>
</body>
</html>
        """
        sections_ja = {k: pretty_json(ja_data.get(k, "")) for k in keys}
        sections_zh = {k: pretty_json(zh_data.get(k, "")) for k in keys}
        return render_template_string(
            tpl,
            keys=keys,
            sections_ja=sections_ja,
            sections_zh=sections_zh,
            ja_path=str(ja_path),
            zh_path=str(zh_path),
        )
    print(f"🛠️ 后台已启动: http://127.0.0.1:{port}/admin")
    app.run(host="127.0.0.1", port=port, debug=True)


if __name__ == "__main__":
    main()
