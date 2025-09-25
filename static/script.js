
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

