/**
 * Core / Pullquote
 * Custom function for this theme.
 */

wp.domReady( function() {

	// Add style for hero blocks image treatment.
	wp.blocks.registerBlockStyle(
		'edgetoolkit/section',
		[
			{
			name: 't-signature',
			label: 'Signature'
			}
		]
	);

} );
