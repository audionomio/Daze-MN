<?php
/* ==============================================
	ARCHIVES, Customizer section
	Daze - Premium WordPress Theme, by NordWood
================================================= */
/*	TAG ARCHIVE
================= */
    $wp_customize->add_setting( 'daze_h_tag_layout', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_tag_layout', array(
		'section'	=> 'daze_archives_layout',
		'label'		=> esc_html__( 'Tag', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_custom_tag_layout', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_custom_tag_layout', array(
		'label'      => esc_html__( 'Customize', 'daze' ),
		'section'    => 'daze_archives_layout',
		'settings'   => 'daze_custom_tag_layout',
		'type'       => 'checkbox'
	));

/* Layout type for tag archive */
	$wp_customize->add_setting(	'daze_tag_layout_type', array(
		'default'			=> 'tiny',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_tag_layout_type', array(
		'label'      		=> esc_html__( 'Layout type', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_tag_layout_type',
		'type'       		=> 'radio',
		'choices'			=> array(
									'masonry'		=> esc_html__( 'Pinterest (masonry) list', 'daze' ),
									'masonry-mini'	=> esc_html__( 'Minimalist (image only) list', 'daze' ),
									'tiny'			=> esc_html__( 'Tiny list', 'daze' ),
									'standard-list' => esc_html__( 'Standard list', 'daze' )
								),
        'active_callback'	=> 'daze_control_tag_layout_type'
	));
	
/* Layout width for tag archive */
	$wp_customize->add_setting( 'daze_tag_layout_width', array(
		'default'        	=> 'narrow',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));	 
	$wp_customize->add_control( 'daze_tag_layout_width', array(
		'label'      		=> esc_html__( 'Layout width', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_tag_layout_width',
		'type'       		=> 'radio',
		'choices'			=> array(
									'full-width'	=> esc_html__( 'Full width grid', 'daze' ),
									'narrow'		=> esc_html__( 'Narrow grid', 'daze' )
								),
        'active_callback'	=> 'daze_control_tag_masonry_list'
	));
	
/* Columns for tag archive */
	$wp_customize->add_setting( 'daze_tag_cols_narrow', array(
		'default'        	=> 'three',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_tag_cols_narrow', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_tag_cols_narrow',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'two' 	=> esc_html__( '2', 'daze' ),
									'three' => esc_html__( '3', 'daze' )
								),
        'active_callback'	=> 'daze_control_tag_cols_narrow'
	));
		
	$wp_customize->add_setting( 'daze_tag_cols_full', array(
		'default'        	=> 'four',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_tag_cols_full', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_tag_cols_full',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'four' => esc_html__( '4', 'daze' ),
									'five' => esc_html__( '5', 'daze' )
								),
        'active_callback'	=> 'daze_control_tag_cols_full'
	));
	
/* Sidebar for tag archive */
	$wp_customize->add_setting( 'daze_tag_include_sidebar', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_tag_include_sidebar', array(
		'label'      		=> esc_html__( 'Include sidebar', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_tag_include_sidebar',
		'type'       		=> 'checkbox',
        'active_callback'	=> 'daze_control_tag_sidebar'
	));
	
/* Pagination for tag archive */
	$wp_customize->add_setting( 'daze_tag_pagination_type', array(
		'default'			=> 'infinite_scroll',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_tag_pagination_type', array(
		'label'      		=> esc_html__( 'Pagination type', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_tag_pagination_type',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'infinite_scroll'		=> esc_html__( 'Infinite scroll', 'daze' ),
									'standard_pagination'	=> esc_html__( 'Standard pagination', 'daze' )
								),
        'active_callback'	=> 'daze_control_tag_layout_type'
	));	

/*	DATE ARCHIVE
================== */
    $wp_customize->add_setting( 'daze_h_date_layout', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_date_layout', array(
		'section'	=> 'daze_archives_layout',
		'label'		=> esc_html__( 'Date', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_custom_date_layout', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_custom_date_layout', array(
		'label'      => esc_html__( 'Customize', 'daze' ),
		'section'    => 'daze_archives_layout',
		'settings'   => 'daze_custom_date_layout',
		'type'       => 'checkbox'
	));

/* Layout type for date archive */
	$wp_customize->add_setting(	'daze_date_layout_type', array(
		'default'			=> 'tiny',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_date_layout_type', array(
		'label'      		=> esc_html__( 'Layout type', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_date_layout_type',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'masonry'		=> esc_html__( 'Pinterest (masonry) list', 'daze' ),
									'masonry-mini'	=> esc_html__( 'Minimalist (image only) list', 'daze' ),
									'tiny'			=> esc_html__( 'Tiny list', 'daze' ),
									'standard-list' => esc_html__( 'Standard list', 'daze' )
								),
        'active_callback'	=> 'daze_control_date_layout_type'
	));
	
/* Layout width for date archive */	
	$wp_customize->add_setting( 'daze_date_layout_width', array(
		'default'        	=> 'narrow',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_date_layout_width', array(
		'label'      		=> esc_html__( 'Layout width', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_date_layout_width',
		'type'       		=> 'radio',
		'choices'			=> array(
									'full-width'	=> esc_html__( 'Full width grid', 'daze' ),
									'narrow'		=> esc_html__( 'Narrow grid', 'daze' )
								),
        'active_callback'	=> 'daze_control_date_masonry_list'
	));
	
/* Columns for date archive */
	$wp_customize->add_setting( 'daze_date_cols_narrow', array(
		'default'        	=> 'three',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_date_cols_narrow', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_date_cols_narrow',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'two' 	=> esc_html__( '2', 'daze' ),
									'three' => esc_html__( '3', 'daze' )
								),
        'active_callback'	=> 'daze_control_date_cols_narrow'
	));
		
	$wp_customize->add_setting( 'daze_date_cols_full', array(
		'default'        	=> 'four',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_date_cols_full', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_date_cols_full',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'four' => esc_html__( '4', 'daze' ),
									'five' => esc_html__( '5', 'daze' )
								),
        'active_callback'	=> 'daze_control_date_cols_full'
	));
	
/* Sidebar for date archive */
	$wp_customize->add_setting( 'daze_date_include_sidebar', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_date_include_sidebar', array(
		'label'      		=> esc_html__( 'Include sidebar', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_date_include_sidebar',
		'type'       		=> 'checkbox',
        'active_callback'	=> 'daze_control_date_sidebar'
	));
	
/* Pagination for date archive */		
	$wp_customize->add_setting( 'daze_date_pagination_type', array(
		'default'			=> 'infinite_scroll',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_date_pagination_type', array(
		'label'      		=> esc_html__( 'Pagination type', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_date_pagination_type',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'infinite_scroll'		=> esc_html__( 'Infinite scroll', 'daze' ),
									'standard_pagination'	=> esc_html__( 'Standard pagination', 'daze' )
								),
        'active_callback'	=> 'daze_control_date_layout_type'
	));

/*	AUTHOR ARCHIVE
==================== */
    $wp_customize->add_setting( 'daze_h_author_layout', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_author_layout', array(
		'section'	=> 'daze_archives_layout',
		'label'		=> esc_html__( 'Author', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_custom_author_layout', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_custom_author_layout', array(
		'label'      => esc_html__( 'Customize', 'daze' ),
		'section'    => 'daze_archives_layout',
		'settings'   => 'daze_custom_author_layout',
		'type'       => 'checkbox'
	));

/* Layout type for author archive */
	$wp_customize->add_setting(	'daze_author_layout_type', array(
		'default'			=> 'tiny',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_author_layout_type', array(
		'label'      		=> esc_html__( 'Layout type', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_author_layout_type',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'masonry'		=> esc_html__( 'Pinterest (masonry) list', 'daze' ),
									'masonry-mini'	=> esc_html__( 'Minimalist (image only) list', 'daze' ),
									'tiny'			=> esc_html__( 'Tiny list', 'daze' ),
									'standard-list' => esc_html__( 'Standard list', 'daze' )
								),
        'active_callback'	=> 'daze_control_author_layout_type'
	));
	
/* Layout width for author archive */	
	$wp_customize->add_setting( 'daze_author_layout_width', array(
		'default'        	=> 'narrow',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_author_layout_width', array(
		'label'      		=> esc_html__( 'Layout width', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_author_layout_width',
		'type'       		=> 'radio',
		'choices'			=> array(
									'full-width'	=> esc_html__( 'Full width grid', 'daze' ),
									'narrow'		=> esc_html__( 'Narrow grid', 'daze' )
								),
        'active_callback'	=> 'daze_control_author_masonry_list'
	));
	
/* Columns for author archive */
	$wp_customize->add_setting( 'daze_author_cols_narrow', array(
		'default'        	=> 'three',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));	 
	$wp_customize->add_control( 'daze_author_cols_narrow', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_author_cols_narrow',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'two' 	=> esc_html__( '2', 'daze' ),
									'three' => esc_html__( '3', 'daze' )
								),
        'active_callback'	=> 'daze_control_author_cols_narrow'
	));
		
	$wp_customize->add_setting( 'daze_author_cols_full', array(
		'default'        	=> 'four',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_author_cols_full', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_author_cols_full',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'four' => esc_html__( '4', 'daze' ),
									'five' => esc_html__( '5', 'daze' )
								),
        'active_callback'	=> 'daze_control_author_cols_full'
	));
	
/* Sidebar for author archive */
	$wp_customize->add_setting( 'daze_author_include_sidebar', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_author_include_sidebar', array(
		'label'      		=> esc_html__( 'Include sidebar', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_author_include_sidebar',
		'type'       		=> 'checkbox',
        'active_callback'	=> 'daze_control_author_sidebar'
	));
	
/* Pagination for author archive */		
	$wp_customize->add_setting( 'daze_author_pagination_type', array(
		'default'			=> 'infinite_scroll',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_author_pagination_type', array(
		'label'      		=> esc_html__( 'Pagination type', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_author_pagination_type',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'infinite_scroll'		=> esc_html__( 'Infinite scroll', 'daze' ),
									'standard_pagination'	=> esc_html__( 'Standard pagination', 'daze' )
								),
        'active_callback'	=> 'daze_control_author_layout_type'
	));

/*	CATEGORY ARCHIVE
====================== */
    $wp_customize->add_setting( 'daze_h_category_layout', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_category_layout', array(
		'section'	=> 'daze_archives_layout',
		'label'		=> esc_html__( 'Category', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_custom_category_layout', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_custom_category_layout', array(
		'label'      => esc_html__( 'Customize', 'daze' ),
		'section'    => 'daze_archives_layout',
		'settings'   => 'daze_custom_category_layout',
		'type'       => 'checkbox'
	));

/* Layout type for category archive */
	$wp_customize->add_setting(	'daze_category_layout_type', array(
		'default'			=> 'tiny',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_category_layout_type', array(
		'label'      		=> esc_html__( 'Layout type', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_category_layout_type',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'masonry'		=> esc_html__( 'Pinterest (masonry) list', 'daze' ),
									'masonry-mini'	=> esc_html__( 'Minimalist (image only) list', 'daze' ),
									'tiny'			=> esc_html__( 'Tiny list', 'daze' ),
									'standard-list' => esc_html__( 'Standard list', 'daze' )
								),
        'active_callback'	=> 'daze_control_category_layout_type'
	));
	
/* Layout width for category archive */	
	$wp_customize->add_setting( 'daze_category_layout_width', array(
		'default'        	=> 'narrow',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));	 
	$wp_customize->add_control( 'daze_category_layout_width', array(
		'label'      		=> esc_html__( 'Layout width', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_category_layout_width',
		'type'       		=> 'radio',
		'choices'			=> array(
									'full-width'	=> esc_html__( 'Full width grid', 'daze' ),
									'narrow'		=> esc_html__( 'Narrow grid', 'daze' )
								),
        'active_callback'	=> 'daze_control_category_masonry_list'
	));
	
/* Columns for category archive */
	$wp_customize->add_setting( 'daze_category_cols_narrow', array(
		'default'        	=> 'three',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_category_cols_narrow', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_category_cols_narrow',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'two' 	=> esc_html__( '2', 'daze' ),
									'three' => esc_html__( '3', 'daze' )
								),
        'active_callback'	=> 'daze_control_category_cols_narrow'
	));
		
	$wp_customize->add_setting( 'daze_category_cols_full', array(
		'default'        	=> 'four',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_category_cols_full', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_category_cols_full',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'four' => esc_html__( '4', 'daze' ),
									'five' => esc_html__( '5', 'daze' )
								),
        'active_callback'	=> 'daze_control_category_cols_full'
	));
	
/* Sidebar for category archive */
	$wp_customize->add_setting( 'daze_category_include_sidebar', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_category_include_sidebar', array(
		'label'      		=> esc_html__( 'Include sidebar', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_category_include_sidebar',
		'type'       		=> 'checkbox',
        'active_callback'	=> 'daze_control_category_sidebar'
	));
	
/* Pagination for category archive */		
	$wp_customize->add_setting( 'daze_category_pagination_type', array(
		'default'			=> 'infinite_scroll',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));	 
	$wp_customize->add_control( 'daze_category_pagination_type', array(
		'label'      		=> esc_html__( 'Pagination type', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_category_pagination_type',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'infinite_scroll'		=> esc_html__( 'Infinite scroll', 'daze' ),
									'standard_pagination'	=> esc_html__( 'Standard pagination', 'daze' )
								),
        'active_callback'	=> 'daze_control_category_layout_type'
	));

/*	SEARCH RESULTS
==================== */
    $wp_customize->add_setting( 'daze_h_search_layout', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_search_layout', array(
		'section'	=> 'daze_archives_layout',
		'label'		=> esc_html__( 'Search', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_custom_search_layout', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_custom_search_layout', array(
		'label'      => esc_html__( 'Customize', 'daze' ),
		'section'    => 'daze_archives_layout',
		'settings'   => 'daze_custom_search_layout',
		'type'       => 'checkbox'
	));

/* Layout type for search results */
	$wp_customize->add_setting(	'daze_search_layout_type', array(
		'default'			=> 'tiny',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_search_layout_type', array(
		'label'      		=> esc_html__( 'Layout type', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_search_layout_type',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'masonry'		=> esc_html__( 'Pinterest (masonry) list', 'daze' ),
									'masonry-mini'	=> esc_html__( 'Minimalist (image only) list', 'daze' ),
									'tiny'			=> esc_html__( 'Tiny list', 'daze' ),
									'standard-list' => esc_html__( 'Standard list', 'daze' )
								),
        'active_callback'	=> 'daze_control_search_layout_type'
	));
	
/* Layout width for search results */	
	$wp_customize->add_setting( 'daze_search_layout_width', array(
		'default'        	=> 'narrow',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_search_layout_width', array(
		'label'      		=> esc_html__( 'Layout width', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_search_layout_width',
		'type'       		=> 'radio',
		'choices'			=> array(
									'full-width'	=> esc_html__('Full width grid', 'daze'),
									'narrow'		=> esc_html__('Narrow grid', 'daze')
								),
        'active_callback'	=> 'daze_control_search_masonry_list'
	));
	
/* Columns for search results */
	$wp_customize->add_setting( 'daze_search_cols_narrow', array(
		'default'        	=> 'three',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_search_cols_narrow', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_search_cols_narrow',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'two' 	=> esc_html__( '2', 'daze' ),
									'three' => esc_html__( '3', 'daze' )
								),
        'active_callback'	=> 'daze_control_search_cols_narrow'
	));
		
	$wp_customize->add_setting( 'daze_search_cols_full', array(
		'default'        	=> 'four',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_search_cols_full', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_search_cols_full',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'four' => esc_html__( '4', 'daze' ),
									'five' => esc_html__( '5', 'daze' )
								),
        'active_callback'	=> 'daze_control_search_cols_full'
	));
	
/* Sidebar for search results */
	$wp_customize->add_setting( 'daze_search_include_sidebar', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_search_include_sidebar', array(
		'label'      		=> esc_html__( 'Include sidebar', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_search_include_sidebar',
		'type'       		=> 'checkbox',
        'active_callback'	=> 'daze_control_search_sidebar'
	));
	
/* Pagination for search results */		
	$wp_customize->add_setting( 'daze_search_pagination_type', array(
		'default'			=> 'infinite_scroll',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_search_pagination_type', array(
		'label'      		=> esc_html__( 'Pagination type', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_search_pagination_type',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'infinite_scroll'		=> esc_html__( 'Infinite scroll', 'daze' ),
									'standard_pagination'	=> esc_html__( 'Standard pagination', 'daze' )
								),
        'active_callback'	=> 'daze_control_search_layout_type'
	));

/*	OTHER ARCHIVES
==================== */
    $wp_customize->add_setting( 'daze_h_archives_layout', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_archives_layout', array(
		'section'	=> 'daze_archives_layout',
		'label'		=> esc_html__( 'Other archives', 'daze' )
	)));
	
	$wp_customize->add_setting( 'daze_custom_archives_layout', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox'
	));
	
	$wp_customize->add_control( 'daze_custom_archives_layout', array(
		'label'      => esc_html__( 'Customize', 'daze' ),
		'section'    => 'daze_archives_layout',
		'settings'   => 'daze_custom_archives_layout',
		'type'       => 'checkbox'
	));

/* Layout type for other archives */
	$wp_customize->add_setting(	'daze_archives_layout_type', array(
		'default'			=> 'tiny',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_archives_layout_type', array(
		'label'      		=> esc_html__( 'Layout type', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_archives_layout_type',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'masonry'		=> esc_html__( 'Pinterest (masonry) list', 'daze' ),
									'masonry-mini'	=> esc_html__( 'Minimalist (image only) list', 'daze' ),
									'tiny'			=> esc_html__( 'Tiny list', 'daze' ),
									'standard-list' => esc_html__( 'Standard list', 'daze' )
								),
        'active_callback'	=> 'daze_control_archives_layout_type'
	));
	
/* Layout width for other archives */	
	$wp_customize->add_setting( 'daze_archives_layout_width', array(
		'default'        	=> 'narrow',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_archives_layout_width', array(
		'label'      		=> esc_html__( 'Layout width', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_archives_layout_width',
		'type'       		=> 'radio',
		'choices'			=> array(
									'full-width'	=> esc_html__( 'Full width grid', 'daze' ),
									'narrow'		=> esc_html__( 'Narrow grid', 'daze' )
								),
        'active_callback'	=> 'daze_control_archives_masonry_list'
	));
	
/* Columns for other archives */
	$wp_customize->add_setting( 'daze_archives_cols_narrow', array(
		'default'        	=> 'three',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_archives_cols_narrow', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_archives_cols_narrow',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'two' 	=> esc_html__( '2', 'daze' ),
									'three' => esc_html__( '3', 'daze' )
								),
        'active_callback'	=> 'daze_control_archives_cols_narrow'
	));	
		
	$wp_customize->add_setting( 'daze_archives_cols_full', array(
		'default'        	=> 'four',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_archives_cols_full', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_archives_cols_full',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'four' => esc_html__( '4', 'daze' ),
									'five' => esc_html__( '5', 'daze' )
								),
        'active_callback'	=> 'daze_control_archives_cols_full'
	));
	
/* Sidebar for other archives */
	$wp_customize->add_setting( 'daze_archives_include_sidebar', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_archives_include_sidebar', array(
		'label'      		=> esc_html__( 'Include sidebar', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_archives_include_sidebar',
		'type'       		=> 'checkbox',
        'active_callback'	=> 'daze_control_archives_sidebar'
	));
	
/* Pagination for other archives */		
	$wp_customize->add_setting( 'daze_archives_pagination_type', array(
		'default'			=> 'infinite_scroll',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_archives_pagination_type', array(
		'label'      		=> esc_html__( 'Pagination type', 'daze' ),
		'section'    		=> 'daze_archives_layout',
		'settings'   		=> 'daze_archives_pagination_type',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'infinite_scroll'		=> esc_html__( 'Infinite scroll', 'daze' ),
									'standard_pagination'	=> esc_html__( 'Standard pagination', 'daze' )
								),
        'active_callback'	=> 'daze_control_archives_layout_type'
	));
?>