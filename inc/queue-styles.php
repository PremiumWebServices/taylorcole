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
 * Load the parent and child theme styles
 */
function edge_theme_style() {

  wp_register_style(
		'toolkit',
		get_template_directory_uri() . '/style.min.css',
		null,
		null,
		'all'
  );

	wp_enqueue_style(
    'toolkit'
	);

}

add_action(
	'wp_enqueue_scripts',
	'edge_theme_style'
);

/**
 * Dequeue styles.
 */
function edge_dequeue_styles() {

}

add_action(
	'wp_print_styles',
	'edge_dequeue_styles',
	100
);
