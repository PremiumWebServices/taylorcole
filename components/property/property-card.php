<?php
/**
 * Card: Property
 *
 * @package EDGE\TaylorCole
 */

$tc_property_images = get_post_meta(
	get_the_ID(),
	'images',
	true
);

$tc_property_type = get_post_type();
if(is_array($tc_property_images)) {
	$tc_property_gallery = array_splice(
		$tc_property_images,
		1
	);
}

$tc_property_theme = null;

$tc_get_property_theme = get_post_meta(
	get_the_ID(),
	'branchID',
	true
);

if( $tc_get_property_theme === '2' ) {
	$tc_property_theme = 't-signature';
}

$statusID = get_post_meta(get_the_ID(), 'availability_ID', true);
if ( 'sales' === $tc_property_type ){
	switch ($statusID) {
		case 1:
		case 3:
		case 4:
		case 5:
		case 7:
		  $status_icon = 'sold';
		  break;
		case 2:
		  $status_icon = 'for-sale';
		  break;
		default:
		  $status_icon = "for-sale";
		  break;	
	}
}
if ( 'lettings' === $tc_property_type ){
	switch ($statusID) {
		case 1:
		case 3:
		case 4:
		case 5:
		case 6:
		  $status_icon = 'let';
		  break;
		case 2:
		  $status_icon = 'to-let';
		  break;
		default:
		  $status_icon = "to-let";
		  break;
	}
}
?>

<article
	class="c-card c-card--property c-propert--teaser <?php echo esc_attr($tc_property_theme); ?>"
	>

<aside class="c-card__aside">
	<figure class="c-card__featured">

		<div class="c-property__type c-icon--<?php echo $status_icon; ?>"></div>
		
		<a
			href="<?php echo esc_url( get_the_permalink() ); ?>"
			>
			<?php
				the_post_thumbnail(
					'tc-property',
					[
						'class' => 'c-card__media c-card__image',
					]
				);
			?>

			<?php
				/**
				 * Show fallback image.
				 */
				if ( ! has_post_thumbnail() ) :
					echo wp_get_attachment_image(
						get_option( 'sales_image' ),
						'tc-property',
						false,
						[
							'class' => 'c-card__media c-card__image',
						]
					);
				endif;
			?>
		</a>
	</figure>

	<div class="c-card__gallery">

		<?php
			for ( $tc_property_counter = 0; $tc_property_counter <= 2; $tc_property_counter++ ) :
				if ( ! isset( $tc_property_gallery[$tc_property_counter] )  ) {
					continue;
				}
			?>
			<figure>
				<a
					href="<?php echo esc_url( get_the_permalink() ); ?>"
					>
					<?php
						echo wp_get_attachment_image(
							$tc_property_gallery[$tc_property_counter],
							'tc-property',
							false,
							[
								'class' => 'c-card__media c-card__image',
							]
						);
					?>
				</a>
			</figure>

			<?php

			endfor;
		?>

	</div>

</aside>

<header class="c-card__header">

	<?php
		the_title(
			'<h3 class="c-card__title" data-mh="c-card__header">',
			'</h3>'
		);
	?>

	<p class="c-card__price">
		<?php
			edge_property_price();
		?>
	</p>

	<ul class="c-card_highlight">
		<li class="c-card_bedrooms">
		<svg
			class="c-icon c-icon--inline c-icon--medium c-icon--bedrooms"
			viewbox=" 0 0 32 32"
			>
			<title>Bedrooms:</title>
			<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--bedrooms.svg#icon--bedrooms' ); ?>">
		</use>
		</svg> <?php edge_property_bedrooms(); ?>
		</li>
		<li class="c-card_bathrooms">
			<svg
				class="c-icon c-icon--inline c-icon--medium c-icon--bathrooms"
				viewbox=" 0 0 32 32"
				>
				<title>Bathrooms:</title>
				<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--bathrooms.svg#icon--bathrooms' ); ?>">
			</use>
			</svg> <?php edge_property_bathrooms(); ?>
		</li>
		<li class="c-card_reception">
			<svg
				class="c-icon c-icon--inline c-icon--medium c-icon--reception"
				viewbox=" 0 0 32 32"
				>
				<title>Reception Rooms:</title>
				<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--reception.svg#icon--reception' ); ?>">
			</use>
			</svg> <?php edge_property_reception(); ?>
		</li>
	</ul>

</header>

<div class="c-card__content">
	<ul class="c-card_feature">
	<?php
			keyFeatures(
				get_the_ID(),
				'list'
			);
		?>
	</ul>
</div>

<footer class="c-card__footer">
	<a
		href="<?php echo esc_url( get_the_permalink() ); ?>"
		class="c-btn c-btn--primary c-btn--icon-right"
		>
		Discover More
		<svg
			class="c-icon c-icon--inline c-icon--arrow-right-alt"
			aria-hidden="true"
			focusable="false"
			viewbox="0 0 24 24"
			>
			<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--arrow-right-alt.svg#icon--arrow-right-alt' ); ?>"></use>
		</svg>
	</a>
</footer>

</article>
