# Scripts 文件夹

这个文件夹包含了项目的各种脚本工具。

## push.py

Git 推送脚本，用于自动提交并强制推送到远程仓库。

### 功能特性

- 默认强制推送到 `main` 分支
- 自动使用当前时间作为提交消息
- 支持自定义远程仓库和分支
- 自动初始化 Git 仓库（如果不存在）

### 使用方法

#### 方法一：使用便捷脚本（推荐）

```bash
# 从项目根目录运行
./push

# 推送到其他分支
./push --branch develop

# 不使用强制推送
./push --no-force
```

#### 方法二：直接运行 Python 脚本

```bash
# 从项目根目录运行
python3 scripts/push.py

# 推送到其他分支
python3 scripts/push.py --branch develop

# 不使用强制推送
python3 scripts/push.py --no-force
```

### 参数说明

- `--remote REMOTE`: 远程仓库地址（默认：git@github.com:iamcheyan/iamcheyan.github.io.git）
- `--branch BRANCH`: 推送分支名（默认：main）
- `--no-force`: 不使用强制推送（默认启用强制推送）

### 环境变量

- `GIT_REMOTE`: 设置默认远程仓库地址
- `GIT_BRANCH`: 设置默认分支名

### 提交消息格式

脚本会自动生成如下格式的提交消息：
```
Update: 2025-09-23 15:54:59
```
