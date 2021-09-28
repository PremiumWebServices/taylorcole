<?php
/**
 * Template Name: Signature Branding
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

if ( isset($_GET['type']) )  {
  $this_post_type = sanitize_text_field(wp_unslash($_GET['type']));
}else{
	$this_post_type = 'sales';
}

$this_post_per_page = 6;

$this_branchID = 2;

$this_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$query_args = rp_get_search_args(
	$this_post_type,
	$this_paged,
	$this_post_per_page,
	$this_branchID
);

$properties = new WP_Query(
	$query_args
);

$count = $properties->found_posts;

?>

<main
	<?php post_class( ['site-main'] ); ?>
	id="content"
	>

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text">
						<?php single_post_title(); ?>
					</h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post(); ?>

				<div class="entry-content">
					<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', '_s' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );
					?>
				</div>

			<?php
			endwhile;

		endif;
		?>

<div id="results" class="c-section--properties_archive">

		<section class="c-properties-grid">

		<?php if ( !$properties->have_posts() ): ?>
			<h2>No properties found</h2>
			<p>Please try widening your search parameters.</p>
		<?php else: ?>
			<?php while ( $properties->have_posts() ): ?>
			<?php
					$properties->the_post();
					// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
					include locate_template(
						'components/property/property-card.php'
					);
				?>

			<?php endwhile; ?>

			<?php endif; ?>

		</section>

		<nav class="c-pagination">
			<?php
					$max_num_pages = $properties->max_num_pages;

					if ( $max_num_pages > 1 ) {

						$pagination_template = locate_template('components/pagination.php');
						if ( '' !== $pagination_template ) {
							// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
							require $pagination_template;
						}
					}
				?>
		</nav>

		<?php
			wp_reset_postdata();
		?>

	</div>

		</main><!-- #main -->

<section
	class="c-section--cta-bar c-section t-signature"
	id=""
	>
	<div class="o-container">

		<section class="c-section__description u-align-middle">
			<p>To book your free property appraisal <a href="tel:01827311412">call us on 01827 311412</a>
		</section>

	</div>
</section>


<?php
get_footer();
