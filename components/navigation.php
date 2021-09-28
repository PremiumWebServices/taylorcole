<?php
/**
 * Navigation: Primary
 *
 * @package EDGE\TaylorCole\Components
 */

?>

<div class="c-menu__controls">
	<a
		class="c-icon c-icon--close"
		data-js="site-menu-close"
		href="#content"
		>
		<svg
			class="c-icon c-icon--inline c-icon--close"
			viewbox=" 0 0 25 25">
			<title>Close</title>
			<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--close.svg#icon--close' ); ?>">
			</use>
		</svg>
	</a>
</div>

<?php
if ( has_nav_menu( 'primary' ) ) {

	wp_nav_menu(
		array(
			'theme_location'  => 'primary',
			'container'       => 'div',
			'container_id'    => 'c-menu__nav',
			'container_class' => 'c-menu__nav',
			'menu_id'         => 'c-nav',
			'menu_class'      => 'c-nav',
			'depth'           => 2,
			'link_before'     => '<span class="menu-item-title">',
			'link_after'      => '</span>',
			'fallback_cb'     => '',
		)
	);

}
?>

<div class="c-menu__overlay">
</div>
