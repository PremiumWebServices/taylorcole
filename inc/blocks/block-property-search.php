<?php
/**
 * Block Property Search.
 *
 * Load custom components via actions.
 *
 * @package    EDGE\EDGECreative\Includes
 * @version    2.0.0
 * @author     EDGE Creative <info@edge-creative.com>
 * @copyright  Copyright (c) 2019 EDGE Creative
 * @license    https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 */

function edge_property_search_register() {


	// check function exists
	if( function_exists('acf_register_block') ) {

		// register the block
		acf_register_block(array(
			'name'				=> 'property-search',
			'title'				=> __('Property Search'),
			'description'		=> __('Display property searchs'),
			'render_callback'	=> 'edge_property_search_block_render',
			'category'			=> 'widgets',
			'icon'				=> 'admin-page',
			'keywords'			=> array( 'pages', 'child', 'blog' ),
		));
	}
}

add_action(
	'acf/init',
	'edge_property_search_register'
);

function edge_property_search_block_render() {
	if( file_exists( get_theme_file_path("/components/blocks/block-property-search.php") ) ) {
		// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		include( get_theme_file_path("/components/blocks/block-property-search.php") );
	}
}
