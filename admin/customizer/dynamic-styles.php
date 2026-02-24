<?php
/* ==============================================
	Dynamic styles
	Daze - Premium WordPress Theme, by NordWood
================================================= */
function daze_dynamic_styles() {	
	wp_enqueue_style( 'daze_dynamic_styles' );
	
	$custom_css = "";
	
// Header text color
	if ( ( '#111111' !== $v = get_theme_mod( 'header_textcolor', '#111111' ) ) && $v && '111111' !== $v ) {
		$custom_css .= "
			#site-header .site-logo a,
			#site-header .site-logo h1 {
				color: #{$v};
			}
		";
	}
	
// Frame color
	if ( ( '#ff2955' !== $v = get_theme_mod( 'daze_main_color_frame', '#ff2955' ) ) && $v ) {
		$custom_css .= "
			html,
			.top-bar.mobile .menu-overlay.active {
				border-color: {$v};
			}
		";
	}
	
	if ( ( '#ff2955' !== $v = get_theme_mod( 'daze_main_color_links', '#ff2955' ) ) && $v ) {
		$custom_css .= "
			input[type='submit'],
			a.button-link,
			.top-bar.desktop .top-menu a:hover,
			.top-bar.desktop .top-menu a:active,
			.search-button:hover,
			.search-button:active,
			.popout-content a,
			.current-menu-item > a,
			#site-header nav a:hover,
			#site-header nav a:active,
			.post-category a,
			.masonry-item .cover-item:hover .featured-area:not(:empty) + .post-header .post-category a,
			.no-results,
			.error404 .post-category,
			.post-excerpt a,
			.post-content a,
			.post-content li,
			.page-links a,
			.edit-link a,
			.post-nums a.page-numbers,
			.tagcloud .count,
			.widget.latest-comments a:hover,
			.widget.latest-comments a:active,
			.widget .cat-item .count,
			.widget .rsswidget,
			.copyrights a {
				color: {$v};
			}
	
			.search-button:hover path,
			.search-button:active path {
				fill: {$v};
			}
		";
	}
	
	if ( ( '#ff2955' !== $v = get_theme_mod( 'daze_main_color_other', '#ff2955' ) ) && $v ) {
		$custom_css .= "
			.widget_calendar td#today:after {
				color: {$v};
			}
			
			.masonry-list-wrapper .sticky .sticky-marker,
			.standard-list .sticky .post-title .sticky-marker,
			.popout-holder .popout-close:hover {
				background: {$v};
			}
			
			#main .drop-caps .post-content p:first-child:first-letter {
				border-color: {$v};
			}
		";
	}
	
	$search_button_top = get_theme_mod( 'daze_show_search_in_top', 1 );
	$social_links_top = get_theme_mod( 'daze_social_in_topbar', 1 );
	$show_tagline = get_theme_mod( 'daze_show_tagline', false );
	
	if ( has_nav_menu( 'top' ) || ( get_bloginfo('description') && $show_tagline ) || $search_button_top || $social_links_top ) {
		$custom_css .= "
			.top-bar.desktop {
				border-bottom: 1px solid #e8e8e8;
			}
		";
		
	} else {
		$custom_css .= "
			.top-bar.desktop {
				border-bottom: none;
			}
		";
	}
	
	$v = intval( get_theme_mod( 'daze_frame_width_mobile', 5 ) );
	if ( 5 !== $v ) {
		$custom_css .= "
			.top-bar.mobile .menu-overlay.active,
			html {
				border-width: {$v}px;
			}
		";
	}

	$v = intval( get_theme_mod( 'daze_frame_width_desktop', 7 ) );
	if ( 7 !== $v ) {
		$custom_css .= "
			@media only screen and (min-width:1180px) {
				html {
					border-width: {$v}px !important;
				}
			}
		";
	}
	
	if ( ( 24 !== $v = get_theme_mod( 'daze_site_title_size_mobile', 24 ) ) && $v ) {
		$custom_css .= "
			.top-bar.mobile .site-logo h1 {
			   font-size: {$v}px;
			}
		";
	}
	
	if ( ( 42 !== $v = get_theme_mod( 'daze_site_title_size', 42 ) ) && $v ) {
		$custom_css .= "
			#site-header .site-logo h1 {
			   font-size: {$v}px;
			}
		";
	}
	
// Background patterns
	$anim_bgr = get_theme_mod( 'daze_bgr_pattern' );
	$bgr_pattern_color = get_theme_mod( 'daze_bgr_pattern_color', '#111' );
	
	if ( $anim_bgr ) {
		$anim_bgr_arr = wp_get_attachment_metadata( daze_get_post_id_by_url( $anim_bgr ) );
		$anim_bgr_W = $anim_bgr_arr['width']/2;
		$anim_bgr_H = $anim_bgr_arr['height']/2;
		
		$custom_css .= "
			@keyframes animatedBackground {
				0% { background-position: 0 0; }
				100% { background-position: -{$anim_bgr_W}px {$anim_bgr_H}px; }
			}
			
			.animated-bgr {
				background-image: url('{$anim_bgr}');
				background-position: 0 0;
				animation: animatedBackground 5s linear infinite;
			}
			
			.pattern-bgr {
				background-image: url('{$anim_bgr}');
			}
		";
		
	} else if ( $bgr_pattern_color ) {
		$custom_css .= "
			.pattern-bgr,
			.animated-bgr {
				background-color: {$bgr_pattern_color};
			}
		";
	}	
	
// Text color for background patterns
	
	if ( ( '#ffffff' !== $v = get_theme_mod( 'daze_bgr_pattern_text', '#ffffff' ) ) && $v ) {
		$custom_css .= "
			.animated-bgr.search-form input[type='search'] {
				color: {$v};
			}
		";
	}
		
/* Sticky banner
================== */
	$sticky_banner_h = get_theme_mod( 'daze_sticky_banner_height', 78 );
	
	if ( 1 > $sticky_banner_h ) {
		$sticky_banner_h = 78;
	}	
	
	if ( $sticky_banner_h ) {
		$custom_css .= "
			.sticky-banner img {
				height: {$sticky_banner_h}px;
			}
		";
	}
	
	$sticky_banner_pos = get_theme_mod( 'daze_sticky_banner_position', 'bottom-right' );
	
	if ( 'bottom-right' === $sticky_banner_pos ) {
		$to_top_post = $sticky_banner_h + 20;
		
		$custom_css .= "
			.sticky-banner {
				right: 5px;
				left: auto;
			}
			
			#to-top {
				bottom: {$to_top_post}px;
			}
			
			@media only screen and (min-width:1180px) {
				.sticky-banner {
					right: 7px; left: auto;
				}
			}
		";		
	}
	
	if ( 'bottom-left' === $sticky_banner_pos ) {
		$custom_css .= "
			.sticky-banner {
				left: 5px;
				right: auto;
			}
			
			@media only screen and (min-width:1180px) {
				.sticky-banner {
					left: 7px; right: auto;
				}
			}
		";		
	}
		
/* Page 404
============= */
	if ( '' !== $v = get_theme_mod( 'daze_page_404_bgr' ) ) {
		$custom_css .= "
			.error404 #central-wrapper {
				background-image:url({$v});
			}
		";		
	}
	
// Apply all the styles above and minify dynamic css, if needed
	if ( true === get_theme_mod( 'daze_opt_minify_dynamic_inline_css', false ) ) {
		$dynamic_css = daze_minify_inline_css( $custom_css );
		
	} else {
		$dynamic_css = $custom_css;
	}
	
	wp_add_inline_style( 'daze_dynamic_styles', $dynamic_css );		
}

add_action( 'wp_enqueue_scripts', 'daze_dynamic_styles' );
?>