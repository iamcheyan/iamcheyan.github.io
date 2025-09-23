<?php
/*
Template Name: case-page
*/ 
?>
<?php get_header(); ?>
<section class="case-page">
	<!-- <h3 class="tit">
		<a href="/case">Portfolio 案例 / 客户</a>
	</h3> -->
	<div class="case-title">
		<div class="content">
			<h4 class="tit">案例关键字</h4>
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
	<div class="content case-list fn-ov lazy_img">
		<div class="case-year">
			<h5 class="tit">2014年</h5>
			<?php query_posts("year=2014&cat=-124,-188&"); ?>
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
			</ul>
		</div>
		<div class="case-year">
			<h5 class="tit">2013年</h5>
			<?php query_posts("year=2013&cat=-124,-188&"); ?>
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
			</ul>
		</div>
		<div class="case-year">
			<h5 class="tit">2012年</h5>
			<?php query_posts("year=2012&cat=-124,-118"); ?>
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
			</ul>
		</div>
		<div class="case-year">
			<h5 class="tit">2011年及以前</h5>
			<?php query_posts("year=2011&cat=-124,-118"); ?>
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
			</ul>
		</div>
	</div>
</section>
<?php get_footer(); ?>
