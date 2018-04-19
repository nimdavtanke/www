<?php
/**
 * thbusiness Theme Customizer
 *
 * @package thbusiness
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function thbusiness_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_setting (
		'thbusiness_main_color',
		array(
			'default'    =>  '#eb5937',
	        'transport'  =>  'refresh'
		)
	);

	$wp_customize->add_control (
		new WP_Customize_Color_Control (
			$wp_customize,
			'thbusiness_main_color',
			array (
					'label'		=>	'Site Main Color',
					'section'	=>	'colors',
					'settings'	=>	'thbusiness_main_color'
				)
			)
		);
}
add_action( 'customize_register', 'thbusiness_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function thbusiness_customize_preview_js() {
	wp_enqueue_script( 'thbusiness_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'thbusiness_customize_preview_js' );


/**
 * Writes out the CSS as defined by the values in the Theme Customizer
 * to the `head` element of the header template.
 *
 * @package thbusiness
 */
function thbusiness_customize_css() {
	
	$color = get_theme_mod( 'thbusiness_main_color' );
	
	if ( $color != '#eb5937 ') : 

?>

	<style type="text/css">
	<?php
		echo 
		'a:hover,
		a:focus,
		a:active {
			color: '.$color.';
		}
		blockquote {
			border-left: 3px solid '.$color.';
		}
		.main-navigation ul ul {
			border-top: 3px solid '.$color.';
		}
		.main-navigation li:hover > a {
			border-bottom: 3px solid '.$color.';
		}
		.main-navigation a:hover, 
		.main-navigation ul li.current-menu-item a, 
		.main-navigation ul li.current_page_ancestor a, 
		.main-navigation ul li.current-menu-ancestor a, 
		.main-navigation ul li.current_page_item a,
		.main-navigation ul li:hover > a {
			color: '.$color.';
		}
		.widget-title {
			border-bottom: 3px solid '.$color.';
		}
		.th-services-box:hover .th-services-icon {
			border: 1px solid '.$color.';
			color: '.$color.';
		}
		.th-services-box:hover .th-morelink {
			background: '.$color.';
		}
		.th-morelink {
			color: '.$color.';
		}
		.th-morelink:visited {
			color: '.$color.';
		}
		.call-to-action-button {
			background: '.$color.';
		}
		.singlepage-widget-moretag {
			background: '.$color.';
		}		
		.moretag {
			background: '.$color.';
		}
		.comment-author .fn,
		.comment-author .url,
		.comment-reply-link,
		.comment-reply-login {
			color: '.$color.';
		}
		a:hover.page-numbers {
			background-color: '.$color.';
		}
		.paging-navigation .current {
			background-color: '.$color.';
		}
		.page-links span a{
			background: '.$color.';
		}
		.page-links a:hover {
			background: '.$color.';
		}
		.th-slider-readmore-button a {
			background: '.$color.';
		}
		.site-footer a:hover {
			color: '.$color.';
		}
		.th-search-box-container {
			border-top: 3px solid '.$color.';
		}
		#th-search-form input[type="submit"] {
			background-color: '.$color.';
		}';
	?>
	</style>
<?php
	endif;
}
add_action( 'wp_head', 'thbusiness_customize_css' );