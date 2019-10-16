<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package vigor
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses vigor_header_style()
 */
function vigor_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'vigor_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1600,
		'height'                 => 1000,
		'flex-height'            => true,
		'wp-head-callback'       => 'vigor_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'vigor_custom_header_setup' );

if ( ! function_exists( 'vigor_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see vigor_custom_header_setup().
	 */
	function vigor_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
		 */
		if ( HEADER_TEXTCOLOR === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :

		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			.home .site-title a,
			.home .site-description,
			.home .main-navigation a,
			.front-page-content,
			.front-page-content a.button {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
				opacity: 0.9;
			}
			.site-title a:hover,
			.main-navigation a:hover,
			.front-page-content a.button:hover {
				opacity: 1;
			}
			.front-page-content a.button {
				border-color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
			.front-page-content a.button:hover {
				background-color: #<?php echo esc_attr( $header_text_color ); ?>;
				color: #111;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
