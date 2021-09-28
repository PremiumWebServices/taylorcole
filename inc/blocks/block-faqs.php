<?php
/**
 * Block Frequently Asked Questions.
 *
 * Load custom components via actions.
 *
 * @package    EDGE\EDGECreative\Includes
 * @version    2.0.0
 * @author     EDGE Creative <info@edge-creative.com>
 * @copyright  Copyright (c) 2019 EDGE Creative
 * @license    https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 */

function edge_faqs_register() {


	// check function exists
	if( function_exists('acf_register_block') ) {

		// register the block
		acf_register_block(array(
			'name'				=> 'faqs',
			'title'				=> __('Frequently Asked Questions'),
			'description'		=> __('Display list of questions and answers'),
			'render_callback'	=> 'edge_faqs_block_render',
			'category'			=> 'widgets',
			'icon'				=> 'admin-page',
			'keywords'			=> array( 'frequently', 'questions', 'answers', 'faq' ),
		));
	}
}

add_action(
	'acf/init',
	'edge_faqs_register'
);

function edge_faqs_block_render() {
	if( file_exists( get_theme_file_path("/components/blocks/block-faqs.php") ) ) {
		// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		include( get_theme_file_path("/components/blocks/block-faqs.php") );
	}
}
