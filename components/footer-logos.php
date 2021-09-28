<?php
/**
 * Footer: Logos
 *
 * @package EDGE\TaylorCole\Components
 */

$tc_footer_logos = get_option(
	'options_footer_logos'
);

if ( ! $tc_footer_logos ) {
	return;
}

?>

<aside class="c-footer__logos">

	<ul class="c-list-logos">
		<?php
			for( $count = 0; $count < $tc_footer_logos; $count++ ) :
				$tc_footer_logos_logo = get_option(
					'options_footer_logos_' . $count . '_logo'
				);
				$tc_footer_logos_link = get_option(
					'options_footer_logos_' . $count . '_link'
				);
			?>

				<li class="c-list-logos__item">
					<a
						href="<?php echo esc_url( $tc_footer_logos_link['url'] ); ?>"
						<?php if ( ! empty( $tc_footer_logos_link['target'] ) ) : ?>
						target="<?php echo esc_attr( $tc_footer_logos_link['target'] ); ?>"
						rel="noopener"
						<?php endif; ?>
						>
						<?php
							echo wp_get_attachment_image(
								$tc_footer_logos_logo,
								'tc-footer-logos'
							);
						?>
					</a>
				</li>
			<?php
			endfor;
		?>
	</ul>

</aside>
