<?php
/**
 * Load Templates.
 *
 * Load custom components via actions.
 *
 * @package    EDGE\EDGECreative\Includes
 * @version    1.0.0
 * @author     EDGE Creative <info@edge-creative.com>
 * @copyright  Copyright (c) 2019 EDGE Creative
 * @license    https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 */



/**
 * Load Header.
 */
function edge_load_header() {
	get_template_part( 'components/header' );
}

add_action(
	'EDGE\Header',
	'edge_load_header',
	20
);

/**
 * Load Footer.
 */
function edge_load_footer() {
	get_template_part( 'components/footer' );
}

add_action(
	'EDGE\Footer',
	'edge_load_footer',
	50
);
