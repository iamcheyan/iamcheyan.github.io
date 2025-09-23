<div class="content fn-ov">
	<div class="blog_list">
		<div class="blog_li">
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
				<?php the_content('',false,'') ?>
			</div>
		</div>
		<?php comments_template(); ?> 
	</div>
	<div class="page">
		<?php posts_nav_link(' &#183; ', '以后','以前'); ?>
	</div>
</div>
