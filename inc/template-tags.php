<?php
/* ==============================================
	TEMPLATE TAGS AND HELPER FUNCTIONS
	Daze - Premium WordPress Theme, by NordWood
================================================= */
/*
	TABLE OF CONTENTS
	
	0.0 HELPER FUNCTIONS
	0.1 Get part of string between two given terms
	0.2 Get the post ID from its URL
	0.3 Convert HEX color value to RGBA
	
	1.0 GET SETTINGS AND CLASSES FOR PARTICULAR ITEMS
	1.1 Classes for site header
	1.2 Classes for #main wrapper
	1.3 Classes for posts list
	1.4 Classes for image holder in posts slider
	
	2.0 PAGINATION
	2.1 Pagination display
	2.2 Posts loading animation
	
	3.0 IMAGE RELATED FUNCTIONS
	3.1 Display attachment image by image url
	3.2 Display giffy attachment image by image url
	3.3 Display giffy attachment image by image id
	3.4 Display giffy featured image by post id
	3.5 Get giffy featured image URL by post ID
	3.6 Get giffy attachment image URL by attachment ID
	
	4.0 SITE LOGO
	4.1 Display site logo (desktop)
	4.2 Display site logo (mobile)
	
	5.0 SEARCH RELATED FUNCTIONS
	5.1 Search button display
	5.2 Highlight searched term
	
	6.0 CATEGORY RELATED FUNCTIONS
	6.1 Check if the post has a category (excluding 'Uncategorized')
	6.2 List categories assigned to a post
	
	7.0 POST RELATED FUNCTIONS
	7.1 Post views
	7.2.1 Edit post
	7.2.2 Edit page
	7.3 Customize comment output
	7.4 Post format icon
	
	8.0 POSTS SLIDER
	8.1 Render posts slider - simple
	8.2 Render posts slider - columns
	
	9.0 SOCIAL NETWORKS RELATED FUNCTIONS
	9.1 Share buttons
	9.2 Get social profiles (deprecated, since Daze 2.2)
	9.2.1 Get saved profiles from Daze 2.1 version and below
	9.3 Get links to social profiles
	
	10.0 SPECIAL BOXES & SPECIAL WIDGETS
	10.1 Special widgets order
	10.2 Output all special widgets
	10.3 Output single widget, by its sidebar
	10.4.1 Output Image Banner 1 special box
	10.4.2 Output Image Banner 2 special box
	10.4.3 Output Image Banner 3 special box
	10.4.4 Output Image Banner 4 special box
	10.4.5 Output Image Banner 5 special box
	10.4.6 Output Social special box
	10.4.7 Output Popular/Latest special box
	10.4.8 Output Latest Comments special box
*/
/* 0.0 HELPER FUNCTIONS
========================= */
/* 0.1 Get part of string between two given terms */
	if( !function_exists( 'daze_get_string_selection' ) ) :
		function daze_get_string_selection( $str, $start, $stop ) {
			$selection = array();
			$start_length = strlen( $start );
			$stop_length = strlen( $stop );
			$start_pos = $selection_start = $selection_stop = 0;

			while( false !== ( $selection_start = strpos( $str, $start, $start_pos ) ) ) {
				$selection_start += $start_length;
				$selection_stop = strpos( $str, $stop, $selection_start );
				
				if( false === $selection_stop ) {
					break;
				}
				
				$selection[] = substr( $str, $selection_start, $selection_stop - $selection_start );
				$start_pos = $selection_stop + $stop_length;
			}

			return $selection;
		}
	endif;
	
/* 0.2 Get the post ID from its URL */
	if( !function_exists( 'daze_get_post_id_by_url' ) ) :
		function daze_get_post_id_by_url( $image_url ) {
			global $wpdb;
			$attachment = $wpdb->get_col(
				$wpdb->prepare(
					"SELECT ID FROM $wpdb->posts WHERE guid='%s';",
					esc_url_raw( $image_url )
				)
			);
			
			return $attachment[0];
		}
	endif;
	
//	0.3 Convert HEX color value to RGBA
	if ( ! function_exists( 'daze_hex2rgba' ) ) :
		function daze_hex2rgba( $color, $alpha = 1 ) {
			$c = trim( $color, '#' );
			$rgba_arr = array();

			if ( strlen( $c ) === 3 ) {
				$r = hexdec( substr( $c, 0, 1 ).substr( $c, 0, 1 ) );
				$g = hexdec( substr( $c, 1, 1 ).substr( $c, 1, 1 ) );
				$b = hexdec( substr( $c, 2, 1 ).substr( $c, 2, 1 ) );
				
			} else if ( strlen( $c ) === 6 ) {
				$r = hexdec( substr( $c, 0, 2 ) );
				$g = hexdec( substr( $c, 2, 2 ) );
				$b = hexdec( substr( $c, 4, 2 ) );				
			}

			$rgba_arr = array( 'red' => $r, 'green' => $g, 'blue' => $b, 'alpha' => $alpha );
			
			$rgba = vsprintf(
				'rgba(%1$s, %2$s, %3$s, %4$f )',
				$rgba_arr
			);
			
			return $rgba;
		}
	endif;

/* 1.0 GET SETTINGS AND CLASSES FOR PARTICULAR ITEMS
====================================================== */
/* 1.1 Classes for site header */
	if( !function_exists( 'daze_get_site_header_class' ) ) :
		function daze_get_site_header_class( $class = '' ) {
			$classes = array();
			
			$logo_pos = get_theme_mod( 'daze_logo_position', 'logo-above-menu' );
			
			$classes[] = sanitize_html_class( $logo_pos );
		 
			if( !empty( $class ) ) {
				if( !is_array( $class ) )
					$class = preg_split( '#\s+#', $class );
				$classes = array_merge( $classes, $class );
				
			} else {
				$class = array();
			}
		 
			$classes = array_map( 'esc_attr', $classes );
			
			$classes = apply_filters( 'daze_site_header_class', $classes, $class );
		 
			return array_unique( $classes );
		}
	endif;
	
	if( !function_exists( 'daze_site_header_class' ) ) :
		function daze_site_header_class( $class = '' ) {
			echo 'class="' . join( ' ', daze_get_site_header_class( $class ) ) . '"';
		}
	endif;
	
/* 1.2 Classes for #main wrapper */
	if( !function_exists( 'daze_get_main_class' ) ) :
		function daze_get_main_class( $class = '' ) {
			$classes = array();
			
			$classes[] = 'clearfix';
			
			if( is_home() || is_archive() || is_search() ) {
				$layout_type = get_theme_mod( 'daze_blog_layout_type', 'masonry' );
				$layout_width = get_theme_mod( 'daze_blog_layout_width', 'narrow' );
				$sidebar = get_theme_mod( 'daze_include_sidebar', false );
				$pagination_type = get_theme_mod( 'daze_pagination_type', 'infinite_scroll' );
				
				if( is_tag() && get_theme_mod( 'daze_custom_tag_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_tag_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_tag_layout_width', 'narrow' );
					$sidebar = get_theme_mod( 'daze_tag_include_sidebar', false );
					$pagination_type = get_theme_mod( 'daze_tag_pagination_type', 'infinite_scroll' );
					
				} else if( is_date() && get_theme_mod( 'daze_custom_date_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_date_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_date_layout_width', 'narrow' );
					$sidebar = get_theme_mod( 'daze_date_include_sidebar', false );
					$pagination_type = get_theme_mod( 'daze_date_pagination_type', 'infinite_scroll' );
					
				} else if( is_author() && get_theme_mod( 'daze_custom_author_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_author_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_author_layout_width', 'narrow' );
					$sidebar = get_theme_mod( 'daze_author_include_sidebar', false );
					$pagination_type = get_theme_mod( 'daze_author_pagination_type', 'infinite_scroll' );
					
				} else if( is_category() && get_theme_mod( 'daze_custom_category_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_category_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_category_layout_width', 'narrow' );
					$sidebar = get_theme_mod( 'daze_category_include_sidebar', false );
					$pagination_type = get_theme_mod( 'daze_category_pagination_type', 'infinite_scroll' );
					
				} else if( is_search() && get_theme_mod( 'daze_custom_search_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_search_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_search_layout_width', 'narrow' );
					$sidebar = get_theme_mod( 'daze_search_include_sidebar', false );
					$pagination_type = get_theme_mod( 'daze_search_pagination_type', 'infinite_scroll' );
					
				} else if( is_archive() && get_theme_mod( 'daze_custom_archives_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_archives_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_archives_layout_width', 'narrow' );
					$sidebar = get_theme_mod( 'daze_archives_include_sidebar', false );
					$pagination_type = get_theme_mod( 'daze_archives_pagination_type', 'infinite_scroll' );
				}
				
				
				if(
					!( 'standard-list' != $layout_type && 'full-width' === $layout_width ) &&
					( true === $sidebar )
				) {
					$classes[] = 'include-sidebar';
				}
				
				$classes[] = ( 'infinite_scroll' === $pagination_type ) ? 'infinite-scroll' : 'standard-pagination' ;
			}
			
			if(
				( is_single() && (
					( 'include-sidebar' === get_theme_mod('daze_include_sidebar_on_posts') && !( daze_posts_get_meta( 'daze_ignore_global' ) ) ) ||
					( daze_get_meta( 'daze_include_sidebar' ) && daze_posts_get_meta( 'daze_ignore_global' ) )
				) )
				|| is_page() && daze_get_meta( 'daze_include_sidebar' )
			) {
				$classes[] = 'include-sidebar';
			}
		 
			if ( ! empty( $class ) ) {
				if ( !is_array( $class ) )
					$class = preg_split( '#\s+#', $class );
				$classes = array_merge( $classes, $class );
				
			} else {
				$class = array();
			}
		 
			$classes = array_map( 'esc_attr', $classes );
			
			$classes = apply_filters( 'daze_main_class', $classes, $class );
		 
			return array_unique( $classes );
		}
	endif;
	
	if( !function_exists( 'daze_main_class' ) ) :
		function daze_main_class( $class = '' ) {
			echo 'class="' . join( ' ', daze_get_main_class( $class ) ) . '"';
		}
	endif;
	
/* 1.3 Classes for posts list */
	if( !function_exists( 'daze_get_layout_class' ) ) :
		function daze_get_layout_class( $class = '' ) {
			$classes = array();
			
			$classes[] = 'clearfix';
			
			if( is_home() || is_archive() || is_search() ) {
				$layout_type = get_theme_mod( 'daze_blog_layout_type', 'masonry' );
				$layout_width = get_theme_mod( 'daze_blog_layout_width', 'narrow' );
				$cols_full = get_theme_mod( 'daze_blog_cols_full', 'four' );
				$cols_narrow = get_theme_mod( 'daze_blog_cols_narrow', 'three' );
				$sidebar = get_theme_mod( 'daze_include_sidebar', false );
				$hide_readmore = get_theme_mod( 'daze_hide_readmore', false );
				
				if( is_tag() && get_theme_mod( 'daze_custom_tag_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_tag_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_tag_layout_width', 'narrow' );
					$cols_full = get_theme_mod( 'daze_tag_cols_full', 'four' );
					$cols_narrow = get_theme_mod( 'daze_tag_cols_narrow', 'three' );
					$sidebar = get_theme_mod( 'daze_tag_include_sidebar', false );
					
				} else if( is_date() && get_theme_mod( 'daze_custom_date_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_date_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_date_layout_width', 'narrow' );
					$cols_full = get_theme_mod( 'daze_date_cols_full', 'four' );
					$cols_narrow = get_theme_mod( 'daze_date_cols_narrow', 'three' );
					$sidebar = get_theme_mod( 'daze_date_include_sidebar', false );
					
				} else if( is_author() && get_theme_mod( 'daze_custom_author_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_author_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_author_layout_width', 'narrow' );
					$cols_full = get_theme_mod( 'daze_author_cols_full', 'four' );
					$cols_narrow = get_theme_mod( 'daze_author_cols_narrow', 'three' );
					$sidebar = get_theme_mod( 'daze_author_include_sidebar', false );
					
				} else if( is_category() && get_theme_mod( 'daze_custom_category_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_category_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_category_layout_width', 'narrow' );
					$cols_full = get_theme_mod( 'daze_category_cols_full', 'four' );
					$cols_narrow = get_theme_mod( 'daze_category_cols_narrow', 'three' );
					$sidebar = get_theme_mod( 'daze_category_include_sidebar', false );
					
				} else if( is_search() && get_theme_mod( 'daze_custom_search_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_search_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_search_layout_width', 'narrow' );
					$cols_full = get_theme_mod( 'daze_search_cols_full', 'four' );
					$cols_narrow = get_theme_mod( 'daze_search_cols_narrow', 'three' );
					$sidebar = get_theme_mod( 'daze_search_include_sidebar', false );
					
				} else if( is_archive() && get_theme_mod( 'daze_custom_archives_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_archives_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_archives_layout_width', 'narrow' );
					$cols_full = get_theme_mod( 'daze_archives_cols_full', 'four' );
					$cols_narrow = get_theme_mod( 'daze_archives_cols_narrow', 'three' );
					$sidebar = get_theme_mod( 'daze_archives_include_sidebar', false );	
				}
				
				
				if( 'standard-list' != $layout_type ) {
					$classes[] = 'masonry';
					$classes[] = 'masonry-list-wrapper';
					
					if( 'masonry-mini' === $layout_type ) {
						$classes[] = 'masonry-mini';
					}
					
					if( 'tiny' === $layout_type ) {
						$classes[] = 'tiny';
					}
					
					if( 'full-width' === $layout_width ) {
						$classes[] = sanitize_html_class( $cols_full ) . '-columns';
						
					} else {						
						$classes[] = ( $sidebar )
									? 'two-columns'
									: sanitize_html_class( $cols_narrow ) . '-columns';
					}
					
					if( true === get_theme_mod( 'daze_masonry_anim_off', false ) ) {
						$classes[] = 'no-anim-bgr';
					}
					
				} else {
					$classes[] = 'standard-list';
					
					if( true === $hide_readmore ) {
						$classes[] = 'hide-readmore';
					}
				}
			}
		 
			if ( ! empty( $class ) ) {
				if ( !is_array( $class ) )
					$class = preg_split( '#\s+#', $class );
				$classes = array_merge( $classes, $class );
			} else {
				$class = array();
			}
		 
			$classes = array_map( 'esc_attr', $classes );
			
			$classes = apply_filters( 'daze_layout_class', $classes, $class );
		 
			return array_unique( $classes );
		}
	endif;
	
	if( !function_exists( 'daze_layout_class' ) ) :
		function daze_layout_class( $class = '' ) {
			echo 'class="' . join( ' ', daze_get_layout_class( $class ) ) . '"';
		}
	endif;
	
/* 1.4 Classes for image holder in posts slider */
	if( !function_exists( 'daze_get_nwps_bgr_class' ) ) :
		function daze_get_nwps_bgr_class( $class = '' ) {
			$classes = array();
			
			if ( has_post_thumbnail( get_the_ID() ) || daze_posts_get_meta( 'daze_posts_nwps_image_id', get_the_ID() ) ) {		
				$classes[] = 'has-bgr-img';
				
			} else {
				$classes[] = 'animated-bgr';
			}			
			
			$slider_type = get_theme_mod( 'daze_nwps_type', 'columns' );
		
			
			if( 'simple' === $slider_type ) {
				$classes[] = 'inner-wrapper';
				
			} else if( 'columns' === $slider_type ) {
				$classes[] = 'nwps-img';
				
			}
		 
			if ( ! empty( $class ) ) {
				if ( !is_array( $class ) )
					$class = preg_split( '#\s+#', $class );
				$classes = array_merge( $classes, $class );
				
			} else {
				$class = array();
			}
		 
			$classes = array_map( 'esc_attr', $classes );
			
			$classes = apply_filters( 'daze_nwps_bgr_class', $classes, $class );
		 
			return array_unique( $classes );
		}
	endif;
	
	if( !function_exists( 'daze_nwps_bgr_class' ) ) :
		function daze_nwps_bgr_class( $class = '' ) {
			echo 'class="' . join( ' ', daze_get_nwps_bgr_class( $class ) ) . '"';
		}
	endif;
	
/* 2.0 PAGINATION
=================== */
/* 2.1 Pagination display */
	if( !function_exists( 'daze_posts_pagination' ) ) :
		function daze_posts_pagination( $numpages = '', $pagerange = '', $paged='' ) {
			if( empty( $pagerange ) ) {
				$pagerange = 2;
			}
			
			global $paged;			
			
			if( empty($paged) ) {
				$paged = 1;
			}
			
			if( '' == $numpages ) {
				global $wp_query;
				
				$numpages = intval( $wp_query->max_num_pages );
				
				if( !$numpages ) {
					$numpages = 1;
				}
			}
			
			$add_args = false;
			
			if( get_option( 'permalink_structure' ) ) {
				$format = 'page/%#%/';
				
				if( is_search() ) {
					$base = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ).$format, 'paged' );
					$add_args = array( 's' => get_query_var( 's' ) );
					
				} else {
					$base = get_pagenum_link(1) . $format;
				}
				
			} else {
				$format = '?paged=%#%';
				$base = '%_%';
			}
			
			$pagination_args = array(
				'base'            => $base,
				'format'          => $format,
				'total'           => $numpages,
				'current'		  => max( 1, get_query_var( 'paged' ) ),
				'end_size'        => 1,
				'mid_size'        => $pagerange,
				'prev_next'       => false,
				'type'            => 'list',
				'add_args'        => $add_args,
				'prev_text'       => '&laquo;',
				'next_text'       => '&raquo;'
			);
			
			$paginate_links = paginate_links( $pagination_args );

			if ( $paginate_links ) :
		?>
			<div class="results-pagination clearfix">
				<?php
					if( get_previous_posts_link() ) {
						is_rtl()
						? previous_posts_link( '<div class="prev">' . daze_get_svg_arrow_right() . esc_html__( 'Previous', 'daze') . '</div>' )
						: previous_posts_link( '<div class="prev">' . daze_get_svg_arrow_left() . esc_html__( 'Previous', 'daze') . '</div>' );
						
					} else {
						if( is_rtl() ) {
						?>
						<div class="prev inactive"><?php echo daze_get_svg_arrow_right() . esc_html__( 'Previous', 'daze'); ?></div>
						
						<?php
						} else {
						?>
						<div class="prev inactive"><?php echo daze_get_svg_arrow_left() . esc_html__( 'Previous', 'daze'); ?></div>
						<?php
						}
					}
					
					if( get_next_posts_link() ) {
						is_rtl()
						? next_posts_link( '<div class="next">' . esc_html__( 'Next', 'daze') . daze_get_svg_arrow_left() . '</div>', $numpages )
						: next_posts_link( '<div class="next">' . esc_html__( 'Next', 'daze') . daze_get_svg_arrow_right() . '</div>', $numpages );
						
					} else {
						if( is_rtl() ) {
						?>
						<div class="next inactive"><?php echo esc_html__( 'Next', 'daze') . daze_get_svg_arrow_left(); ?></div>
						
						<?php
						} else {
						?>
						<div class="next inactive"><?php echo esc_html__( 'Next', 'daze') . daze_get_svg_arrow_right(); ?></div>
						<?php
						}
					}	
				?>				
				<div class="post-nums"><?php
					echo paginate_links( $pagination_args );
				?></div>	
			</div>
			<?php
			endif;
		}
	endif;
	
/* 2.2 Posts loading animation */
	if( !function_exists( 'daze_posts_loading_animation' ) ) :
		function daze_posts_loading_animation() {
			$loader = '<div class="loading"><div class="loader"><div class="circle colored"></div><div class="circle transparent"></div></div></div>';
			return $loader;
		}
	endif;
	
/* 3.0 IMAGE RELATED FUNCTIONS
================================ */
/* 3.1 Display attachment image by image url */
	if( !function_exists( 'daze_get_img_by_url' ) ) :
		function daze_get_img_by_url( $image_url, $size='daze_wrapper_width' ) {
			return wp_get_attachment_image( daze_get_post_id_by_url( $image_url ), $size );
		}
	endif;
	
/* 3.2 Display giffy attachment image by image url */
	if( !function_exists( 'daze_get_giffy_img_by_url' ) ) :
		function daze_get_giffy_img_by_url( $image_url, $size = 'daze_wrapper_width' ) {
			$size = ( "image/gif" === get_post_mime_type( daze_get_post_id_by_url( $image_url ) ) ) ? 'full' : $size;
			
			return wp_get_attachment_image( daze_get_post_id_by_url( $image_url ), $size );
		}
	endif;
	  
/* 3.3 Display giffy attachment image by image id */
	if( !function_exists( 'daze_giffy_attachment' ) ) :
		function daze_giffy_attachment( $image_id, $img_size='daze_wrapper_width' ) {
			$size = ( get_post_mime_type( absint( $image_id ) ) == "image/gif" ) ? 'full' : $img_size;
			
			return wp_get_attachment_image( $image_id, $size );
		}
	endif;
	
/* 3.4 Display giffy featured image by post id */
	if( !function_exists( 'daze_giffy_featured_img' ) ) :
		function daze_giffy_featured_img( $post_id, $img_size='daze_wrapper_width' ) {
			$size = ( get_post_mime_type( get_post_thumbnail_id( absint( $post_id ) ) ) == "image/gif" ) ? 'full' : $img_size;
			
			return get_the_post_thumbnail( $post_id, $size );
		}
	endif;
	
/* 3.5 Get giffy featured image URL by post ID */
	if( !function_exists( 'daze_get_giffy_featured_img_url' ) ) :
		function daze_get_giffy_featured_img_url( $post_id, $size = 'daze_wrapper_width' ) {
			$size = ( "image/gif" === get_post_mime_type( get_post_thumbnail_id( $post_id ) ) ) ? 'full' : $size;
			
			return get_the_post_thumbnail_url( $post_id, $size );
		}
	endif;
	
/* 3.6 Get giffy attachment image URL by attachment ID */
	if( !function_exists( 'daze_get_giffy_attachment_url' ) ) :
		function daze_get_giffy_attachment_url( $image_id, $size = 'daze_wrapper_width' ) {
			$size = ( "image/gif" === get_post_mime_type( $image_id ) ) ? 'full' : $size;
			$src = wp_get_attachment_image_src( $image_id, $size );
			$url = $src[0];
			
			return $url;
		}
	endif;
	
/* 4.0 SITE LOGO
================== */
/* 4.1 Display site logo (desktop) */
	if( !function_exists( 'daze_show_site_logo' ) ) :
		function daze_show_site_logo() {
			$site_logo_retina_url = get_theme_mod( 'daze_site_logo_retina' );
			$site_logo_url = get_theme_mod( 'daze_site_logo' );
			$site_logo_links_to = get_theme_mod( 'daze_logo_link' ) ?
				get_theme_mod( 'daze_logo_link' ) :
				home_url( '/' );
			
		// Search for retina image first
			if( $site_logo_retina_url ) {
				$orig_img_arr = wp_get_attachment_metadata(daze_get_post_id_by_url( esc_url_raw( $site_logo_retina_url ) ));
				$orig_img_W = $orig_img_arr['width'];
				$orig_img_H = $orig_img_arr['height'];
				$retina_W = $orig_img_W/2;
				$retina_H = $orig_img_H/2;
				$retina_size = array( $retina_W, $retina_H );
				
				printf( '<div class="site-logo" style="height:%2$spx"><a href="%1$s" class="retina" style="height:%2$spx">%3$s</a></div>',
					esc_url( $site_logo_links_to ),
					esc_attr( $retina_H ),
					daze_get_giffy_img_by_url( esc_url_raw( $site_logo_retina_url ), 'full' )
				);
				
			} else if( $site_logo_url ) {
				printf( '<div class="site-logo"><a href="%1$s">%2$s</a></div>',
					esc_url( $site_logo_links_to ),
					daze_get_giffy_img_by_url( esc_url_raw( $site_logo_url ), 'full' )
				);
			}
			
		// If no logo is provided, show the site title
			else {
				printf( '<div class="site-logo va-middle"><a href="%1$s"><h1>%2$s</h1></a></div>',
					esc_url( $site_logo_links_to ),
					esc_html( get_bloginfo('name') )
				);
			}	
		}
	endif;
	
/* 4.2 Display site logo (mobile) */
	if( !function_exists( 'daze_show_site_logo_mobile' ) ) :
		function daze_show_site_logo_mobile() {			
			$site_logo_retina_url = get_theme_mod( 'daze_site_logo_mobile_retina' );
			$site_logo_url = get_theme_mod( 'daze_site_logo_mobile' );
			$site_logo_links_to = get_theme_mod( 'daze_logo_link' ) ?
				get_theme_mod( 'daze_logo_link' ) :
				home_url( '/' );
			
			if( !( $site_logo_retina_url || $site_logo_url ) ) {
				daze_show_site_logo();
				return;
			}
			
		// Search for retina image first
			if( $site_logo_retina_url ) {
				$orig_img_arr = wp_get_attachment_metadata(daze_get_post_id_by_url( esc_url_raw( $site_logo_retina_url ) ));
				$orig_img_W = $orig_img_arr['width'];
				$orig_img_H = $orig_img_arr['height'];
				$retina_W = $orig_img_W/2;
				$retina_H = $orig_img_H/2;
				$retina_size = array( $retina_W, $retina_H );
				
				printf( '<div class="site-logo va-middle"><a href="%1$s" class="retina" style="height:%2$spx">%3$s</a></div>',
					esc_url( $site_logo_links_to ),
					esc_attr( $retina_H ),
					daze_get_giffy_img_by_url( esc_url_raw( $site_logo_retina_url ), 'full' )
				);
				
			} else if( $site_logo_url ) {
				printf( '<div class="site-logo va-middle"><a href="%1$s">%2$s</a></div>',
					esc_url( $site_logo_links_to ),
					daze_get_giffy_img_by_url( esc_url_raw( $site_logo_url ), 'full' )
				);
			}
			
		// If no logo is provided, show the site title
			else {
				printf( '<div class="site-logo va-middle"><a href="%1$s"><h1>%2$s</h1></a></div>',
					esc_url( $site_logo_links_to ),
					esc_html( get_bloginfo('name') )
				);
			}	
		}
	endif;

/* 5.0 SEARCH RELATED FUNCTIONS
================================= */
/* 5.1 Search button display */
	if( !function_exists( 'daze_search_button' ) ) :
		function daze_search_button( $text = true ) {
			$text = ( true === $text ) ? get_theme_mod( 'daze_search_button_text', esc_html__( 'Search', 'daze' ) ) : '';
			
			printf(
				'<div class="search-button va-middle"><span class="search-text">%1$s</span><span class="search-icon">%2$s</span></div>',
				esc_html( $text ),
				daze_get_svg_search()
			);
		}
	endif;
	
/* 5.2 Highlight searched term */
	if( !function_exists( 'daze_highlight_searched_terms' ) ) :
		function daze_highlight_searched_terms( $text ) {
			$orig = $text;
			$sr = get_query_var('s');
			$keys = explode( " ", $sr );
			$keys = array_filter( $keys );
			$regEx = '\'(?!((<.*?)|(<a.*?)))(\b'. implode('|', $keys) . '\b)(?!(([^<>]*?)>)|([^>]*?</a>))\'iu';
			$text = preg_replace( $regEx, '<span class="search-highlight">\0</span>', $text );
			
			$result = is_search() ? $text : $orig;
			return $result;
		}
	endif;

/* 6.0 CATEGORY RELATED FUNCTIONS
=================================== */
/* 6.1 Check if the post has a category (excluding 'Uncategorized') */
	if( !function_exists( 'daze_is_categorized' ) ) :   
		function daze_is_categorized( $post_id ) {
			$is_categorized = false;
			$terms = wp_get_object_terms( $post_id, 'category' );
			
			if( is_array($terms) ) :
				foreach( $terms as $index => $term ) :
					if( 'uncategorized' === $term->slug ) {
						unset( $terms[$index] );
					}
				endforeach;
				
				$is_categorized = ( 0 < count( $terms ) );
			endif;
			
			return $is_categorized;
		}
	endif;	
	
/* 6.2 List categories assigned to a post */
	if( !function_exists( 'daze_post_categories' ) ) :
		function daze_post_categories($id) {
			$n = 0;			
			foreach( get_the_category($id) as $category ) {
				if( 'uncategorized' != $category->slug ) {
					if( $n != 0 ) {
						echo '<span class="separator"></span>';
					}
					
					$n++;
					
					printf(
						'<a href="%1$s">%2$s</a>',
						esc_url( get_category_link( $category->term_id ) ),
						esc_html( $category->name )
					);
				}
			}
		}
	endif;	
	
/* 7.0 POST RELATED FUNCTIONS
=============================== */
/* 7.1 Post views */
	if( !function_exists( 'daze_set_post_views' ) ) :   
		function daze_set_post_views( $postID ) {
			$count_key = 'daze_post_views_count';
			$count = (int) get_post_meta( $postID, $count_key, true );
			
			if( '' === $count ){
				$count = 0;
				delete_post_meta( $postID, $count_key );
				add_post_meta( $postID, $count_key, '0' );
				
			} else{
				$count++;
				update_post_meta( $postID, $count_key, $count );
			}
		}
	endif;
	
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	if( !function_exists( 'daze_get_post_views' ) ) :
		function daze_get_post_views( $postID ){
			$count_key = 'daze_post_views_count';
			$count = get_post_meta( $postID, $count_key, true );
			
			if( '' === $count ){
				delete_post_meta( $postID, $count_key );
				add_post_meta( $postID, $count_key, '0' );
				return "0";
			}
			
			return $count;
		}
	endif;
	
/* 7.2.1 Edit post */
	if( !function_exists( 'daze_edit_post' ) ) :
		function daze_edit_post() {
			return edit_post_link(
				esc_html__( 'Edit this post', 'daze' ),
				'<div class="edit-link button-link clearfix">'.daze_get_svg_gear(),
				'</div>'
			);
		}
	endif;
	
/* 7.2.2 Edit page */
	if( !function_exists( 'daze_edit_page' ) ) :
		function daze_edit_page() {
			return edit_post_link(
				esc_html__( 'Edit this page', 'daze' ),
				'<div class="edit-link button-link clearfix">'.daze_get_svg_gear(),
				'</div>'
			);
		}
	endif;	

/* 7.3 Customize comment output */
	if( !function_exists( 'daze_comments_list' ) ) : 
		function daze_comments_list( $comment, $args, $depth ) {
			$GLOBALS['comment'] = $comment;
			$get_comment = get_comment( $comment );
			$comment_author_arr = get_object_vars($get_comment);
			$comment_author_email = $comment_author_arr['comment_author_email'];
			$comment_class = "clearfix";
		?>
			<li <?php comment_class( $comment_class ); ?> id="comment-<?php comment_ID() ?>">			
				<?php echo get_avatar($comment,$args['avatar_size']); ?>
				
				<div class="details">
					<h5 class="author-name"><?php 
						echo wp_kses(
							get_comment_author_link(),
							array( 'a' => array( 'href' => array(), 'rel' => array(), 'class' => array() ) )
						);
					?></h5>
					<p class="meta">
						<?php echo esc_html( date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), strtotime( $comment->comment_date ) ) ); ?>
					</p>
				</div>
				
				<div class="reply">
					<?php
					comment_reply_link(
						array_merge(
							$args,
							array(
								'reply_text' => esc_html__( 'Reply', 'daze' ),
								'depth' => $depth,
								'max_depth' => $args['max_depth']
							)
						),
						$comment->comment_ID
					);
					
					edit_comment_link( esc_html__( 'Edit', 'daze' ) ); ?>
				</div>
				<div class="comment-text post-content">
				<?php
					if ( $comment->comment_approved == '0' ) :
						printf(
							'<em>%s</em>',
							esc_html_e( 'Comment awaiting approval', 'daze' )
						);
					endif;
					
					comment_text();
				?>
				</div>
			</li>
		<?php 
		}
	endif;	
	
/* 7.4 Post format icon */
	if( !function_exists( 'daze_post_format_icon' ) ) :   
		function daze_post_format_icon( $post_id ) {
			$p_format = get_post_format( $post_id );
			
			switch ( $p_format ) {
				case 'image':
					$post_icon = daze_get_svg_image();
					break;
					
				case 'video':
					$post_icon = daze_get_svg_video();
					break;
					
				case 'quote':
					$post_icon = daze_get_svg_quote();
					break;
					
				case 'link':
					$post_icon = daze_get_svg_link();
					break;
					
				case 'gallery':
					$post_icon = daze_get_svg_gallery();
					break;
					
				case 'audio':
					$post_icon = daze_get_svg_audio();
					break;
					
				default:
					$post_icon = daze_get_svg_standard();
			}
			
			return $post_icon;
		}
	endif;
	
/* 8.0 POSTS SLIDER
===================== */
/* 8.1 Render posts slider - simple */
	if( !function_exists( 'daze_post_slider_simple' ) ) :
		function daze_post_slider_simple() {
			if( $get_number_of_posts = get_theme_mod( 'daze_nwps_num_of_posts', 1 ) ) {
				$num_of_posts = $get_number_of_posts;
				
			} else {
				$num_of_posts = 1;
			}
		
			
			$count_posts = wp_count_posts();
			$published_posts = $count_posts->publish;
			
			if( $num_of_posts > $published_posts ) {
				wp_dequeue_script( 'daze_post_slider_simple' );
				return '';
			}
			
			$featured_posts_args = array (
				'post_type' 			=> 'post',
				'post_status' 			=> 'publish',
				'posts_per_page'		=> $num_of_posts,
				'meta_query' 			=> array(
					array(
						'key'     => 'daze_posts_show_in_nwps',
						'value'   => 'show-in-nwps',
						'compare' => '='
					)
				),
				'ignore_sticky_posts'	=> 1
			);
			
			$nwps_query = new WP_Query( $featured_posts_args );

			if( $nwps_query->have_posts() ) :				
			?>
				<div class="holder"></div>
				<div class="nwps simple">
			<?php
				$nwps_show_cat = get_theme_mod( 'daze_nwps_show_cat', true );
				$nwps_show_date = get_theme_mod( 'daze_nwps_show_date', true );
				$nwps_show_author = get_theme_mod( 'daze_nwps_show_author', false );
				
				while( $nwps_query->have_posts() ) :
					$nwps_query->the_post();
					
					if( $img_id = daze_posts_get_meta( 'daze_posts_nwps_image_id', get_the_ID() ) ) {
						$img_url = daze_get_giffy_attachment_url( $img_id, 'full' );
						
					} else if( has_post_thumbnail( get_the_ID() ) ) {
						$img_url = daze_get_giffy_featured_img_url( get_the_ID(), 'full' );
						
					} else {
						$img_url = false;
					}
					?>
					<div class="nwps-slide" >
						<div class="outer-wrapper">				
							<div <?php daze_nwps_bgr_class(); if( $img_url ) { ?> style="background-image:url(<?php echo esc_url( $img_url ) ?>)" <?php } ?>>
								<div class="nwps-content post-header" style="display: none;" >
							<?php
								if( true === $nwps_show_cat && daze_is_categorized( get_the_ID() ) ) {
								?>
									<h6 class="post-category"><?php daze_post_categories( get_the_ID() ); ?></h6>
								<?php
								}
								
								$post_title = get_the_title();
								
								$title_length = get_theme_mod( 'daze_nwps_title_length', 6 );
								
								if( 59 < strlen( $post_title ) ) {
									$post_title = wp_trim_words( $post_title, $title_length, '&hellip;' );
								}
								?>
									<h3><a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"><?php echo esc_html( $post_title ); ?></a></h3>
								<?php							
								if( true === $nwps_show_author || true === $nwps_show_date ) {
								?>
									<div class="post-meta">
								<?php
									if( true === $nwps_show_date ) {
										echo esc_html( get_the_date() );
									}
									
									if( true === $nwps_show_author && true === $nwps_show_date ) {
										echo " | ";
									}
									if( true === $nwps_show_author ) {
										is_rtl()
										? printf(
											'<a class="author-name" href="%2$s">%3$s</a> %1$s',
											get_theme_mod( 'daze_author_name_text', esc_html__( 'Posted by', 'daze' ) ),
											esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ),
											esc_html( get_the_author_meta( "nickname" ) )
										)
										: printf(
											'%1$s <a class="author-name" href="%2$s">%3$s</a>',
											get_theme_mod( 'daze_author_name_text', esc_html__( 'Posted by', 'daze' ) ),
											esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ),
											esc_html( get_the_author_meta( "nickname" ) )
										);
									}
								?>
									</div><!-- .post-meta -->
								<?php
								
								}
								?>
								</div><!-- .nwps-content -->
							<?php
								$overlay_color = get_theme_mod( 'daze_nwps_overlay_color', '#000' );
								$overlay_opacity = get_theme_mod( 'daze_nwps_overlay_opacity', 15 );
								$overlay_opacity = $overlay_opacity/100;
							?>
								<div class="overlay" style="background:<?php echo esc_attr( $overlay_color ); ?>; opacity:<?php echo floatval( $overlay_opacity ); ?>;"></div>
								
							<?php if( true === get_theme_mod( 'daze_nwps_grain_on', true ) ) : ?>
								<div class="noise"></div>
							<?php endif; ?>
							</div>
						</div>
					</div><!-- .nwps-slide -->
			<?php
				endwhile;
				wp_reset_postdata();
			?>
				</div><!-- .nwps.simple -->
			<?php
			endif;	
		}
	endif;
	
/* 8.2 Render posts slider - columns */
	if( !function_exists( 'daze_post_slider_columns' ) ) :
		function daze_post_slider_columns() {
			if( $get_number_of_posts = get_theme_mod( 'daze_nwps_num_of_posts', 3 ) ) {
				$num_of_posts = absint( $get_number_of_posts );
				
			} else {
				$num_of_posts = 3;
			}
							
			
			$count_posts = wp_count_posts();
			$published_posts = $count_posts->publish;
			
			if( 3 > $num_of_posts || ( $num_of_posts > $published_posts ) ) {
				wp_dequeue_script( 'daze_post_slider_columns' );
				return '';
			}
			
			$featured_posts_args = array (
				'post_type' 			=> 'post',
				'post_status' 			=> 'publish',
				'posts_per_page' 		=> $num_of_posts,
				'meta_query'			=> array(
					array(
						'key'     => 'daze_posts_show_in_nwps',
						'value'   => 'show-in-nwps',
						'compare' => '='
					)
				),
				'ignore_sticky_posts'	=> 1
			);
			
			$nwps_query = new WP_Query( $featured_posts_args );

			if( $nwps_query->have_posts() ) :
			?>
			
			<div class="holder"></div>
			<div class="nwps columns">
			<?php
				$overlay_color = get_theme_mod( 'daze_nwps_overlay_color', '#000' );
				$overlay_opacity = get_theme_mod( 'daze_nwps_overlay_opacity', 15 );
				$overlay_opacity = $overlay_opacity/100;
			?>
				<div class="overlay" style="background:<?php echo esc_attr( $overlay_color ); ?>; opacity:<?php echo floatval($overlay_opacity); ?>;"></div>
				
			<?php if( true === get_theme_mod( 'daze_nwps_grain_on', true ) ) { ?>
				<div class="noise"></div>
			<?php }
			
				$nwps_show_cat = get_theme_mod( 'daze_nwps_show_cat', true );
				$nwps_show_date = get_theme_mod( 'daze_nwps_show_date', true );
				$nwps_show_author = get_theme_mod( 'daze_nwps_show_author', false );
				
				$i=0;
		
				while ( $nwps_query->have_posts() ) :
					$nwps_query->the_post();
					
				// Get featured image
					if ( $img_id = daze_posts_get_meta( 'daze_posts_nwps_image_id', get_the_ID() ) ) {
						$img_url = daze_get_giffy_attachment_url( $img_id, 'full' );
						
					} else if( has_post_thumbnail( get_the_ID() ) ) {
						$img_url = daze_get_giffy_featured_img_url( get_the_ID(), 'full' );
						
					} else {
						$img_url = false;
					}
					?>
					<div class="nwps-slide" data-curr-slide="<?php echo absint($i); ?>" >
						<div class="nwps-content post-header" style="display: none;" >
						<?php
						if( true === $nwps_show_cat && daze_is_categorized( get_the_ID() ) ) {
						?>
							<h6 class="post-category"><?php daze_post_categories( get_the_ID() ); ?></h6>
						<?php
						}
								
						$post_title = get_the_title();
						
						$title_length = get_theme_mod( 'daze_nwps_title_length', 6 );
						
						if( 59 < strlen( $post_title ) ) {
							$post_title = wp_trim_words( $post_title, $title_length, '&hellip;' );
						}
						?>
							<h3><?php echo esc_html( $post_title ); ?></h3>
						<?php
						if( true === $nwps_show_author || true === $nwps_show_date ) {
						?>
							<div class="post-meta">
						<?php
							if( true === $nwps_show_date ) {
								echo esc_html( get_the_date() );
							}
							
							if( true === $nwps_show_author && true === $nwps_show_date ) {
								echo " | ";	
							}
							
							if( true === $nwps_show_author ) {
								is_rtl()
								? printf(
									'<a class="author-name" href="%2$s">%3$s</a> %1$s',
									get_theme_mod( 'daze_author_name_text', esc_html__( 'Posted by', 'daze' ) ),
									esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ),
									esc_html( get_the_author_meta( "nickname" ) )
								)
								: printf(
									'%1$s <a class="author-name" href="%2$s">%3$s</a>',
									get_theme_mod( 'daze_author_name_text', esc_html__( 'Posted by', 'daze' ) ),
									esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ),
									esc_html( get_the_author_meta( "nickname" ) )
								);
							}
						?>
							</div><!-- .post-meta -->
						<?php
						}
						?>
							<a class="read-more button-link" href="<?php echo esc_url( get_permalink() ); ?>">
								<?php esc_html_e( 'Read more', 'daze' ); ?>
								<svg x="0px" y="0px" width="128px" height="43px"><rect class="frame" stroke="#fff" width="128px" height="43px" ></rect><rect class="fill" fill="#fff" width="128px" height="43px" ></rect></svg>
							</a>
						</div><!-- .nwps-content -->
					</div><!-- .nwps-slide -->					
					
					<div <?php daze_nwps_bgr_class(); ?> data-curr-slide="<?php echo absint($i); ?>"
						<?php if( '' !== $img_url ) { ?> style="background-image:url(<?php echo esc_url( $img_url ); ?>);" <?php } ?>
					></div>
					<?php
					$i++;
					
				endwhile;
				wp_reset_postdata();
			?>
				</div>
			<?php
			endif;
		}
	endif;
	
/* 9.0 SOCIAL NETWORKS RELATED FUNCTIONS
========================================== */
/* 9.1 Share buttons */
	if( !function_exists( 'daze_share_buttons' ) ) :
		function daze_share_buttons() {			
			$socials = get_theme_mod( 'daze_sharing_links' );
			
		// Open container
			$share_buttons = '<div class="social share">';
			$share_buttons .= '<div class="inner-wrapper">';
			
		// Heading
			$share_buttons .= '<span class="heading">' . get_theme_mod( 'daze_share_buttons_text', esc_html__( 'Share this', 'daze' ) ) . '</span> ';
		
		// Icons
			$share_buttons .= '<span class="icons">';
			$profiles = explode( '-network-', $socials );
			
			array_shift( $profiles );
			
		// Twitter
			if ( in_array( "Twitter", $profiles ) || '' === $socials || ! $socials ) {
				$get_post_tags = get_the_tags( get_the_ID() );
				$post_tags = '';
				
				if( $get_post_tags ) {
					foreach( $get_post_tags as $tag ) {
						$post_tags .= esc_html( $tag->name ) . ','; 
					}
					
					$post_tags = '&hashtags=' . rtrim( $post_tags, "," );
				}
				
				$share_buttons .= sprintf(
					'<a class="bw" href="https://twitter.com/intent/tweet?url=%1$s&text=%2$s%3$s" target="_blank">%4$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					rtrim($post_tags, ","),
					daze_get_svg_twitter()
				);
			}
			
		// Facebook
			if ( in_array( "Facebook", $profiles ) || '' === $socials || ! $socials ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://www.facebook.com/sharer/sharer.php?u=%1$s" target="_blank">%2$s</a>',
					rawurlencode( get_the_permalink() ),
					daze_get_svg_facebook()
				);
			}
			
		// Pinterest
			if ( in_array( "Pinterest", $profiles ) || '' === $socials || ! $socials ) {
				$thumb_small_arr = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'daze_small' );
				
				$share_buttons .= sprintf(
					'<a class="bw" data-pin-do="buttonPin" data-pin-count="above" data-pin-custom="true" href="https://www.pinterest.com/pin/create/button/?url=%1$s&media=%2$s&description=%3$s">%4$s</a>',
					get_permalink(),
					$thumb_small_arr[0],
					strip_tags( get_the_excerpt( get_the_ID() ) ),
					daze_get_svg_pinterest()																										  
				);
			}
			
		// Google Plus
			if ( in_array( "GooglePlus", $profiles ) || '' === $socials || ! $socials ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://plus.google.com/share?url=%1$s" target="_blank">%2$s</a>',
					rawurlencode( get_the_permalink() ),
					daze_get_svg_googleplus()														   
				);
			}
			
		// Blogger
			if ( in_array( "Blogger", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://www.blogger.com/blog-this.g?u=%1$s&n=%2$s&t=%3$s" target="_blank">%4$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					strip_tags( get_the_excerpt( get_the_ID() ) ),
					daze_get_svg_blogger()
				);
			}
			
		// Digg
			if ( in_array( "Digg", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="http://digg.com/submit?url=%1$s&title=%2$s" target="_blank">%3$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					daze_get_svg_digg()
				);
			}
			
		// EverNote
			if ( in_array( "EverNote", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="http://www.evernote.com/clip.action?url=%1$s" target="_blank">%2$s</a>',
					rawurlencode( get_the_permalink() ),
					daze_get_svg_evernote()
				);
			}
			
		// Flattr
			if ( in_array( "Flattr", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://flattr.com/submit/auto?user_id=account&url=%1$s&title=%2$s" target="_blank">%3$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					daze_get_svg_flattr()
				);
			}
			
		// Gmail
			if ( in_array( "Gmail", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://mail.google.com/mail/?view=cm&fs=1&su=%2$s&body=%1$s" target="_blank">%3$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					daze_get_svg_gmail()
				);
			}
			
		// HackerNews
			if ( in_array( "HackerNews", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://news.ycombinator.com/submitlink?u=%1$s&t=%2$s" target="_blank">%3$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					daze_get_svg_hackernews()
				);
			}
			
		// Line
			if ( in_array( "Line", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://lineit.line.me/share/ui?url=%1$s" target="_blank">%2$s</a>',
					rawurlencode( get_the_permalink() ),
					daze_get_svg_line()
				);
			}
			
		// LinkedIn
			if ( in_array( "LinkedIn", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="http://www.linkedin.com/shareArticle?url=%1$s&title=%2$s" target="_blank">%3$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					daze_get_svg_linkedin()
				);
			}
			
		// LiveJournal
			if ( in_array( "LiveJournal", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="http://www.livejournal.com/update.bml?subject=%2$s&event=%1$s" target="_blank">%3$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					daze_get_svg_livejournal()
				);
			}
			
		// MySpace
			if ( in_array( "MySpace", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://myspace.com/post?u=%1$s&t=%2$s&%3$s" target="_blank">%4$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					'custom caption',
					daze_get_svg_myspace()
				);
			}
			
		// OKru
			if ( in_array( "OKru", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl=%1$s&title=%2$s" target="_blank">%3$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					daze_get_svg_okru()
				);
			}
			
		// Pocket
			if ( in_array( "Pocket", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://getpocket.com/save?url=%1$s" target="_blank">%2$s</a>',
					rawurlencode( get_the_permalink() ),
					daze_get_svg_pocket()
				);
			}
			
		// Reddit
			if ( in_array( "Reddit", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://reddit.com/submit?url=%1$s&title=%2$s" target="_blank">%3$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					daze_get_svg_reddit()
				);
			}
			
		// StumbleUpon
			if ( in_array( "StumbleUpon", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="http://www.stumbleupon.com/submit?url=%1$s&title=%2$s" target="_blank">%3$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					daze_get_svg_stumbleupon()
				);
			}
			
		// Telegram
			if ( in_array( "Telegram", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://telegram.me/share/url?url=%1$s&text=%2$s" target="_blank">%3$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					daze_get_svg_telegram()
				);
			}
			
		// Tumblr
			if ( in_array( "Tumblr", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=%1$s&title=%2$s&caption=%3$s" target="_blank">%4$s</a>',
					rawurlencode( get_the_permalink() ),
					get_the_title(),
					'custom caption',
					daze_get_svg_tumblr()
				);
			}
			
		// Viber
			if ( in_array( "Viber", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="viber://forward?text=%1$s" target="_blank">%2$s</a>',
					rawurlencode( get_the_permalink() ),
					daze_get_svg_viber()
				);
			}
			
		// WhatsApp
			if ( in_array( "WhatsApp", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="whatsapp://send?text=%1$s" target="_blank">%2$s</a>',
					rawurlencode( get_the_permalink() ),
					daze_get_svg_whatsapp()
				);
			}
			
		// VK
			if ( in_array( "VK", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="http://vk.com/share.php?url=%1$s" target="_blank">%2$s</a>',
					rawurlencode( get_the_permalink() ),
					daze_get_svg_vk()
				);
			}
			
		// XING
			if ( in_array( "XING", $profiles ) ) {
				$share_buttons .= sprintf(
					'<a class="bw" href="https://www.xing.com/app/user?op=share&url=%1$s" target="_blank">%2$s</a>',
					rawurlencode( get_the_permalink() ),
					daze_get_svg_xing()
				);
			}
			
			$share_buttons .= '</span>';
			
		// Close inner-wrapper
			$share_buttons .= '</div>';
			
		// Close container
			$share_buttons .= '</div>';
			
			return $share_buttons;
		}
	endif;
	
/* 9.2.1 Get saved profiles from Daze 2.1 version and below */
	if( !function_exists( 'daze_bu_get_social_pairs' ) ) :
		function daze_bu_get_social_pairs() {
			$links = daze_get_social_profiles( false, false );
			
			if( false !== strpos( $links, '<a ' ) ) {
				$links_array = explode( '<a ', $links );
				array_shift( $links_array );
				
				$profiles = '';
				
				foreach( $links_array as $link ) {
					$network = daze_get_string_selection( $link, 'title="', '"' );
					$profile_url = daze_get_string_selection( $link, 'href="', '"' );
					
					$profiles .= '-network-' . $network[0] . '-link-' . $profile_url[0];
				}
				
				return $profiles;
				
			} else {
				return '';
			}
		}
	endif;
	
/* 9.3 Get links to social profiles */
	if( !function_exists( 'daze_get_links_2_social_profiles' ) ) :
		function daze_get_links_2_social_profiles( $show_heading = false, $show_titles = false ) {
			$links = '';
			
			if( $socials = get_theme_mod( 'daze_social_profiles' ) ) {			
				$social_heading = esc_html( get_theme_mod( 'daze_social_heading' ) );
			
			// Heading
				if( $show_heading && $social_heading && !is_rtl() ) {
					$links = $social_heading;
				}
			
				$profiles = explode( '-network-', $socials );
				
				array_shift( $profiles );
				
				foreach( $profiles as $profile ) {
					$pair = explode( '-link-', $profile );
					$network = $pair[0];
					$profile_url = $pair[1];
					
					$links .= sprintf(
						'<a class="bw" href="%1$s" target="_blank" title="%2$s">',
						esc_url( $profile_url ),
						esc_attr( $network )
					);
					
					$links .= call_user_func( 'daze_get_svg_'.strtolower( $network ) );
					
					if( true === $show_titles ) {
						$links .= sprintf(
							'<span class="social-title">%s</span>',
							esc_html( $network )
						);
					}
					
					$links .= '</a>';
				}
			
			// Heading (rtl)
				if( $show_heading && $social_heading && is_rtl() ) {
					$links .= $social_heading;
				}
			}
			
			return $links;
		}
	endif;
	
/* 10.0 SPECIAL BOXES & SPECIAL WIDGETS
========================================= */
/* 10.1 Special widgets order */
	if ( ! function_exists( 'daze_special_widget_order' ) ) :
		function daze_special_widget_order( $allow, $start, $interval, $order ) {
			if ( 1 > $interval || 0 == $start || 0 == $interval ) {
				return false;
				
			} else {
				$order++;
				
				$show_special = $allow && ( ( $start === $order ) || ( $order > $start && ( 0 === ( $order - $start ) % $interval ) ) );
				
				if ( !$show_special ) {
					return false;
					
				} else {
					return true;
				}
			}
		}
	endif;

/* 10.2 Output all special widgets */
	if ( ! function_exists( 'daze_special_widgets' ) ) :
		function daze_special_widgets( $item_order ) {
			global $wp_registered_sidebars;
			global	$wp_registered_widgets;

			$output = array();
			$sidebars_widgets = wp_get_sidebars_widgets();

			$sidebar_id = 'sidebar-specials';
			
			if( ! isset( $sidebars_widgets[$sidebar_id] ) ) {
				return $output;
			}

			$widget_ids = $sidebars_widgets[$sidebar_id];

			if( ! $widget_ids ) {
				return array();
			}

			foreach( $widget_ids as $widget_id ) {
				if( ! isset( $wp_registered_widgets[$widget_id] ) || ! isset( $wp_registered_widgets[$widget_id]['params'][0] ) ) {
					continue;
				}
				
				$option_name = $wp_registered_widgets[$widget_id]['callback'][0]->option_name;
				
				$widget_data = get_option( $option_name );
				
				$key = $wp_registered_widgets[$widget_id]['params'][0]['number'];

				$params = array();
				$params[] = $widget_data[$key];

				$start = $params[0]['start'];
				$repeat = $params[0]['repeat'];

				if ( daze_special_widget_order( true, $start, $repeat, $item_order ) ) {
			?>
				<div class="masonry-item-wrapper">
					<div class="masonry-item">
					<?php
						if( false === get_theme_mod( 'daze_masonry_animated_bgr_off', false ) ) {
					?>
						<div class="drop-overlay pattern-bgr"></div>
					<?php
						}
					?>								
						<div class="masonry-content"><?php
							daze_show_widget_by_sidebar( $sidebar_id, $widget_id );
						?></div>
					</div>
				</div>
			<?php
				}
			}
		}
	endif;
	
/* 10.3 Output single widget, by its sidebar */
	if ( ! function_exists( 'daze_show_widget_by_sidebar' ) ) :
		function daze_show_widget_by_sidebar( $sidebar_id, $widget_id ) {
			global $wp_registered_widgets;
			global $wp_registered_sidebars;
			
			$rendered = false;

			if( ! isset( $wp_registered_widgets[$widget_id] ) || ! isset( $wp_registered_widgets[$widget_id]['params'][0] ) ) {
				return false;
			}

			$sidebars_widgets = wp_get_sidebars_widgets();
			
			if ( empty( $wp_registered_sidebars[ $sidebar_id ] ) || empty( $sidebars_widgets[ $sidebar_id ] ) || ! is_array( $sidebars_widgets[ $sidebar_id ] ) ) {
				return false;
			}

			$sidebar = $wp_registered_sidebars[$sidebar_id];
			
			$params = array_merge(
				array( array_merge( $sidebar, array('widget_id' => $widget_id, 'widget_name' => $wp_registered_widgets[$widget_id]['name']) ) ),
				(array) $wp_registered_widgets[$widget_id]['params']
			);

			$classname_ = '';
			
			foreach ( (array) $wp_registered_widgets[$widget_id]['classname'] as $class_name ) {
				if ( is_string( $class_name ) ) {
					$classname_ .= '_' . $class_name;
					
				} elseif ( is_object( $class_name ) ) {
					$classname_ .= '_' . get_class( $class_name );
				}
			}
			
			$classname_ = ltrim( $classname_, '_' );
			
			$params[0]['before_widget'] = sprintf( $params[0]['before_widget'], $widget_id, $classname_ );         
			$params = apply_filters( 'dynamic_sidebar_params', $params );

			$callback = $wp_registered_widgets[$widget_id]['callback'];
			
			if ( is_callable( $callback ) ) {
				call_user_func_array( $callback, $params );
				$rendered = true;
			}

			return $rendered;
		}
	endif;
	
// 10.4.1 Output Image Banner 1 special box
	if ( ! function_exists( 'daze_special_box_bnnr_1' ) ) :
		function daze_special_box_bnnr_1() {
			$widget_args = 'before_title=<h6 class="widget-title">&after_title=</h6>';
			$image_url = get_theme_mod( 'daze_bannerad_box_img' );
			
			if ( ! $image_url || '' === $image_url ) {
				return;
			}
			
			$image_id = daze_get_post_id_by_url( $image_url );
			$image_link = get_theme_mod( 'daze_bannerad_box_link' );
			$new_tab = 1;
		?>	
			<div class="masonry-item-wrapper">
				<div class="masonry-item image-box">
				<?php
					if( false === get_theme_mod( 'daze_masonry_animated_bgr_off', false ) ) {
				?>
					<div class="drop-overlay pattern-bgr"></div>
				<?php
					}
				?>								
					<div class="masonry-content"><?php
						$instance = array(
							'img_link'	=> $image_link,
							'new_tab'	=> $new_tab,
							'img_id'	=> $image_id
						);
						
						the_widget( 'daze_img_widget', $instance, $widget_args );
					?></div>
				</div>
			</div>
		<?php
		}
	endif;
	
// 10.4.2 Output Image Banner 2 special box
	if ( ! function_exists( 'daze_special_box_bnnr_2' ) ) :
		function daze_special_box_bnnr_2() {
			$widget_args = 'before_title=<h6 class="widget-title">&after_title=</h6>';
			$image_url = get_theme_mod( 'daze_bannerad_2_img' );
			
			if ( ! $image_url || '' === $image_url ) {
				return;
			}
			
			$image_id = daze_get_post_id_by_url( $image_url );
			$image_link = get_theme_mod( 'daze_bannerad_2_link' );
			$new_tab = 1;
		?>	
			<div class="masonry-item-wrapper">
				<div class="masonry-item image-box">
				<?php
					if( false === get_theme_mod( 'daze_masonry_animated_bgr_off', false ) ) {
				?>
					<div class="drop-overlay pattern-bgr"></div>
				<?php
					}
				?>								
					<div class="masonry-content"><?php
						$instance = array(
							'img_link'	=> $image_link,
							'new_tab'	=> $new_tab,
							'img_id'	=> $image_id
						);
						
						the_widget( 'daze_img_widget', $instance, $widget_args );
					?></div>
				</div>
			</div>
		<?php
		}
	endif;
	
// 10.4.3 Output Image Banner 3 special box
	if ( ! function_exists( 'daze_special_box_bnnr_3' ) ) :
		function daze_special_box_bnnr_3() {
			$widget_args = 'before_title=<h6 class="widget-title">&after_title=</h6>';
			$image_url = get_theme_mod( 'daze_bannerad_3_img' );
			
			if ( ! $image_url || '' === $image_url ) {
				return;
			}
			
			$image_id = daze_get_post_id_by_url( $image_url );
			$image_link = get_theme_mod( 'daze_bannerad_3_link' );
			$new_tab = 1;
		?>	
			<div class="masonry-item-wrapper">
				<div class="masonry-item image-box">
				<?php
					if( false === get_theme_mod( 'daze_masonry_animated_bgr_off', false ) ) {
				?>
					<div class="drop-overlay pattern-bgr"></div>
				<?php
					}
				?>								
					<div class="masonry-content"><?php
						$instance = array(
							'img_link'	=> $image_link,
							'new_tab'	=> $new_tab,
							'img_id'	=> $image_id
						);
						
						the_widget( 'daze_img_widget', $instance, $widget_args );
					?></div>
				</div>
			</div>
		<?php
		}
	endif;
	
// 10.4.4 Output Image Banner 4 special box
	if ( ! function_exists( 'daze_special_box_bnnr_4' ) ) :
		function daze_special_box_bnnr_4() {
			$widget_args = 'before_title=<h6 class="widget-title">&after_title=</h6>';
			$image_url = get_theme_mod( 'daze_bannerad_4_img' );
			
			if ( ! $image_url || '' === $image_url ) {
				return;
			}
			
			$image_id = daze_get_post_id_by_url( $image_url );
			$image_link = get_theme_mod( 'daze_bannerad_4_link' );
			$new_tab = 1;
		?>	
			<div class="masonry-item-wrapper">
				<div class="masonry-item image-box">
				<?php
					if( false === get_theme_mod( 'daze_masonry_animated_bgr_off', false ) ) {
				?>
					<div class="drop-overlay pattern-bgr"></div>
				<?php
					}
				?>								
					<div class="masonry-content"><?php
						$instance = array(
							'img_link'	=> $image_link,
							'new_tab'	=> $new_tab,
							'img_id'	=> $image_id
						);
						
						the_widget( 'daze_img_widget', $instance, $widget_args );
					?></div>
				</div>
			</div>
		<?php
		}
	endif;
	
// 10.4.5 Output Image Banner 5 special box
	if ( ! function_exists( 'daze_special_box_bnnr_5' ) ) :
		function daze_special_box_bnnr_5() {
			$widget_args = 'before_title=<h6 class="widget-title">&after_title=</h6>';
			$image_url = get_theme_mod( 'daze_bannerad_5_img' );
			
			if ( ! $image_url || '' === $image_url ) {
				return;
			}
			
			$image_id = daze_get_post_id_by_url( $image_url );
			$image_link = get_theme_mod( 'daze_bannerad_5_link' );
			$new_tab = 1;
		?>	
			<div class="masonry-item-wrapper">
				<div class="masonry-item image-box">
				<?php
					if( false === get_theme_mod( 'daze_masonry_animated_bgr_off', false ) ) {
				?>
					<div class="drop-overlay pattern-bgr"></div>
				<?php
					}
				?>								
					<div class="masonry-content"><?php
						$instance = array(
							'img_link'	=> $image_link,
							'new_tab'	=> $new_tab,
							'img_id'	=> $image_id
						);
						
						the_widget( 'daze_img_widget', $instance, $widget_args );
					?></div>
				</div>
			</div>
		<?php
		}
	endif;
	
// 10.4.6 Output Social special box
	if ( ! function_exists( 'daze_special_box_social' ) ) :
		function daze_special_box_social() {
			$widget_args = 'before_title=<h6 class="widget-title">&after_title=</h6>';
			$social_box_desc = get_theme_mod( 'daze_social_box_desc', esc_html__( 'Follow me', 'daze' ) );
			$social_box_heading = get_theme_mod( 'daze_social_box_heading', esc_html__( 'Connect', 'daze' ) );
		?>	
			<div class="masonry-item-wrapper">
				<div class="masonry-item">
				<?php
					if( false === get_theme_mod( 'daze_masonry_animated_bgr_off', false ) ) {
				?>
					<div class="drop-overlay pattern-bgr"></div>
				<?php
					}
				?>								
					<div class="masonry-content"><?php
						$instance = array(
							'desc'	=> $social_box_desc,
							'heading'	=> $social_box_heading
						);
						
						the_widget( 'Daze_Social_Widget', $instance, $widget_args );
					?></div>
				</div>
			</div>
		<?php
		}
	endif;
	
// 10.4.7 Output Popular/Latest special box
	if ( ! function_exists( 'daze_special_box_top_posts' ) ) :
		function daze_special_box_top_posts() {
			$widget_args = 'before_title=<h6 class="widget-title">&after_title=</h6>';
		?>	
			<div class="masonry-item-wrapper">
				<div class="masonry-item">
				<?php
					if( false === get_theme_mod( 'daze_masonry_animated_bgr_off', false ) ) {
				?>
					<div class="drop-overlay pattern-bgr"></div>
				<?php
					}
				?>								
					<div class="masonry-content"><?php
						$instance = array(
							'tp_num_of_posts' => get_theme_mod( 'daze_top_posts_box_count', 4 ),
							'tp_show_latest' => get_theme_mod( 'daze_top_posts_box_latest', 1 ),
							'tp_latest_title' => get_theme_mod( 'daze_top_posts_box_latest_title', esc_html__( 'Latest', 'daze' ) ),
							'tp_show_popular' => get_theme_mod( 'daze_top_posts_box_popular', 1 ),
							'tp_popular_title' => get_theme_mod( 'daze_top_posts_box_popular_title', esc_html__( 'Popular', 'daze' ) ),
							'tp_title_length' => get_theme_mod( 'daze_top_posts_box_title_length', 6 ),
							'tp_hide_views' => get_theme_mod( 'daze_top_posts_hide_views', 0 ),
							'tp_hide_comments' => get_theme_mod( 'daze_top_posts_hide_comments', false ),
							'tp_hide_date' => get_theme_mod( 'daze_top_posts_hide_date', 0 )
						);
						
						the_widget( 'daze_top_posts', $instance );
					?></div>
				</div>
			</div>
		<?php
		}
	endif;
	
// 10.4.8 Output Latest Comments special box
	if ( ! function_exists( 'daze_special_box_latest_comments' ) ) :
		function daze_special_box_latest_comments() {
			$widget_args = 'before_title=<h6 class="widget-title">&after_title=</h6>';
		?>	
			<div class="masonry-item-wrapper">
				<div class="masonry-item">
				<?php
					if( false === get_theme_mod( 'daze_masonry_animated_bgr_off', false ) ) {
				?>
					<div class="drop-overlay pattern-bgr"></div>
				<?php
					}
				?>								
					<div class="masonry-content"><?php
						$instance = array(
							'tp_num_of_posts' => get_theme_mod( 'daze_latest_comments_box_count', 4 )
						);
						
						the_widget( 'daze_latest_comments', $instance );
					?></div>
				</div>
			</div>
		<?php
		}
	endif;
?>