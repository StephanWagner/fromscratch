<div class="footer-widget__wrapper">
	<div class="footer-widget__container container">

		<h4>Footer Widget</h4>

		<p>Add content in Wordpress at <a href="/wp-admin/widgets.php">Design › Widgets › Footer</a></p>

		<?php dynamic_sidebar('footer-widget'); ?>

	</div>
</div>

<footer class="footer__wrapper">
	<div class="footer__container container">
		<div class="footer__credits">
			<?php
			if (get_option('theme_variable_credits')) {
				echo get_option('theme_variable_credits');
			} else {
				echo 'Go to <a href="/wp-admin/options-general.php?page=custom-theme-settings">Settings › Theme settings</a> to edit this text';
			}
			?>
		</div>
		<div class="footer-menu__wrapper">
			<?php wp_nav_menu([
				'theme_location' => 'footer_menu',
				'menu_class' => 'footer-menu__container',
				'container' => false
			]); ?>
		</div>
	</div>
</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>
