/*

	Theme Name: Private Forum
	Author: Sean Creagh
	Description: Private Forum Theme
	Version: 1.0

*/



( function( $ ) {

	$( document ).ready( function() {

		$( '#Navigation' ).find( '#Login-button' ).click( function() {

			$( '#Login-form' ).slideToggle();

		} );		

		$( '#Navimobile' ).find( '#Login-button' ).click( function() {

			$( '#Login-form' ).slideToggle();

		} );

		$( '.cancel' ).click( function() {

			$( '#Login-form' ).slideToggle();

		} );

		$( '#Navicon' ).click( function() {

			$( '#Navimenu' ).toggle( 'slide' );

		} );

		$( '.menu-cancel' ).click( function() {

			$( '#Navimenu' ).toggle( 'slide' );

		} );

	} );

} )( jQuery );