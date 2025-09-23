<?php 
/* List popular posts based on most number of comments */

class Misa_Popular_Posts extends WP_Widget {
	function Misa_Popular_Posts() {
		$widget_ops = array( 'classname' => 'misa_popular_entries', 'description' => __( 'List popular posts based on most commented.', 'misa' ) );
		$this->WP_Widget('misa-popular-posts', __( 'Misa Popular Posts', 'misa' ), $widget_ops);
		$this->alt_option_name = 'misa_popular_entries';		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}	
	function widget($args, $instance) {
		$cache = wp_cache_get('widget_popular_posts', 'widget');	
		$hide_thumb= isset($instance['hide_thumb']) ? $instance['hide_thumb'] : false;	
		if ( !is_array($cache) )
			$cache = array();		
		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}	
		ob_start();
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Popular', 'misa' ) : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		$t = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'orderby' => 'comment_count'));
		if ($t->have_posts()) :
			$output = '';
			echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title; 
			$list_class = ( $hide_thumb == false ) ? 'popular-post-list' : 'bullet-list';
			?>
            <ul class="<?php echo $list_class; ?>">
				<?php  while ($t->have_posts()) : $t->the_post();
					$time = get_the_time('Y-m-d');
					$categories_list = get_the_category_list( __( ', ', 'misa' ) );
					$permalink = get_permalink();
					$title = get_the_title();
					$bloginfo = get_template_directory_uri();
					$post_opts = get_post_meta( $GLOBALS['post']->ID, 'post_options', true);
					$thumbnail = $post_opts['thumb'];
					$default_thumb = $bloginfo.'/images/post_thumb_small.png';
					$thumbnail = ( $thumbnail == '' ) ? $default_thumb : $thumbnail;
					if( $hide_thumb == false ) {
						$thumblink = sprintf('<a class="popular-post-thumb" href="%1$s" rel="bookmark" title="' . __( '%2$s' ) . '" target="_blank"><img class="small_thumb" src="%3$s/scripts/timthumb.php?src=%4$s&amp;w=54&amp;h=54&amp;zc=1&amp;q=100" alt="%2$s"/></a>',$permalink, $title, $bloginfo, $thumbnail, $time);
						}
						else $thumblink = '';					
					$format = '<li>%1$s<a href="%2$s" rel="bookmark" title="' . __( '%3$s' ) . '" target="_blank">%3$s</a><br/>
								<div class="popular-post-meta">%4$s %5$s</div>
								</li>';
					$output.= sprintf( $format, $thumblink, $permalink, $title, $time, $categories_list);  
                endwhile; 
                $output .= '</ul>';
				echo $output;
            echo $after_widget; ?>
            <?php wp_reset_query();  // Restore global post data stomped by the_post().
		endif;		
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_add('widget_popular_posts', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['hide_thumb'] = isset($new_instance['hide_thumb']) ? true : false;
		$this->flush_widget_cache();		
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['misa_popular_entries']) )
		delete_option('misa_popular_entries');		
		return $instance;
	}
	
	function flush_widget_cache() {
		wp_cache_delete('widget_popular_posts', 'widget');
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'hide_thumb' => false, 'cats' => '') );
		$title = esc_attr( $instance['title'] );
		$cats = esc_attr( $instance['cats'] );	
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5; ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'misa' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to show:', 'misa' ); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e( '(at most 15)', 'misa' ); ?></small>
        </p>
		<p><label for="<?php echo $this->get_field_id( 'hide_thumb' ); ?>"><?php _e( 'Hide Thumbnails?', 'misa' ); ?></label>
        <input class="checkbox" type="checkbox" <?php checked($instance['hide_thumb'], true) ?> id="<?php echo $this->get_field_id('hide_thumb'); ?>" name="<?php echo $this->get_field_name( 'hide_thumb' ); ?>" /><br />
        <small><?php _e( 'If unchecked, it will show post thumbnails.', 'misa' ); ?></small>
        </p>                
	<?php }
}?>