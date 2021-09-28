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
function edge_enqueue_scripts() {


	global $edge_theme_version;

	if( ! is_admin() ) {

		wp_register_script(
			'taylorcole_scripts_global',
			get_stylesheet_directory_uri() . '/dist/js/global.min.js',
			array('jquery'),
			$edge_theme_version,
			'all'
		);

		wp_enqueue_script(
			'taylorcole_scripts_global'
		);

		$tc_tab_open = '0';

		$current_post_type = null;

		if ( isset($_GET['type']) )  {
			$current_post_type = get_post_type( get_the_ID() );
		}

		if (
			is_page( [199, 188, 10859] ) || ( $current_post_type === 'sales' )
			) {
			$tc_tab_open = '1';
		}

		if ( is_page( [192] ) || ( $current_post_type === 'lettings') ) {
			$tc_tab_open = '2';
		}

		wp_deregister_script("sirus-recaptcha");
		wp_register_script(
			"sirus-recaptcha",
			"//www.google.com/recaptcha/api.js",
			false,
			false,
			true
		);
		wp_enqueue_script("sirus-recaptcha");
		
		wp_add_inline_script(
			'taylorcole_scripts_global',
			'var tabs = new Tabs({
				elem: "hero-search-tabs",
				open: ' . $tc_tab_open . '
			});',
			'after'
		);

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
					$('[data-slider=\'property-single-gallery\']').slick({
						slidesToShow: 3,
						slidesToScroll: 2,
						arrows: false,
						dots: false,
						autoplay: true,
						autoplaySpeed: 2000,
						mobileFirst: true,
						adaptiveHeight: true,
						responsive: [
							{
								breakpoint: 900,
								settings: {
									slidesToShow: 4,
									slidesToScroll: 3,
								}
							},
							{
								breakpoint: 1024,
								settings: {
									slidesToShow: 5,
									slidesToScroll: 3,
								}
							},
						],
					});
				});
			} )( jQuery, window, document );",
			'after'
		);

	}

	if( is_singular( 'sales' ) OR is_singular( 'lettings' )){
		wp_register_script (
			'booking_validation',
			get_stylesheet_directory_uri() . '/dist/js/booking-validation.js',
			false,
			false,
			true
		);
		wp_enqueue_script (
			'booking_validation'
		);
	}


	if(
		is_page_template( 'page-templates/page-contact.php' )
		){
		wp_register_script (
			'contact_validation',
			get_stylesheet_directory_uri() . '/dist/js/contact-validation.js',
			array( 'jquery' ),
			false,
			true
		);
		wp_enqueue_script (
			'contact_validation'
		);
	}



	if(
		is_page_template( 'page-templates/page-stamp-duty.php' )
		){
		wp_register_script (
			'stamp_duty_validation',
			get_stylesheet_directory_uri() . '/dist/js/stamp-duty-validation.js',
			array( 'jquery' ),
			false,
			true
		);
		wp_enqueue_script (
			'stamp_duty_validation'
		);
	}

}

add_action(
	'wp_enqueue_scripts',
	'edge_enqueue_scripts'
);

/**
 * Customise blocks.
 */
function edge_gutenberg_scripts() {

	if( ! is_admin() ) {
		return;
	}

	wp_enqueue_script(
		'toolkit-editor',
		get_stylesheet_directory_uri() . '/dist/js/editor.min.' . EDGE_THEME_VERSION .'.js',
		array( 'wp-blocks', 'wp-dom' ),
		null,
		true
	);

}

add_action(
	'enqueue_block_editor_assets',
	'edge_gutenberg_scripts'
);

/**
 * Dequeue scripts.
 */
function edge_dequeue_scripts() {

	if( is_admin() ) {
		return;
	}

	// Use latest version of jQuery for front-end.
	wp_deregister_script(
		// phpcs:ignore WPThemeReview.CoreFunctionality.NoDeregisterCoreScript.Found
		'jquery'
	);

	wp_register_script(
		'jquery',
		get_template_directory_uri() . '/dist/js/jquery.min.js',
		false,
		null,
		true
	);

	wp_enqueue_script(
		'jquery'
	);

}

add_action(
	'wp_print_scripts',
	'edge_dequeue_scripts',
	100
);
