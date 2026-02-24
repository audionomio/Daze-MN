<?php
/* ==============================================
	POSTS SLIDER, Customizer section
	Daze - Premium WordPress Theme, by NordWood
================================================= */
/* Show slider */
	$wp_customize->add_setting( 'daze_nwps_on', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_nwps_on', array(
		'label'      => esc_html__( 'Turn on', 'daze' ),
		'section'    => 'daze_posts_slider',
		'settings'   => 'daze_nwps_on',
		'type'       => 'checkbox'
	));
	
/* Type of slider */
	$wp_customize->add_setting( 'daze_nwps_type', array(
		'default'        	=> 'columns',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_nwps_type', array(
		'label'      		=> esc_html__( 'Type of slider:', 'daze' ),
		'section'    		=> 'daze_posts_slider',
		'settings'   		=> 'daze_nwps_type',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'simple' 	=> esc_html__( '1 post per slide', 'daze' ),
									'columns' 	=> esc_html__( '3 posts per slide', 'daze' )
								),
        'active_callback' 	=> 'daze_control_nwps'
	));
	
/* Number of posts */
	$wp_customize->add_setting( 'daze_nwps_num_of_posts', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'			=> esc_attr__( '1', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_nwps_num_of_posts', array(
		'label'      		=> esc_html__( 'Number of posts in slider', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '1', 'daze' )
								),
		'section'    		=> 'daze_posts_slider',
		'settings'   		=> 'daze_nwps_num_of_posts',
		'type'       		=> 'number',
        'active_callback' 	=> 'daze_control_nwps'
	));
	
/* Autoplay */
	$wp_customize->add_setting( 'daze_nwps_autoplay', array(
		'default'        	=> true,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_nwps_autoplay', array(
		'label'      		=> esc_html__( 'Auto play', 'daze' ),
		'section'    		=> 'daze_posts_slider',
		'settings'   		=> 'daze_nwps_autoplay',
		'type'       		=> 'checkbox',
        'active_callback' 	=> 'daze_control_nwps'
	));
	
/* Show category */
	$wp_customize->add_setting( 'daze_nwps_show_cat', array(
		'default'        	=> true,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_nwps_show_cat', array(
		'label'      		=> esc_html__( 'Show category', 'daze' ),
		'section'    		=> 'daze_posts_slider',
		'settings'   		=> 'daze_nwps_show_cat',
		'type'				=> 'checkbox',
        'active_callback' 	=> 'daze_control_nwps'
	));
	
/* Show date */
	$wp_customize->add_setting( 'daze_nwps_show_date', array(
		'default'        	=> true,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_nwps_show_date', array(
		'label'      		=> esc_html__( 'Show date', 'daze' ),
		'section'    		=> 'daze_posts_slider',
		'settings'   		=> 'daze_nwps_show_date',
		'type'       		=> 'checkbox',
        'active_callback' 	=> 'daze_control_nwps'
	));
	
/* Show author */
	$wp_customize->add_setting( 'daze_nwps_show_author', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_nwps_show_author', array(
		'label'      		=> esc_html__( 'Show author', 'daze' ),
		'section'    		=> 'daze_posts_slider',
		'settings'   		=> 'daze_nwps_show_author',
		'type'       		=> 'checkbox',
        'active_callback' 	=> 'daze_control_nwps'
	));
	
/* Post title length */
	$wp_customize->add_setting( 'daze_nwps_title_length', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'			=> esc_attr__( '6', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_nwps_title_length', array(
		'label'      		=> esc_html__( 'Post title word count:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '6', 'daze' )
								),
		'section'    		=> 'daze_posts_slider',
		'settings'   		=> 'daze_nwps_title_length',
		'type'       		=> 'number',
        'active_callback' 	=> 'daze_control_nwps',
	));
	
/* Overlay color */
    $wp_customize->add_setting( 'daze_nwps_overlay_color', array(
        'default'           => '#000',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'type'				=> 'theme_mod'
    ));
	
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'daze_nwps_overlay_color', array(
        'label'    			=> esc_html__( 'Overlay color', 'daze' ),
        'section'  			=> 'daze_posts_slider',
        'settings' 			=> 'daze_nwps_overlay_color',
        'active_callback' 	=> 'daze_control_nwps'
    )));
	
/* Overlay opacity */
	$wp_customize->add_setting( 'daze_nwps_overlay_opacity', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '15', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_nwps_overlay_opacity', array(
		'label'      		=> esc_html__( 'Overlay opacity (in percents)', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '15', 'daze' )
								),
		'section'    		=> 'daze_posts_slider',
		'settings'   		=> 'daze_nwps_overlay_opacity',
		'type'       		=> 'number',
        'active_callback' 	=> 'daze_control_nwps'
	));
	
/* Grain effect */
	$wp_customize->add_setting( 'daze_nwps_grain_on', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_nwps_grain_on', array(
		'label'      		=> esc_html__( 'Include grain effect', 'daze' ),
		'section'    		=> 'daze_posts_slider',
		'settings'   		=> 'daze_nwps_grain_on',
		'type'       		=> 'checkbox',
        'active_callback' 	=> 'daze_control_nwps'
	));
?>