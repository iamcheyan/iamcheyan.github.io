<?php 
/* Missra Theme Admin Options */

load_theme_textdomain( 'misa', TEMPLATEPATH . '/languages' );
$themename = 'Missra';
$shortname = 'misa';
$options = array (
				array(	"type" => "wrap_start" ),
				
				array(	"type" => "tabs_start" ),
						
				array(	"name" => __( 'General', 'misa' ),
						"id" => $shortname."_general",
						"type" => "heading"),
						
				array(	"name" => __( 'Slider', 'misa' ),
						"id" => $shortname."_slider_area",
						"type" => "heading"),
						
				
				array(	"name" => __( 'Single', 'misa' ),
						"id" => $shortname."_single",
						"type" => "heading"),
						
				array(	"name" => __( 'Headings', 'misa' ),
						"id" => $shortname."_headings",
						"type" => "heading"),
						
				array(	"type" => "tabs_end" ),
				
				
				
				//General Settings
				array(	"type" => "tabbed_start",
						"id" => $shortname."_general" ),
				
						
				array(	"name" => __( 'General Settings for the theme', 'misa' ),
						"type" => "subheading" ),
				
				array(  "name" => __( 'Display Blog Name:', 'misa' ),
						"desc" => __( 'Check to display blog name and description in place of Logo.', 'misa' ),
						"id" => $shortname."_blog_name",
						"type" => "checkbox",
						"std" => "false"),		
						
				array(	"name" => __( 'Custom Logo URL:', 'misa' ),
						"desc" => __( 'Enter full URL of your Logo image.', 'misa' ),
						"id" => $shortname."_logo",
						"std" => "",
						"type" => "text"),																		
						
				array(	"name" => __( 'Logo MarginTop(px):', 'misa' ),
						"desc" => __( 'Enter a top margin for Logo or Blog name', 'misa' ),
						"id" => $shortname."_logo_mrgtop",
						"std" => "15",
						"type" => "text"),	
						
				array(	"name" => __( 'Logo MarginBottom(px):', 'misa' ),
						"desc" => __( 'Enter a bottom margin for Logo or Blog name', 'misa' ),
						"id" => $shortname."_logo_mrgbtm",
						"std" => "15",
						"type" => "text"),

				array(	"name" => __( 'Home Category IDs to exclude:', 'misa' ),
						"desc" => __( 'Insert the category IDs you want excluded from home page. Ex: 1,3,5', 'misa' ),
						"id" => $shortname."_exclude_cats",
						"std" => "",
						"type" => "text"),
						
				array(	"name" => __( 'Global Sidebar Placement:', 'misa' ),
						"desc" => __( 'Select a placement for sidebar', 'misa' ),
						"id" => $shortname."_sidebar",
						"std" => "right",
						"type" => "select",
						"options" => array("right", "left")),

				array(	"name" => __( 'Homepage Meta Description:', 'misa' ),
						"desc" => __( 'Meta Description for Website. ', 'misa' ),
						"id" => $shortname."_meta_description",
						"std" => "",
						"type" => "textarea"),

				array(	"name" => __( 'Meta Keywords for SEO:', 'misa' ),
						"desc" => __( 'Enter a brief and concise list of some unique keywords that best describes the content of your page. Seperate each keyword with comma.', 'misa' ),
						"id" => $shortname."_meta_keywords",
						"std" => "",
						"type" => "textarea"),					
						
				array(	"name" => __( 'Custom Footer Text (Left):', 'misa' ),
						"desc" => __( 'Enter custom text for left side of the footer. You can use <code>HTML</code> here.', 'misa' ),
						"id" => $shortname."_footer_left",
						"std" => "",
						"type" => "textarea"),
						
				array(	"name" => __( 'Custom Footer Text (Right):', 'misa' ),
						"desc" => __( 'Enter custom text for right side of the footer. You can use <code>HTML</code> here.', 'misa' ),
						"id" => $shortname."_footer_right",
						"std" => "",
						"type" => "textarea"),						
					
				array(	"type" => "tabbed_end" ),
				
				
				
				//Slider Settings
				array(	"type" => "tabbed_start",
						"id" => $shortname."_slider_area" ),
						
				array(	"name" => __( 'Slider Settings', 'misa' ),
						"type" => "subheading" ),																														
						
				array(  "name" => __( 'Hide Slider:', 'misa' ),
						"desc" => __( 'Check to hide slider on home page.', 'misa' ),
						"id" => $shortname."_hide_slider",
						"type" => "checkbox",
						"std" => "false"),											
						
				array(	"name" => __( 'Category ID to fetch images from:', 'misa' ),
						"desc" => __( 'Enter your featured category ID (or IDs separated by comma) from which images will be shown on slider.', 'misa' ),
						"id" => $shortname."_feat_cat_id",
						"std" => "1",
						"type" => "text"),
						
				array(	"name" => __( 'Number of slides to show:', 'misa' ),
						"desc" => __( 'Enter number of slides to show.', 'misa' ),
						"id" => $shortname."_num_of_slides",
						"std" => "3",
						"type" => "text"),
						
				array(	"name" => __( 'Order of slides:', 'misa' ),
						"desc" => __( 'Select an order - Ascending or descending', 'misa' ),
						"id" => $shortname."_feat_order",
						"std" => "desc",
						"type" => "select",
						"options" => array("desc", "asc")),
						
				array(	"name" => __( 'Slider Height (px):', 'misa' ),
						"desc" => __( 'Enter a height for slider', 'misa' ),
						"id" => $shortname."_sl_ht",
						"std" => "300",
						"type" => "text"),										
						
				array(	"type" => "tabbed_end" ),
				
				
				
				//Single Post Settings
				array(	"type" => "tabbed_start",
						"id" => $shortname."_single" ),
						
				array(	"name" => __( 'Single Post Settings', 'misa' ),
						"type" => "subheading" ),						
						
				array(  "name" => __( 'Whether to show Author Bio:', 'misa' ),
						"desc" => __( 'Select display Author Bio on single posts.', 'misa' ),
						"id" => $shortname."_author",
						"type" => "select",
						"std" => "Enable",
						"options" => array("Enable", "Disable")),
						
				array(  "name" => __( 'Whether to show related posts:', 'misa' ),
						"desc" => __( 'Select display Related Posts on single posts.', 'misa' ),
						"id" => $shortname."_rp",
						"type" => "select",
						"std" => "Enable",
						"options" => array("Enable", "Disable")),
						
				array(	"name" => __( 'Related posts taxonomy:', 'misa' ),
						"desc" => __( 'Select a taxonomy for related posts.', 'misa' ),
						"id" => $shortname."_rp_taxonomy",
						"std" => "category",
						"type" => "select",
						"options" => array("tags", "category")),
						
				array(	"name" => __( 'Related posts display style:', 'misa' ),
						"desc" => __( 'Select a display style for related posts.', 'misa' ),
						"id" => $shortname."_rp_style",
						"std" => "thumbnail",
						"type" => "select",
						"options" => array("thumbnail", "list")),
						
				array(	"name" => __( 'Number of related posts to show:', 'misa' ),
						"desc" => __( 'Enter a number for posts to show.', 'misa' ),
						"id" => $shortname."_rp_num",
						"std" => "4",
						"type" => "text"),
																
				array(	"type" => "tabbed_end" ),
				
				
				
				//Global Heading Settings
				array(	"type" => "tabbed_start",
						"id" => $shortname."_headings" ),
						
				array(	"name" => __( 'Global Heading Settings', 'misa' ),
						"type" => "subheading" ),	
						
				array(  "name" => __( 'Use custom heading settings:', 'misa' ),
						"desc" => __( 'Check to use your custom heading settings. Your custom settings will only take effect if you enable this option.', 'misa' ),
						"id" => $shortname."_custom_headings",
						"type" => "checkbox",
						"std" => "false"),												
						
				array(	"name" => __( 'Heading Font:', 'misa' ),
						"desc" => __( 'Select a font for headings', 'misa' ),
						"id" => $shortname."_heading_font",
						"std" => "Open Sans",
						"type" => "select",
						"options" => array("Open Sans", "Arial", "Georgia", "Allan", "Allerta", "Anton", "Arimo", "Arvo", "Cabin", "Calligraffitti", "Cantarell", "Cardo", "Chewy", "Copse", "Crafty Girls", "Crimson Text", "Crushed", "Cuprum", "Dancing Script", "Droid Sans", "Droid Serif", "EB Garamond", "Expletus Sans", "Gruppo", "Judson", "Just Another Hand", "Kreon", "Lobster", "Luckiest Guy", "Merriweather", "Metrophobic", "Molengo", "Neuton", "Nobile", "Open Sans Condensed", "Orbitron", "Play", "PT Sans", "PT Serif", "Philosopher", "Rokkitt", "Tangerine", "Ubuntu", "Vollkorn", "Yanone Kaffeesatz")),
						
				array(	"name" => __( 'Font Style:', 'misa' ),
						"desc" => __( 'Select a font style for headings. This style will be loaded only if available within the font.', 'misa' ),
						"id" => $shortname."_heading_font_style",
						"std" => "regular",
						"type" => "select",
						"options" => array("regular", "italic", "bold", "bold italic")),											
						
				array(	"name" => __( 'Heading Color:', 'misa' ),
						"desc" => __( 'Choose a color for headings', 'misa' ),
						"id" => $shortname."_heading_color",
						"std" => "333333",
						"type" => "color_text"),						
						
						
				array(	"name" => __( 'Featured Area Heading Settings', 'misa' ),
						"type" => "subheading" ),						
						
				array(	"name" => __( 'Featured area Heading Font:', 'misa' ),
						"desc" => __( 'Select a font for featured area headings', 'misa' ),
						"id" => $shortname."_ft_heading_font",
						"std" => "Open Sans",
						"type" => "select",
						"options" => array("Open Sans", "Arial", "Georgia", "Allan", "Allerta", "Anton", "Arimo", "Arvo", "Cabin", "Calligraffitti", "Cantarell", "Cardo", "Chewy", "Copse", "Crafty Girls", "Crimson Text", "Crushed", "Cuprum", "Dancing Script", "Droid Sans", "Droid Serif", "EB Garamond", "Expletus Sans", "Gruppo", "Judson", "Just Another Hand", "Kreon", "Lobster", "Luckiest Guy", "Merriweather", "Metrophobic", "Molengo", "Neuton", "Nobile", "Open Sans Condensed", "Orbitron", "Play", "PT Sans", "PT Serif", "Philosopher", "Rokkitt", "Tangerine", "Ubuntu", "Vollkorn", "Yanone Kaffeesatz")),
						
				array(	"name" => __( 'Featured area Heading Font Style:', 'misa' ),
						"desc" => __( 'Select a font style for featured area headings. This style will be loaded only if available within the font.', 'misa' ),
						"id" => $shortname."_ft_heading_font_style",
						"std" => "regular",
						"type" => "select",
						"options" => array("regular", "italic", "bold", "bold italic")),											
						
				array(	"name" => __( 'Featured area Heading Color:', 'misa' ),
						"desc" => __( 'Choose a color for headings', 'misa' ),
						"id" => $shortname."_ft_heading_color",
						"std" => "555555",
						"type" => "color_text"),	
						
				array(	"name" => __( 'Blog post titles Settings', 'misa' ),
						"type" => "subheading" ),
						
				array(	"name" => __( 'Post titles heading Font:', 'misa' ),
						"desc" => __( 'Select a font for blog post titles', 'misa' ),
						"id" => $shortname."_bl_heading_font",
						"std" => "Open Sans",
						"type" => "select",
						"options" => array("Open Sans", "Arial", "Georgia", "Allan", "Allerta", "Anton", "Arimo", "Arvo", "Cabin", "Calligraffitti", "Cantarell", "Cardo", "Chewy", "Copse", "Crafty Girls", "Crimson Text", "Crushed", "Cuprum", "Dancing Script", "Droid Sans", "Droid Serif", "EB Garamond", "Expletus Sans", "Gruppo", "Judson", "Just Another Hand", "Kreon", "Lobster", "Luckiest Guy", "Merriweather", "Metrophobic", "Molengo", "Neuton", "Nobile", "Open Sans Condensed", "Orbitron", "Play", "PT Sans", "PT Serif", "Philosopher", "Rokkitt", "Tangerine", "Ubuntu", "Vollkorn", "Yanone Kaffeesatz")),
						
				array(	"name" => __( 'Post titles font style:', 'misa' ),
						"desc" => __( 'Select a font style for post titles. This style will be loaded only if available within the font.', 'misa' ),
						"id" => $shortname."_bl_heading_font_style",
						"std" => "regular",
						"type" => "select",
						"options" => array( "regular", "italic", "bold", "bold italic")),																	
						
						
				array(	"name" => __( 'Post Title Color:', 'misa' ),
						"desc" => __( 'Choose a color for post titles', 'misa' ),
						"id" => $shortname."_bl_col",
						"std" => "333333",
						"type" => "color_text"),
						
				array(	"name" => __( 'Post Title Hover Color:', 'misa' ),
						"desc" => __( 'Choose a hover color for post titles', 'misa' ),
						"id" => $shortname."_bl_hvr_col",
						"std" => "000000",
						"type" => "color_text"),
						
				array(	"name" => __( 'Sidebar Heading Settings', 'misa' ),
						"type" => "subheading" ),						
						
				array(	"name" => __( 'Sidebar Heading Font:', 'misa' ),
						"desc" => __( 'Select a font for sidebar widget headings', 'misa' ),
						"id" => $shortname."_sb_heading_font",
						"std" => "Open Sans",
						"type" => "select",
						"options" => array("Open Sans", "Arial", "Georgia", "Allan", "Allerta", "Anton", "Arimo", "Arvo", "Cabin", "Calligraffitti", "Cantarell", "Cardo", "Chewy", "Copse", "Crafty Girls", "Crimson Text", "Crushed", "Cuprum", "Dancing Script", "Droid Sans", "Droid Serif", "EB Garamond", "Expletus Sans", "Gruppo", "Judson", "Just Another Hand", "Kreon", "Lobster", "Luckiest Guy", "Merriweather", "Metrophobic", "Molengo", "Neuton", "Nobile", "Open Sans Condensed", "Orbitron", "Play", "PT Sans", "PT Serif", "Philosopher", "Rokkitt", "Tangerine", "Ubuntu", "Vollkorn", "Yanone Kaffeesatz")),
						
				array(	"name" => __( 'Sidebar Heading Font Style:', 'misa' ),
						"desc" => __( 'Select a font style for sidebar widget headings. This style will be loaded only if available within the font.', 'misa' ),
						"id" => $shortname."_sb_heading_font_style",
						"std" => "regular",
						"type" => "select",
						"options" => array("regular", "italic", "bold", "bold italic")),
						
				array(	"name" => __( 'Sidebar Heading Color:', 'misa' ),
						"desc" => __( 'Choose a color for headings', 'misa' ),
						"id" => $shortname."_sb_heading_color",
						"std" => "555555",
						"type" => "color_text"),
						
				array(	"name" => __( 'Secondary Area Heading Settings', 'misa' ),
						"type" => "subheading" ),						
						
				array(	"name" => __( 'Secondary area Heading Font:', 'misa' ),
						"desc" => __( 'Select a font for secondary area widget headings', 'misa' ),
						"id" => $shortname."_sc_heading_font",
						"std" => "Open Sans",
						"type" => "select",
						"options" => array("Open Sans", "Arial", "Georgia", "Allan", "Allerta", "Anton", "Arimo", "Arvo", "Cabin", "Calligraffitti", "Cantarell", "Cardo", "Chewy", "Copse", "Crafty Girls", "Crimson Text", "Crushed", "Cuprum", "Dancing Script", "Droid Sans", "Droid Serif", "EB Garamond", "Expletus Sans", "Gruppo", "Judson", "Just Another Hand", "Kreon", "Lobster", "Luckiest Guy", "Merriweather", "Metrophobic", "Molengo", "Neuton", "Nobile", "Open Sans Condensed", "Orbitron", "Play", "PT Sans", "PT Serif", "Philosopher", "Rokkitt", "Tangerine", "Ubuntu", "Vollkorn", "Yanone Kaffeesatz")),
						
				array(	"name" => __( 'Secondary area Heading Font Style:', 'misa' ),
						"desc" => __( 'Select a font style for secondary area widget headings. This style will be loaded only if available within the font.', 'misa' ),
						"id" => $shortname."_sc_heading_font_style",
						"std" => "regular",
						"type" => "select",
						"options" => array("regular", "italic", "bold", "bold italic")),
						
				array(	"name" => __( 'Secondary area Heading Color:', 'misa' ),
						"desc" => __( 'Choose a color for secondary area widget headings', 'misa' ),
						"id" => $shortname."_sc_heading_color",
						"std" => "777777",
						"type" => "color_text"),
						
				array(	"type" => "tabbed_end" ),
				array(	"type" => "wrap_end" )
);

function mytheme_add_admin() {
    global $themename, $shortname, $options;
	
	// Load admin styling files.
	$file_dir = get_template_directory_uri();
	wp_enqueue_style("admin_css", $file_dir."/admin/admin.css", false, "1.0", "all");
	wp_enqueue_style("colorpicker_css", $file_dir."/admin/css/colorpicker.css", false, "1.0", "all");
	wp_enqueue_script("colorpicker_js", $file_dir."/admin/colorpicker.js", false, "1.0");
	wp_enqueue_script("admin_js", $file_dir."/admin/admin.js", false, "1.0");	
	    if ( isset($_GET['page']) && ($_GET['page'] == basename(__FILE__)) ) {
		 if ( isset($_REQUEST['action']) && ('save' == $_REQUEST['action']) ) {
                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
                header("Location: themes.php?page=theme_admin_options.php&saved=true");
                die;
        } else if( isset($_REQUEST['action']) && ('reset' == $_REQUEST['action'] )) {
            foreach ($options as $value) {
                delete_option( $value['id'] ); }
            header("Location: themes.php?page=theme_admin_options.php&reset=true");
            die;
        }
    }
    add_theme_page($themename." Options", __( 'Missra Options', 'misa' ), 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p>'.$themename.' '.__( 'Settings Saved. ', 'misa' ).'</p></div>';
    if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p>'.$themename.' '.__( 'settings reset.', 'misa' ).'</p></div>';
    
?>
<div class="wrap">
<div class="settings-icon"></div>
    <h2><?php echo $themename; ?> <?php _e('Theme Settings','misa') ?></h2>
    <form method="post">
		<?php foreach ($options as $value) {     
            switch ( $value['type'] ) {
			
                case "wrap_start":
                ?>
                <div class="ss_wrap">
                <?php break;
				
                case "wrap_end":
                ?>
                </div>
                <?php break;							
                    
                case "tabs_start":
                ?>
                <ul class="tabs">
                <?php break;
				
                case "tabs_end":
                ?>
                </ul>
                <?php break;
				
                case "tabbed_start":
                ?>
                <div class="tabbed" id="<?php echo $value['id']; ?>">
                <?php break;
				
                case "tabbed_end":
                ?>
                </div>
                <?php break;											
                    
                case "heading":
                ?>
                <li><a href="#<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></li>
                <?php break;
				
                case "subheading":
                ?>
                <div class="subheading"><?php echo $value['name']; ?></div>
                <?php break;				
                
                case 'select':
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                            <?php foreach ($value['options'] as $option) { ?>
                            <option <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
                            <?php } ?>
                        </select>
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
                <?php break;
        
                case 'text':
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
                <?php break;
				
				case 'color_text':
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <input class="mycolor" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
                    <div id="pick_ico_<?php echo $value['id']; ?>" class="picker_ico">
                      <div></div>            
                    </div>                         
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
              
                <?php break;
                case 'textarea':
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <textarea class="code" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="30" rows="6"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std'];} ?></textarea>
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
                <?php break;		
                
                    
                case "checkbox":
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
                <?php break;
                } 
            }
            ?>
            <p class="submit">
            <input name="save" type="submit" value="<?php _e('Save changes', 'misa' ) ?>" class="save"/>    
            <input type="hidden" name="action" value="save" />
            </p>
    </form>
    <form method="post">
        <p class="submit" >
        <input name="reset" type="submit" value="<?php _e('Reset all settings', 'misa' ) ?>" class="reset" style="color:#f56c6c; border:1px solid #f56c6c; margin-left:620px;"/>
        <input type="hidden" name="action" value="reset" />
        </p>
    </form>
    
<!--Show All Categorie'ID-->
<?php function all_cats_id() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach ($categorys as $category) { 
		$output = '<li><div class="cat_name">'.$category->name.":</div><span>".$category->term_id.'</span> </li>';
		echo $output;
		}
	}
?>
 	<ul class="all_cats_id">
        <h3><span class="cat_name" style="margin-right:6px; font-weight:600;"><?php _e('Cat Name','misa');?></span><?php _e('Cat ID','misa');?></h3>
		<?php all_cats_id();?>
	</ul> 
   
</div>
<?php
}
add_action('admin_menu', 'mytheme_add_admin');?>