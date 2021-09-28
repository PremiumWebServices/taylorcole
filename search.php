<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EDGE/TaylorCole
 */

global $query_string;

wp_parse_str(
	$query_string,
	$search_args
);

// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
$search_query = new WP_Query( $search_args );

get_header();

?>

<main
	<?php post_class( ['site-main'] ); ?>
	id="content"
	>

	<aside class="wp-block-edgetoolkit-section c-section c-section--narrow alignwide">
		<div class="c-section__container u-align-center u-align-middle">
			<h2 class="c-title c-title--primary has-text-align-center">
				Site Search
			</h2>
			<div clas="has-text-align-center">
				<?php
					get_search_form();
				?>
			</div>
		</div>
	</aside>

	<section class="wp-block-edgetoolkit-section c-section t-neutral">
		<div class="o-container">
			<?php
				if ( $search_query->have_posts() ) :
				?>

				<header class="">
					<h1 class="c-title c-title--secondary screen-reader-text">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'taylor-cole' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</header>

				<?php
					/* Start the Loop */
					while ( $search_query->have_posts() ) :
						$search_query->the_post();
						?>
						<article
							id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

								<?php if ( 'post' === get_post_type() ) : ?>
								<div class="entry-meta">
								</div><!-- .entry-meta -->
								<?php endif; ?>
							</header><!-- .entry-header -->

							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->

							<footer class="entry-footer">

							</footer><!-- .entry-footer -->
						</article><!-- #post-<?php the_ID(); ?> -->

				<?php

					endwhile;
					?>


				<nav class="c-pagination c-pagination-search">
					<?php
						the_posts_navigation([
							'prev_text' => __( 'Older results', 'taylor-cole' ),
							'next_text' => __( 'Newer results', 'taylor-cole' ),
							'screen_reader_text' => __( 'Search results naviation:', 'taylor-cole' ),
							'aria_label' => __( 'Search', 'taylor-cole' ),
						]);
					?>
				</nav>

			<?php
				else :
					?>

					<h1 class="c-title c-title--secondary">
						No search results found
					</h1>
					<p>Please try widening your search parameters.</p>
				<?php
				endif;
			?>
		</div>
	</section>

</main><!-- #main -->

<?php
get_footer();
