<?php
/**
 * Block: Testimonial Carousel
 *
 * @package EDGE\EDGECreative\Components
 */

$testimonial_list_args = [
	'post_type'      => 'edge-testimonials',
	'posts_per_page' => 5,
	'post_status'    => 'publish',
	'order'          => 'DESC',
	'orderby'        => 'date',
];

// Filter results by services taxonomy.
if ( isset($block['data']['services']) ) {

	$testimonial_list_args['tax_query'] = array(
		array(
			'taxonomy' => 'edge-services',
			'field'    => 'term_id',
			'terms'    => $block['data']['services'],
		),
	);

}

$testimonial_list = new WP_Query(
	$testimonial_list_args
);

if ( ! $testimonial_list->have_posts() ) {
	return;
}

?>


<section
	class="c-section c-section--testimonial"
	data-analytics=""
	>

	<div class="c-section__container">

		<header class="c-section__header c-testimonial__header">
				<h2 class="c-title c-title--primary">
					Why Choose Taylor Cole
				</h2>
		</header>

		<section data-slider="testimonials">

		<?php
			while ( $testimonial_list->have_posts() ) :
				$testimonial_list->the_post();
				get_template_part(
					'components/testimonial/testimonial',
					'slide'
				);
			endwhile;
			?>

		</section>

	</div>

</section>

<?php
	wp_reset_postdata();
