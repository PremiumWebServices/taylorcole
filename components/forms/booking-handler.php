<?php

/**
 * Submit the contact form and if all validates send user to thank you page.
 *
 * @param array $fields Optional. The values entered into the form fields. If not set the $_POST array is assumed.
 *
 * @return array An array containing any errors found and the sent status of the form.
 */


function validate_booking_form( $fields = null ) {
	if ( !isset( $fields ) ) {
		$fields = $_POST;
	}

	$global_error = array(
		'errors' => array(
			'global' => 'An unknown error occurred and your enquiry could not be sent, please try again later.',
		),
		'sent' => false,
	);

	// Check that the form fields are present
	if (
		!isset( $fields['contact_name'] ) ||
		!isset( $fields['contact_email'] ) ||
		!isset( $fields['contact_phone'] )
	) {
		return $global_error;
	}

	// Verify nonce value
	// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
	// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	// phpcs:ignore
	if ( !isset( $_POST[ 'contact_nonce' ] ) || !wp_verify_nonce( $_POST[ 'contact_nonce' ], 'submit_contact_form' ) ) {
		return $global_error;
	}

	$result = array(
		'errors' => array(),
		'sent' => false,
	);


	if ( isset( $fields['url'] ) && '' !== $fields['url'] ) {
		$result['errors']['url'] = 'Leave the spam prevention field blank';
	}


	if ( '' === $fields['contact_name'] ) {
		$result['errors']['contact_name'] = 'Enter your name';
	}
	if ( '' !== $fields['contact_name'] && strlen( $fields['contact_name'] ) < 2 ) {
		$result['errors']['contact_name'] = 'Name should be at least 2 characters';
	}


	if ( '' === $fields['contact_phone'] ) {
		$result['errors']['contact_phone'] = 'Enter your phone number';
	}
	if ( '' !== $fields['contact_phone'] ) {
		$stripped_phone = preg_replace( '/[^0-9+]/', '', $fields['contact_phone'] );

		if ( '' == $stripped_phone || strlen( $stripped_phone ) < 9 ) {
			$result['errors']['contact_phone'] = 'Enter a valid phone number';
		}
	}


	if ( '' === $fields['contact_email'] ) {
		$result['errors']['contact_email'] = 'Enter your email address';
	}
	if ( '' !== $fields['contact_email'] ) {
		$fields['contact_email'] = filter_var( $fields['contact_email'], FILTER_SANITIZE_EMAIL );

		if ( !filter_var( $fields['contact_email'], FILTER_VALIDATE_EMAIL ) ) {
			$result['errors']['contact_email'] = 'Enter a valid email address';
		}
	}

	$reCaptcha_score = getCaptchaScore();

	// Take action based on the score returned.
	if ( (float) 0.5 > (float) $reCaptcha_score ) {
	// phpcs:ignore
		$result['errors']['recaptcha_response'] = 'reCaptcha score too low.';
	}
	
	$fields['form'] = 'property_interest';

	$fields['property_interest_full_name'] = $fields['contact_name'];
	$fields['property_interest_email'] = $fields['contact_email'];

	// If we have no errors send the email
	if ( 0 === count( $result['errors'] ) ) {
		$result['sent'] = send_booking_email( $fields );

		do_action(
			'EDGE\Forms\Record',
			$fields
		);
	}

	return $result;

}

/**
 * Send the contact form as an email.
 *
 * @param array $fields The values entered in the contact form.
 *
 * @return boolean True if the email succeeded, false otherwise.
 */
function send_booking_email( $fields = array() ) {

	// check which propertyType and then assign the corrent email addresses
	switch ($fields['propertyType']) {
		case 'Lettings':
			$recipient = array( 'Taylor Cole <lettings@taylorcole.co.uk>', 'EDGE Creative <karen@edge-creative.com>');
			$from = 'Taylor Cole <lettings@taylorcole.co.uk>';
			break;
		default:
			$recipient = array( 'Taylor Cole <sales@taylorcole.co.uk>', 'EDGE Creative <karen@edge-creative.com>');
			$from = 'Taylor Cole <sales@taylorcole.co.uk>';
	}

	if (
		defined( 'WP_ENV' ) &&
		in_array( WP_ENV, [ 'local', 'qa', 'staging' ] )
	) {
		$recipient = 'EDGE Creative <studio@edge-creative.com>';
		$from = 'EDGE Creative <studio@edge-creative.com>';
	}

	$sendConfig = array(
        'recipient' => $recipient,
        'subject' => $fields['propertyType'].' Property Viewing for '. $fields['property'].' | Taylor Cole',
        'headers' => array(
            "From: " .$from,
            "Reply-To: ".$from,
            "MIME-Version: 1.0",
            "Content-Type: text/html; charset=ISO-8859-1"
        ),
        'body' => '',
    );

	ob_start();

?>
	<table>
        <tr>
            <td colspan="2">A new booking was entered online at Taylor Cole.</td>
        </tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>
            <td><b>Property: </b></td>
            <td><?php echo esc_html($fields['property']); ?> - <a href="<?php echo esc_html($fields['propertyLink']); ?>" title="view property">View Property</a></td>
        </tr>
        <tr>
            <td><b>Full Name: </b></td>
            <td><?php echo esc_html($fields['contact_name']); ?></td>
        </tr>
        <tr>
            <td><b>Phone Number: </b></td>
            <td><?php echo esc_html($fields['contact_phone']); ?></td>
        </tr>
        <tr>
            <td><b>Email Address: </b></td>
            <td><?php echo esc_html($fields['contact_email']); ?></td>
        </tr>

		    <?php if ( isset( $fields['contact_opt_in'] ) ): ?>
		      <tr><td colspan="2">&nbsp;</td></tr>
		      <tr>
		        <td colspan="2">In checking this box, I agree to Taylor Cole using my data to send me information.</td>
		      </tr>
		    <?php endif; ?>
    </table>
<?php

	$sendConfig['body'] = ob_get_clean();

	return wp_mail(
		$sendConfig['recipient'],
		$sendConfig['subject'],
		$sendConfig['body'],
		implode("\r\n", $sendConfig['headers'])
	);
}
