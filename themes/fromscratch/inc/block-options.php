<?php

/**
 * Scripts
 */
function fs_block_options_scripts()
{
    // Scripts
    $min = fs_is_debug() ? '' : '.min';

    $file = '/js/admin-block-options' . $min . '.js';

    wp_enqueue_script(
        'fromscratch-admin-block-options',
        get_theme_file_uri($file),
        [
            'wp-blocks',
            'wp-element',
            'wp-block-editor',
            'wp-components',
            'wp-i18n'
        ],
        fs_asset_hash(get_theme_file_path($file))
    );
}
add_action('enqueue_block_editor_assets', 'fs_block_options_scripts');
