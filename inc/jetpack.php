<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package vigor
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function vigor_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'vigor_infinite_scroll_render',
		'footer_widgets' => true,
		'wrapper'	=> false,
		'posts_per_page' => true,
	) );

	// Site logo.
	$args = array(
		'header-text' => array(
			'site-title',
			'site-description',
		),
		'size' => 'vigor-site-logo',
	);
	add_theme_support( 'site-logo', $args );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add Portfolio CPT.
	add_theme_support( 'jetpack-portfolio' );

	// Add Testimonials CPT.
	add_theme_support( 'jetpack-testimonial' );

} // end function vigor_jetpack_setup.
add_action( 'after_setup_theme', 'vigor_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function vigor_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( vigor_is_jetpack_portfolio_archive() ) {
			get_template_part( 'template-parts/content', 'portfolio' );
		} elseif ( is_search() ) {
			get_template_part( 'template-parts/content', 'search' );
		} else {
			get_template_part( 'template-parts/content', get_post_format() );
		}
	}
} // end function vigor_infinite_scroll_render

/**
 * Jetpack Portfolio template checker
 *
 * Checks if various Jetpack portfolio archives are bring loaded
 *
 * @return boolean	true/false
 * @since 1.0
 */
function vigor_is_jetpack_portfolio_archive() {
	if ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) {
		return true;
	}
}

/**
 * Portfolio Title.
 */
function vigor_portfolio_title() {
	$jetpack_portfolio_title = get_option( 'jetpack_portfolio_title' );
	$title = '';

	if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
		if ( isset( $jetpack_portfolio_title ) && '' != $jetpack_portfolio_title ) {
			$title = esc_html( $jetpack_portfolio_title );
		} else {
			$title = post_type_archive_title( '', false );
		}
	} elseif ( is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) {
		$title = single_term_title( '', false );
	}

	echo esc_html( $title );
}

/**
 * Portfolio Content.
 */
function vigor_portfolio_content() {
	$jetpack_portfolio_content = get_option( 'jetpack_portfolio_content' );

	if ( is_tax() && get_the_archive_description() ) {
		echo esc_html( $before . get_the_archive_description() . $after );
	} else if ( isset( $jetpack_portfolio_content ) && '' != $jetpack_portfolio_content ) {
		$content = convert_chars( convert_smilies( wptexturize( stripslashes( wp_filter_post_kses( addslashes( $jetpack_portfolio_content ) ) ) ) ) );
		echo esc_html( $content );
	}
}
