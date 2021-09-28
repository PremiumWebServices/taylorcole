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
	class="c-section c-section--property_search"
	data-analytics=""
	>

	<div class="c-section__container">

		<h2 id="selling_heading"><?php echo esc_html($selling_heading) ?></h2>
		<h2 id="buying_heading"><?php echo esc_html($buying_heading) ?></h2>
		<h2 id="lettings_heading"><?php echo esc_html($lettings_heading) ?></h2>

		<div id="tabbed_search" class="tab">

			<?php
			 $search_tabs = array('Selling','Buying','Lettings');
			 foreach($search_tabs as $this_tab){
				 if ($this_tab == $default_tab){
					echo '<button id="defaultOpen" class="tablinks tab-'.esc_html($this_tab).'" onclick="openTab(event, \''.esc_html($this_tab).'\')">'.esc_html($this_tab).'</button>';
				 } else {
					echo '<button class="tablinks tab-'.esc_html($this_tab).'" onclick="openTab(event, \''.esc_html($this_tab).'\')">'.esc_html($this_tab).'</button>';
				 }
			 }
			 ?>
		</div>

		<div id="Selling" class="tabcontent">
			<form id="valuation" name="valuation" method="post" action="<?php echo esc_url($selling_page) ?>">
				<input type="text" name="postcode" placeholder="Enter Postcode" />
				<button type="submit" class="button pull--right">Get A Valuation</button>
			</form>
		</div>

		<div id="Buying" class="tabcontent">
		<form id="sales" name="sales" class="form--search row" method="get" action="<?php echo esc_url($buying_page) ?>?type=sales">
				<!-- <input type="text" name="post_type" value="sales" hidden> -->
				<input type="text" name="order" value="price" hidden>

				<div class="row">
					<div class="column--2-3">
						<label>Location</label>
						<input type="text" name="l" value="<?php echo esc_html( $posted_data['l'] ); ?>"/>
					</div>
					<div class="column--1-3">
						<label>Search Radius</label>
						<select class="cs-select cs-skin-border" name="searchRadius">
							<option value="2000000000">Everywhere</option>
							<option value="1">1 miles</option>
							<option value="2">2 miles</option>
							<option value="5">5 miles</option>
							<option value="10">10 miles</option>
						</select>
					</div>
				</div>

				<div class="row">

					<div class="column--1-3">
						<label>Price Range</label>
						<select class="half-width cs-select cs-skin-border" name="minp">
							<option value="0">No Min</option>
							<option value="100000">£100,000</option>
							<option value="500000">£500,000</option>
							<option value="1000000">£1,000,000</option>
							<option value="1500000">£1,500,000</option>
							<option value="2000000">£2,000,000</option>
						</select>
						<select class="half-width cs-select cs-skin-border" name="maxp">
							<option value="20000000">No Max</option>
							<option value="100000">£100,000</option>
							<option value="500000">£500,000</option>
							<option value="1000000">£1,000,000</option>
							<option value="1500000">£1,500,000</option>
							<option value="2000000">£2,000,000</option>
						</select>
					</div>

					<div class="column--1-3">
						<label>Number of Bedrooms</label>
						<select class="half-width cs-select cs-skin-border" name="minb">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<select class="half-width cs-select cs-skin-border" name="maxb">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
					</div>

					<div class="column--1-3">
						<label>Show sold/under offer</label>
						<select class="cs-select cs-skin-border" name="showSold">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>

				</div>


				<div class="row">
					<div class="column--4-4">
						<button type="submit" class="button pull--right">Get Properties</button>
					</div>
				</div>

			</form>
		</div>

		<div id="Lettings" class="tabcontent">
		<form id="sallettingses" name="lettings" class="form--search row" method="get" action="<?php echo esc_url($lettings_page) ?>?type=lettings">
				<!-- <input type="text" name="post_type" value="lettings" hidden> -->
				<input type="text" name="order" value="price" hidden>

				<div class="row">
					<div class="column--2-3">
						<label>Location</label>
						<input type="text" name="l" value="<?php echo esc_html( $posted_data['l'] ); ?>"/>
					</div>
					<div class="column--1-3">
						<label>Search Radius</label>
						<select class="cs-select cs-skin-border" name="searchRadius">
							<option value="2000000000">Everywhere</option>
							<option value="1">1 miles</option>
							<option value="2">2 miles</option>
							<option value="5">5 miles</option>
							<option value="10">10 miles</option>
						</select>
					</div>
				</div>

				<div class="row">

					<div class="column--1-3">
						<label>Price Range</label>
						<select class="half-width cs-select cs-skin-border" name="minp">
							<option value="0">No Min</option>
							<option value="100000">£100,000</option>
							<option value="500000">£500,000</option>
							<option value="1000000">£1,000,000</option>
							<option value="1500000">£1,500,000</option>
							<option value="2000000">£2,000,000</option>
						</select>
						<select class="half-width cs-select cs-skin-border" name="maxp">
							<option value="20000000">No Max</option>
							<option value="100000">£100,000</option>
							<option value="500000">£500,000</option>
							<option value="1000000">£1,000,000</option>
							<option value="1500000">£1,500,000</option>
							<option value="2000000">£2,000,000</option>
						</select>
					</div>

					<div class="column--1-3">
						<label>Number of Bedrooms</label>
						<select class="half-width cs-select cs-skin-border" name="minb">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<select class="half-width cs-select cs-skin-border" name="maxb">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
					</div>

					<div class="column--1-3">
						<label>Show sold/under offer</label>
						<select class="cs-select cs-skin-border" name="showSold">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>

				</div>


				<div class="row">
					<div class="column--4-4">
						<button type="submit" class="button pull--right">Get Properties</button>
					</div>
				</div>

			</form>
		</div>



	</div>

</section>


	</div>

</section>
