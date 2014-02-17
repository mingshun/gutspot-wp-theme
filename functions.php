<?php
/**
 * Gutspot Theme functions and definitions.
 *
 * @package Gutspot
 * @since Gutspot Theme 1.0
 */


/**
 * Import customed Walker_Nav_Menu_Edit.
 */
require_once('inc/theme-walker-nav-menu.php');


/**
 * Import customed menu item actions.
 */
require_once('inc/theme-custom-menu-item.php');


/**
 * Import Bootstrap navigation menu implementation.
 */
require_once('inc/bootstrap-navigation-menu.php');


/**
 * Import theme option theme options page.
 */
require_once('inc/theme-options.php');


/**
 * Import obfuscation encoder.
 */
require_once('inc/obfuscation.php');


/**
 * Sets up theme defaults and registers WordPress features.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_setup() {
  // This theme uses wp_nav_menu() in one location.
  register_nav_menu('primary', 'Bootstrap Navigation Menu');

  // Define sidebar style.
  register_sidebar(array(
    'name'            => 'Primary Sidebar',
    'id'              => 'primary-widget',
    'description'     => 'The primary widget',
    'class'           => 'classsdsd',
    'before_widget'   => '<div class="well widget-box clearfix">',
    'after_widget'    => '</div>',
    'before_title'    => '<h4 class="widget-title">',
    'after_title'     => '</h4>'
 ));
}
add_action('after_setup_theme', 'gutspot_setup');


/**
 * Custom excerpt length to 200 charactors.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_excerpt_length($length) {
  return 200;
}
add_filter('excerpt_length', 'gutspot_excerpt_length');


/**
 * Set the X-UA-Compatible to HTTP header.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_set_x_ua_compable($headers) {
  $headers['X-UA-Compatible'] = 'IE=edge,chrome=1';
  return $headers;
}
add_filter('wp_headers', 'gutspot_set_x_ua_compable');


/**
 * Detect if the current page is the login page.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_is_login_page() {
  return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}


/**
 * Return url related to template url.
 *
 * @since Gutspot Theme 2.0
 */
function gutspot_template_url($url) {
  return get_bloginfo('template_url') . '/' . $url;
}

function gutspot_assets_url($url) {
  return gutspot_template_url('assets/' . $url);
}

function gutspot_css_url($url) {
  return gutspot_assets_url('css/' . $url);
}

function gutspot_js_url($url) {
  return gutspot_assets_url('js/' . $url);
}

function gutspot_img_url($url) {
  return gutspot_assets_url('img/' . $url);
}


/**
 * Load theme stylesheet and javascript files on init.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_styles_scripts() {
  if (!is_admin() && !gutspot_is_login_page()) {
    wp_register_style('bootstrap', gutspot_css_url('bootstrap.css'), array(), '3.1.0', 'screen');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('font-awesome', gutspot_css_url('font-awesome.css'), array('bootstrap'), '4.0.3', 'screen');
    wp_enqueue_style('gutspot', gutspot_css_url('gutspot.css'), array('bootstrap'), '1.0.0', 'screen');

    wp_deregister_script('jquery');
    wp_register_script('jquery', gutspot_js_url('jquery.js'), array(), '2.0.3', true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('boostrap', gutspot_js_url('bootstrap.js'), array('jquery'), '3.1.0', true);
    wp_enqueue_script('gutspot', gutspot_js_url('gutspot.js'), array('jquery'), '1.0.0', true);
  }
}
add_action('wp_enqueue_scripts', 'gutspot_styles_scripts');


/**
 * Load github repository page stylesheet and javascript files.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_github_repos_page_styles_scripts() {
  if (!is_admin() && basename(get_page_template()) == 'page-github-repos.php') {
    wp_enqueue_style('github-repos', gutspot_css_url('github-repos.css'), array(), '1.0.0', 'screen');
    wp_enqueue_style('github-lang-colors', gutspot_css_url('github-lang-colors.css'), array('github-repos'), '1.0.0', 'screen');

    wp_enqueue_script('github-repos', gutspot_js_url('github-repos.js'), array('jquery'), '1.0.0', true);
  }
}
add_action('wp_enqueue_scripts', 'gutspot_github_repos_page_styles_scripts');


/**
 * Remove WordPress generator version.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_remove_generator_version() {
  if (get_option('gutspot_hide_wp_version')) {
    remove_action('wp_head', 'wp_generator');
    add_filter('the_generator', function() {
      return '';
    });    
  }
}
add_action('init', 'gutspot_remove_generator_version');


/**
 * Remove X-Pingback in HTTP headers.
 *
 * @since Gutspot Theme 1.0
 */
function gutspot_remove_x_pingback() {
  if (get_option('gutspot_hide_pingback')) {
    add_filter('wp_headers', function($headers) {
      unset($headers['X-Pingback']);
      return $headers;
    });
  } else {
    add_action('wp_head', function() {?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php
    });
  }
}
add_action('init', 'gutspot_remove_x_pingback');


/**
 *  Add style class to posts link attributes.
 *
 * @since Gutspot Theme 2.0
 */
function gutspot_posts_link_attributes() {
    return 'class="blue-link"';
}
add_filter('next_posts_link_attributes', 'gutspot_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'gutspot_posts_link_attributes');
?>