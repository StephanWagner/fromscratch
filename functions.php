<?php

/**
 * Get an option from the config file
 */
$fromscratch_config = include __DIR__ . '/config.php';

function fromscratch_config($key)
{
	global $fromscratch_config;

	if (isset($fromscratch_config[$key])) {
		return $fromscratch_config[$key];
	}

	return null;
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
	echo '<meta charset="utf-8">' . "\n";
	foreach ([
		'meta_viewport',
		'meta_title',
		'meta_description',
	] as $config_key) {
		if (!empty(fromscratch_config($config_key))) {
			echo '<meta name="' . str_replace('meta_', '', $config_key) . '" content="' . fromscratch_config($config_key) . '">' . "\n";
		}
	}
}
add_action('wp_head', 'fromscratch_meta_tags');

/**
 * Custom Search
 */
function html5_search_form()
{
	$form = '<section class="search"><form role="search" method="get" action="' . home_url('/') . '" >
	<input type="text" value="' . get_search_query() . '" class="search__input" name="s" placeholder="Suche...">
	<button type="submit" value="" class="search__button icon-search"></button>
	</form></section>';
	return $form;
}

add_filter('get_search_form', 'html5_search_form');

/**
 * Allow editors to edit menus
 */
$role_object = get_role('editor');
$role_object->add_cap('edit_theme_options');

/**
 * Change excerpt length
 */
function custom_excerpt_length()
{
	return 60;
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
	return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');

/**
 * Remove wordpress generated links and scripts
 */
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
				'name'      => __('Klein'),
				'shortName' => __('S'),
				'size'      => 14,
				'slug'      => 'small',
			),
			array(
				'name'      => __('Regulär'),
				'shortName' => __('M'),
				'size'      => 16,
				'slug'      => 'normal',
			),
			array(
				'name'      => __('Groß'),
				'shortName' => __('L'),
				'size'      => 20,
				'slug'      => 'large',
			),
			array(
				'name'      => __('Sehr groß'),
				'shortName' => __('XL'),
				'size'      => 26,
				'slug'      => 'huge',
			),
		)
	);
}
add_action('after_setup_theme', 'removeCustomColorsAndSizes');

// Remove default drop cap

add_filter(
	'block_editor_settings',
	function ($editor_settings) {
		$editor_settings['__experimentalFeatures']['global']['typography']['dropCap'] = false;
		return $editor_settings;
	}
);

/**
 * Theme options
 */
function theme_settings_page()
{
?>
	<div class="wrap">
		<h1>Theme Einstellungen</h1>
		<form method="post" action="options.php">
			<?php
			settings_fields('section');
			do_settings_sections('theme_variables_contact');
			do_settings_sections('theme_variables_social');
			do_settings_sections('theme_variables_homepage');
			do_settings_sections('theme_variables_downloads');
			submit_button();
			?>
		</form>
	</div>
<?php
}

function display_theme_variable_phone()
{
	echo '<input type="tel" name="theme_variable_phone" value="' . get_option('theme_variable_phone') . '" size="50">';
}

function display_theme_variable_email()
{
	echo '<input type="email" name="theme_variable_email" value="' . get_option('theme_variable_email') . '" size="50">';
}

function display_theme_variable_address()
{
	echo '<textarea name="theme_variable_address" cols="50" rows="5">' . get_option('theme_variable_address') . '</textarea>';
}

function display_theme_variable_instagram()
{
	echo '<input type="text" name="theme_variable_instagram" value="' . get_option('theme_variable_instagram') . '" size="50">';
}

function display_theme_variable_facebook()
{
	echo '<input type="text" name="theme_variable_facebook" value="' . get_option('theme_variable_facebook') . '" size="50">';
}

function display_theme_variable_slider_id()
{
	echo '<input type="number" name="theme_variable_slider_id" value="' . get_option('theme_variable_slider_id') . '" size="5">';
}

function display_theme_variable_contact_map()
{
	echo '<input type="text" name="theme_variable_contact_map" value="' . get_option('theme_variable_contact_map') . '" size="50">';
}

function display_theme_variable_footer_title()
{
	echo '<input type="text" name="theme_variable_footer_title" value="' . get_option('theme_variable_footer_title') . '" size="50">';
}

function display_theme_variable_footer_text()
{
	echo '<textarea name="theme_variable_footer_text" cols="50" rows="5">' . get_option('theme_variable_footer_text') . '</textarea>';
}

function display_theme_variable_inquiry_button1()
{
	echo '<input type="text" name="theme_variable_inquiry_button1_title" placeholder="Button-Text" value="' . get_option('theme_variable_inquiry_button1_title') . '" size="30">';
	echo '<input type="number" name="theme_variable_inquiry_button1_form_id" placeholder="Formular ID" value="' . get_option('theme_variable_inquiry_button1_form_id') . '" size="5">';
}

function display_theme_variable_inquiry_button2()
{
	echo '<input type="text" name="theme_variable_inquiry_button2_title" placeholder="Button-Text" value="' . get_option('theme_variable_inquiry_button2_title') . '" size="30">';
	echo '<input type="number" name="theme_variable_inquiry_button2_form_id" placeholder="Formular ID" value="' . get_option('theme_variable_inquiry_button2_form_id') . '" size="5">';
}

function getDownloadFields($nr)
{
	echo '<input type="text" name="theme_variables_download' . $nr . '_title" placeholder="Titel" value="' . get_option('theme_variables_download' . $nr . '_title') . '" size="20">';
	echo '<input type="text" name="theme_variables_download' . $nr . '_url" placeholder="URL zur Datei" value="' . get_option('theme_variables_download' . $nr . '_url') . '" size="50">';
}

function display_theme_variables_download1()
{
	getDownloadFields(1);
}

function display_theme_variables_download2()
{
	getDownloadFields(2);
}

function display_theme_variables_download3()
{
	getDownloadFields(3);
}

function display_theme_variables_download4()
{
	getDownloadFields(4);
}

function display_theme_variables_download5()
{
	getDownloadFields(5);
}

function display_theme_variables_download6()
{
	getDownloadFields(6);
}

function display_theme_variables_download7()
{
	getDownloadFields(7);
}

function display_theme_variables_download8()
{
	getDownloadFields(8);
}

function display_theme_variables_download9()
{
	getDownloadFields(9);
}

function display_theme_variables_download10()
{
	getDownloadFields(10);
}

function display_custom_info_fields()
{
	add_settings_section('section', 'Kontakt Informationen', null, 'theme_variables_contact');

	add_settings_field('theme_variable_phone', 'Telefon', 'display_theme_variable_phone', 'theme_variables_contact', 'section');
	register_setting('section', 'theme_variable_phone');

	add_settings_field('theme_variable_email', 'E-Mail Adresse', 'display_theme_variable_email', 'theme_variables_contact', 'section');
	register_setting('section', 'theme_variable_email');

	add_settings_field('theme_variable_address', 'Adresse', 'display_theme_variable_address', 'theme_variables_contact', 'section');
	register_setting('section', 'theme_variable_address');

	add_settings_section('section', 'Social Media', null, 'theme_variables_social');

	add_settings_field('theme_variable_instagram', 'Instagram Benutzername', 'display_theme_variable_instagram', 'theme_variables_social', 'section');
	register_setting('section', 'theme_variable_instagram');

	add_settings_field('theme_variable_facebook', 'Facebook Benutzername', 'display_theme_variable_facebook', 'theme_variables_social', 'section');
	register_setting('section', 'theme_variable_facebook');

	add_settings_section('section', 'Startseite', null, 'theme_variables_homepage');

	add_settings_field('theme_variable_slider_id', 'Slider ID<br>(Siehe MetaSlider)', 'display_theme_variable_slider_id', 'theme_variables_homepage', 'section');
	register_setting('section', 'theme_variable_slider_id');

	add_settings_field('theme_variable_contact_map', 'Kontakt-Karte URL<br>(Siehe Medien)', 'display_theme_variable_contact_map', 'theme_variables_homepage', 'section');
	register_setting('section', 'theme_variable_contact_map');

	add_settings_field('theme_variable_footer_title', 'Anfrage: Titel', 'display_theme_variable_footer_title', 'theme_variables_homepage', 'section');
	register_setting('section', 'theme_variable_footer_title');

	add_settings_field('theme_variable_footer_text', 'Anfrage: Text', 'display_theme_variable_footer_text', 'theme_variables_homepage', 'section');
	register_setting('section', 'theme_variable_footer_text');

	add_settings_field('theme_variable_inquiry_button1', 'Button Schadensmeldung', 'display_theme_variable_inquiry_button1', 'theme_variables_homepage', 'section');
	register_setting('section', 'theme_variable_inquiry_button1_title');
	register_setting('section', 'theme_variable_inquiry_button1_form_id');

	add_settings_field('theme_variable_inquiry_button2', 'Button: Wertgutachten', 'display_theme_variable_inquiry_button2', 'theme_variables_homepage', 'section');
	register_setting('section', 'theme_variable_inquiry_button2_title');
	register_setting('section', 'theme_variable_inquiry_button2_form_id');

	add_settings_section('section', 'Downloads', null, 'theme_variables_downloads');

	for ($i = 1; $i <= 10; $i++) {
		add_settings_field('theme_variables_download' . $i, 'Download ' . $i, 'display_theme_variables_download' . $i, 'theme_variables_downloads', 'section');
		register_setting('section', 'theme_variables_download' . $i . '_title');
		register_setting('section', 'theme_variables_download' . $i . '_url');
	}
}


add_action('admin_init', 'display_custom_info_fields');

function add_custom_info_menu_item()
{
	add_options_page('Theme Einstellungen', 'Theme Einstellungen', 'manage_options', 'custom-theme-settings', 'theme_settings_page');
}

add_action('admin_menu', 'add_custom_info_menu_item');

// Custom image with description excerpt

function imageWithDescriptionExcerpt($text, $limit)
{
	$excerpt = explode(' ', $text, $limit);

	if (count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt) . '...';
	} else {
		$excerpt = implode(" ", $excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

	return $excerpt;
}

// Add title tag

add_theme_support('title-tag');
