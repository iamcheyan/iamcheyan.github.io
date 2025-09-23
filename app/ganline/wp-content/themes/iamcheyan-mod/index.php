<?php get_header(); ?>
		<section class="fn-clear main in-index">
			<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>
					<article class="post fn-clear">
						<div class="title">
							<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?> By.澈言"><?php the_title(); ?></a><br>
								<b class="edit"><?php edit_post_link('Edit', '', ''); ?></b>
							</h2>
						</div>
						<div class="con">
							<div class="post_content">
								<?php if (has_excerpt())
									{ ?>
									<div> 
										<?php the_excerpt() ?>
										<a href="<?php the_permalink(); ?>">阅读全文</a>
									</div>
								<?php 
									}
									else{
										the_content('阅读全文');
									}
								?>
							</div>
							
							<div class="info">
								<div> 
									标签&nbsp;:&nbsp;<?php the_tags('','&nbsp;/&nbsp;',''); ?>
								</div>
								<div href="<?php the_permalink(); ?>" class="time" title="<?php the_time('Y年m月d日（D）H时i分s秒') ?>">
										日期&nbsp;:&nbsp;<?php echo the_time('Y年m月d日') ?>
								</div>
							</div>
							<p class="comment-num">
								<?php /*?><?php echo get_comments_number(); ?><?php */?>
								<?php comments_popup_link(); ?>
								<?php /*?><?php edit_post_link('EDIT', '&nbsp;&nbsp;|&nbsp;&nbsp;', ''); ?><?php */?>
							</p>
						</div>
					</article>
					<?php endwhile; ?>
					<?php else : ?>
					<article>
						<h2>
						<?php _e('Not Found'); ?>
						</h2>
					</article>
				<?php endif; ?>
				<?php comments_template(); ?>
			<div class="page">
				<?php posts_nav_link(' &#183 ', '以后','以前'); ?>
			</div>
		</section>
		<div class="link_list">
			<div class="link_content">
				<?php  wp_list_bookmarks(array(
						'title_before' => '<h2 class="title">',
						'title_after' => '</h2>',
						'category_before' => '',
						'category_after' => '',
					)); 
				?>
			</div>
		</div>

<?php get_footer(); ?>