<?php
/**
 * Block: Marker
 *
 * @package EDGE\Toolkit\Inc\Blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function edge_block_marker_register() {

	// Check ACF is active.
	if ( ! function_exists('acf_register_block') ) {
		return;
	}

	// Register a testimonial block.
	acf_register_block( [
		'name'            => 'marker',
		'title'           => __('Marker'),
		'description'     => __('Add a marker.'),
		'category'        => 'layout',
		'icon'            => 'editor-ol',
		'keywords'        => array(
			'marker',
		),
		'mode'            => 'edit',
		'align'           => 'full',
		'render_template' => 'components/blocks/block-marker.php',
		'supports'        => [
			'align' => false,
		],
	] );

}

add_action(
	'acf/init',
	'edge_block_marker_register'
);
