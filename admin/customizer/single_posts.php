<?php
/* ==============================================
	SINGLE POST, Customizer section
	Daze - Premium WordPress Theme, by NordWood
================================================= */
    $wp_customize->add_setting( 'daze_h_single_posts', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_single_posts', array(
		'section' 		=> 'daze_single_posts',
		'description'	=> esc_html__( 'Force global settings on all single posts', 'daze' )
	)));
	
/* Sidebar */
	$wp_customize->add_setting(	'daze_include_sidebar_on_posts', array(
		'default'			=> 'hide-sidebar',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_include_sidebar_on_posts', array(
		'section'    => 'daze_single_posts',
		'settings'   => 'daze_include_sidebar_on_posts',
		'type'       => 'radio',
		'choices'    => array(
							'include-sidebar'	=> esc_html__( 'Include sidebar', 'daze' ),
							'hide-sidebar'		=> esc_html__( 'Hide sidebar', 'daze' )
						)
	));
	
/* Post category */   	
	$wp_customize->add_setting( 'daze_show_category', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_show_category', array(
		'label'      => esc_html__( 'Show category', 'daze' ),
		'section'    => 'daze_single_posts',
		'settings'   => 'daze_show_category',
		'type'       => 'checkbox'
	));
	
/* Post date */   	
	$wp_customize->add_setting( 'daze_show_date', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_show_date', array(
		'label'      => esc_html__( 'Show date', 'daze' ),
		'section'    => 'daze_single_posts',
		'settings'   => 'daze_show_date',
		'type'       => 'checkbox'
	));
	
/* Post comments */   	
	$wp_customize->add_setting( 'daze_show_comments', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_show_comments', array(
		'label'      => esc_html__( 'Show comments count', 'daze' ),
		'section'    => 'daze_single_posts',
		'settings'   => 'daze_show_comments',
		'type'       => 'checkbox'
	));
	
/* Post author */   	
	$wp_customize->add_setting( 'daze_show_author_name', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_show_author_name', array(
		'label'      => esc_html__( 'Show author\'s name', 'daze' ),
		'section'    => 'daze_single_posts',
		'settings'   => 'daze_show_author_name',
		'type'       => 'checkbox'
	));
	
	$wp_customize->add_setting( 'daze_author_name_text', array(
		'default'     		=> esc_attr__( 'Posted by', 'daze' ),
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( 'daze_author_name_text', array(
		'label'      	=> esc_html__( 'Text before author\'s name', 'daze' ),
		'input_attrs' 	=> array(
								'placeholder' => esc_attr__( 'Posted by', 'daze' )
							),
		'section'    	=> 'daze_single_posts',
		'settings'   	=> 'daze_author_name_text',
		'type'       	=> 'text'
	));
	
/* Hide featured image */   	
	$wp_customize->add_setting( 'daze_hide_featured_image', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_hide_featured_image', array(
		'label'      => esc_html__( 'Hide featured image', 'daze' ),
		'section'    => 'daze_single_posts',
		'settings'   => 'daze_hide_featured_image',
		'type'       => 'checkbox'
	));
	
/* Drop caps */   	
	$wp_customize->add_setting( 'daze_drop_caps', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_drop_caps', array(
		'label'      => esc_html__( 'Drop caps', 'daze' ),
		'section'    => 'daze_single_posts',
		'settings'   => 'daze_drop_caps',
		'type'       => 'checkbox'
	));
	
/* Enlarge galleries */   	
	$wp_customize->add_setting( 'daze_enlarge_galleries', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_enlarge_galleries', array(
		'label'      => esc_html__( 'Enlarge galleries', 'daze' ),
		'section'    => 'daze_single_posts',
		'settings'   => 'daze_enlarge_galleries',
		'type'       => 'checkbox'
	));
	
/* Enlarge embedded media */   	
	$wp_customize->add_setting( 'daze_enlarge_media', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_enlarge_media', array(
		'label'      => esc_html__( 'Enlarge embedded media', 'daze' ),
		'section'    => 'daze_single_posts',
		'settings'   => 'daze_enlarge_media',
		'type'       => 'checkbox'
	));
	
/* Disable Daze gallery slider */   	
	$wp_customize->add_setting( 'daze_gallery_slider', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_gallery_slider', array(
		'label'			=> esc_html__( 'Disable Daze gallery slider', 'daze' ),
		'description'	=> esc_html__( 'Check this if you want to use the native wp gallery or some custom gallery plugin', 'daze' ),
		'section'		=> 'daze_single_posts',
		'settings'		=> 'daze_gallery_slider',
		'type'   	    => 'checkbox'
	));
	
/* Tagcloud */   	
	$wp_customize->add_setting( 'daze_show_tagcloud', array(
		'default'        	=> true,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_show_tagcloud', array(
		'label'      => esc_html__( 'Show tagcloud in post footer', 'daze' ),
		'section'    => 'daze_single_posts',
		'settings'   => 'daze_show_tagcloud',
		'type'       => 'checkbox'
	));
	
/* Author info */   	
	$wp_customize->add_setting( 'daze_show_author_info', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_show_author_info', array(
		'label'      => esc_html__( 'Show author info under the post', 'daze' ),
		'section'    => 'daze_single_posts',
		'settings'   => 'daze_show_author_info',
		'type'       => 'checkbox'
	));
	
/* Disable WP comments */   	
	$wp_customize->add_setting( 'daze_disable_wp_comments', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_disable_wp_comments', array(
		'label'			=> esc_html__( 'Disable WP comments', 'daze' ),
		'section'		=> 'daze_single_posts',
		'settings'		=> 'daze_disable_wp_comments',
		'type'   	    => 'checkbox'
	));
?>