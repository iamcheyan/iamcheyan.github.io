<?php
/* The Content */
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
<?php 
	$post_opts = get_post_meta( $post->ID, 'post_options', true );
	$bloginfo = get_template_directory_uri();
	$thumbnail = $post_opts['thumb'];					
	$default_thumb = $bloginfo.'/images/post_thumb.png';
	$thumbnail = ( $thumbnail == '' ) ? $default_thumb : $thumbnail;
?>
        <article id="post-<?php the_ID();?>" <?php post_class('entry clearfix'); ?> >
            <header class="entry-header">           
            <?php if ( is_sticky() ) : ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'misa' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<h3 class="featured-post"><?php _e( 'Featured', 'misa' ); ?></h3>            
            <?php else : ?>            
            	<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'misa' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php endif; //end sticky?>
            
			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php misa_header_meta(); ?>
				</div>
			<?php endif; ?> 
                       
			</header><!-- header-meta --> 
            
		<?php if ( is_search() ) : ?>
			<div class="entry-summary"><?php the_excerpt(); ?></div><!-- .entry-summary -->
		<?php else : ?>                                
		<div class="entry-content">
        	<?php //include('includes/post-thumb.php'); ?>
			<?php the_content( __( 'Continue reading &rarr;', 'misa' ), 'false' ); ?>
            <?php wp_link_pages(array('before' => '<div class="page-link"><em>' . __( 'Pages:', 'misa' ) . '</em>', 'after' => '</div>', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>', )); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-footer">
        	<div class="entry-meta">
				<?php misa_footer_meta(); ?>
            </div>
		</footer>
</article><!-- #post-<?php the_ID(); ?> -->