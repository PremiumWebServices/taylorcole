<?php
/**
 * Christmas Banner
 *
 * @package EDGE\Toolkit\Components
 */

?>

<link href="https://fonts.googleapis.com/css2?family=Asap:wght@400;700&family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">

<section
	class="c-section--christmas-banner c-section <?php if ( isset( $block['data']['snow_layer'] ) && ! empty( $block['data']['snow_layer'] ) ) { echo 'c-section--snow-layer'; } ?>"
	id="<?php echo esc_attr( $block['id'] ); ?>"
	>

	<?php 
		if ( isset( $block['data']['snow_layer'] ) && ! empty( $block['data']['snow_layer'] ) ) :
		?>

			<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/dist/gui/snow-layer-extended.png' ); ?>" alt="">

		<?php		
		endif;
	?>

	<?php
		if ( isset( $block['data']['christmas_banner_text'] ) && ! empty( $block['data']['christmas_banner_text'] ) ) :
		?>
			<h3 
				class="c-title has-text-align-center" 
				style="font-family: 'Dancing Script', Calibri, sans-serif; 
				font-size: 42px; 
				line-height: 48px; 
				font-weight: 700;
				<?php if ( isset( $block['data']['background_colour'] ) && ! empty( $block['data']['background_colour'] ) ) { echo 'background-color: '.$block['data']['background_colour']; } else { echo 'background-color: #FFFFFF'; } ?>;
				<?php if ( isset( $block['data']['text_colour'] ) && ! empty( $block['data']['text_colour'] ) ) { echo 'color: '.$block['data']['text_colour']; } else { echo 'color: #000000'; } ?>;" 
			>
				<?php echo esc_html( $block['data']['christmas_banner_text'] ); ?>
			</h3>
		<?php
		endif;
	?>

</section>
