<?php
/**
 * Block: Number
 *
 * @package EDGE\Toolkit\Inc\Blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function edge_block_number_marker_register() {

	// Check ACF is active.
	if ( ! function_exists('acf_register_block') ) {
		return;
	}

	// Register a testimonial block.
	acf_register_block( [
		'name'            => 'number-marker',
		'title'           => __('Number Marker'),
		'description'     => __('Add a number marker.'),
		'category'        => 'layout',
		'icon'            => 'editor-ol',
		'keywords'        => array(
			'numbers',
			'marker',
		),
		'mode'            => 'edit',
		'align'           => 'full',
		'supports'        => [
			'align' => false,
		],
	] );

}

add_action(
	'acf/init',
	'edge_block_number_marker_register'
);
