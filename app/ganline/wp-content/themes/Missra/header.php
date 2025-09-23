<?php
/* Header Template */

/* Fetch admin options. */
global $options;
foreach ($options as $value) {
	if(isset($value['id']) && isset ($value['std']))
		if (get_option( $value['id'] ) === FALSE) { 
			$$value['id'] = $value['std']; 
		} else { 
		$$value['id'] = get_option( $value['id'] );
	}
}?>
<?php $dir = get_template_directory_uri();?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="description" content="<?php echo $misa_meta_description; ?>" />
<meta name="keywords" content="<?php echo $misa_meta_keywords; ?>" />
<title><?php global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' ); $site_description = get_bloginfo( 'description', 'display' ); if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description"; ?></title>
<link rel="shortcut icon" href="<?php echo $dir ?>/images/favicon.ico"/>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />        

<!-- STYLE SHEETS -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>"/>      	
<link rel="stylesheet" type="text/css" href="<?php echo $dir; ?>/css/prettyPhoto.css" />

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="<?php echo $dir; ?>/css/ie.css" >
<![endif]-->
<!--[if IE 6]><script type="text/javascript" src="js/iepngfix.js"></script><![endif]-->

<?php
	wp_enqueue_script('jquery');
	wp_enqueue_script('tabber', $dir.'/js/tabs.js', array('jquery-ui-core', 'jquery-ui-tabs'), '1.0');
	if ( is_singular() && get_option('thread_comments') )
	wp_enqueue_script('comment-reply');
	wp_enqueue_script("jq-mini", $dir."/js/jquery.min.js"); 	
	wp_enqueue_script("jq-cycle", $dir."/js/jquery.cycle.slider.js"); 
	wp_enqueue_script("jq-pretty-photo", $dir."/js/jquery.prettyPhoto.js");
	wp_enqueue_script("custom", $dir."/js/custom.js");
	wp_enqueue_script("comments-ajax", $dir."/comments-ajax.js");	
	wp_enqueue_script("contact-form", $dir."/js/form.js");	
	wp_enqueue_script("jq-validate", $dir."/js/jquery.validate.pack.js");
	wp_head();
?> 

<script type="text/javascript">// < ![CDATA[
	jQuery("#web_loading div").animate({width:"10%"});
// ]]></script>

<?php include_once('includes/load_styles.php'); ?>       
</head>
<body <?php body_class(); ?>>
<div id="web_loading"><div></div></div>	
    <div id="header">
        <div class="header_wrap">
        	<?php include('includes/topbar.php'); ?>
            <div class="brand"><?php if ( $misa_blog_name == 'true' ){ ?>                
            <h1 class="blogname"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1><span class="tagline"><?php bloginfo('description'); ?></span>
            <?php }
            else { ?>
            <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>" rel="home"><img src=<?php if ( $misa_logo != '' ) echo ( '"'.$misa_logo.'"'); else { echo ('"'.$dir.'/images/logo.png"' );} ?> alt="<?php bloginfo('name'); ?>" /></a><?php } ?>
            </div><!-- .brand -->
            <div class="header_wgt_area">
			<?php if (is_page()) {
					$page_opts = get_post_meta( $posts[0]->ID, 'page_options', true );
					$unique_header_bar = (isset($page_opts['unique_header_bar'])) ? $page_opts['unique_header_bar'] : '';
					if ( $unique_header_bar )
					{
						if ( is_active_sidebar( $posts[0]->ID.'-header-bar') )
							dynamic_sidebar( $posts[0]->ID.'-header-bar' );						
					}
					else {
						if ( is_active_sidebar( 'default-header-bar' ) )
							dynamic_sidebar( 'default-header-bar' ); 
					}
				} // is_page				
				else // other pages like single, search, archives
				{			
					if ( is_active_sidebar( 'default-header-bar' ) )
						dynamic_sidebar( 'default-header-bar' ); 
				}
			?>         
            
            </div><!-- .header_wgt_area -->
        </div><!-- .header_wrap -->
        
		<div class="navigation">
			<div class="navigation_wrap clearfix">
            	<?php wp_nav_menu( array( 'container' => 'none', 'menu_class' => 'nav1', 'theme_location' => 'primary' ) ); ?>
            	<?php wp_nav_menu( array( 'container' => 'none', 'menu_class' => 'nav2', 'theme_location' => 'secondary' ) ); ?>
			</div>
		</div><!-- .navigation -->
        
    </div><!-- .header -->
    
<div id="main">

	<?php include_once('includes/featured.php'); ?>
     
    <div class="primary">
    	<div class="primary_wrap">           
    	<?php 
    		$content_class = 'content';
			$full_width = '';
			$sidebar_opts = '';
			$is_full = '';
    		if ( is_page() ) {
				$page_opts = get_post_meta( $posts[0]->ID, 'page_options', true );
				$sidebar_opts = (isset($page_opts['sidebar_opts'])) ? $page_opts['sidebar_opts'] : '';
    		}
    		if ( is_single() ) {
				$post_opts = get_post_meta( $posts[0]->ID, 'post_options', true );
				$sidebar_opts = (isset($post_opts['sidebar_opts'])) ? $post_opts['sidebar_opts'] : '';
    		}
    
    		if ( $sidebar_opts == 'none' || ( $misa_sidebar == 'none' && ( !( $sidebar_opts == 'right' || $sidebar_opts == 'left' ) ) ) ) {
				$full_width = 'true';
    		}            
    		if ( $full_width == 'true' || is_page_template('page-3column.php') || is_page_template('page-4column.php') || is_search() || is_404() ) {
				$is_full = 'true';
				$content_class = 'content wide';				
    		}            
    		if ( ( $sidebar_opts == 'left' ) && ( !( $sidebar_opts == 'right' || $sidebar_opts == 'none' ) ) && !$is_full ){
				$content_class = 'content right';    
		get_sidebar(); ?>
		<div class="<?php echo $content_class; ?>">
		<?php  }			
			elseif (( $misa_sidebar == 'left' ) && ( !( $sidebar_opts == 'right' || $sidebar_opts == 'none' ) ) && !$is_full ){
				$content_class = 'content right';
		get_sidebar();?>
		<div class="<?php echo $content_class; ?>">
		<?php  } 
			else { ?>
		<div class="<?php echo $content_class; ?>">
		<?php }?>