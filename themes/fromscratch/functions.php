<?php

/**
 * Load config
 */
$fromscratch_config = include __DIR__ . '/config.php';

// Hide deprecated errors
if ($fromscratch_config['hideDeprecatedWarnigs'] && defined('WP_DEBUG') && WP_DEBUG) {
	error_reporting(E_ALL & ~E_DEPRECATED);
}

/**
 * Check wheather we are in debug mode
 */
function fromscratch_is_debug()
{
	return defined('WP_DEBUG') && true === WP_DEBUG;
}

/**
 * Get the hash for assets
 */
function fromscratch_get_asset_hash($file)
{
	// Return time when debugging
	if (fromscratch_is_debug()) {
		return time();
	}

	return filemtime(dirname(__FILE__) . $file);
}

/**
 * Init stylesheets
 */
function fromscratch_init_styles()
{
	$min = fromscratch_is_debug() ? '' : '.min';

	$file = '/css/main' . $min . '.css';
	wp_enqueue_style('fromscratch_main', get_template_directory_uri() . $file, [], fromscratch_get_asset_hash($file), 'all');
}
add_action('wp_enqueue_scripts', 'fromscratch_init_styles');

function fromscratch_admin_styles()
{
	$min = fromscratch_is_debug() ? '' : '.min';

	$file = '/css/admin' . $min . '.css';
	wp_enqueue_style('fromscratch_admin_styles', get_template_directory_uri() . $file, [], fromscratch_get_asset_hash($file), 'all');
}
add_action('admin_enqueue_scripts', 'fromscratch_admin_styles');

/**
 * Init scripts
 */
function fromscratch_init_scripts()
{
	$min = fromscratch_is_debug() ? '' : '.min';

	$file = '/js/main' . $min . '.js';
	wp_enqueue_script('fromscratch_main', get_template_directory_uri() . $file, [], fromscratch_get_asset_hash($file), true);
}
add_action('wp_enqueue_scripts', 'fromscratch_init_scripts');

function fromscratch_admin_scripts()
{
	$min = fromscratch_is_debug() ? '' : '.min';

	$file = '/js/admin' . $min . '.js';
	wp_enqueue_script('fromscratch_admin_scripts', get_template_directory_uri() . $file, [], fromscratch_get_asset_hash($file), true);
}
add_action('admin_enqueue_scripts', 'fromscratch_admin_scripts');

/**
 * Add manifest
 */
add_action('wp_head', 'inc_manifest_link');

// Creates the link tag
function inc_manifest_link()
{
	echo '<link rel="manifest" href="' . get_template_directory_uri() . '/manifest.json">';
}

/**
 * Add menus support and register menus
 */
add_theme_support('menus');

register_nav_menus([
	'header_menu' => __('Header', 'theme'),
	'footer_menu' => __('Footer', 'theme')
]);

// Add post thumbnails
add_theme_support('post-thumbnails');

/**
 * Add meta data
 */
function fromscratch_meta_tags()
{
	global $fromscratch_config;

	echo '<meta charset="utf-8">' . "\n";
	foreach ([
		'viewport'
	] as $meta) {
		echo '<meta name="' . $meta . '" content="' . $fromscratch_config['meta_' . $meta] . '">' . "\n";
	}
}
add_action('wp_head', 'fromscratch_meta_tags');

/**
 * Custom Search
 */
function html5_search_form()
{
	$form = '
		<form role="search" method="get" action="' . home_url('/') . '" >
			<input type="text" value="' . get_search_query() . '" class="search__input" name="s" placeholder="Search...">
			<button type="submit" class="button search__button">Search</button>
		</form>
	';

	return $form;
}
add_filter('get_search_form', 'html5_search_form');

/**
 * Allow editors to edit menus
 */
// $role_object = get_role('editor');
// $role_object->add_cap('edit_theme_options');

// Allow wide alignments
add_theme_support('align-wide');

/**
 * Change excerpt length
 */
function custom_excerpt_length()
{
	global $fromscratch_config;
	return $fromscratch_config['custom_excerpt_length'];
}
add_filter('excerpt_length', 'custom_excerpt_length');

/**
 * Custom excerpt
 */
function excerpt($limit)
{
	$excerpt = explode(' ', get_the_excerpt(), $limit);

	if (count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt) . '...';
	} else {
		$excerpt = implode(" ", $excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

	return $excerpt;
}

function custom_excerpt_more()
{
	global $fromscratch_config;
	return $fromscratch_config['custom_excerpt_more'];
}
add_filter('excerpt_more', 'custom_excerpt_more');

/**
 * Clean up HTML
 */
add_theme_support('title-tag');

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'wp_oembed_add_host_js');

// Remove blog link

function adjust_admin_panel()
{
	add_action('admin_menu', function () {
		remove_menu_page('edit.php');
	});
}

if (!empty($fromscratch_config['disable_blogs'])) {
	add_action('init', 'adjust_admin_panel');
}

/**
 * Remove comments
 */
function remove_menu_pages()
{
	remove_menu_page('edit-comments.php');
};

add_action('admin_menu', 'remove_menu_pages');

/**
 * Add custom colors and sizes
 */
function addCustomColorsAndSizes()
{
	global $fromscratch_config;
	add_theme_support('editor-color-palette', $fromscratch_config['theme_colors']);

	add_theme_support('editor-font-sizes', $fromscratch_config['theme_font_sizes']);
}
add_action('after_setup_theme', 'addCustomColorsAndSizes');

/**
 * Remove drop cap
 */
function disable_drop_cap_editor_settings($editor_settings)
{
	$editor_settings['__experimentalFeatures']['typography']['dropCap'] = false;
	return $editor_settings;
}
add_filter('block_editor_settings_all', 'disable_drop_cap_editor_settings');

/**
 * Theme settings
 */

require_once 'inc/theme-settings.php';
