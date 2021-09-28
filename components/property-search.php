<?php
/**
 * Block: Property Search
 *
 * @package EDGE\EDGECreative\Components
 */

$posted_data = array(
	'l' => (isset($_GET['l'])) ? '' : isset($_GET['l']),
);


$default_tab   = get_field('default_tab');

$selling_page  = get_permalink(get_field('selling_results_page'));
$buying_page   = get_permalink(get_field('buying_results_page'));
$lettings_page = get_permalink(get_field('lettings_results_page'));

$selling_heading  = get_field('selling_heading');
$buying_heading   = get_field('buying_heading');
$lettings_heading = get_field('lettings_heading');

?>

<section
	class="c-section c-property-search"
	data-analytics=""
	>

	<div class="c-property-search__container">

		<header class="c-property-search__header">

			<h2>
				<?php
					esc_html_e(
						'Your property journey starts here',
						'taylor-cole'
					);
				?>
			</h2>

		</header>

		<div
			class="c-tabbing js-tabs"
			id="hero-search-tabs"
			>

			<ul class="c-tabs js-tabs__header" role="tablist">
				<li class="">
					<a
						class="c-tab c-tab-selling js-tabs__title"
						id="search-selling-tab"
						>
						<?php
							esc_html_e(
								'Selling',
								'taylor-cole'
							);
						?>
					</a>
				</li>
				<li class="">
					<a
						class="c-tab c-tab-buying js-tabs__title"
						id="search-buying-tab"
						>
						<?php
							esc_html_e(
								'Buying',
								'taylor-cole'
							);
						?>
					</a>
				</li>
				<?php if ( ! is_page_template( [
					'page-templates/page-fine-village.php',
					'page-templates/page-signature.php'
				] ) ) : ?>
				<li class="">
					<a
						class="c-tab c-tab-letting js-tabs__title"
						id="search-letting-tab"
						>
					<?php
							esc_html_e(
								'Lettings',
								'taylor-cole'
							);
						?>
					</a>
				</li>
			<?php endif; ?>
			</ul>

			<div class="c-tabbing__content">

				<section
					class="c-tabbing__pane c-pane c-pane--selling js-tabs__content"
					id="search-selling"
					role="tabpanel"
					aria-labelledby="search-selling-tab"
					>
						<?php
							get_template_part(
								'components/search/search',
								'selling'
							);
						?>
				</section>

				<section
					class="c-tabbing__pane c-pane c-pane--buying js-tabs__content"
					id="search-buying"
					role="tabpanel"
					aria-labelledby="search-buying-tab"
					>

						<?php
							get_template_part(
								'components/search/search',
								'buying'
							);
						?>

				</section>
				<?php if ( ! is_page_template( [
					'page-templates/page-fine-village.php',
					'page-templates/page-signature.php'
				] ) ) : ?>
				<section
					class="c-tabbing__pane c-pane c-pane--letting js-tabs__content"
					id="search-letting"
					role="tabpanel"
					aria-labelledby="search-letting-tab"
					>

						<?php
							get_template_part(
								'components/search/search',
								'letting'
							);
						?>

				</section>
				<?php endif; ?>
			</div>

		</div>

	</div>

</section>
