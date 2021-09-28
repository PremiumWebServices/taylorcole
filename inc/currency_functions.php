<?php

/*
 * Functions to help with outputting currency values
 *
 */

/**
 * Output a string (pounds & pennies), or an integer (pennies only), value in a currency format.
 *
 * @param integer $value The value to convert, e.g. 2399, £23.99, 1,000.99 etc.
 * @param string $currency_symbol Optional, The currency symbol to be placed in front of the value.
 * @param string $thousands_separator Optional, The symbol to separate thousands with.
 *
 * @return string The currency value formatted.
 */
function tc_get_currency_format ( $value, $currency_symbol = '&pound;', $thousands_separator = ',' ) {
	if ( !is_integer( $value ) ) {
		$value = preg_replace( '/[^0-9.]/','', $value );
		$value = (double)$value * 100;

		$value = (integer)$value;
	}

	$pounds = (integer)($value / 100);
	$pennies = (integer)($value % 100);

	if ( 0 == $pennies ) {
		$pennies = '';
	} else if ( $pennies < 10 ) {
		$pennies = '0' . $pennies;
	}

	$value = $pounds . ( ('' != $pennies) ? '.' . $pennies : '' );

	// Include thousands separator, if set
	if ( isset( $thousands_separator ) ) {
		$value = number_format( $value, 0, '.', $thousands_separator );
	}

	return $currency_symbol . $value;
}

/**
 * Get the pennies only value, stripping all special characters from a currency value.
 *
 * @param mixed $value The value to strip special characters from.
 *
 * @return string The amount of pennies.
 */
function tc_get_currency_base ( $value ) {
	$value = preg_replace( '/[^0-9.]/','', $value );
	$value = (double)$value * 100;

	return (integer)$value;
}
