<?php
/**
 * Hero: default
 *
 * @package EDGE\TaylorCole\Components\Hero
 */

?>

<section
		class="c-hero c-hero--search <?php echo esc_attr( 't-' . $hero->theme ); ?>"
		>

	<?php
		if ( $hero->content->image ) : ?>
			<figure class="c-hero__base">
				<?php echo wp_get_attachment_image(
					$hero->content->image,
					'large',
					false,
					null
				); ?>
			</figure>
		<?php
		endif;
	?>

	<div class="c-hero__container u-align-middle">

		<?php if( is_page( 199 ) ) :
			$header_image = get_template_directory_uri() . '/dist/svg/logo_taylor-cole-signature.svg#logo-taylor-cole-signature';
			$header_name = 'Taylor Cole Signature';
			$header_size = '226 184';
		?>

			<header class="c-hero__header">

				<p class="intro">Introducing</p>

				<svg
					class="c-logo"
					viewBox="<?php echo esc_attr( '0 0 ' . $header_size ); ?>"
					>
					<title><?php echo esc_html( $header_name ); ?></title>
					<use xlink:href="<?php echo esc_url( $header_image ); ?>"></use>
				</svg>

				<?php
					$hero_extra_content = get_post_meta( get_the_ID(), 'hero_extra_content', true );
					if ( $hero_extra_content ) {
						echo wp_kses_post(
							apply_filters(
								'edge_wysiwyg_field',
								$hero_extra_content
							)
						);
					}
				?>

			</header>




		<?php endif; ?>



		<div class="c-hero__content">

			<?php
					get_template_part(
						'components/property-search'
					);
			?>

		</div>

	</div>

</section>
