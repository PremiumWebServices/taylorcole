<?php
/**
 * EDGE template Hooks
 *
 * Action/filter hooks used by EDGE Creative's functions/templates.
 *
 * @package EDGE\Toolkit\Inc
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Hook into wysiwyg output.
 */
add_filter(
	'edge_wysiwyg_field',
	'wptexturize'
);

add_filter(
	'edge_wysiwyg_field',
	'convert_smilies'
);

add_filter(
	'edge_wysiwyg_field',
	'convert_chars'
);

add_filter(
	'edge_wysiwyg_field',
	'wpautop',
	12
);

add_filter(
	'edge_wysiwyg_field',
	'shortcode_unautop'
);

add_filter(
	'edge_wysiwyg_field',
	'prepend_attachment'
);

add_filter(
	'edge_wysiwyg_field',
	'do_shortcode'
);

add_filter(
	'edge_wysiwyg_field',
	[ $wp_embed, 'run_shortcode' ],
	8
);

add_filter(
	'meta_content',
	[ $wp_embed, 'autoembed' ],
	8
);

add_filter(
	'body_class',
	'tc_signature_class'
);


/**
 * Header Append
 *
 * @see edge_load_hero()
 */
add_action(
	'EDGE\Header\Append',
	'edge_load_hero',
	10
);
