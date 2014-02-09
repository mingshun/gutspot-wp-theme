<?php

/**
 * Action for adding custom nav fields.
 *
 * @since Gutstop 2.0
 */
function gutspot_add_custom_nav_fields($menu_item) {
  $menu_item->font_awesome_icon = get_post_meta($menu_item->ID, '_menu_item_font_awesome_icon', true);
  return $menu_item;
}
add_filter('wp_setup_nav_menu_item', 'gutspot_add_custom_nav_fields');
  

/**
 * Action for updating custom nav fields.
 *
 * @since Gutspot 2.0
 */
function gutspot_update_custom_nav_fields($menu_id, $menu_item_db_id, $args) {
  // Check if element is properly sent
  if (is_array($_REQUEST['menu-item-font-awesome-icon'])) {
    $font_awesome_icon_value = $_REQUEST['menu-item-font-awesome-icon'][$menu_item_db_id];
    update_post_meta($menu_item_db_id, '_menu_item_font_awesome_icon', $font_awesome_icon_value);
  }
}
add_action('wp_update_nav_menu_item', 'gutspot_update_custom_nav_fields', 10, 3);


/**
 *  Replace the default walker nav menu edit instance with the theme customed one.
 *
 * @since Gutspot 2.0
 */
function gutspot_edit_walker($walker, $menu_id) {
  return 'Theme_Walker_Nav_Menu_Edit';
}
add_filter('wp_edit_nav_menu_walker', 'gutspot_edit_walker', 10, 2);