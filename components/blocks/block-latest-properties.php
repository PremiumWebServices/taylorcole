<?php
/**
 * Block: Latest Properties
 *
 * @package EDGE\EDGECreative\Components
 */

$latest_properties_args = [
	'post_type'              => 'sales',
	'orderby'                => 'date',
	'order'                  => 'DESC',
	'posts_per_page'         => 3,
	'update_post_meta_cache' => false,
	'update_post_term_cache' => false,
];

$latest_properties = new WP_Query(
	$latest_properties_args
);

$this_post_type = get_field( 'property_type' );
$this_per_page = get_field( 'per_page' );

?>

<section
	class="c-section c-section--properties"
	data-analytics=""
	>

	<div class="c-section__container">

	<header
		class="c-section__header u-text-center">

		<h2 class="c-title c-title--tertiary">
			Popular Properties
		</h2>
	</header>

		<?php
			if ( $latest_properties->have_posts() ) :
		?>
			<section class="c-section__grid">

				<?php /* Start the Loop */
					while ( $latest_properties->have_posts() ) :
						$latest_properties->the_post();
						// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
						include locate_template(
							'components/property/property-card.php'
						);
					endwhile;
					wp_reset_postdata();
				?>

			</section>

			<?php
			endif;
		?>


		<footer class="c-section__footer c-latest-properties__footer">

			<a href="<?php echo esc_url( get_home_url() ); ?>/properties/" class="c-btn c-btn--tertiary c-btn__all-properties">
				View All Properties
			</a>

		</footer>

	</div>

</section>
