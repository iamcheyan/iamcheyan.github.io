<section class="fn-clear main">
	<?php if(have_posts()) : ?>
		<?php while(have_posts()) : the_post(); ?>
			<article class="post">
				<div class="title">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?> By.澈言"><?php the_title(); ?></a><br>
						<b class="edit"><?php edit_post_link('Edit', '', ''); ?></b>
					</h2>
				</div>
				<div class="con">
					<div class="post_content">
						<?php the_content('',false,'') ?>
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
			<div>
				<h2>
				<?php _e('Not Found'); ?>
				</h2>
			</div>
		<?php endif; ?>
	<?php comments_template(); ?> 
	<div class="page">
		<?php posts_nav_link(' &#183 ', '以后','以前'); ?>
	</div>
</section>