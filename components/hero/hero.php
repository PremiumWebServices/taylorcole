<?php
/**
 * Hero: default
 *
 * @package EDGE\TaylorCole\Components\Hero
 */

$edge_hero_show = get_post_meta(
	get_the_ID(),
	'hero_show',
	true
);

// Gate template if not content available.
if ( ! $edge_hero_show ) {
	return;
}

$edge_hero_image = get_post_meta(
	get_the_ID(),
	'hero_image',
	true
);

$edge_hero_theme = get_post_meta(
	get_the_ID(),
	'hero_theme',
	true
);

$edge_hero_body = get_post_meta(
	get_the_ID(),
	'hero_body',
	true
);

$edge_hero_title = get_post_meta(
	get_the_ID(),
	'hero_title',
	true
);

$edge_hero_description = get_post_meta(
	get_the_ID(),
	'hero_description',
	true
);

?>

<section
		class="c-hero <?php echo esc_attr( 't-' . $edge_hero_theme ); ?>"
		>

	<?php
		if ( $edge_hero_image ) : ?>
			<figure class="c-hero__base">
				<?php echo wp_get_attachment_image(
					$edge_hero_image,
					'large',
					false,
					null
				); ?>
			</figure>
		<?php
		endif;
	?>

	<div class="c-hero__container u-align-middle">

		<div class="c-hero__content">

			<?php if ( 'content' === $edge_hero_body ) : ?>

				<?php if ( $edge_hero_title ) : ?>
					<h1 class="c-hero__heading">
						<?php
							echo esc_html( $edge_hero_title );
						?>
					</h1>
				<?php endif; ?>

				<?php if ( $edge_hero_description ) : ?>
					<div class="c-hero__description">
					<?php
						echo wp_kses_post(
							apply_filters(
								'edge_wysiwyg_field',
								$edge_hero_description
							)
						);
						?>
					</div>
				<?php endif; ?>

			<?php endif; ?>

			<?php
				if ( 'property' === $edge_hero_body ) :
					get_template_part(
						'components/property-search'
					);
				endif;
			?>

		</div>

	</div>

</section>
