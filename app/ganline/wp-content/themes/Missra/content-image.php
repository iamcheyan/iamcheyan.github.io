<?php
/**
 * The template for displaying posts in the Image Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Missra
 * @since Missra 1.0
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'misa' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<h3 class="entry-format"><?php _e( 'Image', 'misa' ); ?></h3>
        	<div class="entry-meta">
				<?php misa_header_meta(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content( __( 'Continue reading &rarr;', 'misa' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'misa' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<div class="entry-meta">
				<?php misa_footer_meta(); ?>
			</div>
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
