<?php
/**
 * Block: Property Listing
 *
 * @package EDGE\EDGECreative\Components
 */



$this_post_type = get_field( 'property_type' );
$this_post_per_page = get_field( 'per_page' );

$this_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$query_args = rp_get_search_args( $this_post_type, $this_paged, $this_post_per_page);
$loop = new WP_Query( $query_args );
$count = $loop->found_posts;

?>

<section
	class="c-section c-section--property_listing"
	data-analytics=""
	>

	<div class="c-section__container">

		<?php if ( !$loop->have_posts() ): ?>
			<h2>No properties found</h2>
			<p>Please try widening your search parameters.</p>
		<?php else: ?>
			<?php while ( $loop->have_posts() ): ?>
			<?php
					$loop->the_post();
					// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
					include locate_template( 'components/property/property-card.php' );
				?>

			<?php endwhile; ?>

			<?php
        	$max_num_pages = $loop->max_num_pages;

        	if ( $max_num_pages > 1 ) {

						$pagination_template = locate_template('components/pagination.php');
						if ( '' !== $pagination_template ) {
							// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
							require $pagination_template;
						}
					}
				?>

				<?php
					wp_reset_postdata();
				?>

			<?php endif; ?>



		<footer class="c-section__footer c-testimonial__footer">
		</footer>

	</div>

</section>
