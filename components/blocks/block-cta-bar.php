<?php
/**
 * CTA Bar
 *
 * @package EDGE\Toolkit\Components
 */

?>

<section
	class="c-section--cta-bar c-section"
	id="<?php echo esc_attr( $block['id'] ); ?>"
	>
	<div class="o-container">

		<?php
			if ( isset( $block['data']['description'] ) && ! empty( $block['data']['description'] ) ) :
			?>
			<section class="c-section__description u-align-middle">
				<?php
					echo wp_kses_post(
						apply_filters(
							'edge_wysiwyg_field',
							$block['data']['description']
						)
					);
				?>
			</section>
			<?php
			endif;
		?>

		<?php
			if ( isset( $block['data']['link'] ) && ! empty( $block['data']['link'] ) ) :
			?>
			<section class="c-section__cta u-align-middle">
				<a
					class="c-btn c-btn--tertiary"
					href="<?php echo esc_url( $block['data']['link']['url'] ); ?>"
					<?php if ( ! $block['data']['link']['target'] ) : ?>
						target="<?php echo esc_attr( $block['data']['link']['target'] ); ?>"
						rel="noopener"
						<?php endif; ?>
					>
					<?php echo esc_html( $block['data']['link']['title'] ); ?>
				</a>
			</section>
			<?php
			endif;
		?>

	</div>
</section>
