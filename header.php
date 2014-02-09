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
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<?php wp_head(); ?>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo gutspot_img_url('gutspot-favicon-144-precomposed.png'); ?>" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo gutspot_img_url('gutspot-favicon-114-precomposed.png'); ?>" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo gutspot_img_url('gutspot-favicon-72-precomposed.png'); ?>" />
<link rel="apple-touch-icon-precomposed" href="<?php echo gutspot_img_url('gutspot-favicon-57-precomposed.png'); ?>" />
<link rel="shortcut icon" href="<?php echo gutspot_img_url('gutspot-favicon.png'); ?>" />
<?php print get_option('gutspot_analytics'); ?>
</head>
<body <?php body_class(); ?>>
<div class="container">

  <div class="page-header" id="banner">
    <div class="row">
      <div class="col-md-12">
        <h1 id="title"><?php bloginfo('name'); ?></h1>
        <p class="lead"><?php bloginfo('description'); ?></p>
      </div>
    </div>
  </div><!-- /.page-header -->

  <div class="navbar navbar-inverse" id="navbar">
    <div class="container navbar-container-style">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="navbar-collapse collapse navbar-inverse-collapse navbar-collapse-style">
        <?php
          wp_nav_menu(array(
            'theme_location'  => 'primary',
            'depth'           => 2,
            'container'       => false,
            'menu_class'      => 'nav navbar-nav',
            'walker'          => new Bootstrap_Navigation_Menu()
          ));
        ?>
        <form class="navbar-form navbar-right navbar-input-group navbar-search-form" role="search" method="GET" action="<?php bloginfo('url'); ?>">
          <div class="input-group">
            <input type="text" class="form-control" name="s" placeholder="站内搜索" speech x-webkit-speech>
            <span class="input-group-btn">
              <button class="btn btn-warning" type="submit">
                <span class="glyphicon glyphicon-search"></span>
              </button>
            </span>
          </div>
        </form>
      </div><!-- /.nav-collapse -->
    </div>
  </div><!-- /.navbar -->