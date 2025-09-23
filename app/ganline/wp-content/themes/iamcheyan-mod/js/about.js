// goTop = function(){
// 	$top = $(".go-top");
// 	$sTop = $(document).scrollTop();
// 	//ie6下goTop的定位
// 	if (!window.XMLHttpRequest) {
// 		$wHeight = $(window).height();
// 		$(".go-top").css("top",$sTop + $wHeight - 280);
// 	};
// 	if ($sTop > 160){
// 		$top.fadeIn(300);
// 	} else {
// 		$top.fadeOut(300);
// 	}
// };
$(function(){
	// window.onscroll = goTop;
	//iphone访问向下滚动一个像素，隐藏顶部地址栏;
	if (/(iPhone|iPad|iPod)/i.test(navigator.userAgent)) {  
		window.addEventListener('load', function(){
			setTimeout(scrollTo, 0, 0, 1) 
		}, false);
	};

	//在IE下显示可缩放的背景图
	if (!!window.ActiveXObject) {
		$bgImg = function(){
			$winWidth = document.body.clientWidth;
			$winHeight = document.body.clientHeight;
			$imgHeight = 1080 / (1920 / $winWidth);
			$(".ie-bg img").width($winWidth).height($imgHeight);
		};
		$bgImg();
		window.onresize = $bgImg;
	};
	
	$(".go-top").click(function(){
		$("html,body").animate({
			scrollTop: 0
		},1000);
	});
	$("a.at").click(function(){
		$link = $(this).attr("data-link");
		$point = $($link).offset().top;
		// console.log($point);
		$("html,body").animate({
			scrollTop: $point
		},1000);
	});
});