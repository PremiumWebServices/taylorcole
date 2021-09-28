<?php
/**
 * Block: CV standard
 *
 * @package    EDGE\KLO\Includes
 */

function edge_cta_bar_block_register() {

	// Check ACF is active.
	if ( ! function_exists('acf_register_block') ) {
		return;
	}

	// Register a testimonial block.
	acf_register_block( array(
		'name'            => 'cta_bar',
		'title'           => __('Call To Action'),
		'description'     => __('Call To Action Bar'),
		'category'        => 'widgets',
		'icon'            => 'format-aside',
		'keywords'        => array(
			'call to action',
			'bar',
			'section',
		),
		'align'           => 'full',
		'render_callback'	=> 'edge_cta_bar_block_render',
		'supports'        => array(
			'align' => false,
		),
	) );

}

add_action(
	'acf/init',
	'edge_cta_bar_block_register'
);

function edge_cta_bar_block_render(
	$block,
	$content = '',
	$is_preview = false,
	$post_id = 0
	) {

		if ( ! file_exists(
		get_theme_file_path(
			"/components/blocks/block-cta-bar.php"
			)
		)
		) {
			return;
		}

		// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		include(
			get_theme_file_path(
				"/components/blocks/block-cta-bar.php"
			)
		);

}
