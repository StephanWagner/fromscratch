<?php

add_action('wp_nav_menu_item_custom_fields', function ($item_id, $item) {
	$is_button = get_post_meta($item_id, '_menu_item_is_button', true);
?>
	<p class="description description-wide">
		<label>
			<input type="checkbox"
				name="menu-item-is-button[<?php echo esc_attr($item_id); ?>]"
				value="1"
				<?php checked($is_button, '1'); ?>>
				<?php echo fs_t('MENU_SHOW_AS_BUTTON'); ?>
		</label>
	</p>
<?php
}, 10, 2);

add_action('wp_update_nav_menu_item', function ($menu_id, $menu_item_db_id) {
	$value = isset($_POST['menu-item-is-button'][$menu_item_db_id]) ? '1' : '';
	update_post_meta($menu_item_db_id, '_menu_item_is_button', $value);
}, 10, 2);

add_filter('nav_menu_css_class', function ($classes, $item) {
	if (get_post_meta($item->ID, '_menu_item_is_button', true)) {
		$classes[] = 'menu-item-is-button';
	}
	return $classes;
}, 10, 2);
