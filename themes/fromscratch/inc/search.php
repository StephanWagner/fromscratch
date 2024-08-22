<?php

/**
 * Search form
 */
function fs_search_form()
{
	$form = '
		<form role="search" method="get" action="' . home_url('/') . '" >
			<input type="text" value="' . get_search_query() . '" class="search__input" name="s" placeholder="Search...">
			<button type="submit" class="button search__button">Search</button>
		</form>
	';

	return $form;
}
add_filter('get_search_form', 'fs_search_form');
