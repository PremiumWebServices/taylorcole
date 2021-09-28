<?php
/**
 * Template tags.
 *
 * @package    EDGE\Toolkit
 */

if ( ! function_exists( 'edge_get_primary_taxonomy_id' ) ) {

	function edge_time_ago() {

		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			human_time_diff(
				get_the_time( 'U' ),
				current_time( 'timestamp' )
			) . ' ' . __( 'ago' )
		);

			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<span class="posted-on">' . $time_string . '</span>';

	}

}

if ( ! function_exists( 'edge_get_primary_taxonomy_id' ) ) {

	function edge_get_primary_taxonomy_id( $post_id, $taxonomy ) {

		// Return no category if WP SEO plugin is not present.
		if ( ! class_exists( 'WPSEO_Primary_Term' ) ) {
			return;
		}

		$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post_id );
		$primary_term = $wpseo_primary_term->get_primary_term();

		// If a primary term is set by Yoast return it.
		if ( false !== $primary_term ) {

			$get_primary_term = get_term_by(
				'id',
				absint($primary_term),
				$taxonomy
			);

			return $get_primary_term->name;

		}

		$get_term = get_the_terms(
			$post_id,
			$taxonomy
		);

		// If term set show the first one.
		if( $get_term ) {
			return $get_term[0]->name;
		}

		// If not term show default option.
		$default = get_term_by(
			'id',
			get_option( 'default_category' ),
			$taxonomy
		);

		return $default->name;

	}

}
