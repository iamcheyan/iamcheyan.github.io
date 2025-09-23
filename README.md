# Cheyan's Personal Website / 澈言个人网站 / 徹言の個人ウェブサイト

## Language / 语言 / 言語
- [English](#english)
- [中文](#中文)
- [日本語](#日本語)

---

## English

Welcome to Cheyan's personal website project! This is a modern static website showcasing my technical background, portfolio, and achievements.

### About Me

I am Cheyan, a full-stack developer and writer. Since 2009, I have been engaged in full-stack development, specializing in Python (Flask・PyWebIO・Streamlit), JavaScript (ES6+), MySQL, and other technology stacks. In 2014, I founded a company and secured investment, gaining rich experience in team management and project execution.

Beyond technical work, I have also published multiple books covering personal growth and technology trends, and have organized offline events at universities and bookstores across China. Additionally, I have participated in film and television scriptwriting and production, accumulating cross-domain collaboration and creative implementation capabilities.

Currently, I hope to work in web development and related positions in Japan, leveraging my technical expertise and diverse background to contribute greater value to product innovation and team development.

### Website Architecture

#### Tech Stack
- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Template Engine**: Custom Python template system
- **Build Tool**: Python script automation
- **Hosting Platform**: GitHub Pages
- **Version Control**: Git

#### Project Structure

```
iamcheyan.com/
├── data/                    # Content data files
│   ├── content_jp.json     # Japanese content data
│   ├── content_zh.json     # Chinese content data
│   └── README.md           # Data files documentation
├── scripts/                # Automation scripts
│   ├── push.py            # Git push script
│   └── README.md          # Script usage documentation
├── static/                # Static resources
│   ├── *.css             # Style files
│   ├── *.js              # JavaScript files
│   └── *.png/*.jpg       # Image resources
├── index.template.html    # HTML template file
├── app.py                 # Main build script
└── README.md             # Multi-language documentation
```

### How the Website Works

#### 1. Content Management System
The website adopts a **data-driven** architecture design:

- **Data Layer**: JSON files store all dynamic content
- **Template Layer**: HTML templates define page structure
- **Rendering Layer**: Python scripts render data into templates
- **Output Layer**: Generate static HTML files

#### 2. Multi-language Support
- Supports Japanese and Chinese bilingual
- Manages different language content through independent JSON files
- Automatically generates corresponding language HTML files

#### 3. Automated Build Process
1. Modify JSON content files in the `data/` directory
2. Run `python3 app.py` to generate static HTML
3. Use `python3 app.py push` to build and push to GitHub

### GitHub Hosting

#### Hosting Method
The website is hosted on **GitHub Pages**:
- **Repository Address**: `iamcheyan/iamcheyan.github.io`
- **Access URL**: `https://iamcheyan.com`
- **Branch**: `main` (default branch)

#### Auto Deployment
GitHub Pages automatically deploys content from the `main` branch:
- Push code to the `main` branch
- GitHub automatically detects and redeploys the website
- Usually updates within a few minutes

### Development Workflow

#### 1. Modify Content
```bash
# Edit data files
vim data/content_zh.json    # Modify Chinese content
vim data/content_jp.json    # Modify Japanese content
```

#### 2. Rebuild
```bash
# Generate static HTML files
python3 app.py
```

This generates:
- `index.html` (Japanese version)
- `index.zh-cn.html` (Chinese version)

#### 3. Preview Changes
```bash
# Local preview (optional)
python3 -m http.server 8000
# Visit http://localhost:8000
```

#### 4. Deploy to Production
```bash
# Method 1: Build HTML files only (default)
python3 app.py

# Method 2: Build and push to GitHub
python3 app.py push

# Method 3: Push only (if HTML is already generated)
python3 scripts/push.py
```

### Quick Start

#### Requirements
- Python 3.6+
- Git
- GitHub account

#### Clone Project
```bash
git clone https://github.com/iamcheyan/iamcheyan.github.io.git
cd iamcheyan.github.io
```

#### Modify Content
1. Edit `data/content_zh.json` or `data/content_jp.json`
2. Run `python3 app.py` to build HTML files
3. Run `python3 app.py push` to build and push to GitHub

#### Custom Configuration
- **Remote Repository**: Modify the `--remote` parameter in `scripts/push.py`
- **Push Branch**: Modify the `--branch` parameter in `scripts/push.py`
- **Template Style**: Modify `index.template.html` and `static/che.css`

### Project Features

#### 1. Simple and Efficient
- Pure static website, fast loading
- No database dependencies, easy maintenance
- CDN acceleration support

#### 2. Easy to Maintain
- Separation of data and presentation
- Template design, easy to modify
- Automated build and deployment

#### 3. Multi-language Support
- Complete Chinese-Japanese bilingual support
- Independent content management
- Automatic language switching

#### 4. Modern Design
- Responsive layout
- Dark mode support
- Elegant visual effects

### Contact

- **Website**: https://iamcheyan.com
- **GitHub**: https://github.com/iamcheyan
- **Twitter**: https://x.com/iamcheyan
- **Email**: me@iamcheyan.com

### License

This project uses the MIT License. For details, see the [LICENSE](LICENSE) file.

---

*Last updated: September 2025*

---

## 中文

欢迎来到澈言的个人网站项目！这是一个现代化的静态网站，展示我的技术背景、作品集和成就。

### 关于我

我是澈言，一名全栈开发者和作家。自2009年起从事全栈开发，擅长使用Python（Flask・PyWebIO・Streamlit）、JavaScript（ES6+）、MySQL等技术栈。2014年创办公司并获得投资，具备丰富的团队管理与项目落地经验。

除了技术工作，我还跨界出版多本图书，涵盖个人成长、科技趋势等主题，并在中国各高校和书店举办线下活动。同时参与影视剧编剧与制片，积累了跨领域协作与创意实现能力。

目前希望在日本从事Web开发及相关岗位，发挥自身技术专长与多元背景，为产品创新和团队发展贡献更大价值。

### 网站架构

#### 技术栈
- **前端**: HTML5, CSS3, JavaScript (ES6+)
- **模板引擎**: 自定义Python模板系统
- **构建工具**: Python脚本自动化构建
- **托管平台**: GitHub Pages
- **版本控制**: Git

#### 项目结构

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
└── README.md             # 多语言说明文件
```

### 网站工作原理

#### 1. 内容管理系统
网站采用**数据驱动**的架构设计：

- **数据层**: JSON文件存储所有动态内容
- **模板层**: HTML模板定义页面结构
- **渲染层**: Python脚本将数据渲染到模板
- **输出层**: 生成静态HTML文件

#### 2. 多语言支持
- 支持日语和中文双语
- 通过独立的JSON文件管理不同语言的内容
- 自动生成对应语言的HTML文件

#### 3. 自动化构建流程
1. 修改 `data/` 目录下的JSON内容文件
2. 运行 `python3 app.py` 生成静态HTML
3. 使用 `python3 app.py push` 构建并推送到GitHub

### GitHub托管

#### 托管方式
网站托管在 **GitHub Pages** 上：
- **仓库地址**: `iamcheyan/iamcheyan.github.io`
- **访问地址**: `https://iamcheyan.com`
- **分支**: `main`（默认分支）

#### 自动部署
GitHub Pages 会自动部署 `main` 分支的内容：
- 推送代码到 `main` 分支
- GitHub 自动检测并重新部署网站
- 通常在几分钟内更新生效

### 开发工作流

#### 1. 修改内容
```bash
# 编辑数据文件
vim data/content_zh.json    # 修改中文内容
vim data/content_jp.json    # 修改日语内容
```

#### 2. 重新构建
```bash
# 生成静态HTML文件
python3 app.py
```

这会生成：
- `index.html` (日语版本)
- `index.zh-cn.html` (中文版本)

#### 3. 预览更改
```bash
# 本地预览（可选）
python3 -m http.server 8000
# 访问 http://localhost:8000
```

#### 4. 部署到生产环境
```bash
# 方法一：仅构建HTML文件（默认）
python3 app.py

# 方法二：构建并推送到GitHub
python3 app.py push

# 方法三：仅推送（如果HTML已生成）
python3 scripts/push.py
```

### 快速开始

#### 环境要求
- Python 3.6+
- Git
- GitHub账号

#### 克隆项目
```bash
git clone https://github.com/iamcheyan/iamcheyan.github.io.git
cd iamcheyan.github.io
```

#### 修改内容
1. 编辑 `data/content_zh.json` 或 `data/content_jp.json`
2. 运行 `python3 app.py` 构建HTML文件
3. 运行 `python3 app.py push` 构建并推送到GitHub

#### 自定义配置
- **远程仓库**: 修改 `scripts/push.py` 中的 `--remote` 参数
- **推送分支**: 修改 `scripts/push.py` 中的 `--branch` 参数
- **模板样式**: 修改 `index.template.html` 和 `static/che.css`

### 项目特色

#### 1. 简洁高效
- 纯静态网站，加载速度快
- 无数据库依赖，维护简单
- 支持CDN加速

#### 2. 易于维护
- 数据与展示分离
- 模板化设计，易于修改
- 自动化构建和部署

#### 3. 多语言支持
- 完整的中日双语支持
- 独立的内容管理
- 自动语言切换

#### 4. 现代化设计
- 响应式布局
- 深色模式支持
- 优雅的视觉效果

### 联系方式

- **网站**: https://iamcheyan.com
- **GitHub**: https://github.com/iamcheyan
- **Twitter**: https://x.com/iamcheyan
- **邮箱**: me@iamcheyan.com

### 许可证

本项目采用 MIT 许可证。详情请参阅 [LICENSE](LICENSE) 文件。

---

*最后更新: 2025年9月*

---

## 日本語

徹言の個人ウェブサイトプロジェクトへようこそ！これは私の技術背景、作品集、業績を展示するモダンな静的ウェブサイトです。

### 私について

私は徹言、フルスタック開発者兼作家です。2009年からフルスタック開発に従事し、Python（Flask・PyWebIO・Streamlit）、JavaScript（ES6+）、MySQLなどの技術スタックを活用してまいりました。2014年に起業し、投資を獲得した経験があります。チームマネジメントやプロジェクト実行の豊富な経験を持ち、書籍出版や映像作品の脚本・制作にも携わるなど、多分野での協働経験を積んでまいりました。

現在は日本でWeb開発職を希望しております。自身の技術専門性と多様な背景を活かし、製品革新とチーム発展により大きな価値を提供したいと考えています。

### ウェブサイトアーキテクチャ

#### 技術スタック
- **フロントエンド**: HTML5, CSS3, JavaScript (ES6+)
- **テンプレートエンジン**: カスタムPythonテンプレートシステム
- **ビルドツール**: Pythonスクリプト自動ビルド
- **ホスティングプラットフォーム**: GitHub Pages
- **バージョン管理**: Git

#### プロジェクト構造

```
iamcheyan.com/
├── data/                    # コンテンツデータファイル
│   ├── content_jp.json     # 日本語コンテンツデータ
│   ├── content_zh.json     # 中国語コンテンツデータ
│   └── README.md           # データファイル説明
├── scripts/                # 自動化スクリプト
│   ├── push.py            # Gitプッシュスクリプト
│   └── README.md          # スクリプト使用方法
├── static/                # 静的リソース
│   ├── *.css             # スタイルファイル
│   ├── *.js              # JavaScriptファイル
│   └── *.png/*.jpg       # 画像リソース
├── index.template.html    # HTMLテンプレートファイル
├── app.py                 # メインビルドスクリプト
└── README.md             # 多言語説明ファイル
```

### ウェブサイトの仕組み

#### 1. コンテンツ管理システム
ウェブサイトは**データ駆動**のアーキテクチャ設計を採用：

- **データ層**: JSONファイルで全ての動的コンテンツを保存
- **テンプレート層**: HTMLテンプレートでページ構造を定義
- **レンダリング層**: Pythonスクリプトでデータをテンプレートにレンダリング
- **出力層**: 静的HTMLファイルを生成

#### 2. 多言語サポート
- 日本語と中国語のバイリンガルサポート
- 独立したJSONファイルで異なる言語のコンテンツを管理
- 対応言語のHTMLファイルを自動生成

#### 3. 自動ビルドフロー
1. `data/` ディレクトリのJSONコンテンツファイルを修正
2. `python3 app.py` を実行して静的HTMLを生成
3. `python3 app.py push` を使用してビルドしGitHubにプッシュ

### GitHubホスティング

#### ホスティング方法
ウェブサイトは **GitHub Pages** でホスティング：
- **リポジトリアドレス**: `iamcheyan/iamcheyan.github.io`
- **アクセスアドレス**: `https://iamcheyan.com`
- **ブランチ**: `main`（デフォルトブランチ）

#### 自動デプロイ
GitHub Pages は `main` ブランチのコンテンツを自動デプロイ：
- コードを `main` ブランチにプッシュ
- GitHub が自動検出してウェブサイトを再デプロイ
- 通常数分で更新が反映

### 開発ワークフロー

#### 1. コンテンツ修正
```bash
# データファイルを編集
vim data/content_zh.json    # 中国語コンテンツを修正
vim data/content_jp.json    # 日本語コンテンツを修正
```

#### 2. 再ビルド
```bash
# 静的HTMLファイルを生成
python3 app.py
```

これにより以下が生成されます：
- `index.html` (日本語版)
- `index.zh-cn.html` (中国語版)

#### 3. 変更プレビュー
```bash
# ローカルプレビュー（オプション）
python3 -m http.server 8000
# http://localhost:8000 にアクセス
```

#### 4. 本番環境へのデプロイ
```bash
# 方法1：HTMLファイルのみビルド（デフォルト）
python3 app.py

# 方法2：ビルドしてGitHubにプッシュ
python3 app.py push

# 方法3：プッシュのみ（HTMLが既に生成済みの場合）
python3 scripts/push.py
```

### クイックスタート

#### 環境要件
- Python 3.6+
- Git
- GitHubアカウント

#### プロジェクトクローン
```bash
git clone https://github.com/iamcheyan/iamcheyan.github.io.git
cd iamcheyan.github.io
```

#### コンテンツ修正
1. `data/content_zh.json` または `data/content_jp.json` を編集
2. `python3 app.py` を実行してHTMLファイルをビルド
3. `python3 app.py push` を実行してビルドしGitHubにプッシュ

#### カスタム設定
- **リモートリポジトリ**: `scripts/push.py` の `--remote` パラメータを修正
- **プッシュブランチ**: `scripts/push.py` の `--branch` パラメータを修正
- **テンプレートスタイル**: `index.template.html` と `static/che.css` を修正

### プロジェクトの特徴

#### 1. シンプルで効率的
- 純静的ウェブサイト、高速ロード
- データベース依存なし、メンテナンス簡単
- CDN加速サポート

#### 2. メンテナンスしやすい
- データと表示の分離
- テンプレート化設計、修正容易
- 自動ビルド・デプロイ

#### 3. 多言語サポート
- 完全な日中バイリンガルサポート
- 独立したコンテンツ管理
- 自動言語切り替え

#### 4. モダンデザイン
- レスポンシブレイアウト
- ダークモードサポート
- エレガントな視覚効果

### 連絡先

- **ウェブサイト**: https://iamcheyan.com
- **GitHub**: https://github.com/iamcheyan
- **Twitter**: https://x.com/iamcheyan
- **メール**: me@iamcheyan.com

### ライセンス

このプロジェクトはMITライセンスを使用しています。詳細は [LICENSE](LICENSE) ファイルをご覧ください。

---

*最終更新: 2025年9月*