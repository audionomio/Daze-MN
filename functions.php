<?php
/* =========================
   WP VERSION COMPATIBILITY
   ========================= */
// Daze MN requires WordPress 6.0 or later.
	if ( version_compare( $GLOBALS['wp_version'], '6.0', '<' ) ) {
		require get_template_directory() . '/inc/back-compat.php';
	}

/* TGM PLUGIN ACTIVATION
========================== */   
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Daze for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */  
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'daze_register_required_plugins' );

function daze_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
	/*
		Array of the plugins bundled with a theme. Required keys are name and slug.
		If the source is NOT from the .org repo, then source is also required.
		Guide:
		- 'name' - The plugin name
		- 'slug' - The plugin slug (typically the folder name)
		- 'source' - The plugin source
		- 'required' - If false, the plugin is only 'recommended' instead of required.
		- 'version' - If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
		- 'force_activation' - If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
		- 'force_deactivation' - If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		- 'external_url' - If set, overrides default API URL and points to an external URL.
		- 'is_callable' - If set, this callable will be be checked for availability to determine if a plugin is active.
	*/
		array(
			'name'               => esc_html__( 'Daze Featured Area', 'daze' ),
			'slug'               => 'daze-featured-area',
			'source'             => get_template_directory() . '/plugins/daze-featured-area.zip',
			'required'           => true,
			'version'            => '2.0',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => ''
		),
		
		array(
			'name'               => esc_html__( 'Daze Pop-out pages', 'daze' ),
			'slug'               => 'daze-popout-pages',
			'source'             => get_template_directory() . '/plugins/daze-popout-pages.zip',
			'required'           => false,
			'version'            => '3.1',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => ''
		),
		
		array(
			'name'               => esc_html__( 'Daze Custom Login Page', 'daze' ),
			'slug'               => 'daze-custom-login-page',
			'source'             => get_template_directory() . '/plugins/daze-custom-login-page.zip',
			'required'           => false,
			'version'            => '2.0',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
	);

	/*
		Array of configuration settings.
		Guide:
		- 'id' - Unique ID for hashing notices for multiple instances of TGMPA.
		- 'default_path' - Default absolute path to bundled plugins.
		- 'menu' - Menu slug.
		- 'has_notices' - Show admin notices or not.
		- 'dismissable' - If false, a user cannot dismiss the nag message.
		- 'dismiss_msg' - If 'dismissable' is false, this message will be output at top of nag.
		- 'is_automatic' - Automatically activate plugins after installation or not.
		- 'message' - Message to output right before the plugins table.
	*/
	$config = array(
		'id'           => 'daze',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
	
/* SET MAXIMUM CONTENT WIDTH
============================== */
	if( !isset( $content_width ) ) {
		$content_width = 1140;
	}

/* THEME SETUP
================ */
	if( !function_exists( 'daze_theme_setup' ) ):
		function daze_theme_setup() {
		   
		// Title tag management
			add_theme_support( 'title-tag' );
		   
		// Automatic feed links
			add_theme_support( 'automatic-feed-links' );

		// Post thumbnails
			add_theme_support( 'post-thumbnails' );
			update_option( 'thumbnail_size_w', 60 );
			update_option( 'thumbnail_size_h', 60 );
			update_option( 'thumbnail_crop', 1 );
			add_image_size( 'daze_small', 180, 180, true );
			update_option( 'medium_size_w', 360 );
			update_option( 'medium_large_size_w', 680 );
			update_option( 'large_size_w', 1024 );
			add_image_size( 'daze_wrapper_width', 1140, 9999, false );
			update_option( 'image_default_align', 'none' );
			update_option( 'image_default_link_type', 'none' );
			update_option( 'image_default_size', 'daze_wrapper_width' );

		// Post formats
			add_theme_support( 'post-formats', array(
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			));

		// Navigation menus
			register_nav_menus( array(
				'main' => esc_html__( 'Main Menu', 'daze' ),
				'top'  => esc_html__( 'Top Menu', 'daze' ),
			));

		// HTML5 markup
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			));
			
		// Styles for the editor
			add_editor_style( array( 'editor-style.css', daze_fonts_url() ) );

		// Custom background support
			$bgrargs = array(
				'default-color' => 'f6f6f6'
			);
			add_theme_support( 'custom-background', $bgrargs );

		// Custom header support
			$headerargs = array();
			add_theme_support( 'custom-header', $headerargs );

		// Translations
			load_theme_textdomain( 'daze', get_template_directory() . '/languages' );
		}
	endif;
	
	add_action( 'after_setup_theme', 'daze_theme_setup' );

/* REGISTER SCRIPTS AND STYLES
================================ */
   require_once( get_template_directory() . '/inc/scripts-register.php' );

/* SVG ICONS
============= */ 
   require_once( get_template_directory() . '/inc/svg-icons.php' );

/* FILTERS AND HOOKS
====================== */
   require_once( get_template_directory() . '/inc/filters-and-hooks.php' );

/* HELPERS AND TEMPLATE TAGS
============================== */
   require_once( get_template_directory() . '/inc/template-tags.php' );

/* INSTAGRAM API
================== */
   require_once( get_template_directory() . '/inc/class-daze-instagram-api.php' );
   require_once( get_template_directory() . '/admin/instagram-settings.php' );

/* DEPRECATED FUNCTIONS
============================== */
   require_once( get_template_directory() . '/inc/dep.php' );
   
/* WIDGETS
============ */   
// Register widgets areas
	function daze_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( '1. Main sidebar', 'daze' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Drag in the widgets you want to appear in the main sidebar.', 'daze' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>'
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( '2. Site header', 'daze' ),
			'id'            => 'sidebar-site_header',
			'description'   => esc_html__( 'Drag in the widgets you want to appear above the site header.', 'daze' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>'
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( '3. Top of blog', 'daze' ),
			'id'            => 'sidebar-blog_top',
			'description'   => esc_html__( 'Drag in the widgets you want to appear above the posts list.', 'daze' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>'
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( '4. Footer Instagram area', 'daze' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Drag in the widgets you want to appear above the site footer. (Best for Instagram Carousel)', 'daze' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>'
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( '5. Single post header', 'daze' ),
			'id'            => 'sidebar-single_header',
			'description'   => esc_html__( 'Drag in the widgets you want to appear in the header of single posts.', 'daze' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>'
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( '6. Single post footer', 'daze' ),
			'id'            => 'sidebar-single_footer',
			'description'   => esc_html__( 'Drag in the widgets you want to appear in the footer of single posts.', 'daze' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>'
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( '7. Site footer', 'daze' ),
			'id'            => 'sidebar-site_footer',
			'description'   => esc_html__( 'Drag in the widgets you want to appear at the bottom of site footer.', 'daze' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>'
		) );
		
		register_sidebar( array(
			'name'          => '&#9733; ' . esc_html__( 'Specials', 'daze' ),
			'id'            => 'sidebar-specials',
			'description'   => esc_html__( 'Drag in the widgets you want to appear in masonry list on blog page.', 'daze' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>'
		));
	}
	
	add_action( 'widgets_init', 'daze_widgets_init' );
	
	require get_template_directory() . '/admin/widgets/tagcloud.php';
	require get_template_directory() . '/admin/widgets/image-widget.php';
	require get_template_directory() . '/admin/widgets/author.php';
	require get_template_directory() . '/admin/widgets/facebook-badge.php';
	require get_template_directory() . '/admin/widgets/top-posts.php';
	require get_template_directory() . '/admin/widgets/latest-comments.php';
	require get_template_directory() . '/admin/widgets/instagram-grid.php';
	require get_template_directory() . '/admin/widgets/instagram-carousel.php';
	require get_template_directory() . '/admin/widgets/social.php';
	
	if ( function_exists( 'daze_popout_init' ) ) {
		require get_template_directory() . '/admin/widgets/popout.php';
	}
	
/* CUSTOM FIELDS
================== */	
	require get_template_directory() . '/admin/metaboxes/custom-fields.php';
	
/* CUSTOMIZER
=============== */
	require get_template_directory() . '/admin/customizer/customizer.php';
   
/* USERS
========== */
	require get_template_directory() . '/admin/users/custom-fields.php';
	
/* WELCOME TO DAZE
====================== */
	require get_template_directory() . '/admin/welcome/welcome.php';

/* INSTAGRAM TOKEN AUTO-REFRESH
================================= */
	add_filter( 'cron_schedules', function( $schedules ) {
		$schedules['daze_50_days'] = array(
			'interval' => 50 * DAY_IN_SECONDS,
			'display'  => esc_html__( 'Every 50 days (Instagram token refresh)', 'daze' ),
		);
		return $schedules;
	});

	if ( ! wp_next_scheduled( 'daze_refresh_instagram_token' ) ) {
		wp_schedule_event( time(), 'daze_50_days', 'daze_refresh_instagram_token' );
	}
	add_action( 'daze_refresh_instagram_token', array( 'Daze_Instagram_API', 'refresh_token' ) );
?>