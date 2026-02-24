<?php
/* =============================================
	COLOR SCHEME, Customizer section
	Daze - Premium WordPress Theme, by NordWood
================================================ */
/* Site frame color */
    $wp_customize->add_setting( 'daze_main_color_frame', array(
        'default'           => '#ff2955',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
		'transport' 		=> 'postMessage',
        'type'				=> 'theme_mod' 
    ));
	
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'daze_main_color_frame', array(
        'label'    => esc_html__( 'Site frame color', 'daze' ),
        'section'  => 'colors',
        'settings' => 'daze_main_color_frame'
    )));
	
/* Site frame width */
	$wp_customize->add_setting( 'daze_frame_width_mobile', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '5', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_frame_width_mobile', array(
		'label'			=> esc_html__( 'Site frame width (for mobiles):', 'daze' ),
		'description'	=> esc_html__( 'in pixels', 'daze' ),
		'input_attrs'	=> array(
								'placeholder' => esc_attr__( '5', 'daze' )
							),
		'section'		=> 'colors',
		'settings'		=> 'daze_frame_width_mobile',
		'type'			=> 'number'
	));
	
	$wp_customize->add_setting( 'daze_frame_width_desktop', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '7', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_frame_width_desktop', array(
		'label'			=> esc_html__( 'Site frame width (for desktop):', 'daze' ),
		'description'	=> esc_html__( 'in pixels', 'daze' ),
		'input_attrs'	=> array(
								'placeholder' => esc_attr__( '7', 'daze' )
							),
		'section'		=> 'colors',
		'settings'		=> 'daze_frame_width_desktop',
		'type'			=> 'number'
	));
	
/* Links */
    $wp_customize->add_setting( 'daze_main_color_links', array(
        'default'           => '#ff2955',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'type'				=> 'theme_mod' 
    ));
	
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'daze_main_color_links', array(
        'label'			=> esc_html__( 'Links', 'daze' ),
        'description'	=> esc_html__( 'Used also for buttons text, pagination, tagcloud and category count', 'daze' ),
        'section'		=> 'colors',
        'settings'		=> 'daze_main_color_links'
    )));	
	
// Other
    $wp_customize->add_setting( 'daze_main_color_other', array(
        'default'           => '#ff2955',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'type'				=> 'theme_mod' 
    ));
	
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'daze_main_color_other', array(
        'label'				=> esc_html__( 'Other', 'daze' ),
        'description'		=> esc_html__( 'Used for dots in calendar widget and lists, drop-caps underline, close button on popout, sticky post badge.', 'daze' ),
        'section'			=> 'colors',
        'settings'			=> 'daze_main_color_other'
    )));

/* Placeholder styles */
	$wp_customize->add_setting( 'daze_bgr_pattern', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type'				=> 'theme_mod'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'daze_bgr_pattern', array(
		'label'			=> esc_html__( 'Holder pattern', 'daze' ),
		'description' 	=> esc_html__( 'It will be used as background in the search area, on Pinterest list and also in the posts slider, if no image is uploaded.', 'daze' ),
		'section'  		=> 'colors',
		'settings' 		=> 'daze_bgr_pattern'
	)));
	
/* Placeholder bgr color */
    $wp_customize->add_setting( 'daze_bgr_pattern_color', array(
        'default'           => '#111',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'type'				=> 'theme_mod'
    ));
	
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'daze_bgr_pattern_color', array(
        'label'			=> esc_html__( 'Holder color', 'daze' ),
        'description'	=> esc_html__( 'It will be used if no image pattern is uploaded.', 'daze' ),
        'section'		=> 'colors',
        'settings'		=> 'daze_bgr_pattern_color'
    )));
	
/* Placeholder text color */
    $wp_customize->add_setting( 'daze_bgr_pattern_text', array(
        'default'           => '#ffffff',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
		'transport' 		=> 'postMessage',
        'type'				=> 'theme_mod' 
    ));
	
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'daze_bgr_pattern_text', array(
        'label'    => esc_html__( 'Search text color', 'daze' ),
        'section'  => 'colors',
        'settings' => 'daze_bgr_pattern_text'
    )));
?>