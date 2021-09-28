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
 * @package EDGE\TaylorCole
 */

get_header();

do_action( 'EDGE\Hero' );

?>

<?php
	if ( have_posts() ) :
?>
<main role="main" id="content">

<ul class="c-team-grid">

<?php
	/* Start the Loop. */
	while ( have_posts() ) :
		the_post();
		?>

		<?php
		get_template_part(
			'components/team',
			'teaser'
		);
		?>
	<?php
	endwhile;
?>
	</ul>

</main>

<?php endif; ?>

<?php
	get_footer();
