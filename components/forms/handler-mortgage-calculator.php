<?php

/**
 * Submit the contact form and if all validates send user to thank you page.
 *
 * @param array $fields Optional. The values entered into the form fields. If not set the $_POST array is assumed.
 *
 * @return array An array containing any errors found and the sent status of the form.
 */

function validate_mortgage_form( $fields = null ) {
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
		! isset( $fields['mortgage_deposit_type'] ) ||
		! isset( $fields['mortgage_property_price'] ) ||
		! isset( $fields['mortgage_deposit_amount'] ) ||
		! isset( $fields['mortgage_repayment_terms'] ) ||
		! isset( $fields['mortgage_interest-rate'] )
	) {
		return $global_error;
	}

	$result = array(
		'errors' => array(),
		'calculation_monthly' => false,
		'calculation_borrow' => false,
	);


	if ( '' === $fields['mortgage_property_price'] ) {
		$result['errors']['mortgage_property_price'] = 'Enter a property price';
	}

	if ( '' === $fields['mortgage_deposit_amount'] ) {
		$result['errors']['mortgage_deposit_amount'] = 'Enter your deposit amount';
	}

	$fields['form'] = 'mortgage_calculator';
	
	// If we have no errors send the email
	if ( 0 === count( $result['errors'] )) {

		$result['calculation_monthly'] = calculate_mortgage_monthly( $fields );
		$result['calculation_borrow'] = calculate_mortgage_borrow( $fields );

		do_action(
			'EDGE\Forms\Record',
			$fields
		);

	}

	return $result;
}

// Calculate the monthly mortgage cost
function calculate_mortgage_monthly( $fields = array() ) {

	// M = P[r(1+r)^n/((1+r)^n)-1)] 
	if( $fields['mortgage_deposit_type'] === 'Percentage') {
		$borrowed = ( ($fields['mortgage_property_price'] / 100 ) * $fields['mortgage_deposit_type'] ); //amount borrowed
	} else {
		$borrowed = $fields['mortgage_property_price']; //amount borrowed
	}
    $interestRate = $fields['mortgage_interest-rate']; //interest rate
    $term = $fields['mortgage_repayment_terms']; //term
    $months = ( $term * 12 );
    $answer = ($borrowed * ($interestRate / 100)) / 12;
    $answer_two = ( $borrowed * (($interestRate/12) / 100) / ( 1 - pow( 1 + (($interestRate/12) / 100), -$months)) );
	return $answer_two;

}

// Calculate the amount need to borrow
function calculate_mortgage_borrow( $fields = array() ) {

	return '140,000';

}
