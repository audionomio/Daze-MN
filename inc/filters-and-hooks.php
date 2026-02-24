<?php
/* ==========================================================================
	Filters and hooks
	Daze - Premium WordPress Theme, by NordWood
========================================================================== */
/*
	TABLE OF CONTENTS
	
	1.0 IMAGE RELATED FILTERS
	1.1 Additional image size
	1.2 Add title attribute to attachment image	
	
	2.0 SETTINGS AND CLASSES FOR PARTICULAR ITEMS
	2.1 Classes for 'body' tag
	2.2 Classes for post
	
	3.0 CUSTOM COLUMNS FOR ADMIN SCREENS
	3.1 Custom column for posts: Featured image
	3.2 Custom column for posts: Image for slider
	3.3 Custom column for posts: Image for posts list
	3.4 Custom column for pages: Featured image
	3.5 Custom column for categories and tags: Category/Tag ID
	3.6 Custom column for users: User ID and custom photo
	
	4.0 POST RELATED FILTERS
	4.1 The "read more" link
	
	5.0 CUSTOM OUTPUT FOR DEFAULT WP ELEMENTS
	5.1 Custom gallery output
	5.2 Modify categories list output
	5.3 Modify tag cloud
	
	6.0 SOCIAL NETWORKS AND SEO RELATED FILTERS
	6.1 Open Graph meta tags
	6.2 Add a pingback url auto-discovery header for singularly identifiable articles
	
	7.0 CUSTOM WIDGET FIELDS
	7.1 Add custom fields to particular widgets
	7.2 Save custom widget fields
	
	8.0 OPTIMIZATION
	8.1 Disable WP Emoji
	8.2 Remove query string from static files
	8.3 Minify inline CSS
*/

/* 1.0 IMAGE RELATED FILTERS
============================== */
/* 1.1 Additional image size */
	if( !function_exists( 'daze_img_sizes' ) ) :
		function daze_img_sizes( $sizes ) {
			return array_merge( $sizes, array(
				'daze_wrapper_width' => esc_html__( 'Extra large', 'daze' )
			));
		}
	endif;
	
	add_filter( 'image_size_names_choose', 'daze_img_sizes' );

/* 1.2 Add title attribute to attachment image */
	if( !function_exists( 'daze_title_to_attachment' ) ) :
		function daze_title_to_attachment( $attr, $attachment ) {
			$attr['title'] = esc_attr( $attachment->post_title );
			return $attr;
		}
	endif;
	
	add_filter( 'wp_get_attachment_image_attributes', 'daze_title_to_attachment', 10, 2 );	
	
/* 2.0 SETTINGS AND CLASSES FOR PARTICULAR ITEMS
================================================== */
/* 2.1 Classes for 'body' tag */
	if( !function_exists( 'daze_body_classes' ) ) :
		function daze_body_classes( $classes ) {
			$classes[] = '';
			$layout_type = get_theme_mod( 'daze_blog_layout_type', 'masonry' );
			
			if( is_home() || is_archive() || is_search() ) {
				$layout_width = get_theme_mod( 'daze_blog_layout_width', 'narrow' );
					
				if( is_tag() && get_theme_mod( 'daze_custom_tag_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_tag_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_tag_layout_width', 'narrow' );
					
				} else if( is_date() && get_theme_mod( 'daze_custom_date_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_date_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_date_layout_width', 'narrow' );
					
				} else if( is_author() && get_theme_mod( 'daze_custom_author_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_author_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_author_layout_width', 'narrow' );
					
				} else if( is_category() && get_theme_mod( 'daze_custom_category_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_category_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_category_layout_width', 'narrow' );
					
				} else if( is_search() && get_theme_mod( 'daze_custom_search_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_search_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_search_layout_width', 'narrow' );
					
				} else if( is_archive() && get_theme_mod( 'daze_custom_archives_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_archives_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_archives_layout_width', 'narrow' );				
				}

				if( 'standard-list' != $layout_type ) :
					$classes[] = 'masonry';
					if( $layout_width === 'full-width' ) {
						$classes[] = 'full-width';
					}
				endif;
			}
			
			if( is_home() && ( 'standard-list' === $layout_type ) && ( 'full-posts' === get_theme_mod( 'daze_post_length' ) ) ) {
				$classes[] = 'full-posts';
			}
			
			return $classes;
		}
	endif;
	
	add_filter( 'body_class', 'daze_body_classes' );
	
/* 2.2 Classes for post */
	if ( !function_exists( 'daze_post_classes' ) ) :
		function daze_post_classes( $classes ) {			
			$classes[] = 'clearfix';
			
			$layout_width = get_theme_mod( 'daze_blog_layout_width', 'narrow' );
			
			if( is_home() || is_archive() || is_search() ) {
				$layout_type = get_theme_mod( 'daze_blog_layout_type', 'masonry' );
				$post_format = get_post_format();
					
				if( is_tag() && get_theme_mod( 'daze_custom_tag_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_tag_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_tag_layout_width', 'narrow' );
					
				} else if( is_date() && get_theme_mod( 'daze_custom_date_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_date_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_date_layout_width', 'narrow' );
					
				} else if( is_author() && get_theme_mod( 'daze_custom_author_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_author_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_author_layout_width', 'narrow' );
					
				} else if( is_category() && get_theme_mod( 'daze_custom_category_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_category_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_category_layout_width', 'narrow' );
					
				} else if( is_search() && get_theme_mod( 'daze_custom_search_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_search_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_search_layout_width', 'narrow' );
					
				} else if( is_archive() && get_theme_mod( 'daze_custom_archives_layout', false ) ) {
					$layout_type = get_theme_mod( 'daze_archives_layout_type', 'tiny' );
					$layout_width = get_theme_mod( 'daze_archives_layout_width', 'narrow' );
				}

				if(
					"masonry-mini" === $layout_type
					|| (
						"masonry" === $layout_type
						&& ( "link" === $post_format || "quote" === $post_format || "image" === $post_format )
						)
				) {
					$classes[] = 'cover-item';
				}
			}
			
			if( is_page() ) {
				if( daze_get_meta( 'daze_drop_caps' ) ) {
					$classes[] = 'drop-caps';
				}
				
				if( daze_get_meta( 'daze_enlarge_galleries' ) ) {
					$classes[] = 'enlarge-galleries';
				}
				
				if( daze_get_meta( 'daze_enlarge_media' ) ) {
					$classes[] = 'enlarge-media';
				}
			}		
			
			if(
				is_single()
				|| (
					is_home()
					&& ( $layout_type === "standard-list" )
					&& ( get_theme_mod( 'daze_post_length' ) === "full-posts" )
				)
			) {
				if( ( get_theme_mod( 'daze_drop_caps' ) && !( daze_posts_get_meta( 'daze_ignore_global' ) ) ) || daze_get_meta( 'daze_drop_caps' ) ) {
					$classes[] = 'drop-caps';
				}
				
				if( ( get_theme_mod( 'daze_enlarge_galleries' ) && !( daze_posts_get_meta( 'daze_ignore_global' ) ) ) || daze_get_meta( 'daze_enlarge_galleries' ) ) {
					$classes[] = 'enlarge-galleries';
				}
				
				if( ( get_theme_mod( 'daze_enlarge_media' ) && !( daze_posts_get_meta( 'daze_ignore_global' ) ) ) || daze_get_meta( 'daze_enlarge_media' ) ) {
					$classes[] = 'enlarge-media';
				}
			}		
			
			return $classes;
		}
	endif;
	add_filter( 'post_class', 'daze_post_classes' );
	
/* 3.0 CUSTOM COLUMNS FOR ADMIN SCREENS
========================================== */
/* 3.1 Custom column for posts: Featured image */
	if ( ! function_exists( 'daze_posts_list_featured_img' ) ) :
		function daze_posts_list_featured_img( $columns ){
			$b = array_slice( $columns , 0, 2 );
			$a = array_slice( $columns , 2 );
			
			$c['daze_post_featured_img'] = esc_html__( 'Featured Image', 'daze' );
			
			$columns = array_merge( $b, $c, $a );

			return $columns;
		}
	endif;
	
	add_filter( 'manage_posts_columns', 'daze_posts_list_featured_img', 5 );

	if ( ! function_exists( 'daze_posts_list_featured_img_display' ) ) :
		function daze_posts_list_featured_img_display( $column_name, $post_id ){
			switch( $column_name ) {
				case 'daze_post_featured_img':
					if ( has_post_thumbnail( $post_id ) ) {
						echo get_the_post_thumbnail( $post_id, 'thumbnail' );
					}
				break;
			}
		}
	endif;
	
	add_action( 'manage_posts_custom_column', 'daze_posts_list_featured_img_display', 5, 2 );

/* 3.2 Custom column for posts: Image for slider */
	if( !function_exists( 'daze_posts_list_nwps_img' ) ) :
		function daze_posts_list_nwps_img($columns){
			$b = array_slice( $columns , 0, 3 );
			$a = array_slice( $columns , 3 );	
			$c['daze_nwps_img'] = esc_html__( 'Slider image', 'daze' );
			
			$columns = array_merge( $b, $c, $a );
			
			$fp_args = array (
				'post_type' => 'post',
				'posts_per_page' => get_theme_mod( 'daze_nwps_num_of_posts' ),
				'meta_query' => array(
					array(
						'key'     => 'daze_posts_show_in_nwps',
						'value'   => 'show-in-nwps',
						'compare' => '='
					)
				)
			);
			
			$nwps_posts = get_posts( $fp_args );

			global $nwps_ids;

			$nwps_ids = array();

			foreach( $nwps_posts as $nwps_post ) {
				array_push( $nwps_ids, $nwps_post->ID );
			}

			return $columns;
		}
	endif;
	
	add_filter( 'manage_post_posts_columns', 'daze_posts_list_nwps_img', 5 ); 

	if( !function_exists( 'daze_posts_list_nwps_img_display' ) ) :
		function daze_posts_list_nwps_img_display( $column_name, $post_id ) {
			if( 'daze_nwps_img' === $column_name ) :
				$show_in_nwps = daze_posts_get_meta( 'daze_posts_show_in_nwps' ) ? daze_posts_get_meta( 'daze_posts_show_in_nwps' ) : true;
				
				global $nwps_ids;
				$in_nwps = in_array( $post_id, $nwps_ids);
				
				if( $show_in_nwps ) {
					if( !$in_nwps ) {
						echo '<span style="opacity: 0.2;">';
					}
					
					if( $nwps_img_id = daze_posts_get_meta( 'daze_posts_nwps_image_id' ) ) {
						echo wp_get_attachment_image( $nwps_img_id, 'thumbnail' );
						
					} else if( has_post_thumbnail( $post_id ) ) {
						echo get_the_post_thumbnail( $post_id, 'thumbnail' );
						
					} else {
						echo '<div style="width:60px; height:60px; background-color:' . esc_attr( get_theme_mod( 'daze_bgr_pattern_color', '#111' ) ) . '">';
						if( $bgr_pattern = get_theme_mod( 'daze_bgr_pattern' ) ) {
							echo daze_get_img_by_url( esc_url( $bgr_pattern ), 'thumbnail' );
						}
						echo '</div>';
					}
						
					if( !$in_nwps ) {
						echo '</span>';
					}
				}
			endif;
		}
	endif;
	
	add_action( 'manage_post_posts_custom_column', 'daze_posts_list_nwps_img_display', 5, 2 );
	
/* 3.3 Custom column for posts: Image for posts list */	
	if( !function_exists( 'daze_add_posts_col_list_img' ) ) :
		function daze_add_posts_col_list_img( $columns ){
			$b = array_slice( $columns , 0, 3 );
			$a = array_slice( $columns , 3 );
			
			$c['daze_posts_col_list_img'] = esc_html__( 'Image in posts list', 'daze' );
			
			$columns = array_merge( $b, $c, $a );

			return $columns;
		}
	endif;
	
	add_filter( 'manage_post_posts_columns', 'daze_add_posts_col_list_img', 5 );
	
	if( !function_exists( 'daze_posts_col_list_img' ) ) :
		function daze_posts_col_list_img( $column_name, $post_id ) {
			if( 'daze_posts_col_list_img' === $column_name ) :				
				if( $img_id = get_post_meta( $post_id, 'daze_posts_featured_on_list_id', true ) ) {
					echo wp_get_attachment_image( $img_id, 'thumbnail' );					
				}
			endif;
		}
	endif;

	add_action( 'manage_post_posts_custom_column', 'daze_posts_col_list_img', 5, 2 );
	
/* 3.4 Custom column for pages: Featured image */
	if( !function_exists( 'daze_pages_list_featured_img' ) ) :
		function daze_pages_list_featured_img( $columns ) {
			$b = array_slice( $columns , 0, 2 );
			$a = array_slice( $columns , 2 );
			
			$c['daze_page_featured_img'] = esc_html__( 'Featured Image', 'daze' );
			
			$columns = array_merge( $b, $c, $a );

			return $columns;
		}
	endif;
	
	add_filter( 'manage_pages_columns', 'daze_pages_list_featured_img' );
	 
	if( !function_exists( 'daze_pages_list_featured_img_display' ) ) :  
		function daze_pages_list_featured_img_display( $column_name, $post_id ) {	
			switch( $column_name ){	  
				case 'daze_page_featured_img':
					if( has_post_thumbnail( $post_id ) ) {
						echo get_the_post_thumbnail( $post_id, 'thumbnail' );
					}
				break;	 
			}
		}
	endif;
	
	add_action( 'manage_pages_custom_column', 'daze_pages_list_featured_img_display', 10, 2 );

/* 3.5 Custom column for categories and tags: Category/Tag ID */
	if( !function_exists( 'daze_taxonomy_list_id' ) ) :
		function daze_taxonomy_list_id( $columns ) {
			$b = array_slice( $columns , 0, 2 );
			$a = array_slice( $columns , 2 );
			
			$c['daze_taxonomy_id'] = esc_html__( 'ID', 'daze' );
			
			$columns = array_merge( $b, $c, $a );

			return $columns;
		}
	endif;
	
	add_filter( 'manage_edit-category_columns', 'daze_taxonomy_list_id' );
	
	if( !function_exists( 'daze_taxonomy_list_id_display' ) ) :  
		function daze_taxonomy_list_id_display( $value, $column_name, $tax_id ) {
			return $tax_id;
		}
	endif;
	
	add_action( 'manage_category_custom_column', 'daze_taxonomy_list_id_display', 10, 3 );
	
//	3.6 Custom column for users: User ID and custom photo
	add_filter( 'manage_users_columns' , 'daze_add_users_col_id' );

	if ( ! function_exists( 'daze_add_users_col_id' ) ) :  
		function daze_add_users_col_id( $columns ) {
			$b = array_slice( $columns , 0, 3 );
			$a = array_slice( $columns , 3 );
			
			$c['daze_users_col_id'] = esc_html__( 'ID', 'daze' );
			
			$columns = array_merge( $b, $c, $a );

			return $columns;
		}
	endif;
	
	add_filter( 'manage_users_columns' , 'daze_add_users_column_img' );

	if ( ! function_exists( 'daze_add_users_column_img' ) ) :  
		function daze_add_users_column_img( $columns ) {
			$b = array_slice( $columns , 0, 4 );
			$a = array_slice( $columns , 4 );
			
			$c['daze_users_column_img'] = esc_html__( 'Photo', 'daze' );
			
			$columns = array_merge( $b, $c, $a );

			return $columns;
		}
	endif;
	
	add_action( 'manage_users_custom_column', 'daze_manage_users_columns', 10, 3 );
	
	if ( ! function_exists( 'daze_manage_users_columns' ) ) :  
		function daze_manage_users_columns( $value, $column_name, $user_id ) {
			if ( 'daze_users_col_id' === $column_name ) :
				return $user_id;
			endif;
			
			if ( 'daze_users_column_img' === $column_name ) :
				$img_id = get_the_author_meta( 'daze_user_img', $user_id );
				return wp_get_attachment_image( $img_id, array(32, 32) );
			endif;
		}
	endif;

/* 4.0 POST RELATED FILTERS
============================== */
/* 4.1 The "read more" link */
	if( !function_exists( 'daze_read_more' ) ) :
	function daze_read_more( $more ) {
		return sprintf( '...<div><a class="read-more button-link" href="%1$s">%2$s</a></div>',
			esc_url( get_permalink( get_the_ID() ) ),
			esc_html__( 'Read More', 'daze' )
		);
	}	
	endif;
	
	add_filter( 'excerpt_more', 'daze_read_more' );
	
	if( !function_exists( 'daze_more_tag' ) ) :
		function daze_more_tag() {
			if( true === get_theme_mod( 'daze_hide_readmore', false ) ) {
				return '';
			}
			
			return sprintf( '...<div><a class="read-more button-link" href="%1$s">%2$s</a></div>',
				esc_url( get_permalink( get_the_ID() ) ),
				esc_html__( 'Read More', 'daze' )
			);
		}
	endif;
	
	add_filter( 'the_content_more_link', 'daze_more_tag' );

/* 5.0 CUSTOM OUTPUT FOR DEFAULT WP ELEMENTS
============================================== */
/* 5.1 Custom gallery output */
	if( !function_exists( 'daze_gallery_slider' ) ) :
		function daze_gallery_slider( $gallery_output, $attr ) {
			global $post;

			if( isset( $attr['orderby'] ) ) {
				$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
				if( !$attr['orderby'] ) {
					unset($attr['orderby']);
				}
			}

			$atts = shortcode_atts(
				array(
					'order'		=> 'ASC',
					'orderby'	=> 'post__in',
					'id'		=> $post->ID,
					'size'		=> 'daze_small',
					'include'	=> '',
					'exclude'	=> ''
				), $attr
			);

			$order   = $atts['order'];
			$orderby = $atts['orderby'];
			$id      = intval( $atts['id'] );
			$size    = $atts['size'];
			$include = $atts['include'];
			$exclude = $atts['exclude'];
			
			if( 'RAND' == $order ) {
			  $orderby = 'none';
			}

			if( !empty($include) ) {
				$include = preg_replace('/[^0-9,]+/', '', $include);
				$_attachments = get_posts(
					array(
						'include'			=> $include,
						'post_status'		=> 'inherit',
						'post_type'			=> 'attachment',
						'post_mime_type'	=> 'image',
						'order'				=> $order,
						'orderby'			=> $orderby
					)
				);

				$attachments = array();
				
				foreach( $_attachments as $key => $val ) {
					$attachments[$val->ID] = $_attachments[$key];
				}
			}

			if( empty( $attachments ) ) {
				return '';
			}

			$gallery_output = '<div class="gallery-slider">';
			
			foreach( $attachments as $id => $attachment ) {
				$img_thumb = wp_get_attachment_image_src( $id, 'daze_small' );
				$img_caption = $attachment->post_excerpt;

				$gallery_output .= '<div data-thumb="' . esc_url( $img_thumb[0] ) . '" class="gallery-item">';
				$gallery_output .= wp_get_attachment_image( $id, 'daze_wrapper_width' );
				$gallery_output .= '<span class="caption">' . esc_html( $img_caption ) . '</span>';
				$gallery_output .= '</div>';
			}
			
			$gallery_output .= '</div>';
			
			return $gallery_output;
		}
	endif;
	
	if( false === get_theme_mod( 'daze_gallery_slider' ) ) {
		add_filter( 'post_gallery', 'daze_gallery_slider', 10, 3 );
	}
	
/* 5.2 Modify categories list output */
	if( !function_exists( 'daze_cat_list' ) ) :
		function daze_cat_list( $links ) {
			$links = str_replace( '</a> (', '</a> <span class="count">', $links );
			$links = str_replace( ')', '</span>', $links );
			
			return $links;
		}
	endif;
	
	add_filter( 'wp_list_categories', 'daze_cat_list' );
	
	function daze_filter_categories_widget( $cat_args ) {
		return $cat_args;
	}

	add_filter( 'widget_categories_args', 'daze_filter_categories_widget', 10, 1 );
	
/* 5.3 Modify tag cloud */
	if( !function_exists( 'daze_tag_cloud' ) ) :
		function daze_tag_cloud( $args ) {
			$args['largest'] = 12;
			$args['smallest'] = 12;
			$args['unit'] = 'px';
			$args['number'] = '12';
			$args['separator'] = '';
			$args['link'] = 'view';
			
			return $args;
		}
	endif;
	
	add_filter( 'widget_tag_cloud_args', 'daze_tag_cloud' );

/* 6.0 SOCIAL NETWORKS AND SEO RELATED FILTERS
================================================ */
/* 6.1 Open Graph meta tags */
	if( get_theme_mod( 'daze_include_og' ) ) {
		if( !function_exists( 'daze_add_og_xml_ns' ) ) :
			function daze_add_og_xml_ns( $content ) {
				return ' xmlns:og="http://ogp.me/ns#" ' . $content;
			}
		endif;
		
		add_filter( 'language_attributes', 'daze_add_og_xml_ns' );

		if( !function_exists( 'daze_add_fb_xml_ns' ) ) :
			function daze_add_fb_xml_ns( $content ) {
				return ' xmlns:fb="https://www.facebook.com/2008/fbml" ' . $content;
			}
		endif;
		
		add_filter( 'language_attributes', 'daze_add_fb_xml_ns' );

		if( !function_exists( 'daze_og_meta_tags' ) ) :
			function daze_og_meta_tags() {
				$fb_app_id = get_theme_mod( 'daze_fb_app_id', '' );
			if ( $fb_app_id ) {
				echo '<meta property="fb:app_id" content="' . esc_attr( $fb_app_id ) . '" />';
			}
				
				if ( !is_singular() ) {
					return;
				}
				
				$thumbnail_src = '';
				
				echo '<meta property="og:url" content="' . rawurlencode( get_the_permalink() ) . '"/>';
				echo '<meta property="og:type" content="article"/>';
				echo '<meta property="og:title" content="' . get_the_title() . '"/>';
				echo '<meta property="og:description" content="'. strip_tags( get_the_excerpt( get_the_ID() ) ) .'" />';
				echo '<meta property="og:site_name" content="' . get_bloginfo( 'name' ) . '"/>';
				
				if( has_post_thumbnail( get_the_ID() ) ) {
					$thumbnail_arr = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'daze_wrapper_width' );
					$thumbnail_src = $thumbnail_arr[0];
					
				} else if( get_theme_mod( 'daze_og_image' ) ) {
					$thumbnail_src = get_theme_mod( 'daze_og_image' );
				}
				
				if( '' !== $thumbnail_src ) {
					echo '<meta property="og:image" content="' . esc_url( $thumbnail_src ) . '"/>';
				}
				
				echo '<meta property="og:image:width" content="1140"/>';
			}
		endif;
		
		add_action( 'wp_head', 'daze_og_meta_tags', 5 );
	}	
	
/* 6.2 Add a pingback url auto-discovery header for singularly identifiable articles */
	if( !function_exists( 'daze_pingback_header' ) ) :
		function daze_pingback_header() {
			if ( is_singular() && pings_open( get_queried_object() ) ) {
				printf(
					'<link rel="pingback" href="%s">',
					get_bloginfo( 'pingback_url', 'display' )
				);
			}
		}
	endif;
	
	add_action( 'wp_head', 'daze_pingback_header' );

/* 7.0 CUSTOM WIDGET FIELDS
============================= */
/* 7.1 Add custom fields to particular widgets */
	add_filter( 'in_widget_form', 'daze_add_widget_options', 10, 3 );

	if ( ! function_exists( 'daze_add_widget_options' ) ) :
		function daze_add_widget_options( $widget, $return, $instance ) {
			global $wp_registered_sidebars;			
			$spec_widgets = wp_get_sidebars_widgets();
			$spec_ids = $spec_widgets['sidebar-specials'];
			
			if ( in_array( $widget->id, $spec_ids  ) ) {
				$start = isset( $instance['start'] ) ? $instance['start'] : 3;
				$repeat = isset( $instance['repeat'] ) ? $instance['repeat'] : 4;
			?>
				<h4><?php esc_html_e( 'Loop', 'daze' ); ?></h4>
				<p>	
					<label for="<?php echo esc_attr( $widget->get_field_name( 'start' ) ); ?>"><?php esc_html_e( 'Starting position:', 'daze' ); ?></label>			
					<input type="number" class="widefat"
						name="<?php echo esc_attr( $widget->get_field_name( 'start' ) ); ?>"
						id="<?php echo esc_attr( $widget->get_field_id( 'start' ) ); ?>"
						value="<?php echo absint( $start ); ?>"
						placeholder="2"
					>
				</p>
				<p>	
					<label for="<?php echo esc_attr( $widget->get_field_name( 'repeat' ) ); ?>"><?php esc_html_e( 'Repeat on:', 'daze' ); ?></label>			
					<input type="number" class="widefat"
						name="<?php echo esc_attr( $widget->get_field_name( 'repeat' ) ); ?>"
						id="<?php echo esc_attr( $widget->get_field_id( 'repeat' ) ); ?>"
						value="<?php echo absint( $repeat ); ?>"
						placeholder="4"
					>
				</p>
			<?php
			}
			
		}
	endif;
	
/* 7.2 Save custom widget fields */
	add_filter( 'widget_update_callback', 'daze_save_widget_options', 10, 3 );

	if ( ! function_exists( 'daze_save_widget_options' ) ) :
		function daze_save_widget_options( $instance, $new_instance ) {
			$instance['start'] = isset( $new_instance['start'] ) ? absint( $new_instance['start'] ) : 3;
			$instance['repeat'] = isset( $new_instance['repeat'] ) ? absint( $new_instance['repeat'] ) : 3;
			
			return $instance;
		}
	endif;	

/* 8.0 OPTIMIZATION
============================= */
/* 8.1 Disable WP Emoji */
	if ( true === get_theme_mod( 'daze_opt_no_emojis', false ) ) {
		add_action( 'init', 'daze_disable_emojis', 4 );		
	}
	
	if ( ! function_exists( 'daze_disable_emojis' ) ) :
		function daze_disable_emojis() {
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_action( 'admin_print_styles', 'print_emoji_styles' );
			remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
			remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
			remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
			add_filter( 'tiny_mce_plugins', 'daze_disable_emojis_tinymce' );

			/* Remove DNS prefetch s.w.org (used for emojis, since WP 4.7) */
			add_filter( 'emoji_svg_url', '__return_false' );

			if ( get_site_option( 'initial_db_version' ) >= 32453 ) {
			/* Remove the ASCII to smiley convertion */
				remove_action( 'init', 'smilies_init', 5 );
			}
		}
	endif;

	if ( ! function_exists( 'daze_disable_emojis_tinymce' ) ) :
		function daze_disable_emojis_tinymce( $plugins ) {
			if ( is_array( $plugins ) ) {
				return array_diff( $plugins, array( 'wpemoji' ) );
				
			} else {
				return array();
			}
		}
	endif;
	
//	8.2 Remove query string from static files
	if ( true === get_theme_mod( 'daze_opt_no_queries_on_static_files', false ) ) {
		add_filter( 'style_loader_src', 'daze_remove_cssjs_ver', 10, 2 );
		add_filter( 'script_loader_src', 'daze_remove_cssjs_ver', 10, 2 );
	}

	if ( ! function_exists( 'daze_remove_cssjs_ver' ) ) :
		function daze_remove_cssjs_ver( $src ) {
			if ( strpos( $src, '?ver=' ) ) {
				$src = remove_query_arg( 'ver', $src );
			}
			
			return $src;
		}
	endif;
	
// 8.3 Minify inline CSS
/*
	- Keep important white–space(s) in 'calc()'
	- Fix case for '#foo<space>[bar="baz"]', '#foo<space>*' and '#foo<space>:first-child' [^1]
	- Fix case for '[bar="baz"]<space>.foo', '*<space>.foo', ':nth-child(2)<space>.foo' and '@media<space>(foo: bar)<space>and<space>(baz: qux)' [^2]
	- Minify HEX color code [^3]
	- Remove white–space(s) around punctuation(s) [^4]
	- Replace zero unit(s) with '0' [^5]
	- Replace '0.6' with '.6' [^6]
	- Replace ':0 0', ':0 0 0' and ':0 0 0 0' with ':0' [^7]
	- Replace 'background(?:-position)?:(0|none)' with 'background$1:0 0' [^8]
	- Replace '(border(?:-radius)?|outline):none' with '$1:0' [^9]
	- Remove empty selector(s) [^10]
	- Remove the last semi–colon and replace multiple semi–colon(s) with a semi–colon [^11]
	- Replace multiple white–space(s) with a space [^12]
*/
// Create a constant for the escape character
	if ( ! function_exists( 'daze_minify_inline_css' ) ) :	
		function daze_minify_inline_css( $input ) {
			if ( false !== stripos( $input, 'calc(' ) ) {
				$input = preg_replace_callback('#\b(calc\()\s*(.*?)\s*\)#i', function($m) {
					return $m[1] . preg_replace('#\s+#', '\x1A', $m[2]) . ')';
				}, $input);
			}
			$input = preg_replace(array(
				'#(?<=[\w])\s+(\*|\[|:[\w-]+)#',
				'#([*\]\)])\s+(?=[\w\#.])#', '#\b\s+\(#', '#\)\s+\b#',
				'#\#([a-f\d])\1([a-f\d])\2([a-f\d])\3\b#i',
				'#\s*([~!@*\(\)+=\{\}\[\]:;,>\/])\s*#',
				'#\b(?<!\d\.)(?:0+\.)?0+(?:[a-z]+\b)#i',
				'#\b0+\.(\d+)#',
				'#:(0\s+){0,3}0(?=[!,;\)\}]|$)#',
				'#\b(background(?:-position)?):(?:0|none)([;,\}])#i',
				'#\b(border(?:-radius)?|outline):none\b#i',
				'#(^|[\{\}])(?:[^\{\}]+)\{\}#',
				'#;+([;\}])#',
				'#\s+#'
			), array(
				'\x1A' . '$1',
				' $ 1 '  .  '\x1A' , '\x1A'  .  ' ( ' , ' ) '  .  '\x1A' ,
				'#$1$2$3',
				'$1',
				'0',
				'.$1',
				':0',
				'$1:0 0$2',
				'$1:0',
				'$1',
				'$1',
				' '
			), $input);
			
			return trim( str_replace( '\x1A', ' ', $input ) );
		}
	endif;
?>