<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
        <link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div class="navbar-wrapper">
      <div class="container" style="box-shadow: 0px 1px 5px rgba(0,0,0,.5);">
        <div class="navbar navbar-inverse navbar-static-top nav-custom" role="navigation">
            <div>
                <?php echo get_option('local'); ?><?php echo get_option('main_seo_term'); ?>
            </div>
            <div class="logo">
                <div class="logo_holder"><a href="/"><img src="<?php echo get_option('logo'); ?>" width="100%"/></a></div>
                <div class="attorney_info_holder">
                    <h1><?php echo get_option('business_owner'); ?></h1>
                    <hr></hr>
                    <h2><?php echo get_option('business_type'); ?></h2>
                </div>
            </div>
            <div class="navbar-top">
            </div>
            <div class="navbar-grey">
                <div class="location">
                    <span class="location_title"><?php echo get_option('location'); ?></span> <?php echo get_option('business_type'); ?>
                </div>
                <div class="phone">
                    <div class="phone-tag"><?php echo get_option('contact_tagline'); ?></div>
                    <div class="phone-number"><?php echo get_option('contact_info'); ?></div>
                </div>
            </div>
        </div>
      </div>
    </div>
    
    <div class="nav-header">
        <img src="http://dev.layout.net/wp-content/uploads/2013/12/neal-j-weill.png" />
    </div>
    <div class="container">
        <div class="navbar-collapse collapse">
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
        </div>
    </div>
</header><!-- #masthead -->
<div id="main" class="site-main">
