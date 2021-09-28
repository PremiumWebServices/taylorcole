<?php

/**
 * Submit the contact form and if all validates send user to thank you page.
 *
 * @param array $fields Optional. The values entered into the form fields. If not set the $_POST array is assumed.
 *
 * @return array An array containing any errors found and the sent status of the form.
 */

function validate_borrow_form( $fields = null ) {
	if ( !isset( $fields ) ) {
		$fields = $_POST;
	}

	$global_error = array(
		'errors' => array(
			'global' => 'An unknown error occurred and your enquiry could not be sent, please try again later.',
		),
		'borrow_amount' => false,
	);

	// Check that the form fields are present
	if (
		! isset( $fields['borrow_salary'] )
	) {
		return $global_error;
	}

	$result = array(
		'errors' => array(),
		'borrow_amount' => false,
	);


	if ( '' === $fields['borrow_salary'] ) {
		$result['errors']['borrow_salary'] = 'Enter a property price';
	}

	$fields['form'] = 'borrow_calculator';
	
	// If we have no errors send the email
	if ( 0 === count( $result['errors'] )) {

		$result['borrow_amount'] = calculate_borrow_amount( $fields );

		do_action(
			'EDGE\Forms\Record',
			$fields
		);

	}

	return $result;
}

// Calculate the monthly borrow cost
function calculate_borrow_amount( $fields = array() ) {

	// $fields['borrow_salary'] = your salary
	// $fields['borrow_partners_salary'] = partners salary
	
	if ( isset( $fields['borrow_partners_salary'] ) && $fields['borrow_partners_salary'] !== '' ) {
		$value = $fields['borrow_salary'] + $fields['borrow_partners_salary'];
	} else {
		$value = $fields['borrow_salary'];
	}

	$borrow = $value * 4.5;

	return $borrow;

}
