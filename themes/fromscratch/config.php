<?php
return [
	// The meta content for viewport
	'meta_viewport' => 'width=device-width',

	// Disable blogs
	'disable_blogs' => false,

	// The length of excerpts
	'custom_excerpt_length' => 60,

	// The text to show after the excerpt if it was truncated
	'custom_excerpt_more' => '...',

	// Colors
	'theme_colors' => [
		// Black and white
		['slug' => 'white', 'color' => '#fff', 'name' => 'White'],
		['slug' => 'black', 'color' => '#000', 'name' => 'Black'],

		// Primary colors
		['slug' => 'primary', 'color' => '#00aaff', 'name' => 'Primary color'],
		['slug' => 'secondary', 'color' => '#00ddff', 'name' => 'Secondary color'],

		// Grayscale
		['slug' => 'gray-1', 'color' => '#666', 'name' => 'Gray 1'],
		['slug' => 'gray-2', 'color' => '#999', 'name' => 'Gray 2'],
		['slug' => 'gray-3', 'color' => '#ccc', 'name' => 'Gray 3'],
		['slug' => 'gray-4', 'color' => '#ddd', 'name' => 'Gray 4'],
		['slug' => 'gray-5', 'color' => '#eee', 'name' => 'Gray 5'],
		['slug' => 'gray-6', 'color' => '#fafafa', 'name' => 'Gray 6'],

		// Status colors
		['slug' => 'error', 'color' => '#f33', 'name' => 'Status: Error'],
		['slug' => 'warning', 'color' => '#fc0', 'name' => 'Status: Warning'],
		['slug' => 'success', 'color' => '#5d5', 'name' => 'Status: Success'],
	],

	// Font sizes
	'theme_font_sizes' => [
		[
			'name' => 'Small',
			'shortName' => 'S',
			'size' => 14,
			'slug' => 's',
		],
		[
			'name' => 'Medium',
			'shortName' => 'M',
			'size' => 16,
			'slug' => 'm',
		],
		[
			'name' => 'Large',
			'shortName' => 'L',
			'size' => 24,
			'slug' => 'l',
		],
		[
			'name' => 'Extra large',
			'shortName' => 'XL',
			'size' => 32,
			'slug' => 'xl',
		],
	]
];
