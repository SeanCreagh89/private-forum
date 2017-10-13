/*

	Theme Name: Private Forum
	Author: Sean Creagh
	Description: Save data input as custom post type
	Version: 1.0

*/



( function( $ ) {

	$( document ).ready( function() {

		var submit = document.getElementById( 'report-submit' );

		var admin_ajax_request = function ( form_data, action ) {

			$.ajax( {

				type: 'POST',
				dataType: 'json',
				url: screen_reader_text.admin_ajax,
				data: {

					action: action,
					data: form_data,
					submission: document.getElementById( 'o66' ).value,
					security: screen_reader_text.security

				},
				success: function( response ) {

					if ( true === response.success ) {

						document.getElementById( 'success-log' ).innerHTML = 'Your report has been saved to the directory';
						document.getElementById( 'owner_field' ).value = "";
						document.getElementById( 'make_field' ).value = "";
						document.getElementById( 'model_field' ).value = "";
						document.getElementById( 'registration_field' ).value = "";
						document.getElementById( 'colour_field' ).value = "";
						document.getElementById( 'description_field' ).value = "";
						$( '.form-wrapper' ).slideToggle();

					} else {

						document.getElementById( 'required' ).innerHTML = 'You report was not saved. Please check your details for any errors';

					}

				}

			} );

		};

		submit.addEventListener( 'click', function( event ) {

			event.preventDefault();

			var error = 0;

			var owner = document.getElementById( 'owner_field' ).value;
			var make = document.getElementById( 'make_field' ).value;
			var model = document.getElementById( 'model_field' ).value;
			var registration = document.getElementById( 'registration_field' ).value;
			var colour = document.getElementById( 'colour_field' ).value;
			var description = document.getElementById( 'description_field' ).value;

			var string_exp = new RegExp( "^[ a-zA-Z]+$" );
			var registration_exp = new RegExp( "^[0-9]{2,3}\-[A-Z]{1,2}\-[A-Z0-9]{1,5}$");
			var description_exp = new RegExp( "^[ a-zA-Z0-9.,'!?()-€]+$" );

			if ( !string_exp.test( owner ) ) {

				$( '#owner_field' ).css( { 'border-color' : '#cd0000' } );

				if ( owner == "" ) {

					document.getElementById( 'owner_message' ).innerHTML = "This is a required field.";

				} else {

					document.getElementById( 'owner_message' ).innerHTML = "Invalid Owner Name. e.g. John Smith.";

				}

				$( '#owner_field' ).focusin( function() {

					$( this ).next( '.error-message' ).show()

				} );

				$( '#owner_field' ).focusout( function() {

					$( this ).next( '.error-message' ).hide();

				} );

				++error;

			} else {

				$( '#owner_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'owner_message' ).innerHTML = "";

			}

			if ( !string_exp.test( make ) ) {

				$( '#make_field' ).css( { 'border-color' : '#cd0000' } );

				if ( make == "" ) {

					document.getElementById( 'make_message' ).innerHTML = "This is a required field.";

				} else {

					document.getElementById( 'make_message' ).innerHTML = "Invalid Make. e.g. Ford, Toyota, KIA, etc.";
					
				}

				$( '#make_field' ).focusin( function() {

					$( this ).next( '.error-message' ).show()

				} );

				$( '#make_field' ).focusout( function() {

					$( this ).next( '.error-message' ).hide();

				} );

				++error;

			} else {

				$( '#make_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'make_message' ).innerHTML = "";

			}

			if ( !string_exp.test( model ) ) {

				$( '#model_field' ).css( { 'border-color' : '#cd0000' } );

				if ( model == "" ) {

					document.getElementById( 'model_message' ).innerHTML = "This is a required field.";

				} else {

					document.getElementById( 'model_message' ).innerHTML = "Invalid Model. e.g. Mondeo, Corolla, Sportage, etc.";
					
				}

				$( '#model_field' ).focusin( function() {

					$( this ).next( '.error-message' ).show()

				} );

				$( '#model_field' ).focusout( function() {

					$( this ).next( '.error-message' ).hide();

				} );

				++error;

			} else {

				$( '#model_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'model_message' ).innerHTML = "";

			}

			if ( !registration_exp.test( registration ) ) {

				$( '#registration_field' ).css( { 'border-color' : '#cd0000' } );

				if ( registration == "" ) {

					document.getElementById( 'registration_message' ).innerHTML = "This is a required field.";

				} else {

					document.getElementById( 'registration_message' ).innerHTML = "Invalid Registration. e.g. 01-LS-100 or 121-LS-10000.";
					
				}

				$( '#registration_field' ).focusin( function() {

					$( this ).next( '.error-message' ).show()

				} );

				$( '#registration_field' ).focusout( function() {

					$( this ).next( '.error-message' ).hide();

				} );

				++error;

			} else {

				$( '#registration_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'registration_message' ).innerHTML = "";

			}

			if ( !string_exp.test( colour ) ) {

				$( '#colour_field' ).css( { 'border-color' : '#cd0000' } );

				if ( colour == "" ) {

					document.getElementById( 'colour_message' ).innerHTML = "This is a required field.";

				} else {

					document.getElementById( 'colour_message' ).innerHTML = "Invalid Colour. e.g. Red, Blue, White, etc.";
					
				}

				$( '#colour_field' ).focusin( function() {

					$( this ).next( '.error-message' ).show()

				} );

				$( '#colour_field' ).focusout( function() {

					$( this ).next( '.error-message' ).hide();

				} );

				++error;

			} else {

				$( '#colour_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'colour_message' ).innerHTML = "";

			}

			if ( !description_exp.test( description ) ) {

				$( '#description_field' ).css( { 'border-color' : '#cd0000' } );

				if ( description == "" ) {

					document.getElementById( 'description_message' ).innerHTML = "This is a required field.";

				} else {

					document.getElementById( 'description_message' ).innerHTML = "This field will only accept some special characters. Please review your entry.";
					
				}

				$( '#description_field' ).focusin( function() {

					$( this ).next( '.error-message' ).show()

				} );

				$( '#description_field' ).focusout( function() {

					$( this ).next( '.error-message' ).hide();

				} );

				++error;

			} else {

				$( '#description_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'description_message' ).innerHTML = "";

			}

			if ( error == 0 ) {

				var form_data = {

					'owner_field': document.getElementById( 'owner_field' ).value,
					'make_field': document.getElementById( 'make_field' ).value,
					'model_field': document.getElementById( 'model_field' ).value,
					'registration_field': document.getElementById( 'registration_field' ).value,
					'colour_field': document.getElementById( 'colour_field' ).value,
					'description_field': document.getElementById( 'description_field' ).value

				}

				admin_ajax_request( form_data, 'process_bad_debt' );

			}

		} );

		$( '#form-print' ).click( function() {

			$( '.form-wrapper' ).slideToggle();

		} );

		$( '.cancel' ).click( function() {

			$( '.form-wrapper' ).slideToggle();

		} );

	} );

} )( jQuery );