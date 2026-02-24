<?php
/* ==============================================
	SITE IDENTITY - Customizer section
	Daze - Premium WordPress Theme, by NordWood
================================================= */
/* Tagline */
	$wp_customize->add_setting( 'daze_show_tagline', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_show_tagline', array(
		'label'		=> esc_html__( 'Show tagline', 'daze' ),
		'section'	=> 'title_tagline',
		'settings'	=> 'daze_show_tagline',
		'type'		=> 'checkbox'
	));
	
/* Copyright */
    $wp_customize->add_setting( 'daze_h_copyright', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_copyright', array(
		'section'	=> 'title_tagline',
		'label'		=> esc_html__( 'Copyright', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_copyright', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'wp_kses_data'
	));
	
	$wp_customize->add_control( 'daze_copyright', array(
		'section'    => 'title_tagline',
		'settings'   => 'daze_copyright',
		'type'       => 'textarea'
	));
	
/* Favicon (Site Icon) */
	$wp_customize->get_control( 'blogname' )->label			= esc_html__( 'Site title', 'daze' );
	$wp_customize->get_control( 'site_icon' )->label		= esc_html__( 'Favicon', 'daze' );
	$wp_customize->get_control( 'site_icon' )->description	= esc_html__( 'Favicon must be square and at least 512px wide and tall.', 'daze' );
?>