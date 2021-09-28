/**
 * Core / Pullquote
 * Custom function for this theme.
 */

wp.domReady( function() {

	// Remove default styling
	wp.blocks.unregisterBlockStyle(
		'core/image',
		[ 'rounded' ]
	);

} );
