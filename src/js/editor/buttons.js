/**
 * Core / Pullquote
 * Custom function for this theme.
 */

wp.domReady( function() {

	// Remove default styling
	wp.blocks.unregisterBlockStyle(
		'core/button',
		[ 'default', 'outline', 'squared', 'fill' ]
	);

	// Add style for hero blocks image treatment.
	wp.blocks.registerBlockStyle(
		'core/button',
		[
			{
			name: 'c-btn--tertiary',
			label: 'Tertiary'
			}
		]
	);

} );
