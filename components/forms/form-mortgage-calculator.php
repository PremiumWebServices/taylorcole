<?php
/**
 * Form: Mortgage Calculator
 *
 * @package EDGE\TaylorCole\Components\Forms
 */

require_once get_theme_file_path( '/components/forms/handler-mortgage-calculator.php');

$result = null;
if ( isset( $_POST['mortgage_submit'] ) && 'true' == $_POST['mortgage_submit'] ) {

	$result = validate_mortgage_form( $_POST );
	if ( $result['sent'] ) {
		wp_redirect( get_permalink( get_page_by_path( 'thank-you' )->ID ) );
		exit();
	}
}

?>

	<!-- <form
		id="mortgage-calculator<?php echo esc_attr( '-' . get_the_ID() ); ?>"
		class="c-form c-form--mortgage"
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
					There were some errors with your enquiry. Please fix them and try again.
				</p>

			<?php endif; ?>
		</div>

	<?php elseif (
		isset( $result['calculation_monthly'] ) &&
		$result['calculation_monthly'] !== false &&
		isset( $result['calculation_borrow'] ) &&
		$result['calculation_borrow'] !== false
		) : ?>

		<div class="c-form__group">
			<div class="c-form__notification c-form__notification--info">
				<strong>Mortgage Costs</strong>
				
				<p>Monthly Cost: <?php echo $result['calculation_monthly']; ?></p>

				<p>Amount you need to borrow: <?php echo $result['calculation_borrow']; ?></p>

				<p>These figures are not quotations or an offer of mortgage and should be used as a guide only.</p>

				<p class="c-form__text--error">The mortgage amount shown is intended as a guide only. The actual amount you will be able to borrow could be more or less than this figure and depends on your personal circumstances.</p>
			</div>
		</div>

	<?php endif; ?>

		<fieldset class="c-form__fieldset">

			<legend class="c-title c-title--secondary">
				Deposit
			</legend>

			<section class="">

				<div class="c-form__group c-form__checkbox form__data">

					<label class="c-form__label" for="form-fixed-amount">
						<input
							class="form__checkbox"
							id="form-fixed-amount"
							name="mortgage_deposit_type"
							type="radio"
							value="Fixed Amount"
							/>
							Fixed Amount
					</label>

				</div>

				<div class="c-form__group c-form__checkbox form__data">
					<label class="c-form__label" for="form-percentage">
						<input
							class="form__checkbox"
							id="form-percentageg"
							name="mortgage_deposit_type"
							type="radio"
							value="Percentage"
							/>
							Percentage
					</label>

				</div>

			</section>

			<section class="c-form__row-2">

				<div class="c-form__group form__item-1">

					<label class="c-form__label" for="form-property-price">
						Property Price<span class="c-form__description c-form__description--required">*</span>
					</label>

					<div class="c-form__group--append">

						<div class="c-form__input-pound">&pound;</div>
						<input
							class="c-form__input <?php echo ( ( isset( $result['errors']['mortgage_property_price'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
							id="form-property-price"
							name="mortgage_property_price"
							type="text"
							required="required"
							autocomplete="name"
							value="<?php echo esc_attr( ( isset( $_POST['mortgage_property_price'] ) ) ? sanitize_text_field(wp_unslash($_POST['mortgage_property_price'])) : '' ) ?>"
							/>
					</div>

					<?php if ( isset( $result['errors']['mortgage_property_price'] ) ): ?>
						<p class="form__message form__message--error js-form-message js-form-message--error">
							<?php echo esc_html( $result['errors']['mortgage_property_price'] ); ?>
						</p>
					<?php endif; ?>

				</div>

				<div class="c-form__group form__item-2">

					<label class="c-form__label" for="form-deposit-amount">
						Deposit Amount<span class="c-form__description c-form__description--required">*</span>
					</label>

					<div class="c-form__group--append">

						<div class="c-form__input-pound">&pound;</div>
						<input
							class="c-form__input <?php echo ( ( isset( $result['errors']['mortgage_deposit_amount'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
							id="form-deposit-amount"
							name="mortgage_deposit_amount"
							type="text"
							required="required"
							autocomplete="name"
							value="<?php echo esc_attr( ( isset( $_POST['mortgage_deposit_amount'] ) ) ? sanitize_text_field(wp_unslash($_POST['mortgage_deposit_amount'])) : '' ) ?>"
							/>
						</div>

					<?php if ( isset( $result['errors']['mortgage_deposit_amount'] ) ): ?>
						<p class="form__message form__message--error js-form-message js-form-message--error">
							<?php echo esc_html( $result['errors']['mortgage_deposit_amount'] ); ?>
						</p>
					<?php endif; ?>

				</div>

			</section>

		</fieldset>

		<fieldset class="c-form__fieldset">

			<legend class="c-title c-title--secondary">
				Terms of the Mortgage
			</legend>

			<section class="c-form__row-2">

				<div class="c-form__group form__item-1">

					<label class="c-form__label" for="form-repayment-terms">
						Repayment Terms (Years)<span class="c-form__description c-form__description--required">*</span>
					</label>
					<input
						class="c-form__input <?php echo ( ( isset( $result['errors']['mortgage_repayment_terms'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
						id="form-repayment-terms"
						name="mortgage_repayment_terms"
						type="text"
						required="required"
						value="<?php echo esc_attr( ( isset( $_POST['mortgage_repayment_terms'] ) ) ? sanitize_text_field(wp_unslash($_POST['mortgage_repayment_terms'])) : '' ) ?>"
					/>

					<?php if ( isset( $result['errors']['contact_house_no'] ) ): ?>
						<p class="form__message form__message--error js-form-message js-form-message--error">
							<?php echo esc_html( $result['errors']['contact_house_no'] ); ?>
						</p>
					<?php endif; ?>

				</div>

				<div class="c-form__group form__item-2">

					<label class="c-form__label" for="form-interest-rate">
					Interest Rate (%)<span class="c-form__description c-form__description--required">*</span>
					</label>
					<input
						class="c-form__input <?php echo ( ( isset( $result['errors']['mortgage_interest-rate'] ) ) ? 'c-form__input--has-error' : '' ) ?>"
						id="form-interest-rate"
						name="mortgage_interest-rate"
						type="text"
						required="required"
						value="<?php echo esc_attr( ( isset( $_POST['mortgage_interest-rate'] ) ) ? sanitize_text_field(wp_unslash($_POST['mortgage_interest-rate'])) : '' ) ?>"
					/>

					<?php if ( isset( $result['errors']['mortgage_interest-rate'] ) ): ?>
						<p class="form__message form__message--error js-form-message js-form-message--error">
							<?php echo esc_html( $result['errors']['mortgage_interest-rate'] ); ?>
						</p>
					<?php endif; ?>

				</div>

			</section>

			<section class="c-form__row-2">

				<div class="c-form__group form__item-1">

					<label class="c-form__label" for="form-mortgage-type">
						Mortgage Type
					</label>

					<select
						class="c-form__select"
						id="form-mortgage-type"
						name="mortgage_type"
						required>
						<option value="">Select</option>
						<option value="1">Repayment</option>
						<option value="2">Interest Only</option>
					</select>

					<?php if ( isset( $result['errors']['mortgage_type'] ) ): ?>
						<p class="form__message form__message--error js-form-message js-form-message--error">
							<?php echo esc_html( $result['errors']['mortgage_type'] ); ?>
						</p>
					<?php endif; ?>

				</div>

				<div class="c-form__group form__item-2">

					<button
						class="c-btn c-btn--full c-btn--primary"
						id="form-submit"
						name="mortgage_submit"
						type="submit"
						value="true"
						>
						Calculate Mortgage
					</button>

				</div>

			</section>

		</fieldset>


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
        'contact_nonce'
      );
    ?>

  </form> -->

  <!-- Mortgage Calculator Widget -->
  <div class="mcw-wrap_250" id="maoWrap">
	<div id="mcwWidget">

	</div>
	<script>
	var maoCalc={};
	maoCalc.settings={
		"theme":"theme1","view":"vertical1","responsive":"mcw-wrap_responsive","font":"Open Sans, Helvetica, Arial, sans-serif","border":false,"boxShadow":true,"backgroundColor":"#ffffff","fieldColor":"#fff","textColor":"#334356","borderColor":"#dde2e5","currency":"£","currencySide":"left","delimiters":",.","popup":false,"popupView":"doughnutPopup","style":true,"widgetTotalInterest":false,"widgetTotalPrincipal":false,"monthlyPayment":"Monthly Payment","totalPrincipalPaid":"Total Principal","totalInterestPaid":"Total Interest","totalPayments":"Total Payments","years":"years","title":{"enabled":true,"color":"#334356","label":"Mortgage Calculator"},"homePrice":{"label":"Property Price","value":"0"},"downPayment":{"enabled":true,"label":"Deposit Amount","value":"0"},"interestRate":{"label":"Interest Rate","value":"1"},"mortgageTerm":{"label":"Repayment Terms","value":"1"},"pmi":{"enabled":false,"label":"PMI","value":false},"taxes":{"enabled":false,"label":"Taxes","value":false},"insurance":{"enabled":false,"label":"Insurance","value":false},"hoa":{"enabled":false,"label":"HOA","value":false},"extra":{"enabled":true,"labelAdd":"Add extra payments","labelRemove":"Remove extra payments","labelToMonthy":"To monthly","labelYearly":"Extra yearly"},"startDate":{"enabled":false,"label":"Start Date"},"monthsArr":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"button":{"color":"#ffffff","bg":"#143157","label":"Calculate Mortgage"},"amortizationSchedule":"Amortization Schedule","popupLabels":{"monthlyPrincipalInterest":"Monthly Principal & Interest","monthlyExtraPayment":"Monthly Extra Payment","monthlyPayment":"MONTHLY PAYMENT","downPayment":"Down payment","extraPayments":"Extra payments","totalPrincipalPaid":"Total principal paid","totalInterestPaid":"Total interest paid","totalOfAllPayments":"TOTAL OF ALL PAYMENTS","amortizationSchedule":"Amortization Schedule","tablePaymentDate":"Payment date","tablePayment":"Payment","tablePrincipal":"Principal","tableInterest":"Interest","tableTotalInterest":"Total Interest","tableBalance":"Balance","pmi":"PMI","taxes":"Taxes","insurance":"Insurance","shortInsurance":"Ins","hoa":"HOA","chartBalance":"Balance","chartPrincipal":"Principal","chartInterest":"Interest"},"useTitleAsLink":false,"titleLinkUrl":"","useFooterLink":false,"footerLinkAnchor":"","footerLinkUrl":""
	};
	(function(){
		function loadScript(src){
			var s,t;s=document.createElement("script");
			s.src=src;t=document.getElementsByTagName("script")[0];
			t.parentNode.insertBefore(s,t);
		}
		function decode(str){
			return!window.btoa?'not_found':window.btoa(unescape(encodeURIComponent(str)));
		}
		var uri='https://mortgage-advice-online.org/widget/'+decode(window.location)+'.js';
		loadScript(uri);
	})();
	</script>
</div>
<!-- End Mortgage Calculator Widget -->