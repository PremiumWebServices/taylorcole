<?php
/**
 * Card: News
 *
 * @package EDGE\TaylorCole\Components
 */

$terms = wp_get_post_terms(
	get_the_ID(),
	'category',
	[]
);

?>

<article
	class="c-card c-card--news"
	>

	<aside class="c-card__aside">
		<?php
			the_post_thumbnail(
				'tc-property',
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
					'tc-property',
					false,
					[
						'class' => 'c-card__media c-card__image',
					]
				);
			endif;
		?>
	</aside>

	<header class="c-card__header" data-mh="c-card__header">
		<?php
			the_title(
				'<h2 class="c-title c-title--tertiary"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>'
			);
		?>
		<!--<p class="c-news__meta">
			<span class="author vcard">
				<?php echo esc_html( get_the_author() ); ?>
			</span>  |  <?php edge_time_ago(); ?></p>-->
	</header>

	<div class="c-card__body">
		<?php
			the_excerpt();
		?>
	</div>
	<?php
		if ( $terms ) :
		?>
	<div class="c-topics" data-mh="c-card__topic">
		<h3>Topic</h3>
		<ul class="c-topics__lists">
			<?php
				foreach ( $terms as $value ) :
				?>
				<li><?php
						echo esc_html(
							$value->name
						);
					?></li>
				<?php
				endforeach;
			?>
		</ul>
	</div>
	<?php
		endif;
	?>

	<footer class="c-card__footer">
		<a
			href="<?php echo esc_url( get_the_permalink() ); ?>"
			class="c-btn c-btn--primary c-btn--icon-right"
			>
			<?php
				esc_html_e(
					'Read More',
					'taylore-cole'
				);
			?>
			<svg
				class="c-icon c-icon--inline c-icon--arrow-right-alt"
				aria-hidden="true"
				focusable="false"
				viewbox="0 0 24 24"
				>
				<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--arrow-right-alt.svg#icon--arrow-right-alt' ); ?>"></use>
			</svg>
		</a>
	</footer>


</article>
