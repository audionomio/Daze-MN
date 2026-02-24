<?php
/* ==============================================
	SITE HEADER, Customizer section
	Daze - Premium WordPress Theme, by NordWood
================================================= */
/* Site logo */
    $wp_customize->add_setting( 'daze_h_site_logo', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_site_logo', array(
		'section'	=> 'daze_site_header',
		'label'		=> esc_html__( 'Site logo', 'daze' )
	)));
	
// Logo position
	$wp_customize->add_setting(	'daze_logo_position', array(
		'default'			=> 'logo-above-menu',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_logo_position', array(
		'label'			=> esc_html__( 'Logo position in header', 'daze' ),
		'description'	=> esc_html__( 'desktop view', 'daze' ),
		'section'		=> 'daze_site_header',
		'settings'		=> 'daze_logo_position',
		'type'			=> 'radio',
		'choices'		=> array(
								'logo-above-menu'	=> esc_html__( 'Above the main menu', 'daze' ),
								'logo-bellow-menu'	=> esc_html__( 'Bellow the main menu', 'daze' ),
								'logo-left-to-menu'	=> esc_html__( 'Left to the main menu', 'daze' ),
								'logo-right-to-menu' => esc_html__( 'Right to the main menu', 'daze' )
							)
	));
	
// Image link
	$wp_customize->add_setting( 'daze_logo_link', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( 'daze_logo_link', array(
		'label'    			=> esc_html__( 'Logo links to:', 'daze' ),
		'description'    	=> esc_html__( 'Leave blank to keep default (site homepage)', 'daze' ),
		'section'  			=> 'daze_site_header',
		'settings' 			=> 'daze_logo_link',
		'type'       		=> 'url'
	));
	
// Regular logo
	$wp_customize->add_setting( 'daze_site_logo', array(
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'daze_site_logo', array(
		'label'			=> esc_html__( 'Upload logo', 'daze' ),
		'section'		=> 'daze_site_header',
		'settings'		=> 'daze_site_logo'
	)));
	
// Retina logo
	$wp_customize->add_setting( 'daze_site_logo_retina', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type'				=> 'theme_mod'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'daze_site_logo_retina', array(
		'label'			=> esc_html__( 'Upload retina logo', 'daze' ),
		'section'		=> 'daze_site_header',
		'description'	=> esc_html__( 'Has to be twice the size of a regular photo.', 'daze' ),
		'settings'		=> 'daze_site_logo_retina'
	)));
	
// Regular mobile logo
	$wp_customize->add_setting( 'daze_site_logo_mobile', array(
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'daze_site_logo_mobile', array(
		'label'		=> esc_html__( 'Upload mobile logo', 'daze' ),
		'section'	=> 'daze_site_header',
		'settings'	=> 'daze_site_logo_mobile'
	)));
	
// Retina mobile logo
	$wp_customize->add_setting( 'daze_site_logo_mobile_retina', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type'				=> 'theme_mod'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'daze_site_logo_mobile_retina', array(
		'label'			=> esc_html__( 'Upload mobile retina logo', 'daze' ),
		'section'		=> 'daze_site_header',
		'description'	=> esc_html__( 'Has to be twice the size of a regular photo.', 'daze' ),
		'settings'		=> 'daze_site_logo_mobile_retina'
	)));
	
/*	Site title font size	
========================== */
// Desktop
	$wp_customize->add_setting( 'daze_site_title_size', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '42', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_site_title_size', array(
		'label'			=> esc_html__( 'Font size (px) for site title in header (desktop view):', 'daze' ),
		'description'	=> esc_html__( 'if no desktop logo is provided', 'daze' ),
		'input_attrs'	=> array(
								'placeholder' => esc_attr__( '42', 'daze' )
							),
		'section'		=> 'daze_site_header',
		'settings'		=> 'daze_site_title_size',
		'type'			=> 'number'
	));
	
// Mobile
	$wp_customize->add_setting( 'daze_site_title_size_mobile', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '24', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_site_title_size_mobile', array(
		'label'			=> esc_html__( 'Font size (px) for site title in top bar (mobile view):', 'daze' ),
		'description'	=> esc_html__( 'if no desktop nor mobile logo is provided', 'daze' ),
		'input_attrs'	=> array(
								'placeholder' => esc_attr__( '24', 'daze' )
							),
		'section'		=> 'daze_site_header',
		'settings'		=> 'daze_site_title_size_mobile',
		'type'			=> 'number'
	));
	
/*	Search button
=================== */
    $wp_customize->add_setting( 'daze_h_search_button', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_search_button', array(
		'section'	=> 'daze_site_header',
		'label'		=> esc_html__( 'Search button', 'daze' )
	)));
   
// Search button text
	$wp_customize->add_setting( 'daze_search_button_text', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'        	=> esc_attr__( 'Search', 'daze' ),
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control('daze_search_button_text', array(
		'label'      	=> esc_html__( 'Search button text', 'daze' ),
		'input_attrs' 	=> array(
								'placeholder' => esc_attr__( 'Search', 'daze' )
							),
		'section'    	=> 'daze_site_header',
		'settings'   	=> 'daze_search_button_text',
		'type'       	=> 'text'
	));
   
// Search field placeholder
	$wp_customize->add_setting( 'daze_search_placeholder', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'        	=> esc_attr__( 'Type your search', 'daze' ),
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control('daze_search_placeholder', array(
		'label'      	=> esc_html__( 'Search field placeholder', 'daze' ),
		'input_attrs' 	=> array(
								'placeholder' => esc_attr__( 'Type your search', 'daze' )
							),
		'section'    	=> 'daze_site_header',
		'settings'   	=> 'daze_search_placeholder',
		'type'       	=> 'text'
	));

// Search button in top bar
	$wp_customize->add_setting( 'daze_show_search_in_top', array(
		'default'        	=> true,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_show_search_in_top', array(
		'label'      => esc_html__( 'Show in top bar', 'daze' ),
		'section'    => 'daze_site_header',
		'settings'   => 'daze_show_search_in_top',
		'type'       => 'checkbox'
	));

// Search button in top bar
	$wp_customize->add_setting( 'daze_show_search_in_top_mobile', array(
		'default'        	=> true,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_show_search_in_top_mobile', array(
		'label'      => esc_html__( 'Show in mobile menu bar', 'daze' ),
		'section'    => 'daze_site_header',
		'settings'   => 'daze_show_search_in_top_mobile',
		'type'       => 'checkbox'
	));
	
// Search button in main menu
	$wp_customize->add_setting( 'daze_show_search_in_menu', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_show_search_in_menu', array(
		'label'      => esc_html__( 'Show in main menu', 'daze' ),
		'section'    => 'daze_site_header',
		'settings'   => 'daze_show_search_in_menu',
		'type'       => 'checkbox'
	));
?>