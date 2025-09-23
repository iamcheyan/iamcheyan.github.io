# 澈言 (Cheyan) 个人网站

欢迎来到澈言的个人网站项目！这是一个现代化的静态网站，展示我的技术背景、作品集和成就。

## 关于我

我是澈言，一名全栈开发者和作家。自2009年起从事全栈开发，擅长使用Python（Flask・PyWebIO・Streamlit）、JavaScript（ES6+）、MySQL等技术栈。2014年创办公司并获得投资，具备丰富的团队管理与项目落地经验。

除了技术工作，我还跨界出版多本图书，涵盖个人成长、科技趋势等主题，并在中国各高校和书店举办线下活动。同时参与影视剧编剧与制片，积累了跨领域协作与创意实现能力。

目前希望在日本从事Web开发及相关岗位，发挥自身技术专长与多元背景，为产品创新和团队发展贡献更大价值。

## 网站架构

### 技术栈
- **前端**: HTML5, CSS3, JavaScript (ES6+)
- **模板引擎**: 自定义Python模板系统
- **构建工具**: Python脚本自动化构建
- **托管平台**: GitHub Pages
- **版本控制**: Git

### 项目结构

```
iamcheyan.com/
├── data/                    # 内容数据文件
│   ├── content_jp.json     # 日语内容数据
│   ├── content_zh.json     # 中文内容数据
│   └── README.md           # 数据文件说明
├── scripts/                # 自动化脚本
│   ├── push.py            # Git推送脚本
│   └── README.md          # 脚本使用说明
├── static/                # 静态资源
│   ├── *.css             # 样式文件
│   ├── *.js              # JavaScript文件
│   └── *.png/*.jpg       # 图片资源
├── index.template.html    # HTML模板文件
├── app.py                 # 主构建脚本
├── push                   # 便捷推送脚本
└── README.md             # 项目说明（本文件）
```

## 网站工作原理

### 1. 内容管理系统
网站采用**数据驱动**的架构设计：

- **数据层**: JSON文件存储所有动态内容
- **模板层**: HTML模板定义页面结构
- **渲染层**: Python脚本将数据渲染到模板
- **输出层**: 生成静态HTML文件

### 2. 多语言支持
- 支持日语和中文双语
- 通过独立的JSON文件管理不同语言的内容
- 自动生成对应语言的HTML文件

### 3. 自动化构建流程
1. 修改 `data/` 目录下的JSON内容文件
2. 运行 `python3 app.py` 生成静态HTML
3. 使用 `./push` 脚本推送到GitHub

## GitHub托管

### 托管方式
网站托管在 **GitHub Pages** 上：
- **仓库地址**: `iamcheyan/iamcheyan.github.io`
- **访问地址**: `https://iamcheyan.com`
- **分支**: `main`（默认分支）

### 自动部署
GitHub Pages 会自动部署 `main` 分支的内容：
- 推送代码到 `main` 分支
- GitHub 自动检测并重新部署网站
- 通常在几分钟内更新生效

## 开发工作流

### 1. 修改内容
```bash
# 编辑数据文件
vim data/content_zh.json    # 修改中文内容
vim data/content_jp.json    # 修改日语内容
```

### 2. 重新构建
```bash
# 生成静态HTML文件
python3 app.py
```

这会生成：
- `index.html` (日语版本)
- `index.zh-cn.html` (中文版本)

### 3. 预览更改
```bash
# 本地预览（可选）
python3 -m http.server 8000
# 访问 http://localhost:8000
```

### 4. 部署到生产环境
```bash
# 一键推送并部署
./push
```

## 快速开始

### 环境要求
- Python 3.6+
- Git
- GitHub账号

### 克隆项目
```bash
git clone https://github.com/iamcheyan/iamcheyan.github.io.git
cd iamcheyan.github.io
```

### 修改内容
1. 编辑 `data/content_zh.json` 或 `data/content_jp.json`
2. 运行 `python3 app.py` 重新生成网站
3. 运行 `./push` 推送到GitHub

### 自定义配置
- **远程仓库**: 修改 `scripts/push.py` 中的 `--remote` 参数
- **推送分支**: 修改 `scripts/push.py` 中的 `--branch` 参数
- **模板样式**: 修改 `index.template.html` 和 `static/che.css`

## 项目特色

### 1. 简洁高效
- 纯静态网站，加载速度快
- 无数据库依赖，维护简单
- 支持CDN加速

### 2. 易于维护
- 数据与展示分离
- 模板化设计，易于修改
- 自动化构建和部署

### 3. 多语言支持
- 完整的中日双语支持
- 独立的内容管理
- 自动语言切换

### 4. 现代化设计
- 响应式布局
- 深色模式支持
- 优雅的视觉效果

## 联系方式

- **网站**: https://iamcheyan.com
- **GitHub**: https://github.com/iamcheyan
- **Twitter**: https://x.com/iamcheyan
- **邮箱**: me@iamcheyan.com

## 许可证

本项目采用 MIT 许可证。详情请参阅 [LICENSE](LICENSE) 文件。

---

*最后更新: 2025年9月*
