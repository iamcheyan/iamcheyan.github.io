<?php
/* Functions and definitions */

/* 
*Load custom functions, widgets and options from various files.
*/ 
include_once('admin/theme_admin_options.php');
include_once('includes/init_custom_widgets.php');
include_once('includes/post_options.php');
include_once('includes/page_options.php');
include_once('includes/cats_widget.php');
include_once('includes/recent_posts_widget.php');
include_once('includes/mini_folio_widget.php');
include_once('includes/popular_posts_widget.php');
include_once('includes/recent_comments_widget.php');
include_once('includes/mini_slider_widget.php');
include_once('includes/content_slider_widget.php');
include_once('includes/shortcodes/shortcodes.php');
include_once('includes/shortcodes/visual_shortcodes.php');

if ( ! isset( $content_width ) )
	$content_width = 620;
/* Make theme available for translation */
load_theme_textdomain( 'misa', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );
	
/* Match Theme styles inside visual editor using editor-style.css */
add_editor_style();

/* Add default posts and comments RSS feed links to head */
add_theme_support( 'automatic-feed-links' );

/* Add support for post thumbnails */
add_theme_support( 'post-thumbnails' );	
	
/* Add support for wp_nav_menu() */
function register_my_menu() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'misa' ) );
	register_nav_menu( 'secondary', __( 'Secondary Menu', 'misa' ) );
}
add_action( 'init', 'register_my_menu' );	


/* Add support for custom backgrounds. */
add_theme_support( 'custom-background', array('default-color' => 'f1f1f1','default-image' => get_template_directory_uri() . '/images/bg.png',) );
	

/* Add support for a variety of post formats */
add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

/* Adds a rel="prettyPhoto" tag to all linked image files */
add_filter('the_content', 'prettyPhoto_replace');      
function prettyPhoto_replace ($content)      
{   global $post;      
    $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";      
    $replacement = '<a rel="prettyPhoto"$6  $1href=$2$3.$4$5 >$7</a>';      
    $content = preg_replace($pattern, $replacement, $content);  
	//if (!is_single() ){
	//	$content = preg_replace("/<img[^>]+>/i", "", $content);
	//	}
    return $content;      
}
	
/* Create and register Sidebar Widgets */
function misa_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Default Header Widget Area', 'misa' ),
		'id' => 'default-header-bar',
		'description' => __( 'The default header widget area', 'misa' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );

	register_sidebar( array(
		'name' => __( 'Default Featured Widget Area', 'misa' ),
		'id' => 'default-feat-bar',
		'description' => __( 'The default featured widget area', 'misa' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	) );

	register_sidebar( array(
		'name' => __( 'Default Sidebar', 'misa' ),
		'id' => 'default-sidebar',
		'description' => __( 'The default primary widget area', 'misa' ),
		'before_widget' => '<div class="widgetwrap">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );
	
	register_sidebar( array(
		'name' => __( 'Default Secondary Column 1', 'misa' ),
		'id' => 'secondary-column-1',
		'description' => __( 'First column of secondary widget area', 'misa' ),
		'before_widget' => '<div class="widgetwrap">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );	

	register_sidebar( array(
		'name' => __( 'Default Secondary Column 2', 'misa' ),
		'id' => 'secondary-column-2',
		'description' => __( 'Second column of secondary widget area', 'misa' ),
		'before_widget' => '<div class="widgetwrap">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );
	
	register_sidebar( array(
		'name' => __( 'Default Secondary Column 3', 'misa' ),
		'id' => 'secondary-column-3',
		'description' => __( 'Third column of secondary widget area', 'misa' ),
		'before_widget' => '<div class="widgetwrap">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );
	
	register_sidebar( array(
		'name' => __( 'Default Secondary Column 4', 'misa' ),
		'id' => 'secondary-column-4',
		'description' => __( 'Fourth column of secondary widget area', 'misa' ),
		'before_widget' => '<div class="widgetwrap">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );	

	$mypages = get_pages();
	$unique_header_bar = '';
	$unique_feat_bar = '';
	$unique_sidebar = '';
	$unique_secondarybar = '';
	
	foreach($mypages as $pp) {
		$page_opts = get_post_meta( $pp->ID, 'page_options', true );
		if (isset($page_opts['unique_header_bar']))
			$unique_header_bar = $page_opts['unique_header_bar'];
		if (isset($page_opts['unique_feat_bar']))
			$unique_feat_bar = $page_opts['unique_feat_bar'];	
		if (isset($page_opts['unique_sidebar']))
			$unique_sidebar = $page_opts['unique_sidebar'];	
		if (isset($page_opts['unique_secondarybar']))
			$unique_secondarybar = $page_opts['unique_secondarybar'];
		
		/* Register exclusive widget areas for each page */
		
		if ( $unique_header_bar ){
				register_sidebar( array(
					'name' => __( $pp->post_title.' Header Widget Area', 'misa' ),
					'id' => $pp->ID.'-header-bar',
					'description' => sprintf( esc_attr__( '%s header widget area', 'misa' ), $pp->post_title ),
					'before_widget' => '',
					'after_widget' => '',
					'before_title' => '',
					'after_title' => ''
				) );
		}		
		
		if ( $unique_feat_bar ){
				register_sidebar( array(
					'name' => __( $pp->post_title.' Featured Widget Area', 'misa' ),
					'id' => $pp->ID.'-feat-bar',
					'description' => sprintf( esc_attr__( '%s featured widget area', 'misa' ), $pp->post_title ),
					'before_widget' => '',
					'after_widget' => '',
					'before_title' => '',
					'after_title' => ''
				) );
		}		
		
		if ( $unique_sidebar ){
			register_sidebar( array(
				'name' => __( $pp->post_title.' Sidebar', 'misa' ),
				'id' => $pp->ID.'-sidebar',
				'description' => sprintf( esc_attr__( '%s Sidebar', 'misa' ), $pp->post_title ),
				'before_widget' => '<div class="widgetwrap">',
				'after_widget' => '</div>',
				'before_title' => '<h5>',
				'after_title' => '</h5>'
			) );
		}
		if ( $unique_secondarybar ){
			register_sidebar( array(
				'name' => __( $pp->post_title.' Secondary Column 1' ),
				'id' => $pp->ID.'-secondary-column-1',
				'description' => sprintf( esc_attr__( 'Secondary Column 1 of %s', 'misa' ), $pp->post_title ),
				'before_widget' => '<div class="widgetwrap">',
				'after_widget' => '</div>',
				'before_title' => '<h5>',
				'after_title' => '</h5>'
			) );	
		
			register_sidebar( array(
				'name' => __( $pp->post_title.' Secondary Column 2' ),
				'id' => $pp->ID.'-secondary-column-2',
				'description' => sprintf( esc_attr__( 'Secondary Column 2 of %s', 'misa' ), $pp->post_title ),
				'before_widget' => '<div class="widgetwrap">',
				'after_widget' => '</div>',
				'before_title' => '<h5>',
				'after_title' => '</h5>'
			) );
			
			register_sidebar( array(
				'name' => __( $pp->post_title.' Secondary Column 3' ),
				'id' => $pp->ID.'-secondary-column-3',
				'description' => sprintf( esc_attr__( 'Secondary Column 3 of %s', 'misa' ), $pp->post_title ),
				'before_widget' => '<div class="widgetwrap">',
				'after_widget' => '</div>',
				'before_title' => '<h5>',
				'after_title' => '</h5>'
			) );
			
			register_sidebar( array(
				'name' => __( $pp->post_title.' Secondary Column 4' ),
				'id' => $pp->ID.'-secondary-column-4',
				'description' => sprintf( esc_attr__( 'Secondary Column 4 of %s', 'misa' ), $pp->post_title ),
				'before_widget' => '<div class="widgetwrap">',
				'after_widget' => '</div>',
				'before_title' => '<h5>',
				'after_title' => '</h5>'
			) );			

		}
	}
}
add_action( 'widgets_init', 'misa_widgets_init' ); 


/* Show header meta information for posts */
function misa_header_meta() {          
	printf( 
			__( '<span class="date-link">%1$s</span> <span class="author-link">%2$s</span>', 'misa' ),	 
			
			sprintf( 
					__( '<span>Posted on</span><a href="%1$s" title="%2$s" rel="bookmark"> %3$s </a>' , 'misa'),
					
					get_permalink(),
					esc_attr( get_the_time() ),
					get_the_date('Y-m-d')
					),	
			sprintf( 
					__( '<span>Posted by</span><a href="%1$s" title="%2$s">%3$s</a>', 'misa' ), 
					get_author_posts_url( get_the_author_meta( 'ID' ) ), 
					sprintf( 
							esc_attr__( 'View all posts by %s', 'misa' ),
							get_the_author() 
							),
					get_the_author() 
					)
			);
	?>
	<span class="comments-link">
		<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'misa' ) . '</span>', __( '<b>1</b> Reply', 'misa' ), __( '<b>%</b> Replies', 'misa' ) ); ?>
	</span>
	<?php edit_post_link( __( 'Edit', 'misa' ), '<span class="edit-link">', '</span>' );
}

/* Show footer meta information for posts */
function misa_footer_meta() { 
	$categories_list = get_the_category_list( __( ', ', 'misa' ) );
	$tags_list = get_the_tag_list( '', __( ', ', 'misa' ) );
	printf(    
			__( '<span class="cats-link">%1$s</span><span class="tags-link">%2$s</span> ', 'misa' ),	 
			sprintf( __( '<span>Posted in</span> %2$s', 'misa' ), '', $categories_list ),
			sprintf( __( '<span>Tagged</span> %2$s', 'misa' ), '', $tags_list )
	   	);		 
}


//Category counts
function get_category_count($input = '',$type=0) {
global $wpdb;
 
	if($input == '' && $type == 0) {
		$category = get_the_category();
		return $category[0]->category_count;
	}
	elseif(is_numeric($input) && $type == 0) {
	$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->term_taxonomy WHERE  $wpdb->term_taxonomy.term_id=$input";
	return $wpdb->get_var($SQL);
	}
	elseif(!is_numeric($input) && $type == 0){
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
	return $wpdb->get_var($SQL);
	}elseif(is_numeric($input) && $type == 1){
$SQL = "SELECT  t.term_id t,t.count c,t1.term_id t1,t1.count c1,t2.term_id t2,t2.count c2 FROM $wpdb->term_taxonomy t LEFT JOIN $wpdb->term_taxonomy t1 on t.term_id = t1.parent LEFT JOIN $wpdb->term_taxonomy t2 on t2.parent = t1.term_id WHERE t.term_id = $input";
		$counts = $wpdb->get_results($SQL);
		$result = array();
	foreach($counts as $row){
	if(!array_key_exists($row->t,$result)){
		$result[$row->t]=$row->c;
	}
	if(!array_key_exists($row->t1, $result)&&$row->t1!=null){
		$result[$row->t1]=$row->c1;
	}
	if(!array_key_exists($row->t2, $result)&&$row->t2!=null){
		$result[$row->t2]=$row->c2;
	}
	}
		$t_count = 0;
	foreach(array_values($result) as $temp_count){
		$t_count += $temp_count;
	}
	return $t_count;
	}
	}

// Shorten Any Text
function short($text, $limit)
{
	$chars_limit = $limit;
	$chars_text = strlen($text);
	$text = strip_tags($text);
	$text = $text." ";
	$text = substr($text,0,$chars_limit);
	$text = substr($text,0,strrpos($text,' '));
	if ($chars_text > $chars_limit)
	{
		$text = $text."...";
	}
	return $text;
}

//breadcrumbs logic.
function misa_breadcrumbs(){
$delimiter = '/';
  $name = __( 'Home', 'misa' ); //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) { 
    global $post;
    $home = home_url();
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . __( 'Archive by category', 'misa' ) /*. ' &#39;'*/;
      single_cat_title();
     echo /* '&#39;' .*/ $currentAfter;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
 
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
	  echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_search() ) {
      echo $currentBefore . __( 'Search results for', 'misa' ) .' &#39;' . get_search_query() . '&#39;'. $currentAfter;
 
    } elseif ( is_tag() ) {
      echo $currentBefore . __( 'Posts tagged', 'misa' ) /*.'&#39;'*/;
      single_tag_title();
      echo /*'&#39;' .*/ $currentAfter;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . __( 'Articles posted by ', 'misa' ) . $userdata->display_name . $currentAfter;
 
    } elseif ( is_404() ) {
      echo $currentBefore . __( 'Error 404', 'misa' ) . $currentAfter;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page() ) echo ' (';
      echo __( 'Page', 'misa' ) . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page() ) echo ')';
    }
   }
}


/* Dynamic Page Titles on Featured Area */
function misa_page_title(){
	if ( !is_home() && !is_front_page() || is_paged() ) { 
		if ( is_category() ) {
			single_cat_title();
		} 
		elseif ( is_day() ) {
			_e( 'Daily Archives', 'misa' );
		} 
		elseif ( is_month() ) {
			_e( 'Monthly Archives', 'misa' );
		} 
		elseif ( is_year() ) {
			_e( 'Yearly Archives', 'misa' );
		} 
		elseif ( is_single() && !is_attachment() ) {
			$cat = get_the_category(); $cat = $cat[0];
			echo get_category_parents( $cat, false, '' );
		} 
		elseif ( is_page() ) {
			the_title();
		}  
		elseif ( is_search() ) {
			_e( 'Search Results', 'misa' );
		} 
		elseif ( is_tag() ) {
			_e( 'Tag Archives', 'misa' );
		} 
		elseif ( is_author() ) {
			_e( 'Author Archives', 'misa' ); 
		}
		elseif ( is_404() ) {
			_e( 'Error 404', 'misa' );
		}
		elseif ( is_attachment() ) {
		_e( 'Attachments', 'misa' );
		}		
	}
}


/* Misa Comments List */
if ( ! function_exists( 'misa_comment' ) ) :

function misa_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; 
	global $commentcount;
	if(!$commentcount) { 
		$pagenum = get_query_var('cpage')-1;
		$page_comment_count=get_option('comments_per_page');
		$commentcount = $pagenum * $page_comment_count;
	}	
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :		
	?>
        
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'misa' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'misa' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>        
        
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div class="commentwrapper <?php $author_id = get_the_author_meta('ID'); if($author_id == $comment->user_id) $author_flag = 'true';?>" id="comment-<?php comment_ID(); ?>">
            <div class="comment-meta">
            	<div class="comment-author">
                	<div class="author-card">
						<?php $avatar_size = 43;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 43;
							echo get_avatar( $comment, $avatar_size );?>
					</div>
                    <div class="author-data">
					<?php printf( __( '%1$s on %2$s <span class="says">said:</span>', 'misa' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'misa' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
                    
                    <?php edit_comment_link( __( 'Edit', 'misa' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
            	</div><!-- .comment-author -->
                
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'misa' ); ?></em>
				<br />
			<?php endif; ?>
                
             </div><!-- comment-meta -->
                
			<div class="comment-content"><?php comment_text(); ?></div> 
                
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'misa' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
            
			<div class="comment-level">
				<?php if(!$parent_id = $comment->comment_parent) { printf('#%1$s', ++$commentcount); } ?>
			</div><!-- .comment-level -->
            
		</div><!-- #comment-## -->

		<?php
			break;
		endswitch;
	}
	endif; // ends check for misa_comment()


// Pagenavi
function wp_pagenavi($range = 5) {
	global $paged, $wp_query;
	if ( !$max_page ) { $max_page = $wp_query->max_num_pages;}
	if($max_page > 1){
		echo '<div class="nav-page">';
		if(!$paged){$paged = 1;}
		echo '<span class="pages-of">'.$paged.' / '.$max_page.'</span>';
		previous_posts_link( __( '&laquo;  Previous Page', 'misa' ) );
		if($max_page > $range){
			if($paged < $range){
				for($i = 1; $i <= ($range + 1); $i++){
					echo "<a  href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current page-numbers'";
					echo ">$i</a>";

				}
			} elseif($paged >= ($max_page - ceil(($range/2)))){
				for($i = $max_page - $range; $i <= $max_page; $i++){
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current page-numbers'";
					echo ">$i</a>";
				}
			} elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
				for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current page-numbers'";
					echo ">$i</a>";
				}
			}
		} else {
			for($i = 1; $i <= $max_page; $i++){
				echo "<a href='" . get_pagenum_link($i) ."'";
				if($i==$paged) echo " class='current page-numbers'";
				echo ">$i</a>";
			}
		}
		next_posts_link( __( ' Next Page  &raquo;', 'misa' ) );
		echo '</div>';
	}
}


/* Related Posts on single post pages */
function misa_related_posts( $misa_rp_taxonomy, $misa_rp_style, $misa_rp_num ) {
	$temp = (isset($post)) ? $post : '';
	global $post;
	if ( $misa_rp_taxonomy == 'tags' )
	{
		$tags = wp_get_post_tags($post->ID);
		if ($tags) {
			$tag_ids = array();
			foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
			$args=array(
				'tag__in' => $tag_ids,
				'post__not_in' => array($post->ID),
				'posts_per_page'=> $misa_rp_num,
				'ignore_sticky_posts'=>1
			);
		} // end if tags	
	} //end taxonomy tags 
	else
	{
		$categories = get_the_category($post->ID);
		if ($categories) {
			$category_ids = array();
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;		
			$args=array(
			'category__in' => $category_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=> $misa_rp_num,
			'ignore_sticky_posts'=>1
			);
		} // end if categories
	} // end taxonomy categories
		$new_query = new WP_Query( $args );
		$list_class = ( $misa_rp_style == 'thumbnail' ) ? 'related_posts' : 'related_list';
		if( $new_query->have_posts() ) { ?>	
			<div class="<?php echo $list_class; ?> clearfix">
            	<h3 class="related-head single-headings"><?php _e( 'Related Posts', 'misa' ); ?></h3>
            	<ul >				
				<?php while( $new_query->have_posts() ) {
						$new_query->the_post(); ?>				
					<li><a href="<?php the_permalink(); ?>" title="<?php printf( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php
						$post_opts = get_post_meta( $post->ID, 'post_options', true);
						$img = (isset($post_opts['thumb'])) ? $post_opts['thumb'] : '' ;
						if ( $misa_rp_style == 'thumbnail' ) { ?><img src="<?php 
							if ( $img != '' ) {
						echo get_template_directory_uri(); ?>/scripts/timthumb.php?src=<?php echo $img; ?>&amp;w=140&amp;h=100&amp;zc=1&amp;q=100<?php }
							else { echo get_template_directory_uri(); ?>/images/post_thumb.png" <?php } ?> alt="<?php the_title(); ?>" width="140px" height="100px"/>
					<?php } else the_title(); ?></a>
                    	<div class="related_posts_title">
                        	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'misa' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
                        </div>
                    
                    </li>
				<?php } // while have posts
				echo '</ul></div>';
			} // if have posts
		$post = $temp;
		wp_reset_query();
	}


/* Remove auto DIV container on WP Menus */
function my_wp_nav_menu_args( $args = '' )
{
	$args['container'] = false;
	return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );


//Shortcodes autoformatting prevention
function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}
	return $new_content;
}
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
add_filter('the_content', 'my_formatter', 99);


//get cats children id
function get_cats_children($id = '',$link = true,$separator = '',$visited = array()){
	_deprecated_function( __FUNCTION__, '2.8', 'get_term_children()' );
	global $cat;
	if($id == '')$id = $cat;
		$chain = '';
	/** TODO: consult hierarchy */
	$cat_ids = get_all_category_ids();
	foreach ( (array) $cat_ids as $cat_id ) {
	if ( $cat_id == $id )continue;
		$category = get_category( $cat_id );
	if ( is_wp_error( $category ) )return $category;
	if ( $category->parent == $id && !in_array( $category->term_id, $visited ) ) {
		$visited[] = $category->term_id;
		$category_id = $category->term_id;
		$category_name = $category->name;
		$category_link = get_category_link( $category_id );
	if($link) 
		$chain .= '<a class="item-child-cat" href="'.$category_link.'" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '"  target="_blank" >'.$category_name.'</a>'.$separator;
	else 
		$chain .= $category_name.$separator;
		$chain .= get_cats_children( $category_id,$link,$separator,$visited );
		}
	}
	return $chain;
	}
function the_cats_children($id = '',$link = true,$separator = '',$visited = array()){
	echo get_cats_children($id,$link,$separator,$visited);
}



// comments
function new_field($fields) {
$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
	'author' => '<p class="comment-form-author">'. '<label for="author">' . __( 'Name', 'misa' ) . '</label> ' .( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />'. '</p>',
	'email'  => '<p class="comment-form-email">'. '<label for="email">' . __( 'Email', 'misa' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ).'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'. '</p>',
	'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'misa' ) . '</label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);
return $fields;
}
// the filter required to do so
add_filter('comment_form_default_fields','new_field');

// Enable short codes inside Widgets
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');
?>
<?php /* -------------------------------------  ALL FUNCTIONS END  ------------------------------------- */ ?>