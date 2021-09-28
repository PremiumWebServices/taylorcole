<?php
/**
 * Media
 *
 * All funcations to control media.
 *
 * @package    EDGE\TaylorCole\Inc
 * @version    1.0.0
 * @author     EDGE Creative <info@edge-creative.com>
 * @copyright  Copyright (c) 2019 EDGE Creative
 * @license    https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 */

/**
 * Custom images sizes required by theme.
 *
 * @version 0.1.0
 * @since   0.1.0
 */
function edge_image_sizes() {

	/**
	 * Property Images
	 */
	add_image_size(
		'tc-property',
		320,
		213,
		array( 'center', 'center' )
	);

	add_image_size(
		'tc-property--small',
		600,
		400,
		array( 'center', 'center' )
	);

	add_image_size(
		'tc-property--medium',
		900,
		600,
		array( 'center', 'center' )
	);

	add_image_size(
		'tc-property--large',
		1200,
		800,
		array( 'center', 'center' )
	);

	add_image_size(
		'tc-property--full',
		1920,
		1280,
		array( 'center', 'center' )
	);

	add_image_size(
		'tc-footer-logos',
		999999,
		34
	);

	add_image_size(
		'tc-footer-logos--medium',
		999999,
		68
	);

	add_image_size(
		'tc-footer-logos--large',
		999999,
		136
	);

}

add_action(
	'after_setup_theme',
	'edge_image_sizes'
);
