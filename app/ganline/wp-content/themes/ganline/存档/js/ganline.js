//提交留言//{{{
var message = function(){
	$(".message .text").focus(function(){
		if ($(this).val() == this.defaultValue) {
			$(this).val("").css("color", "#333");
		};
	}).blur(function(){
		if ($(this).val() == "") {
			$(this).val(this.defaultValue).css("color","#eee");
		};
	});
};
//}}}
//首页图片滚动//{{{
var indexImgPlay = function() {
	//变量
	$box = $(".index-img");
	$ul = $box.find(".big-img");
	$li = $ul.find("li");
	$left = $box.find("a.left");
	$right = $box.find("a.right");
	$ani = $box.find("div.width");
	$i = $li.length;
	$w = $ul.find("img").width();
	$cur = 1;
	$num = $box.find(".num").find("li");

	//定义自动滚动
	var $mov;

	//右
	$right.click(function() {
		if (!$ani.is(":animated")) {
			if ($cur < $i) {
				$ani.animate({
					"left": "-=" + $w
				}, 800, function() {
					$cur++;
					$num.eq($cur - 1).addClass("on").siblings().removeClass("on");
				});
			}
			if ($cur == $i) {
				$ani.animate({
					"left": 0
				}, 1200, function() {
					$cur = 1;
					$num.eq(0).addClass("on").siblings().removeClass("on");
				});
			};
		};
	});
	//左
	$left.click(function() {
		if (!$ani.is(":animated")) {
			if ($cur > 1) {
				$ani.animate({
					"left": "+=" + $w
				}, 800, function() {
					$cur--;
					$num.eq($cur - 1).addClass("on").siblings().removeClass("on");
				});
			}
			if ($cur == 1) {
				$ani.animate({
					"left": -($i - 1) * $w
				}, 1200, function() {
					$cur = $i;
					$num.eq($cur - 1).addClass("on").siblings().removeClass("on");
				});
			};
		};
	});

	//点击num图标
	$num.click(function() {
		$ind = $(this).index();
		$ani.animate({
			"left": -($w * $ind)
		}, 800, function() {
			$cur = $ind + 1;
		});
		$(this).addClass("on").siblings().removeClass("on");
	});

	$box.live("mouseenter", function() {
		//移入时清除计时器
		clearInterval($mov);
	}).live("mouseleave", function() {
		//计时器
		$mov = setInterval(function() {
			$right.trigger("click");
		}, 5000);
	}).trigger('mouseleave');
};

//}}}
//异步加载
(function($){
	$.fn.extend({
		"LazyLoad":function(value){
			var $winH = $(window).height(); //获取窗口高度
			var $img = this;
			var $imgH = parseInt($img.height() / 2); //图片到一半的时候显示
			var $srcDef = "";
			$runing(); //页面刚载入时判断要显示的图片
			$(window).scroll(function() {
				$runing(); //滚动刷新
			});

			function $runing() {
				$img.each(function(i) { //遍历img
					var $src = $img.eq(i).attr("img-data"); //获取当前img URL地址
					var $scroTop = $img.eq(i).offset(); //获取图片位置
					if ($scroTop.top + $imgH >= $(window).scrollTop() && $(window).scrollTop() + $winH >= $scroTop.top + $imgH) { //判断窗口至上往下的位置
						if ($img.eq(i).attr("src") == $srcDef) {
							$img.eq(i).hide();
						};
						$img.eq(i).attr("src", function() {
							return $src
						}).fadeIn(300); //元素属性交换
					};;
				})
			};
		}
	});
})(jQuery);

//JS
$(function(){
	message();
	indexImgPlay();
	$(".lazy_img img").LazyLoad();
});
