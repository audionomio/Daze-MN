<?php
/* ===============================================
	OPTIMIZATION, Customizer section
	Daze - Premium WordPress Theme, by NordWood
================================================== */
/*	WordPress actions and filters
=================================== */
    $wp_customize->add_setting( 'daze_opt_note', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_opt_note', array(
		'section'		=> 'daze_opt',
		'description'	=> esc_html__( 'This section includes a few basic controls for site optimization. To learn more about how these options work and when you should use them, please read the documentation provided with Daze.', 'daze' )
	)));
	
// Remove WP Emojis
	$wp_customize->add_setting( 'daze_opt_no_emojis', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_opt_no_emojis', array(
		'label'      => esc_html__( 'Disable WordPress Emojis', 'daze' ),
		'section'    => 'daze_opt',
		'settings'   => 'daze_opt_no_emojis',
		'type'       => 'checkbox'
	));
	
// Minify dynamic inline css
	$wp_customize->add_setting( 'daze_opt_minify_dynamic_inline_css', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_opt_minify_dynamic_inline_css', array(
		'label'      => esc_html__( 'Minify dynamic inline css', 'daze' ),
		'section'    => 'daze_opt',
		'settings'   => 'daze_opt_minify_dynamic_inline_css',
		'type'       => 'checkbox'
	));
	
// Remove query string from static files
	$wp_customize->add_setting( 'daze_opt_no_queries_on_static_files', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_opt_no_queries_on_static_files', array(
		'label'      => esc_html__( 'Remove query string from static files', 'daze' ),
		'section'    => 'daze_opt',
		'settings'   => 'daze_opt_no_queries_on_static_files',
		'type'       => 'checkbox'
	));
?>