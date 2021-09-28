<?php
/**
 * Template Name: Lettings Branding
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EDGE\TaylorCole\Pages
 */

get_header();

?>

<main
	<?php post_class( ['site-main'] ); ?>
	id="content"
	>

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text">
						<?php single_post_title(); ?>
					</h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post(); ?>

				<div class="entry-content">
					<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', '_s' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );
					?>
				</div>

			<?php
			endwhile;

		endif;
		?>

		</main><!-- #main -->

<?php
get_footer();
