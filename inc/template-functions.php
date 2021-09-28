<?php
/**
 * EDGE Template
 *
 * Functions for the templating system.
 *
 * @package  EDGE\Toolkit\Inc
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Register Menus
 */
function edge_register_menus() {

	register_nav_menu( 'primary', _x( 'Primary Menu', 'primary menu', 'taylor-cole') );
	register_nav_menu( 'footer-menu', _x( 'Main Footer Menu', 'main footer menu', 'taylor-cole') );

}

add_action( 'init', 'edge_register_menus' );


function new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Add Pagination to page.
 */
function edge_pagination_bar() {
	global $wp_query;
	$total_pages = $wp_query->max_num_pages;
	if ($total_pages > 1){
			$current_page = max(1, get_query_var('paged'));
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo paginate_links(array(
					'base' => get_pagenum_link(1) . '%_%',
					'format' => 'page/%#%/',
					'current' => $current_page,
					'total' => $total_pages,
			));
	}
}

function tc_signature_class( $classes ) {

	if (
		is_page_template( [
		'page-templates/page-fine-village.php',
		'page-templates/page-signature.php'
		] ) ||
		get_post_meta(
			get_the_ID(),
			'branchID',
			true
		) === '2'
		) {
			array_push( $classes, 't-signature' );
	}

	return $classes;

}
