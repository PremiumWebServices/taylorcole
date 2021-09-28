<?php
/**
 * Primary Menu
 *
 * @package EDGE\EDGECreative\Components
 */
?>

 <?php if ( has_nav_menu( 'footer-menu' ) ) {

  wp_nav_menu(
    array(
      'theme_location'  => 'footer-menu',
      'container'       => 'nav',
      'container_id'    => 'c-footer__navigation',
      'container_class' => 'c-footer__navigation',
      'menu_class'      => 'c-footer__menu',
      'depth'           => 1,
      'link_before'     => '<span class="c-menu__link">',
      'link_after'      => '</span>',
      'fallback_cb'     => '',
    )
  );

}
