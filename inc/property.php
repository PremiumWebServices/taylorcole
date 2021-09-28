<?php
/**
 * Property Functions
 *
 * Functions for the templating system.
 *
 * @package  EDGE\Toolkit\Inc
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function propertyFeatures($postID, $type){
  $propertyFeatures = array(
    'Bedrooms' => get_post_meta($postID, 'propertyBedrooms', true),
    'Bathrooms' => get_post_meta($postID, 'propertyBathrooms', true),
    'Ensuites' => get_post_meta($postID, 'propertyEnsuites', true),
    'Reception rooms' => get_post_meta($postID, 'propertyReceptionRooms', true),
    'Kitchens' => get_post_meta($postID, 'propertyKitchens', true)
  );
  if ($type == 'list') {
    foreach ($propertyFeatures as $key => $value) {
      if ($value != 0) {
        echo esc_html($value).' '.esc_html($key).', ';
      }
    }
  }
  if ($type == 'stacked') {
    foreach ($propertyFeatures as $key => $value) {
      if ($value != 0) {
        echo esc_html($value).' '.esc_html($key).'<br />';
      }
    }
  }
}

function keyFeatures($postID, $type){

  $KeyFeatures = array(
    'propertyFeature2' => get_post_meta($postID, 'propertyFeature2', true),
    'propertyFeature3' => get_post_meta($postID, 'propertyFeature3', true),
    'propertyFeature4' => get_post_meta($postID, 'propertyFeature4', true),
		'propertyFeature5' => get_post_meta($postID, 'propertyFeature5', true),
		'propertyFeature6' => get_post_meta($postID, 'propertyFeature6', true),
		'propertyFeature7' => get_post_meta($postID, 'propertyFeature7', true),
		'propertyFeature8' => get_post_meta($postID, 'propertyFeature8', true),
		'propertyFeature9' => get_post_meta($postID, 'propertyFeature9', true),
		'propertyFeature10' => get_post_meta($postID, 'propertyFeature10', true),
	);

  if ($type == 'list') {
    foreach ($KeyFeatures as $key => $value) {
      if ($value != "") {
        echo '<li>' . esc_html($value) . '</li>';
      }
    }
  }
}

function buildPropertyAddress($postID) {
  $address = '';
  $propertyAddress = array(
    'addressNumber' => get_post_meta($postID, 'addressNumber', true),
    'addressStreet' => get_post_meta($postID, 'addressStreet', true),
    'address2' => get_post_meta($postID, 'address2', true),
    'address3' => get_post_meta($postID, 'address3', true),
    'address4' => get_post_meta($postID, 'address4', true),
    'addressPostcode' => get_post_meta($postID, 'addressPostcode', true),
    'country' => get_post_meta($postID, 'country', true)
  );
  foreach ($propertyAddress as $key => $value) {
    if ($key == 'addressNumber' || $key == 'country') {
      $address .= $key.'-'.$value.' ';
    }
    elseif (!empty($value)) {
      $address .= $key.'-'.$value.', ';
    }
  }
  return $address;
}

function propertyStatus($postID){
  $statusID = get_post_meta($postID, 'availability_ID', true);

  switch ($statusID) {
    case 1:
      $statusTitle = 'On Hold';
      break;
    case 2:
      $statusTitle = 'For Sale';
      break;
    case 3:
      $statusTitle = 'Under Offer';
      break;
    case 4:
      $statusTitle = 'Sold STC';
      break;
    case 5:
      $statusTitle = 'Sold';
      break;
    case 7:
      $statusTitle = 'Withdrawn';
      break;
    default:
      $statusTitle = '';
      break;
  }
  echo esc_html($statusTitle);
}

function constructPropertyInfo($postID, $type) {
  $post_object = get_post($postID);
  $sidebarInfo = array(
    'Description' => $post_object->post_content,
    'Brochures' => implode(get_post_meta($postID, 'brochures', true)),
    'Floorplans' => implode(get_post_meta($postID, 'floorplans', true)),
    'EPC-Graphs' => implode(get_post_meta($postID, 'epcGraphs', true)),
    'EPC-Front Pages' => implode(get_post_meta($postID, 'epcFrontPages', true)),
    'Virtual-Tours' => implode(get_post_meta($postID, 'virtualTours', true)),
    'External-Links' => implode(get_post_meta($postID, 'externalLinks', true))
  );
  if ($type == 'nav') {
    echo '<ul class="sidebar">';
    foreach ($sidebarInfo as $key => $value) {
      if (!empty($value)) {
        echo '<li class="sidebar__link"><a id='.esc_html($key).'>'.esc_html($key).'</a></li>';
      }
    }
    echo '</ul>';
  }
  if ($type == 'pages') {
    foreach ($sidebarInfo as $key => $value) {
      if (!empty($value)) {
        echo '
          <div id='.esc_html($key).'>
            <div class="column--12"><h1>'.esc_html($key).'</h1></div>
            <ul>
              <li><a href='.esc_html($value).'>Download info</a></li>
            </ul>
          </div>
        ';
      }
    }
  }
}

function edge_property_bedrooms() {

	echo esc_html(
		get_post_meta(
			get_the_ID(),
			'propertyBedrooms',
			true
		)
	);

}

function edge_property_bathrooms() {

	echo esc_html(
		get_post_meta(
			get_the_ID(),
			'propertyBathrooms',
			true
		)
	);

}

function edge_property_reception() {

	$edge_property_reception = get_post_meta(
		get_the_ID(),
		'propertyReceptionRooms',
		true
	);

	if( empty( $edge_property_reception ) ) {
		echo esc_html( '0' );
	}

	echo esc_html(
		$edge_property_reception
	);

}

function edge_property_price() {

	if ( get_post_type() == 'lettings'){
		$price_type = 'rent';
	} else {
		$price_type = 'price';
	}

	if ( get_post_meta( get_the_ID(), 'forSalePOA', true ) ) {
		$price = 'POA';
	} else {
		$price = get_post_meta(get_the_ID(), $price_type, true);
		$fmt = new NumberFormatter( 'en_GB', NumberFormatter::CURRENCY );
		$price =  $fmt->formatCurrency($price, "gbp");
		$price = explode('.',$price);
		$price = $price[0];
	}
	echo esc_html( $price );
	echo " - " . get_post_meta(get_the_ID(), 'availability', true);
}
