
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
(function(){
  // 事件照片弹窗逻辑
  function openEventPhotoModal(src, caption, title, date){
    var modal = document.getElementById('event-photo-modal');
    if(!modal) return;
    var img = document.getElementById('event-photo-modal-img');
    var titleEl = document.getElementById('event-photo-modal-title');
    var descEl = document.getElementById('event-photo-modal-desc');
    var dateEl = document.getElementById('event-photo-modal-date');
    if(img){ img.src = src || ''; img.alt = caption || title || ''; }
    if(titleEl){ titleEl.textContent = title || ''; }
    if(descEl){ descEl.textContent = caption || ''; }
    if(dateEl){ dateEl.textContent = date || ''; }
    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeEventPhotoModal(){
    var modal = document.getElementById('event-photo-modal');
    if(!modal) return;
    modal.classList.remove('open');
    document.body.style.overflow = '';
  }

  // 点击遮罩关闭
  window.addEventListener('click', function(e){
    var modal = document.getElementById('event-photo-modal');
    if(modal && modal.classList.contains('open')){
      if(e.target === modal){ closeEventPhotoModal(); }
    }
  });
  // ESC 关闭
  window.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeEventPhotoModal(); });
  // 关闭按钮
  document.addEventListener('click', function(e){ if(e.target && e.target.classList && e.target.classList.contains('photo-close')) closeEventPhotoModal(); });

  // 事件图片点击打开弹窗
  document.addEventListener('click', function(e){
    var fig = e.target.closest && e.target.closest('.event-photo-figure');
    if(!fig) return;
    var src = fig.getAttribute('data-photo') || (fig.querySelector('img') ? fig.querySelector('img').src : '');
    var caption = fig.getAttribute('data-caption') || '';
    var title = fig.getAttribute('data-title') || '';
    var date = fig.getAttribute('data-date') || '';
    openEventPhotoModal(src, caption, title, date);
  });
})();

