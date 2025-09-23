<?php
/* Category Archives */
global $options;
foreach ($options as $value) {
	if(isset($value['id']) && isset ($value['std']))
		if (get_option( $value['id'] ) === FALSE) {
			$$value['id'] = $value['std']; 
		} else {
		$$value['id'] = get_option( $value['id'] );
	}
}
?>
<?php get_header();?>

<?php if ( have_posts() ) : ?>

	<?php wp_pagenavi();?><!--PageNavi-->			
    
	<?php while ( have_posts() ) : the_post();  ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; ?>
    
	<?php wp_pagenavi();?><!--PageNavi-->

<?php else : ?>

	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h2 class="entry-title"><?php _e( 'Nothing Found', 'misa' ); ?></h2>
		</header><!-- .entry-header -->

	<div class="entry-content">
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'misa' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- .entry-content -->
    
</article><!-- #post-0 -->

<?php endif; //End Loop?>

</div><!-- .content -->  
          
<?php
	$sidebar_opts = '';
    if ( is_page() ) {
		$page_opts = get_post_meta( $post->ID, 'page_options', true );
		$sidebar_opts = $page_opts['sidebar_opts'];
    }
    if ( ( $sidebar_opts == 'right' ) && ( !( $sidebar_opts == 'left' || $sidebar_opts == 'none' ) ) ){
		get_sidebar();
    }
    elseif ( ( $misa_sidebar == 'right' ) && ( !( $sidebar_opts == 'left' || $sidebar_opts == 'none' ) ) ) {
		get_sidebar();
    } ?>
    </div><!-- .primary_wrap --> 
</div><!-- .primary --> 
   
<?php get_footer(); ?>