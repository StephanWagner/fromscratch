<?php

/**
 * Config
 */
$fs_config = include __DIR__ . '/config.php';
$fs_config_variables = include __DIR__ . '/config-variables.php';

/**
 * Bootstrap
 */
require_once 'inc/bootstrap.php';

/**
 * Theme setup
 */
require_once 'inc/theme-setup.php';

/**
 * Head
 */
require_once 'inc/head.php';

/**
 * Assets
 */
require_once 'inc/assets.php';

/**
 * Variables
 */
require_once 'inc/variables.php';

/**
 * Blocks
 */
require_once 'inc/block-options.php';
