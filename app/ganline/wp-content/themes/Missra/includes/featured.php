    <?php
    if( !( $misa_hide_slider == 'true' ) ):
		if( is_home() || is_front_page() ):?>   
            <div class="featured">
                <div class="slider_wrap">
                    <div class="cycle_wrapper">
						<?php
                        $misa_feat_cat_id = empty($misa_feat_cat_id) ? '1' : $misa_feat_cat_id ;
                        $slide_args = array( 'showposts' => $misa_num_of_slides, 'cat'=> $misa_feat_cat_id, 'order' => $misa_feat_order );
                        $temp = $post;
                        $blogdir = get_template_directory_uri();
                        global $post;
                        $slideshow_query = new WP_Query($slide_args); ?> 
                        <ul class="cycle_slider"><?php 
                            if( $slideshow_query->have_posts() ):
								while ($slideshow_query->have_posts()): $slideshow_query->the_post();
									$post_opts = get_post_meta( $post->ID, 'post_options', true);
									$default_thumb = $bloginfo.'/images/post_thumb_small.png';
									$img = (isset($post_opts['thumb'])) ? $post_opts['thumb'] : $default_thumb;
									$caption = (isset($post_opts['caption'])) ? $post_opts['caption'] : '';
									$hide_caption = (isset($post_opts['hide_caption'])) ? $post_opts['hide_caption'] : '';
									$img_link = (isset($post_opts['img_link'])) ? $post_opts['img_link'] : '';
									$no_link = (isset($post_opts['no_link'])) ? $post_opts['no_link'] : '';								
									$title = get_the_title(); 
									$perma = get_permalink();?>
                                    <li><?php if($img):
									if( $no_link != 'true' ) { // If image links enabled ?>									
                                        <a href="<?php if($img_link) echo $img_link; else the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank"><img class="slide_img" src="<?php echo $dir; ?>/scripts/timthumb.php?src=<?php echo $img; ?>&amp;w=620&amp;h=<?php echo $misa_sl_ht; ?>&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>"/></a>                                    
                                    <?php } 
									else { // If image links disabled ?>									
                                        <img class="slide_img" src="<?php echo $dir; ?>/scripts/timthumb.php?src=<?php echo $img; ?>&amp;w=960&amp;h=<?php echo $misa_sl_ht; ?>&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>"/>									
									<?php }
									if( $hide_caption != 'true' ) { ?>
									<div class="show_desc">
									<?php if( $caption != '')
										echo $caption;
									else ?> 
									<a href="<?php the_permalink();?>" target="_blank"><?php the_title(); ?> </a>
									</div>                                
									<?php }								
									endif; //img ?>
									</li>
								<?php endwhile; 
                            endif;
                            $post = $temp;
                            wp_reset_query();
                            ?>                    
                        </ul><!-- .cycle_slider -->
                        
                        <div class="controls">
                            <a class="prev-sld" href="#" title="<?php _e( 'Previous Post', 'misa' ) ?>"></a>
                            <a class="next-sld" href="#" title="<?php _e( 'Next Post', 'misa' ) ?>"></a>
                        </div><!-- .controls -->
                        
                        <ul class="cycle_nav"></ul>
                        
                    </div><!-- .cycle_wrapper -->


					<div class="sticky-posts">
                    	<h5><?php _e( 'Sticky Posts', 'misa' ) ?></h5>
						<ul>
						<?php
							$sticky = get_option('sticky_posts');
							rsort( $sticky );
							$sticky = array_slice( $sticky, 0, 4);
							query_posts( array(
											   'post__in' => $sticky, 
											   'posts_per_page' => 4, 
											   'caller_get_posts' => 1
											   ) );
						if (have_posts()) : while (have_posts()) : the_post();
							$time = get_the_time('Y-m-d');
							$categories_list = get_the_category_list( __( ', ', 'misa' ) );
							$permalink = get_permalink();
							$title = get_the_title();
							$bloginfo = get_template_directory_uri();
							$post_opts = get_post_meta( $GLOBALS['post']->ID, 'post_options', true);
							$thumbnail = $post_opts['thumb'];					
							$default_thumb = $bloginfo.'/images/post_thumb_small.png';
							$thumbnail = ( $thumbnail == '' ) ? $default_thumb : $thumbnail;
							if($thumbnail ) {
								$thumblink = sprintf('<a class="recent-post-thumb" href="%1$s" rel="bookmark" title="' . __( '%2$s' ) . '"><img class="small_thumb" src="%3$s/scripts/timthumb.php?src=%4$s&amp;w=54&amp;h=54&amp;zc=1&amp;q=100" alt="%2$s"/></a>',$permalink, $title, $bloginfo, $thumbnail, $time);
						}
							else $thumblink = '';					
								$format = '<li>%1$s<a href="%2$s" rel="bookmark" title="' . __( '%3$s' ) . '">%3$s</a><br/>
									<span class="sticky-post-meta">%4$s %5$s</span>
								</li>';
								$output.= sprintf( $format, $thumblink, $permalink, $title, $time, $categories_list );  
                		endwhile; 
                			$output .= '</ul>';
							echo $output;
						endif;				
						?>
				</div>


                </div><!-- .slider_wrap -->
            </div><!-- .featured -->
            <?php 
		endif; // If on Home
    endif; // If not Hide Slider ?>    
    <?php if( is_page() && (!is_home() && !is_front_page()) ){
		$page_opts = get_post_meta( $posts[0]->ID, 'page_options', true );
		$custom_caption = (isset($page_opts['custom_caption'])) ? $page_opts['custom_caption'] : '';
		$cust_embed = (isset($page_opts['cust_embed'])) ? $page_opts['cust_embed'] : '';
		$hide_feat = (isset($page_opts['hide_feat'])) ? $page_opts['hide_feat'] : '';
		if( !$hide_feat ) {	
	?>   
    <div class="featured">
        <div class="featured_wrap clearfix <?php if ( $cust_embed ) echo ( 'custom_embed' ); ?>">
		<?php
        if( $cust_embed ) { // Custom Page Header or Flash Embed
		echo stripslashes( $cust_embed );
		}
		else {		
		?>
            <div class="page-title">
                <h3><?php if( $custom_caption ) echo( $custom_caption ); else misa_page_title(); ?></h3>
            </div>
            <div class="feat_widget_area">
				<?php 
                $unique_feat_bar = (isset($page_opts['unique_feat_bar'])) ? $page_opts['unique_feat_bar'] : '';
                if ( $unique_feat_bar )
                {
                    if ( is_active_sidebar( $posts[0]->ID.'-feat-bar') ) :
                        dynamic_sidebar( $posts[0]->ID.'-feat-bar' );
                    endif;
                }
                else
                {			
                    if ( is_active_sidebar( 'default-feat-bar' ) ) :
                        dynamic_sidebar( 'default-feat-bar' ); 
                    endif; 
                }?> 
            </div><!-- .feat_widget_area -->
            <?php } // Not Custom embed ?>
            </div><!-- .featured_wrap -->
    </div><!-- .featured -->
    <?php } // Hide Featured
	} // Featured Area
	
	elseif(!is_home() && !is_front_page()) { // Normal Pages like single, search, archives ?>
        <div class="featured">
            <div class="featured_wrap clearfix">
                <div class="breadcrumbs">
                    <h3><?php if(!is_attachment()){
							misa_breadcrumbs();}
							else{ misa_page_title(); }
						?>
					</h3>
                </div>
                <div class="feat_widget_area">
					<?php
                    if ( is_active_sidebar( 'default-feat-bar' ) ) :
                    dynamic_sidebar( 'default-feat-bar' ); 
                    endif; 
                    ?> 
                </div><!-- .feat_widget_area -->
            </div><!-- .featured_wrap -->
        </div><!-- .featured -->
	<?php } ?>