<?php get_header(); ?>
<?php
	//引入自定义字段
	if (is_single())
	{
		$caseinfo = get_post_meta($post->ID, "caseinfo_value", true);
		$webbgcolor = get_post_meta($post->ID, "webbgcolor_value", true);
		$webbordercolor = get_post_meta($post->ID, "webbordercolor_value", true);
		$casedetail = get_post_meta($post->ID, "casedetail_value", true);
		$webimg = get_post_meta($post->ID, "webimg_value", true);
	}
?>
<section class="case-page">
	<?php while(have_posts()) : the_post(); ?>
		<!--
			网页-84
		-->
		<?php
			$post = $wp_query->post;
			if ( in_category('84') ) {
		?>
		<div id="caseWeb">
			<div class="case-title">
				<div class="content">
					<h4 class="tit">
						<a href="/case">Portfolio 案例</a> / <a href="/category/website/" title="网页设计以及WEB开发">网页设计以及WEB开发</a> / <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						<span class="edit"> 
							<?php edit_post_link('[编辑文章]', '', ''); ?>
						</span>
					</h4>
					<div class="description fn-clear">
						<div class="info">
							<?php echo $caseinfo; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="case-detailed">
				<div class="page_bg">
					<div class="case-content fn-clear">
						<div class="case-ask">
							<h3><?php the_title(); ?></h3>
							<span class="fn-right">
								<span>同此设计师交谈</span>
								<span class="qq-online">
									<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=77017463&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:77017463:41" alt="点击这里同橄榄传媒设计师澈言进行交谈" title="点击这里同橄榄传媒设计师澈言进行交谈"/></a>
									<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=274662512&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:274662512:41" alt="点击这里同橄榄传媒销售代表Bopt进行交谈" title="点击这里同橄榄传媒销售代表Bopt进行交谈"/></a>
								</span>
							</span>
						</div>
						<div class="case_img">
							<img src="<?php echo $webimg; ?>" alt="<?php the_title(); ?>">
						</div>
						<div class="conditions">
							<?php echo $casedetail; ?>
							<div class="tag">
								标签：<?php the_tags('','&nbsp;/&nbsp;',''); ?>
							</div>
						</div>
					</div>
					<div class="screenshot" style="background-color: <?php echo $webbgcolor; ?>; border-bottom-color: <?php echo $webbordercolor; ?>;">
						<?php the_content('',false,'') ?>
					</div>
				</div>
			</div>
		</div>
		<div class="case-re">
			<h5 class="tit">其他相关案例</h5>
			<div class="case-list">
				<!-- 读取最新的6篇文章并排除分类ID为111里面的文章 -->
				<?php query_posts('showposts=6&cat=84'); ?>
				<ul class="fn-clear fn-grid-3">
					<?php while (have_posts()) : the_post(); ?>  
					<li class="case-li fn-box">
						<div class="pic">
							<a class="show" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
							<b class="category">
								<?php the_category(' ') ?><?php ?>
							</b>
							<a class="link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php 
									if(has_post_thumbnail()) {
										the_post_thumbnail('w325');
									} else {
										// 显示默认图片或者不做任何事情
									}
								?>
							</a>
						</div>
						<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><b class="edit"><?php edit_post_link('Edit', '', ''); ?></b>
						</h5>
						<p class="brief">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php
									//引入自定义字段
									$caseinfo = get_post_meta($post->ID, "caseinfo_value", true);
									$content = mb_substr($caseinfo,0,46,'utf-8');
									$html = array("<br>","<br/>","<p>","</p>");
									$content = str_replace($html,"",$content);
									echo $content,'...';
								?>
							</a>
						</p>
					</li>
					<?php endwhile;?> 
				</ul>
				<?php wp_reset_query(); ?>
			</div>
		</div>
		<!--
			视频-85
		-->
		<?php
			} else
			if ( in_category('85') ) {
		?>
		<div id="caseVideo">
			<div class="case-title">
				<div class="content">
					<h4 class="tit">
						<a href="/case">Portfolio 案例</a> / <a href="/category/video/" title="视频广告以及影视后期特效">视频广告以及影视后期特效</a> / <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						<span class="edit"> 
							<?php edit_post_link('[编辑文章]', '', ''); ?>
						</span>
					</h4>
					<div class="description fn-clear">
						<?php echo $caseinfo; ?>
					</div>
					<div class="tag">
						标签：<?php the_tags('','&nbsp;/&nbsp;',''); ?>
					</div>
				</div>
			</div>
			<div class="case-content">
				<div class="case-ask">
					<h3><?php the_title(); ?></h3>
					<span class="fn-right">
						<span>同此设计师交谈</span>
						<span class="qq-online">
							<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=23623021&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:23623021:41" alt="点击这里同橄榄传媒视频特效师David Wong进行交谈" title="点击这里同橄榄传媒视频特效师David Wong进行交谈"/></a>
							<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=274662512&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:274662512:41" alt="点击这里同橄榄传媒销售代表Bopt进行交谈" title="点击这里同橄榄传媒销售代表Bopt进行交谈"/></a>
						</span>
					</span>
				</div>
				<div class="video-part">
					<?php the_content('',false,'') ?>
				</div>
			</div>
		</div>
		<div class="case-re">
			<h5 class="tit">其他相关案例</h5>
			<div class="case-list">
				<!-- 读取最新的6篇文章并排除分类ID为111里面的文章 -->
				<?php query_posts('showposts=6&cat=85'); ?>
				<ul class="fn-clear fn-grid-3">
					<?php while (have_posts()) : the_post(); ?>  
					<li class="case-li fn-box">
						<div class="pic">
							<a class="show" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
							<b class="category">
								<?php the_category(' ') ?><?php ?>
							</b>
							<a class="link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php 
									if(has_post_thumbnail()) {
										the_post_thumbnail('w325');
									} else {
										// 显示默认图片或者不做任何事情
									}
								?>
							</a>
						</div>
						<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><b class="edit"><?php edit_post_link('Edit', '', ''); ?></b>
						</h5>
						<p class="brief">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php
									//引入自定义字段
									$caseinfo = get_post_meta($post->ID, "caseinfo_value", true);
									$content = mb_substr($caseinfo,0,46,'utf-8');
									$html = array("<br>","<br/>","<p>","</p>");
									$content = str_replace($html,"",$content);
									echo $content,'...';
								?>
							</a>
						</p>
					</li>
					<?php endwhile;?> 
				</ul>
				<?php wp_reset_query(); ?>
			</div>
		</div>
		<!--
			室内效果图-86
		-->
		<?php
			} else
			if ( in_category('86')) {
		?>
		<div id="caseHome">
			<div class="case-title">
				<div class="content">
					<h4 class="tit">
						<a href="/case">Portfolio 案例</a> / <a href="/category/home/" title="室内建筑效果图创意与制作">室内建筑效果图创意与制作</a> / <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h4>
					<div class="description fn-clear">
						<?php echo $caseinfo; ?>
					</div>
					<div class="tag">
						标签：<?php the_tags('','&nbsp;/&nbsp;',''); ?>
					</div>
				</div>
			</div>
			<div class="case-content">
				<div class="case-ask">
					<h3><?php the_title(); ?></h3>
					<span class="fn-right">
						<span>同此设计师交谈</span>
						<span class="qq-online">
							<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=179030841&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:179030841:41" alt="点击这里同橄榄传媒室内设计师Jason Yao进行交谈" title="点击这里同橄榄传媒室内设计师Jason Yao进行交谈"/></a>
							<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=407504509&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:407504509:41" alt="点击这里同橄榄传媒室内设计师康康进行交谈" title="点击这里同橄榄传媒室内设计师康康进行交谈"/></a>
							<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=274662512&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:274662512:41" alt="点击这里同橄榄传媒销售代表Bopt进行交谈" title="点击这里同橄榄传媒销售代表Bopt进行交谈"/></a>
						</span>
					</span>
				</div>
				<?php the_content('',false,'') ?>
			</div>
		</div>
		<div class="case-re">
			<h5 class="tit">其他相关案例</h5>
			<div class="case-list">
				<!-- 读取最新的6篇文章并排除分类ID为111里面的文章 -->
				<?php query_posts('showposts=6&cat=86'); ?>
				<ul class="fn-clear fn-grid-3">
					<?php while (have_posts()) : the_post(); ?>  
					<li class="case-li fn-box">
						<div class="pic">
							<a class="show" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
							<b class="category">
								<?php the_category(' ') ?><?php ?>
							</b>
							<a class="link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php 
									if(has_post_thumbnail()) {
										the_post_thumbnail('w325');
									} else {
										// 显示默认图片或者不做任何事情
									}
								?>
							</a>
						</div>
						<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><b class="edit"><?php edit_post_link('Edit', '', ''); ?></b>
						</h5>
						<p class="brief">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php
									//引入自定义字段
									$caseinfo = get_post_meta($post->ID, "caseinfo_value", true);
									$content = mb_substr($caseinfo,0,46,'utf-8');
									$html = array("<br>","<br/>","<p>","</p>");
									$content = str_replace($html,"",$content);
									echo $content,'...';
								?>
							</a>
						</p>
					</li>
					<?php endwhile;?> 
				</ul>
				<?php wp_reset_query(); ?>
			</div>
		</div>
		<!--
			平面设计-120
		-->
		<?php
			} else
			if ( in_category('120') || in_category('131')) {
		?>
		<div id="graphic">
			<div class="case-title">
				<div class="content">
					<h4 class="tit">
						<a href="/case">Portfolio 案例</a> / <a href="/category/design/" title="品牌形象以及平面设计">品牌形象以及平面设计</a> / <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						<span class="edit"> 
							<?php edit_post_link('[编辑文章]', '', ''); ?>
						</span>
					</h4>
					<div class="description fn-clear">
						<?php echo $caseinfo; ?>
					</div>
					<div class="tag">
						标签：<?php the_tags('','&nbsp;/&nbsp;',''); ?>
					</div>
				</div>
			</div>
			<div class="case-content">
				<div class="case-ask">
					<h3><?php the_title(); ?></h3>
					<span class="fn-right">
						<span>同此设计师交谈</span>
						<span class="qq-online">
							<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=77017463&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:77017463:41" alt="点击这里同橄榄传媒设计师澈言进行交谈" title="点击这里同橄榄传媒设计师澈言进行交谈"/></a>
							<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=274662512&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:274662512:41" alt="点击这里同橄榄传媒销售代表Bopt进行交谈" title="点击这里同橄榄传媒销售代表Bopt进行交谈"/></a>
						</span>
					</span>
				</div>
				<?php the_content('',false,'') ?>
			</div>
		</div>
		<div class="case-re">
			<h5 class="tit">其他相关案例</h5>
			<div class="case-list">
				<!-- 读取最新的6篇文章并排除分类ID为111里面的文章 -->
				<?php query_posts('showposts=6&cat=120&cat=131'); ?>
				<ul class="fn-clear fn-grid-3">
					<?php while (have_posts()) : the_post(); ?>  
					<li class="case-li fn-box">
						<div class="pic">
							<a class="show" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
							<b class="category">
								<?php the_category(' ') ?><?php ?>
							</b>
							<a class="link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php 
									if(has_post_thumbnail()) {
										the_post_thumbnail('w325');
									} else {
										// 显示默认图片或者不做任何事情
									}
								?>
							</a>
						</div>
						<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><b class="edit"><?php edit_post_link('Edit', '', ''); ?></b>
						</h5>
						<p class="brief">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php
									//引入自定义字段
									$caseinfo = get_post_meta($post->ID, "caseinfo_value", true);
									$content = mb_substr($caseinfo,0,46,'utf-8');
									$html = array("<br>","<br/>","<p>","</p>");
									$content = str_replace($html,"",$content);
									echo $content,'...';
								?>
							</a>
						</p>
					</li>
					<?php endwhile;?> 
				</ul>
				<?php wp_reset_query(); ?>
			</div>
		</div>
		<!--
			文章博客-124&188
		-->
		<?php
			} else
			if ( in_category('124') || in_category('188')) {
			include( TEMPLATEPATH.'/post_content.php');
		?>
		<?php
			}
		?>
	<?php endwhile; ?>
</section>
<?php get_footer(); ?>