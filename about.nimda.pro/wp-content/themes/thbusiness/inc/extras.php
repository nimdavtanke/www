<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package thbusiness
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function thbusiness_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'thbusiness_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function thbusiness_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'thbusiness_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function thbusiness_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'thbusiness' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'thbusiness_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function thbusiness_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'thbusiness_setup_author' );

/**
 * Sets the post excerpt length to 70 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function thbusiness_excerpt_length( $length ) {
	return 70;
}
add_filter( 'excerpt_length', 'thbusiness_excerpt_length' );

/**
 * Replaces content [...] with ...
 */
function thbusiness_excerpt_more() {
	return '&hellip; ';
}
add_filter( 'excerpt_more', 'thbusiness_excerpt_more' );

/**
 * Custom length excerpt
 */
function thbusiness_excerpt( $limit ) {
    return wp_trim_words( get_the_excerpt(), $limit );
}


/**
* thbusiness slider function inserts a slider.
*/
if ( !function_exists( 'thbusiness_homepage_slider' ) ) :

function thbusiness_homepage_slider() {
global $post;
?>

<section class="slider">
	<div class="flexslider">
		<ul class="slides">
			<?php
				for( $i = 1; $i <= 5; $i++ ) {
					$thbusiness_slider_title = of_get_option( 'thbusiness_slider_title'.$i , '' );
					$thbusiness_slider_text = of_get_option( 'thbusiness_slider_text'.$i , '' );
					$thbusiness_slider_image = of_get_option( 'thbusiness_slider_image'.$i , '' );
					$thbusiness_slider_link = of_get_option( 'thbusiness_slider_link'.$i , '#' );
					$thbusiness_slider_link_text = of_get_option( 'thbusiness_slider_link_text'.$i , 'Read More' );
			?>
			<?php  if( !empty( $thbusiness_header_title ) || !empty( $thbusiness_slider_text ) || !empty( $thbusiness_slider_image ) ) : ?>
			<li>
				<div class="th-slider-container">
					<figure>
						<img alt="<?php echo esc_attr( $thbusiness_slider_title ); ?>" src="<?php echo esc_url( $thbusiness_slider_image ); ?>">
					</figure>

					<?php if( !empty( $thbusiness_slider_title ) || !empty( $thbusiness_slider_text ) ) { ?>
						<div class="th-slider-details-container">
						<?php if( !empty( $thbusiness_slider_title ) ) { ?>
							<div class="th-slider-title">
								<h3><a href="<?php echo esc_url( $thbusiness_slider_link ); ?>" title="<?php echo esc_attr( $thbusiness_slider_title ); ?>"><span><?php echo $thbusiness_slider_title; ?></span></a></h3>
							</div><!-- .th-slider-title -->
						<?php } ?>
						
						<?php if( !empty( $thbusiness_slider_text ) ) { ?>
							<div class="th-slider-description">
								<p><?php echo $thbusiness_slider_text; ?></p>
							</div><!-- .th-slider-description -->
						<?php } ?>
						<?php if( !empty( $thbusiness_slider_link_text ) ) { ?>
							<div class="th-slider-readmore-button">
								<a href="<?php echo esc_url( $thbusiness_slider_link ); ?>" title="<?php echo esc_attr( $thbusiness_slider_title ); ?>"><?php echo $thbusiness_slider_link_text; ?></a>
							</div><!-- .th-slider-readmore-button -->
						<?php } ?>
						</div><!-- .th-slider-details-container -->
					<?php } ?>
				</div><!-- .th-slider-container -->
			</li>
			<?php endif; ?>
			<?php } ?>
		</ul>
	</div>
</section>

<?php }

endif;