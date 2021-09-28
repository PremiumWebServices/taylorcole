<?php
/**
 * EDGE Queue Scripts
 *
 * Dequeue, enqueue, and register scripts
 *
 * @package EDGE\Toolkit\Inc
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Dequeue scripts.
 */
function edge_enqueue_featherlight() {

	if( is_admin() ) {
		return;
	}

	if( ! is_singular( array( 'sales', 'lettings', 'commercial', 'agricultural' ) ) ) {
		return;
	}

	$handle = 'featherlight';
	$script = 'featherlight.1.7.14.min.js';
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

	wp_add_inline_script(
		$handle,
		"( function( $, window, document, undefined ) {
			$( document ).ready(function() {
				console.log('test', $('.c-gallery__secondary a.c-gallery__item') );
				$('.c-gallery__secondary a.c-gallery__item').featherlightGallery({
					gallery: {
						previous: '«',
						next: '»',
						fadeIn: 300
				},
				openSpeed: 300
				});
			});
		} )( jQuery, window, document );",
		'after'
	);

}

add_action(
	'wp_enqueue_scripts',
	'edge_enqueue_featherlight'
);
