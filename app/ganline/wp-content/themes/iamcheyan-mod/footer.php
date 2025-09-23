<?php include_once("m.php"); ?>
<footer>
		<nav class="nav" class="fn-clear">
			<ul class="part">
				<li><a href="/aboutme/">作者</a></li>
				<li><a href="http://weibo.com/cheyan" target="_blank" title="微博">微博</a></li>
				<li><a href="http://user.qzone.qq.com/77017463" target="_blank" title="日志（在QQ空间）">归档</a></li>
				<!-- <li><a href="http://veikin.com" target="_blank">VEIKIN</a></li> -->
			</ul>
			<!-- <ul class="part">
				
				
				<li><a href="http://www.douban.com/people/iamcheyan/" target="_blank">DouBan</a></li>
			</ul>
			<ul class="part">
				<li><a href="https://me.alipay.com/iamcheyan" target="_blank">AliPay</a></li>
			</ul>
	 -->
	</nav>
	<a class="admin" href="/wp-admin">admin</a>
	<span>
		Copyright © <?php echo date('Y',time()); ?> <a href="http://iamcheyan.com">cheyan</a>. All rights reserved
	</span>
</footer>
<!-- tongji -->
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-20626512-1']);
	_gaq.push(['_trackPageview']);
	
	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
<!-- tongji end -->
<?php wp_footer(); ?>
</body>
</html>
