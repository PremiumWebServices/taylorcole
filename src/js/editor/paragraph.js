/**
 * Core / Paragraph
 * Custom function for this theme.
 */

wp.domReady( function() {

	// Add style for hero blocks image treatment.
	wp.blocks.registerBlockStyle(
		'core/paragraph',
		[
			{
			name: 'highlighted',
			label: 'Highlighted'
			}
		]
	);

} );
