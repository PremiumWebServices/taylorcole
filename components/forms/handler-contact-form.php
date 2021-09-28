<?php

/**
 * Submit the contact form and if all validates send user to thank you page.
 *
 * @param array $fields Optional. The values entered into the form fields. If not set the $_POST array is assumed.
 *
 * @return array An array containing any errors found and the sent status of the form.
 */


function validate_contact_form( $fields = null ) {
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
		! isset( $fields['contact_first_name'] ) ||
		! isset( $fields['contact_house_no'] ) ||
		! isset( $fields['contact_postcode'] ) ||
		! isset( $fields['contact_email'] ) ||
		! isset( $fields['contact_telephone'] )
	) {
		return $global_error;
	}

	$result = array(
		'errors' => array(),
		'sent' => false,
	);


	if ( '' === $fields['contact_first_name'] ) {
		$result['errors']['contact_first_name'] = 'Enter your first name';
	}
	if ( '' !== $fields['contact_first_name'] && strlen( $fields['contact_first_name'] ) < 2 ) {
		$result['errors']['contact_first_name'] = 'First name should be at least 2 characters';
	}

	if ( '' === $fields['contact_house_no'] ) {
		$result['errors']['contact_house_no'] = 'Enter your house no';
	}

	if ( '' === $fields['contact_postcode'] ) {
		$result['errors']['contact_postcode'] = 'Enter your postcode';
	}
	if ( '' !== $fields['contact_postcode'] && strlen( $fields['contact_postcode'] ) < 2 ) {
		$result['errors']['contact_postcode'] = 'Postcode should be at least 2 characters';
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

	if ( '' === $fields['contact_telephone'] ) {
		$result['errors']['contact_telephone'] = 'Enter your phone number';
	}
	if ( '' !== $fields['contact_telephone'] ) {
		$stripped_telephone = preg_replace( '/[^0-9+]/', '', $fields['contact_telephone'] );

		if ( '' == $stripped_telephone || strlen( $stripped_telephone ) < 9 ) {
			$result['errors']['contact_telephone'] = 'Enter a valid phone number';
		}
	}

	$reCaptcha_score = getCaptchaScore();

	// Take action based on the score returned.
	if ( (float) 0.5 > (float) $reCaptcha_score ) {
	// phpcs:ignore
		$result['errors']['recaptcha_response'] = 'reCaptcha score too low.';
	}

	$fields['form'] = 'contact';

	$fields['contact_full_name'] = $fields['contact_first_name'] . ' ' . $fields['contact_last_name'];

	// If we have no errors send the email
	if ( 0 === count( $result['errors'] )) {

		$result['sent'] = send_contact_email( $fields );

		$result['sent'] = send_customer_email( $fields );

		do_action(
			'EDGE\Forms\Record',
			$fields
		);

	}

	return $result;
}

/**
 * Send the message form as an email.
 *
 * @param array $fields The values entered in the message form.
 *
 * @return boolean True if the email succeeded, false otherwise.
 */
function send_contact_email( $fields = array() ) {
	
	switch ($fields['contact_type']){
		case 'Lettings Office':
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
    'subject' => 'Contact Form | Taylor Cole',
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
      <td colspan="2">A user has submitted an message on Taylor Cole.</td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
      <td><b>First Name: </b></td>
      <td><?php echo esc_html($fields['contact_first_name']) ?></td>
    </tr>
		<tr>
      <td><b>Last Name: </b></td>
      <td><?php echo esc_html( ( isset( $fields['contact_last_name'] )  ) ? $fields['contact_last_name'] : '-' ); ?></td>
    </tr>

		<tr>
      <td><b>House No: </b></td>
      <td><?php echo esc_html( $fields['contact_house_no'] ); ?></td>
    </tr>
		<tr>
      <td><b>Street: </b></td>
      <td><?php echo esc_html( ( isset( $fields['contact_street'] )  ) ? $fields['contact_street'] : '-' ); ?></td>
    </tr>
		<tr>
      <td><b>Address 2: </b></td>
      <td><?php echo esc_html( ( isset( $fields['contact_address2'] )  ) ? $fields['contact_address2'] : '-' ); ?></td>
    </tr>
		<tr>
      <td><b>County: </b></td>
      <td><?php echo esc_html( ( isset( $fields['contact_county'] )  ) ? $fields['contact_county'] : '-' ); ?></td>
    </tr>
		<tr>
      <td><b>Postcode: </b></td>
      <td><?php echo esc_html($fields['contact_postcode']) ?></td>
    </tr>
		<tr>
      <td><b>Contact Number: </b></td>
      <td><?php echo esc_html($fields['contact_telephone']) ?></td>
    </tr>

		<tr>
      <td><b>Email Address: </b></td>
      <td><?php echo esc_html($fields['contact_email']) ?></td>
    </tr>
		<tr>
      <td><b>Type: </b></td>
      <td><?php echo esc_html($fields['contact_type']) ?></td>
    </tr>
		<tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
      <td colspan="2"><b>Additional Information: </b></td>
    </tr>
    <tr>
      <td colspan="2"><?php echo esc_html( ( isset( $fields['contact_message'] )  ) ? $fields['contact_message'] : '-' ); ?></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <?php if ( isset( $fields['contact_opt_in'] ) ): ?>
      <tr>
				<td colspan="2">In checking this box, I agree to Taylor Cole using my data to send me information.</td>
      </tr>
    <?php else: ?>
      <tr>
        <td colspan="2">I <strong>DO NOT</strong> agree to Taylor Cole using my data to send me information.</td>
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

/**
 * Send the message form as an email.
 *
 * @param array $fields The values entered in the message form.
 *
 * @return boolean True if the email succeeded, false otherwise.
 */
function send_customer_email( $fields = array() ) {

	$recipient = $fields['contact_full_name'] . ' <' . $fields['contact_email'] . '>';
	$from = 'Taylor Cole <sales@taylorcole.co.uk>';

	$sendConfig = array(
    'recipient' => $recipient,
    'subject' => 'Confirmation | Taylor Cole',
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
			<td colspan="2">Thank you for your enquiry, a member of the team will be in contact shortly.</td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
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
