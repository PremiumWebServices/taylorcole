<?php
/**
 * Form: Stamp Duty Calculator
 *
 * @package EDGE\TaylorCole\Components\Forms
 */
?>


<?php

/*$result = null;
if ( isset( $_POST['contact_submit'] ) && 'true' == $_POST['contact_submit'] ) {
  $result = validate_contact_form( $_POST );
}*/

?>

<section class="c-form t-primary">

	<fieldset class="c-form__fieldset">

		<legend class="c-title c-title--primary u-align-center">
			Stamp Duty Calculator
		</legend>

		<section class="c-form__row-2">

			<div class="c-form__group form__item-1">

				<label class="c-form__label" for="form-interest-rate">
					Property Value<span class="c-form__description c-form__description--required">*</span>
				</label>

				<div class="c-form__group--append">
					<div class="c-form__input-pound">&pound;</div>
					<input
						class="c-form__input <?php echo ( ( isset( $result['errors']['property_value'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
						id="form-interest-rate"
						name="property_value"
						type="number"
						required="required"
						value="<?php echo esc_attr( ( isset( $_POST['property_value'] ) ) ? sanitize_text_field(wp_unslash($_POST['property_value'])) : '' ) ?>"
						/>
				</div>
				<?php if ( isset( $result['errors']['property_value'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['property_value'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-2">

				<label class="c-form__label" for="form-interest-rate">
					Property type<span class="c-form__description c-form__description--required">*</span>
				</label>

				<select
					class="c-form__input <?php echo ( ( isset( $result['errors']['property_value'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="form-property-type"
					name="property_type"
					type="type"
					required="required"
					value="<?php echo esc_attr( ( isset( $_POST['property_value'] ) ) ? sanitize_text_field(wp_unslash($_POST['property_value'])) : '' ) ?>"
					>
					<option value="">Select the type of Property</option>
					<option value="first">First-time Buyers</option>
					<option value="residential">Residential</option>
					<option value="second">Buy-to-Let or Second Home Purchases</option>
				</select>

				<?php if ( isset( $result['errors']['property_value'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['property_value'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<input
				id="template_directory"
				name="template_directory"
				type="hidden"
				value="<?php echo esc_url( get_template_directory_uri() ); ?>"
				/>

		</section>

	</fieldset>

	<section>
		<div class="c-form__group u-text-center">

			<button
				class="c-btn c-btn--tertiary c-btn--medium"
				id="stamp_duty_submit"
				name="stamp_duty_submit"
				type="submit"
				value="true"
				>
				Calculate Stamp Duty
			</button>

		</div>
	</section>

</section>
