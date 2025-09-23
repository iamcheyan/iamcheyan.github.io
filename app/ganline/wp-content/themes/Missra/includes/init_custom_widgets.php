<?php 
/*Initialize Custom Widgets*/
function custom_widget_init() {
	register_widget('Misa_Cat_Widget');
	register_widget('Misa_Recent_Posts');
	register_widget('Misa_Mini_Folio');
	register_widget('Misa_Popular_Posts');
	register_widget('Misa_Recent_Comments');
	register_widget('Misa_Mini_Slider');
	register_widget('Misa_Content_Slider');
}
add_action('widgets_init', 'custom_widget_init');?>