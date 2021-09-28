<?php
/**
 * Block: Icons
 *
 * @package EDGE\XPTheme\Components
 */

// Default class to use as base for custom CMS class.
$block_link_classes = [
	'c-icon-group'
];

if( isset( $block['className'] ) ) {
	array_push(
		$block_link_classes,
		$block['className']
	);
}

$edge_icons = $block['data']['icons'];

if ( 0 === $edge_icons ) {
	return;
}

?>

<ul
	class="<?php echo esc_attr( implode( ' ', $block_link_classes ) ); ?>"
	id="<?php echo esc_attr( $block['id'] ); ?>">

	<?php
		for( $counter = 0; $counter < $edge_icons; $counter++ ) :
			$icon = $block['data']['icons_' . $counter . '_icon'];
			$description = $block['data']['icons_' . $counter . '_description'];
		?>

			<li class="c-icon-group__item">
				<figure class="c-icon-group__icon">
					<?php
						echo wp_get_attachment_image(
							$icon,
							'full',
							false,
							[ 'class' => 'c-icon c-icon--feature' ]
						);
					?>
				</figure>

				<div class="c-icon-group__body">
					<?php
						echo wp_kses_post(
							apply_filters(
								'edge_wysiwyg_field',
								$description
							)
						);
					?>
				</div>
			</li>

		<?php
		endfor;
	?>

</ul>
