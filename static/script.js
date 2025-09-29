
// YouTube 视频模态框功能
function openVideoModal() {
	const modal = document.getElementById('video-modal');
	const player = document.getElementById('youtube-player');
	
	// 使用澈言的纪录片视频
	const videoId = 'nJZTpk1Lf_8'; // 澈言的纪录片视频
	player.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
	
	modal.style.display = 'block';
	document.body.style.overflow = 'hidden'; // 防止背景滚动
}

function closeVideoModal() {
	const modal = document.getElementById('video-modal');
	const player = document.getElementById('youtube-player');
	
	modal.style.display = 'none';
	player.src = ''; // 停止视频播放
	document.body.style.overflow = 'auto'; // 恢复滚动
}

// 点击遮罩层关闭模态框
document.addEventListener('click', function(event) {
	const modal = document.getElementById('video-modal');
	const modalContent = document.querySelector('.video-modal-content');
	
	if (event.target === modal && event.target !== modalContent) {
		closeVideoModal();
	}
});

// ESC 键关闭模态框
document.addEventListener('keydown', function(event) {
	if (event.key === 'Escape') {
		closeVideoModal();
	}
});

// 主题切换功能
class ThemeManager {
	constructor() {
		this.themeToggle = null;
		this.themeIcon = null;
		this.currentTheme = 'light';
		this.init();
	}

	init() {
		// 等待DOM加载完成
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', () => this.setupThemeToggle());
		} else {
			this.setupThemeToggle();
		}
	}

	setupThemeToggle() {
		this.themeToggle = document.getElementById('theme-toggle');
		this.themeIcon = document.querySelector('.theme-icon');
		
		if (!this.themeToggle || !this.themeIcon) {
			console.warn('主题切换按钮未找到');
			return;
		}

		// 从localStorage读取保存的主题设置
		this.loadSavedTheme();
		
		// 绑定点击事件
		this.themeToggle.addEventListener('click', () => this.toggleTheme());
		
		// 监听系统主题变化
		if (window.matchMedia) {
			const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
			mediaQuery.addEventListener('change', (e) => {
				if (!localStorage.getItem('theme-preference')) {
					this.setTheme(e.matches ? 'dark' : 'light');
				}
			});
		}
	}

	loadSavedTheme() {
		const savedTheme = localStorage.getItem('theme-preference');
		
		if (savedTheme) {
			this.setTheme(savedTheme);
		} else {
			// 如果没有保存的主题，检查系统偏好
			const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
			this.setTheme(prefersDark ? 'dark' : 'light');
		}
	}

	setTheme(theme) {
		this.currentTheme = theme;
		
		// 更新HTML的data-theme属性
		document.documentElement.setAttribute('data-theme', theme);
		
		// 更新按钮图标
		if (this.themeIcon) {
			this.themeIcon.textContent = theme === 'dark' ? '☀️' : '🌙';
		}
		
		// 更新按钮的aria-label
		if (this.themeToggle) {
			this.themeToggle.setAttribute('aria-label', 
				theme === 'dark' ? '切换到明亮主题' : '切换到暗色主题'
			);
		}
		
		// 保存到localStorage
		localStorage.setItem('theme-preference', theme);
		
		// 触发自定义事件，其他组件可以监听
		document.dispatchEvent(new CustomEvent('themeChanged', { 
			detail: { theme: theme } 
		}));
	}

	toggleTheme() {
		const newTheme = this.currentTheme === 'light' ? 'dark' : 'light';
		this.setTheme(newTheme);
		
		// 添加切换动画效果
		if (this.themeToggle) {
			this.themeToggle.style.transform = 'scale(0.9)';
			setTimeout(() => {
				this.themeToggle.style.transform = '';
			}, 150);
		}
	}

	getCurrentTheme() {
		return this.currentTheme;
	}
}

// 创建主题管理器实例
const themeManager = new ThemeManager();

// 将主题管理器暴露到全局，方便其他脚本使用
window.themeManager = themeManager;

