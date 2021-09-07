<?php
/*
Template Name: Home
Template Post Type: post, page
*/
?>

<?php get_header(); ?>

<div class="content__wrapper">
	<div class="content__container container">

		<h1>Different template for home page</h1>

		<h2><?php the_title(); ?></h2>

		<?php
		if (have_posts()) {
			while (have_posts()) {
				the_post();
				the_content();
			}
		}
		?>
	</div>
</div>

<?php get_footer(); ?>
