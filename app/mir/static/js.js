$(function(){
	$(".mdl dt").click(function(){
		$(this).parents(".mdl").toggleClass("mdlon");
		$(this).toggleClass("on");
	});
	var $fixedMenu = $("#ULeft #menu");
	var $vHeight = $(window).height();
	var $tableWidth = $(".tableBasic").width();
	// console.log($tableWidth);
	$tableT  = $(".table.tableBasic").offset().top - 20;
	$("#ULeft #menu").height($vHeight - 100);
	$(window).load(function(){
		$t = $fixedMenu.offset().top;
		// console.log($tableT)
	});
	var $trHtml = $(".tableBasic tr").html();
		// console.log($trHtml);
		$(".tableBasic").before("<table cellpadding='0' cellspacing='0' class='table tableBasic fixedTable' ><tbody><tr>"+$trHtml+"</tbody></tr></table>");
		$(".tableBasic").width($tableWidth)
	window.onscroll = function(){
		var $s = $(document).scrollTop();
		if ($s > $t){
			$fixedMenu.css({
				position : "fixed",
				top : 40,
				height :  $vHeight - 100
				// left : 0
			});
		} else {
			$fixedMenu.css({
				position : "static"
			})
		}
		if ($s > $tableT){
			$(".fixedTable").fadeIn(100);
		} else {
			$(".fixedTable").fadeOut(100);
		}
	};
	function windowsResize(){
		var $vHeight = $(window).height();
		$("#ULeft #menu").height($vHeight - 100);
		var $s = $(document).scrollTop();
		if ($s > $tableT){
			$(".fixedTable").fadeIn(100);
		} else {
			$(".fixedTable").fadeOut(100);
		}
	}
	window.onresize = windowsResize;
});

