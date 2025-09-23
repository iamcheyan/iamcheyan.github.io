<?php get_header(); ?>
<div class="entry">
	<?php include (TEMPLATEPATH. '/article.php'); ?>
</div>

<aside>
	<?php dynamic_sidebar(postSidebar); ?>
</aside>
<?php get_footer(); ?>