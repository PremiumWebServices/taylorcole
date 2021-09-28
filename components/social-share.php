<?php
/**
 * Social Sharing
 *
 * @package EDGE\EDGECreative\Components
 */

?>

<section class="c-section--social-share">
	<div class="o-container">
		<div class="c-social-share">
			<?php esc_html_e( 'Share this', 'taylor-cole' ); ?>

			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>" target="_blank" rel="noopener">		<svg
					class="c-icon c-icon--inline c-icon--facebook"
					viewbox=" 0 0 25 25"
					>
					<title>Share this news post via Facebook</title>
					<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--facebook.svg#icon--facebook' ); ?>">
				</use>
				</svg>
			</a>

			<a href="https://twitter.com/home?status=<?php echo esc_url( get_permalink() ); ?>" target="_blank" rel="noopener">
				<svg
					class="c-icon c-icon--inline c-icon--twitter"
					viewbox=" 0 0 25 25"
					>
					<title>Share this news post via Twitter.</title>
					<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--twitter.svg#icon--twitter' ); ?>">
				</use>
				</svg>
			</a>

			<a href="mailto:?body=<?php echo esc_url( get_permalink() ); ?>" target="_blank" rel="noopener">
				<svg
					class="c-icon  c-icon--inline c-icon--mail"
					viewbox=" 0 0 25 25"
					>
					<title>Share this news post by e-mail.</title>
					<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--mail.svg#icon--mail' ); ?>"></use>
				</svg>
			</a>

			<button onclick="javascript:window.print();" class="c-btn c-btn--print" id="#print" target="_blank" rel="noopener">
				<svg
					class="c-icon c-icon--inline c-icon--print"
					viewbox=" 0 0 25 25"
					>
					<title>Print this news post.</title>
					<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--print.svg#icon--print' ); ?>">
				</use>
				</svg>
			</button>

		</div>
	</div>
</section>
