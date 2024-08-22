<?php

/**
 * Check wheather we are in debug mode
 */
function fs_is_debug()
{
	return defined('WP_DEBUG') && WP_DEBUG === true;
}
