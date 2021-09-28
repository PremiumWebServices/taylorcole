<?php
/**
 *
 * @author EDGE Creative Solutions
 *
 */

get_header();

?>

<main class="testimonials-archive blog-archive"  id="content" role="main">

	<?php
		if ( have_posts() ) :
		?>

		<section
			class="c-card_testimonials c-archive_testimonials">

			<?php
				while ( have_posts() ) :
					the_post();

						get_template_part(
							'/components/testimonial/testimonial-card'
						);

				endwhile;
			?>
		</section>

		<?php
		endif;
	?>

	<nav class="c-pagination">
		<?php edge_pagination_bar(); ?>
	</nav>

</main>

<?php
get_footer();
