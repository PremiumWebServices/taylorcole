<?php
/**
 * Search Form
 *
 * @package EDGE/TaylorCole
 */

?>

<form
	role="search"
	method="get"
	id="searchform"
	class="c-form searchform"
	action="<?php echo esc_url( home_url( '/' ) ); ?>"
	>

	<div class="c-form__group">
		<label
			class="u-hide-visually c-form__label screen-reader-text"
			for="s"
			>
			Search for:
		</label>

		<input
			class="c-form__input"
			type="text"
			value=""
			name="s"
			id="s"
			>

	</div>

	<div class="c-form__group u-text-center">
		<button
			class="c-btn c-btn--primary"
			type="submit"
			id="searchsubmit"
			>
			<?php
				esc_html_e(
					'Search',
					'taylor-cole'
				);
			?>
		</button>
	</div>


</form>
