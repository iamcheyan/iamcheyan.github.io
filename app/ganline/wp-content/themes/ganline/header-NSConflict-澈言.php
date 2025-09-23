<!doctype html>
<html lang="zh-CN">
<head>
<?php if(!m) {?>
<title>
	<?php wp_title(' – ', true, 'right'); ?>
	<?php bloginfo('name'); ?>
</title>
<?php } else {?>
<title>
	<?php wp_title(' – ', true, 'right'); ?>
	<?php bloginfo('name'); ?>
</title>
<?php }?>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<meta name="robots" content="index,follow" />
<meta name="author" content="cheyan@ganline.com" />
<meta name="copyright" content="Copyright © 2012-2013 ganline.com橄榄传媒. All rights reserved." />
<meta name="keywords" content="设计公司|画册设计|广告公司|致力于企业品牌的建设、设计、广告；我们提供企业形象设计(设计公司、品牌设计),标志设计,画册设计(广告公司,画册设计),产品摄影(摄影公司),包装设计(包装设计,品牌设计公司),网站建设(网络公司),室内效果图设计,三门峡装修，三门峡网站建设" />
<meta name="description" content="橄榄传媒（ganline.com），是一家什么都做的设计公司。"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" /> 
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta name="format-detection" content="email=no" />
<link rel="apple-touch-icon" href="/static/img/app-ico.gif" />
<link rel="alternate" type="application/rss+xml" title="橄榄传媒站点推送 RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="橄榄传媒站点推送 RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="橄榄传媒站点推送Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="/static/css/style.css" />
<link rel="shortcut icon" href="/static/img/favicon.ico" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="/static/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/static/js/ganline.min.js"></script>
<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" media="all" href="/static/css/ie.css" />
	<script src="/static/js/html5.js"></script>
<![endif]-->
</head>
<body>
<header>
	<div class="content">
		<a href="/" title="橄榄传媒" class="logo">
			<img src="/static/img/logo.gif" alt="橄榄传媒LOGO">
		</a>
		<nav>
			<div class="nav_left">
				<menu class="index">
					<a class="link" href="/" title="Home 首页">Home 首页</a>
					<!-- <b>/</b> -->
				</menu>
				<menu class="about <?php if ( is_page('about') ) { echo ' on ' ; } ?>">
					<a class="link" href="/about" title="About 了解我们">About 了解我们</a>
				</menu>
				<!-- <b class="hide">/</b> -->
			</div>
			<div class="nav_right">
				<menu <?php if ( is_page('case') || is_tag() ) { echo ' class="on" ' ; } ?>>
					<div class="sort_menu">
						<a class="link" href="/case" title="Portfolio 案例">Portfolio 案例</a>
						<ul>
							<li><a href="/category/website/" title="WebSite 网站开发">WebSite 网站开发</a></li>
							<li><a href="/category/design" title="Disign 平面设计">Disign 平面设计</a></li>
							<li><a href="/category/home" title="Home 工程效果">Home 工程效果</a></li>
							<li><a href="/category/video" title="video 视频包装">video 视频包装</a></li>
						</ul>
					</div>
				</menu>
				<!-- <b>/</b> -->
				<menu <?php if ( is_category('124') ) { echo ' class="on" ' ; } ?>>
					<a href="/blog" title="Blog 博客">Blog 博客</a>
				</menu>
				<!-- <b>/</b> -->
				<!-- <menu class="job">
					<a class="link" href="/about#job" title="Jobs 招聘">Jobs 招聘</a>
				</menu> -->
				<!-- <b>/</b> -->
				<!-- <menu>
					<a href="javascript:;" title=""Services 服务 / 流程>Services 服务 / 流程</a>
				</menu> -->
				<menu>
					<a href="/about#contact" title="Contact 联系我们">Contact 联系我们</a>
				</menu>
			</div>
		</nav>
	</div>
</header>
