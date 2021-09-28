<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package EDGE\Toolkit
 */

?>

<?php
	/**
	 * Hook: EDGE\Footer.
	 */
	do_action( 'EDGE\Footer' );
?>

<?php
	wp_footer();
?>

</body>
</html>
