<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

get_header();

?>

<main
	<?php post_class( ['site-main'] ); ?>
	id="content"
	>

	<section class="wp-block-edgetoolkit-section c-section c-section--narrow alignwide error404 no-results not-found">

	<div class="c-section__container u-align-center u-align-middle">

		<header class="entry-header">
				<h1 class="c-title c-title--primary has-text-align-center">
					<?php esc_html_e( 'Page not found (Error: 404)', 'taylorcole' ); ?>
				</h1>
			</header>

			<div class="has-text-align-center">
				<p><?php esc_html_e( 'Check that the link you followed was spelt correctly.', 'taylorcole' ); ?></p>
			</div>

		</div>

	</section>

	<aside
		class="wp-block-edgetoolkit-section c-section c-section--narrow alignwide"
		>
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

	</main><!-- #main -->

<?php get_footer(); ?>
