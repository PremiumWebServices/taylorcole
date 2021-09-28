jQuery(document).ready(function($){

	$( '[data-js="site-menu-toggle"], [data-js="site-menu-close"]' ).click( function( event ){

		event.preventDefault();

		//$('.mobile-menu').toggleClass("is-expanded");
		$( '[data-js="site-menu"]' ).toggleClass( 'is-active' );
		$( '.c-menu__overlay' ).toggleClass( 'is-active' );

	});

	/**
	 * Close menu and remove overlay when overlay is clicked.
	 */
	$( '.c-menu-overlay' ).click( function( event ){

		event.preventDefault();

		$( '[data-js="site-menu"]' ).removeClass( 'is-active' );
		$( '.c-menu__overlay' ).removeClass( 'is-active' );

	});


});
