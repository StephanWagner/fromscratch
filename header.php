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

					<div class="search__wrapper">
						<div class="search__container">
							<?= get_search_form() ?>
						</div>
					</div>
				</div>

				<div class="header-menu__toggler-container" onclick="toggleMenu()">
					<div class="main-menu__toggler-icons">
						<div class="main-menu__toggler-icon main-menu__toggler-icon--menu">
							<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px">
								<path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
							</svg>
						</div>
						<div class="main-menu__toggler-icon main-menu__toggler-icon--close">
							<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px">
								<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
							</svg>
						</div>
					</div>
				</div>

			</div>
		</header>
