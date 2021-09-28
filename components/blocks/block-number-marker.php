<?php
/**
 * Block: Number
 *
 * @package EDGE\XPTheme\Components
 */

// Default class to use as base for custom CMS class.
$block_link_classes = [
	'c-number-marker',
	'c-number-marker--' . $block['data']['number'],
];

if( isset( $block['className'] ) ) {
	array_push(
		$block_link_classes,
		$block['className']
	);
}

?>

<div
	class="<?php echo esc_attr( implode( ' ', $block_link_classes ) ); ?>"
	id="<?php echo esc_attr( $block['id'] ); ?>">
	<img
		src="<?php echo esc_url( get_stylesheet_directory_uri() . '/dist/svg/number-' . $block['data']['number'] . '-small.svg' ); ?>"
		alt=""
		height="40"
		width="60">
</div>
