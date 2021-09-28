<?php
/**
 * Search Form: Selling
 */
?>

<form id="valuation" name="valuation" method="post" action="/calculators/valuation/">

	<legend class="c-title c-title--tertiary">
		Free Online Valuation
	</legend>

	<div
		class="c-form__group c-form__group--inline"
		>

		<input
			class="c-form__input c-form--padding5"
			type="text"
			name="valuation_postcode"
			placeholder="Enter Postcode"
		>

		<button
			type="submit"
			class="c-btn c-btn--outline">
			<?php
				esc_html_e(
					'Get A Valuation',
					'taylor-cole'
				);
			?>
		</button>

	</div>

</form>
