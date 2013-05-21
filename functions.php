<?php
/**
 * Resets the `$theme` global to the blog theme
 */
function _include_theme() {
	global $theme;
	require_once 'libs/blog_theme.php';
	$theme = new BlogTheme();
	$theme->supports('staff', true);
	$theme->init();
}
add_action('after_setup_theme', '_include_theme');