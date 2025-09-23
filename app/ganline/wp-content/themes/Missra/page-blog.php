<?php
/*
Template Name: Blog Page
*/

/* Fetch Theme Admin Options */
global $options;
foreach ($options as $value) {
if(isset($value['id']) && isset ($value['std']))
if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] );}
}
get_header();
if (is_page() ) {
	$page_opts = get_post_meta( $post->ID, 'page_options', true );
	$category = $page_opts['category'];				
	$post_per_page = $page_opts['post_per_page'];	
	$post_per_page = empty($post_per_page) ? '6' : $post_per_page;
} 
if ($category) {
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} 
	elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} 
	else {
		$paged = 1;
	}
	$do_not_show_stickies = 1; // 0 to show stickies
	$args=array(
		'cat' => $category,
		'orderby' => 'date',
		'order' => 'desc',
		'paged' => $paged,
		'posts_per_page' => $post_per_page,
		'ignore_sticky_posts' => 1
	);
	$temp = $wp_query;  // Assign orginal query to temp variable for later use
	$wp_query = new WP_Query($args);
	if( have_posts() ) : 
		while ($wp_query->have_posts()) : $wp_query->the_post();
			$post_opts = get_post_meta( $post->ID, 'post_options', true );
			$img = (isset($post_opts['thumb'])) ? $post_opts['thumb'] : '' ;	
			?>
			<div id="post-<?php the_ID();?>" <?php post_class('entry clearfix'); ?> >
            	<div class="entry-header">  
					<?php if ( is_sticky() ) : ?>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'misa' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<h3 class="featured-post"><?php _e( 'Featured', 'misa' ); ?></h3>            
            		<?php else : ?>            
            		<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'misa' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<?php endif; //end sticky?>                        
            		<div class="entry-meta"><?php misa_header_meta(); ?></div>	
                </div>
                <div class="entry-content">		
					<?php
						$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
						if ( $images ) :
							$image = array_shift( $images );
							$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
					?>
					<div class="blog-page-thumb foldify">
						<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
					</div>
					<?php endif; ?>           
					<?php preg_replace("/<img[^>]+>/i", "", $content); ?>
					<?php the_content( __( 'Read More &rarr;', 'misa' ), 'false' ); wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'misa' ), 'after' => '</div>' ) );?>
                 </div>  
				<div class="footer-meta">
					<span class="tags"><?php _e( 'Tag:', 'misa' ); ?> <?php the_tags( '', ', ', ' ' ) ?></span>
					<span><?php _e( 'Permalink:', 'misa' ); ?></span><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" class="permalink"><?php the_title(); ?></a>                        
				</div>
            </div><!-- .entry -->
		<?php endwhile; // End the content			
		if ( $wp_query->max_num_pages > 1 ) :?>
			<?php if ( function_exists( 'wp_pagenavi' ) ) wp_pagenavi();
            else {?>
                <div class="pagination">				
                    <div class="prev"><?php next_posts_link( __( '&larr; Older Posts', 'misa' ) ) ?></div>
                    <div class="next"><?php previous_posts_link( __( 'Newer Posts &rarr;', 'misa' ) ) ?></div>
                </div>			
            <?php }  
        endif;
        else : ?>
            <h2 class="entry-title"><?php _e( 'Not Found', 'misa' ); ?></h2>
            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'misa' ); ?></p>
            <?php get_search_form();
		endif;
	$wp_query = $temp;  //reset back to original query
}  // if ($category) ?>
</div><!-- .content -->            
	<?php
	$sidebar_opts = '';
    if ( is_page() ) {
		$page_opts = get_post_meta( $post->ID, 'page_options', true );
		$sidebar_opts = (isset($page_opts['sidebar_opts'])) ? $page_opts['sidebar_opts'] : '';
    }
    if ( ( $sidebar_opts == 'right' ) && ( !( $sidebar_opts == 'left' || $sidebar_opts == 'none' ) ) ){
		get_sidebar();
    }
    elseif ( ( $misa_sidebar == 'right' ) && ( !( $sidebar_opts == 'left' || $sidebar_opts == 'none' ) ) ) {
		get_sidebar();
    }?>
    </div><!-- .primary_wrap --> 
</div><!-- .primary -->     
<?php get_footer(); ?>