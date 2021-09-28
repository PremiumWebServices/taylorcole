<?php
/**
 * Block: Frequently Asked Questions.
 *
 * @package EDGE\EDGECreative\Components
 */




// Get the title assigned to this block
$block_title = get_field( 'faqs_title' );

// Get the post type assigned to this block
$block_type = get_field( 'faqs_type' );

// Get the image assigned to this block
$block_image = get_field( 'faqs_image' );


// Get FAQ's as disclosures
$query_args = array(
	'post_type'              => 'edge_'.$block_type.'_faqs',
	'post_status'            => 'publish',
  'ignore_sticky_posts'    => true,
	'order'                  => 'ASC',
	'orderby'                => 'menu_order',
	'update_post_meta_cache' => false,
	'update_post_term_cache' => false,
);

$get_disclosures = new WP_Query( $query_args );


?>


<div class="wp-block-media-text alignwide is-vertically-aligned-center is-stacked-on-mobile">

	<?php if (isset($block_image['id'])) : ?>
	<figure
		class="wp-block-media-text__media"
		>
		<?php
			echo wp_get_attachment_image(
				$block_image['id'],
				'large'
			);
		?>
	</figure>
	<?php endif; ?>

	<section
		class="wp-block-media-text__content c-section c-section--disclosure"
		data-analytics=""
		>

		<?php if (isset($block_title)) : ?>
		<div
			class="c-section__container"
			>

			<header class="c-section__header c-header--hightlight">
					<h2 class="c-title c-title--primary">
						<?php echo esc_html($block_title); ?>
					</h2>
			</header>

		</div>
		<?php endif; ?>

		<?php if( $get_disclosures->posts ) : ?>
		<div class="">

			<?php // loop through the rows of data
				foreach (  $get_disclosures->posts as $disclosure ) :
			?>
			<dl class="c-disclosure" itemprop="mainEntity" itemscope itemtype="http://schema.org/Question">

				<dt class="c-disclosure__term">
					<button
						aria-expanded="true"
						aria-controls="<?php echo esc_attr( $block_type . '_' . $disclosure->ID ); ?>"
						class="c-disclosure__button js-disclosure-button"
						>
						<div class="c-disclosure__title" itemprop="name">
							<?php echo esc_html( $disclosure->post_title ); ?>
						</div>
						<svg
							class="c-icon c-icon--disclosure"
							viewbox=" 0 0 20 20"
							>
							<title>Toggle Disclosure</title>
							<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--disclosure.svg#icon--disclosure' ); ?>"></use>
						</svg>
					</button>
				</dt>

				<dd class="c-disclosure__description" itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
					<div
						id="<?php echo esc_attr(  $block_type . '_' . $disclosure->ID ); ?>"
						class="c-disclosure__content"
						style="display: block;"
						itemprop="text"
						>
							<?php
								echo wp_kses_post(
									apply_filters(
										'edge_wysiwyg_field',
										$disclosure->post_content
									)
								);
							?>
					</div>
				</dd>

			</dl>
			<?php
				endforeach;
			?>

		</div>
		<?php endif; ?>

	</section>

</div>
