<?php
/**
 * Primary Menu
 *
 * @package EDGE\EDGECreative\Components
 */

?>

 <?php if ( has_nav_menu( 'primary' ) ) {

  wp_nav_menu(
    array(
      'theme_location'  => 'primary',
      'container'       => 'div',
      'container_id'    => 'c-nav-wrap',
      'container_class' => 'c-nav-wrap',
      'menu_id'         => 'c-nav',
      'menu_class'      => 'c-nav',
      'depth'           => 1,
      'link_before'     => '<span class="menu-item-title">',
      'link_after'      => '</span>',
      'fallback_cb'     => '',
    )
  );

}
