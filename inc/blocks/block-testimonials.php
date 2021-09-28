<?php
/**
 * Block Testimonial Carousel.
 *
 * Load custom components via actions.
 *
 * @package    EDGE\EDGECreative\Includes
 * @version    2.0.0
 * @author     EDGE Creative <info@edge-creative.com>
 * @copyright  Copyright (c) 2019 EDGE Creative
 * @license    https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 */

function edge_testimonial_assets() {

	$handle = 'slick-slider';
	$script = 'slick-carousel.1.8.1.min.js';
	$list   = 'enqueued';

	if ( ! wp_script_is( $handle, $list ) ) {
		// Register Slick Slider.
		wp_register_script(
			$handle,
			get_template_directory_uri() . '/dist/js/' . $script,
			array( 'jquery' ),
			null,
			true
		);

		// Load Slick Slider.
		wp_enqueue_script(
			$handle
		);

	}
	// Load Hero Slider.
	wp_add_inline_script(
		$handle,
		"( function( $, window, document, undefined ) {
			$( document ).ready(function() {
				$('[data-slider=\'testimonials\']').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
					dots: true,
					autoplay: true,
					autoplaySpeed: 5000,
					mobileFirst: true,
					adaptiveHeight: true,
				});
			});
		} )( jQuery, window, document );",
		'after'
	);

}


function edge_testimonial_carousel_register() {

	// Check ACF is active.
	if ( ! function_exists('acf_register_block') ) {
		return;
	}

	// Register block.
	acf_register_block(array(
		'name'           => 'testimonial-carousel',
		'title'          => __( 'Testimonial Carousel', 'taylor-cole' ),
		'description'    => __( 'Display carousel of testimonials.', 'taylor-cole' ),
		'enqueue_assets' => 'edge_testimonial_assets',
		'category'       => 'widgets',
		'icon'           => 'admin-page',
		'keywords'       => array(
			'quote',
			'slider'
		),
		'render_template' => 'components/blocks/block-testimonials.php',
		'supports'        => [
			'align' => false,
		],
	));

}

add_action(
	'acf/init',
	'edge_testimonial_carousel_register'
);
