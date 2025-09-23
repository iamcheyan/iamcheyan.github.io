<div class="mod">
<?php 	
	$cat_args=array(
	'exclude' => get_option('misa_exclude_cats'), //Home Category IDs to exclude
	'orderby' => 'ID', // ordered by category id - options - ID, name, slug, count, term_group
	'order' => 'ASC' // order ascending
	 );
	$categories=get_categories($cat_args);
	foreach($categories as $category) {
	echo '<div class="mod-wrap">'; 
	?>
	<?php $args=array(
		'showposts' => 1, // number of posts to display
		'category__in' => array($category->term_id),
		'ignore_sticky_posts'=>1, // number of sticky posts to ignore in the listing		
		);
	$posts=get_posts($args);
	if ($posts) {		
		echo '<div class="item-caption">
					<h5><a class="item-parent-cat" href="' . get_category_link( $category->term_id ) .'"  title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . ' target="_blank" >' . $category->name.'</a>'.get_cats_children($category->term_id).'</h5>
				<div class="layout-meta">
					<em>'. __( 'Post Counts:', 'misa' ).''.get_category($category->term_id)->count.'</em>
					<a href="' . get_category_link( $category->term_id ) . '/feed" title="' . sprintf( __( "RSS in %s" ), $category->name ) . '" ' . ' target="_blank" >' . __( 'RSS', 'misa' ).'</a>
					<a href="' . get_category_link( $category->term_id ) .'"  title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . ' target="_blank" > '. __( 'More Post', 'misa' ).'</a>
				</div>					
			</div>
		<div class="preview-post">';		
	foreach($posts as $post) {
		setup_postdata($post); 		
		$post_opts = get_post_meta( $post->ID, 'post_options', true );
		$bloginfo = get_template_directory_uri();
		$thumbnail = $post_opts['thumb'];					
		$default_thumb = $bloginfo.'/images/post_thumb.png';
		$thumbnail = ( $thumbnail == '' ) ? $default_thumb : $thumbnail;		
	?>
		<?php if ( $thumbnail ) { ?>
			<div class="preview-post-img foldify"><a href="<?php the_permalink(); ?>" target="_blank">
				<img src="<?php echo get_template_directory_uri(); ?>/scripts/timthumb.php?src=<?php echo $thumbnail; ?>&amp;w=140&amp;h=100&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/></a>
			</div>
		<?php } ?> 
			<h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" target="_blank"><?php the_title(); ?></a></h5>
			<div class="entry-meta"><?php misa_header_meta(); ?></div>
			<?php //echo short( get_the_excerpt(), 200 ); ?>
			<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 73,"..."); ?>
			<a href="<?php the_permalink(); ?>" class="read-more" rel="bookmark" title="<?php the_title_attribute(); ?>" target="_blank"><?php _e( 'Read More &rarr;', 'misa' ); ?></a>
		<?php 
		  } echo '</div>';
		  } ?><!-- .preview-post -->

<?php $args=array(
		'showposts' => 1, // number of posts to display
		'category__in' => array($category->term_id),
		'orderby' => rand,
		);
	$posts=get_posts($args);
	if ($posts) {		
		echo '<div class="random-post">';		
	foreach($posts as $post) {
		setup_postdata($post); 		
		$post_opts = get_post_meta( $post->ID, 'post_options', true );
		$bloginfo = get_template_directory_uri();
		$thumbnail = $post_opts['thumb'];					
		$default_thumb = $bloginfo.'/images/post_thumb.png';
		$thumbnail = ( $thumbnail == '' ) ? $default_thumb : $thumbnail;		
	?>
	<?php if ( $thumbnail ) { ?>
            <a href="<?php the_permalink(); ?>" target="_blank">
				<img src="<?php echo get_template_directory_uri(); ?>/scripts/timthumb.php?src=<?php echo $thumbnail; ?>&amp;w=140&amp;h=100&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" title="<?php //the_title(); ?>"/>
			</a> 
		<?php } ?> 
            <div class="boxCaption">
				<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title_attribute(); ?></a></h5>
			</div>
		<?php 
		  } echo '</div>';
	} ?><!-- .random-post -->
 
	<div class="list-post">    
		<?php $args=array(
			'showposts' => 3, // number of posts to display
			'category__in' => array($category->term_id),
			'offset'=>1
			);
		$posts=get_posts($args);
		if ($posts) {
			echo '<ul class="list-post-left">';
		foreach($posts as $post) {
			setup_postdata($post); ?>							
        	<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" target="_blank"><?php the_title(); ?></a> <?php edit_post_link() ?>	<!--<span class="date"><?php //the_time('Y-m-d') ?></span>--></li>
			<?php 
		  	} echo '</ul>';
		  	} ?><!-- .list-post-left -->
          
 		<?php $args=array(
			'showposts' => 3, // number of posts to display
			'category__in' => array($category->term_id),
			'offset'=>4
			);
		$posts=get_posts($args);
		if ($posts) {
			echo '<ul class="list-post-right">';
		foreach($posts as $post) {
			setup_postdata($post); ?>							
        	<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" target="_blank"><?php the_title(); ?></a> <?php edit_post_link() ?>	<!--<span class="date"><?php //the_time('Y-m-d') ?></span>--></li>
		  	<?php 
} echo '</ul>';
		  	} ?><!-- .list-post-right -->         
	</div><!-- .list-post -->
          				
	<?php	
	echo '</div>';// .mod-wrap		
	} 
?>

</div><!--  .mod  -->