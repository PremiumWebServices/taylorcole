<?php
/**
 * Form: Get In Touch
 *
 * @package EDGE\TaylorCole\Components\Forms
 */

require_once get_theme_file_path( '/components/forms/handler-contact-form.php');

$result = null;
if ( isset( $_POST['contact_submit'] ) && 'true' == $_POST['contact_submit'] ) {
	$result = validate_contact_form( $_POST );
  	if ( $result['sent'] ) {
		wp_redirect( get_permalink( get_page_by_path( 'thank-you' )->ID ) );
		exit();
	}
}

?>

	<script
		src="https://www.google.com/recaptcha/api.js?render=6Lc7cNkZAAAAAIZvBV3FMTNkVvK3ep8dJVFvdOQH"
		>
	</script>
	<script>
	document.addEventListener("DOMContentLoaded", function(){
		grecaptcha.ready(function () {
			grecaptcha.execute(
			'6Lc7cNkZAAAAAIZvBV3FMTNkVvK3ep8dJVFvdOQH',
			{ action: 'quote' }).then(function (token) {
				var recaptchaResponse = document.getElementById('recaptchaResponse');
				recaptchaResponse.value = token;
			}
			);
		});
	});
	</script>
	
  <form
    id="contact<?php echo esc_attr( '-' . get_the_ID() ); ?>"
    class="c-form c-form--contact"
    action="#contact-form"
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
			There were some errors with your enquire. Please fix them and try again.
          </p>

        <?php endif; ?>
      </div>
    <?php endif; ?>

		<section class="c-form__row-2">

			<div class="c-form__group form__item-1">

				<label class="c-form__label" for="contact_first_name">
					First Name<span title="Required field." class="c-form__description c-form__description--required">*</span>
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['contact_first_name'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="contact_first_name"
					name="contact_first_name"
					type="text"
					required="required"
					autocomplete="given-name"
					value="<?php echo esc_attr( ( isset( $_POST['contact_first_name'] ) ) ? sanitize_text_field(wp_unslash($_POST['contact_first_name'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['contact_first_name'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['contact_first_name'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-2">

				<label class="c-form__label" for="contact_last_name">
					Last Name
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['contact_last_name'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="contact_last_name"
					name="contact_last_name"
					type="text"
					autocomplete="family-name"
					value="<?php echo esc_attr( ( isset( $_POST['contact_last_name'] ) ) ? sanitize_text_field(wp_unslash($_POST['contact_last_name'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['contact_last_name'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['contact_last_name'] ); ?>
					</p>
				<?php endif; ?>

			</div>

		</section>

		<section class="c-form__row-2">

			<div class="c-form__group form__item-1">

				<label class="c-form__label" for="contact_house_no">
					House No<span title="Required field." class="c-form__description c-form__description--required">*</span>
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['contact_house_no'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="contact_house_no"
					name="contact_house_no"
					type="text"
					required="required"
					value="<?php echo esc_attr( ( isset( $_POST['contact_house_no'] ) ) ? sanitize_text_field(wp_unslash($_POST['contact_house_no'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['contact_house_no'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['contact_house_no'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-2">

				<label class="c-form__label" for="contact_street">
					Street
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['contact_street'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="contact_street"
					name="contact_street"
					type="text"
					autocomplete="address-line4"
					value="<?php echo esc_attr( ( isset( $_POST['contact_street'] ) ) ? sanitize_text_field(wp_unslash($_POST['contact_street'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['contact_street'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['contact_street'] ); ?>
					</p>
				<?php endif; ?>

			</div>

		</section>

		<section class="c-form__row-2">

			<div class="c-form__group form__item-1">

				<label class="c-form__label" for="contact_address2">
					Address 2
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['contact_address2'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="contact_address2"
					name="contact_address2"
					type="text"
					autocomplete="address-level3"
					value="<?php echo esc_attr( ( isset( $_POST['contact_address2'] ) ) ? sanitize_text_field(wp_unslash($_POST['contact_address2'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['contact_address2'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['contact_address2'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-2">

				<label class="c-form__label" for="contact_town_city">
					Town / City
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['contact_town_city'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="contact_town_city"
					name="contact_town_city"
					type="text"
					autocomplete="address-level2"
					value="<?php echo esc_attr( ( isset( $_POST['contact_town_city'] ) ) ? sanitize_text_field(wp_unslash($_POST['contact_town_city'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['contact_town_city'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['contact_town_city'] ); ?>
					</p>
				<?php endif; ?>

			</div>

		</section>

		<section class="c-form__row-2">

			<div class="c-form__group form__item-1">

				<label class="c-form__label" for="contact_county">
					County
				</label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['contact_county'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="contact_county"
					name="contact_county"
					type="text"
					autocomplete="address-level1"
					value="<?php echo esc_attr( ( isset( $_POST['contact_county'] ) ) ? sanitize_text_field(wp_unslash($_POST['contact_county'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['contact_county'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['contact_county'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-2">

				<label class="c-form__label" for="contact_postcode">Postcode<spa title="Required field."n class="c-form__description c-form__description--required">*</span></label>
				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['contact_postcode'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="contact_postcode"
					name="contact_postcode"
					type="text"
					required="required"
					autocomplete=""
					value="<?php echo esc_attr( ( isset( $_POST['contact_postcode'] ) ) ? sanitize_text_field(wp_unslash($_POST['contact_postcode'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['contact_postcode'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['contact_postcode'] ); ?>
					</p>
				<?php endif; ?>

			</div>

		</section>

		<section class="c-form__row-2">

			<div class="c-form__group form__item-1">
				<label class="c-form__label" for="contact_email">
					Email<span title="Required field." class="c-form__description c-form__description--required">*</span>
				</label>

				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['contact_email'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="contact_email"
					name="contact_email"
					type="email"
					required="required"
					autocomplete="email"
					value="<?php echo esc_attr( ( isset( $_POST['contact_email'] ) ) ? sanitize_text_field(wp_unslash($_POST['contact_email'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['contact_email'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['contact_email'] ); ?>
					</p>
				<?php endif; ?>

			</div>

			<div class="c-form__group form__item-2">
				<label class="c-form__label" for="contact_telephone">
					Contact Number<span title="Required field." class="c-form__description c-form__description--required">*</span>
				</label>

				<input
					class="c-form__input <?php echo ( ( isset( $result['errors']['contact_telephone'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
					id="contact_telephone"
					name="contact_telephone"
					type="tel"
					autocomplete="telephone"
					required
					value="<?php echo esc_attr( ( isset( $_POST['contact_telephone'] ) ) ? sanitize_text_field(wp_unslash($_POST['contact_telephone'])) : '' ) ?>"
				/>

				<?php if ( isset( $result['errors']['contact_telephone'] ) ): ?>
					<p class="form__message form__message--error js-form-message js-form-message--error">
						<?php echo esc_html( $result['errors']['contact_telephone'] ); ?>
					</p>
				<?php endif; ?>

			</div>

		</section>

    <div class="c-form__group">

      <label class="c-form__label" for="contact_message">
        Additional Information
      </label>
      <textarea
        class="c-form__input <?php echo ( ( isset( $result['errors']['contact_message'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
        id="contact_message"
        name="contact_message"
        type="text"
      ><?php echo esc_attr( ( isset( $_POST['contact_message'] ) ) ? sanitize_text_field(wp_unslash($_POST['contact_message'])) : '' ) ?></textarea>

      <?php if ( isset( $result['errors']['contact_message'] ) ): ?>
        <p class="form__message form__message--error js-form-message js-form-message--error"><?php echo esc_html($result['errors']['contact_message']) ?></p>
      <?php endif; ?>

    </div>

		<section class="">

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

		</section>

    <div class="c-form__group c-form__checkbox">

			<label class="c-form__label" for="contact_opt_in">

				<input
					class="form__checkbox"
					id="contact_opt_in"
					name="contact_opt_in"
					type="checkbox"
					value="<?php echo esc_attr( ( isset( $_POST['contact_opt_in'] ) ) ? sanitize_text_field(wp_unslash($_POST['contact_opt_in'])) : '' ) ?>"
					/>
					In checking this box, I agree to Taylor Cole using my data to send me information.
      </label>

    </div>

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

			<input
		      type="hidden"
		      name="recaptcha_response"
		      id="recaptchaResponse"
			  value=""
			/>

		</div>


    <div class="c-form__group">
      <button
        class="c-btn c-btn--primary"
        id="contact_submit"
        name="contact_submit"
        type="submit"
        value="true"
        >
        Submit
      </button>
    </div>

    <?php
      wp_nonce_field(
        'submit_contact',
        'contact_nonce'
      );
    ?>

  </form>
