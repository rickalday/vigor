<?php
/**priority
 * vigor Theme Customizer.
 *
 * @package vigor
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vigor_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

}
add_action( 'customize_register', 'vigor_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function vigor_customize_preview_js() {
	wp_enqueue_script( 'vigor_customizer', get_template_directory_uri() . '/inc/assets/js/customizer.js', array( 'customize-preview' ), '20160509', true );
}
add_action( 'customize_preview_init', 'vigor_customize_preview_js' );

/**
 * Add a placeholder section to show users additional available options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vigor_customizer_options( $wp_customize ) {

	$wp_customize->add_panel( 'theme_options', array(
		'title'     => esc_html__( 'Homepage Options', 'vigor' ),
		'description'   => esc_html__( 'Each section below can be shown/hidden on the homepage and can give a unique look from blog, portfolio, agency to a store.', 'vigor' ),
		'priority'  => 105,
	) );


	/**
	 * Homepage Header Hero
	 */
	$wp_customize->add_section( 'vigor_hero', array(
		'title'         => esc_html__( 'Homepage Hero Image', 'vigor' ),
		'description'   => esc_html__( 'Add Hero image and text', 'vigor' ),
		'priority'      => 1,
		'panel'         => 'theme_options',
	) );

	// Homepage Header Hero Show/Hide setting.
	$wp_customize->add_setting( 'vigor_hero_showhide', array(
		'default'       => 'hide',
		'sanitize_callback' => 'vigor_sanitize_showhide',
	) );

	// Homepage Header Hero Show/Hide control.
	$wp_customize->add_control( 'vigor_hero_showhide', array(
		'label'         => esc_html__( 'Homepage Header Hero', 'vigor' ),
		'description'	=> esc_html__( 'Show/Hide Header Hero section.', 'vigor' ),
		'section'       => 'vigor_hero',
		'settings'      => 'vigor_hero_showhide',
		'type'          => 'select',
		'choices'       => array(
		'show'      	=> esc_html__( 'Show', 'vigor' ),
		'hide'      	=> esc_html__( 'Hide', 'vigor' ),
		),
	) );

	// Header Hero Image Setting.
	$wp_customize->add_setting( 'vigor_hero_image', array(
		'default'       => '',
		'sanitize_callback' => 'vigor_sanitize_image',
	) );

	// Header Hero Image Control.
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'vigor_hero_image', array(
			'label'         => esc_html__( 'Hero Image', 'vigor' ),
			'section'    => 'vigor_hero',
			'settings'   => 'vigor_hero_image',
			)
		)
	);

	// Header Hero Image Setting.
	$wp_customize->add_setting( 'vigor_hero_image_2x', array(
		'default'       => '',
		'sanitize_callback' => 'vigor_sanitize_image',
	) );

	// Header Hero Image Control.
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'vigor_hero_image_2x', array(
			'label'         => esc_html__( 'Hero Retina Image', 'vigor' ),
			'section'    => 'vigor_hero',
			'settings'   => 'vigor_hero_image_2x',
			)
		)
	);

	// Homepage Header Hero Title.
	$wp_customize->add_setting( 'vigor_hero_title', array(
		'default'       => esc_html__( 'Hero Title', 'vigor' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Header Hero Title Control.
	$wp_customize->add_control( 'vigor_hero_title', array(
		'label'         => esc_html__( 'Title', 'vigor' ),
		'section'       => 'vigor_hero',
		'settings'      => 'vigor_hero_title',
		'type'          => 'text',
	) );

	// Header Hero Message Setting.
	$wp_customize->add_setting( 'vigor_hero_message', array(
		'default'       => '',
		'sanitize_callback' => 'esc_textarea',
	) );

	// Header Hero Message Control.
	$wp_customize->add_control( 'vigor_hero_message', array(
		'label'         => esc_html__( 'Message', 'vigor' ),
		'section'       => 'vigor_hero',
		'settings'      => 'vigor_hero_message',
		'type'          => 'textarea',
	) );

	// Header Hero Button Setting.
	$wp_customize->add_setting( 'vigor_hero_button', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Header Hero Button Control.
	$wp_customize->add_control( 'vigor_hero_button', array(
		'label'         => esc_html__( 'Button Text', 'vigor' ),
		'description'   => esc_html__( 'The text for first button.', 'vigor' ),
		'section'       => 'vigor_hero',
		'settings'      => 'vigor_hero_button',
		'type'          => 'text',
	) );

	// Header Hero Button URL Setting.
	$wp_customize->add_setting( 'vigor_hero_button_url', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Header Hero Button URL Control.
	$wp_customize->add_control( 'vigor_hero_button_url', array(
		'label'         => esc_html__( 'Button URL', 'vigor' ),
		'description'   => esc_html__( 'The link for first button.', 'vigor' ),
		'section'       => 'vigor_hero',
		'settings'      => 'vigor_hero_button_url',
		'type'          => 'text',
	) );

	// Header Hero Second Button Setting.
	$wp_customize->add_setting( 'vigor_hero_button_2', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Header Hero Second Button Control.
	$wp_customize->add_control( 'vigor_hero_button_2', array(
		'label'         => esc_html__( 'Second button Text', 'vigor' ),
		'description'   => esc_html__( 'The text for second button.', 'vigor' ),
		'section'       => 'vigor_hero',
		'settings'      => 'vigor_hero_button_2',
		'type'          => 'text',
	) );

	// Header Hero Second Button URL Setting.
	$wp_customize->add_setting( 'vigor_hero_button_url_2', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Header Hero Second Button URL Control.
	$wp_customize->add_control( 'vigor_hero_button_url_2', array(
		'label'         => esc_html__( 'Second button URL', 'vigor' ),
		'description'   => esc_html__( 'The link for second button.', 'vigor' ),
		'section'       => 'vigor_hero',
		'settings'      => 'vigor_hero_button_url_2',
		'type'          => 'text',
	) );

	/**
	 * Homepage CTA Section
	 */
	$wp_customize->add_section( 'vigor_cta', array(
		'title'         => esc_html__( 'Homepage Call to Action', 'vigor' ),
		'description'   => esc_html__( 'Click to Action section appears below the header/slideshow section. This section enables you to add a custom text and a Click to Action button.', 'vigor' ),
		'priority'      => 2,
		'panel'         => 'theme_options',
	) );

	// Homepage CTA Title.
	$wp_customize->add_setting( 'vigor_cta_showhide', array(
		'default'       => 'hide',
		'sanitize_callback' => 'vigor_sanitize_showhide',
	) );

	// Homepage CTA Title Control.
	$wp_customize->add_control( 'vigor_cta_showhide', array(
		'label'         => esc_html__( 'Call to Action', 'vigor' ),
		'description'	=> esc_html__( 'Show/Hide call to action section.', 'vigor' ),
		'section'       => 'vigor_cta',
		'settings'      => 'vigor_cta_showhide',
		'type'          => 'select',
		'choices'       => array(
		'show'      	=> esc_html__( 'Show', 'vigor' ),
		'hide'      	=> esc_html__( 'Hide', 'vigor' ),
		),
	) );

	// Homepage CTA Title.
	$wp_customize->add_setting( 'vigor_cta_title', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage CTA Title Control.
	$wp_customize->add_control( 'vigor_cta_title', array(
		'label'         => esc_html__( 'Title', 'vigor' ),
		'section'       => 'vigor_cta',
		'settings'      => 'vigor_cta_title',
		'type'          => 'text',
	) );

	// CTA Message Setting.
	$wp_customize->add_setting( 'vigor_cta_message', array(
		'default'       => '',
		'sanitize_callback' => 'wp_kses_post',
	) );

	// CTA Message Control.
	$wp_customize->add_control( 'vigor_cta_message', array(
		'label'         => esc_html__( 'Message', 'vigor' ),
		'section'       => 'vigor_cta',
		'settings'      => 'vigor_cta_message',
		'type'          => 'textarea',
	) );

	/**
     * Homepage Slideshow
     */

    // Slideshow Section
    $wp_customize->add_section( 'vigor_slideshow', array(
        'title'         => esc_html__( 'Homepage Slideshow', 'vigor' ),
        'description'   => esc_html__( 'All slideshow images will be resized to 2400px wide by 1200px tall, with mobile breakpoints. Low resolution images will not look good in the slideshow area, so please upload images of adequate size for the best display.', 'vigor' ),
        'priority'      => 3,
        'panel'         => 'theme_options',
    ) );

    // Slideshow Setting
    $wp_customize->add_setting( 'slideshow', array(
        'default'       => '',
	) );

	// Slideshow Title.
	$wp_customize->add_setting( 'vigor_slideshow_title', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	
	// Slideshow Title Control.
	$wp_customize->add_control( 'vigor_slideshow_title', array(
		'label'         => esc_html__( 'Title', 'vigor' ),
		'section'       => 'vigor_slideshow',
		'settings'      => 'vigor_slideshow_title',
		'type'          => 'text',
	) );

	// Slideshow Subtitle Setting.
	$wp_customize->add_setting( 'vigor_slideshow_subtitle', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Slideshow Control.
	$wp_customize->add_control( 'vigor_slideshow_subtitle', array(
		'label'         => esc_html__( 'Message', 'vigor' ),
		'section'       => 'vigor_slideshow',
		'settings'      => 'vigor_slideshow_subtitle',
		'type'          => 'textarea',
	) );

	// Slideshow Button Setting.
	$wp_customize->add_setting( 'vigor_slideshow_button', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Slideshow Button Control.
	$wp_customize->add_control( 'vigor_slideshow_button', array(
		'label'         => esc_html__( 'Button Text', 'vigor' ),
		'description'   => esc_html__( 'The text for the text link at the bottom of the slideshow.', 'vigor' ),
		'section'       => 'vigor_slideshow',
		'settings'      => 'vigor_slideshow_button',
		'type'          => 'text',
	) );

	// Slideshow Button URL Setting.
	$wp_customize->add_setting( 'vigor_slideshow_button_url', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Slideshow Button URL Control.
	$wp_customize->add_control( 'vigor_slideshow_button_url', array(
		'label'         => esc_html__( 'Button URL', 'vigor' ),
		'description'   => esc_html__( 'The link for for the text link.', 'vigor' ),
		'section'       => 'vigor_slideshow',
		'settings'      => 'vigor_slideshow_button_url',
		'type'          => 'text',
	) );


    // Slideshow Control
    $wp_customize->add_control( new Vigor_Multi_Image_Control( $wp_customize, 'vigor_slideshow', array(
        'label'         => __( 'Slideshow Images', 'vigor' ),
        'section'       => 'vigor_slideshow',
        'settings'      => 'slideshow',
        'type'          => 'multi-image'
    ) ) );

    // Slideshow Autostart Setting
    $wp_customize->add_setting( 'slideshow_autostart', array(
        'default'       => 'true',
        'sanitize_callback' => 'vigor_sanitize_truefalse',
    ) );

    // Slideshow Autostart Control
    $wp_customize->add_control( 'slideshow_autostart', array(
        'label'         => __( 'Slideshow Autostart', 'vigor' ),
        'section'       => 'vigor_slideshow',
        'settings'      => 'slideshow_autostart',
        'type'          => 'select',
        'choices'       => array(
            'true'      => __( 'Auto start', 'vigor' ),
            'false'     => __( 'Click start', 'vigor' )
        )
    ) );

    // Slideshow Animation Setting
    $wp_customize->add_setting( 'slideshow_animation', array(
        'default'       => 'fade',
        'sanitize_callback' => 'vigor_sanitize_animation',
    ) );

    // Slideshow Animation Control
    $wp_customize->add_control( 'slideshow_animation', array(
        'label'         => __( 'Slideshow Animation', 'vigor' ),
        'section'       => 'vigor_slideshow',
        'settings'      => 'slideshow_animation',
        'type'          => 'select',
        'choices'       => array(
            'fade'          => __( 'Fade', 'vigor' ),
            'horizontal'    => __( 'Slide', 'vigor' )
        )
    ) );


    // Slideshow Navigation Setting
    $wp_customize->add_setting( 'slideshow_nav', array(
        'default'       => 'true',
        'sanitize_callback' => 'vigor_sanitize_truefalse',
    ) );

    // Slideshow Navigation Control
    $wp_customize->add_control( 'slideshow_nav', array(
        'label'         => __( 'Slideshow Navigation', 'vigor' ),
        'section'       => 'vigor_slideshow',
        'settings'      => 'slideshow_nav',
        'type'          => 'select',
        'choices'       => array(
            'true'   => __( 'Show', 'vigor' ),
            'false'  => __( 'Hide', 'vigor' )
        )
    ) );

    // Slideshow Overlay Setting
    $wp_customize->add_setting( 'slideshow_overlay', array(
        'default'       => 'title',
        'sanitize_callback' => 'vigor_sanitize_overlay',
    ) );

    // Slideshow Overlay Control
    $wp_customize->add_control( 'slideshow_overlay', array(
        'label'         => __( 'Slideshow Overlay', 'vigor' ),
        'description'   => __( 'Select an overlay option. Image titles and descriptions are used to populate the overlay text for each slide.', 'vigor' ),
        'section'       => 'vigor_slideshow',
        'settings'      => 'slideshow_overlay',
        'type'          => 'select',
        'choices'       => array(
            'title'         => __( 'Show Image Title & Description', 'vigor' ),
            'none'          => __( 'None', 'vigor' )
        )
    ) );


	/**
	 * Homepage Plans Section
	 */
	$wp_customize->add_section( 'vigor_plans', array(
		'title'         => esc_html__( 'Homepage Plans', 'vigor' ),
		'description'   => esc_html__( 'There are 3 columns in this section with title and description. Highlight the best plans you provide.', 'vigor' ),
		'priority'      => 4,
		'panel'         => 'theme_options',
	) );

	// Homepage Plans Show/Hide setting.
	$wp_customize->add_setting( 'vigor_plans_showhide', array(
		'default'       => 'hide',
		'sanitize_callback' => 'vigor_sanitize_showhide',
	) );

	// Homepage Plans Show/Hide control.
	$wp_customize->add_control( 'vigor_plans_showhide', array(
		'label'         => esc_html__( 'Homepage Plans', 'vigor' ),
		'description'	=> esc_html__( 'Show/Hide plans section.', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_showhide',
		'type'          => 'select',
		'choices'       => array(
		'show'      	=> esc_html__( 'Show', 'vigor' ),
		'hide'      	=> esc_html__( 'Hide', 'vigor' ),
		),
	) );

	// Homepage Plans Title.
	$wp_customize->add_setting( 'vigor_plans_title', array(
		'default'       => esc_html__( 'Plans', 'vigor' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Plans Title Control.
	$wp_customize->add_control( 'vigor_plans_title', array(
		'label'         => esc_html__( 'Title', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_title',
		'type'          => 'text',
	) );

	// Homepage Plans Title.
	$wp_customize->add_setting( 'vigor_plans_title1', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Plans Title Control.
	$wp_customize->add_control( 'vigor_plans_title1', array(
		'label'         => esc_html__( 'Plan Title 1', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_title1',
		'type'          => 'text',
	) );

	// Plans Desc Setting.
	$wp_customize->add_setting( 'vigor_plans_description1', array(
		'default'       => '',
		'sanitize_callback' => 'wp_kses_post',
	) );

	// Plans Desc Control.
	$wp_customize->add_control( 'vigor_plans_description1', array(
		'label'         => esc_html__( 'Plan Description 1', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_description1',
		'type'          => 'textarea',
	) );

	// Homepage Plans Button.
	$wp_customize->add_setting( 'vigor_plans_button1', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Plans Button Control.
	$wp_customize->add_control( 'vigor_plans_button1', array(
		'label'         => esc_html__( 'Plan Button 1', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_button1',
		'type'          => 'text',
	) );

	// Plans Button URL Setting.
	$wp_customize->add_setting( 'vigor_plans_button_url1', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Plans Button URL Control.
	$wp_customize->add_control( 'vigor_plans_button_url1', array(
		'label'         => esc_html__( 'Button URL', 'vigor' ),
		'description'   => esc_html__( 'The link for plan button.', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_button_url1',
		'type'          => 'text',
	) );

	// Homepage Plans Title.
	$wp_customize->add_setting( 'vigor_plans_title2', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Plans Title Control.
	$wp_customize->add_control( 'vigor_plans_title2', array(
		'label'         => esc_html__( 'Plan Title 2', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_title2',
		'type'          => 'text',
	) );

	// Plans Desc Setting.
	$wp_customize->add_setting( 'vigor_plans_description2', array(
		'default'       => '',
		'sanitize_callback' => 'wp_kses_post',
	) );

	// Plans Desc Control.
	$wp_customize->add_control( 'vigor_plans_description2', array(
		'label'         => esc_html__( 'Plan Description 2', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_description2',
		'type'          => 'textarea',
	) );

	// Homepage Plans Button.
	$wp_customize->add_setting( 'vigor_plans_button2', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Plans Button Control.
	$wp_customize->add_control( 'vigor_plans_button2', array(
		'label'         => esc_html__( 'Plan Button 2', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_button2',
		'type'          => 'text',
	) );

	// Plans Button URL Setting.
	$wp_customize->add_setting( 'vigor_plans_button_url2', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Plans Button URL Control.
	$wp_customize->add_control( 'vigor_plans_button_url2', array(
		'label'         => esc_html__( 'Button URL', 'vigor' ),
		'description'   => esc_html__( 'The link for plan button.', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_button_url2',
		'type'          => 'text',
	) );


	// Homepage Plans Title.
	$wp_customize->add_setting( 'vigor_plans_title3', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Plans Title Control.
	$wp_customize->add_control( 'vigor_plans_title3', array(
		'label'         => esc_html__( 'Plan Title 3', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_title3',
		'type'          => 'text',
	) );

	// Plans Desc Setting.
	$wp_customize->add_setting( 'vigor_plans_description3', array(
		'default'       => '',
		'sanitize_callback' => 'wp_kses_post',
	) );

	// Plans Desc Control.
	$wp_customize->add_control( 'vigor_plans_description3', array(
		'label'         => esc_html__( 'Plan Description 3', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_description3',
		'type'          => 'textarea',
	) );

	// Homepage Plans Button.
	$wp_customize->add_setting( 'vigor_plans_button3', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Plans Button Control.
	$wp_customize->add_control( 'vigor_plans_button3', array(
		'label'         => esc_html__( 'Plan Button 3', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_button3',
		'type'          => 'text',
	) );

	// Plans Button URL Setting.
	$wp_customize->add_setting( 'vigor_plans_button_url3', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Plans Button URL Control.
	$wp_customize->add_control( 'vigor_plans_button_url3', array(
		'label'         => esc_html__( 'Button URL', 'vigor' ),
		'description'   => esc_html__( 'The link for plan button.', 'vigor' ),
		'section'       => 'vigor_plans',
		'settings'      => 'vigor_plans_button_url3',
		'type'          => 'text',
	) );

	/**
	 * Homepage Contact Section
	 */
	$wp_customize->add_section( 'vigor_location', array(
		'title'         => esc_html__( 'Homepage Locations', 'vigor' ),
		'priority'      => 5,
		'panel'         => 'theme_options',
	) );

	// Homepage Contact Show/Hide setting.
	$wp_customize->add_setting( 'vigor_location_showhide', array(
		'default'       => 'hide',
		'sanitize_callback' => 'vigor_sanitize_showhide',
	) );

	// Homepage Contact Show/Hide control.
	$wp_customize->add_control( 'vigor_location_showhide', array(
		'label'         => esc_html__( 'Homepage Locations', 'vigor' ),
		'description'	=> esc_html__( 'Show/Hide homepage location section.', 'vigor' ),
		'section'       => 'vigor_location',
		'settings'      => 'vigor_location_showhide',
		'type'          => 'select',
		'choices'       => array(
		'show'      	=> esc_html__( 'Show', 'vigor' ),
		'hide'      	=> esc_html__( 'Hide', 'vigor' ),
		),
	) );

	// Homepage Contact Title.
	$wp_customize->add_setting( 'vigor_location_title', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Contact Title Control.
	$wp_customize->add_control( 'vigor_location_title', array(
		'label'         => esc_html__( 'Title', 'vigor' ),
		'section'       => 'vigor_location',
		'settings'      => 'vigor_location_title',
		'type'          => 'text',
	) );

	// Homepage Location Title.
	$wp_customize->add_setting( 'vigor_location_title1', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Location Title Control 1
	$wp_customize->add_control( 'vigor_location_title1', array(
		'label'         => esc_html__( 'First location title', 'vigor' ),
		'section'       => 'vigor_location',
		'settings'      => 'vigor_location_title1',
		'type'          => 'text',
	) );

	// Homepage Location Address Setting 1
	$wp_customize->add_setting( 'vigor_location_address1', array(
		'default'       => '',
		'sanitize_callback' => 'esc_textarea',
	) );

	// Homepage Location Address Control 1
	$wp_customize->add_control( 'vigor_location_address1', array(
		'label'         => esc_html__( 'First location address', 'vigor' ),
		'description'   => esc_html__( 'This is used for Google Maps', 'vigor' ),
		'section'       => 'vigor_location',
		'settings'      => 'vigor_location_address1',
		'type'          => 'textarea',
	) );

	// Homepage Location Hours Setting 1
	$wp_customize->add_setting( 'vigor_location_details1', array(
		'default'       => '',
		'sanitize_callback' => 'esc_textarea',
	) );

	// Homepage Location Hours Control 1
	$wp_customize->add_control( 'vigor_location_details1', array(
		'label'         => esc_html__( 'First location phone and hours', 'vigor' ),
		'section'       => 'vigor_location',
		'settings'      => 'vigor_location_details1',
		'type'          => 'textarea',
	) );

	// Homepage Location Gallery Setting 1
    $wp_customize->add_setting( 'location_gallery1', array(
        'default'       => '',
	) );

	// Homepage Location Gallery Control 1
    $wp_customize->add_control( new Vigor_Multi_Image_Control( $wp_customize, 'location_gallery1', array(
        'label'         => __( 'Location Gallery 1', 'vigor' ),
        'section'       => 'vigor_location',
        'settings'      => 'location_gallery1',
        'type'          => 'multi-image'
    ) ) );

	// Homepage Location Title 2
	$wp_customize->add_setting( 'vigor_location_title2', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	
	// Homepage Location Title Control 2
	$wp_customize->add_control( 'vigor_location_title2', array(
		'label'         => esc_html__( 'Second location title', 'vigor' ),
		'section'       => 'vigor_location',
		'settings'      => 'vigor_location_title2',
		'type'          => 'text',
	) );

	// Homepage Location Address Setting 2
	$wp_customize->add_setting( 'vigor_location_address2', array(
		'default'       => '',
		'sanitize_callback' => 'esc_textarea',
	) );

	// Homepage Location Address Control 2
	$wp_customize->add_control( 'vigor_location_address2', array(
		'label'         => esc_html__( 'Second location address', 'vigor' ),
		'description'   => esc_html__( 'This is used for Google Maps', 'vigor' ),
		'section'       => 'vigor_location',
		'settings'      => 'vigor_location_address2',
		'type'          => 'textarea',
	) );

	// Homepage Location Hours Setting 2
	$wp_customize->add_setting( 'vigor_location_details2', array(
		'default'       => '',
		'sanitize_callback' => 'esc_textarea',
	) );

	// Homepage Location Hours Control 2
	$wp_customize->add_control( 'vigor_location_details2', array(
		'label'         => esc_html__( 'Second location phone and hours', 'vigor' ),
		'section'       => 'vigor_location',
		'settings'      => 'vigor_location_details2',
		'type'          => 'textarea',
	) );

	// Homepage Location Gallery Setting 2
    $wp_customize->add_setting( 'location_gallery2', array(
        'default'       => '',
	) );

	// Homepage Location Gallery Control 2
    $wp_customize->add_control( new Vigor_Multi_Image_Control( $wp_customize, 'location_gallery2', array(
        'label'         => __( 'Location Gallery 2', 'vigor' ),
        'section'       => 'vigor_location',
        'settings'      => 'location_gallery2',
        'type'          => 'multi-image'
    ) ) );

	// Homepage Location Title 3
	$wp_customize->add_setting( 'vigor_location_title3', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	
	// Homepage Location Title Control 3
	$wp_customize->add_control( 'vigor_location_title3', array(
		'label'         => esc_html__( 'Third location title', 'vigor' ),
		'section'       => 'vigor_location',
		'settings'      => 'vigor_location_title3',
		'type'          => 'text',
	) );

	// Homepage Location Address Setting 3
	$wp_customize->add_setting( 'vigor_location_address3', array(
		'default'       => '',
		'sanitize_callback' => 'esc_textarea',
	) );

	// Homepage Location Address Control 3
	$wp_customize->add_control( 'vigor_location_address3', array(
		'label'         => esc_html__( 'Third location address', 'vigor' ),
		'description'   => esc_html__( 'This is used for Google Maps', 'vigor' ),
		'section'       => 'vigor_location',
		'settings'      => 'vigor_location_address3',
		'type'          => 'textarea',
	) );

	// Homepage Location Hours Setting 3
	$wp_customize->add_setting( 'vigor_location_details3', array(
		'default'       => '',
		'sanitize_callback' => 'esc_textarea',
	) );

	// Homepage Location Hours Control 3
	$wp_customize->add_control( 'vigor_location_details3', array(
		'label'         => esc_html__( 'Third location phone and hours', 'vigor' ),
		'section'       => 'vigor_location',
		'settings'      => 'vigor_location_details3',
		'type'          => 'textarea',
	) );

	// Homepage Location Gallery Setting 3
    $wp_customize->add_setting( 'location_gallery3', array(
        'default'       => '',
	) );

	// Homepage Location Gallery Control 3
    $wp_customize->add_control( new Vigor_Multi_Image_Control( $wp_customize, 'location_gallery3', array(
        'label'         => __( 'Location Gallery 3', 'vigor' ),
        'section'       => 'vigor_location',
        'settings'      => 'location_gallery3',
        'type'          => 'multi-image'
	) ) );
	

	/**
	 * Homepage Mailing List Section
	 */
	$wp_customize->add_section( 'vigor_mailing', array(
		'title'         => esc_html__( 'Homepage Mailing List', 'vigor' ),
		'description'   => esc_html__( 'Homepage mailing list', 'vigor' ),
		'priority'      => 6,
		'panel'         => 'theme_options',
	) );

	// Homepage Mailing List  Title.
	$wp_customize->add_setting( 'vigor_mailing_showhide', array(
		'default'       => 'hide',
		'sanitize_callback' => 'vigor_sanitize_showhide',
	) );

	// Homepage Mailing List  Title Control.
	$wp_customize->add_control( 'vigor_mailing_showhide', array(
		'label'         => esc_html__( 'Mailing List', 'vigor' ),
		'description'	=> esc_html__( 'Show/Hide mailing list section.', 'vigor' ),
		'section'       => 'vigor_mailing',
		'settings'      => 'vigor_mailing_showhide',
		'type'          => 'select',
		'choices'       => array(
		'show'      	=> esc_html__( 'Show', 'vigor' ),
		'hide'      	=> esc_html__( 'Hide', 'vigor' ),
		),
	) );

	// Homepage Mailing List Title.
	$wp_customize->add_setting( 'vigor_mailing_title', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Mailing List Title Control.
	$wp_customize->add_control( 'vigor_mailing_title', array(
		'label'         => esc_html__( 'Title', 'vigor' ),
		'section'       => 'vigor_mailing',
		'settings'      => 'vigor_mailing_title',
		'type'          => 'text',
	) );

	// Mailing List  Message Setting.
	$wp_customize->add_setting( 'vigor_mailing_message', array(
		'default'       => '',
		'sanitize_callback' => 'wp_kses_post',
	) );

	// Mailing List  Message Control.
	$wp_customize->add_control( 'vigor_mailing_message', array(
		'label'         => esc_html__( 'Message', 'vigor' ),
		'section'       => 'vigor_mailing',
		'settings'      => 'vigor_mailing_message',
		'type'          => 'textarea',
	) );

	// Homepage Mailing List Shortcode.
	$wp_customize->add_setting( 'vigor_mailing_shortcode', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Mailing List  Title Control.
	$wp_customize->add_control( 'vigor_mailing_shortcode', array(
		'label'         => esc_html__( 'Shortcode', 'vigor' ),
		'section'       => 'vigor_mailing',
		'settings'      => 'vigor_mailing_shortcode',
		'type'          => 'text',
	) );

	// Mailing List Footer Message Setting.
	$wp_customize->add_setting( 'vigor_mailing_footer_message', array(
		'default'       => '',
		'sanitize_callback' => 'wp_kses_post',
	) );

	// Mailing List Footer Message Control.
	$wp_customize->add_control( 'vigor_mailing_footer_message', array(
		'label'         => esc_html__( 'Mailing List Footer Message', 'vigor' ),
		'section'       => 'vigor_mailing',
		'settings'      => 'vigor_mailing_footer_message',
		'type'          => 'textarea',
	) );

	if ( class_exists( 'woocommerce' ) ) {
	/**
	 * Homepage Shop Section
	 */
	$wp_customize->add_section( 'vigor_shop', array(
		'title'         => esc_html__( 'Homepage Shop Section', 'vigor' ),
		'description'   => esc_html__( 'Display Shop section on your homepage', 'vigor' ),
		'priority'      => 6,
		'panel'         => 'theme_options',
	) );

	// Homepage Shop Show/Hide setting.
	$wp_customize->add_setting( 'vigor_shop_showhide', array(
		'default'       => 'hide',
		'sanitize_callback' => 'vigor_sanitize_showhide',
	) );

	// Homepage Shop Show/Hide control.
	$wp_customize->add_control( 'vigor_shop_showhide', array(
		'label'         => esc_html__( 'Homepage Shop', 'vigor' ),
		'description'	=> esc_html__( 'Show/Hide Shop section.', 'vigor' ),
		'section'       => 'vigor_shop',
		'settings'      => 'vigor_shop_showhide',
		'type'          => 'select',
		'choices'       => array(
		'show'      	=> esc_html__( 'Show', 'vigor' ),
		'hide'      	=> esc_html__( 'Hide', 'vigor' ),
		),
	) );


	// Homepage Shop Title.
	$wp_customize->add_setting( 'vigor_shop_title', array(
		'default'       => esc_html__( 'Shop Section Title', 'vigor' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Shop Title Control.
	$wp_customize->add_control( 'vigor_shop_title', array(
		'label'         => esc_html__( 'Shop Title', 'vigor' ),
		'section'       => 'vigor_shop',
		'settings'      => 'vigor_shop_title',
		'type'          => 'text',
	) );

	// Homepage Shop Message Setting.
	$wp_customize->add_setting( 'vigor_shop_message', array(
		'default'       => '',
		'sanitize_callback' => 'esc_textarea',
	) );

	// Homepage Shop Message Control.
	$wp_customize->add_control( 'vigor_shop_message', array(
		'label'         => esc_html__( 'Message', 'vigor' ),
		'section'       => 'vigor_shop',
		'settings'      => 'vigor_shop_message',
		'type'          => 'textarea',
	) );

	// Homepage Shop Button Setting.
	$wp_customize->add_setting( 'vigor_shop_button', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Shop Button Control.
	$wp_customize->add_control( 'vigor_shop_button', array(
		'label'         => esc_html__( 'Button Text', 'vigor' ),
		'description'   => esc_html__( 'The text for text link.', 'vigor' ),
		'section'       => 'vigor_shop',
		'settings'      => 'vigor_shop_button',
		'type'          => 'text',
	) );

	// Homepage Shop Button URL Setting.
	$wp_customize->add_setting( 'vigor_shop_button_url', array(
		'default'       => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Homepage Shop Button URL Control.
	$wp_customize->add_control( 'vigor_shop_button_url', array(
		'label'         => esc_html__( 'Button URL', 'vigor' ),
		'description'   => esc_html__( 'The link for button.', 'vigor' ),
		'section'       => 'vigor_shop',
		'settings'      => 'vigor_shop_button_url',
		'type'          => 'text',
	) );

	}

}

add_action( 'customize_register', 'vigor_customizer_options' );

/**
 * Sanitization callback for Numbers
 *
 * @param (string) $value unsanitized string.
 * @return (string) $value sanitized string.
 */
function vigor_sanitize_number( $value ) {
	if ( ! in_array( $value, array(
		'2',
		'3',
		'4',
		'6',
		'8',
		'9',
		'12',
		)
	) ) {
		$value = '6';
	}

	return $value;
}

/**
 * Sanitization callback for Show Hide
 *
 * @param (string) $value unsanitized string.
 * @return (string) $value sanitized string.
 */
function vigor_sanitize_showhide( $value ) {
	if ( ! in_array( $value, array(
		'show',
		'hide',
		)
	) ) {
		$value = 'show';
	}

	return $value;
}

/**
 * Sanitization callback for Show Hide
 *
 * @param (string) $value unsanitized string.
 * @return (string) $value sanitized string.
 */
function vigor_sanitize_truefalse( $value ) {
	if ( ! in_array( $value, array(
		'true',
		'false',
		)
	) ) {
		$value = 'true';
	}

	return $value;
}

/**
 * Sanitization callback for Items or Collections 
 *
 * @param (string) $value unsanitized string.
 * @return (string) $value sanitized string.
 */
function vigor_sanitize_item_collection( $value ) {
	if ( ! in_array( $value, array(
		'items',
		'collections',
		)
	) ) {
		$value = 'items';
	}

	return $value;
}

/**
 * Sanitization callback for Portfolio Type
 *
 * @param (string) $value unsanitized string.
 * @return (string) $value sanitized string.
 */
function vigor_sanitize_type( $value ) {
	if ( ! in_array( $value, array(
		'grid',
		'tiled',
		'masonry',
		)
	) ) {
		$value = 'grid';
	}

	return $value;
}

/**
 * Sanitization callback for Animation
 *
 * @param (string) $value unsanitized string.
 * @return (string) $value sanitized string.
 */
function vigor_sanitize_animation( $value ) {
	if ( ! in_array( $value, array(
		'fade',
		'horizontal',
		)
	) ) {
		$value = 'fade';
	}

	return $value;
}

/**
 * Sanitization callback for Overlay
 *
 * @param (string) $value unsanitized string.
 * @return (string) $value sanitized string.
 */
function vigor_sanitize_overlay( $value ) {
	if ( ! in_array( $value, array(
	    'title',
        'search',
        'title_search',
        'none',
		)
	) ) {
		$value = 'title';
	}

	return $value;
}

/**
 * Image sanitization callback.
 *
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default.
 *
 * - Sanitization: image file extension
 * - Control: text, WP_Customize_Image_Control
 *
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */
function vigor_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
	$mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png',
		'bmp'          => 'image/bmp',
		'tif|tiff'     => 'image/tiff',
		'ico'          => 'image/x-icon',
	);
	// Return an array with file extension and mime_type.
	$file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
	return ( $file['ext'] ? $image : $setting->default );
}

/**
 * Binds to customizer options panel.
 */
function vigor_customize_preview_css() {
    wp_enqueue_style( 'vigor_customizer_css', get_template_directory_uri() . '/inc/assets/css/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'vigor_customize_preview_css' );

