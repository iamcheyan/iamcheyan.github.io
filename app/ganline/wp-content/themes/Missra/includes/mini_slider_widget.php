<?php 
/* Mini slide show of post thumbnails. */

class Misa_Mini_Slider extends WP_Widget {
	function Misa_Mini_Slider() {
		$widget_ops = array( 'classname' => 'misa_mini_slider', 'description' => __( 'Mini slide show of post thumbnails.', 'misa') );
		$this->WP_Widget('misa-mini-slider', __( 'Misa Mini Slider', 'misa' ), $widget_ops);
	}
	
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);		
		$cats = empty( $instance['cats'] ) ? '' : $instance['cats'];
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 10 )
			$number = 10;
			
		if ( !$speed = (int) $instance['speed'] )
			$speed = 600;
		else if ( $speed < 1 )
			$speed = 600;
			
		if ( !$timeout = (int) $instance['timeout'] )
			$timeout = 4000;
		else if ( $timeout < 1 )
			$timeout = 4000;			
		$text = '';				
		$text = $instance['text'];
		$sliderID = empty( $instance['sliderID'] ) ? '' : $instance['sliderID'];
		$fx = $instance['fx'];
		$my_query = new WP_Query( array ( 'showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'cat' => $cats ) );
		if ($my_query->have_posts()) : ?>
			<?php echo $before_widget; ?>
            <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <script type="text/javascript">
			var $s = jQuery.noConflict();
			$s(window).load(function(){
				$s('#<?php echo $sliderID; ?>').cycle({	
					fx: '<?php echo $fx; ?>',
					speed: <?php echo $speed; ?>, 
					timeout: <?php echo $timeout; ?>,
					sync:1,
					pause:1,
					next: '#<?php echo $sliderID.'-next'; ?>',
					prev: '#<?php echo $sliderID.'-prev'; ?>'		
				})	
			}) 
        </script>            
            <?php echo $text; ?>
            <div class="widgetslider">
                <ul id="<?php echo $sliderID; ?>" class="wslides">
                <?php  while ($my_query->have_posts()) : $my_query->the_post(); 
					$bloginfo = get_template_directory_uri();
					$post_opts = get_post_meta( $GLOBALS['post']->ID, 'post_options', true);
					$thumbnail = $post_opts['thumb'];
					$default_thumb = $bloginfo.'/images/post_thumb.png';
					$thumbnail = ( $thumbnail == '' ) ? $default_thumb : $thumbnail;
				?>
                    <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'misa' ), the_title_attribute( 'echo=0' ) ); ?>" target="_blank"><img src="<?php echo $bloginfo; ?>/scripts/timthumb.php?src=<?php echo $thumbnail; ?>&amp;w=270&amp;h=190&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>"/></a></li>
                <?php endwhile; ?> 
                </ul>
            </div><!-- .widgetslider --> 
            <div class="slider-controls">
            	<a class="sliderprev" href="#" id="<?php echo $sliderID.'-prev'; ?>"></a>
            	<a class="slidernext" href="#" id="<?php echo $sliderID.'-next'; ?>"></a>
			</div>            
            <?php 
			echo $after_widget;
			wp_reset_query();  // Restore global post data stomped by the_post()
			endif;			
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( in_array( $new_instance['fx'], array( 'fade', 'scrollLeft', 'scrollRight', 'scrollUp', 'scrollDown', 'slideX', 'slideY' ) ) ) {
			$instance['fx'] = $new_instance['fx'];
		} else {
			$instance['fx'] = 'fade';
		}
		$instance['cats'] = strip_tags( $new_instance['cats'] );
		$instance['sliderID'] = strip_tags( $new_instance['sliderID'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['speed'] = (int) $new_instance['speed'];
		$instance['timeout'] = (int) $new_instance['timeout'];
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( $new_instance['text'] ); 
		return $instance;
	}
	
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'cats' => '', 'sliderID' => '', 'fx' => 'fade', 'text' => '' ) );
		$title = esc_attr( $instance['title'] );
		$cats = esc_attr( $instance['cats'] );
		$sliderID = esc_attr( $instance['sliderID'] ); 
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
		if ( !isset($instance['speed']) || !$speed = (int) $instance['speed'] )
			$speed = 600;
		if ( !isset($instance['timeout']) || !$timeout = (int) $instance['timeout'] )
			$timeout = 4000;			
		$text = format_to_edit($instance['text']);			
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'misa' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p><label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e( 'Category to fetch slides:', 'misa' ); ?></label> 
		<input type="text" value="<?php echo $cats; ?>" name="<?php echo $this->get_field_name('cats'); ?>" id="<?php echo $this->get_field_id('cats'); ?>" class="widefat" /><br />
		<small><?php _e( 'Category IDs to load images from. Eg: 1,3,5', 'misa' ); ?></small>
		</p>
		<p><label for="<?php echo $this->get_field_id('sliderID'); ?>"><?php _e( 'Unique ID name for slider:', 'misa' ); ?></label> 
		<input type="text" value="<?php echo $sliderID; ?>" name="<?php echo $this->get_field_name('sliderID'); ?>" id="<?php echo $this->get_field_id('sliderID'); ?>" class="widefat" /><br />
		<small><?php _e( 'Enter a unique ID name. Eg: myslider, slider2, myclients etc. Unique IDs are used to avoid any conflict if this widget is used multiple times on same page.', 'misa' ); ?></small>
		</p>
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of slides to show:', 'misa' ); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e( '(at most 10)', 'misa' ); ?></small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('fx'); ?>"><?php _e( 'Effect:', 'misa' ); ?></label>
            <select name="<?php echo $this->get_field_name('fx'); ?>" id="<?php echo $this->get_field_id('fx'); ?>" class="widefat">
            <option value="fade"<?php selected( $instance['fx'], 'fade' ); ?>><?php _e('Fade', 'misa'); ?></option>
            <option value="scrollLeft"<?php selected( $instance['fx'], 'scrollLeft' ); ?>><?php _e('Scroll Left', 'misa'); ?></option>
            <option value="scrollRight"<?php selected( $instance['fx'], 'scrollRight' ); ?>><?php _e('Scroll Right', 'misa'); ?></option>
            <option value="scrollUp"<?php selected( $instance['fx'], 'scrollUp' ); ?>><?php _e('Scroll Up', 'misa'); ?></option>
            <option value="scrollDown"<?php selected( $instance['fx'], 'scrollDown' ); ?>><?php _e('Scroll Down', 'misa'); ?></option>            <option value="slideX"<?php selected( $instance['fx'], 'slideX' ); ?>><?php _e('Slide X', 'misa'); ?></option>
            <option value="slideY"<?php selected( $instance['fx'], 'slideY' ); ?>><?php _e('Slide Y', 'misa'); ?></option>
            </select>
        </p><br/>
		<p><label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e( 'Speed:', 'misa' ); ?></label>
		<input id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo $speed; ?>" /><br />
		<small><?php _e( '(in miliseconds)', 'misa' ); ?></small>
        </p>
		<p><label for="<?php echo $this->get_field_id('timeout'); ?>"><?php _e( 'Timeout:', 'misa' ); ?></label>
		<input id="<?php echo $this->get_field_id('timeout'); ?>" name="<?php echo $this->get_field_name('timeout'); ?>" type="text" value="<?php echo $timeout; ?>" /><br />
		<small><?php _e( '(in miliseconds)', 'misa' ); ?></small>
        </p>
		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e( 'Text to appear before slider:', 'misa' ); ?></label>
        <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea><br />
		<small><?php _e( 'You can use basic HTML here.', 'misa' ); ?></small>
        </p><br/>
	<?php }
}?>