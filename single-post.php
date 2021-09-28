<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package EDGE\KLO
 */

get_header();

do_action( 'edge/hero' );

?>

<main role="main" id="content">

<?php
	while ( have_posts() ) :
		the_post();
	?>

<div class="hero">
<header class="c-header c-header--hightlight">
		<div class="c-aside">
			<?php
				the_post_thumbnail(
					'hero-small',
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
					'hero-small',
					false,
					[
						'class' => 'c-card__media c-card__image',
					]
				);
			endif;
		?>
		</div>
			<?php
				the_title(
					'<h1 class="c-title c-title--secondary">',
					'</h1>'
				);
			?>
			<?php
				if ( ! has_excerpt() ) {
					echo '';
			} else {
					the_excerpt();
			}
			?>

		</header><!-- .entry-header -->
		</div>
	<article
		<?php post_class( [ 'c-section--news', 's-post' ] ); ?>
		id="post-<?php the_ID(); ?>"
		>





		<div class="c-content">
			<?php
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

	</article><!-- #post-<?php the_ID(); ?> -->

	<?php
			get_template_part(
				'components/social',
				'share'
			)
		?>

<?php
	endwhile; // End of the loop.
?>

</main>

<?php
	get_footer();
