<?php
/* ==============================================
	SOCIAL PROFILES, Customizer section
	Daze - Premium WordPress Theme, by NordWood
================================================= */
/* Social profiles
===================== */
    $wp_customize->add_setting( 'daze_social_profiles', array(
        'default' 			=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
	
    $wp_customize->add_control( new Daze_Customize_Social_Profiles( $wp_customize, 'daze_social_profiles', array(
        'label'		=> esc_html__( 'My social profiles', 'daze' ),
        'section'	=> 'daze_social_sharing',
        'settings'	=> 'daze_social_profiles'
    )));
	
// Heading for social links
	$wp_customize->add_setting( 'daze_social_heading', array(
		'default'     		=> esc_attr__( 'Connect with me', 'daze' ),
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( 'daze_social_heading', array(
		'label'      	=> esc_html__( 'Heading for social links (in top bar):', 'daze' ),
		'input_attrs' 	=> array(
							'placeholder' => esc_attr__( 'Connect with me', 'daze' )
		),
		'section'    	=> 'daze_social_sharing',
		'settings'   	=> 'daze_social_heading',
		'type'       	=> 'text'
	));
	
// Social profiles in top bar
	$wp_customize->add_setting( 'daze_social_in_topbar', array(
		'default'			=> false,
		'capability'		=> 'edit_theme_options',
		'type'				=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_social_in_topbar', array(
		'label'      => esc_html__( 'Show the social links in top bar', 'daze' ),
		'section'    => 'daze_social_sharing',
		'settings'   => 'daze_social_in_topbar',
		'type'       => 'checkbox'
	));
	
// Social links in footer
	$wp_customize->add_setting( 'daze_social_in_footer', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_social_in_footer', array(
		'label'      => esc_html__( 'Show the social links in footer', 'daze' ),
		'section'    => 'daze_social_sharing',
		'settings'   => 'daze_social_in_footer',
		'type'       => 'checkbox'
	));
	
/* 	Share options
=================== */
    $wp_customize->add_setting( 'daze_share_options', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_share_options', array(
		'section'	=> 'daze_social_sharing',
		'label'		=> esc_html__( 'Sharing options', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_show_share_buttons', array(
		'default'        	=> true,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_show_share_buttons', array(
		'label'      => esc_html__( 'Show the share buttons', 'daze' ),
		'section'    => 'daze_social_sharing',
		'settings'   => 'daze_show_share_buttons',
		'type'       => 'checkbox'
	));
	
/* Sharing links
===================== */
    $wp_customize->add_setting( 'daze_sharing_links', array(
        'default' 			=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
	
    $wp_customize->add_control( new Daze_Customize_Sharing_Links( $wp_customize, 'daze_sharing_links', array(
        'description'	=> esc_html__( 'Choose the networks you want enable for sharing', 'daze' ),
        'section'		=> 'daze_social_sharing',
        'settings'		=> 'daze_sharing_links'
    )));
	
// Heading for share buttons
	$wp_customize->add_setting( 'daze_share_buttons_text', array(
		'default'     		=> esc_attr__( 'Share this', 'daze' ),
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( 'daze_share_buttons_text', array(
		'label'      	=> esc_html__( 'Text before share buttons', 'daze' ),
		'input_attrs' 	=> array(
								'placeholder' => esc_attr__( 'Share this', 'daze' )
							),
		'section'    	=> 'daze_social_sharing',
		'settings'   	=> 'daze_share_buttons_text',
		'type'       	=> 'text'
	));
	
// Image for Open Graph
	$wp_customize->add_setting( 'daze_include_og', array(
		'default'        	=> true,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_include_og', array(
		'label'      => esc_html__( 'Include Open Graph meta tags', 'daze' ),
		'section'    => 'daze_social_sharing',
		'settings'   => 'daze_include_og',
		'type'       => 'checkbox'
	));
	
// Default social share image
	$wp_customize->add_setting( 'daze_og_image', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'daze_og_image', array(
		'label'    => esc_html__( 'Default image for Open Graph', 'daze' ),
		'section'  => 'daze_social_sharing',
		'settings' => 'daze_og_image'
	)));
	
/* 	Shareable text-selection
============================== */
    $wp_customize->add_setting( 'daze_h_selection_share', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_selection_share', array(
		'section'	=> 'daze_social_sharing',
		'label'		=> esc_html__( 'Twitter share selection', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_selection_share_on', array(
		'default'        	=> true,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_selection_share_on', array(
		'label'      => esc_html__( 'Turn on', 'daze' ),
		'section'    => 'daze_social_sharing',
		'settings'   => 'daze_selection_share_on',
		'type'       => 'checkbox'
	));
	
	$wp_customize->add_setting( 'daze_selection_share_text', array(
		'default'     		=> esc_attr__( 'Tweet this', 'daze' ),
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( 'daze_selection_share_text', array(
		'label'      	=> esc_html__( 'Custom title', 'daze' ),
		'input_attrs' 	=> array(
								'placeholder' => esc_attr__( 'Tweet this', 'daze' )
							),
		'section'    	=> 'daze_social_sharing',
		'settings'   	=> 'daze_selection_share_text',
		'type'       	=> 'text'
	));
	
/* 	Discussion
================ */   
    $wp_customize->add_setting( 'daze_h_fb_comments', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_fb_comments', array(
		'section'	=> 'daze_social_sharing',
		'label'		=> esc_html__( 'FB Comments', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_allow_fb_comments', array(
		'default'			=> false,
		'capability'		=> 'edit_theme_options',
		'type'				=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_allow_fb_comments', array(
		'label'      	=> esc_html__( 'Allow login with Facebook to comment', 'daze' ),
		'description'	=> esc_html__( 'Applies globally to single posts only. For each single page, go to Edit Page and use their own options.', 'daze' ),
		'section'    	=> 'daze_social_sharing',
		'settings'   	=> 'daze_allow_fb_comments',
		'type'       	=> 'checkbox'
	));
		
/* 	API keys
============== */
    $wp_customize->add_setting( 'daze_api_credentials', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_api_credentials', array(
		'section'	=> 'daze_social_sharing',
		'label'		=> esc_html__( 'API keys', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_google_maps_api_key', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( 'daze_google_maps_api_key', array(
		'label'      => esc_html__( 'Google Maps', 'daze' ),
		'section'    => 'daze_social_sharing',
		'settings'   => 'daze_google_maps_api_key',
		'type'       => 'text'
	));
?>