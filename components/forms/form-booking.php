<?php

if (isset($tc_property_type)){
	$tc_property_type = ucfirst($tc_property_type);
}else{
	$tc_property_type = ucfirst(get_post_type());
}

require_once get_theme_file_path( '/components/forms/booking-handler.php');

$result = null;
if ( isset( $_POST['contact_submit'] ) && 'true' == $_POST['contact_submit'] ) {

	$result = validate_booking_form( $_POST );
	
	if ( $result['sent'] ) {
		wp_redirect( get_permalink( get_page_by_path( 'thank-you' )->ID ) );
		exit();
	}
}

?>

<section id="bookaviewing" class="c-form c-section__form">

	<div class="o-container">

		<script
			src="https://www.google.com/recaptcha/api.js?render=6Lc7cNkZAAAAAIZvBV3FMTNkVvK3ep8dJVFvdOQH"
			>
		</script>
		<script>
			grecaptcha.ready(function () {
				grecaptcha.execute(
				'6Lc7cNkZAAAAAIZvBV3FMTNkVvK3ep8dJVFvdOQH',
				{ action: 'quote' }).then(function (token) {
					var recaptchaResponse = document.getElementById('recaptchaResponse');
					recaptchaResponse.value = token;
				}
				);
			});
		</script>

		<form
			id="booking-form"
			class="form__bookingform"
			action="#booking-form"
			method="POST"
			>

			<header class="c-form__header">

				<legend class="">
					Like this Property?
				</legend>

				<div class="u-text-center">
					<p>Register your interest and arrange a viewing.</p>
				</div>

			</header>

				<input type="hidden" name="formType" value="viewing" />
				<input type="hidden" name="propertyType" value="<?php echo esc_html($tc_property_type); ?>" />

				<input
					type="hidden"
					name="property"
					value="<?php the_title(); ?>"
					>

				<input
					type="hidden"
					name="propertyLink"
					value="<?php the_permalink(); ?>"
					>

				<?php if ( isset( $result['errors'] ) && count( $result['errors'] ) > 0 ): ?>
					<div class="c-form__group">
						<?php if ( isset( $result['errors']['global'] ) ): ?>

							<p class="c-form__notification c-form__notification--error">
								<?php echo esc_html($result['errors']['global']) ?>
							</p>

						<?php else: ?>

							<p class="c-form__notification c-form__notification--error">
								There were some errors with your enquiry. Please fix them and try again.
							</p>

						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="c-form__row-3">

					<div class="c-form__group form__item-1">

						<label class="c-form__label" for="contact_name">
							Name<span class="c-form__description c-form__description--required">*</span>
						</label>

						<input
							class="c-form__input <?php echo ( ( isset( $result['errors']['contact_name'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
							id="contact_name"
							name="contact_name"
							type="text"
							required="required"
							autocomplete="name"
							value="<?php
							// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
							// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
							// phpcs:ignore
							echo esc_attr( ( isset( $_POST['contact_name'] ) ) ? $_POST['contact_name'] : '' ) ?>"
						/>

						<?php if ( isset( $result['errors']['contact_name'] ) ): ?>
							<p class="c-form__message c-form__message--error js-form-message js-form-message--error"><?php echo esc_html($result['errors']['contact_name']); ?></p>
						<?php endif; ?>

					</div>

					<div class="c-form__group c-form__item-2">

						<label class="c-form__label" for="contact_email">
							Email Address<span class="c-form__description c-form__description--required">*</span>
						</label>

						<input
							class="c-form__input <?php echo ( ( isset( $result['errors']['contact_email'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
							id="contact_email"
							name="contact_email"
							type="email"
							required="required"
							autocomplete="email"
							value="<?php
							// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
							// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
							// phpcs:ignore
							echo esc_attr( ( isset( $_POST['contact_email'] ) ) ? $_POST['contact_email'] : '' ) ?>"
						/>

						<?php if ( isset( $result['errors']['contact_email'] ) ): ?>
							<p class="c-form__message c-form__message--error js-form-message js-form-message--error"><?php echo esc_html($result['errors']['contact_email']); ?></p>
						<?php endif; ?>

					</div>

					<div class="c-form__group form__item-3">

						<label class="c-form__label" for="contact_phone">
							Phone Number<span class="c-form__description c-form__description--required">*</span>
						</label>

						<input
							class="c-form__input <?php echo ( ( isset( $result['errors']['contact_phone'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
							id="contact_phone"
							name="contact_phone"
							type="tel"
							required="required"
							value="<?php
							// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
							// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
							// phpcs:ignore
							echo esc_attr( ( isset( $_POST['contact_phone'] ) ) ? $_POST['contact_phone'] : '' ) ?>"
						/>

						<?php if ( isset( $result['errors']['contact_phone'] ) ): ?>
							<p class="c-form__message c-form__message--error js-form-message js-form-message--error"><?php echo esc_html($result['errors']['contact_phone']); ?></p>
						<?php endif; ?>

					</div>

				</div>

				<div class="c-form__group c-form__checkbox-gdpr u-text-center">

					<label class="c-form__label" for="contact_opt_in">
						<input
							class="c-form__checkbox"
							id="contact_opt_in"
							name="contact_opt_in"
							type="checkbox"
							value="<?php
						// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
						// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
						// phpcs:ignore
						echo esc_attr( ( isset( $_POST['contact_opt_in'] ) ) ? $_POST['contact_opt_in'] : '' ) ?>"
						/>

						In checking this box, I agree to Taylor Cole using my data to send me information.
					</label>

				</div>

				<div class="c-form__group--as">

					<label class="form__label" for="url">Spam Prevention <span class="c-form__description c-form__description--required">(leave this field blank)</span></label>
					<input class="form__input" id="url" name="url" type="text" tabindex="-1" />

					<?php if ( isset( $result['errors']['url'] ) ): ?>
						<p class="c-form__message c-form__message--error js-form-message js-form-message--error">
							<?php echo esc_html($result['errors']['url']); ?>
						</p>
					<?php endif; ?>

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

			<input
		      type="hidden"
		      name="recaptcha_response"
		      id="recaptchaResponse"
			>

		</div>

				<div class="c-form__group u-text-center">
					<button
						class="c-btn c-btn--primary c-btn--icon-right"
						id="contact_submit"
						name="contact_submit"
						type="submit"
						value="true"
						>
						<?php esc_html_e( 'Arrange a Viewing', 'taylor-color' ); ?>
						<svg
							class="c-icon c-icon--inline c-icon--arrow-right-alt"
							aria-hidden="true"
							focusable="false"
							viewbox="0 0 24 24">
							<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--arrow-right-alt.svg#icon--arrow-right-alt' ); ?>"></use>
						</svg>
					</button>
				</div>



				<?php
					wp_nonce_field(
						'submit_contact_form',
						'contact_nonce'
					);
				?>

			</form>


	</div>

</section>
