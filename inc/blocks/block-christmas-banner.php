<?php
/**
 * Block: CV standard
 *
 * @package    EDGE\KLO\Includes
 */

function edge_christmas_banner_block_register() {

	// Check ACF is active.
	if ( ! function_exists('acf_register_block') ) {
		return;
	}

	// Register a testimonial block.
	acf_register_block( array(
		'name'            => 'christmas_banner',
		'title'           => __('Christmas Banner'),
		'description'     => __('Christmas Banner'),
		'category'        => 'widgets',
		'icon'            => 'editor-paste-text',
		'keywords'        => array(
			'christmas',
			'banner',
		),
		'align'           => 'full',
		'render_callback'	=> 'edge_christmas_banner_block_render',
		'supports'        => array(
			'align' => false,
		),
	) );

}

add_action(
	'acf/init',
	'edge_christmas_banner_block_register'
);

function edge_christmas_banner_block_render(
	$block,
	$content = '',
	$is_preview = false,
	$post_id = 0
	) {

		if ( ! file_exists(
		get_theme_file_path(
			"/components/blocks/block-christmas-banner.php"
			)
		)
		) {
			return;
		}

		// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		include(
			get_theme_file_path(
				"/components/blocks/block-christmas-banner.php"
			)
		);

}
