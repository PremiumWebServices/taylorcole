( function( $, window, document, undefined ) {

    $("#contact_submit").click( function(event) {

        var form = $(this).closest('form'),
            antiSpam = form.find('#url');

        if ( antiSpam.val() !== '' ) {
            antiSpam.addClass('form__input--has-error');
            show_inline_result( antiSpam, 'Leave the spam prevention field blank' );

            event.preventDefault();
            return false;
        }

        var name = form.find('#contact_name'),

            phone = form.find('#contact_phone'),
            stripped_phone = phone.val().replace(/[^0-9+]/g, ''),

            email = form.find('#contact_email'),
            email_re = /^[A-Z0-9._%+-]+@(?:[A-Z0-9-]+\.)+[A-Z]{2,4}$/i,

            proceed = true;


        // START VALIDATION

        if( name.is('[required]') && name.val() === '' ) {
            name.addClass('form__input--has-error');
            show_inline_result( name, 'Enter your name' );

            proceed = false;
        }
        if ( name.val() !== '' && name.val().length <= 1 ) {
            name.addClass('form__input--has-error');
            show_inline_result( name, 'Name should be at least 2 characters' );

            proceed = false;
        }


        if( phone.is('[required]') && phone.val() === '' ) {
            phone.addClass('form__input--has-error');
            show_inline_result( phone, 'Enter your phone number' );

            proceed = false;
        }
        if ( phone.val() !== '' && stripped_phone.length < 9 ) {
            phone.addClass('form__input--has-error');
            show_inline_result( phone, 'Enter a valid phone number' );

            proceed = false;
        }


        if( email.is('[required]') && email.val() === '' ) {
            email.addClass('form__input--has-error');
            show_inline_result( email, 'Enter your email address' );

            proceed = false;
        }
        if ( email.val() !== '' && !email_re.test( email.val() ) ) {
            email.addClass('form__input--has-error');
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
        $(this).removeClass('form__input--has-error');

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
