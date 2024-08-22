<?php

/**
 * Get the hash for assets
 */
function fs_asset_hash($file)
{
	// Return time when debugging
	if (fs_is_debug()) {
		return time();
	}

	return filemtime(get_template_directory() . $file);
}

/**
 * Stylesheets
 */
function fs_styles()
{
	$min = fs_is_debug() ? '' : '.min';

	$file = '/css/main' . $min . '.css';

	wp_enqueue_style(
		'main-styles',
		get_template_directory_uri() . $file,
		[],
		fs_asset_hash($file),
		'all'
	);
}
add_action('wp_enqueue_scripts', 'fs_styles');

/**
 * Admin stylesheets
 */
function fs_admin_styles()
{
	$min = fs_is_debug() ? '' : '.min';

	$file = '/css/admin' . $min . '.css';
	wp_enqueue_style(
		'main-admin-styles',
		get_template_directory_uri() . $file,
		[],
		fs_asset_hash($file),
		'all'
	);
}
add_action('admin_enqueue_scripts', 'fs_admin_styles');

/**
 * Scripts
 */
function fs_scripts()
{
	$min = fs_is_debug() ? '' : '.min';

	$file = '/js/main' . $min . '.js';

	wp_enqueue_script(
		'main-scripts',
		get_template_directory_uri() . $file,
		[],
		fs_asset_hash($file),
		true
	);
}
add_action('wp_enqueue_scripts', 'fs_scripts');

/**
 * Admin scripts
 */
function fs_admin_scripts()
{
	$min = fs_is_debug() ? '' : '.min';

	$file = '/js/admin' . $min . '.js';

	wp_enqueue_script(
		'main-admin-scripts',
		get_template_directory_uri() . $file,
		[],
		fs_asset_hash($file),
		true
	);
}
add_action('admin_enqueue_scripts', 'fs_admin_scripts');

/**
 * Admin block options scripts
 */
function fs_admin_block_options_scripts()
{
	$min = fs_is_debug() ? '' : '.min';

	$file = '/js/admin-block-options' . $min . '.js';

	wp_enqueue_script(
		'main-block-options',
		get_template_directory_uri() . $file,
		['wp-blocks', 'wp-element', 'wp-components', 'wp-editor'],
		fs_asset_hash($file)
	);
}
add_action('enqueue_block_editor_assets', 'fs_admin_block_options_scripts');
