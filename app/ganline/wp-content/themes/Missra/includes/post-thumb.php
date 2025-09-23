			<div class="blog-post foldify">
				<?php if ( $thumbnail ) { ?>
				<a rel="prettyPhoto[image]" href="<?php echo $thumbnail; ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/scripts/timthumb.php?src=<?php echo $thumbnail; ?>&amp;w=210&amp;h=150&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
				</a>
				<?php } ?>
			</div>