<?php
/**
 * Add SVG polyfill for IE 11
 *
 * @package    EDGE\TaylorCole\Includes
 */

function edge_svg4everybody() {
	$handle = 'svg4everybody.2.1.9.min.js';
	// Register SVG4Everybody.
	wp_register_script(
		'svg4everybody',
		get_template_directory_uri() . '/dist/js/' . $handle,
		array(),
		null,
		true
	);

	// Load SVG4Everybody.
	wp_enqueue_script(
		'svg4everybody'
	);

	// Call script inline.
	wp_add_inline_script(
		'svg4everybody',
		"svg4everybody();",
		'after'
	);

}

add_action(
	'wp_enqueue_scripts',
	'edge_svg4everybody'
);
