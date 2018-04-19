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
	
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-xs-12 col-lg-4">
					<div class="site-branding">
						<?php if (  of_get_option( 'thbusiness_show_site_logo_text', 'text_only' ) == 'logo_only'  && of_get_option( 'thbusiness_site_logo_image', '' ) != '' ) { ?>
							<div class="site-logo-image">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo of_get_option( 'thbusiness_site_logo_image', '' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
							</div>
						<?php } ?>
						<?php if ( of_get_option( 'thbusiness_show_site_logo_text', 'text_only' ) == 'text_only' ) { ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						<?php } ?>
					</div>
				</div><!-- .col-md-4 .col-xs-12 .col-lg-4 -->

				<div class="col-md-8 col-xs-12 col-lg-8">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					</nav><!-- #site-navigation -->
					<a href="#" class="navbutton" id="main-nav-button">Main Menu</a>
					<div class="responsive-mainnav"></div>

					<div class="th-search-button-icon"></div>
					<div class="th-search-box-container">
						<div class="th-search-box">
							<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="th-search-form" method="get">
								<input type="text" value="" name="s" id="s" />
								<input type="submit" value="<?php esc_attr_e( 'Search', 'thbusiness' ); ?>" />
							</form>
						</div><!-- th-search-box -->
					</div><!-- .th-search-box-container -->
				</div><!-- .col-md-8 .col-xs-12 .col-lg-8 -->
			</div><!-- .row -->
		</div><!-- container -->
	</header><!-- #masthead -->
	
	<?php if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
		</a>
	<?php endif; // End header image check. ?>
	
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