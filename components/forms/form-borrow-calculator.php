<?php
/**
 * Form: Borrowing Calculator
 *
 * @package EDGE\TaylorCole\Components\Forms
 */

require_once get_theme_file_path( '/components/forms/handler-borrow-calculator.php');

$result = null;
if ( isset( $_POST['borrow_submit'] ) && 'true' == $_POST['borrow_submit'] ) {

	$result = validate_borrow_form( $_POST );
	if ( $result['sent'] ) {
		wp_redirect( get_permalink( get_page_by_path( 'thank-you' )->ID ) );
		exit();
	}
}

?>

<section class="c-form t-primary">

	<form
		id="borrow-calculator<?php echo esc_attr( '-' . get_the_ID() ); ?>"
		class="c-form c-form--borrow"
		method="POST"
	>
	
		<fieldset class="c-form__fieldset">

			<legend class="c-title c-title--primary u-align-center">
				How much can I borrow?
			</legend>

			<?php if (
			isset( $result['borrow_amount'] ) &&
			$result['borrow_amount'] !== false
			) : ?>

			<div class="c-form__group">
				<p class="c-form__notification c-form__notification--success">
					You can borrow up to: &#163;<?php echo $result['borrow_amount']; ?>
				</p>
			</div>

			<?php endif; ?>

			<section class="c-form__row-2">

				<div class="c-form__group form__item-1">

					<label class="c-form__label" for="form-borrow-salary">
						Your Salary (Per Annum)<span class="c-form__description c-form__description--required">*</span>
					</label>

					<div class="c-form__group--append">
						<div class="c-form__input-pound">&pound;</div>
						<input
							class="c-form__input <?php echo ( ( isset( $result['errors']['borrow_salary'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
							id="form-borrow-salary"
							name="borrow_salary"
							type="number"
							required="required"
							value="<?php echo esc_attr( ( isset( $_POST['borrow_salary'] ) ) ? sanitize_text_field(wp_unslash($_POST['borrow_salary'])) : '' ) ?>"
							/>
					</div>
					<?php if ( isset( $result['errors']['borrow_salary'] ) ): ?>
						<p class="form__message form__message--error js-form-message js-form-message--error">
							<?php echo esc_html( $result['errors']['borrow_salary'] ); ?>
						</p>
					<?php endif; ?>

				</div>

				<div class="c-form__group form__item-2">

					<label class="c-form__label" for="form-borrow-partner">
					Partners Salary (Optional)
					</label>

					<div class="c-form__group--append">

					<div class="c-form__input-pound">&pound;</div>
						<input
							class="c-form__input <?php echo ( ( isset( $result['errors']['borrow_partners_salary'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
							id="form-borrow-partner"
							name="borrow_partners_salary"
							type="number"
							value="<?php echo esc_attr( ( isset( $_POST['borrow_partners_salary'] ) ) ? sanitize_text_field(wp_unslash($_POST['borrow_partners_salary'])) : '' ) ?>"
							>
					</div>

						<?php if ( isset( $result['errors']['borrow_partners_salary'] ) ): ?>
						<p class="form__message form__message--error js-form-message js-form-message--error">
							<?php echo esc_html( $result['errors']['borrow_partners_salary'] ); ?>
						</p>
					<?php endif; ?>

				</div>
			</section>

		</fieldset>

		<section>
			<div class="c-form__group u-text-center">

				<button
					class="c-btn c-btn--outline c-btn--medium"
					id="form-submit"
					name="borrow_submit"
					type="submit"
					value="true"
					>
					Calculate Amount
				</button>

			</div>
		</section>
		
	</form>

</section>
