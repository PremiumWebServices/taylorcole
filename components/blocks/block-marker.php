<?php
/**
 * Block: Number
 *
 * @package EDGE\TaylorCole\Components
 */

// Default class to use as base for custom CMS class.
$block_link_classes = [
	'c-marker',
	'c-marker--' . $block['data']['marker'],
];

if( isset( $block['className'] ) ) {
	array_push(
		$block_link_classes,
		$block['className']
	);
}

if ( empty( $block['data']['marker'] ) ) {
	return;
}

?>

<div
	class="<?php echo esc_attr( implode( ' ', $block_link_classes ) ); ?>"
	id="<?php echo esc_attr( $block['id'] ); ?>">

	<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/dist/svg/marker-' . $block['data']['marker'] . '.svg' ); ?>" alt="">

</div>
