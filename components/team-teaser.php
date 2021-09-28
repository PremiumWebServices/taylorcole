<?php
/**
 * Card: Team Teaser
 *
 * @package EDGE\TaylorCole\Components
 */

?>
<li
	class="c-card c-card--team c-profile"
	>
	<a class="" href="<?php echo esc_url(get_permalink()); ?>">
	<figure class="c-card__aside c-profile__image">
		<?php
			// Show fallback image
			$member_profile = get_option( 'team_featured_image', false );

			if ( has_post_thumbnail( get_the_ID() ) ) {
				$member_profile = get_post_thumbnail_id( get_the_ID() );
			}
			echo wp_get_attachment_image(
				$member_profile,
				'edge-team-profile',
				false,
				[
					'class' => 'c-profile__image',
				]
			);
		?>
	</figure>
	</a>

	<section class="c-card__body">
		<div class="c-card__content">

			<h3 class="c-title c-title--quaternary c-profile__name">
				<?php the_title(); ?>
			</h3>

			<?php
				$team_job_title = get_post_meta( get_the_ID(), 'job_title', true );
				$team_qualifications = get_post_meta( get_the_ID(), 'qualifications', true );
				if ( $team_job_title || $team_qualifications ):?>
				<p class="c-profile__job-title">
					<?php if ( $team_job_title  ) : ?>
						<?php echo esc_html( $team_job_title ); ?>
					<?php endif; ?>

					<?php if ( $team_job_title && $team_qualifications ) : ?>
						<?php echo ' / '; ?>
					<?php endif; ?>

					<?php if ( $team_qualifications  ) : ?>
						<?php echo esc_html( $team_qualifications ); ?>
					<?php endif; ?>
				</p>
				<?php
				endif;
			?>

		</div>
		<div class="wp-block-button">
			<a class="wp-block-button__link" href="<?php echo esc_url(get_permalink()); ?>">View Profile</a>
		</div>
	</section>

</li>
