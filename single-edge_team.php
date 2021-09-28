<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */

get_header();

do_action( 'edge/hero' );

?>

<?php
	if ( have_posts() ) :
?>
<main role="main">
	<article
		<?php post_class( ['s-profile', 'c-profile' ] ); ?>
		id="post-<?php the_ID(); ?>"
		>
		<?php 	/* Start the Loop */
			while ( have_posts() ) :
				the_post();
			?>
	<div class="c-section__container">
				<aside
					class="c-profile__aside"
					>
					<?php
						the_post_thumbnail(
							'edge-team-profile',
							[
								'class' => 'c-profile__image',
							]
						);
						// Show fallback image
						if ( ! has_post_thumbnail() ) :
							echo wp_get_attachment_image(
								get_option( 'team_featured_image' ),
								'edge-team-profile',
								false,
								[
									'class' => 'c-profile__image',
								]
							);
						endif;
					?>
				</aside>

				<header
					class="c-profile__header u-text-center"
					data-analytics=""
					>

					<div
						class="c-header c-section__container"
						>

						<div
							class="c-section__header"
							>
								<?php
									the_title(
										'<h1 class="c-title c-title--secondary">',
										'</h1>'
									);
								?>

								<?php if ( $qualifications = get_post_meta( get_the_ID(), 'qualifications', true ) ) : ?>
									<p class="c-profile__qualification">
										<?php echo esc_html( $qualifications ); ?>
									</p>
								<?php endif; ?>

								<?php if ( $job_title = get_post_meta( get_the_ID(), 'job_title', true ) ) : ?>
									<p class="c-profile__job-title">
										<?php echo esc_html( $job_title ); ?>
									</p>
								<?php endif; ?>

								<?php if ( $email = get_post_meta( get_the_ID(), 'email', true ) ) : ?>
								<p class="c-profile__email">
								<svg
									class="c-icon c-icon--small c-icon--email"
									viewbox="0 0 25 25"
									>
									<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--mail.svg#icon--mail' ); ?>"></use>
								</svg>
								<a
									href="<?php echo esc_url( 'mailto:' . $email ); ?>?subject=Website Enquiry"
									>
									<?php echo esc_html( $email ); ?>
								</a>
								</p>
								<?php endif; ?>

						</div>

					</div>

				</header>

				<div class="c-profile__content c-section__container o-container o-container--narrow">
					<?php
						the_content();
					?>
				</div>

				<footer class="c-profile__footer">
					<div class="wp-block-button">
						<a
							class="wp-block-button__link"
							href="<?php echo esc_url( get_post_type_archive_link( 'edge_team' ) ); ?>">
							Back to Team Members
						</a>
					</div>
				</footer>

			<?php
				endwhile;
				?>




			</div>

	</article>

</main>

<?php endif; ?>

<?php
	get_footer();
