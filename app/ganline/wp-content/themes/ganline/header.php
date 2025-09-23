<!doctype html>
<html lang="zh-CN">
<head>
<title><?php wp_title(' – ', true, 'right'); ?>橄榄传媒 | 橄榄广告 | 三门峡橄榄广告有限责任公司 | 三门峡广告公司 | 三门峡装修公司 | 三门峡室内设计 | 三门峡视频宣传片制作 | 三门峡装饰公司 | 三门峡网站建设 | 三门峡网站推广 | 三门峡室内效果图设计</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<meta name="robots" content="index,follow" />
<meta name="author" content="cheyan@ganline.com" />
<meta name="copyright" content="Copyright © 2012-<?php echo date('Y',time()); ?> ganline.com橄榄传媒. All rights reserved." />
<meta name="keywords" content="橄榄传媒，橄榄广告，三门峡橄榄广告有限责任公司，三门峡广告公司，三门峡装修公司，三门峡室内设计，三门峡视频宣传片制作，三门峡装饰公司，三门峡网站建设，三门峡网站推广，三门峡室内效果图设计" />
<meta name="description" content="橄榄传媒GANLINE.COM，系品牌策划与推广、平面及空间设计、网站开发建设的专业设计和传播机构。"/>
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
							<li><a href="/category/website/" title="网站设计及开发">网站设计及开发</a></li>
							<li><a href="/category/mobile/" title="移动互联网产品">移动互联网产品</a></li>
							<li><a href="/category/design" title="创意与平面设计">创意与平面设计</a></li>
							<li><a href="/category/home" title="室内家装效果图">室内空间设计图</a></li>
							<li><a href="/category/video" title="视频广告宣传片">视频广告宣传片</a></li>
						</ul>
					</div>
				</menu>
				<!-- <b>/</b> -->
				<menu <?php if ( is_category('124') ) { echo ' class="on" ' ; } ?> class="hot_link">
					<a href="http://ganline.com/ganline2013/" title="2013作品集锦">2013作品集锦</a>
				</menu>
				<!-- <b>/</b> -->
				<!-- <menu class="job">
					<a class="link" href="/about#job" title="Jobs 招聘">Jobs 招聘</a>
				</menu> -->
				<!-- <b>/</b> -->
				<!-- <menu>
					<a href="javascript:;" title=""Services 服务 / 流程>Services 服务 / 流程</a>
				</menu> -->
				<menu class="contact_us">
					<a href="/about#contact" title="Contact 联系我们">Contact 联系我们</a>
				</menu>
			</div>
		</nav>
	</div>
</header>
