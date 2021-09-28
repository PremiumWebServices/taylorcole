<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EDGE\TaylorCole
 */

get_header();

?>

<main role="main" id="content">

	<section
		class="c-section c-section--news-list"
		data-analytics=""
		>

		<div
			class="o-container"
			>

				<?php if ( have_posts() ) : ?>
					<div class="c-news-grid">
						<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
								get_template_part(
									'components/card',
									'news'
								);
							endwhile;
						?>
					</div>
				<?php endif; ?>

		</div>

	</section>

</main>

<?php
	get_footer();
