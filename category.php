<?php
/**
 * News Category
 *
 * @package EDGE\TaylorCole
 */

get_header();

?>

<main role="main" id="content">

	<section
		class="c-section c-section--news-list"
		data-analytics=""
		>

		<div
			class="o-container"
			>

			<header class="c-header c-header--hightlight">
				<?php
					the_archive_title(
						'<h1 class="c-title c-title--primary">',
						'</h1>'
					);
				?>
			</header><!-- .page-header -->

				<?php if ( have_posts() ) : ?>
					<div class="c-news-grid">
						<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
								get_template_part(
									'components/card',
									'news'
								);
							endwhile;
						?>
					</div>
				<?php endif; ?>

				<nav class="c-pagination">
					<?php edge_pagination_bar(); ?>
				</nav>

		</div>

	</section>

</main>

<?php
	get_footer();
