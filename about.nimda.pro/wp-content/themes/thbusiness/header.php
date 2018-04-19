<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package thbusiness
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<div class="container-fluid">
	<div class="row">
	
	<?php
	   	if( of_get_option( 'thbusiness_activate_slider', '0' ) == '1' ) { 
			if ( is_front_page() ) {
				thbusiness_homepage_slider();
			}
	 } ?>

	</div><!-- .row -->
	</div><!-- .container-fluid -->

	<div id="content" class="site-content">
<div class="container">
	<div class="row">