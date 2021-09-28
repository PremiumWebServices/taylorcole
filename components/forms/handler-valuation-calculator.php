<?php

/**
 * Submit the contact form and if all validates send user to thank you page.
 *
 * @param array $fields Optional. The values entered into the form fields. If not set the $_POST array is assumed.
 *
 * @return array An array containing any errors found and the sent status of the form.
 */

function validate_valuation_form( $fields = null ) {
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
		! isset( $fields['valuation_first_name'] ) ||
		! isset( $fields['valuation_house_no'] ) ||
		! isset( $fields['valuation_postcode'] ) ||
		! isset( $fields['valuation_email'] ) ||
		! isset( $fields['valuation_phone'] )
	) {
		return $global_error;
	}

	$result = array(
		'errors' => array(),
		'sent' => false,
	);


	if ( '' === $fields['valuation_first_name'] ) {
		$result['errors']['valuation_first_name'] = 'Enter your first name';
	}
	if ( '' !== $fields['valuation_first_name'] && strlen( $fields['valuation_first_name'] ) < 2 ) {
		$result['errors']['valuation_first_name'] = 'First name should be at least 2 characters';
	}

	if ( '' === $fields['valuation_house_no'] ) {
		$result['errors']['valuation_house_no'] = 'Enter your house no';
	}

	if ( '' === $fields['valuation_postcode'] ) {
		$result['errors']['valuation_postcode'] = 'Enter your postcode';
	}
	if ( '' !== $fields['valuation_postcode'] && strlen( $fields['valuation_postcode'] ) < 2 ) {
		$result['errors']['valuation_postcode'] = 'Postcode should be at least 2 characters';
	}

	if ( '' === $fields['valuation_email'] ) {
		$result['errors']['valuation_email'] = 'Enter your email address';
	}
	if ( '' !== $fields['valuation_email'] ) {
		$fields['valuation_email'] = filter_var( $fields['valuation_email'], FILTER_SANITIZE_EMAIL );

		if ( !filter_var( $fields['valuation_email'], FILTER_VALIDATE_EMAIL ) ) {
			$result['errors']['valuation_email'] = 'Enter a valid email address';
		}
	}

	if ( '' === $fields['valuation_phone'] ) {
		$result['errors']['valuation_phone'] = 'Enter your phone number';
	}
	if ( '' !== $fields['valuation_phone'] ) {
		$stripped_phone = preg_replace( '/[^0-9+]/', '', $fields['valuation_phone'] );

		if ( '' == $stripped_phone || strlen( $stripped_phone ) < 9 ) {
			$result['errors']['valuation_phone'] = 'Enter a valid phone number';
		}
	}

	$fields['form'] = 'valuation_calculator';

	$fields['valuation_full_name'] = $fields['valuation_first_name'] . ' ' . $fields['valuation_last_name'];

	// If we have no errors send the email
	if ( 0 === count( $result['errors'] )) {

		$result['sent'] = send_contact_valuation_email( $fields );

		$result['sent'] = send_customer_valuation_email( $fields );

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
function send_contact_valuation_email( $fields = array() ) {
	
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
		$recipient = 'EDGE Creative <info@edge-creative.com>';
		$from = 'EDGE Creative <info@edge-creative.com>';
	}

	$sendConfig = array(
		'recipient' => $recipient,
		'subject' => 'Valuation Calculator Form | Taylor Cole',
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
			<td colspan="2">A user has submitted a valuation message on Taylor Cole.</td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td><b>First Name: </b></td>
			<td><?php echo esc_html($fields['valuation_first_name']) ?></td>
		</tr>
		<tr>
			<td><b>Last Name: </b></td>
			<td><?php echo esc_html( ( isset( $fields['valuation_last_name'] )  ) ? $fields['valuation_last_name'] : '-' ); ?></td>
		</tr>
		<tr>
			<td><b>House No: </b></td>
			<td><?php echo esc_html( $fields['valuation_house_no'] ); ?></td>
		</tr>
		<tr>
			<td><b>Street: </b></td>
			<td><?php echo esc_html( ( isset( $fields['valuation_street'] )  ) ? $fields['valuation_street'] : '-' ); ?></td>
		</tr>
		<tr>
			<td><b>Address 2: </b></td>
			<td><?php echo esc_html( ( isset( $fields['valuation_address2'] )  ) ? $fields['valuation_address2'] : '-' ); ?></td>
		</tr>
		<tr>
			<td><b>County: </b></td>
			<td><?php echo esc_html( ( isset( $fields['valuation_county'] )  ) ? $fields['valuation_county'] : '-' ); ?></td>
		</tr>
		<tr>
			<td><b>Postcode: </b></td>
			<td><?php echo esc_html($fields['valuation_postcode']) ?></td>
		</tr>
		<tr>
		  <td><b>Contact Number: </b></td>
		  <td><?php echo esc_html($fields['valuation_phone']) ?></td>
		</tr>
		<tr>
			<td><b>Email Address: </b></td>
			<td><?php echo esc_html($fields['valuation_email']) ?></td>
		</tr>
		<tr>
			<td><b>Deposit Type: </b></td>
			<td><?php echo esc_html($fields['valuation_deposit_type']) ?></td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td colspan="2"><b>Additional Information: </b></td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td><b>Preferred Date: </b></td>
			<td><?php echo esc_html( ( isset( $fields['valuation_preferred_date'] )  ) ? $fields['valuation_preferred_date'] : '-' ); ?></td>
		</tr>
		<tr>
			<td><b>Preferred Time of Day: </b></td>
			<td><?php echo esc_html( ( isset( $fields['valuation_preferred_time'] )  ) ? $fields['valuation_preferred_time'] : '-' ); ?></td>
		</tr>
		<tr>
			<td><b>Other Requirements: </b></td>
			<td><?php echo esc_html( ( isset( $fields['valuation-other'] )  ) ? $fields['valuation-other'] : '-' ); ?></td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<?php if ( isset( $fields['valuation_opt_in'] ) ): ?>
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
function send_customer_valuation_email( $fields = array() ) {

	$recipient = $fields['valuation_full_name'] . ' <' . $fields['valuation_email'] . '>';
	$from = 'Taylor Cole <sales@taylorcole.co.uk>';;

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
