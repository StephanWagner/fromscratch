<?php
return [
	// Disable blogs
	'disable_blogs' => false,

	// Meta tags
	'meta' => [
		'viewport' => 'width=device-width, initial-scale=1',
	],

	// Menus
	'menus' => [
		'header_menu' => 'Header Menü',
		'footer_menu' => 'Footer Menü',
	],

	// The length of excerpts
	'excerpt_length' => 60,

	// The text to show after the excerpt if it was truncated
	'excerpt_more' => '...',

	// Colors
	'theme_colors' => [
		// Black and white
		['slug' => 'white', 'color' => '#fff', 'name' => 'Weiß'],
		['slug' => 'black', 'color' => '#000', 'name' => 'Schwarz'],
		['slug' => 'black-off', 'color' => '#222', 'name' => 'Helleres Schwarz'],

		// Primary colors
		['slug' => 'primary', 'color' => '#00aaff', 'name' => 'Primärfarbe'],
		['slug' => 'secondary', 'color' => '#00ddff', 'name' => 'Sekundärfarbe'],

		// Grayscale
		['slug' => 'gray-1', 'color' => '#666', 'name' => 'Grau 1'],
		['slug' => 'gray-2', 'color' => '#999', 'name' => 'Grau 2'],
		['slug' => 'gray-3', 'color' => '#ccc', 'name' => 'Grau 3'],
		['slug' => 'gray-4', 'color' => '#ddd', 'name' => 'Grau 4'],
		['slug' => 'gray-5', 'color' => '#eee', 'name' => 'Grau 5'],
		['slug' => 'gray-6', 'color' => '#fafafa', 'name' => 'Grau 6'],

		// Status colors
		['slug' => 'error', 'color' => '#f33', 'name' => 'Status: Fehler'],
		['slug' => 'warning', 'color' => '#fc0', 'name' => 'Status: Warnung'],
		['slug' => 'success', 'color' => '#5d5', 'name' => 'Status: Erfolg'],
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
			'name' => 'Regular',
			'shortName' => 'M',
			'size' => 16,
			'slug' => 'm',
		],
		[
			'name' => 'Large',
			'shortName' => 'L',
			'size' => 18,
			'slug' => 'l',
		],
		[
			'name' => 'Extra large',
			'shortName' => 'XL',
			'size' => 22,
			'slug' => 'xl',
		],
	]
];
