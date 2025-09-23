<?php get_header(); ?>

<section class="content fn-ov">
	<div class="is-me">
		<div class="index-img">
			<div class="img-box">
				<div class="arrows">
					<a href="javascript:;" class="left">
						<i>上一张</i>
					</a>
					<a href="javascript:;" class="right">
						<i>下一张</i>
					</a>
				</div>
				<ul class="fn-clear ul">
					<?php
						//获取到的文件是在根目录
						$imgxml = simplexml_load_file(TEMPLATEPATH . '/admin/index_top_img.xml');
						foreach($imgxml -> iteam as $iteams) {
					?>
						<li>
							<?php
								$imgDesc = $iteams -> describe;
								if(strlen($imgDesc) > 1){
									echo '<div class="info"><div class="text">' . $imgDesc . '</div><div class="bg"></div></div>';
								};
							?>
							
							<a href="<?php print ($iteams -> link);?>" title="<?php print ($iteams -> titie);?>">
								<img src="<?php print ($iteams -> image);?>" alt="<?php print ($iteams -> titie);?>">
							</a>
						</li>
					<?php
						}
					?>
				</ul>
			</div>
		</div>
		<div class="power">
			<div class="fn-clear fn-grid-4">
				<dl class="fn-box">
					<dt class="tit">品牌形象以及平面设计</dt>
					<dd class="info">企业形象是指人们通过企业的各种标志而建立起来的对企业的总体印象，我们为您的企业提供辨识度高的品牌形象策划及设计服务。</dd>
					<dd class="more">
						<a href="/category/design/" title="品牌形象以及平面设计">查看详细</a>
					</dd>
				</dl>
				<dl class="fn-box">
					<dt class="tit">视频广告以及影视后期特效</dt>
					<dd class="info">我们致力于视频媒介的推广与传媒产业相关研究及国际项目开发，运用画面语言与专业的后期制作技术为您营造出与众不同视觉效果。</dd>
					<dd class="more">
						<a href="/category/video/" title="视频广告以及影视后期特效">查看详细</a>
					</dd>
				</dl>
				<dl class="fn-box">
					<dt class="tit">室内建筑效果图创意与制作</dt>
					<dd class="info">为您量身定制高端家居生活，个性化布局，打造私属的品味空间，给您的家带来舒适，环保，时尚，个性化的生活品位。</dd>
					<dd class="more">
						<a href="/category/home/" title="室内建筑效果图创意与制作">查看详细</a>
					</dd>
				</dl>
				<dl class="fn-box">
					<dt class="tit">网页设计以及WEB开发</dt>
					<dd class="info">网站是企业在因特网上宣传和反映形象和文化的重要窗口，我们为您提供最优秀的网页设计以及整站开发服务。</dd>
					<dd class="more">
						<a href="/category/website/" title="网页设计以及WEB开发">查看详细</a>
					</dd>
				</dl>
			</div>
		</div>
	</div>
	<div class="lately fn-clear">
		<h3 class="tit">
			近期作品&服务
		</h3>
		<div class="case-list lazy_img">
			<!-- 读取最新的文章并排除分类ID为124,118博客里面的文章 -->
			<?php query_posts('showposts=9&cat=-124,-188'); ?>
			<ul class="fn-grid-3 fn-clear">
				<?php while (have_posts()) : the_post(); ?>  
				<li class="case-li fn-box">
					<div class="pic ">
						<a class="show" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
						<b class="category">
							<?php the_category(' ') ?><?php ?>
						</b>
						<a class="link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php 
								$imageurl = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full-size');
							?>
							<img src="" width="<?php echo $imageurl [1]; ?>" height="<?php echo $imageurl [2]; ?>" alt="<?php the_title(); ?>" img-data="<?php echo $imageurl [0]; ?>" />
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
					<?php /*
						<p><?php the_tags('','&nbsp;/&nbsp;',''); ?></p>
					*/?>
				</li>
				<?php endwhile;?> 
			</ul>
			<?php wp_reset_query(); ?>
			<div class="fn-center more_case">
				<a href="/case" >+ 查看更多案例</a>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
