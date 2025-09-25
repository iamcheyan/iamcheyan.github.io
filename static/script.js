$(function(){
	// $(window).scroll(function(){
		// $s = $(document).scrollTop();
		// $(".nav").addClass("fixed").show().css("top", $s);
		
		// $bookTop = $(".box.book").offset().top;
		// $projectTop = $(".box.project").offset().top;
		// $cheTop = $(".che").offset().top;
		
		// if ($s > $bookTop){
			// $(".box.book").animate({
				// paddingTop : 220
			// });
			// $(".nav").addClass("fixed").show().css("top", $bookTop + 50);
		// } if ($s > $projectTop || $s > ($projectTop - 800)){
			// $(".box.project").animate({
				// paddingTop : 220
			// });
			// $(".nav").addClass("fixed").show().css("top", $projectTop + 30);
		// } if ($s < 280){
			// $("header.fixed").hide();
		// };
	// });
	
	$("nav .menu").hover(function(){
		$(this).find("a").css("z-index",2);
		$(this).find("ul").show();
		$(this).parents("header").css("z-index",999);
	},function(){
		$(this).find("a").css("z-index",0);
		$(this).find("ul").hide();
		$(this).parents("header").css("z-index",1);
	});
	$("header>h1>a").click(function(){
		$(this).attr("href","javascript:;");
		$("html,body").animate({
			scrollTop: 0
		},500);
	});
	$(".at").click(function(){		
		$box = $(this).attr("data-box");	
		$top = $($box).offset().top;
		$("html,body").animate({
			scrollTop: $top -100
		},1000,function(){
			$(".nav").slideDown(300);
		});
		return false;
	});
	
});

// YouTube 视频模态框功能
function openVideoModal() {
	const modal = document.getElementById('video-modal');
	const player = document.getElementById('youtube-player');
	
	// 使用澈言的纪录片视频
	const videoId = 'fNH7k-i9IdA'; // 澈言的纪录片视频
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

