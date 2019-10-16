<?php
/**
 * vigor functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vigor
 */

if ( ! defined( 'VIGOR_VERSION' ) ) {
	define( 'VIGOR_VERSION', '1.0' );
}

if ( ! function_exists( 'vigor_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vigor_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on vigor, use a find and replace
		 * to change 'vigor' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'vigor', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 300, 300, true );
		add_image_size( 'vigor-site-logo', 200, 200, false );
		add_image_size( 'portfolio-large', 1600, 1600, true );
		add_image_size( 'portfolio-thumbnail', 600, 400, true );
		add_image_size( 'portfolio-landscape', 800, 600, true );
		add_image_size( 'testimonial-thumbnail', 300, 300, true );
		add_image_size( 'vigor-slideshow', 2400, 1200, true );
		add_image_size( 'sell-media-square', 600, 600, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main' => esc_html__( 'Main Menu', 'vigor' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

	}
endif;
add_action( 'after_setup_theme', 'vigor_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vigor_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'vigor_content_width', 1200 );
}
add_action( 'after_setup_theme', 'vigor_content_width', 0 );

/**
 * Set default theme colors for WordPress.com
 */
function vigor_theme_colors() {
	$themecolors = array(
		'bg'            => 'ffffff',
		'border'        => 'eeeeee',
		'text'          => '444444',
		'link'          => '444444',
		'url'           => '444444',
	);
}
add_action( 'template_redirect', 'vigor_theme_colors' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vigor_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Vigor Footer Left', 'vigor' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Vigor Footer Center Left', 'vigor' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Vigor Footer Center Right', 'vigor' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'vigor_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function vigor_scripts() {
	wp_enqueue_style( 'vigor-genericons', get_template_directory_uri() . '/inc/genericons/genericons.css', '', VIGOR_VERSION );

	wp_enqueue_style( 'vigor-style', get_stylesheet_uri(), array( 'vigor-genericons', 'dashicons' ), VIGOR_VERSION );

	wp_enqueue_style( 'vigor-fonts', get_template_directory_uri() . '/fonts.css', array(), 10 );

	wp_enqueue_style( 'vigor-lightbox-css', get_template_directory_uri() . '/js/simplelightbox.min.css', array(), 10 );

	wp_enqueue_script( 'vigor-unslider', get_template_directory_uri() . '/js/unslider.js', array(), VIGOR_VERSION, true );

	wp_enqueue_script( 'vigor-lightbox', get_template_directory_uri() . '/js/simple-lightbox.min.js', array(), VIGOR_VERSION, true );

	wp_enqueue_script( 'vigor-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), VIGOR_VERSION, true );

	wp_enqueue_script( 'vigor-scripts', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), VIGOR_VERSION, true );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// locaize js for front end scripts
	wp_localize_script( 'vigor-scripts', 'vigor_theme', array(
		'slideshow_animation' => get_theme_mod( 'slideshow_animation', 'fade' ),
		'slideshow_autostart' => get_theme_mod( 'slideshow_autostart', true ),
		'slideshow_nav' => get_theme_mod( 'slideshow_nav', true ),
	) );


	// Make custom fonts apply to all non-header tags
	$custom_fonts = maybe_unserialize( get_option( 'tt_font_theme_options' ) );
	//print_r($custom_fonts);
	if ( ! empty( $custom_fonts['tt_default_body']['font_id'] ) ) {
		$custom_css = "
			body, input, select, textarea {
				font-family: {$custom_fonts['tt_default_body']['font_name']};
				font-weight: {$custom_fonts['tt_default_body']['font_weight']};
				color: {$custom_fonts['tt_default_body']['font_color']};
			}";
		wp_add_inline_style( 'vigor-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'vigor_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer additions for Slideshow.
 */
require get_template_directory() . '/inc/customizer-extends.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Activates required plugins on theme activation.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 * Register the required plugins for this theme.
 */
function vigor_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Include from WordPress Plugin Repository.
		array(
			'name'      => 'JetPack',
			'slug'      => 'jetpack',
			'required'  => true,
		),

	);

	tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'vigor_register_required_plugins' );

/**
 * Remove ... from the excerpt.
 */
function vigor_fix_the_excerpt() {
	return '';
}
add_filter( 'excerpt_more', 'vigor_fix_the_excerpt' );

/**
 * Fix excerpt length
 */
function vigor_excerpt_length() {
	return 26;
}
add_filter( 'excerpt_length', 'vigor_excerpt_length' );