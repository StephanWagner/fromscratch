<?php

/**
 * Scripts
 */
function fs_block_scripts()
{
    // Scripts
    foreach (
        [
            'admin-blocks',
            'admin-block-options'
        ] as $filename
    ) {
        $min = fs_is_debug() ? '' : '.min';

        $file = '/js/' . $filename . $min . '.js';

        wp_enqueue_script(
            'fromscratch-' . $filename,
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
}
add_action('enqueue_block_editor_assets', 'fs_block_scripts');

/**
 * Register blocks
 */
function fs_register_blocks()
{
    global $fs_config_blocks;

    // Register blocks
    foreach ($fs_config_blocks['blocks'] as $block) {
        register_block_type(get_theme_file_path('blocks/' . $block['name']));
    }
}
add_action('init', 'fs_register_blocks');
