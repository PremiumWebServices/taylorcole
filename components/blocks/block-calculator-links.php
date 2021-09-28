<?php
/**
 * Block: Calculator Links
 *
 * @package EDGE\EDGECreative\Components
 */

?>

<section class="c-section c-section--calculator-links c-section--overlap-bottom">

	<div class="c-section__container">

		<div class="c-section__item c-section__item__blue">

			<a href="<?php echo esc_url( home_url( '/calculators/mortgage/' ) ); ?>">
				<svg
					class="c-icon c-icon--large c-icon--mortgage-calculator"
					viewbox=" 0 0 72 72"
					aria-hidden="true"
					focusable="false"
					>
					<use
						xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--mortgage-calculator.svg#icon--mortgage-calculator' ); ?>">
					</use>
				</svg>
				Mortgage Calculator
			</a>

		</div>

		<div class="c-section__item c-section__item__blue">

			<a href="<?php echo esc_url( home_url( '/calculators/stamp-duty/' ) ); ?>">
				<svg
						class="c-icon c-icon--large c-icon--stamp-duty-calculator"
						viewbox=" 0 0 72 72"
						aria-hidden="true"
						focusable="false"
						>
					<use
						xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--stamp-duty-calculator.svg#icon--stamp-duty-calculator' ); ?>">
					</use>
				</svg>
				Stamp Duty Calculator
			</a>

		</div>

		<div class="c-section__item c-section__item__blue">

			<a href="<?php echo esc_url( home_url( '/calculators/valuation/' ) ); ?>">
				<svg
					class="c-icon c-icon--large c-icon--valuation-calculator"
					viewbox=" 0 0 72 72"
					aria-hidden="true"
					focusable="false"
					>
					<use
						xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--valuation-calculator.svg#icon--valuation-calculator' ); ?>">
					</use>
				</svg>
				Valuation Calculator
			</a>

		</div>

		<div class="c-section__item c-section__item__blue">

			<a href="<?php echo esc_url( home_url( '/testimonials/' ) ); ?>">
				<svg
					class="c-icon c-icon--large c-icon--how-to-buy"
					viewbox=" 0 0 72 72"
					aria-hidden="true"
					focusable="false"
					>
					<use
						xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--testimonial.svg#icon--testimonial' ); ?>">
					</use>
				</svg>
				<span>Testimonials</span>
			</a>

		</div>

	</div>

</section>
