<?php
/**
 * Property: Single
 */

$imageCounter = 0;
$brochures = get_post_meta($post->ID, 'brochures', true);
$tc_property_type = get_post_type();
$tc_property_images = get_post_meta(
	get_the_ID(),
	'images',
	true
);

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

	<?php
		if ( $tc_property_images ) :
		?>
		<section
			class="c-hero c-gallery c-property__gallery"
			>

			<figure class="c-hero__base c-gallery__primary">

				<?php
					echo wp_get_attachment_image(
						$tc_property_images[0],
						'tc-property--full',
						false,
						[ 'class' => '' ]
					);
				?>

			</figure>

			<div class="o-container u-align-bottom">

				<div class="c-property__type c-icon--<?php echo $status_icon; ?>"></div>

			</div>

		</section>

		<aside>
			<div
				class="c-gallery__secondary o-container"
				data-slider="property-single-gallery"
				data-featherlight-gallery
				data-featherlight-filter="a"
				>

				<?php
					// Build Secondary Gallery. Removing first image.
					$tc_property_gallery = array_splice(
						$tc_property_images,
						1
					);
					foreach ( $tc_property_gallery as $value ) :
					?>

						<figure>

							<a
								class="c-gallery__item"
								href="<?php echo esc_url( wp_get_attachment_image_url( $value, 'full' ) ); ?>"
								>

								<?php
									echo wp_get_attachment_image(
										$value,
										'tc-property',
										false,
										[ 'class' => '', ]
									);
								?>
							</a>

						</figure>

					<?php
					endforeach;
				?>

				</div>

		</aside>
		<?php
		endif;
	?>

	<header class="c-property__header">

		<div class="o-container c-property__container">

			<section class="c-card__details">

				<?php
					$tc_get_primary_feature = get_post_meta(
						get_the_ID(),
						'propertyFeature1',
						true
					);
					if ( $tc_get_primary_feature ) :
					?>
					<h1 class="c-card__title">
						<?php echo esc_html( $tc_get_primary_feature ); ?>
					</h1>
					<?php
					endif;
				?>
				<?php
					the_title(
						'<h2 class="c-card__address">',
						'</h2>'
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

			</section>

			<section class="c-property__options">
				<h2>Options</h2>
				<ul
					class="c-card__options"
					>
					<li>
						<svg
							class="c-icon c-icon--inline c-icon--small c-icon--viewing"
							viewbox=" 0 0 24 24"
							>
							<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--viewing.svg#icon--viewing' ); ?>">
							</use>
						</svg>
						<a
							href="#booking-form"
							>
							Arrange a Viewing
						</a>
					</li>
					<!--<li><svg
								class="c-icon c-icon--inline c-icon--small c-icon--map"
								viewbox=" 0 0 24 24"
								>
								<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--map.svg#icon--map' ); ?>">
								</use>
							</svg>Map</li>-->
					<!--<li>Printout</li>-->
					<?php
						if( $floorplans = get_post_meta( get_the_ID(), 'floorplans', true ) ) :
							foreach ( $floorplans as $key => $value) :
						?>
						<li>
							<svg
								class="c-icon c-icon--inline c-icon--small c-icon--floorview"
								viewbox=" 0 0 24 24"
								>
								<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--floorview.svg#icon--floorview' ); ?>">
								</use>
							</svg>
							<a
								href="<?php echo esc_url( wp_get_attachment_image_url( $value, 'full' ) ); ?>"
								data-featherlight="image"
								>
								Floorplan <?php echo esc_html( ( $key + 1 ) ); ?>
							</a>
						</li>
						<?php
						endforeach;
						endif;
					?>
					<?php
						$virtualTours = get_post_meta(
							get_the_ID(),
							'virtualTours',
							true
						);
						if(
							empty( $virtualTours )
							) :
								foreach ( $virtualTours as $key => $value) :
								?>
									<li>
										<!--<svg
										class="c-icon c-icon--inline c-icon--small c-icon--map"
										viewbox=" 0 0 24 24"
										>
										<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--map.svg#icon--map' ); ?>">
										</use>
									</svg>Map</li>-->
									<a
										target="_blank"
										rel="noopener"
										href="<?php echo esc_url( $value['url'] ); ?>"
										data-featherlight-iframe-frameborder="0"
										data-featherlight-iframe-allow="autoplay; encrypted-media"
										data-featherlight-iframe-allowfullscreen="true"
										data-featherlight-iframe-style="display:block;border:none;height:85vh;width:85vw;"
										>
										<?php esc_html_e( 'Virtual Tour', 'taylor-cole' ); ?>
									</a>
								</li>
							<?php
							endforeach;
						endif;
					?>

					<!--<li>Street View</li>-->
					<?php
						if( $epcGraphs = get_post_meta( get_the_ID(), 'epcGraphs', true ) ) :
							foreach ( $epcGraphs as $key => $value) :
						?>
						<li><svg
								class="c-icon c-icon--inline c-icon--small c-icon--epc"
								viewbox=" 0 0 24 24"
								>
								<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--epc.svg#icon--epc' ); ?>">
								</use>
							</svg>
							<a
								href="<?php echo esc_url( wp_get_attachment_image_url( $value, 'full' ) ); ?>"
								data-featherlight="image"
								>
								EPC
							</a>
						</li>
						<?php
						endforeach;
						endif;
					?>
				</ul>
			</section>

			<section class="c-property__features">
				<h2>
					<?php
						esc_html_e(
							'Key Features'
						);
					?>
				</h2>
				<ul class="c-card_feature">
				<?php
					keyFeatures(
						get_the_ID(),
						'list'
					);
				?>
				</ul>
			</section>

		</div>

	</header>

	<article class="c-property__content">

		<div class="o-container">

			<header>
				<h2>Description</h2>
			</header>

			<div class="c-property__description">
				<?php
					the_content();
				?>
			</div>

		</div>

	</article>

	<?php
		get_template_part(
			'components/social',
			'share'
		);
	?>

	<footer class="c-property__footer">
		<?php
			get_template_part(
				'components/forms/form-booking'
			);
		?>
	</footer>
