<?php
/**
 * Template Name: Mortgate Calculator
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EDGE\TaylorCole\Pages
 */

get_header();

?>

<main
	<?php post_class( ['site-main'] ); ?>
	id="content"
	>

	<section class="c-section c-section--form--mortgage">
		<div class="c-section__container">
			<?php
				get_template_part(
					'components/forms/form',
					'mortgage-calculator'
				);
			?>
		</div>
	</section>

	<section class="c-section c-section--form--borrow">
		<div class="c-section__container">
			<?php
				get_template_part(
					'components/forms/form',
					'borrow-calculator'
				);
			?>
		</div>
	</section>

	<?php
	if ( have_posts() ) :

		/* Start the Loop */
		while ( have_posts() ) :
			the_post(); ?>

			<div class="entry-content">
				<?php
				the_content();
				?>
			</div>

		<?php
		endwhile;

	endif;
	?>

</main><!-- #main -->

<?php
get_footer();
