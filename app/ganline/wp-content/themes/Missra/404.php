<?php
/* 404 - Not Found Template */

get_header(); ?>
		<div id="post-0" class="post error404 not-found">
			<h2><?php _e( 'Not Found!', 'misa' ); ?></h2>
			<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'misa' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .post-0 -->
	</div><!-- .content -->
	</div><!-- .primary_wrap --> 
</div><!-- .primary -->     
<?php get_footer(); ?>