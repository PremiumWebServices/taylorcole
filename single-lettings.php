<?php
/**
 * The Template for displaying all single posts
 *
 */

global $post;

// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
require_once dirname(__FILE__) . '/components/forms/booking-handler.php';

$result = null;
if ( isset( $_POST['contact_submit'] ) && 'true' == $_POST['contact_submit'] ) {

	$result = validate_booking_form( $_POST );
	if ( $result['sent'] ) {

		wp_redirect( get_the_permalink( 146 ) );
		exit();

	}
}

get_header();

?>


<main
	<?php post_class( ['site-main'] ); ?>
	id="content"
	>

	<?php
		while ( have_posts() ) :
			the_post();

			get_template_part(
				'components/property/property-single'
			);

		endwhile;
	?>

</main>

<?php get_footer();
