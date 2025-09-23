<?php
/*
Template Name: blog_list
*/ 
?>
<?php get_header(); ?>
<section class="case-page">
	<!-- <h3 class="tit">
		<a href="/case">Blog 博客</a>
	</h3> -->
	<?php
		/*
		<div class="case-title">
			<div class="content">
				<h4 class="tit">日志关键字</h4>
				<div class="description fn-clear">
					<div class="tag">
						<!-- 抓取所有标签 -->
						<?php
							$tags = get_terms('post_tag');
							foreach ( $tags as $key => $tag ) {
								if ( 'edit' == 'view' )
									$link = get_edit_tag_link( $tag->term_id, 'post_tag' );
								else
									$link = get_term_link( intval($tag->term_id), 'post_tag' );
								if ( is_wp_error( $link ) )
									return false;

								$tags[ $key ]->link = $link;
								$tags[ $key ]->id = $tag->term_id;
								$tags[ $key ]->name = $tag->name;
								?>
								<li>
										<a href="<?php echo $link ?>" ><?php echo $tag->name ?></a>
								</li>

								<?php
							//echo ' <a href="'. $link .'">' . $tag->name . '</a>';
							}
						?>
					</div>
				</div>
			</div>
		</div>
		*/
	?>
	
	<div class="content fn-ov">
		<div>
			<?php query_posts("cat=124,188"); ?>
			<ul class="blog_list">
				<?php while (have_posts()) : the_post(); ?>  
				<li class="blog_li">
					<div class="h1 fn-clear">
						<?php echo get_avatar( get_the_author_email(), 60 ); ?>
						<div class="blog_info">
							<h3>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</h3>
							// <?php the_author(); ?> 发表与<?php the_time('Y'); ?>年<?php the_time('M')?>月<?php the_time('d')?>日
							<b class="edit"><?php edit_post_link('Edit', '', ''); ?></b>
						</div>
					</div>
					
					
					<div class="blog_content">
						<?php
							//引入自定义字段
							$caseinfo = get_post_meta($post->ID, "caseinfo_value", true);
							$content = mb_substr($caseinfo,'utf-8');
							$html = array("<br>","<br/>","<p>","</p>");
							$content = str_replace($html,"",$content);
							echo $content;
						?>
					</div>
					<div class="more">
						<a href="<?php the_permalink() ?>" title="阅读全文">阅读全文</a>
					</div>
				</li>
				<?php endwhile;?> 
			</ul>
			<!-- <ul class="fn-clear fn-grid-3">
				<?php while (have_posts()) : the_post(); ?>  
				<li class="case-li fn-box">
					<div class="pic">
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
					<p><?php the_tags('','&nbsp;/&nbsp;',''); ?></p>
				</li>
				<?php endwhile;?> 
			</ul> -->
		</div>
	</div>
</section>
<?php get_footer(); ?>