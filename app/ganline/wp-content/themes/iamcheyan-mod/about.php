<?php
/*
Template Name: aboutMe
*/ 
?>
<?php include_once("m.php"); ?>
<!doctype html>
<html><head>
<?php if(!m) {?>
<title>iamcheyan.com</title>
<?php } else {?>
<title>Iamcheyan</title>
<?php }?>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<meta name="robots" content="index,follow" />
<meta name="author" content="iamcheyan" />
<meta name="copyright" content="Copyright © 2010-2012 iamcheyan. All rights reserved." />
<meta name="description" content="iamcheyan.com是设计师郭澈言的个人站点。" />
<link rel="alternate" type="application/rss+xml" title="iamcheyan.com站点推送 RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="iamcheyan.com站点推送 RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="iamcheyan.com站点推送 Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/che.css" />
<?php if(!$m){ /* 非移动设备 */ ?>
<link rel="shortcut icon" href="http://works.iamcheyan.com/favicon.ico" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jq.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/about.min.js"  type="text/javascript"></script>
<!--[if lt IE 9]>
	<script src="<?php bloginfo('template_url'); ?>/js/html5.js"></script>
<![endif]-->
<?php } else { /* 移动设备 */ ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0;" /> 
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta name="format-detection" content="email=no" />
<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/img/icon@2x.png" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jq.min.js"></script>
<?php } ?>
</head>
<body class="cheyan">
	<che>
		<h1 class="title">iamcheyan.com</h1>
		<header style="display:none">
			<nav>
				<ul>
					<li><a href="javascript:;" title="关于我" data-link=".about" class="at">about</a></li>
					<li><a href="javascript:;" title="联系" data-link=".contact" class="at">contact</a></li>
					<li><a href="javascript:;" title="留言" data-link=".ds-thread" class="at">comments</a></li>
					<li><a href="http://veikin.com" target="_blank">veikin</a></li>
					<li class="weibo"><a href="http://weibo.com/cheyan" target="_blank" title="微博">weibo</a></li>
					<li class="note"><a href="http://user.qzone.qq.com/77017463" target="_blank" title="日志（在QQ空间）">note(QQzone)</a></li>	
				</ul>
			</nav>
		</header>
		<?php if(have_posts()) : ?>
		<?php while(have_posts()) : the_post(); ?>
			<section class="content about">
				<?php the_content(); ?>
				<?php endwhile; ?>
				<?php else : ?>
				<div>
					<h2>
					<?php _e('Not Found'); ?>
					</h2>
				</div>
			</section>
		<?php endif; ?>
		<?php comments_template(); ?> 
			</section>
			<footer>
				<p>
					<span>©&nbsp;2009-<?php echo date('Y',time()); ?> &nbsp;</span>
					<a href="http://iamcheyan.com">Iamcheyan.com</a>
					<a href="http://iamcheyan.com/wp-admin/" target="_blank" class="admin">Admin Login</a>
					<a href="http://iamcheyan.com/wp-admin/admin.php?page=statpresscn/statpresscn.php" target="_blank" title="访问统计" class="time">访问统计</a>
				</p>
			</footer>
		</che>
		<!--[if lt IE 9]>
		<div class="ie-bg" style="display:block; _top:expression(offsetParent.scrollTop); _left:expression(offsetParent.scrollLeft);">
			<img src="http://ww3.sinaimg.cn/large/64d1ec5djw1dzfjmnnf1qj.jpg" alt="DSC-1030.by.Mi">
		</div>
		<![endif]-->
		<div class="fn-hide">
			<!-- google analytice -->
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
			<!-- google end -->
			<!-- baidu tongji -->
			<script type="text/javascript">
			var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
			document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F53b93e98818f4f350fb0d80429f05ea5' type='text/javascript'%3E%3C/script%3E"));
			</script>
			<!-- baidu tongji end -->
		</div>
		<?php wp_footer(); ?>
	</body>
</html>
