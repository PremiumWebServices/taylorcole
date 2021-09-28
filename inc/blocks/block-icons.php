<?php
/**
 * Block: Icon
 *
 * @package EDGE\Toolkit\Inc\Blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function edge_block_icons_register() {

	// Check ACF is active.
	if ( ! function_exists('acf_register_block') ) {
		return;
	}

	// Register a testimonial block.
	acf_register_block( [
		'name'            => 'Icons',
		'title'           => __('Links with Icon Block'),
		'description'     => __('Add a variable-quantity list of icons.'),
		'category'        => 'layout',
		'icon'            => 'media-default',
		'keywords'        => array(
			'icon',
			'icons',
			'links',
			'features',
			'services',
		),
		'mode'            => 'edit',
		'align'           => 'full',
		'render_template' => 'components/blocks/block-icons.php',
		'supports'        => [
			'align' => false,
		],
	] );

}

add_action(
	'acf/init',
	'edge_block_icons_register'
);
