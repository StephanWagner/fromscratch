<?php

/**
 * Load config
 */
$fromscratch_config = include __DIR__ . '/config.php';

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

	$file = '/js/vendor' . $min . '.js';
	wp_enqueue_script('fromscratch_vendor', get_template_directory_uri() . $file, [], fromscratch_get_asset_hash($file), false);

	$file = '/js/main' . $min . '.js';
	wp_enqueue_script('fromscratch_main', get_template_directory_uri() . $file, [], fromscratch_get_asset_hash($file), true);
}
add_action('wp_enqueue_scripts', 'fromscratch_init_scripts');

/**
 * Add menus support and register menus
 */
add_theme_support('menus');

register_nav_menus([
	'header_menu' => __('Header', 'theme'),
	'footer_menu' => __('Footer', 'theme')
]);

/**
 * Add meta data
 */
function fromscratch_meta_tags()
{
	global $fromscratch_config;

	echo '<meta charset="utf-8">' . "\n";
	foreach ([
		'meta_viewport',
		'meta_title',
		'meta_description',
	] as $meta) {
		echo '<meta name="' . $meta . '" content="' . $fromscratch_config[$meta] . '">' . "\n";
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
			<button type="submit" class="search__button">Search</button>
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

/**
 * Remove custom colors and sizes
 */
function removeCustomColorsAndSizes()
{
	add_theme_support('editor-color-palette');
	add_theme_support('disable-custom-colors');
	add_theme_support('disable-custom-font-sizes');

	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => __('Small'),
				'shortName' => __('S'),
				'size'      => 14,
				'slug'      => 'small',
			),
			array(
				'name'      => __('Regular'),
				'shortName' => __('M'),
				'size'      => 16,
				'slug'      => 'normal',
			),
			array(
				'name'      => __('Large'),
				'shortName' => __('L'),
				'size'      => 20,
				'slug'      => 'large',
			),
			array(
				'name'      => __('Extra large'),
				'shortName' => __('XL'),
				'size'      => 26,
				'slug'      => 'huge',
			),
		)
	);
}
add_action('after_setup_theme', 'removeCustomColorsAndSizes');

/**
 * Remove drop cap
 */
add_filter(
	'block_editor_settings',
	function ($editor_settings) {
		$editor_settings['__experimentalFeatures']['global']['typography']['dropCap'] = false;
		return $editor_settings;
	}
);

/**
 * Theme settings
 */

// TODO load theme settings from config!!!!


function theme_settings_page()
{
?>
	<div class="wrap">
		<h1>Theme settings</h1>
		<form method="post" action="options.php">
			<?php
			settings_fields('section');
			do_settings_sections('theme_variables_footer');
			submit_button();
			?>
		</form>
	</div>
<?php
}

function display_theme_variable_credits()
{
	echo '<input type="tel" name="theme_variable_credits" value="' . get_option('theme_variable_credits') . '" size="50">';
}

function display_custom_info_fields()
{
	add_settings_section('section', 'Footer', null, 'theme_variables_footer');

	add_settings_field('theme_variable_credits', 'Credits', 'display_theme_variable_credits', 'theme_variables_footer', 'section');
	register_setting('section', 'theme_variable_credits');
}
add_action('admin_init', 'display_custom_info_fields');

function add_custom_info_menu_item()
{
	add_options_page('Theme settings', 'Theme settings', 'manage_options', 'custom-theme-settings', 'theme_settings_page');
}
add_action('admin_menu', 'add_custom_info_menu_item');
