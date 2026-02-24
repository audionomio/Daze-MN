<?php
/* ==============================================
	SPECIAL BOXES, Customizer section
	Daze - Premium WordPress Theme, by NordWood
================================================= */
    $wp_customize->add_setting( 'daze_special_boxes_note', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_special_boxes_note', array(
        'description'	=> esc_html__( 'NOTE: All of the special boxes are now also available as special widgets! Check out the Appearance -> Widgets screen to see this new feature.', 'daze' ),
		'section'	=> 'daze_special_boxes'
	)));
	
/*	Image banner
================== */
    $wp_customize->add_setting( 'daze_h_bannerad_box', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_bannerad_box', array(
		'section'	=> 'daze_special_boxes',
		'label'		=> esc_html__( 'Banner Ad', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_inc_bannerad_box', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_inc_bannerad_box', array(
		'label'      => esc_html__( 'Turn on', 'daze' ),
		'section'    => 'daze_special_boxes',
		'settings'   => 'daze_inc_bannerad_box',
		'type'       => 'checkbox'
	));
	
// Starting position
	$wp_customize->add_setting( 'daze_bannerad_box_start', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '3', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_bannerad_box_start', array(
		'label'      		=> esc_html__( 'Starting position:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '3', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_bannerad_box_start',
		'type'       		=> 'number',
		'active_callback' 	=> 'daze_control_bannerad_box'
	));
	
// Repeating interval
	$wp_customize->add_setting( 'daze_bannerad_box_interval', array(
		'capability'		=> 'edit_theme_options',
		'type'				=> 'theme_mod',
		'default'           => esc_attr__( '5', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control('daze_bannerad_box_interval', array(
		'label'      		=> esc_html__( 'Repeat on every x posts:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '5', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_bannerad_box_interval',
		'type'       		=> 'number',
        'active_callback'	=> 'daze_control_bannerad_box'
	));
	
// Image upload
	$wp_customize->add_setting( 'daze_bannerad_box_img', array(
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'daze_bannerad_box_img', array(
		'label'				=> esc_html__( 'Upload image', 'daze' ),
		'section'			=> 'daze_special_boxes',
		'settings'			=> 'daze_bannerad_box_img',
        'active_callback'	=> 'daze_control_bannerad_box',
	)));
	
// Image link
	$wp_customize->add_setting( 'daze_bannerad_box_link', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'transport'        	=> 'postMessage',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( 'daze_bannerad_box_link', array(
		'label'    			=> esc_html__( 'Image Link', 'daze' ),
		'section'  			=> 'daze_special_boxes',
		'settings' 			=> 'daze_bannerad_box_link',
		'type'       		=> 'url',
        'active_callback' 	=> 'daze_control_bannerad_box'
	));
	
// Banner 2
	$wp_customize->add_setting( 'daze_inc_bannerad_2', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_inc_bannerad_2', array(
		'label'      		=> esc_html__( 'Add another banner', 'daze' ),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_inc_bannerad_2',
		'type'       		=> 'checkbox',
        'active_callback'	=> 'daze_control_bannerad_box'
	));
	
// Subsection heading
    $wp_customize->add_setting( 'daze_h_bannerad_2', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_bannerad_2', array(
		'section'			=> 'daze_special_boxes',
		'label'				=> esc_html__( 'Banner Ad 2', 'daze' ),
		'active_callback' 	=> 'daze_control_bannerad_2'
	)));
	
// Banner 2 Starting position
	$wp_customize->add_setting( 'daze_bannerad_2_start', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '3', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_bannerad_2_start', array(
		'label'      		=> esc_html__( 'Starting position:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '3', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_bannerad_2_start',
		'type'       		=> 'number',
		'active_callback' 	=> 'daze_control_bannerad_2'
	));
	
// Banner 2 Repeating interval
	$wp_customize->add_setting( 'daze_bannerad_2_interval', array(
		'capability'		=> 'edit_theme_options',
		'type'				=> 'theme_mod',
		'default'           => esc_attr__( '5', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control('daze_bannerad_2_interval', array(
		'label'      		=> esc_html__( 'Repeat on every x posts:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '5', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_bannerad_2_interval',
		'type'       		=> 'number',
        'active_callback'	=> 'daze_control_bannerad_2'
	));
	
// Banner 2 Image upload
	$wp_customize->add_setting( 'daze_bannerad_2_img', array(
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'daze_bannerad_2_img', array(
		'label'				=> esc_html__( 'Upload image', 'daze' ),
		'section'			=> 'daze_special_boxes',
		'settings'			=> 'daze_bannerad_2_img',
        'active_callback'	=> 'daze_control_bannerad_2',
	)));
	
// Banner 2 Image link
	$wp_customize->add_setting( 'daze_bannerad_2_link', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'transport'        	=> 'postMessage',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( 'daze_bannerad_2_link', array(
		'label'    			=> esc_html__( 'Image Link', 'daze' ),
		'section'  			=> 'daze_special_boxes',
		'settings' 			=> 'daze_bannerad_2_link',
		'type'       		=> 'url',
        'active_callback' 	=> 'daze_control_bannerad_2'
	));
	
// Banner 3
	$wp_customize->add_setting( 'daze_inc_bannerad_3', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_inc_bannerad_3', array(
		'label'      		=> esc_html__( 'Add another banner', 'daze' ),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_inc_bannerad_3',
		'type'       		=> 'checkbox',
        'active_callback'	=> 'daze_control_bannerad_2'
	));
	
// Subsection heading
    $wp_customize->add_setting( 'daze_h_bannerad_3', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_bannerad_3', array(
		'section'	=> 'daze_special_boxes',
		'label'		=> esc_html__( 'Banner Ad 3', 'daze' ),
		'active_callback' 	=> 'daze_control_bannerad_3'
	)));	
	
// Banner 3 Starting position
	$wp_customize->add_setting( 'daze_bannerad_3_start', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '3', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_bannerad_3_start', array(
		'label'      		=> esc_html__( 'Starting position:', 'daze' ),
		'input_attrs' 		=> array(
								'placeholder' => esc_attr__( '3', 'daze' )
		),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_bannerad_3_start',
		'type'       		=> 'number',
		'active_callback' 	=> 'daze_control_bannerad_3'
	));
	
// Banner 3 Repeating interval
	$wp_customize->add_setting( 'daze_bannerad_3_interval', array(
		'capability'		=> 'edit_theme_options',
		'type'				=> 'theme_mod',
		'default'           => esc_attr__( '5', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control('daze_bannerad_3_interval', array(
		'label'      		=> esc_html__( 'Repeat on every x posts:', 'daze' ),
		'input_attrs' 		=> array(
								'placeholder' => esc_attr__( '5', 'daze' )
		),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_bannerad_3_interval',
		'type'       		=> 'number',
        'active_callback'	=> 'daze_control_bannerad_3'
	));
	
// Banner 3 Image upload
	$wp_customize->add_setting( 'daze_bannerad_3_img', array(
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'daze_bannerad_3_img', array(
		'label'				=> esc_html__( 'Upload image', 'daze' ),
		'section'			=> 'daze_special_boxes',
		'settings'			=> 'daze_bannerad_3_img',
        'active_callback'	=> 'daze_control_bannerad_3',
	)));
	
// Banner 3 Image link
	$wp_customize->add_setting( 'daze_bannerad_3_link', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'transport'        	=> 'postMessage',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( 'daze_bannerad_3_link', array(
		'label'    			=> esc_html__( 'Image Link', 'daze' ),
		'section'  			=> 'daze_special_boxes',
		'settings' 			=> 'daze_bannerad_3_link',
		'type'       		=> 'url',
        'active_callback' 	=> 'daze_control_bannerad_3'
	));
	
// Banner 4
	$wp_customize->add_setting( 'daze_inc_bannerad_4', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_inc_bannerad_4', array(
		'label'      		=> esc_html__( 'Add another banner', 'daze' ),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_inc_bannerad_4',
		'type'       		=> 'checkbox',
        'active_callback'	=> 'daze_control_bannerad_3'
	));
	
// Subsection heading
    $wp_customize->add_setting( 'daze_h_bannerad_4', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_bannerad_4', array(
		'section'	=> 'daze_special_boxes',
		'label'		=> esc_html__( 'Banner Ad 4', 'daze' ),
		'active_callback' 	=> 'daze_control_bannerad_4'
	)));	
	
// Banner 3 Starting position
	$wp_customize->add_setting( 'daze_bannerad_4_start', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '3', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_bannerad_4_start', array(
		'label'      		=> esc_html__( 'Starting position:', 'daze' ),
		'input_attrs' 		=> array(
								'placeholder' => esc_attr__( '3', 'daze' )
		),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_bannerad_4_start',
		'type'       		=> 'number',
		'active_callback' 	=> 'daze_control_bannerad_4'
	));
	
// Banner 4 Repeating interval
	$wp_customize->add_setting( 'daze_bannerad_4_interval', array(
		'capability'		=> 'edit_theme_options',
		'type'				=> 'theme_mod',
		'default'           => esc_attr__( '5', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control('daze_bannerad_4_interval', array(
		'label'      		=> esc_html__( 'Repeat on every x posts:', 'daze' ),
		'input_attrs' 		=> array(
								'placeholder' => esc_attr__( '5', 'daze' )
		),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_bannerad_4_interval',
		'type'       		=> 'number',
        'active_callback'	=> 'daze_control_bannerad_4'
	));
	
// Banner 4 Image upload
	$wp_customize->add_setting( 'daze_bannerad_4_img', array(
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'daze_bannerad_4_img', array(
		'label'				=> esc_html__( 'Upload image', 'daze' ),
		'section'			=> 'daze_special_boxes',
		'settings'			=> 'daze_bannerad_4_img',
        'active_callback'	=> 'daze_control_bannerad_4',
	)));
	
// Banner 4 Image link
	$wp_customize->add_setting( 'daze_bannerad_4_link', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'transport'        	=> 'postMessage',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( 'daze_bannerad_4_link', array(
		'label'    			=> esc_html__( 'Image Link', 'daze' ),
		'section'  			=> 'daze_special_boxes',
		'settings' 			=> 'daze_bannerad_4_link',
		'type'       		=> 'url',
        'active_callback' 	=> 'daze_control_bannerad_4'
	));
	
// Banner 5
	$wp_customize->add_setting( 'daze_inc_bannerad_5', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_inc_bannerad_5', array(
		'label'      		=> esc_html__( 'Add another banner', 'daze' ),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_inc_bannerad_5',
		'type'       		=> 'checkbox',
        'active_callback'	=> 'daze_control_bannerad_4'
	));
	
// Subsection heading
    $wp_customize->add_setting( 'daze_h_bannerad_5', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_bannerad_5', array(
		'section'	=> 'daze_special_boxes',
		'label'		=> esc_html__( 'Banner Ad 5', 'daze' ),
		'active_callback' 	=> 'daze_control_bannerad_5'
	)));	
	
// Banner 3 Starting position
	$wp_customize->add_setting( 'daze_bannerad_5_start', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '3', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_bannerad_5_start', array(
		'label'      		=> esc_html__( 'Starting position:', 'daze' ),
		'input_attrs' 		=> array(
								'placeholder' => esc_attr__( '3', 'daze' )
		),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_bannerad_5_start',
		'type'       		=> 'number',
		'active_callback' 	=> 'daze_control_bannerad_5'
	));
	
// Banner 5 Repeating interval
	$wp_customize->add_setting( 'daze_bannerad_5_interval', array(
		'capability'		=> 'edit_theme_options',
		'type'				=> 'theme_mod',
		'default'           => esc_attr__( '5', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control('daze_bannerad_5_interval', array(
		'label'      		=> esc_html__( 'Repeat on every x posts:', 'daze' ),
		'input_attrs' 		=> array(
								'placeholder' => esc_attr__( '5', 'daze' )
		),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_bannerad_5_interval',
		'type'       		=> 'number',
        'active_callback'	=> 'daze_control_bannerad_5'
	));
	
// Banner 5 Image upload
	$wp_customize->add_setting( 'daze_bannerad_5_img', array(
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'daze_bannerad_5_img', array(
		'label'				=> esc_html__( 'Upload image', 'daze' ),
		'section'			=> 'daze_special_boxes',
		'settings'			=> 'daze_bannerad_5_img',
        'active_callback'	=> 'daze_control_bannerad_5',
	)));
	
// Banner 5 Image link
	$wp_customize->add_setting( 'daze_bannerad_5_link', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'transport'        	=> 'postMessage',
		'type'           	=> 'theme_mod'
	));
	
	$wp_customize->add_control( 'daze_bannerad_5_link', array(
		'label'    			=> esc_html__( 'Image Link', 'daze' ),
		'section'  			=> 'daze_special_boxes',
		'settings' 			=> 'daze_bannerad_5_link',
		'type'       		=> 'url',
        'active_callback' 	=> 'daze_control_bannerad_5'
	));
	
/* Social box
=============== */
    $wp_customize->add_setting( 'h_social_box', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'h_social_box', array(
		'section'	=> 'daze_special_boxes',
		'label'		=> esc_html__( 'Social links box', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_inc_social_box', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_inc_social_box', array(
		'label'      => esc_html__('Turn on', 'daze'),
		'section'    => 'daze_special_boxes',
		'settings'   => 'daze_inc_social_box',
		'type'       => 'checkbox'
	));
	
// Starting position
	$wp_customize->add_setting( 'daze_social_box_start', array(
		'capability'		=> 'edit_theme_options',
		'type'				=> 'theme_mod',
		'default'			=> esc_attr__( '3', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control('social_box_start_c', array(
		'label'      		=> esc_html__('Starting position:', 'daze'),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '3', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_social_box_start',
		'type'       		=> 'number',
		'active_callback' 	=> 'daze_control_social_box'
	));
	
// Repeating interval
	$wp_customize->add_setting( 'daze_social_box_interval', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'			=> esc_attr__( '5', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control('daze_social_box_interval', array(
		'label'      		=> esc_html__( 'Repeat on every x posts:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '5', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_social_box_interval',
		'type'       		=> 'number',
        'active_callback'	=> 'daze_control_social_box'
	));
	
// Short description
	$wp_customize->add_setting( 'daze_social_box_desc', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'          	=> esc_html__( 'Follow me', 'daze' ),
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( 'daze_social_box_desc', array(
		'label'      		=> esc_html__( 'Short description:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( 'Follow me', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_social_box_desc',
		'type'       		=> 'text',
        'active_callback'	=> 'daze_control_social_box'
	));
	
// Selective refresh for description on social box
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'daze_social_box_desc' )->transport = 'postMessage';
		
		$wp_customize->selective_refresh->add_partial( 'daze_social_box_desc', array(
			'selector' 			=> '.masonry-item.social h6',
			'render_callback' 	=> function() {
				echo esc_html( get_theme_mod( 'daze_social_box_desc' ) );
			}
		));
	}
	
// Heading
	$wp_customize->add_setting( 'daze_social_box_heading', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'          	=> esc_html__( 'Connect', 'daze' ),
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( 'daze_social_box_heading', array(
		'label'      		=> esc_html__( 'Heading:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( 'Connect', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_social_box_heading',
		'type'       		=> 'text',
        'active_callback'	=> 'daze_control_social_box'
	));
	
// Selective refresh for heading on social box
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'daze_social_box_heading' )->transport = 'postMessage';
		
		$wp_customize->selective_refresh->add_partial( 'daze_social_box_heading', array(
			'selector' 			=> '.masonry-item.social h2',
			'render_callback' 	=> function() {
				echo esc_html( get_theme_mod( 'daze_social_box_heading' ) );
			}
		));
	}
	
/* Top posts
============== */
    $wp_customize->add_setting( 'daze_h_top_posts_box', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_top_posts_box', array(
		'section' => 'daze_special_boxes',
		'label' => esc_html__( 'Popular/Latest posts', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_inc_top_posts_box', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_inc_top_posts_box', array(
		'label'      => esc_html__( 'Turn on', 'daze' ),
		'section'    => 'daze_special_boxes',
		'settings'   => 'daze_inc_top_posts_box',
		'type'       => 'checkbox'
	));
	
// Starting position
	$wp_customize->add_setting( 'daze_top_posts_box_start', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'			=> esc_attr__( '3', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_top_posts_box_start', array(
		'label'      		=> esc_html__( 'Starting position:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '3', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_top_posts_box_start',
		'type'				=> 'number',
		'active_callback' 	=> 'daze_control_top_posts'
	));
	
// Repeating interval
	$wp_customize->add_setting( 'daze_top_posts_box_interval', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'			=> esc_attr__( '5', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_top_posts_box_interval', array(
		'label'      		=> esc_html__( 'Repeat on every x posts:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '5', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_top_posts_box_interval',
		'type'       		=> 'number',
        'active_callback' 	=> 'daze_control_top_posts',
	));
	
// Number of posts
	$wp_customize->add_setting( 'daze_top_posts_box_count', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'			=> esc_attr__( '4', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_top_posts_box_count', array(
		'label'      		=> esc_html__( 'Number of posts:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '4', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_top_posts_box_count',
		'type'       		=> 'number',
        'active_callback' 	=> 'daze_control_top_posts',
	));
	
// Post title length
	$wp_customize->add_setting( 'daze_top_posts_box_title_length', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'			=> esc_attr__( '6', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_top_posts_box_title_length', array(
		'label'      		=> esc_html__( 'Post title word count:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '6', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_top_posts_box_title_length',
		'type'       		=> 'number',
        'active_callback' 	=> 'daze_control_top_posts',
	));
	
// Show popular
	$wp_customize->add_setting( 'daze_top_posts_box_popular', array(
		'default'        	=> true,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_top_posts_box_popular', array(
		'label'      		=> esc_html__( 'Show Popular', 'daze' ),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_top_posts_box_popular',
		'type'       		=> 'checkbox',
        'active_callback' 	=> 'daze_control_top_posts'
	));
	
// Show latest
	$wp_customize->add_setting( 'daze_top_posts_box_latest', array(
		'default'        	=> true,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_top_posts_box_latest', array(
		'label'      		=> esc_html__( 'Show Latest', 'daze' ),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_top_posts_box_latest',
		'type'       		=> 'checkbox',
        'active_callback' 	=> 'daze_control_top_posts'
	));
	
// Hide views
	$wp_customize->add_setting( 'daze_top_posts_hide_views', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_top_posts_hide_views', array(
		'label'      		=> esc_html__( 'Hide views', 'daze' ),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_top_posts_hide_views',
		'type'       		=> 'checkbox',
        'active_callback' 	=> 'daze_control_top_posts'
	));
	
// Hide comments count
	$wp_customize->add_setting( 'daze_top_posts_hide_comments', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_top_posts_hide_comments', array(
		'label'      		=> esc_html__( 'Hide comments count', 'daze' ),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_top_posts_hide_comments',
		'type'       		=> 'checkbox',
        'active_callback' 	=> 'daze_control_top_posts'
	));
	
// Hide date
	$wp_customize->add_setting( 'daze_top_posts_hide_date', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_top_posts_hide_date', array(
		'label'      		=> esc_html__( 'Hide date', 'daze' ),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_top_posts_hide_date',
		'type'       		=> 'checkbox',
        'active_callback' 	=> 'daze_control_top_posts'
	));
	
/* Latest comments
==================== */
    $wp_customize->add_setting( 'daze_h_latest_comments_box', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_latest_comments_box', array(
		'section' 	=> 'daze_special_boxes',
		'label'		=> esc_html__( 'Latest comments', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_inc_latest_comments_box', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_inc_latest_comments_box', array(
		'label'      => esc_html__( 'Turn on', 'daze' ),
		'section'    => 'daze_special_boxes',
		'settings'   => 'daze_inc_latest_comments_box',
		'type'       => 'checkbox'
	));
	
// Starting position
	$wp_customize->add_setting( 'daze_latest_comments_box_start', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '3', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_latest_comments_box_start', array(
		'label'      		=> esc_html__( 'Starting position:', 'daze' ),
		'input_attrs'		=> array(
									'placeholder' => esc_attr__( '3', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_latest_comments_box_start',
		'type'       		=> 'number',
		'active_callback' 	=> 'daze_control_latest_comments_box'
	));
	
// Repeating interval
	$wp_customize->add_setting( 'daze_latest_comments_box_interval', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '5', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_latest_comments_box_interval', array(
		'label'      		=> esc_html__( 'Repeat on every x posts:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '5', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_latest_comments_box_interval',
		'type'       		=> 'number',
        'active_callback' 	=> 'daze_control_latest_comments_box',
	));
	
// Number of posts
	$wp_customize->add_setting( 'daze_latest_comments_box_count', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '4', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_latest_comments_box_count', array(
		'label'      		=> esc_html__( 'Number of posts:', 'daze' ),
		'input_attrs' 		=> array(
									'placeholder' => esc_attr__( '4', 'daze' )
								),
		'section'    		=> 'daze_special_boxes',
		'settings'   		=> 'daze_latest_comments_box_count',
		'type'       		=> 'number',
        'active_callback' 	=> 'daze_control_latest_comments_box',
	));
?>