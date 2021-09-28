<?php

/**
 * Functions related to the job search functionality.
 */

function residentialPropertyType( $type ) {
	$map = array(
		1 => 'House',
		2 => 'Flat/Apartment',
		3 => 'Bungalow',
		4 => 'Other',
	);

	return $map[ $type ];
}


/**
 * Get the valid search keys.
 * @return array The keys that can be searched for.
 */
function rp_get_valid_search_keys( $unset_keys = array() ) {
	$valid_keys = array(
		'l',
		'r',
		'minp',
		'maxp',
		'pt',
		'pt_h',
		'pt_f',
		'minb',
		'maxb',
		'order',
		'signature',
		'showSold',
		'searchRadius',
	);

	if ( is_string($unset_keys) ) {
		$unset_keys = array( $unset_keys );
	}

	if ( is_array($unset_keys) && count($unset_keys) > 0 ) {
		foreach ($unset_keys as $key => $value) {

			if ( ($valid_key = array_search($value, $valid_keys)) !== false ) {
				unset( $valid_keys[$valid_key] );
			}

		}
	}

	return $valid_keys;
}


/**
 * Add $_GET params to a URL, as long as they are valid
 */
function rp_get_query_permalink( $url = null ) {
	if ( !isset($url) ) {
		$url = get_the_permalink();
	}

	return esc_url( add_query_arg( $_GET, $url ) );
}

/**
 * Output a number of hidden inputs containing the $_POST keys, as long as they are valid.
 */
function rp_echo_post_inputs( $unset_keys = array(), $post_array = null ) {
	$valid_keys = rp_get_valid_search_keys($unset_keys);

	if ( !isset($post_array) ) {
		$post_array = $_POST;
	}

	?>

	<?php foreach( $valid_keys as $name ): ?>
		<?php
		  if( !isset( $post_array[$name] ) ) {
		    continue;
		  }

		  $name = htmlspecialchars($name);
		  $value = $post_array[$name];

		  if ( is_array($value) ):

		  		foreach ($value as $value_inner):
		  		?>
		  				<input class="hide" type="hidden" name="<?php echo esc_html($name); ?>[]" value="<?php echo esc_html($value_inner); ?>">
		  		<?php
		  		endforeach;

		  else:

		  	$value = htmlspecialchars($value);
		  	?>
		  		<input class="hide" type="hidden" name="<?php echo esc_html($name); ?>" value="<?php echo esc_html($value); ?>">
		  	<?php
		  endif;
		?>

	<?php endforeach; ?>

	<?php
}


/**
 * Get the distance between 2 lat and lngs.
 * @param float $lat1 The first latitude.
 * @param float $lon1 The second longitude.
 * @param float $lat2 The first latitude.
 * @param float $lon2 The second longitude.
 */
function rp_get_distance($lat1, $lon1, $lat2, $lon2, $unit = 'M') {
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
    return ($miles * 0.8684);
  } else {
    return $miles;
  }
}

/**
 * Get the latitude & longitude of an address
 * @param  string $location
 * @return array          A keyed array containing status, coords['lat'], coords['lng']
 */
function rp_geocode_location( $location ) {
	$location = str_replace( ' ', '+', $location );
	$location = str_replace( ',+', ',', $location );

	$base_url = 'https://maps.google.com/maps/api/geocode/json?bounds=49.989314,-11.026658|61.569879,1.597545&region=uk&address=';

	$geolocation = json_decode(
		file_get_contents( $base_url . $location . '&key=AIzaSyDtpAyBojzhjZji9AI8EB6qIoZu8x0pm7c'  )											 
	);

	if ( 'OK' != $geolocation->status ) {
		return array(
			'coords' => array(),
			'status' => false,
		);
	}

	return array(
		'coords' => (array)$geolocation->results[0]->geometry->location,
		'status' => true,
	);
}

/**
 * Get the query args for the job search.
 * @param integer $paged The current page number.
 * @param integer $posts_per_page Number of posts to show on each page.
 * @param integer $branchID which branch get get results from.
 * @return array The query args that can be passed to WP_Query or get_posts.
*/

function rp_get_search_args( $post_type, $paged, $posts_per_page = 10, $branchID = null) {



	$query_args = array(
		'post_type' => $post_type,
		'paged' => $paged,
		'posts_per_page' => $posts_per_page,
		'meta_query' => array(
			array(
				'key' => 'availability_ID',
				'value' => '7',
				'compare' => '!=',
			),
		),
	);
	
	if ( isset( $_GET['showSold'] ) && $_GET['showSold'] == 'no' ) {
		$query_args['meta_query'][] = array(
			'relation' => 'AND',
			array(
				'key' => 'availability_ID',
				'value'   => '2',
				'compare' => 'IN'
			)
		);
	}

	if ($branchID != null) {
		$query_args['meta_query'][] = array(
			'relation' => 'AND',
			array(
				'key' => 'branchID',
	  		'value' => $branchID,
	  		'compare' => '='
			)
		);
	}


	$price_key = 'price';
	if ( 'lettings' == $post_type ) {
		$price_key = 'rent';
	}

	$propertyType_meta_query = array();

	if ( isset( $_GET['pt'] ) && '' != $_GET['pt'] ) {
		if ( 4 == $_GET['pt'] ) {
		  $query_args['meta_query'][] = array(
		  	'relation' => 'OR',
		  	array(
				'key' => 'propertyType',
				'value'   => array(1,2,3),
				'compare' => 'NOT IN',
		  	),
		  	array(
				'key' => 'propertyType',
				'value'   => '',
				'compare' => 'NOT EXISTS',
		  	),
			);
		} elseif ( 1 == $_GET['pt'] ) {
			$query_args['meta_query'][] = array(
				'key' => 'propertyType',
				'value'   => array(1,3),
				'compare' => 'IN',
			);
		} else {
			$query_args['meta_query'][] = array(
				'key' => 'propertyType',
					// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
					// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
					// phpcs:ignore
				'value'   => $_GET['pt'],
				'compare' => '=',
			);
		}
	}

	if ( isset( $_GET['minp'], $_GET['maxp'] ) ) {
		$query_args['meta_query'][] = array(
			'key' => $price_key,
			// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			// phpcs:ignore
			'value'   => array( $_GET['minp'], $_GET['maxp'] ),
			'type'    => 'numeric',
			'compare' => 'BETWEEN',
		);
	}

	if ( isset( $_GET['minb'], $_GET['maxb'] ) ) {
		$query_args['meta_query'][] = array(
			'key' => 'propertyBedrooms',
			// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			// phpcs:ignore
			'value'   => array( $_GET['minb'], $_GET['maxb'] ),
			'type'    => 'numeric',
			'compare' => 'BETWEEN',
		);
	}

	if ( isset($_GET['l']) && '' !== $_GET['l'] ) {

		// Check for postcode, and if so add to meta_query
		$location_is_postcode = false;
		// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		// phpcs:ignore
		if ( preg_match('/[A-Za-z]{1,2}[0-9]{1,2}/', $_GET['l'] ) ) {
			$location_is_postcode = true;
		}

		if ( $location_is_postcode ) {

			$query_args['meta_query'][] = array(
				'key' => 'addressPostcode',
				// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
				// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
				// phpcs:ignore
				'value'   => $_GET['l'],
				'compare' => 'LIKE',
			);

		}

    // Search address fields for our location.
    if ( ! $location_is_postcode ) {

      $location_query = array(
        'relation' => 'OR',
        array(
					'key' => 'addressName',
					// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
					// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
					// phpcs:ignore
          'value'   => $_GET['l'],
          'compare' => 'LIKE',
        ),
        array(
					'key' => 'addressStreet',
					// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
					// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
					// phpcs:ignore
          'value'   => $_GET['l'],
          'compare' => 'LIKE',
        ),
        array(
					'key' => 'address2',
					// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
					// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
					// phpcs:ignore
          'value'   => $_GET['l'],
          'compare' => 'LIKE',
        ),
        array(
          'key' => 'address3',
					// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
					// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
					// phpcs:ignore
					'value'   => $_GET['l'],
          'compare' => 'LIKE',
        ),
        array(
          'key' => 'address4',
					// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
					// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
					// phpcs:ignore
					'value'   => $_GET['l'],
          'compare' => 'LIKE',
        ),
      );

      $query_args['meta_query'][] = $location_query;

    }

    // Minimum area before using the radius search.
    $radius_search_min = 2;

    /**
     * If not a postcode, and, if has a radius greater than 2 miles.
     * This allows for areas greater than 2 miles. As Google Maps doesn't have
     * a boundries API to get the borders of a location.
     */
    if (
      ! $location_is_postcode &&
      isset($_GET['r']) &&
      $_GET['r'] > $radius_search_min
    ) {
			// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			// phpcs:ignore
			$geocode = rp_geocode_location( $_GET['l'] );
			if ( $geocode['status'] ) {
				$query_args['distance_query'] = array(
					'latitude' => $geocode['coords']['lat'],
					'longitude' => $geocode['coords']['lng'],
					// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
					// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
					// phpcs:ignore
					'radius' => $_GET['r'],
				);
			}

		}

	}

	if (
    isset($query_args['meta_query']) &&
    count($query_args['meta_query']) > 1
  ) {
		$query_args['meta_query']['relation'] = 'AND';
	}

	// Order By settings
	$order = '';
	if ( isset( $_GET['order'] ) && '' !== $_GET['order'] ) {
		// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		// phpcs:ignore
		$order = $_GET['order'];
	}

	switch ( $order ) {
	  case 'name_asc':
	    $query_args['order'] = 'ASC';
	    $query_args['orderby'] = 'title';
	    break;

	  case 'name_desc':
	    $query_args['order'] = 'DESC';
	    $query_args['orderby'] = 'title';
	    break;

	  case 'price_asc':
	    $query_args['order'] = 'ASC';
	    $query_args['meta_key'] = $price_key;
	    $query_args['orderby'] = 'meta_value_num';
	    break;

	  case 'date':
	    $query_args['order'] = 'DESC';
	    $query_args['orderby'] = 'date';
	    break;

	  case 'price_desc':
	  default:
	    $query_args['order'] = 'DESC';
	    $query_args['meta_key'] = $price_key;
	    $query_args['orderby'] = 'meta_value_num';
	    break;
	}

	return $query_args;
}
