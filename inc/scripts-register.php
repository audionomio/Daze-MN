<?php
/* ===============================================
	Register of scripts and styles used in theme
	Daze - Premium WordPress Theme, by NordWood
================================================== */
/* Front end
============== */   
// Fonts
	if( !function_exists( 'daze_fonts_url' ) ) :
		function daze_fonts_url() {
			$fonts_url = '';
			
		/* Translators: If there are characters in your language that are not
		* supported by Poppins, translate this to 'off'. Do not translate
		* into your own language.
		*/			
			$poppins = esc_attr_x( 'on', 'Poppins font: on or off', 'daze' );
 
			if ( 'off' !== $poppins ) {
				$fonts_url = add_query_arg(
				array(
					'family'  => rawurlencode( 'Poppins:400,500,600,700,300&subset=latin,latin-ext' ),
					'display' => 'swap',
				),
				'//fonts.googleapis.com/css'
			);
			}
			
			return esc_url_raw( $fonts_url );
		}
	endif;
	
// Scripts and styles
	if ( !function_exists( 'daze_frontend_register' ) ) :
		function daze_frontend_register() {
		// Assets
			wp_register_style(
				'daze_assets_slick_slider',
				get_template_directory_uri() . '/assets/slick/slick.css'
			);
			
			wp_register_script(
				'daze_assets_slick_slider',
				get_template_directory_uri() . '/assets/slick/slick.min.js',
				array('jquery'),
				'',
				true
			);
			
			wp_register_script(
				'daze_assets_images_loaded',
				get_template_directory_uri() . '/assets/images-loaded/imagesloaded.pkgd.min.js',
				array('jquery'),
				'',
				true
			);
			
			wp_register_script(
				'daze_assets_infinite_scroll',
				get_template_directory_uri() . '/assets/infinite-scroll/jquery.infinitescroll.min.js',
				array('jquery'),
				'',
				true
			);
			
			wp_register_script(
				'daze_assets_masonry',
				get_template_directory_uri() . '/assets/masonry/masonry.pkgd.min.js',
				array('jquery'),
				'',
				true
			);
			
		// Main
			wp_register_style( 'daze_main', get_stylesheet_uri() );
			
			wp_register_script(
				'daze_main', get_template_directory_uri() . '/js/main.js',
				array( 'jquery', 'daze_assets_images_loaded' ),
				false,
				true
			);
			
		// Share selected text
			wp_register_script(
				'daze_share_selection', get_template_directory_uri() . '/js/share-selection.js',
				array('jquery'),
				false,
				true
			);
			
		// Posts List
			wp_register_script(
				'daze_infinite_scroll',
				get_template_directory_uri() . '/js/infinite-scroll.js',
				array( 'jquery', 'daze_assets_images_loaded', 'daze_assets_infinite_scroll', 'daze_assets_masonry' ),
				'',
				true
			);
			
			wp_register_script(
				'daze_masonry_layout',
				get_template_directory_uri() . '/js/masonry-layout.js',
				array( 'jquery', 'daze_assets_images_loaded', 'daze_assets_masonry' ),
				'',
				true
			);
			
		// Gallery
			wp_register_style(
				'daze_gallery',
				get_template_directory_uri() . '/css/gallery-slider.css',
				array( 'daze_assets_slick_slider' )
			);
			
			wp_register_script(
				'daze_gallery',
				get_template_directory_uri() . '/js/gallery-slider.js',
				array( 'jquery', 'daze_assets_slick_slider' ),
				'',
				true
			);
			
		// Posts sliders
			wp_register_style(
				'daze_post_slider',
				get_template_directory_uri() . '/css/posts-slider.css',
				array( 'daze_assets_slick_slider' )
			);
			
			wp_register_script(
				'daze_post_slider_columns',
				get_template_directory_uri() . '/js/posts-slider-columns.js',
				array( 'jquery', 'daze_assets_slick_slider' ),
				'',
				true
			);
			
			wp_register_script(
				'daze_post_slider_simple',
				get_template_directory_uri() . '/js/posts-slider-simple.js',
				array( 'jquery','daze_assets_slick_slider' ),
				'',
				true
			);
			
		// Widgets
			wp_register_script(
				'daze_instagram_carousel',
				get_template_directory_uri() . '/admin/widgets/js/instagram-carousel.js',
				array( 'jquery', 'daze_assets_slick_slider' ),
				'',
				true
			);
			
			wp_register_style( 'daze_top_posts', get_template_directory_uri() . '/admin/widgets/css/top-posts-slider.css' );
			
			wp_register_script(
				'daze_top_posts',
				get_template_directory_uri() . '/admin/widgets/js/top-posts-slider.js',
				array( 'jquery', 'daze_assets_slick_slider' ),
				'',
				true
			);
			
			wp_register_style( 'daze_latest_comments', get_template_directory_uri() . '/admin/widgets/css/latest-comments.css' );
			
		// Dynamic styles
			wp_register_style( 'daze_dynamic_styles', get_template_directory_uri() . '/css/dynamic-styles.css' );
			
		// Google maps
			$google_maps_api_key = get_theme_mod( 'daze_google_maps_api_key' );
			wp_register_script(
				'mapAPI',
				'https://maps.googleapis.com/maps/api/js?v=3&key='.$google_maps_api_key,
				array('jquery'),
				null,
				true
			);
			
			wp_register_script(
				'daze_gmap_coords',
				get_template_directory_uri() . '/js/gmap-coords.js',
				array( 'jquery', 'mapAPI' ),
				'',
				true
			);
			
			wp_register_script(
				'daze_gmap_address',
				get_template_directory_uri() . '/js/gmap-addr.js',
				array( 'jquery', 'mapAPI' ),
				'',
				true
			);
			
			wp_enqueue_style( 'daze-fonts', daze_fonts_url(), array(), '1.0.0' );			
			wp_enqueue_style( 'daze_main' );
			wp_enqueue_style( 'daze_dynamic_styles' );
			wp_enqueue_script( 'daze_main' );
			
			if ( is_active_widget( false, false, 'daze_fb_badge', true ) ) {
				wp_enqueue_script(
					'daze_assets_fb_sdk',
					get_template_directory_uri() . '/assets/social/fb-sdk.js',
					null,
					'',
					true
				);
			}
			
			if( is_rtl() ) {
				wp_enqueue_style( 'daze_rtl', get_template_directory_uri() . '/rtl.css' );
			}
			
		// Enable threaded comments
			$comments_available = false;
			
			if( false === get_theme_mod( 'daze_disable_wp_comments', false ) && comments_open( get_the_ID() ) ) {
				$comments_available = true;
			}
			
			if( ( is_single() && $comments_available && get_option( 'thread_comments' ) ) || ( is_page() && get_option( 'thread_comments' ) ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
			
		// Enqueue script for shareable text-selection, if it's enabled via customizer			
			if( get_theme_mod( 'daze_selection_share_on', true ) ) {
				
				$shareselection = array(
					'cloudtext' => get_theme_mod( 'daze_selection_share_text', esc_html__( 'Tweet this', 'daze' ) ),
					'icon_twitter' => daze_get_svg_twitter()
				);
				
				wp_localize_script( 'daze_share_selection', 'shareselection', $shareselection );								
				wp_enqueue_script( 'daze_share_selection' );
			}
			
		// 	Enqueue scripts for posts lists
			if( is_home() || is_archive() || is_search() ) {
				global $wp_query;
				
				$daze_pagination_type = get_theme_mod( 'daze_pagination_type', 'infinite_scroll' );
				$daze_blog_layout_type = get_theme_mod( 'daze_blog_layout_type', 'masonry' );
				
				if( is_tag() && get_theme_mod( 'daze_custom_tag_layout', false ) ) {
					$daze_pagination_type = get_theme_mod( 'daze_tag_pagination_type', 'infinite_scroll' );
					$daze_blog_layout_type = get_theme_mod( 'daze_tag_layout_type', 'tiny' );
					
				} else if( is_date() && get_theme_mod( 'daze_custom_date_layout', false ) ) {
					$daze_pagination_type = get_theme_mod( 'daze_date_pagination_type', 'infinite_scroll' );
					$daze_blog_layout_type = get_theme_mod( 'daze_date_layout_type', 'tiny' );
					
				} else if( is_author() && get_theme_mod( 'daze_custom_author_layout', false ) ) {
					$daze_pagination_type = get_theme_mod( 'daze_author_pagination_type', 'infinite_scroll' );
					$daze_blog_layout_type = get_theme_mod( 'daze_author_layout_type', 'tiny' );
					
				} else if( is_category() && get_theme_mod( 'daze_custom_category_layout', false ) ) {
					$daze_pagination_type = get_theme_mod( 'daze_category_pagination_type', 'infinite_scroll' );
					$daze_blog_layout_type = get_theme_mod( 'daze_category_layout_type', 'tiny' );
					
				} else if( is_search() && get_theme_mod( 'daze_custom_search_layout', false ) ) {
					$daze_pagination_type = get_theme_mod( 'daze_search_pagination_type', 'infinite_scroll' );
					$daze_blog_layout_type = get_theme_mod( 'daze_search_layout_type', 'tiny' );
					
				} else if( is_archive() && get_theme_mod( 'daze_archives_layout_type', false ) ) {
					$daze_pagination_type = get_theme_mod( 'daze_archives_pagination_type', 'infinite_scroll' );
					$daze_blog_layout_type = get_theme_mod( 'daze_archive_layout_type', 'tiny' );

				}

				
				if( 'infinite_scroll' === $daze_pagination_type ) {
					if( is_home() && ( 'masonry' === $daze_blog_layout_type || 'masonry-mini' === $daze_blog_layout_type ) ) {
						if( get_theme_mod( 'daze_inc_latest_comments_box', false ) ) {
							wp_enqueue_style( 'daze_latest_comments' );
						}
								
						if( get_theme_mod( 'daze_inc_top_posts_box', false ) ) {
							wp_enqueue_style( 'daze_top_posts' );
							wp_enqueue_script( 'daze_top_posts' );
						}
					}
					
					if( is_home() ) {
						$home_list_exclude_cat = array();
						$home_list_exclude_cat = explode(',', get_theme_mod('daze_hide_posts_by_cat'));
						$home_list_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$home_list_args = array(
							'post_type' => 'post',
							'post_status' => 'publish',
							'category__not_in' => $home_list_exclude_cat,
							'posts_per_page' => get_option( 'posts_per_page' ),
							'paged' => $home_list_paged,
							'ignore_sticky_posts' => 0
						);

						$home_list_query = new WP_Query( $home_list_args );
						
						$infinite = array(
							'icon_prev' => daze_get_svg_arrow_left(),
							'icon_next' => daze_get_svg_arrow_right(),
							'share_selection' => ( get_theme_mod( 'daze_selection_share_on', true ) === true ? true : false ),
							'blog_layout_type' => $daze_blog_layout_type,
							'max_pages' => $home_list_query->max_num_pages
						);
						wp_localize_script( 'daze_infinite_scroll', 'infinite', $infinite );
						wp_enqueue_script( 'daze_infinite_scroll' );
						
					} else {
						$infinite = array(
							'icon_prev' => daze_get_svg_arrow_left(),
							'icon_next' => daze_get_svg_arrow_right(),
							'share_selection' => ( get_theme_mod( 'daze_selection_share_on', true ) === true ? true : false ),
							'blog_layout_type' => $daze_blog_layout_type,
							'max_pages' => $wp_query->max_num_pages
						);
						wp_localize_script( 'daze_infinite_scroll', 'infinite', $infinite );
						wp_enqueue_script( 'daze_infinite_scroll' );
					}
					
					
					wp_enqueue_style( 'daze_gallery' );
					wp_enqueue_script( 'daze_gallery' );
					
				} else if( ( 'standard-list' != $daze_blog_layout_type ) && 'standard_pagination' === $daze_pagination_type ) {
					wp_enqueue_script( 'daze_masonry_layout' );					
				}
			}
			
		// Enqueue Google Map scripts for contact page
			if( is_page_template( 'page-templates/contact.php' ) ) {				
				$get_pin_id = daze_pages_get_meta( 'daze_contact_gmap_pin_id' );
				
				if( $get_pin_id ) {
					$pin_arr = wp_get_attachment_image_src( $get_pin_id, 'full' );
					$pin = $pin_arr[0];
					
				} else {
					$pin = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
				}
				
				$pin_title = ( $get_pin_title = daze_pages_get_meta( 'daze_contact_gmap_pin_title' ) )
				? $get_pin_title
				: '';
				
				$address = daze_pages_get_meta( 'daze_contact_gmap_addr' );
				$lat = daze_pages_get_meta( 'daze_contact_gmap_lat' );
				$lng = daze_pages_get_meta( 'daze_contact_gmap_lng' );
				
				if( $lat && $lng ) {	
					$args = array(
						'pin' => $pin,
						'title' => $pin_title,
						'lat' => $lat,
						'lng' => $lng
					);
						
					wp_localize_script('daze_gmap_coords', 'mapargs', $args );
					wp_enqueue_script( 'daze_gmap_coords' );
					
				} else if( $address ) {
					$args = array(
						'pin' => $pin,
						'title' => $pin_title,
						'addr' => $address
					);
						
					wp_localize_script( 'daze_gmap_address', 'mapargs', $args );
					wp_enqueue_script( 'daze_gmap_address' );
				}
			}
			
		// Enqueue scripts for posts slider
			if( get_theme_mod( 'daze_nwps_on', false ) && ( is_home() || ( is_page() && 'show-nwps' === daze_pages_get_meta( 'daze_pages_show_nwps', false ) ) ) ) {
				$nwps_args = array(
					'autoplay' => ( get_theme_mod( 'daze_nwps_autoplay', true ) === true ) ? true : false,
					'icon_prev' => daze_get_svg_slider_arrow_left(),
					'icon_next' => daze_get_svg_slider_arrow_right()
				);
				
				wp_enqueue_style( 'daze_post_slider' );
				
				if( get_theme_mod( 'daze_nwps_type', 'columns' ) === 'columns' ) {
					wp_localize_script( 'daze_post_slider_columns', 'nwps_args', $nwps_args );
					wp_enqueue_script( 'daze_post_slider_columns' );
					
				} else {
					wp_localize_script( 'daze_post_slider_simple', 'nwps_args', $nwps_args );
					wp_enqueue_script( 'daze_post_slider_simple' );
				}
			}

			
			

		// Enqueue scripts for post gallery-slider (only on single posts/pages)
		if ( is_singular() ) {
			wp_enqueue_style( 'daze_gallery' );

			$gall_args = array(
				'icon_prev' => daze_get_svg_arrow_left(),
				'icon_next' => daze_get_svg_arrow_right()
			);
			wp_localize_script( 'daze_gallery', 'gall_args', $gall_args );
			wp_enqueue_script( 'daze_gallery' );
		}
		}
	endif;
	add_action( 'wp_enqueue_scripts', 'daze_frontend_register' );

/* BACK END
============= */
	function daze_init_scripts_admin() {		
		wp_register_style( 'daze_metaboxes', get_template_directory_uri() . '/admin/metaboxes/css/metaboxes.css' );
		
		wp_register_script(
			'daze_metaboxes',
			get_template_directory_uri() . '/admin/metaboxes/js/metaboxes.js',
			array('jquery'),
			false,
			true
		);	
		
		wp_register_script(
			'daze_img_upload',
			get_template_directory_uri() . '/admin/js/img-upload.js',
			array('jquery'),
			false,
			true
		);
	}
	
	add_action( 'admin_enqueue_scripts', 'daze_init_scripts_admin' );
	
// Enqueue scripts for particular admin pages
	add_action( 'current_screen', 'daze_admin_screen_scripts' );
	
	if ( ! function_exists( 'daze_admin_screen_scripts' ) ) :
		function daze_admin_screen_scripts() {
			wp_register_script(
				'daze_widgets_screen',
				get_template_directory_uri() . '/admin/widgets/js/widgets-screen.js',
				array('jquery'),
				null,
				true
			);
		
			wp_enqueue_style(
				'daze_welcome_screen',
				get_template_directory_uri() . '/admin/welcome/css/welcome.css'
			);
			
			$screen = get_current_screen();
		
		// "Widgets" screen
			if ( "widgets" === $screen->id ) {
				$spec_desc = sprintf(
					'<h3>%1$s</h3><p>%2$s</p><p>%3$s</p>',
					esc_html__( 'Special widgets', 'daze' ),
					esc_html__( 'The widgets from this field will appear among the posts on blog page with masonry layout. Use the two additional fields to control their positions.', 'daze' ),
					esc_html__( 'Though other widgets may work as well, those signed with &#9733; are marked as being fully compatible and best candidates for this feature.', 'daze' )
				);
				
				$sb_desc = sprintf(
					'<h3>%1$s</h3><p>%2$s</p><p>%3$s</p>',
					esc_html__( 'Sidebar areas', 'daze' ),
					esc_html__( 'Drag the widgets to the sidebars above, in which you want them to appear.', 'daze' ),
					esc_html__( 'Adsense code can be included via \'Custom HTML\' widget.', 'daze' )
				);
				
				$sb_list_title = esc_html__( 'Posts list', 'daze' );
				$sb_list_preview = get_template_directory_uri() . '/admin/widgets/img/list.png';
				
				$sb_single_title = esc_html__( 'Single post/page', 'daze' );
				$sb_single_preview = get_template_directory_uri() . '/admin/widgets/img/single.png';
		
				$areas = array(
					'spec_desc'			=> $spec_desc,
					'sb_desc'			=> $sb_desc,
					'sb_list_title'		=> $sb_list_title,
					'sb_list_preview'	=> $sb_list_preview,
					'sb_single_title'	=> $sb_single_title,
					'sb_single_preview'	=> $sb_single_preview
				);
				
				wp_localize_script( 'daze_widgets_screen', 'areas', $areas );
				
				wp_enqueue_script( 'daze_widgets_screen' );
				
				wp_enqueue_style(
					'daze_widgets_screen',
					get_template_directory_uri() . '/admin/widgets/css/widgets-screen.css'
				);
			}
		}
	endif;
?>