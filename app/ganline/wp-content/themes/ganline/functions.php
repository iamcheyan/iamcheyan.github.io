<?php /*?><?php if ( function_exists ('register_sidebar')) { 
	register_sidebar ('weibo'); 
}
?><?php */?>
<?php

//===============自定义字段
$gl_case_page =
array(
	"caseinfo" => array(
		"name" => "caseinfo",
		"std" => "这里是这个案例的简要说明",
		"title" => "案例介绍，300字左右，尽量长一点:"),

	"webimg" => array(
		"name" => "webimg",
		"std" => "#eee",
		"title" => "网页案例-主图，显示在iMac里面的预览图"),

	"casedetail" => array(
		"name" => "casedetail",
		"std" => "",
		"title" => "案例信息，可以填入html代码:"),

	"webbgcolor" => array(
		"name" => "webbgcolor",
		"std" => "#fff",
		"title" => "案例背景色，十六进制数:"),

	"webbordercolor" => array(
		"name" => "webbordercolor",
		"std" => "#eee",
		"title" => "案例边线颜色，十六进制数:"),

	"index_img" => array(
		"name" => "index_img",
		"std" => "",
		"title" => "首页大图地址:"),
	
	"index_img_link" => array(
		"name" => "index_img_link",
		"std" => "",
		"title" => "首页大图链接:")
);
//创建自定义域以及输入框
function gl_case_page() {
	global $post, $gl_case_page;

	foreach($gl_case_page as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

		if($meta_box_value == "")
			$meta_box_value = $meta_box['std'];

		// 自定义字段标题
		echo'<h4>'.$meta_box['title'].'</h4>';

		// 自定义字段输入框
		echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
	}
	
	echo '<input type="hidden" name="newmetaboxes_noncename" id="newmetaboxes_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
}
//在文章编辑页添加自定义字段模块
function create_meta_box() {
	global $theme_name;

	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-boxes', '橄榄传媒案例面板', 'gl_case_page', 'post', 'normal', 'high' );
	}
}
//保存自定义字段中的信息
function save_postdata( $post_id ) {
	global $gl_case_page;
	
	if ( !wp_verify_nonce( $_POST['newmetaboxes_noncename'], plugin_basename(__FILE__) ))
		return;
	
	if ( !current_user_can( 'edit_posts', $post_id ))
		return;
					
	foreach($gl_case_page as $meta_box) {
		$data = $_POST[$meta_box['name'].'_value'];

		if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
		elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
			update_post_meta($post_id, $meta_box['name'].'_value', $data);
		elseif($data == "")
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
	}
}
//将函数连接到指定action（动作），以让WordPress程序执行编写的函数
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');
//===============自定义字段 END

//===============在后台添加橄榄传媒管理员控制面板
// my_add_pages() 为 'admin_menu' 钩子的回调函数
function my_add_pages() {
	add_menu_page('橄榄传媒官网管理系统', '橄榄传媒', 'administrator', 'ganline_admin' , 'index_top');
	add_submenu_page('ganline_admin','首页图片','首页大图管理', 'administrator' ,'ganline_admin' , 'index_top'); 
	add_submenu_page('ganline_admin','网站流量','访客统计系统', 'administrator' ,'ganline_admin_tongji','ganline_admin_tongji'); 

}

function index_top() {
	require_once( get_template_directory() . '/admin/admin_index.php' );
}

function ganline_admin_tongji() {
	echo "http://tongji.baidu.com/web/5760887/overview/sole?siteId=3698102";
}
// 隐藏前台顶部菜单栏
function my_function_admin_bar(){ 
return false; 
} 
add_filter( 'show_admin_bar' , 'my_function_admin_bar');

// 删除菜单
function remove_menus() {
	global $menu;
	$restricted = array(__('Appearance'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}

if ( is_admin() ) {
	// 删除左侧菜单
	add_action('admin_menu', 'remove_menus');
}

// 通过add_action来自动调用my_add_pages函数
add_action('admin_menu', 'my_add_pages');
//===============在后台添加橄榄传媒管理员控制面板 END

//文章缩略图控制
add_theme_support('post-thumbnails');
add_image_size('w325', 325, 155);

if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'indexSidebar',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));
}
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'tagSidebar',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));
}
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'postSidebar',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));
}

if (! function_exists('twentyten_comment')) : function twentyten_comment($comment,$args,$depth) {
	$GLOBALS['comment'] = $comment;
	switch ($comment -> comment_type) :
		case '' :
	?>
	
	<li class="comment-li comment-<?php comment_ID(); ?>">
		<section class="comment-main">
			<dl class="you fn-clear">
				<dt class="name fn-left">
					<?php echo get_comment_author_link(); ?>
					<?php if ($comment -> comment_approved == '0') : ?>
					<span>您的评论正在等待审核</span>
					<?php endif; ?>
				</dt>
				<dd class="date fn-right">
					<span class="year"><?php echo get_comment_time('Y') ?></span><span class="month">/<?php echo get_comment_time('m') ?></span><span class="day">/<?php echo get_comment_time('d') ?></span><span class="time">/<?php echo get_comment_time('H:i') ?></span>
				</dd>
			</dl>
			<section class="con">
				<?php comment_text(); ?>
				<div class="reply-you"><?php comment_reply_link(array_merge($args,array('depth' => $depth,'max_depth' => $args['max_depth']))); ?></div>
			</section>
		</section>
	<?php
			break;
	endswitch;
}
endif;
?>
