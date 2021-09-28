<?php
/**
 * Search Form: Lettings
 */

?>

<form
	id="lettings"
	name="lettings"
	class="form--search row"
	method="get"
	action="/properties/#content"
	>

	<legend class="c-title c-title--tertiary">
		Refine your search
	</legend>

	<div class="c-form__group--as">
		<input type="text" name="type" value="lettings" hidden>
		<input type="text" name="order" value="price" hidden>
	</div>

	<div class="c-form__group c-form__row-3">
		<div class="c-form__item-1">
			<label class="c-form__label">
				<?php esc_html_e( 'Include Let Agreed', 'taylor-cole' ); ?>
			</label>

			<select class="c-form__select" name="showSold">
				<option value="yes"><?php esc_html_e( 'Yes', 'taylor-cole' ); ?></option>
				<option value="no" <?php echo ( ( isset($_GET['showSold']) && 'no' == $_GET['showSold'] ) ? 'selected="selected"' : '' ) ?>><?php esc_html_e( 'No', 'taylor-cole' ); ?></option>
			</select>
		</div>
	</div>

	<div class="c-form__group c-form__row-2">

		<div class="c-form__item-1">

			<label class="c-form__label">
			<?php esc_html_e( 'Location', 'taylor-cole' ); ?>
			</label>

			<input
				class="c-form__input"
				type="text"
				name="l"
				value="<?php echo ( isset( $posted_data['l'] ) ) ? esc_html( $posted_data['l']) : ''; ?>"
				>

		</div>

		<div class="c-form__item-2">

			<label class="c-form__label">
			<?php esc_html_e( 'Search Radius', 'taylor-cole' ); ?>
			</label>

			<select
				class="c-form__select"
				name="r"
				>
				<option value="2000000000">
					<?php esc_html_e( 'Everywhere', 'taylor-cole' ); ?>
				</option>
				<option value="1">1 mile</option>
				<option value="2">2 miles</option>
				<option value="5">5 miles</option>
				<option value="10">10 miles</option>
			</select>

		</div>

	</div>

	<?php
			$min_price = 300;
			$max_price = 2000;
			$step = 100;
	?>

	<div class="c-form__group c-form__row-2">

		<div class="c-form__item-1">

			<label class="c-form__label">
				<?php esc_html_e( 'Minimum Price', 'taylor-cole' ); ?>
			</label>

			<select class="c-form__select" name="minp">
				<option
					value="0"
					selected="selected"
					>
					<?php esc_html_e( 'No Min', 'taylor-cole' ); ?>
				</option>
				<?php for ($i=$min_price; $i <= $max_price; $i += $step): ?>
							<option value="<?php echo esc_html($i) ?>" <?php echo ( ( isset($_GET['minp']) && $i == $_GET['minp'] ) ? 'selected="selected"' : '' ) ?> ><?php echo esc_html(tc_get_currency_format((integer)$i*100)) ?></option>
				<?php endfor; ?>
			</select>

		</div>

		<div class="c-form__item-2">

			<label class="c-form__label">
			<?php esc_html_e( 'Maximum Price', 'taylor-cole' ); ?>
			</label>

			<select class="c-form__select" name="maxp">
				<option
				value="999999999999"
				selected="selected"><?php esc_html_e( 'No Max', 'taylor-cole' ); ?>
				</option>
				<?php for ($i=$min_price; $i <= $max_price; $i += $step): ?>
							<option value="<?php echo esc_html($i) ?>" <?php echo ( ( isset($_GET['maxp']) && $i == $_GET['maxp'] ) ? 'selected="selected"' : '' ) ?> ><?php echo esc_html(tc_get_currency_format((integer)$i*100)) ?></option>
				<?php endfor; ?>
			</select>

		</div>

	</div>

	<div class="c-form__group c-form__row-2">

		<div class="c-form__item-1">

			<label class="c-form__label">
			<?php esc_html_e( 'Minimum Bedrooms', 'taylor-cole' ); ?>
			</label>

			<select class="c-form__select" name="minb">
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

		<div class="c-form__item-2">

			<label class="c-form__label">
			<?php esc_html_e( 'Maximum Bedrooms', 'taylor-cole' ); ?>
			</label>

			<select class="c-form__select" name="maxb">
				<option value="99">No Max</option>
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

	</div>

	<div class="c-form__group c-form__row-2">

			<div class="c-form__item-2">
					<button
						type="submit"
						class="c-btn c-btn--outline c-btn--full"
						>
						<?php esc_html_e( 'Get Properties', 'taylor-cole' ); ?>
					</button>
			</div>

	</div>

</form>
