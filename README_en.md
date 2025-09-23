# Cheyan's Personal Website

Welcome to Cheyan's personal website project! This is a modern static website showcasing my technical background, portfolio, and achievements.

## About Me

I am Cheyan, a full-stack developer and writer. Since 2009, I have been engaged in full-stack development, specializing in Python (Flask・PyWebIO・Streamlit), JavaScript (ES6+), MySQL, and other technology stacks. In 2014, I founded a company and secured investment, gaining rich experience in team management and project execution.

Beyond technical work, I have also published multiple books covering personal growth and technology trends, and have organized offline events at universities and bookstores across China. Additionally, I have participated in film and television scriptwriting and production, accumulating cross-domain collaboration and creative implementation capabilities.

Currently, I hope to work in web development and related positions in Japan, leveraging my technical expertise and diverse background to contribute greater value to product innovation and team development.

## Website Architecture

### Tech Stack
- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Template Engine**: Custom Python template system
- **Build Tool**: Python script automation
- **Hosting Platform**: GitHub Pages
- **Version Control**: Git

### Project Structure

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
└── README_*.md           # Multi-language documentation
```

## How the Website Works

### 1. Content Management System
The website adopts a **data-driven** architecture design:

- **Data Layer**: JSON files store all dynamic content
- **Template Layer**: HTML templates define page structure
- **Rendering Layer**: Python scripts render data into templates
- **Output Layer**: Generate static HTML files

### 2. Multi-language Support
- Supports Japanese and Chinese bilingual
- Manages different language content through independent JSON files
- Automatically generates corresponding language HTML files

### 3. Automated Build Process
1. Modify JSON content files in the `data/` directory
2. Run `python3 app.py` to generate static HTML
3. Automatically push to GitHub Pages

## GitHub Hosting

### Hosting Method
The website is hosted on **GitHub Pages**:
- **Repository Address**: `iamcheyan/iamcheyan.github.io`
- **Access URL**: `https://iamcheyan.com`
- **Branch**: `main` (default branch)

### Auto Deployment
GitHub Pages automatically deploys content from the `main` branch:
- Push code to the `main` branch
- GitHub automatically detects and redeploys the website
- Usually updates within a few minutes

## Development Workflow

### 1. Modify Content
```bash
# Edit data files
vim data/content_zh.json    # Modify Chinese content
vim data/content_jp.json    # Modify Japanese content
```

### 2. Rebuild
```bash
# Generate static HTML files
python3 app.py
```

This generates:
- `index.html` (Japanese version)
- `index.zh-cn.html` (Chinese version)

### 3. Preview Changes
```bash
# Local preview (optional)
python3 -m http.server 8000
# Visit http://localhost:8000
```

### 4. Deploy to Production
```bash
# Method 1: One-click build and push (recommended)
python3 app.py

# Method 2: Push only (if HTML is already generated)
python3 scripts/push.py
```

## Quick Start

### Requirements
- Python 3.6+
- Git
- GitHub account

### Clone Project
```bash
git clone https://github.com/iamcheyan/iamcheyan.github.io.git
cd iamcheyan.github.io
```

### Modify Content
1. Edit `data/content_zh.json` or `data/content_jp.json`
2. Run `python3 app.py` to build and push to GitHub in one click

### Custom Configuration
- **Remote Repository**: Modify the `--remote` parameter in `scripts/push.py`
- **Push Branch**: Modify the `--branch` parameter in `scripts/push.py`
- **Template Style**: Modify `index.template.html` and `static/che.css`

## Project Features

### 1. Simple and Efficient
- Pure static website, fast loading
- No database dependencies, easy maintenance
- CDN acceleration support

### 2. Easy to Maintain
- Separation of data and presentation
- Template design, easy to modify
- Automated build and deployment

### 3. Multi-language Support
- Complete Chinese-Japanese bilingual support
- Independent content management
- Automatic language switching

### 4. Modern Design
- Responsive layout
- Dark mode support
- Elegant visual effects

## Contact

- **Website**: https://iamcheyan.com
- **GitHub**: https://github.com/iamcheyan
- **Twitter**: https://x.com/iamcheyan
- **Email**: me@iamcheyan.com

## License

This project uses the MIT License. For details, see the [LICENSE](LICENSE) file.

---

*Last updated: September 2025*
