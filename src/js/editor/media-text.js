
/**
 * Core / Media Text
 * Custom function for this theme.
 */

wp.domReady( function() {

	// Add style for hero blocks image treatment.
	wp.blocks.registerBlockStyle(
		'core/media-text',
		[
			{
			name: 'infographic',
			label: 'Infographic'
			},
			{
				name: 'infographic-primary',
				label: 'Infographic (Primary)'
			}
		]
	);

} );
