<?php
/* ===============================================
	PAGE 404
	Daze - Premium WordPress Theme, by NordWood
================================================== */
// Background image
	$wp_customize->add_setting( 'daze_page_404_bgr', array(
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'daze_page_404_bgr', array(
		'label'    => esc_html__( 'Background image', 'daze' ),
		'section'  => 'daze_page_404',
		'settings' => 'daze_page_404_bgr'
	)));
   
// Short description
	$wp_customize->add_setting( 'daze_page_404_desc', array(
		'default'        	=> esc_attr__( '404 error', 'daze' ),
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( 'daze_page_404_desc', array(
		'label'      	=> esc_html__( 'Short description', 'daze' ),
		'input_attrs' 	=> array(
							'placeholder' => esc_attr__( '404 error', 'daze' )
		),
		'section'    	=> 'daze_page_404',
		'settings'   	=> 'daze_page_404_desc',
		'type'       	=> 'text'
	));
	
// Selective refresh for description on 404
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'daze_page_404_desc' )->transport = 'postMessage';
		
		$wp_customize->selective_refresh->add_partial( 'daze_page_404_desc', array(
			'selector' 			=> '.err404-desc',
			'render_callback' 	=> function() {
				echo esc_html( get_theme_mod( 'daze_page_404_desc' ) );
			}
		));
	}
   
// Heading
	$wp_customize->add_setting( 'daze_page_404_heading', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'        	=> esc_attr__( 'Oops! This page is not here anymore...', 'daze' ),
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control('daze_page_404_heading', array(
		'label'      	=> esc_html__( 'Custom error message', 'daze' ),
		'input_attrs'	=> array(
								'placeholder' => esc_attr__( 'Oops! This page is not here anymore...', 'daze' )
							),
		'section'		=> 'daze_page_404',
		'settings'		=> 'daze_page_404_heading',
		'type'			=> 'text'
	));
	
// Selective refresh for title on 404
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'daze_page_404_heading' )->transport = 'postMessage';
		
		$wp_customize->selective_refresh->add_partial( 'daze_page_404_heading', array(
			'selector'			=> '.err404-title',
			'render_callback'	=> function() {
				echo esc_html( get_theme_mod( 'daze_page_404_heading' ) );
			}
		));
	}
	
// Text
	$wp_customize->add_setting( 'daze_page_404_text', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'wp_kses_data'
	));
	
	$wp_customize->add_control( 'daze_page_404_text', array(
		'label'      => esc_html__( 'Additional text:', 'daze' ),
		'section'    => 'daze_page_404',
		'settings'   => 'daze_page_404_text',
		'type'       => 'textarea'
	));
	
// Selective refresh for text on 404
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'daze_page_404_text' )->transport = 'postMessage';
		
		$wp_customize->selective_refresh->add_partial( 'daze_page_404_text', array(
			'selector' 			=> '.err404-txt',
			'render_callback' 	=> function() {
				echo esc_html( get_theme_mod( 'daze_page_404_text' ) );
			}
		));
	}
	
// Back to home button label
	$wp_customize->add_setting( 'daze_page_404_bttn_label', array(
		'default'        	=> esc_attr__( 'Back to home', 'daze' ),
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( 'daze_page_404_bttn_label', array(
		'label'      	=> esc_html__( 'Back to home button text', 'daze' ),
		'input_attrs' 	=> array(
								'placeholder' => esc_attr__( 'Back to home', 'daze' )
							),
		'section'    	=> 'daze_page_404',
		'settings'   	=> 'daze_page_404_bttn_label',
		'type'       	=> 'text'
	));
	
// Selective refresh for the back button
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'daze_page_404_bttn_label' )->transport = 'postMessage';
		
		$wp_customize->selective_refresh->add_partial( 'daze_page_404_bttn_label', array(
			'selector' 			=> '.err404-bttn',
			'render_callback' 	=> function() {
				echo esc_html( get_theme_mod( 'daze_page_404_bttn_label', esc_html__( 'Back to home', 'daze' ) ) );
			}
		));
	}
?>