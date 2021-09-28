( function( $, window, document, undefined ) {

	//Contact Now
	$("#contact_submit").click( function(event) {

			var form = $(this).closest('form');

			var firstname = form.find('#contact_first_name'),
					lastname = form.find('#contact_last_name'),
					houseno = form.find('#contact_house_no'),
					street = form.find('#contact_street'),
					town_city = form.find('#contact_town_city'),
					county = form.find('#contact_county'),
					postcode = form.find('#contact_postcode'),

					phone = form.find('#contact_telephone'),
					stripped_phone = phone.val().replace(/[^0-9+]/g, ''),

					email = form.find('#contact_email'),
					email_re = /^[A-Z0-9._%+-]+@(?:[A-Z0-9-]+\.)+[A-Z]{2,4}$/i,

					proceed = true;


			// START VALIDATION

			if( firstname.is('[required]') && firstname.val() === '' ) {
					firstname.addClass('c-form__input--has-error');
					show_inline_result( firstname, 'Enter your first name' );

					proceed = false;
			}
			if ( firstname.val() !== '' && firstname.val().length <= 1 ) {
					firstname.addClass('c-form__input--has-error');
					show_inline_result( firstname, 'First name should be at least 2 characters' );

					proceed = false;
			}

			if( lastname.is('[required]') && lastname.val() === '' ) {
				lastname.addClass('c-form__input--has-error');
				show_inline_result( lastname, 'Enter your last name' );

				proceed = false;
			}
			if ( lastname.val() !== '' && lastname.val().length <= 1 ) {
					lastname.addClass('c-form__input--has-error');
					show_inline_result( lastname, 'Last name should be at least 2 characters' );

					proceed = false;
			}

			if( houseno.is('[required]') && houseno.val() === '' ) {
				houseno.addClass('c-form__input--has-error');
				show_inline_result( houseno, 'Enter your house no' );

				proceed = false;
			}


			if( street.is('[required]') && street.val() === '' ) {
				street.addClass('c-form__input--has-error');
				show_inline_result( street, 'Enter your street' );

				proceed = false;
			}
			if ( street.val() !== '' && street.val().length <= 1 ) {
					street.addClass('c-form__input--has-error');
					show_inline_result( street, 'Street should be at least 2 characters' );

					proceed = false;
			}


			if( town_city.is('[required]') && town_city.val() === '' ) {
				town_city.addClass('c-form__input--has-error');
				show_inline_result( town_city, 'Enter your town / city' );

				proceed = false;
			}
			if ( town_city.val() !== '' && town_city.val().length <= 1 ) {
					town_city.addClass('c-form__input--has-error');
					show_inline_result( town_city, 'Town / city should be at least 2 characters' );

					proceed = false;
			}

			if( county.is('[required]') && county.val() === '' ) {
				county.addClass('c-form__input--has-error');
				show_inline_result( county, 'Enter your county' );

				proceed = false;
			}
			if ( county.val() !== '' && county.val().length <= 1 ) {
					county.addClass('c-form__input--has-error');
					show_inline_result( county, 'County should be at least 2 characters' );

					proceed = false;
			}

			if( postcode.is('[required]') && postcode.val() === '' ) {
				postcode.addClass('c-form__input--has-error');
				show_inline_result( postcode, 'Enter your postcode' );

				proceed = false;
			}
			if ( postcode.val() !== '' && postcode.val().length <= 1 ) {
					postcode.addClass('c-form__input--has-error');
					show_inline_result( postcode, 'Postcode should be at least 2 characters' );

					proceed = false;
			}

			if( phone.is('[required]') && phone.val() === '' ) {
				phone.addClass('c-form__input--has-error');
				show_inline_result( phone, 'Enter your phone number' );

				proceed = false;
		}
		if ( phone.val() !== '' && stripped_phone.length < 9 ) {
				phone.addClass('c-form__input--has-error');
				show_inline_result( phone, 'Enter a valid phone number' );

				proceed = false;
		}


			if( email.is('[required]') && email.val() === '' ) {
					email.addClass('c-form__input--has-error');
					show_inline_result( email, 'Enter your email address' );

					proceed = false;
			}
			if ( email.val() !== '' && !email_re.test( email.val() ) ) {
					email.addClass('c-form__input--has-error');
					show_inline_result( email, 'Enter a valid email address' );

					proceed = false;
			}

			// END VALIDATION


			if( !proceed ) {
					// Transfer focus from submit button to first error field
					var error_fields = $('.js-form-message--error').filter(':visible');

					if ( error_fields.length ) {
							var $first_error = error_fields.eq(0),
									$first_error_input = $first_error.siblings('input,textarea,select'),
									offset = 0;

							if ( $first_error_input.length > 0 ) {
									offset = $first_error_input.offset().top;
							} else {
									offset = $first_error.offset().top;
							}

							smooth_scroll( offset - 250, 250 );
							setTimeout(function() {
									if ( $first_error_input.length > 0 ) {
											$first_error_input.focus();
									}
							}, 250);
					}

					event.preventDefault();
					return false;
			}
	});


	//reset previously set border color after entering text
	$('input, textarea, select').on( 'change', function() {
			$(this).removeClass('c-form__input--has-error');

			if ( $(this).siblings('.js-form-message--error').length ) {
					$(this).siblings('.js-form-message--error').slideUp(250);
			}
	});

	function smooth_scroll( y, speed ) {
			speed = speed || 250;

			$('html, body').stop().animate({
					scrollTop: y
			}, speed);
	}

	function show_inline_result( field, message, status ) {
			status = 'error' || status;

			var msg_container = field.siblings('.js-form-message'),
					msg_container_html = '<p class="c-form__message c-form__message--'+status+' js-form-message js-form-message--'+status+'" style="display:none;">' + message + '</p>';

			if ( msg_container.length > 0 ) {

					if ( msg_container.is(':visible') ) {
							msg_container.html( message ).hide().fadeIn(250);
					} else {
							msg_container.html( message ).hide().slideDown(250);
					}

			} else {

					msg_container = $( msg_container_html );
					msg_container.insertAfter( field ).slideDown(250);

			}

	}

} )( jQuery, window, document );
