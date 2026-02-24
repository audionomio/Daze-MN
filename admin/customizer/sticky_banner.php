<?php
/* ==============================================
	STICKY BANNER
	Daze - Premium WordPress Theme, by NordWood
================================================= */
// Sticky banner image
	$wp_customize->add_setting( 'daze_sticky_banner_img', array(
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'daze_sticky_banner_img', array(
		'label'			=> esc_html__( 'Sticky banner image', 'daze' ),
		'section'		=> 'daze_sticky_banner',
		'settings'		=> 'daze_sticky_banner_img'
	)));
	
// Selective refresh for sticky banner image
	if( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'daze_sticky_banner_img' )->transport = 'postMessage';
		
		$wp_customize->selective_refresh->add_partial( 'daze_sticky_banner_img', array(
			'selector' => '.sticky-banner',
			'render_callback' => function() {
				$sticky_banner = get_theme_mod( 'daze_sticky_banner_img' );
				
				if( '' === $sticky_banner ) {
					echo '';
					
				} else {
					echo daze_get_giffy_img_by_url( $sticky_banner );
				}
			}
		));
	}
	
// Sticky banner link
	$wp_customize->add_setting( 'daze_sticky_banner_link', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'transport'        	=> 'postMessage',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( 'daze_sticky_banner_link', array(
		'label'		=> esc_html__( 'Sticky banner links to:', 'daze' ),
		'section'	=> 'daze_sticky_banner',
		'settings'	=> 'daze_sticky_banner_link',
		'type'		=> 'url'
	));
	
// Sticky banner height
	$wp_customize->add_setting( 'daze_sticky_banner_height', array(
		'capability'     	=> 'edit_theme_options',
		'default'           => esc_attr__( '78', 'daze' ),
		'transport'        	=> 'postMessage',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_sticky_banner_height', array(
		'label'			=> esc_html__( 'Banner height (px)', 'daze' ),
		'description'	=> esc_html__( 'Image will be resized to the chosen height, while keeping its original ratio.', 'daze' ),
		'input_attrs'	=> array(
								'placeholder' => esc_attr__( '78', 'daze' )
							),
		'section'		=> 'daze_sticky_banner',
		'settings'		=> 'daze_sticky_banner_height',
		'type'			=> 'number'
	));
	
// Sticky banner position
	$wp_customize->add_setting(	'daze_sticky_banner_position', array(
		'default'			=> 'bottom-right',
		'capability'     	=> 'edit_theme_options',
		'transport'        	=> 'postMessage',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_sticky_banner_position', array(
		'label'      	=> esc_html__( 'Sticky banner position', 'daze' ),
		'description'  	=> esc_html__( 'The image will be placed at the chosen corner of the site frame.', 'daze' ),
		'section'    	=> 'daze_sticky_banner',
		'settings'   	=> 'daze_sticky_banner_position',
		'type'       	=> 'radio',
		'choices'    	=> array(
								'bottom-right'	=> esc_html__( 'Bottom right', 'daze' ),
								'bottom-left'	=> esc_html__( 'Bottom left', 'daze' )
							)
	));
	
// Add a close button
	$wp_customize->add_setting( 'daze_sticky_banner_close', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'transport'        	=> 'postMessage',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_sticky_banner_close', array(
		'label'      => esc_html__( 'Add a close button', 'daze' ),
		'section'    => 'daze_sticky_banner',
		'settings'   => 'daze_sticky_banner_close',
		'type'       => 'checkbox'
	));
?>