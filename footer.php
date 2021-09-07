
<footer class="footer__wrapper">
	<div class="footer__container container">
		<div class="footer-menu__wrapper">
			<?php wp_nav_menu([
				'theme_location' => 'footer_menu',
				'container' => false,
				'menu_class' => 'footer-menu__container'
			]); ?>
		</div>
	</div>
</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
