# 徹言 (Cheyan) 個人ウェブサイト

徹言の個人ウェブサイトプロジェクトへようこそ！これは私の技術背景、作品集、業績を展示するモダンな静的ウェブサイトです。

## 私について

私は徹言、フルスタック開発者兼作家です。2009年からフルスタック開発に従事し、Python（Flask・PyWebIO・Streamlit）、JavaScript（ES6+）、MySQLなどの技術スタックを活用してまいりました。2014年に起業し、投資を獲得した経験があります。チームマネジメントやプロジェクト実行の豊富な経験を持ち、書籍出版や映像作品の脚本・制作にも携わるなど、多分野での協働経験を積んでまいりました。

現在は日本でWeb開発職を希望しております。自身の技術専門性と多様な背景を活かし、製品革新とチーム発展により大きな価値を提供したいと考えています。

## ウェブサイトアーキテクチャ

### 技術スタック
- **フロントエンド**: HTML5, CSS3, JavaScript (ES6+)
- **テンプレートエンジン**: カスタムPythonテンプレートシステム
- **ビルドツール**: Pythonスクリプト自動ビルド
- **ホスティングプラットフォーム**: GitHub Pages
- **バージョン管理**: Git

### プロジェクト構造

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
└── README_*.md           # 多言語説明ファイル
```

## ウェブサイトの仕組み

### 1. コンテンツ管理システム
ウェブサイトは**データ駆動**のアーキテクチャ設計を採用：

- **データ層**: JSONファイルで全ての動的コンテンツを保存
- **テンプレート層**: HTMLテンプレートでページ構造を定義
- **レンダリング層**: Pythonスクリプトでデータをテンプレートにレンダリング
- **出力層**: 静的HTMLファイルを生成

### 2. 多言語サポート
- 日本語と中国語のバイリンガルサポート
- 独立したJSONファイルで異なる言語のコンテンツを管理
- 対応言語のHTMLファイルを自動生成

### 3. 自動ビルドフロー
1. `data/` ディレクトリのJSONコンテンツファイルを修正
2. `python3 app.py` を実行して静的HTMLを生成
3. GitHub Pagesに自動プッシュ

## GitHubホスティング

### ホスティング方法
ウェブサイトは **GitHub Pages** でホスティング：
- **リポジトリアドレス**: `iamcheyan/iamcheyan.github.io`
- **アクセスアドレス**: `https://iamcheyan.com`
- **ブランチ**: `main`（デフォルトブランチ）

### 自動デプロイ
GitHub Pages は `main` ブランチのコンテンツを自動デプロイ：
- コードを `main` ブランチにプッシュ
- GitHub が自動検出してウェブサイトを再デプロイ
- 通常数分で更新が反映

## 開発ワークフロー

### 1. コンテンツ修正
```bash
# データファイルを編集
vim data/content_zh.json    # 中国語コンテンツを修正
vim data/content_jp.json    # 日本語コンテンツを修正
```

### 2. 再ビルド
```bash
# 静的HTMLファイルを生成
python3 app.py
```

これにより以下が生成されます：
- `index.html` (日本語版)
- `index.zh-cn.html` (中国語版)

### 3. 変更プレビュー
```bash
# ローカルプレビュー（オプション）
python3 -m http.server 8000
# http://localhost:8000 にアクセス
```

### 4. 本番環境へのデプロイ
```bash
# 方法1：ワンクリックビルド・プッシュ（推奨）
python3 app.py

# 方法2：プッシュのみ（HTMLが既に生成済みの場合）
python3 scripts/push.py
```

## クイックスタート

### 環境要件
- Python 3.6+
- Git
- GitHubアカウント

### プロジェクトクローン
```bash
git clone https://github.com/iamcheyan/iamcheyan.github.io.git
cd iamcheyan.github.io
```

### コンテンツ修正
1. `data/content_zh.json` または `data/content_jp.json` を編集
2. `python3 app.py` を実行してワンクリックでGitHubにビルド・プッシュ

### カスタム設定
- **リモートリポジトリ**: `scripts/push.py` の `--remote` パラメータを修正
- **プッシュブランチ**: `scripts/push.py` の `--branch` パラメータを修正
- **テンプレートスタイル**: `index.template.html` と `static/che.css` を修正

## プロジェクトの特徴

### 1. シンプルで効率的
- 純静的ウェブサイト、高速ロード
- データベース依存なし、メンテナンス簡単
- CDN加速サポート

### 2. メンテナンスしやすい
- データと表示の分離
- テンプレート化設計、修正容易
- 自動ビルド・デプロイ

### 3. 多言語サポート
- 完全な日中バイリンガルサポート
- 独立したコンテンツ管理
- 自動言語切り替え

### 4. モダンデザイン
- レスポンシブレイアウト
- ダークモードサポート
- エレガントな視覚効果

## 連絡先

- **ウェブサイト**: https://iamcheyan.com
- **GitHub**: https://github.com/iamcheyan
- **Twitter**: https://x.com/iamcheyan
- **メール**: me@iamcheyan.com

## ライセンス

このプロジェクトはMITライセンスを使用しています。詳細は [LICENSE](LICENSE) ファイルをご覧ください。

---

*最終更新: 2025年9月*
