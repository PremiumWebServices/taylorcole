<?php
/**
 * Card: Testimonial
 *
 * @package EDGE\TaylorCole
 */

?>

<article class="c-testimonial">

	<div class="o-container c-testimonial__container">

		<figure class="c-testimonial__image">
			<?php
				the_post_thumbnail(
					'edge-blog--teaser',
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
					get_option( 'posts_image' ),
					'edge-blog--teaser',
					false,
					[
						'class' => 'c-card__media c-card__image',
					]
				);
			endif;
			?>
		</figure>

		<div class="c-testimonial__content">

			<header>

				<svg
					class="c-icon c-icon--quote"
					viewbox=" 0 0 36 26"
					aria-hidden="true"
					>
					<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--quote.svg#icon--quote' ); ?>">
				</use>
				</svg>

				<h2 class="c-title--primary c-card_title">
					<?php echo esc_html(get_field('testimonial_headline')); ?>
				</h2>
			</header>

			<div class="c-testimonial__quote">

				<?php
					echo wp_kses_post(
						the_content()
					);
				?>

				<p class="c-testimonial__author">
					<?php
						esc_html(
							the_title()
						);
					?>
				</p>

			</div>

		</div>

	</div>

</article>
