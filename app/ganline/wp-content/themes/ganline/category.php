<?php get_header(); ?>
<section class="case-page">
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
	<div class="content case-list fn-ov">
		<ul class="fn-clear fn-grid-3">
			<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>
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
						<p><?php the_tags('','&nbsp;/&nbsp;',''); ?></p>
					</li>
					<?php endwhile; ?>
					<?php else : ?>
					<div>
						<h2>
						<?php _e('Not Found'); ?>
						</h2>
					</div>
				<?php endif; ?>
			<?php comments_template(); ?> 
		</ul>
		<div class="page">
			<?php posts_nav_link(' &#183; ', '以后','以前'); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
