<?php
/* ==============================================
	Custom fields and metaboxes
	Daze - Premium WordPress Theme, by NordWood
================================================= */
/* Get custom fields
====================== */	
// General
	if ( !function_exists( 'daze_get_meta' ) ):
		function daze_get_meta( $value ) {
			global $post;

			$field = get_post_meta( $post->ID, $value, true );
			
			if( !empty( $field ) ) {
				return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
				
			} else {
				return false;
			}
		}
	endif;
	
// Posts only
	if ( !function_exists( 'daze_posts_get_meta' ) ):
		function daze_posts_get_meta( $value ) {
			global $post;

			$field = get_post_meta( $post->ID, $value, true );
			
			if( !empty( $field ) ) {
				return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
				
			} else {
				return false;
			}
		}
	endif;
	
// Pages only
	if( !function_exists( 'daze_pages_get_meta' ) ):
		function daze_pages_get_meta( $value ) {
			global $post;

			$field = get_post_meta( $post->ID, $value, true );
			if( !empty( $field ) ) {
				return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
				
			} else {
				return false;
			}
		}
	endif;

/* Create meta boxes
====================== */
// Posts and pages
	if( !function_exists( 'daze_meta_boxes' ) ):
		function daze_meta_boxes($post_types) {
			$show_on = array ( 'post', 'page' );
			if(in_array($post_types, $show_on)){				
				add_meta_box(
					'daze_meta_boxes-daze-meta-boxes',
					esc_html__( 'Layout', 'daze' ),
					'daze_metabox_html',
					$post_types,
					'advanced',
					'default'
				);				
			}	
		}
	endif;
	
	add_action( 'add_meta_boxes', 'daze_meta_boxes' );
	
// Posts only
	if( !function_exists( 'daze_meta_boxes_posts' ) ):
		function daze_meta_boxes_posts() {			
			add_meta_box(
				'daze_meta_boxes_posts-daze-meta-boxes-posts',
				esc_html__( 'Visibility', 'daze' ),
				'daze_metabox_html_posts',
				'post',
				'advanced',
				'default'
			);
			
			add_meta_box(
				'daze_meta_boxes_posts_global-daze-meta-boxes-posts-global',
				esc_html__( 'Ignore global settings', 'daze' ),
				'daze_metabox_html_posts_global',
				'post',
				'advanced',
				'default'
			);
				
			add_meta_box(
				'daze_meta_boxes_posts_side-daze-meta-boxes-posts-side',
				esc_html__( 'Custom Post Link', 'daze' ),
				'daze_metabox_html_posts_side',
				'post',
				'side',
				'low'
			);			
		}
	endif;
	
	add_action( 'add_meta_boxes_post', 'daze_meta_boxes_posts' );
	
// Pages only
	if( !function_exists( 'daze_meta_boxes_pages' ) ):
		function daze_meta_boxes_pages() {
			add_meta_box(
				'daze_meta_boxes_pages-daze-meta-boxes-pages',
				esc_html__( 'Sections', 'daze' ),
				'daze_metabox_html_pages',
				'page',
				'advanced',
				'default'
			);
		}
	endif;
	
	add_action( 'add_meta_boxes_page', 'daze_meta_boxes_pages' );

/* Create custom fields
========================= */	
// Posts and pages
	if( !function_exists( 'daze_metabox_html' ) ):	
		function daze_metabox_html( $post) {
			wp_nonce_field( '_daze_metabox_html_nonce', 'daze_metabox_html_nonce' );
			?>
			<div class="daze-metabox-section clearfix">			
				<fieldset>
					<input type="checkbox"
						name="daze_include_sidebar"
						id="daze_include_sidebar"
						value="include-sidebar"
						<?php echo ( daze_get_meta( 'daze_include_sidebar' ) === 'include-sidebar' ) ? 'checked' : ''; ?>
					>
					<label for="daze_include_sidebar"><?php esc_html_e( 'Include sidebar', 'daze' ); ?></label>
					
					<input type="checkbox"
						name="daze_drop_caps"
						id="daze_drop_caps"
						value="drop-caps"
						<?php echo ( daze_get_meta( 'daze_drop_caps' ) === 'drop-caps' ) ? 'checked' : ''; ?>
					>
					<label for="daze_drop_caps"><?php esc_html_e( 'Apply drop caps', 'daze' ); ?></label>
					
					<input type="checkbox"
						name="daze_enlarge_galleries"
						id="daze_enlarge_galleries"
						value="enlarge-galleries"
						<?php echo ( daze_get_meta( 'daze_enlarge_galleries' ) === 'enlarge-galleries' ) ? 'checked' : ''; ?>
					>
					<label for="daze_enlarge_galleries"><?php esc_html_e( 'Enlarge galleries', 'daze' ); ?></label>
					
					<input type="checkbox"
						name="daze_enlarge_media"
						id="daze_enlarge_media"
						value="enlarge-media"
						<?php echo ( daze_get_meta( 'daze_enlarge_media' ) === 'enlarge-media' ) ? 'checked' : ''; ?>
					>
					<label for="daze_enlarge_media"><?php esc_html_e( 'Enlarge embedded media', 'daze' ); ?></label>
					
					<input type="checkbox"
						name="daze_hide_featured_image"
						id="daze_hide_featured_image"
						value="hide-featured-image"
						<?php echo ( daze_get_meta( 'daze_hide_featured_image' ) === 'hide-featured-image' ) ? 'checked' : ''; ?>
					>
					<label for="daze_hide_featured_image"><?php esc_html_e( 'Hide featured image', 'daze' ); ?></label>
					
					<input type="checkbox"
						name="daze_allow_fb_comments"
						id="daze_allow_fb_comments"
						value="allow-fb-comments"
						<?php echo ( daze_get_meta( 'daze_allow_fb_comments' ) === 'allow-fb-comments' ) ? 'checked' : ''; ?>
					>
					<label for="daze_allow_fb_comments"><?php esc_html_e( 'Allow Facebook comments', 'daze' ); ?></label>
				</fieldset>
			</div><!-- Layout options -->
		<?php
		}
	endif;
   
/* Posts only */
	if( !function_exists( 'daze_metabox_html_posts' ) ):	
		function daze_metabox_html_posts( $post) {
			wp_nonce_field( '_daze_metabox_html_posts_nonce', 'daze_metabox_html_posts_nonce' );
			?>
			<div class="daze-metabox-section clearfix">			
				<fieldset>
					<input type="checkbox"
						name="daze_posts_show_cat"
						id="daze_posts_show_cat"
						value="show-cat"
						<?php echo ( daze_posts_get_meta( 'daze_posts_show_cat' ) === 'show-cat' ) ? 'checked' : ''; ?>
					>
					<label for="daze_posts_show_cat"><?php esc_html_e( 'Show category', 'daze' ); ?></label>
					
					<input type="checkbox"
						name="daze_posts_show_date"
						id="daze_posts_show_date"
						value="show-date"
						<?php echo ( daze_posts_get_meta( 'daze_posts_show_date' ) === 'show-date' ) ? 'checked' : ''; ?>
					>
					<label for="daze_posts_show_date"><?php esc_html_e( 'Show date', 'daze' ); ?></label>
					
					<input type="checkbox"
						name="daze_posts_show_comments_count"
						id="daze_posts_show_comments_count"
						value="show-comments-count"
						<?php echo ( daze_posts_get_meta( 'daze_posts_show_comments_count' ) === 'show-comments-count' ) ? 'checked' : ''; ?>
					>
					<label for="daze_posts_show_comments_count"><?php esc_html_e( 'Show comments count', 'daze' ); ?></label>
					
					<input type="checkbox"
						name="daze_posts_show_author"
						id="daze_posts_show_author"
						value="show-author"
						<?php echo ( daze_posts_get_meta( 'daze_posts_show_author' ) === 'show-author' ) ? 'checked' : ''; ?>
					>
					<label for="daze_posts_show_author"><?php esc_html_e( 'Show author\'s name', 'daze' ); ?></label>
					
					<input type="checkbox"
						name="daze_posts_show_tagcloud"
						id="daze_posts_show_tagcloud"
						value="show-tagcloud"
						<?php echo ( daze_posts_get_meta( 'daze_posts_show_tagcloud' ) === 'show-tagcloud' ) ? 'checked' : ''; ?>
					>
					<label for="daze_posts_show_tagcloud"><?php esc_html_e( 'Show tagcloud', 'daze' ); ?></label>
				</fieldset>
			</div><!-- Elements visibility options -->
			
			<div class="daze-metabox-section clearfix">
				<h5><?php esc_html_e( 'Posts slider', 'daze' ); ?></strong></h5>
				
				<fieldset>
					<input type="checkbox"
						name="daze_posts_show_in_nwps"
						id="daze_posts_show_in_nwps"
						value="show-in-nwps"
						<?php echo ( daze_posts_get_meta( 'daze_posts_show_in_nwps' ) === 'show-in-nwps' ) ? 'checked' : ''; ?>
					>
					<label for="daze_posts_show_in_nwps"><?php esc_html_e( 'Show in posts slider', 'daze' ); ?></label>
				</fieldset>
				
				<fieldset>					
					<div class="img-upload-wrapper clearfix">
						<div class="img-preview">
						<?php
							if ( daze_posts_get_meta( 'daze_posts_nwps_image_id' ) != '' ) :
								echo wp_get_attachment_image( daze_posts_get_meta( 'daze_posts_nwps_image_id' ), 'thumbnail' );
							endif;
						?>				
						</div>
						
						<input type="hidden" class="img-id"
							name="daze_posts_nwps_image_id"
							id="daze_posts_nwps_image_id"						
							value="<?php echo esc_attr( daze_posts_get_meta( 'daze_posts_nwps_image_id' ) ); ?>"
						>				
						
						<input type="button" class="button upload-img <?php if( daze_posts_get_meta( 'daze_posts_nwps_image_id' ) != '' ) echo 'hidden'; ?>"
							name="daze_posts_nwps_image_upload"
							id="daze_posts_nwps_image_upload"
							value="<?php esc_attr_e( 'Upload image for the slider', 'daze' ); ?>"
						>
						
						<input type="button" class="button remove-img <?php if( daze_posts_get_meta( 'daze_posts_nwps_image_id' ) == '' ) echo 'hidden'; ?>"
							name="daze_posts_nwps_image_remove"
							id="daze_posts_nwps_image_remove"
							value="<?php esc_attr_e( 'Remove image', 'daze' ); ?>"
						>
					</div>					
					
					<p><?php esc_html_e( 'If no image is uploaded for the slider, featured image will be used. Recommended size is 1820x682 (px).', 'daze' ); ?></p>					
				</fieldset>
			</div><!-- Posts slider options -->
			
			<div class="daze-metabox-section clearfix">
				<h5><?php esc_html_e( 'Featured image for posts list', 'daze' ); ?></strong></h5>
				
				<fieldset>					
					<div class="img-upload-wrapper clearfix">
						<div class="img-preview">
						<?php
							if ( daze_posts_get_meta( 'daze_posts_featured_on_list_id' ) != '' ) :
								echo wp_get_attachment_image( daze_posts_get_meta( 'daze_posts_featured_on_list_id' ), 'thumbnail' );
							endif;
						?>				
						</div>
						
						<input type="hidden" class="img-id"
							name="daze_posts_featured_on_list_id"
							id="daze_posts_featured_on_list_id"						
							value="<?php echo esc_attr( daze_posts_get_meta( 'daze_posts_featured_on_list_id' ) ); ?>"
						>				
						
						<input type="button" class="button upload-img <?php if( daze_posts_get_meta( 'daze_posts_featured_on_list_id' ) != '' ) echo 'hidden'; ?>"
							name="daze_posts_featured_on_list_upload"
							id="daze_posts_featured_on_list_upload"
							value="<?php esc_attr_e( 'Upload image for the list', 'daze' ); ?>"
						>
						
						<input type="button" class="button remove-img <?php if( daze_posts_get_meta( 'daze_posts_featured_on_list_id' ) == '' ) echo 'hidden'; ?>"
							name="daze_posts_featured_on_list_remove"
							id="daze_posts_featured_on_list_remove"
							value="<?php esc_attr_e( 'Remove image', 'daze' ); ?>"
						>
					</div>					
					
					<p><?php esc_html_e( 'If no image is uploaded for the list, featured image will be used.', 'daze' ); ?></p>
				</fieldset>
			</div><!-- Featured image for posts list -->
		<?php
		}
	endif;
	
	if( !function_exists( 'daze_metabox_html_posts_global' ) ):	
		function daze_metabox_html_posts_global( $post) {
			wp_nonce_field( '_daze_metabox_html_posts_global_nonce', 'daze_metabox_html_posts_global_nonce' );
			?>			
			<div class="daze-metabox-section clearfix">			
				<fieldset>
					<input type="checkbox"
						name="daze_ignore_global"
						id="daze_ignore_global"
						value="ignore-global"
						<?php echo ( daze_posts_get_meta( 'daze_ignore_global' ) === 'ignore-global' ) ? 'checked' : ''; ?>
					>
					<label for="daze_ignore_global"><?php esc_html_e( 'Check this to give the above options priority over the global "Daze single posts" settings in Customizer', 'daze' ); ?></label>
				</fieldset>
			</div><!-- Layout options -->
		<?php
		}
	endif;
	
	if( !function_exists( 'daze_metabox_html_posts_side' ) ):	
		function daze_metabox_html_posts_side( $post) {
			wp_nonce_field( '_daze_metabox_html_posts_side_nonce', 'daze_metabox_html_posts_side_nonce' );
			?>
			<div class="daze-metabox-section clearfix">			
				<fieldset>					
					<label for="daze_featured_img_link"><?php esc_html_e( 'URL:', 'daze' ); ?></label>
					<input type="url" class="widefat"
						name="daze_featured_img_link"
						id="daze_featured_img_link"
						value="<?php echo esc_url_raw( daze_posts_get_meta( 'daze_featured_img_link' ) ); ?>"
					>
					
					<input type="checkbox"
						name="daze_featured_img_target"
						id="daze_featured_img_target"
						value="new-tab"
						<?php echo ( daze_posts_get_meta( 'daze_featured_img_target' ) === 'new-tab' ) ? 'checked' : ''; ?>
					>
					<label for="daze_featured_img_target"><?php esc_html_e( 'Open link in new tab', 'daze' ); ?></label>
					
					
					<p class="small">Leave blank to keep default (post permalink)</p>
				</fieldset>
			</div><!-- Layout options -->
		<?php
		}
	endif;
	
/* Pages only */	
	if ( !function_exists( 'daze_metabox_html_pages' ) ):
		function daze_metabox_html_pages( $post) {
			wp_nonce_field( '_daze_metabox_html_pages_nonce', 'daze_metabox_html_pages_nonce' );
		?>
		
			<input type="hidden"
				name="daze_get_page_template"
				id="daze_get_page_template"
				value="<?php echo esc_attr( get_page_template_slug() ); ?>"
			><!-- Check if it's a contact page template -->
		
			<div class="daze-metabox-section clearfix">
				<h5><?php esc_html_e( 'Daze posts slider', 'daze' ); ?></strong></h5>
				
				<fieldset>
					<input type="checkbox"
						name="daze_pages_show_nwps"
						id="daze_pages_show_nwps"
						value="show-nwps"
						<?php echo ( daze_pages_get_meta( 'daze_pages_show_nwps' ) === 'show-nwps' ) ? 'checked' : ''; ?>
					>
					<label for="daze_pages_show_nwps"><?php esc_html_e( 'Show posts slider on this page', 'daze' ); ?></label>
				</fieldset>
			</div><!-- Posts slider visibility -->
		
			<div class="daze-metabox-section clearfix">
				<h5><?php esc_html_e( 'Daze page header', 'daze' ); ?></strong></h5>
				
				<fieldset>
					<input type="checkbox"
						name="daze_pages_hide_title"
						id="daze_pages_hide_title"
						value="hide-title"
						<?php echo ( daze_pages_get_meta( 'daze_pages_hide_title' ) === 'hide-title' ) ? 'checked' : ''; ?>
					>
					<label for="daze_pages_hide_title"><?php esc_html_e( 'Hide title on this page', 'daze' ); ?></label>
				</fieldset>
			</div><!-- Posts slider visibility -->
		
			<div class="daze-pages-contact daze-metabox-section clearfix">
				<h5><?php esc_html_e( 'Contact form', 'daze' ); ?></strong></h5>
				
				<fieldset>
					<label for="daze_contact_form_heading"><?php esc_html_e( 'Heading', 'daze' ); ?></label>
					<input type="text" class="widefat"
						name="daze_contact_form_heading"
						id="daze_contact_form_heading"
						value="<?php echo esc_attr( daze_pages_get_meta( 'daze_contact_form_heading' ) ); ?>"
					>
					
					<label for="daze_contact_form_shortcode"><?php esc_html_e( 'Shortcode', 'daze' ); ?></label>
					<input type="text" class="widefat"
						name="daze_contact_form_shortcode"
						id="daze_contact_form_shortcode"
						value="<?php echo esc_attr( daze_pages_get_meta( 'daze_contact_form_shortcode' ) ); ?>"
					>
				</fieldset>
			</div><!-- Contact page template only -->
			
			<div class="daze-pages-contact daze-metabox-section">
				<h5><?php esc_html_e( 'Contact photo', 'daze' ); ?></strong></h5>				
				
				<fieldset>
					<label for="daze_contact_photo_heading"><?php esc_html_e( 'Heading', 'daze' ); ?></label>
					<input type="text" class="widefat"
						name="daze_contact_photo_heading"
						id="daze_contact_photo_heading"
						value="<?php echo esc_attr( daze_pages_get_meta( 'daze_contact_photo_heading' ) ); ?>"
					>
					
					<div class="img-upload-wrapper clearfix">				
						<div class="img-preview">
						<?php
							if ( daze_pages_get_meta( 'daze_contact_photo_id' ) != '' ) :
								echo wp_get_attachment_image( daze_pages_get_meta( 'daze_contact_photo_id' ), 'thumbnail' );
							endif;
						?>				
						</div>
						
						<?php
							$contact_photo_arr = wp_get_attachment_image_src( daze_pages_get_meta( 'daze_contact_photo_id' ) );
						?>
						<label for="daze_contact_photo_url"><?php esc_html_e( 'Image URL:', 'daze' ); ?></label>
						<input type="url" class="img-url widefat"
							name="daze_contact_photo_url"
							id="daze_contact_photo_url"
							value="<?php echo esc_url_raw( $contact_photo_arr[0] ); ?>"
						>
						
						<input type="hidden" class="img-id"
							name="daze_contact_photo_id"
							id="daze_contact_photo_id"						
							value="<?php echo esc_attr( daze_pages_get_meta( 'daze_contact_photo_id' ) ); ?>"
						>				
						
						<input type="button" class="button upload-img <?php if( daze_pages_get_meta( 'daze_contact_photo_id' ) != '' ) echo 'hidden'; ?>"
							name="daze_contact_photo_upload"
							id="daze_contact_photo_upload"
							value="<?php esc_attr_e( 'Upload Image', 'daze' ); ?>"
						>
						
						<input type="button" class="button remove-img <?php if( daze_pages_get_meta( 'daze_contact_photo_id' ) == '' ) echo 'hidden'; ?>"
							name="daze_contact_photo_remove"
							id="daze_contact_photo_remove"
							value="<?php esc_attr_e( 'Remove Image', 'daze' ); ?>"
						>
					</div>
				</fieldset><!-- Contact photo options -->
			</div><!-- Contact page template only -->
			
			<div class="daze-pages-contact daze-metabox-section">
				<h5><?php esc_html_e( 'Contact map', 'daze' ); ?></strong></h5>				
				
				<fieldset>
					<label for="daze_contact_gmap_heading"><?php esc_html_e( 'Heading', 'daze' ); ?></label>
					<input type="text" class="widefat"
						name="daze_contact_gmap_heading"
						id="daze_contact_gmap_heading"
						value="<?php echo esc_attr( daze_pages_get_meta( 'daze_contact_gmap_heading' ) ); ?>"
					>
					
					<label for="daze_contact_gmap_lat"><?php esc_html_e( 'Latitude', 'daze' ); ?></label>
					<input type="text"
						name="daze_contact_gmap_lat"
						id="daze_contact_gmap_lat"
						value="<?php echo esc_attr( daze_pages_get_meta( 'daze_contact_gmap_lat' ) ); ?>"
					>
					
					<label for="daze_contact_gmap_lng"><?php esc_html_e( 'Longitude', 'daze' ); ?></label>
					<input type="text"
						name="daze_contact_gmap_lng"
						id="daze_contact_gmap_lng"
						value="<?php echo esc_attr( daze_pages_get_meta( 'daze_contact_gmap_lng' ) ); ?>"
					>
					
					<label for="daze_contact_gmap_addr"><?php esc_html_e( 'Full Address', 'daze' ); ?></label>
					<input type="text" class="widefat"
						name="daze_contact_gmap_addr"
						id="daze_contact_gmap_addr"
						value="<?php echo esc_attr( daze_pages_get_meta( 'daze_contact_gmap_addr' ) ); ?>"
					>
				</fieldset><!-- Contact map options -->
				
				<h6><?php esc_html_e( 'Map marker', 'daze' ); ?></strong></h6>
				<fieldset>
					<div class="img-upload-wrapper clearfix">				
						<div class="img-preview"><?php
							if ( daze_pages_get_meta( 'daze_contact_gmap_pin_id' ) != '' ) :
								echo wp_get_attachment_image( daze_pages_get_meta( 'daze_contact_gmap_pin_id' ), 'thumbnail' );
							endif;
						?></div>						
						
						<?php
							$map_pin_arr = wp_get_attachment_image_src( daze_pages_get_meta( 'daze_contact_gmap_pin_id' ) );
						?>
						<label for="daze_contact_gmap_pin_url"><?php esc_html_e( 'Image URL:', 'daze' ); ?></label>
						<input type="url" class="img-url widefat"
							name="daze_contact_gmap_pin_url"
							id="daze_contact_gmap_pin_url"
							value="<?php echo esc_url_raw( $map_pin_arr[0] ); ?>"
						>
						
						<input type="hidden" class="img-id"
							name="daze_contact_gmap_pin_id"
							id="daze_contact_gmap_pin_id"
							value="<?php echo esc_attr( daze_pages_get_meta( 'daze_contact_gmap_pin_id' ) ); ?>"
						>				
						
						<input type="button" class="button upload-img <?php if( daze_pages_get_meta( 'daze_contact_gmap_pin_id' ) != '' ) echo 'hidden'; ?>"
							name="daze_contact_gmap_pin_upload"
							id="daze_contact_gmap_pin_upload"
							value="<?php esc_attr_e( 'Upload image', 'daze' ); ?>"
						>
						
						<input type="button" class="button remove-img <?php if( daze_pages_get_meta( 'daze_contact_gmap_pin_id' ) == '' ) echo 'hidden'; ?>"
							name="daze_contact_gmap_pin_remove"
							id="daze_contact_gmap_pin_remove"
							value="<?php esc_attr_e( 'Remove image', 'daze' ); ?>"
						>
					</div>
					
					<label for="daze_contact_gmap_pin_title"><?php esc_html_e( 'Marker title', 'daze' ); ?></label>
					<input type="text"
						name="daze_contact_gmap_pin_title"
						id="daze_contact_gmap_pin_title"
						value="<?php echo esc_attr( daze_pages_get_meta( 'daze_contact_gmap_pin_title' ) ); ?>"
					>
				</fieldset><!-- Contact map pin options -->
			</div><!-- Contact page template only -->
		<?php
		}
	endif;

/* Updating meta fields
========================= */
// General			
	if( !function_exists( 'daze_save_meta' ) ):
		function daze_save_meta( $post_id ) {
			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			
			if( ! isset( $_POST['daze_metabox_html_nonce'] ) || ! wp_verify_nonce( $_POST['daze_metabox_html_nonce'], '_daze_metabox_html_nonce' ) ) {
				return;
			}
			
			if( ! current_user_can( 'edit_post', $post_id ) ) { return; }
			
			if( isset( $_POST['daze_include_sidebar'] ) ) {
				update_post_meta( $post_id, 'daze_include_sidebar', sanitize_text_field( $_POST['daze_include_sidebar'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_include_sidebar', null );
			}
			
			if( isset( $_POST['daze_drop_caps'] ) ) {
				update_post_meta( $post_id, 'daze_drop_caps', sanitize_text_field( $_POST['daze_drop_caps'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_drop_caps', null );
			}
			
			if ( isset( $_POST['daze_enlarge_galleries'] ) ) {
				update_post_meta( $post_id, 'daze_enlarge_galleries', sanitize_text_field( $_POST['daze_enlarge_galleries'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_enlarge_galleries', null );
			}
			
			if ( isset( $_POST['daze_enlarge_media'] ) ) {
				update_post_meta( $post_id, 'daze_enlarge_media', sanitize_text_field( $_POST['daze_enlarge_media'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_enlarge_media', null );
			}
			
			if ( isset( $_POST['daze_hide_featured_image'] ) ) {
				update_post_meta( $post_id, 'daze_hide_featured_image', sanitize_text_field( $_POST['daze_hide_featured_image'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_hide_featured_image', null );
			}
			
			if ( isset( $_POST['daze_allow_fb_comments'] ) ) {
				update_post_meta( $post_id, 'daze_allow_fb_comments', sanitize_text_field( $_POST['daze_allow_fb_comments'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_allow_fb_comments', null );
			}
		}
	endif;
	add_action( 'save_post', 'daze_save_meta' );
			
// Posts only			
	if ( !function_exists( 'daze_posts_save_meta' ) ):
		function daze_posts_save_meta( $post_id ) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			
			if ( ! isset( $_POST['daze_metabox_html_posts_nonce'] ) || ! wp_verify_nonce( $_POST['daze_metabox_html_posts_nonce'], '_daze_metabox_html_posts_nonce' ) ) {
				return;
			}
			
			if ( ! isset( $_POST['daze_metabox_html_posts_side_nonce'] ) || ! wp_verify_nonce( $_POST['daze_metabox_html_posts_side_nonce'], '_daze_metabox_html_posts_side_nonce' ) ) {
				return;
			}
			
			if ( ! isset( $_POST['daze_metabox_html_posts_global_nonce'] ) || ! wp_verify_nonce( $_POST['daze_metabox_html_posts_global_nonce'], '_daze_metabox_html_posts_global_nonce' ) ) {
				return;
			}
			
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
			
			if ( isset( $_POST['daze_posts_show_cat'] ) ) {
				update_post_meta( $post_id, 'daze_posts_show_cat', sanitize_text_field( $_POST['daze_posts_show_cat'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_posts_show_cat', null );
			}
			
			if ( isset( $_POST['daze_posts_show_date'] ) ) {
				update_post_meta( $post_id, 'daze_posts_show_date', sanitize_text_field( $_POST['daze_posts_show_date'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_posts_show_date', null );
			}
			
			if ( isset( $_POST['daze_posts_show_comments_count'] ) ) {
				update_post_meta( $post_id, 'daze_posts_show_comments_count', sanitize_text_field( $_POST['daze_posts_show_comments_count'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_posts_show_comments_count', null );
			}
			
			if ( isset( $_POST['daze_posts_show_author'] ) ) {
				update_post_meta( $post_id, 'daze_posts_show_author', sanitize_text_field( $_POST['daze_posts_show_author'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_posts_show_author', null );
			}
			
			if ( isset( $_POST['daze_posts_show_tagcloud'] ) ) {
				update_post_meta( $post_id, 'daze_posts_show_tagcloud', sanitize_text_field( $_POST['daze_posts_show_tagcloud'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_posts_show_tagcloud', null );
			}
			
			if ( isset( $_POST['daze_posts_show_in_nwps'] ) ) {
				update_post_meta( $post_id, 'daze_posts_show_in_nwps', sanitize_text_field( $_POST['daze_posts_show_in_nwps'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_posts_show_in_nwps', null );
			}
			
			if ( isset( $_POST['daze_posts_nwps_image_id'] ) ) {
				update_post_meta( $post_id, 'daze_posts_nwps_image_id', sanitize_text_field( $_POST['daze_posts_nwps_image_id'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_posts_nwps_image_id', null );
			}
			
			if ( isset( $_POST['daze_posts_featured_on_list_id'] ) ) {
				update_post_meta( $post_id, 'daze_posts_featured_on_list_id', sanitize_text_field( $_POST['daze_posts_featured_on_list_id'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_posts_featured_on_list_id', null );
			}
			
			if ( isset( $_POST['daze_ignore_global'] ) ) {
				update_post_meta( $post_id, 'daze_ignore_global', sanitize_text_field( $_POST['daze_ignore_global'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_ignore_global', null );
			}
			
			if ( isset( $_POST['daze_featured_img_link'] ) ) {
				update_post_meta( $post_id, 'daze_featured_img_link', esc_url_raw( $_POST['daze_featured_img_link'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_featured_img_link', null );
			}
			
			if ( isset( $_POST['daze_featured_img_target'] ) ) {
				update_post_meta( $post_id, 'daze_featured_img_target', sanitize_text_field( $_POST['daze_featured_img_target'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_featured_img_target', null );
			}
		}
	endif;
	add_action( 'save_post', 'daze_posts_save_meta' );	
	
// Pages only
	if ( !function_exists( 'daze_pages_save_meta' ) ):
		function daze_pages_save_meta( $post_id ) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
			if ( ! isset( $_POST['daze_metabox_html_pages_nonce'] ) || ! wp_verify_nonce( $_POST['daze_metabox_html_pages_nonce'], '_daze_metabox_html_pages_nonce' ) ) { return; }
			if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }
			
			if ( isset( $_POST['daze_pages_show_nwps'] ) ) {
				update_post_meta( $post_id, 'daze_pages_show_nwps', sanitize_text_field( $_POST['daze_pages_show_nwps'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_pages_show_nwps', null );
			}
			
			if ( isset( $_POST['daze_pages_hide_title'] ) ) {
				update_post_meta( $post_id, 'daze_pages_hide_title', sanitize_text_field( $_POST['daze_pages_hide_title'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_pages_hide_title', null );
			}
			
		// Contact page template only
			if ( isset( $_POST['daze_contact_form_heading'] ) ) {
				update_post_meta( $post_id, 'daze_contact_form_heading', sanitize_text_field( $_POST['daze_contact_form_heading'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_contact_form_heading', null );
			}
			
			if ( isset( $_POST['daze_contact_form_shortcode'] ) ) {
				update_post_meta( $post_id, 'daze_contact_form_shortcode', sanitize_text_field( $_POST['daze_contact_form_shortcode'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_contact_form_shortcode', null );	
			}		
	
			if ( isset( $_POST['daze_contact_photo_heading'] ) ) {
				update_post_meta( $post_id, 'daze_contact_photo_heading', sanitize_text_field( $_POST['daze_contact_photo_heading'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_contact_photo_heading', null );
			}
			
			if ( isset( $_POST['daze_contact_photo_id'] ) ) {
				update_post_meta( $post_id, 'daze_contact_photo_id', sanitize_text_field( $_POST['daze_contact_photo_id'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_contact_photo_id', null );
			}
			
			if ( isset( $_POST['daze_contact_gmap_heading'] ) ) {
				update_post_meta( $post_id, 'daze_contact_gmap_heading', sanitize_text_field( $_POST['daze_contact_gmap_heading'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_contact_gmap_heading', null );
			}
			
			if ( isset( $_POST['daze_contact_gmap_lat'] ) ) {
				update_post_meta( $post_id, 'daze_contact_gmap_lat', sanitize_text_field( $_POST['daze_contact_gmap_lat'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_contact_gmap_lat', null );
			}
			
			if ( isset( $_POST['daze_contact_gmap_lng'] ) ) {
				update_post_meta( $post_id, 'daze_contact_gmap_lng', sanitize_text_field( $_POST['daze_contact_gmap_lng'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_contact_gmap_lng', null );
			}
			
			if ( isset( $_POST['daze_contact_gmap_addr'] ) ) {
				update_post_meta( $post_id, 'daze_contact_gmap_addr', sanitize_text_field( $_POST['daze_contact_gmap_addr'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_contact_gmap_addr', null );
			}
			
			if ( isset( $_POST['daze_contact_gmap_pin_id'] ) ) {
				update_post_meta( $post_id, 'daze_contact_gmap_pin_id', sanitize_text_field( $_POST['daze_contact_gmap_pin_id'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_contact_gmap_pin_id', null );
			}
			
			if ( isset( $_POST['daze_contact_gmap_pin_title'] ) ) {
				update_post_meta( $post_id, 'daze_contact_gmap_pin_title', sanitize_text_field( $_POST['daze_contact_gmap_pin_title'] ) );
				
			} else {
				update_post_meta( $post_id, 'daze_contact_gmap_pin_title', null );
			}
		}
	endif;
	add_action( 'save_post', 'daze_pages_save_meta' );

/* Scripts and styles
======================= */
	if ( !function_exists( 'daze_metabox_scripts' ) ):
		function daze_metabox_scripts($hook) {
			if( 'post.php' != $hook && 'post-new.php' != $hook ) {
				return;
			}
			
			wp_enqueue_style( 'daze_metaboxes' );
			
			$postinfo = array(
				'type' => get_post_type(),
				'status' => get_post_status()
			);
			
			wp_localize_script( 'daze_metaboxes', 'postinfo', $postinfo );
			wp_enqueue_script( 'daze_metaboxes' );			
			wp_enqueue_media();
			wp_enqueue_script( 'daze_img_upload' );
		}
	endif;
	
	add_action('admin_enqueue_scripts', 'daze_metabox_scripts');	
?>