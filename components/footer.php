<?php
/**
 * Footer.
 *
 * @package EDGE\Components
 */

$footer_image = get_template_directory_uri() . '/dist/svg/logo_taylor-cole.svg#logo-taylor-cole';
$footer_name = get_bloginfo( 'name' );
$footer_size = '283 182';

if( is_page_template( 'page-templates/page-lettings.php' ) ) {
	$footer_image = get_template_directory_uri() . '/dist/svg/logo_taylor-cole-lettings.svg#logo-taylor-cole-lettings';
	$footer_name = 'Taylor Cole Residential Lettings';
	$footer_size = '283 173';
}

if(
	is_page_template( 'page-templates/page-fine-village.php' ) ||
	'2' === $tc_get_property_theme = get_post_meta(
		get_the_ID(),
		'branchID',
		true
	)
	) {
	$footer_image = get_template_directory_uri() . '/dist/svg/logo_taylor-cole-signature.svg#logo-taylor-cole-signature';
	$footer_name = 'Taylor Cole Signiture';
	$footer_size = '226 184';
}

?>

<footer class="c-footer">
	<div class="c-footer__container">

	<section class="c-masthead">
		<a class="c-logo-wrap"
				href="<?php echo esc_url( get_home_url() ); ?>">
				<svg
					class="c-logo"
					viewBox="<?php echo esc_attr( '0 0 ' . $footer_size ); ?>"
					>
					<title><?php echo esc_html( $footer_name ); ?></title>
					<use xlink:href="<?php echo esc_url( $footer_image ); ?>"></use>
				</svg>
			</a>
	</section>

	<section class="c-footer__contact">
		<header>
			<h2>Contact</h2>
		</header>

		<article>
			<h3>Sales Team</h3>
			<svg
			class="c-icon c-icon--inline c-icon--phone"
			viewbox=" 0 0 15 15"
			>
			<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--phone.svg#icon--phone' ); ?>"></use>
			</svg><a href="tel:01827311412" target="_top">01827 311412</a> <svg
			class="c-icon c-icon--inline c-icon--mail"
			viewbox=" 0 0 25 25"
			>
			<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--mail.svg#icon--mail' ); ?>"></use>
			</svg><a href="mailto:sales@taylorcole.co.uk?subject=Website Enquiry" target="_top">sales@taylorcole.co.uk</a><br>
			6a Victoria Road, Tamworth, Staffordshire, B79 7HL
		</article>

		<article>
			<h3>Lettings Team</h3>
			<svg
			class="c-icon c-icon--inline c-icon--phone"
			viewbox=" 0 0 15 15"
			>
			<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--phone.svg#icon--phone' ); ?>"></use>
			</svg><a href="tel:01827311511" target="_top">01827 311511</a> <svg
			class="c-icon c-icon--inline c-icon--mail"
			viewbox=" 0 0 25 25"
			>
			<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--mail.svg#icon--mail' ); ?>"></use>
			</svg><a href="mailto:lettings@taylorcole.co.uk?subject=Website Enquiry" target="_top">lettings@taylorcole.co.uk</a><br>
			8a Victoria Road, Tamworth, Staffordshire, B79 7HL
		</article>


	</section>

	<section class="c-footer__social">

		<div class="c-footer__link-top">
			<a class="c-footer__top" href="#top">
				<svg
					class="c-icon c-icon--arrow-up"
					viewBox=" 0 0 24 24"
					>
					<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--arrow-up	.svg#icon--arrow-up	' ); ?>"></use>
				</svg>

				back to top
			</a>
		</div>

		<?php
			get_template_part(
				'components/social'
			);
			get_template_part(
				'components/footer-logos'
				);
		?>

	</section>

	<hr class="c-footer__separator">

	<?php
		if ( $tc_footer_text = get_option( 'options_footer_text' ) ) :
		?>
		<section class="c-description c-footer__description">
			<?php
				echo wp_kses_post(
					apply_filters(
						'edge_wysiwyg_field',
						$tc_footer_text
					)
				);
				?>
		</section>
		<?php
		endif;
	?>

	<section class="c-footer__links">

			<?php
				get_template_part(
					'components/footer-menu'
				);
			?>

		<article class="c-legalise">
			<p>&copy; <?php echo esc_html( date("Y") ); ?> Taylor Cole | <a href="https://www.edge-creative.com/" target="_blank" rel="noopener">Website by EDGE Creative</a></p>
		</article>
	</section>

	</div>
</footer>
