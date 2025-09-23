<section class="fn-clear main">
	<?php if(have_posts()) : ?>
		<?php while(have_posts()) : the_post(); ?>
			<article class="post fn-clear">
				<div class="title">
					<i href="<?php the_permalink(); ?>" class="time" title="<?php the_time('Y年m月d日（D）H时i分s秒') ?>">
							<?php echo date('F',get_the_time('U')).' '.get_the_time('jS  Y');
							//get_the_time('U') 获得文章日期时间戳
							//用 php 内置 date 函数重新输出月份
							?>
					</i>
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?> By.澈言"><?php the_title(); ?></a><br>
						<b class="edit"><?php edit_post_link('Edit', '', ''); ?></b>
					</h2>
				</div>
				<div class="con">
					<div>
						<?php the_content('',false,'') ?>
					</div>
					<div class="info">
						<p> 
							Tags&nbsp;:&nbsp;<?php the_tags('','&nbsp;/&nbsp;',''); ?><br>Category&nbsp;:&nbsp;<?php the_category('&nbsp;/&nbsp;') ?>
							<?php /*?><a class="moreLink btn" href="<?php the_permalink() ?>">阅读全文&gt;&gt;</a><?php */?>
						</p>
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
		<?php posts_nav_link(' &#183; ', '以后','以前'); ?>
	</div>
</section>