/*

	Theme Name: Private Forum
	Author: Sean Creagh
	Description: Save data input as custom post type
	Version: 1.0

*/



( function( $ ) {

	$( document ).ready( function() {

		var submit = document.getElementById( 'garage-submit' );

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

						document.getElementById( 'success-log' ).innerHTML = 'Your garage has been saved to the directory';
						document.getElementById( 'garage_name_field' ).value = "";
						document.getElementById( 'garage_owner_field' ).value = "";
						document.getElementById( 'garage_email_field' ).value = "";
						document.getElementById( 'garage_number_field' ).value = "";
						document.getElementById( 'garage_address_line_1_field' ).value = "";
						document.getElementById( 'garage_address_line_2_field' ).value = "";
						document.getElementById( 'garage_county_field' ).value = "";
						document.getElementById( 'garage_eircode_field' ).value = "";
						document.getElementById( 'garage_map_field' ).value = "";
						$( '.form-wrapper' ).slideToggle();

					} else {

						document.getElementById( 'required' ).innerHTML = 'You garage was not saved. Please check your details for any errors';

					}

				}

			} );

		};

		submit.addEventListener( 'click', function( event ) {

			event.preventDefault();

			var error = 0; 

			var name = document.getElementById( 'garage_name_field' ).value;
			var owner = document.getElementById( 'garage_owner_field' ).value;
			var email = document.getElementById( 'garage_email_field' ).value;
			var number = document.getElementById( 'garage_number_field' ).value;
			var address_ln1 = document.getElementById( 'garage_address_line_1_field' ).value;
			var address_ln2 = document.getElementById( 'garage_address_line_2_field' ).value;
			var county = document.getElementById( 'garage_county_field' ).value;
			var eircode = document.getElementById( 'garage_eircode_field' ).value;
			var map = document.getElementById( 'garage_map_field' ).value;

			var name_exp = new RegExp( "^[ a-zA-Z0-9']+$" );
			var owner_exp = new RegExp( "^[ a-zA-Z]+$" );
			var email_exp = new RegExp( "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" );
			var number_exp = new RegExp( "^[ 0-9-+()]+$" );
			var address_exp = new RegExp( "^[ a-zA-Z0-9]+$" );
			var county_exp = new RegExp( "^[ a-zA-Z0-9.]+$" );
			var eircode_exp = new RegExp( "^[ A-Z0-9]{3}[ ][ A-Z0-9]{4}$" );
			var url_exp = new RegExp( "^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$" );

			if ( !name_exp.test( name ) ) {

				$( '#garage_name_field' ).css( { 'border-color' : '#cd0000' } );

				if ( name == "" ) {

					document.getElementById( 'garage_name_message' ).innerHTML = "This is a required field.";

				} else {

					document.getElementById( 'garage_name_message' ).innerHTML = "Invalid Garage Name. e.g. Midlands Auto Garage.";

				}

				$( '#garage_name_field' ).focusin( function() {

					$( this ).next( '.error-message' ).show()

				} );

				$( '#garage_name_field' ).focusout( function() {

					$( this ).next( '.error-message' ).hide();

				} );

				++error;

			} else {

				$( '#garage_name_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'garage_name_message' ).innerHTML = "";

			}

			if ( !owner_exp.test( owner ) ) {

				$( '#garage_owner_field' ).css( { 'border-color' : '#cd0000' } );

				if ( owner == "" ) {

					document.getElementById( 'garage_owner_message' ).innerHTML = "This is a required field.";

				} else {

					document.getElementById( 'garage_owner_message' ).innerHTML = "Invalid Owner Name. e.g. John Smith.";

				}

				$( '#garage_owner_field' ).focusin( function() {

					$( this ).next( '.error-message' ).show()

				} );

				$( '#garage_owner_field' ).focusout( function() {

					$( this ).next( '.error-message' ).hide();

				} );

				++error;

			} else {

				$( '#garage_owner_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'garage_owner_message' ).innerHTML = "";

			}

			if ( !email_exp.test( email ) ) {

				if ( email != "" ) {

					$( '#garage_email_field' ).css( { 'border-color' : '#cd0000' } );

					document.getElementById( 'garage_email_message' ).innerHTML = "Invalid Email Address. e.g. example@email.com.";

					$( '#garage_email_field' ).focusin( function() {

						$( this ).next( '.error-message' ).show()

					} );

					$( '#garage_email_field' ).focusout( function() {

						$( this ).next( '.error-message' ).hide();

					} );

					++error;

				}

			} else {

				$( '#garage_email_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'garage_email_message' ).innerHTML = "";

			}

			if ( !number_exp.test( number ) ) {

				$( '#garage_number_field' ).css( { 'border-color' : '#cd0000' } );

				if ( number == "" ) {

					document.getElementById( 'garage_number_message' ).innerHTML = "This is a required field.";

				} else {

					document.getElementById( 'garage_number_message' ).innerHTML = "Invalid Phone Number. e.g. 0871234567, 087 123 4567 or 087-123-4567.";

				}

				$( '#garage_number_field' ).focusin( function() {

					$( this ).next( '.error-message' ).show()

				} );

				$( '#garage_number_field' ).focusout( function() {

					$( this ).next( '.error-message' ).hide();

				} );

				++error;

			} else {

				$( '#garage_number_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'garage_number_message' ).innerHTML = "";

			}

			if ( !address_exp.test( address_ln1 ) ) {

				$( '#garage_address_line_1_field' ).css( { 'border-color' : '#cd0000' } );

				if ( address_ln1 == "" ) {

					document.getElementById( 'garage_address_line_1_message' ).innerHTML = "This is a required field.";

				} else {

					document.getElementById( 'garage_address_line_1_message' ).innerHTML = "Invalid Street Name. e.g. Leinster House.";

				}

				$( '#garage_address_line_1_field' ).focusin( function() {

					$( this ).next( '.error-message' ).show()

				} );

				$( '#garage_address_line_1_field' ).focusout( function() {

					$( this ).next( '.error-message' ).hide();

				} );

				++error;

			} else {

				$( '#garage_address_line_1_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'garage_address_line_1_message' ).innerHTML = "";

			}

			if ( !address_exp.test( address_ln2 ) ) {

				$( '#garage_address_line_2_field' ).css( { 'border-color' : '#cd0000' } );

				if ( address_ln2 == "" ) {

					document.getElementById( 'garage_address_line_2_message' ).innerHTML = "This is a required field.";

				} else {

					document.getElementById( 'garage_address_line_2_message' ).innerHTML = "Invalid Locality. e.g. Kildare Street.";

				}

				$( '#garage_address_line_2_field' ).focusin( function() {

					$( this ).next( '.error-message' ).show()

				} );

				$( '#garage_address_line_2_field' ).focusout( function() {

					$( this ).next( '.error-message' ).hide();

				} );

				++error;

			} else {

				$( '#garage_address_line_2_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'garage_address_line_2_message' ).innerHTML = "";

			}

			if ( !county_exp.test( county ) ) {

				$( '#garage_county_field' ).css( { 'border-color' : '#cd0000' } );

				if ( county == "" ) {

					document.getElementById( 'garage_county_message' ).innerHTML = "This is a required field.";

				} else {

					document.getElementById( 'garage_county_message' ).innerHTML = "Invalid County Name. e.g. Dublin 2.";

				}

				$( '#garage_county_field' ).focusin( function() {

					$( this ).next( '.error-message' ).show()

				} );

				$( '#garage_county_field' ).focusout( function() {

					$( this ).next( '.error-message' ).hide();

				} );
				
				++error;

			} else {

				$( '#garage_county_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'garage_county_message' ).innerHTML = "";

			}

			if ( !eircode_exp.test( eircode ) ) {

				if ( eircode != "" ) {

					$( '#garage_eircode_field' ).css( { 'border-color' : '#cd0000' } );

					document.getElementById( 'garage_eircode_message' ).innerHTML = "Invalid Area Code. e.g. A12 B345.";

					$( '#garage_eircode_field' ).focusin( function() {

						$( this ).next( '.error-message' ).show()

					} );

					$( '#garage_eircode_field' ).focusout( function() {

						$( this ).next( '.error-message' ).hide();

					} );

					++error;

				}

			} else {

				$( '#garage_eircode_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'garage_eircode_message' ).innerHTML = "";

			}

			if ( !url_exp.test( map ) ) {

				if ( map != "" ) {

					$( '#garage_map_field' ).css( { 'border-color' : '#cd0000' } );

					document.getElementById( 'garage_map_message' ).innerHTML = "Invalid Map URL.";

					$( '#garage_map_field' ).focusin( function() {

						$( this ).next( '.error-message' ).show()

					} );

					$( '#garage_map_field' ).focusout( function() {

						$( this ).next( '.error-message' ).hide();

					} );

					++error;

				}

			} else {

				$( '#garage_map_field' ).css( { 'border-color' : '#5a5a5a' } );
				document.getElementById( 'garage_map_message' ).innerHTML = "";

			}
			
			if ( error == 0 ) {

				var form_data = {

					'garage_name_field': document.getElementById( 'garage_name_field' ).value,
					'garage_owner_field': document.getElementById( 'garage_owner_field' ).value,
					'garage_email_field': document.getElementById( 'garage_email_field' ).value,
					'garage_number_field': document.getElementById( 'garage_number_field' ).value,
					'garage_address_line_1_field': document.getElementById( 'garage_address_line_1_field' ).value,
					'garage_address_line_2_field': document.getElementById( 'garage_address_line_2_field' ).value,
					'garage_county_field': document.getElementById( 'garage_county_field' ).value,
					'garage_eircode_field': document.getElementById( 'garage_eircode_field' ).value,
					'garage_map_field': document.getElementById( 'garage_map_field' ).value

				}

				admin_ajax_request( form_data, 'process_garage' );

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