<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="page__wrapper">

		<header class="header__wrapper">
			<div class="header__container container">
				<div class="header-menu__wrapper">
					<?php wp_nav_menu([
						'theme_location' => 'header_menu',
						'container' => false,
						'menu_class' => 'header-menu__container'
					]); ?>
				</div>
			</div>
		</header>
