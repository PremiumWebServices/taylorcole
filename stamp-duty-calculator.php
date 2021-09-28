<?php
if( $_POST ) {
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower(sanitize_text_field(wp_unslash($_SERVER['HTTP_X_REQUESTED_WITH']))) != 'xmlhttprequest') {
        //exit script outputting json data
        $output = json_encode(
            array(
                'type'=>'error',
                'text' => 'Request must come from Ajax'
            )
        );
				//phpcs:ignore
        die($output);
    }
		//phpcs:ignore
		$propertyAmount = filter_var( $_POST["propertyAmount"], FILTER_SANITIZE_STRING );
		//phpcs:ignore
		$propertyType = filter_var( $_POST["propertyType"], FILTER_SANITIZE_STRING );

    $stampDutyOne = 2;
    $stampDutyTwo = 5;
    $stampDutyThree = 10;
		$stampDutyFour = 12;

    $bandOneLimit = 125000;
    $bandTwoLimit = 250000;
    $bandThreeLimit = 925000;
		$bandFourLimit = 1500000;

		if ( "first" === $propertyType ) {

			$bandOneLimit = 300000;
			$bandTwoLimit = 500000;
			$bandThreeLimit = 925000;
			$bandFourLimit = 1500000;

			$stampDutyOne = 5;
			$stampDutyTwo = 5;
			$stampDutyThree = 10;
			$stampDutyFour = 12;

		}

		if ( "second" === $propertyType ) {

			$bandOneLimit = 0;
			$bandTwoLimit = 250000;
			$bandThreeLimit = 925000;
			$bandFourLimit = 1500000;

			$stampDutyOne = 3;
			$stampDutyTwo = 5;
			$stampDutyThree = 8;
			$stampDutyFour = 13;
			$stampDutyFive = 15;

		}

    if ( $propertyAmount > $bandOneLimit ) {
        $stampDuty = (($propertyAmount - $bandOneLimit)/100)*$stampDutyOne;
    }

    if ( $propertyAmount > $bandTwoLimit) {
        $stampDutyOne = (($bandTwoLimit - $bandOneLimit)/100)*$stampDutyOne;
        $stampDutyTwo = (($propertyAmount - $bandTwoLimit)/100)*$stampDutyTwo;
        $stampDuty = $stampDutyOne + $stampDutyTwo;
    }

    if ( $propertyAmount > $bandThreeLimit) {
        $stampDutyOne = (($bandTwoLimit - $bandOneLimit)/100)*$stampDutyOne;
        $stampDutyTwo = (($bandThreeLimit - $bandTwoLimit)/100)*$stampDutyTwo;
        $stampDutyThree = (($propertyAmount - $bandThreeLimit)/100)*$stampDutyThree;
        $stampDuty = $stampDutyOne + $stampDutyTwo + $stampDutyThree;
    }

    if ( $propertyAmount > $bandFourLimit) {
        $stampDutyOne = (($bandTwoLimit - $bandOneLimit)/100)*$stampDutyOne;
        $stampDutyTwo = (($bandThreeLimit - $bandTwoLimit)/100)*$stampDutyTwo;
        $stampDutyThree = (($bandFourLimit - $bandThreeLimit)/100)*$stampDutyThree;
        $stampDutyFour = (($propertyAmount - $bandFourLimit)/100)*$stampDutyFour;
        $stampDuty = $stampDutyOne + $stampDutyTwo + $stampDutyThree + $stampDutyFour;
    }

    if ( isset( $bandFiveLimit ) && $propertyAmount > $bandFiveLimit) {
			$stampDutyOne = (($bandTwoLimit - $bandOneLimit)/100)*$stampDutyOne;
			$stampDutyTwo = (($bandThreeLimit - $bandTwoLimit)/100)*$stampDutyTwo;
			$stampDutyThree = (($bandFourLimit - $bandThreeLimit)/100)*$stampDutyThree;
			$stampDutyFour = (($bandFiveLimit - $bandFourLimit)/100)*$stampDutyFour;
			$stampDutyFive = (($propertyAmount - $bandFiveLimit)/100)*$stampDutyFive;
			$stampDuty = $stampDutyOne + $stampDutyTwo + $stampDutyThree + $stampDutyFour + $stampDutyFive;
	}

    setlocale(LC_MONETARY, 'en_GB');
    $stampDuty = '£'.number_format($stampDuty, 2, $locale['decimal_point'], $locale['thousands_sep']);

		$output = json_encode(array('type'=>'message', 'text' => $stampDuty));
		//phpcs:ignore
    die($output);

    }
