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

do_action( 'EDGE\Hero' );

if ( isset($_GET['type']) )  {
  $this_post_type = sanitize_text_field(wp_unslash($_GET['type']));
}else{
	$this_post_type = 'sales';
}

$this_post_per_page = 6;


$this_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$query_args = rp_get_search_args(
	$this_post_type,
	$this_paged,
	$this_post_per_page
);

$properties = new WP_Query(
	$query_args
);

$count = $properties->found_posts;

?>

<main
	id="content"
	class="c-section--property_listing"
	>

	<?php
		the_content();
	?>

	<div class="c-section--properties_archive">

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

<?php
get_footer();
