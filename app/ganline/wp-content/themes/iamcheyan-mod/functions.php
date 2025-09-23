<?php /*?><?php if ( function_exists ('register_sidebar')) { 
	register_sidebar ('weibo'); 
}
?><?php */?>
<?php

// remove_filter( 'the_content', 'wpautop' );	//去除正文P标签包裹
// remove_filter( 'the_excerpt', 'wpautop' );	//去除摘要P标签包裹

//去掉图片链接
function wpc_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );
    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'wpc_imagelink_setup', 10);

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
