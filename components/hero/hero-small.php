<?php
/**
 * Hero: Small
 *
 * @package EDGE\TaylorCole\Components\Hero
 */

?>

<section
		class="c-hero c-hero--small <?php echo esc_attr( 't-' . $hero->theme ); ?>"
		>

	<?php
		if ( $hero->content->image ) : ?>
			<figure class="c-hero__base">
				<?php echo wp_get_attachment_image(
					$hero->content->image ,
					'large',
					false,
					null
				); ?>
			</figure>
		<?php
		endif;
	?>

	<div class="c-hero__container u-align-middle">

		<div class="c-hero__content u-text-center">

			<div class="c-hero__icon u-align-center">
				<?php
					echo wp_get_attachment_image(
						$hero->content->icon,
						'thumbnail',
						false
					);
				?>
			</div>

			<?php if ( $hero->content->title ) : ?>
				<h1 class="c-hero__heading">
					<?php
						echo esc_html( $hero->content->title );
					?>
				</h1>
			<?php endif; ?>

			<?php if ( $hero->content->description ) : ?>
				<div class="c-hero__description">
				<?php
					echo wp_kses_post(
						apply_filters(
							'edge_wysiwyg_field',
							$hero->content->description
						)
					);
					?>
				</div>
			<?php endif; ?>

		</div>

	</div>

</section>
