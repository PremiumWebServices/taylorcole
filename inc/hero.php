<?php
/**
 * Hero Content
 *
 * Get the fields from several different post, page, archives, etc. and output
 * in a standardized format.
 *
 * @package EDGE\Inc
 */

function edge_load_hero() {

	$heros = edge_get_hero();

	if ( empty( $heros ) || !isset($heros->items) ) {
		return;
	}

	foreach ( $heros->items as $hero ) :

		if ( 'default' === $hero->template ) {
			// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require get_template_directory() . '/components/hero/hero.php';
			continue;
		}

		$filepath = locate_template(
			'components/hero/hero-' . $hero->template . '.php'
		);

		// Check we have a section. Otherwise use default.
		if ( ! $filepath ) {
			do_action(
			'wonolog.log',
			[
				'message' => '[Hero] Template not found.',
				'level'   => 'WARNING',
				'context' => [
					'components/hero/hero-' . $hero->template . '.php'
				],
			]
		);
			continue;
		}

		// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require $filepath;

	endforeach;

}

add_action(
	'edge/hero',
	'edge_load_hero'
);

/**
 * Custom images sizes required by theme.
 *
 * @version 0.1.0
 */
function edge_hero_image_sizes() {
	add_image_size( 'hero', 1600, 960 );
	add_image_size( 'hero-small', 480, 288 );
	add_image_size( 'hero-medium', 900, 540 );
	add_image_size( 'hero-large', 1200, 600 );
}

add_action(
	'after_setup_theme',
	'edge_hero_image_sizes'
);

/**
 * Does the page have hero content set?
 *
 * @return bool If the page has hero content.
 */
function edge_has_hero( $page_id = null ) {
	/* TODO Check page has hero. */
}

function edge_is_hero_body_class( $classes ) {

	$page_id = null;
	/**
	 * Get hero for Taxonomies.
	 */
	if ( is_tax() ) {

		$slug = get_term_by(
			'slug',
			get_query_var( 'term' ),
			get_query_var( 'taxonomy' )
		);

		$hero = get_term_meta(
			$slug->term_id,
			'hero_show',
			true
		);

	}

	/**
	 * Get hero for Archives.
	 */
	if ( is_archive() && !empty( get_queried_object()->rewrite['slug'] ) ) {
		$slug = get_queried_object()->rewrite['slug'];
		$hero = get_option( $slug . '_hero_show' );

		// Return false if no hero items are present.
		if ( $hero === 0 ) {
			return;
		}

	}

	/**
	 * Get hero for Pages/Posts.
	 */
	if (
		is_front_page() ||
		is_home() ||
		is_page() ||
		is_single()
		) {

		if (
			is_home() &&
			get_option( 'page_for_posts' )
			) {
			$page_id = get_option( 'page_for_posts' );
		}

		if (
			is_front_page() &&
			get_option( 'page_on_front' )
			) {
			$page_id = get_option( 'page_on_front' );
		}

		// Set a page id if none is supplied.
		if ( is_null( $page_id )  ) {
			$page_id = get_the_ID();
		}

		$hero  = get_post_meta( $page_id, 'hero_show', true );

	}

	// Return false if no hero items are present.
	if ( ! empty( $hero ) ) {
		return array_merge(
			$classes,
			array( 'has-hero' )
		);
	}

	return $classes;

}

add_filter(
  'body_class',
  'edge_is_hero_body_class',
  20
);

/**
 * Get hero content.
 *
 * @param int|string $page_id Page it to return hero content.
 *
 * @return array Array of content to be used.
 */
function edge_get_hero( $page_id = null ) {

	$page_id;
	$hero = null;
	$hero_output = (object) [];

	/**
	 * Get hero for taxonomies.
	 */
	if ( is_tax() ) {

		$slug = get_term_by(
			'slug',
			get_query_var( 'term' ),
			get_query_var( 'taxonomy' )
		);

		$hero = get_term_meta(
			$slug->term_id,
			'hero',
			true
		);

		// Return false if no hero items are present.
		if ( empty( $hero ) ) {
			return;
		}

		$hero_output->total = count( $hero );

		foreach ( $hero as $count => $row ) :

			// Get hero content.
			$hero_input = (object) [
				'template' => $row,
				'count'    => $count,
				'theme'    =>	get_term_meta( $slug->term_id, 'hero_' . $count . '_hero_theme', true ),
				'content'  => (object) [
					'title'       => get_term_meta( $slug->term_id, 'hero_' . $count . '_hero_title', true ),
					'sub_title'   => get_term_meta( $slug->term_id, 'hero_' . $count . '_hero_sub_title', true ),
					'description' => get_term_meta( $slug->term_id, 'hero_' . $count . '_hero_description', true ),
					'image'       => (int) get_term_meta( $slug->term_id, 'hero_' . $count . '_hero_image', true ),
					'icon'        => (int) get_term_meta( $slug->term_id, 'hero_' . $count . '_hero_icon', true ),
				],
			];

			$hero_output->items[ $count ] = $hero_input;

		endforeach;

		return $hero_output;

	}

	/**
	 * Get hero for Archives.
	 */
	if ( is_archive() ) {

		$slug = get_queried_object()->rewrite['slug'];
		$hero = get_option( $slug . '_hero' );
		$show_hero = get_option( $slug . '_show_hero' );

		// Return false if no hero items are present.
		if ( $show_hero == 0 ) {
			return;
		}

		$hero_output->total = count( $hero );

		foreach ( $hero as $count => $row ) :

			// Get hero content.
			$hero_input = (object) [
				'template' => $row,
				'count'    => $count,
				'theme'    =>	get_option( $slug . '_hero_' . $count . '_hero_theme' ),
				'content'  => (object) [
					'title'       => get_option( $slug . '_hero_' . $count . '_hero_title' ),
					'description' => get_option( $slug . '_hero_' . $count . '_hero_description' ),
					'image'       => (int) get_option( $slug . '_hero_' . $count . '_hero_image' ),
					'icon'        => (int) get_option( $slug . '_hero_' . $count . '_hero_icon' ),
				],
			];
			$hero_output->items[ $count ] = $hero_input;

		endforeach;

		return $hero_output;
	}

	/**
	 * Get hero for Pages/Posts.
	 */
	if (
		is_front_page() ||
		is_home() ||
		is_page() ||
		is_single()
	) {

		if (
			is_home() &&
			get_option( 'page_for_posts' )
		) {
			$page_id = get_option( 'page_for_posts' );
		}

		if (
			is_front_page() &&
			get_option( 'page_on_front' )
		) {
			$page_id = get_option( 'page_on_front' );
		}

		// Set a page id if none is supplied.
		if ( is_null( $page_id )  ) {
			$page_id = get_the_ID();
		}

		$hero  = get_post_meta( $page_id, 'hero', true );

		// Return false if no hero items are present.
		if ( empty( $hero ) ) {
			return;
		}

		$hero_output->total = count( $hero );

		foreach ( $hero as $count => $row ) :

			// Get hero content.
			$hero_input = (object) [
				'template' => $row,
				'count'    => $count,
				'theme'       => get_post_meta( $page_id, 'hero_' . $count . '_hero_theme', true ),
				'content'  => (object) [
					'title'       => get_post_meta( $page_id, 'hero_' . $count . '_hero_title', true ),
					'description' => get_post_meta( $page_id, 'hero_' . $count . '_hero_description', true ),
					'image'       => (int) get_post_meta( $page_id, 'hero_' . $count . '_hero_image', true ),
					'icon'        => (int) get_post_meta( $page_id, 'hero_' . $count . '_hero_icon', true ),

				],
			];

			$hero_output->items[ $count ] = $hero_input;

		endforeach;
	}

	return $hero_output;

}
