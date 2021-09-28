<?php
/**
 * Form: Valuation Calculator
 *
 * @package EDGE\TaylorCole\Components\Forms
 */

require_once get_theme_file_path( '/components/forms/handler-valuation-calculator.php');

$result = null;
if ( isset( $_POST['valuation_submit'] ) && 'true' == $_POST['valuation_submit'] ) {

	$result = validate_valuation_form( $_POST );
	if ( $result['sent'] ) {
		wp_redirect( get_permalink( get_page_by_path( 'thank-you' )->ID ) );
		exit();
	}
}

?>

	<form
		id="valuation-calculator<?php echo esc_attr( '-' . get_the_ID() ); ?>"
		class="c-form c-form--valuation"
		method="POST"
	>

	<?php if (
		isset( $result['errors'] ) &&
		count( $result['errors'] ) > 0
		) : ?>

		<div class="c-form__group">
			<?php if ( isset( $result['errors']['global'] ) ): ?>

				<p class="c-form__notification c-form__notification--error">
					<?php echo esc_html( $result['errors']['global'] ); ?>
				</p>

			<?php else: ?>

				<p class="c-form__notification c-form__notification--error">
					There were some errors with your enquiry. Please fix them and try again.
				</p>

			<?php endif; ?>
		</div>

	<?php elseif (
		isset( $result['sent'] ) &&
		$result['sent'] !== false ) : ?>

		<div class="c-form__group">
			<p class="c-form__notification c-form__notification--success">
				Thank you for your enquiry, a member of the team will be in contact shortly.
			</p>
		</div>

	<?php endif; ?>

	<fieldset class="c-form__fieldset">

		<legend class="c-form__legend c-title c-title--secondary">
			About you
		</legend>

		<section class="c-form__row-3">

			<div class="c-form__group form__item-1">

				<label class="c-form__label" for="form-valuation-title">
					Title<span class="c-form__description c-form__description--required">*</span>
				</label>
				<select
					class="c-form__select"
					id="form-valuation-title"
					name="valuation_title"
					required>
						<option value="">Select</option>
						<option value="Mr">Mr</option>
						<option value="Mrs">Mrs</option>
						<option value="Miss">Miss</option>
						<option value="Mr &amp; Mrs">Mr &amp; Mrs</option>
						<option value="Mr &amp; Miss">Mr &amp; Miss</option>
						<option value="Dr">Dr</option>
						<option value="Dr &amp; Mrs">Dr &amp; Mrs</option>
						<option value="Mr &amp; Dr">Mr &amp; Dr</option>
						<option value="Rev.">Rev.</option>
						<option value="Messrs">Messrs</option>
				</select>

				<?php if ( isset( $result['errors']['valuation_title'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['valuation_title'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-2">

				<label class="c-form__label" for="form-interest-rate">
				First Name<span class="c-form__description c-form__description--required">*</span>
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['valuation_first_name'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="form-valuation-first-name"
					name="valuation_first_name"
					type="text"
					required="required"
					value="<?php echo esc_attr( ( isset( $_POST['valuation_first_name'] ) ) ? sanitize_text_field(wp_unslash($_POST['valuation_first_name'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['valuation_first_name'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['valuation_first_name'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-3">

				<label class="c-form__label" for="form-valuation-family-name">
				Last Name<span class="c-form__description c-form__description--required">*</span>
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['valuation_family_name'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="form-valuation-family-name"
					name="valuation_family_name"
					type="text"
					required="required"
					value="<?php echo esc_attr( ( isset( $_POST['valuation_family_name'] ) ) ? sanitize_text_field(wp_unslash($_POST['valuation_family_name'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['valuation_family_name'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['valuation_family_name'] ); ?>
					</p>
				<?php endif; ?>

			</div>

		</section>

	</fieldset>

	<fieldset class="c-form__fieldset">

		<legend class="c-form__legend c-title c-title--secondary">
			Property to be valued
		</legend>

		<section class="c-form__row-3">

			<div class="c-form__group form__item-1">

				<label class="c-form__label" for="form-valuation-house-name-no">
					House Name / No<span class="c-form__description c-form__description--required">*</span>
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['valuation_house_no'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="form-valuation_house_no"
					name="valuation_house_no"
					type="text"
					required="required"
					value="<?php echo esc_attr( ( isset( $_POST['valuation_house_no'] ) ) ? sanitize_text_field(wp_unslash($_POST['valuation_house_name_no'])) : '' ) ?>"
					>
				<?php if ( isset( $result['errors']['valuation_house_no'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['valuation_house_no'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-2">

				<label class="c-form__label" for="form-valuation-house-street">
					Street<span class="c-form__description c-form__description--required">*</span>
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['valuation_house_street'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="form-valuation-house-street"
					name="valuation_house_street"
					type="text"
					required="required"
					value="<?php echo esc_attr( ( isset( $_POST['valuation_house_street'] ) ) ? sanitize_text_field(wp_unslash($_POST['valuation_house_street'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['valuation_house_street'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['valuation_house_street'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-3">

				<label class="c-form__label" for="form-valuation-house-address-2">
				Address line 2
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['valuation_house_address_2'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="form-valuation-house-address-2"
					name="valuation_house_address_2"
					type="text"
					value="<?php echo esc_attr( ( isset( $_POST['valuation_house_address_2'] ) ) ? sanitize_text_field(wp_unslash($_POST['valuation_house_address_2'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['valuation_house_address_2'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['valuation_house_address_2'] ); ?>
					</p>
				<?php endif; ?>

			</div>

		</section>

		<section class="c-form__row-3">

			<div class="c-form__group form__item-1">

				<label class="c-form__label" for="form-valuation-address-town">
					Town / City<span class="c-form__description c-form__description--required">*</span>
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['valuation_address_town'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="form-valuation-address-town"
					name="valuation_address_town"
					type="text"
					required="required"
					value="<?php echo esc_attr( ( isset( $_POST['valuation_address_town'] ) ) ? sanitize_text_field(wp_unslash($_POST['valuation_address_town'])) : '' ) ?>"
					>
				<?php if ( isset( $result['errors']['valuation_address_town'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['valuation_address_town'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-2">

				<label class="c-form__label" for="form-valuation-county">
					County<span class="c-form__description c-form__description--required">*</span>
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['valuation_address_county'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="form-valuation-county"
					name="valuation_address_county"
					type="text"
					required="required"
					value="<?php echo esc_attr( ( isset( $_POST['valuation_address_county'] ) ) ? sanitize_text_field(wp_unslash($_POST['valuation_address_county'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['valuation_address_county'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['valuation_address_county'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-3">

				<label class="c-form__label" for="form-interest-rate">
				Post Code<span class="c-form__description c-form__description--required">*</span>
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['valuation_postcode'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="form-postcode"
					name="valuation_postcode"
					type="text"
					required="required"
					value="<?php echo esc_attr( ( isset( $_POST['valuation_postcode'] ) ) ? sanitize_text_field(wp_unslash($_POST['valuation_postcode'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['valuation_postcode'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['valuation_postcode'] ); ?>
					</p>
				<?php endif; ?>

			</div>

		</section>

	</fieldset>

	<fieldset class="c-form__fieldset">

		<legend class="c-form__legend c-title c-title--secondary">
			Your Contact Details
		</legend>

		<section class="c-form__row-2">

			<div class="c-form__group form__item-1">

				<label class="c-form__label" for="form-valuation-email">
					Email Address<span class="c-form__description c-form__description--required">*</span>
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['valuation_email'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="form-valuation-email"
					name="valuation_email"
					type="email"
					required="required"
					value="<?php echo esc_attr( ( isset( $_POST['valuation_email'] ) ) ? sanitize_text_field(wp_unslash($_POST['valuation_email'])) : '' ) ?>"
					>
				<?php if ( isset( $result['errors']['valuation_email'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['valuation_email'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-2">

				<label class="c-form__label" for="form-valuation-phone">
					Contact Number<span class="c-form__description c-form__description--required">*</span>
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['valuation_phone'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="form-valuation-phone"
					name="valuation_phone"
					type="text"
					value="<?php echo esc_attr( ( isset( $_POST['valuation_phone'] ) ) ? sanitize_text_field(wp_unslash($_POST['valuation_phone'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['valuation_phone'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['valuation_phone'] ); ?>
					</p>
				<?php endif; ?>

			</div>

		</section>

	</fieldset>

	<fieldset class="c-form__fieldset">

		<legend class="c-form__legend c-title c-title--secondary">
			Additional Information
		</legend>

		<section class="c-form__row-2">

			<div class="c-form__group form__item-1">

				<label class="c-form__label" for="form-valuation-preferred-date">
					Preferred Date
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['valuation_preferred_date'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="form-valuation-preferred-date"
					name="valuation_preferred_date"
					type="date"
					value="<?php echo esc_attr( ( isset( $_POST['valuation_preferred_date'] ) ) ? sanitize_text_field(wp_unslash($_POST['valuation_preferred_date'])) : '' ) ?>"
					>
				<?php if ( isset( $result['errors']['valuation_preferred_date'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['valuation_preferred_date'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-2">

				<p class="c-form__label">
					Preferred Time of Day<span class="c-form__description c-form__description--required">*</span>
				</p>

				<div class="c-form__checkbox form__data">

					<label class="c-form__label" for="form-valuation-preferred-time">
						<input
							class="form__checkbox"
							id="form-valuation-preferred-time_1"
							name="valuation_preferred_time"
							type="radio"
							value="No Preference"
							checked
							/>
							No Preference
					</label>

				</div>

				<div class="c-form__checkbox form__data">

					<label class="c-form__label" for="form_valuation_preferred_time_2">
						<input
							class="form__checkbox"
							id="form_valuation_preferred_time_2"
							name="valuation_preferred_time"
							type="radio"
							value="Morning"
							/>
							Morning
					</label>

				</div>

				<div class="c-form__checkbox form__data">

					<label class="c-form__label" for="form_valuation_preferred_time_3">
						<input
							class="form__checkbox"
							id="form_valuation_preferred_time_3"
							name="valuation_preferred_time"
							type="radio"
							value="Afternoon"
							/>
							Afternoon
					</label>

				</div>

			</div>

		</section>

		<section class="c-form__row">

			<div class="c-form__group form__item-1">

				<label class="c-form__label" for="form-valuations-other">
					Other Requirements
				</label>
				<textarea
					class="c-form__input <?php echo ( ( isset( $result['errors']['valuation-other'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="form-valuations-other"
					name="valuation-other"
					></textarea>
				<?php if ( isset( $result['errors']['valuation-other'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['valuation-other'] ); ?>
					</p>
				<?php endif; ?>

			</div>

		</section>

		<section class="c-form__row-1">

			<div class="c-form__group form__item-1">

				<p class="c-form__label" for="form-valuation-department">
					Department
				</p>

				<div class="c-form__group c-form__checkbox form__data">

				<label class="c-form__label" for="contact_sales">
					<input
						class="form__checkbox"
						id="contact_sales"
						name="contact_type"
						type="radio"
						value="Sales Office"
						/>
						Sales Office
				</label>

				</div>

				<div class="c-form__group c-form__checkbox form__data">
					<label class="c-form__label" for="contact_letting">
						<input
							class="form__checkbox"
							id="contact_letting"
							name="contact_type"
							type="radio"
							value="Lettings Office"
							/>
							Lettings Office
					</label>

				</div>

				<div class="c-form__group c-form__checkbox form__data">

					<label class="c-form__label" for="contact_fine_village">

						<input
							class="c-form__checkbox"
							id="contact_fine_village"
							name="contact_type"
							type="radio"
							value="Signature"
							/>

						Signature
					</label>

				</div>

			</div>

		</section>

	</fieldset>

	<section class="c-form__group u-text-center">

			<button
				class="c-btn c-btn--primary c-btn--medium"
				id="valuation_submit"
				name="valuation_submit"
				type="submit"
				value="true"
				>
				Calculate Valuation
			</button>

	</section>

		<div class="c-form__group">
			<?php
			$thankyou_id = get_post_meta(
				get_the_ID(),
				'ty_page',
				true
			);?>
      <input
        type="hidden"
        name="contact_thankyou"
        id="contact_thankyou"
				value="<?php echo esc_html($thankyou_id) ?>"
        >
		</div>

		<div class="c-form__group">

			<input
				class="c-form__input"
				id="js-referer_source"
				name="referer_source"
				data-tracking="js-referer_source"
				type="hidden"
				value=""
			/>

			<input
				class="c-form__input"
				id="js-referer_medium"
				name="referer_medium"
				data-tracking="js-referer_medium"
				type="hidden"
				value=""
			/>

			<input
				class="c-form__input"
				id="js-referer_campaign"
				name="referer_campaign"
				data-tracking="js-referer_campaign"
				type="hidden"
				value=""
			/>

			<input
				class="c-form__input"
				id="js-referer_content"
				name="referer_content"
				data-tracking="js-referer_content"
				type="hidden"
				value=""
			/>

			<input
				class="c-form__input"
				id="js-referer_keyword"
				name="referer_keyword"
				data-tracking="js-referer_keyword"
				type="hidden"
				value=""
			/>

			<input
				class="c-form__input"
				id="js-referer_landing_page"
				name="referer_landing_page"
				data-tracking="js-referer_landing_page"
				type="hidden"
				value=""
			/>

		</div>


    <?php
      wp_nonce_field(
        'submit_contact',
        'valuation_nonce'
      );
    ?>

  </form>
