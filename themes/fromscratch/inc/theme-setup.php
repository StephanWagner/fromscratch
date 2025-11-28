<?php

/**
 * Menus
 */
function fs_menus()
{
	add_theme_support('menus');

	global $fs_config;
	register_nav_menus($fs_config['menus']);
}
add_action('after_setup_theme', 'fs_menus');

/**
 * Support alignwide and alignfull
 */
function fs_add_alignwide()
{
	add_theme_support('align-wide');
}
add_action('after_setup_theme', 'fs_add_alignwide');

/**
 * Support post thumbnails
 */
function fs_add_post_thumbnails()
{
	add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'fs_add_post_thumbnails');

/**
 * Support support for admin styles
 */
function fs_add_admin_style_support()
{
	add_theme_support('wp-block-styles');
	add_theme_support('editor-styles');
}
add_action('after_setup_theme', 'fs_add_admin_style_support');

/**
 * Remove blogs
 */
function fs_adjust_admin_panel()
{
	add_action('admin_menu', function () {
		remove_menu_page('edit.php');
	});
}

if (!empty($fs_config['disable_blogs'])) {
	add_action('init', 'fs_adjust_admin_panel');
}

/**
 * Excerpt length
 */
function fs_excerpt_length()
{
	global $fs_config;
	return $fs_config['excerpt_length'];
}
add_filter('excerpt_length', 'fs_excerpt_length');

/**
 * Excerpt more
 */
function fs_excerpt_more()
{
	global $fs_config;
	return $fs_config['excerpt_more'];
}
add_filter('excerpt_more', 'fs_excerpt_more');

/**
 * Remove comments
 */
function fs_remove_comments()
{
	remove_post_type_support('post', 'comments');
	remove_post_type_support('page', 'comments');
}
add_action('init', 'fs_remove_comments');

function fs_remove_comments_in_admin()
{
	remove_menu_page('edit-comments.php');
	remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
}
add_action('admin_menu', 'fs_remove_comments_in_admin');

/**
 * Add custom colors and sizes
 */
function addCustomColorsAndSizes()
{
	global $fs_config;
	add_theme_support('editor-color-palette', $fs_config['theme_colors']);
    // add_theme_support('editor-gradient-presets', $fs_config['theme_gradients']);
	add_theme_support('editor-font-sizes', $fs_config['theme_font_sizes']);
}
add_action('after_setup_theme', 'addCustomColorsAndSizes');
