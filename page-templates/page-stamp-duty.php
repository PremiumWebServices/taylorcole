<?php
/**
 * Template Name: Stamp Duty Calculator
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

				<section class="c-section c-section--form--stamp-duty">
					<div class="c-section__container">
						<?php
							get_template_part(
								'components/forms/form',
								'stamp-duty'
							);
						?>
					</div>
				</section>

				<section class="c-section c-section--form-stamp-duty-results">
					<div class="c-section__container">
							<div class="c-form">
						<header class="c-section__header">
							<h2 class="c-title c-title--primary u-align-center">Stamp Duty Due</h2>
						</header>

						<div class="c-section__content" id="stamp-result">
							<p>Calculating...</p>
						</div>
						</div>
					</div>
				</section>

			<?php
			endwhile;

		endif;
		?>

		</main><!-- #main -->

<?php
get_footer();
