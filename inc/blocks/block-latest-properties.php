<?php
/**
 * Block Latest Properties.
 *
 * Load custom components via actions.
 *
 * @package    EDGE\EDGECreative\Includes
 * @version    2.0.0
 * @author     EDGE Creative <info@edge-creative.com>
 * @copyright  Copyright (c) 2019 EDGE Creative
 * @license    https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 */

function edge_latest_properties_register() {


	// check function exists
	if( function_exists('acf_register_block') ) {

		// register the block
		acf_register_block(array(
			'name'				=> 'latest-properties',
			'title'				=> __('Latest Properties'),
			'description'		=> __('Display latest 3 properties'),
			'render_callback'	=> 'edge_latest_properties_block_render',
			'category'			=> 'widgets',
			'icon'				=> 'admin-page',
			'keywords'			=> array( 'pages', 'child', 'blog' ),
		));
	}
}

add_action(
	'acf/init',
	'edge_latest_properties_register'
);

function edge_latest_properties_block_render() {
	if( file_exists( get_theme_file_path("/components/blocks/block-latest-properties.php") ) ) {
		// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		include( get_theme_file_path("/components/blocks/block-latest-properties.php") );
	}
}
