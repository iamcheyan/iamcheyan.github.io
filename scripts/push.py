#!/usr/bin/env python3
import argparse
import os
import shutil
import subprocess
import sys
from datetime import datetime
from pathlib import Path


def run(cmd: list[str], cwd: Path) -> subprocess.CompletedProcess:
    result = subprocess.run(cmd, cwd=cwd, capture_output=True, text=True)
    if result.returncode != 0:
        raise RuntimeError(
            f"命令执行失败: {' '.join(cmd)}\nSTDOUT:\n{result.stdout}\nSTDERR:\n{result.stderr}"
        )
    return result


def git_exists() -> bool:
    return shutil.which("git") is not None


def ensure_repo_initialized(repo_dir: Path, branch: str) -> None:
    git_dir = repo_dir / ".git"
    if not git_dir.exists():
        run(["git", "init"], cwd=repo_dir)
        # 显式设置默认分支名
        run(["git", "symbolic-ref", "HEAD", f"refs/heads/{branch}"], cwd=repo_dir)


def set_remote(repo_dir: Path, remote_url: str) -> None:
    # 如果 origin 已存在，先移除
    existing = subprocess.run(
        ["git", "remote"], cwd=repo_dir, capture_output=True, text=True
    )
    if existing.returncode == 0 and "origin" in existing.stdout.split():
        run(["git", "remote", "remove", "origin"], cwd=repo_dir)
    run(["git", "remote", "add", "origin", remote_url], cwd=repo_dir)


def has_any_commit(repo_dir: Path) -> bool:
    proc = subprocess.run(
        ["git", "rev-parse", "--verify", "HEAD"],
        cwd=repo_dir,
        capture_output=True,
        text=True,
    )
    return proc.returncode == 0


def has_staged_or_worktree_changes(repo_dir: Path) -> bool:
    # 工作区或暂存区有变更？
    proc = subprocess.run(
        ["git", "status", "--porcelain"], cwd=repo_dir, capture_output=True, text=True
    )
    return proc.stdout.strip() != ""


def commit_all(repo_dir: Path) -> None:
    now = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    message = f"Update: {now}"
    run(["git", "add", "-A"], cwd=repo_dir)

    if has_any_commit(repo_dir):
        # 有提交历史时，仅在有变更时提交
        if has_staged_or_worktree_changes(repo_dir):
            run(["git", "commit", "-m", message], cwd=repo_dir)
    else:
        # 首次提交允许空提交，确保可推送
        run(["git", "commit", "--allow-empty", "-m", message], cwd=repo_dir)


def push_force(repo_dir: Path, branch: str, force: bool) -> None:
    args = ["git", "push", "-u", "origin", branch]
    if force:
        args.append("--force")
    run(args, cwd=repo_dir)


def main() -> int:
    if not git_exists():
        print("错误: 未检测到 git，请先安装 Git 并配置凭据。", file=sys.stderr)
        return 1

    parser = argparse.ArgumentParser(
        description="将当前仓库内容强制推送到指定远程分支"
    )
    parser.add_argument(
        "--remote",
        default=os.environ.get(
            "GIT_REMOTE",
            "git@github.com:iamcheyan/iamcheyan.github.io.git",
        ),
        help="远程仓库地址（可用环境变量 GIT_REMOTE 覆盖）",
    )
    parser.add_argument(
        "--branch",
        default=os.environ.get("GIT_BRANCH", "main"),
        help="推送分支名（默认 main，可用环境变量 GIT_BRANCH 覆盖）",
    )
    parser.add_argument(
        "--no-force",
        action="store_true",
        help="不使用 --force（默认强制推送到 main 分支）",
    )

    args = parser.parse_args()
    remote_url: str = args.remote
    branch: str = args.branch
    use_force: bool = not args.no_force

    # 将工作目录切换到脚本所在目录的父目录（仓库根目录）
    repo_dir = Path(__file__).resolve().parent.parent
    os.chdir(repo_dir)

    try:
        ensure_repo_initialized(repo_dir, branch)
        set_remote(repo_dir, remote_url)
        commit_all(repo_dir)
        push_force(repo_dir, branch, use_force)
        print(
            f"已推送到 {remote_url} 的分支 {branch}（{'--force' if use_force else 'no-force'}）。"
        )
        return 0
    except Exception as exc:
        print(str(exc), file=sys.stderr)
        return 2


if __name__ == "__main__":
    sys.exit(main())


