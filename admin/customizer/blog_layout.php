<?php
/* =============================================
	BLOG LAYOUT, Customizer section
	Daze - Premium WordPress Theme, by NordWood
================================================ */
/* Blog layout type */
	$wp_customize->add_setting(	'daze_blog_layout_type', array(
		'default'			=> 'masonry',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_blog_layout_type', array(
		'label'      => esc_html__( 'Layout type', 'daze' ),
		'section'    => 'daze_blog_layout',
		'settings'   => 'daze_blog_layout_type',
		'type'       => 'radio',
		'choices'    => array(
							'masonry'		=> esc_html__( 'Pinterest (Masonry) list', 'daze' ),
							'masonry-mini'	=> esc_html__( 'Minimalist (image only) list', 'daze' ),
							'standard-list' => esc_html__( 'Standard list', 'daze' )
						)
	));	
	
/* Post length (standard list only) */
	$wp_customize->add_setting( 'daze_post_length', array(
		'default'        	=> 'post-excerpts',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_post_length', array(
		'label'      		=> esc_html__( 'Post length', 'daze' ),
		'section'    		=> 'daze_blog_layout',
		'settings'   		=> 'daze_post_length',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'post-excerpts' => esc_html__( 'Excerpts', 'daze' ),
									'full-posts' 	=> esc_html__( 'Full posts', 'daze' )
								),
        'active_callback' 	=> 'daze_control_standard_list'
	));
	
/* Layout width (masonry only) */	
	$wp_customize->add_setting( 'daze_blog_layout_width', array(
		'default'        	=> 'narrow',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_blog_layout_width', array(
		'label'      		=> esc_html__( 'Layout width', 'daze' ),
		'section'    		=> 'daze_blog_layout',
		'settings'   		=> 'daze_blog_layout_width',
		'type'       		=> 'radio',
		'choices'			=> array(
									'full-width'	=> esc_html__('Full width grid', 'daze'),
									'narrow'		=> esc_html__('Narrow grid', 'daze')
								),
        'active_callback'	=> 'daze_control_masonry_list'
	));
	
/* Columns (masonry only) */
	$wp_customize->add_setting( 'daze_blog_cols_narrow', array(
		'default'        	=> 'three',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_blog_cols_narrow', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_blog_layout',
		'settings'   		=> 'daze_blog_cols_narrow',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'two' 	=> esc_html__( '2', 'daze' ),
									'three' => esc_html__( '3', 'daze' )
								),
        'active_callback'	=> 'daze_control_blog_cols_narrow'
	));	
		
	$wp_customize->add_setting( 'daze_blog_cols_full', array(
		'default'        	=> 'four',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_blog_cols_full', array(
		'label'      		=> esc_html__( 'Number of columns', 'daze' ),
		'section'    		=> 'daze_blog_layout',
		'settings'   		=> 'daze_blog_cols_full',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'four' => esc_html__( '4', 'daze' ),
									'five' => esc_html__( '5', 'daze' )
								),
        'active_callback'	=> 'daze_control_cols_full'
	));
	
/* Sidebar */
	$wp_customize->add_setting( 'daze_include_sidebar', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_include_sidebar', array(
		'label'      		=> esc_html__( 'Include sidebar', 'daze' ),
		'section'    		=> 'daze_blog_layout',
		'settings'   		=> 'daze_include_sidebar',
		'type'       		=> 'checkbox',
        'active_callback'	=> 'daze_control_sidebar'
	));
	
/* First post */	
	$wp_customize->add_setting( 'daze_first_post', array(
		'default'			=> 'nothing',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_first_post', array(
		'label'      		=> esc_html__( 'Latest post', 'daze' ),
		'section'    		=> 'daze_blog_layout',
		'settings'   		=> 'daze_first_post',
		'type'       		=> 'radio',
		'choices'    		=> array(
									'enlarge_plus_full'		=> esc_html__( 'Enlarge and show full post', 'daze' ),
									'enlarge_plus_excerpt'	=> esc_html__( 'Enlarge and show excerpt', 'daze' ),
									'nothing'				=> esc_html__( 'Do nothing', 'daze' )
								),
        'active_callback'	=> 'daze_control_first_post'
	));
	
/* Pagination */		
	$wp_customize->add_setting( 'daze_pagination_type', array(
		'default'			=> 'infinite_scroll',
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_choices'
	));
	
	$wp_customize->add_control( 'daze_pagination_type', array(
		'label'      => esc_html__( 'Pagination type', 'daze' ),
		'section'    => 'daze_blog_layout',
		'settings'   => 'daze_pagination_type',
		'type'       => 'radio',
		'choices'    => array(
							'infinite_scroll'		=> esc_html__( 'Infinite scroll', 'daze' ),
							'standard_pagination'	=> esc_html__( 'Standard pagination', 'daze' )
						)
	));
	
/* Exclude posts by category */	
	$wp_customize->add_setting( 'daze_hide_posts_by_cat', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( 'daze_hide_posts_by_cat', array(
		'label'      	=> esc_html__( 'Exclude posts by category', 'daze' ),
		'description'  	=> esc_html__( 'Use category ID. For multiple categories, separate ids with comma', 'daze' ),
		'section'    	=> 'daze_blog_layout',
		'settings'   	=> 'daze_hide_posts_by_cat',
		'type'       	=> 'text'
	));
	
/* Read more button */
	$wp_customize->add_setting( 'daze_hide_readmore', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_hide_readmore', array(
		'label'		=> esc_html__( 'Hide Read More button', 'daze' ),
		'section'	=> 'daze_blog_layout',
		'settings'	=> 'daze_hide_readmore',
		'type'		=> 'checkbox'
	));
	
/* Post excerpt length */
	$wp_customize->add_setting( 'daze_excerpt_length', array(
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'default'           => esc_attr__( '55', 'daze' ),
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( 'daze_excerpt_length', array(
		'label'			=> esc_html__( 'Auto excerpt word count:', 'daze' ),
		'description'	=> esc_html__( 'Applied when Excerpt field is empty and no "more" tag is used.', 'daze' ),
		'input_attrs'	=> array(
								'placeholder' => esc_attr__( '55', 'daze' )
							),
		'section'		=> 'daze_blog_layout',
		'settings'		=> 'daze_excerpt_length',
		'type'			=> 'number'
	));
	
/* Animations & effects */	
    $wp_customize->add_setting( 'daze_h_blog_animation', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new Daze_Customizer_Section_Block( $wp_customize, 'daze_h_blog_animation', array(
		'section'		=> 'daze_blog_layout',
		'label'			=> esc_html__( 'Animations and effects', 'daze' ),
		'description'	=> esc_html__( 'Check the option below if you want to turn off the \'dropping\' animation on masonry items and remove delay between their loads. This applies to all blog pages (including search and archives), if masonry is chosen as layout type.', 'daze' )
	)));
	
/* Animated background */
	$wp_customize->add_setting( 'daze_masonry_anim_off', array(
		'default'        	=> false,
		'capability'     	=> 'edit_theme_options',
		'type'           	=> 'theme_mod',
		'sanitize_callback' => 'daze_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'daze_masonry_anim_off', array(
		'label'		=> esc_html__( 'Turn off animation and delay', 'daze' ),
		'section'	=> 'daze_blog_layout',
		'settings'	=> 'daze_masonry_anim_off',
		'type'		=> 'checkbox'
	));
?>