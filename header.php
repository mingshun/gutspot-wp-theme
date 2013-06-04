<!--
                               .                                     .   
                             .o8                                   .o8   
     .oooooooo oooo  oooo  .o888oo  .oooo.o oo.ooooo.   .ooooo.  .o888oo 
    888' `88b  `888  `888    888   d88(  "8  888' `88b d88' `88b   888   
    888   888   888   888    888   `"Y88b.   888   888 888   888   888   
    `88bod8P'   888   888    888 . o.  )88b  888   888 888   888   888 . 
    `8oooooo.   `V88V"V8P'   "888" 8""888P'  888bod8P' `Y8bod8P'   "888" 
    d"     YD                                888                         
    "Y88888P'                               o888o                        
                                                                         
-->
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/stylesheets/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/stylesheets/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/stylesheets/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/stylesheets/docs.css" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--[if lt IE 9]><script src="<?php bloginfo('template_url'); ?>/javascripts/html5shiv.js"></script><![endif]-->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo('template_url'); ?>/img/gutspot-favicon-144-precomposed.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_url'); ?>/img/gutspot-favicon-114-precomposed.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_url'); ?>/img/gutspot-favicon-72-precomposed.png" />
<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_url'); ?>/img/gutspot-favicon-57-precomposed.png" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/gutspot-favicon.png" />
<base href="<?php bloginfo('template_url'); ?>/" />
<?php wp_head(); ?>
<?php print get_option('gutspot_analytics'); ?>
</head>
<body <?php body_class(); ?>>
<div class="container">
  <header id="header">
    <hgroup class="row">
      <div class="span9">
        <h1><a href="<?php bloginfo('siteurl'); ?>"><?php bloginfo('name'); ?></a></h1>
        <p class="lead"><?php bloginfo('description'); ?></p>
      </div>
      <div class="span3">
        <div class="pull-right">
<?php get_search_form(); ?>
        </div>
      </div>
    </hgroup>
  </header>
  <div class="navi">
    <div class="subnav">
<?php
  wp_nav_menu(array(
    'theme_location'  => 'primary',
    'depth'           => 2,
    'container'       => false,
    'menu_class'      => 'nav nav-pills',
    'walker'          => new Bootstrap_Navigation_Menu()
  ));
?>
    </div>
  </div>
  <!-- end of navi -->
