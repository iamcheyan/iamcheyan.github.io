$(function(){
	//图片弹层
	$(".blog .post .con img").live({ 
		mouseenter: function() {
			var $top = $(this).offset.top();
			var $h = $(this).height();
			var $left = $(this).offset().left;
			console.log($top,$left,$h);
			$(this).after("<a class='link_img' style='position:absolute;left:" + $left +"px;top:" + $top + "px;'>查看大图</a>");
		}, mouseleave: function() { 
			// $(".link_img").remove();
		}
	}); 
});