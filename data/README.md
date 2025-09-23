# 数据文件 (Data Files)

这个文件夹包含了网站的内容数据文件。

## 文件说明

### content_jp.json
日语版本的内容数据文件，包含：
- 个人信息和介绍
- 项目列表
- 出版物信息
- 媒体报道
- 联系方式等

### content_zh.json
中文版本的内容数据文件，包含：
- 个人信息和介绍
- 项目列表
- 出版物信息
- 媒体报道
- 联系方式等

## 数据结构

这些JSON文件包含了网站的所有动态内容，通过 `app.py` 脚本读取并渲染到HTML模板中。

### 主要字段说明

```json
{
  "site_title": "网站标题",
  "about": {
    "me_title": "关于我标题",
    "me_content": "个人介绍内容（支持HTML）"
  },
  "titles": {
    "contact_title": "联系方式标题",
    "projects_books_title": "项目标题",
    "books_title": "出版物标题",
    "projects_title": "其他项目标题",
    "events_title": "媒体报道标题"
  },
  "contact": {
    "twitter": "Twitter账号",
    "twitter_link": "Twitter链接",
    "email": "邮箱地址",
    "email_link": "邮箱链接"
  },
  "resume_download_text": "简历下载按钮文本",
  "books": {
    "list": [...], // 出版物列表
    "platforms": "购买平台信息"
  },
  "web_project_list": [...], // 网站项目列表
  "projects": {
    "list": [...], // 其他项目列表
    "imgs": [...] // 项目图片列表
  },
  "events": {
    "years": [...] // 按年份组织的媒体报道
  }
}
```

## 修改内容

要更新网站内容，只需编辑对应的JSON文件：

1. **个人信息**：修改 `about.me_title` 和 `about.me_content`
2. **项目信息**：更新 `web_project_list` 和 `projects.list`
3. **出版物**：修改 `books.list`
4. **媒体报道**：更新 `events.years`
5. **联系方式**：修改 `contact` 部分

修改完成后，运行 `python3 app.py` 重新生成HTML文件。