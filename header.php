<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="page__wrapper">

		<header class="header__wrapper">
			<div class="header__container container">

				<div class="logo__container">
					<img src="<?= get_template_directory_uri() ?>/img/logo.png" class="logo__image" alt="">
				</div>

				<div class="header-menu__wrapper">
					<?php wp_nav_menu([
						'theme_location' => 'header_menu',
						'container' => false,
						'menu_class' => 'header-menu__container'
					]); ?>
				</div>
			</div>
		</header>
