<?php
/**
 * Functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package EDGE\Toolkit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Load functions files
 */
$function_includes = [
	'inc/version.php',
	'inc/queue-styles.php',
	'inc/queue-scripts.php',
	'inc/media.php',
	'inc/svg4everybody.php',
	'inc/featherlight.php',
	'inc/template-tags.php',
	'inc/template-functions.php',
	'inc/template-hooks.php',
	'inc/blocks/block-calculator-links.php',
	'inc/blocks/block-testimonials.php',
	'inc/blocks/block-property-listing.php',
	'inc/blocks/block-property-search.php',
	'inc/blocks/block-latest-properties.php',
	'inc/blocks/block-faqs.php',
	'inc/blocks/block-cta-bar.php',
	'inc/components.php',
	'inc/property.php',
	'inc/property_search.php',
	'inc/currency_functions.php',
	'inc/hero.php',
	'inc/blocks/block-number-marker.php',
	'inc/blocks/block-icons.php',
	'inc/blocks/block-marker.php',
	'inc/blocks/block-christmas-banner.php',
];

foreach ( $function_includes as $file ) {

	$filepath = locate_template( $file );

	if ( ! $filepath ) {

		do_action(
			'wonolog.log',
			[
				'message' => '[Toolkit] Function file missing.',
				'level'   => 'WARNING',
				'context' => [
					$filepath
				],
			]
		);

		continue;

	}

	// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	require $filepath;

}

unset( $file, $filepath );

/**
 * Setup Theme
 *
 * @return void
 */
function edge_toolkit_theme_setup() {

	load_theme_textdomain(
		'taylor-cole',
		get_template_directory() . '/languages'
	);

	add_theme_support(
		'editor-styles'
	);

	add_editor_style(
		'editor.min.css'
	);

	add_theme_support(
		'title-tag'
	);

	// Disable custom color picker for blocks.
	add_theme_support(
		'disable-custom-colors'
	);

	// Disable color palette selector for blocks.
	add_theme_support(
		'editor-color-palette'
	);

	add_theme_support(
		'disable-custom-font-sizes'
	);

}

add_action(
	'after_setup_theme',
	'edge_toolkit_theme_setup'
);

/*
* Prevent ACF from removing default meta boxes
*/
add_filter('acf/settings/remove_wp_meta_box', '__return_false');

/**
 * Update Taxonomy WP Query
 *
 * @param object $query
 *
 * @return object
 */
function edge_testimonial_wp_query( $query ) {

	// Check we are in the archives query.
	if ( ! $query->is_main_query() ) {
		return;
	}

	// Check we are not in the admin area.
	if ( is_admin() ) {
		return;
	}

	// Check we are in the right post type.
	if ( ! is_post_type_archive( 'edge-testimonials' ) ) {
		return;
	}

	// Set order by `menu_order` then `name`.
	$query->set(
		'orderby',
		array(
			'menu_order' => 'ASC',
			'date'       => 'DESC',
		)
	);

	$query->set(
		'update_post_meta_cache',
		'false'
	);

	$query->set(
		'update_post_term_cache',
		'false'
	);

	return $query;

}

add_action(
	'pre_get_posts',
	'edge_testimonial_wp_query',
	20
);

/**
 * Update Taxonomy WP Query
 *
 * @param object $query
 *
 * @return object
 */
function tc_team_wp_query( $query ) {

	// Check we are in the archives query.
	if ( ! $query->is_main_query() ) {
		return;
	}

	// Check we are not in the admin area.
	if ( is_admin() ) {
		return;
	}

	// Check we are in the right post type.
	if ( ! is_post_type_archive( 'edge_team' ) ) {
		return;
	}

	// Set order by `menu_order` then `name`.
	$query->set(
		'orderby',
		array(
			'menu_order' => 'DESC',
			'title'      => 'ASC',
		)
	);

	return $query;

}

add_action(
	'pre_get_posts',
	'tc_team_wp_query',
	20
);

/**
 * Contact form.
 */
function contact_form_redirect(){
	require_once get_theme_file_path( '/components/forms/handler-contact-form.php');

  $result = null;
  if ( isset( $_POST['contact_submit'] ) ) {

    $result = validate_contact_form( $_POST );

    if ( $result['sent'] ) {
			$thankyou_url = get_permalink(
				isset( $_POST['contact_thankyou'] ) ? sanitize_text_field(wp_unslash($_POST['contact_thankyou'])) : ''
			);
      // Permalink with explicit hash to override redirect to bottom of page
      wp_redirect( esc_url($thankyou_url) . '#' );
      exit();

    }

  }
}
add_action( 'template_redirect', 'contact_form_redirect' );


/**
 * Buying search form.
 */
function search_form_redirect(){

		if ( isset( $_GET['search_submit'] ) ) {
			//phpcs:ignore
			$_SERVER['QUERY_STRING'] = str_replace( 'search_submit=true' ,'' , $_SERVER['QUERY_STRING'] );
			if ( isset( $_GET['signature'] ) ) {
				//phpcs:ignore
				wp_redirect( esc_url('/signature') . '?' .  $_SERVER['QUERY_STRING']  . '#results'  );
			}else{
				//phpcs:ignore
				wp_redirect( esc_url('/properties') . '?' . $_SERVER['QUERY_STRING']  . '#content' );
			}
		}

}
add_action( 'template_redirect', 'search_form_redirect' );


/**
 * Add exclude list for EDGE Forms.
 */
function edge_add_exclude_form_meta( $args ) {

	$exclude_list = [
		'_wp_http_referer',
		'recaptcha_response',
		'contact_submit',
		'contact_nonce',
		'contact_thankyou',
	];

	$args = wp_parse_args(
		$exclude_list,
		$args
	);

	return $args;

}

add_filter(
	'EDGE\Forms\Record\Exclude',
	'edge_add_exclude_form_meta'
);


/* 
	Recaptcha functionality
*/

function getCaptchaScore() {
	$recaptcha_secret   = '6Lc7cNkZAAAAAP1Lx5tP94_CT6dDblqIFkhZ9TSF';
	$recaptcha_response = $_POST['recaptcha_response'];

    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'secret' => $recaptcha_secret,
            'response' => $recaptcha_response,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ],
        CURLOPT_RETURNTRANSFER => true
    ]);
    
    $output = curl_exec($ch);
    curl_close($ch);
    
    $recaptcha = json_decode($output);
	return $recaptcha->score;
}