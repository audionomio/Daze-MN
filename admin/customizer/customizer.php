<?php
/* ==============================================
	CUSTOMIZER
	Daze - Premium WordPress Theme, by NordWood
================================================= */
/*	Section block
=================== */
	if( class_exists( 'WP_Customize_Control' ) && !class_exists( 'Daze_Customizer_Section_Block' ) ) :
		class Daze_Customizer_Section_Block extends WP_Customize_Control {
			public $content = '';
			
			public function render_content() {
				if ( isset( $this->label ) ) {
					printf(
						'<span class="customize-control-title"><h3>%s</h3></span>',
						esc_html($this->label)
					);
				}
				
				if ( isset( $this->description ) ) {
					printf(
						'<span class="customize-control-description">%s</span>',
						esc_html($this->description)
					);
				}
			}
		}
	endif;

/*	CUSTOM HTML FOR SOCIAL PROFILES
===================================== */
	if( class_exists( 'WP_Customize_Control' ) && !class_exists( 'Daze_Customize_Social_Profiles' ) ) :
		class Daze_Customize_Social_Profiles extends WP_Customize_Control {
		 
			public function render_content(){
				global $wp_customize;
					
				if( isset( $this->label ) ) {
					printf(
						'<span class="customize-control-title"><h3>%s</h3></span>',
						esc_html( $this->label )
					);
				}
				
				if( isset( $this->description ) ) {
					printf(
						'<span class="customize-control-description">%s</span>',
						esc_html( $this->description )
					);
				}
				
				$networks = array( "Facebook", "Twitter", "Instagram", "Pinterest", "GooglePlus", "500px", "Behance", "Blogger", "BlogLovin", "DailyMotion", "Delicious", "DeviantArt", "Digg", "Dribble", "Envato", "Etsy", "Flickr", "FourSquare", "GitHub", "GrooveShark", "Hypem", "KickStarter", "LastFM", "LinkedIn", "Medium", "MixCloud", "MySpace", "Reddit", "Scribd", "SnapChat", "SoundCloud", "Spotify", "Steam", "StumbleUpon", "TripAdvisor", "Tumblr", "Twitch", "Vimeo", "VK", "XING", "Yelp", "YouTube" );
				
			// Get the active social profiles and generate their name-url pairs
				$profiles = explode( '-network-', $this->value() );
				
				array_shift( $profiles );
				$pairs = array();				
				
				foreach( $profiles as $profile ) {
					$pair = explode( '-link-', $profile );
					$network = $pair[0];
					$profile_url = $pair[1];
					$pairs[$network] = $profile_url;
				}
			?>
				<div class="daze-social-profiles-controls clearfix">					
					<div class="daze-social-profiles-choices clearfix">
					<?php
						foreach( $networks as $network ) {
							$has_profile = array_key_exists( $network, $pairs );
							
							if( $has_profile ) {
								$url = $pairs[$network];
								$active = "active";
								
							} else {
								$url = '';
								$active = '';
							}								
					?>
						<span class="daze-social-profiles-icon"
							title = "<?php echo esc_html( $network ); ?>"
							data-network-name="<?php echo esc_html( $network ); ?>"
							data-has-profile="<?php echo esc_html( $active ); ?>"
							data-profile-url="<?php echo esc_html( $url ); ?>"
						><?php
							echo call_user_func( 'daze_get_svg_'.strtolower( $network ) );
						?></span>
					<?php
						}
					?>						
						<div class="daze-social-profiles-popout">
							<fieldset class="daze-social-profiles-fieldset">
								<label class="daze-social-profiles-active-label" for="<?php echo esc_attr( $this->id ); ?>-active"></label>
								
								<textarea rows="4" class="daze-social-profiles-active"
									id="<?php echo esc_attr( $this->id ); ?>-active"
									name="<?php echo esc_attr( $this->id ); ?>-active"
								></textarea>
							</fieldset>
							
							<span class="daze-close-button"><?php echo daze_get_svg_close(); ?></span>
						</div>
					</div>
					
					<!-- Keep the values from the old version of Daze -->
					<fieldset class="daze-social-profiles-fieldset">
						<p><strong><?php esc_html_e( 'For the users who switched from Daze 2.1 or older version: ', 'daze' ); ?></strong><?php esc_html_e( 'Click the button below to import your profiles that were saved in old fields.', 'daze' ); ?></p>
						
						<input type="hidden" class="daze-social-profiles-bu"
							id="<?php echo esc_attr( $this->id ); ?>-bu"
							name="<?php echo esc_attr( $this->id ); ?>-bu"
							value="<?php echo esc_attr( daze_bu_get_social_pairs() ); ?>"
						/>
					
						<!-- Button to get the values from old version -->
						<input type="button" class="daze-social-profiles-get-bu button"
							id="<?php echo esc_attr( $this->id ); ?>-get-bu"
							name="<?php echo esc_attr( $this->id ); ?>-get-bu"
							value="<?php esc_attr_e( 'Import saved profiles', 'daze' ); ?>"
						/>
					</fieldset>
					
					<!-- Combine all of the options above into a single string, to be saved as social profiles control -->
					<fieldset class="daze-social-profiles-fieldset">
						<input type="hidden" class="daze-social-profiles-combined"
							id="<?php echo esc_attr( $this->id ); ?>"
							name="<?php echo esc_attr( $this->id ); ?>"
							value="<?php echo esc_attr( $this->value() ); ?>"
							<?php $this->link(); ?>
						/>
					</fieldset>
				</div>				
			<?php
			}
		}
	endif;

/*	CUSTOM HTML FOR SHARING LINKS
===================================== */
	if( class_exists( 'WP_Customize_Control' ) && !class_exists( 'Daze_Customize_Sharing_Links' ) ) :
		class Daze_Customize_Sharing_Links extends WP_Customize_Control {		 
			public function render_content(){
				global $wp_customize;
					
				if( isset( $this->label ) ) {
					printf(
						'<span class="customize-control-title"><h3>%s</h3></span>',
						esc_html( $this->label )
					);
				}
				
				if( isset( $this->description ) ) {
					printf(
						'<span class="customize-control-description">%s</span>',
						esc_html( $this->description )
					);
				}
				
				$networks = array( "Facebook", "Twitter", "Instagram", "Pinterest", "GooglePlus", "Blogger", "Digg", "MySpace", "Reddit", "StumbleUpon", "Tumblr", "VK", "XING", "EverNote", "Flattr", "Gmail", "HackerNews", "Line", "LinkedIn", "OKru", "Pocket", "Telegram", "Viber", "WhatsApp" );
				
			// Get the active social profiles and generate their name-url pairs
				$profiles = explode( '-network-', $this->value() );				
				array_shift( $profiles );
			?>
				<div class="daze-sharing-links-controls clearfix">					
					<div class="daze-sharing-links-choices clearfix">
						<?php
							foreach( $networks as $network ) {
								if( in_array( $network, $profiles ) ) {
									$active = "on";
									
								} else {
									$active = "off";
								}
								
						?>
							<span class="daze-sharing-links-icon"
								title = "<?php echo esc_html( $network ); ?>"
								data-network-name="<?php echo esc_html( $network ); ?>"
								data-is-active="<?php echo esc_html( $active ); ?>"
							><?php
								echo call_user_func( 'daze_get_svg_'.strtolower( $network ) );
							?></span>
						<?php
							}
						?>
					</div>
					
					<!-- Combine all of the options above into a single string, to be saved as social profiles control -->
					<fieldset class="daze-sharing-links-fieldset">
						<input type="hidden" class="daze-sharing-links-combined"
							id="<?php echo esc_attr( $this->id ); ?>"
							name="<?php echo esc_attr( $this->id ); ?>"
							value="<?php echo esc_attr( $this->value() ); ?>"
							<?php $this->link(); ?>
						/>
					</fieldset>
				</div>				
			<?php
			}
		}
	endif;

/*	SECTIONS
========================================================================== */  
	if( !function_exists( 'daze_customizer' ) ) : 
		function daze_customizer( $wp_customize ) {
			$wp_customize->get_section( 'static_front_page' )->title = esc_html__( 'Static front page', 'daze' );
			
		// Site identity
			$wp_customize->get_section( 'title_tagline' )->priority = 1;
			$wp_customize->get_section( 'title_tagline' )->title = esc_html__( 'Site identity', 'daze' );
			$wp_customize->remove_control( 'display_header_text' );
			
			include_once( get_template_directory() . '/admin/customizer/site_identity.php' );
			
		// Site header
			$wp_customize->add_section( 'daze_site_header', array(
				'title'    => esc_html__( 'Daze header & top bar', 'daze' ),
				'priority' => 2
			));
			
			include_once( get_template_directory() . '/admin/customizer/site_header.php' );
			
		// Blog layout
			$wp_customize->add_section( 'daze_blog_layout', array(
				'title'    => esc_html__( 'Daze blog layout', 'daze' ),
				'priority' => 3
			));
			
			include_once( get_template_directory() . '/admin/customizer/blog_layout.php' );
			
		// Archives layout
			$wp_customize->add_section( 'daze_archives_layout', array(
				'title'    => esc_html__( 'Daze archives layouts', 'daze' ),
				'priority' => 4
			));
			
			include_once( get_template_directory() . '/admin/customizer/archives_layout.php' );
			
		// Special boxes
			$wp_customize->add_section( 'daze_special_boxes', array(
				'title'			=> esc_html__( 'Daze special boxes', 'daze' ),
				'description'	=> esc_html__( 'Important: Available only on Pinterest/Masonry list', 'daze' ),
				'priority'		=> 5
			));
			
			include_once( get_template_directory() . '/admin/customizer/special_boxes.php' );
			
		// Single Posts
			$wp_customize->add_section( 'daze_single_posts', array(
				'title'    => esc_html__( 'Daze single posts', 'daze' ),
				'priority' => 6
			));
			
			include_once( get_template_directory() . '/admin/customizer/single_posts.php' );
			
		// Posts Slider
			$wp_customize->add_section( 'daze_posts_slider', array(
				'title'    => esc_html__( 'Daze posts slider', 'daze' ),
				'priority' => 7
			));
			
			include_once( get_template_directory() . '/admin/customizer/posts_slider.php' );
			
		// Color scheme
			$wp_customize->get_section( 'colors' )->title = esc_html__( 'Daze color scheme', 'daze' );
			$wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Header text color', 'daze' );
			$wp_customize->get_control( 'background_color' )->label = esc_html__( 'Background color', 'daze' );			
			$wp_customize->remove_section( 'background_image' );
			$wp_customize->remove_section( 'header_image' );
			
			include_once( get_template_directory() . '/admin/customizer/color_scheme.php' );
			
		// Social profiles and sharing options
			$wp_customize->add_section( 'daze_social_sharing', array(
				'title'    => esc_html__( 'Daze social', 'daze' ),
				'priority' => 8
			));
			
			include_once( get_template_directory() . '/admin/customizer/social_sharing.php' );
			
		// Sticky Banner
			$wp_customize->add_section( 'daze_sticky_banner', array(
				'title'    => esc_html__( 'Daze sticky banner', 'daze' ),
				'priority' => 9
			));
			
			include_once( get_template_directory() . '/admin/customizer/sticky_banner.php' );	
			
		// Page 404
			$wp_customize->add_section( 'daze_page_404', array(
				'title'    => esc_html__( 'Daze page 404', 'daze' ),
				'priority' => 10
			));
			
			include_once( get_template_directory() . '/admin/customizer/page_404.php' );
			
		// Optimization
			$wp_customize->add_section( 'daze_opt', array(
				'title'    => esc_html__( 'Daze optimization', 'daze' ),
				'priority' => 11
			));
			
			include_once( get_template_directory() . '/admin/customizer/optimization.php' );			
		}
	endif;
 
	add_action( 'customize_register', 'daze_customizer' );	

/*	Callbacks
=============== */
// Posts Slider
	if ( !function_exists( 'daze_control_nwps' ) ) :
		function daze_control_nwps($control) {
			if( $control->manager->get_setting( 'daze_nwps_on' )->value() === true ) {
				return true;
			}
			return false;
		}
	endif;
	
// Blog controls
	if ( !function_exists( 'daze_control_standard_list' ) ) :
		function daze_control_standard_list($control) {
			if( "standard-list" === $control->manager->get_setting( 'daze_blog_layout_type' )->value() ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_masonry_list' ) ) :
		function daze_control_masonry_list($control) {
			if( "masonry" === $control->manager->get_setting( 'daze_blog_layout_type' )->value() || "masonry-mini" === $control->manager->get_setting( 'daze_blog_layout_type' )->value() ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_sidebar' ) ) :
		function daze_control_sidebar($control) {
			$blog_layout_width	= $control->manager->get_setting( 'daze_blog_layout_width' )->value();
			$blog_layout_type	= $control->manager->get_setting( 'daze_blog_layout_type' )->value();
			if( !( "full-width" === $blog_layout_width && "standard-list" != $blog_layout_type ) ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_blog_cols_narrow' ) ) :
		function daze_control_blog_cols_narrow($control) {
			$blog_layout_type	= $control->manager->get_setting( 'daze_blog_layout_type' )->value();
			$blog_layout_width	= $control->manager->get_setting( 'daze_blog_layout_width' )->value();
			$include_sidebar	= $control->manager->get_setting( 'daze_include_sidebar' )->value();
			if( ( "masonry" === $blog_layout_type || "masonry-mini" === $blog_layout_type ) && "narrow" === $blog_layout_width && false === $include_sidebar ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_cols_full' ) ) :
		function daze_control_cols_full($control) {
			$blog_layout_type	= $control->manager->get_setting( 'daze_blog_layout_type' )->value();
			$blog_layout_width	= $control->manager->get_setting( 'daze_blog_layout_width' )->value();
			if( ( $blog_layout_type === "masonry" || $blog_layout_type === "masonry-mini" ) && "full-width" === $blog_layout_width ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_first_post' ) ) :
		function daze_control_first_post($control) {			
			$blog_layout_type	= $control->manager->get_setting( 'daze_blog_layout_type' )->value();
			$blog_layout_width	= $control->manager->get_setting( 'daze_blog_layout_width' )->value();
			if( !( ( $blog_layout_type === "masonry" || $blog_layout_type === "masonry-mini" ) && "full-width" === $blog_layout_width ) ) {
				return true;
			}
			return false;
		}
	endif;
	
// Tag controls	
	if ( !function_exists( 'daze_control_tag_layout_type' ) ) :
		function daze_control_tag_layout_type($control) {
			if( true === $control->manager->get_setting( 'daze_custom_tag_layout' )->value() ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_tag_masonry_list' ) ) :
		function daze_control_tag_masonry_list($control) {
			$tag_custom			= $control->manager->get_setting( 'daze_custom_tag_layout' )->value();
			$tag_layout_type	= $control->manager->get_setting( 'daze_tag_layout_type' )->value();
			if( true === $tag_custom && "standard-list" != $tag_layout_type ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_tag_cols_narrow' ) ) :
		function daze_control_tag_cols_narrow($control) {
			$tag_custom				= $control->manager->get_setting( 'daze_custom_tag_layout' )->value();
			$tag_layout_type		= $control->manager->get_setting( 'daze_tag_layout_type' )->value();
			$tag_layout_width		= $control->manager->get_setting( 'daze_tag_layout_width' )->value();
			$tag_include_sidebar	= $control->manager->get_setting( 'daze_tag_include_sidebar' )->value();
			if( $tag_custom && "standard-list" != $tag_layout_type && "narrow" === $tag_layout_width && false === $tag_include_sidebar ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_tag_cols_full' ) ) :
		function daze_control_tag_cols_full($control) {
			$tag_custom			= $control->manager->get_setting( 'daze_custom_tag_layout' )->value();
			$tag_layout_type	= $control->manager->get_setting( 'daze_tag_layout_type' )->value();
			$tag_layout_width	= $control->manager->get_setting( 'daze_tag_layout_width' )->value();
			if( $tag_custom && "full-width" === $tag_layout_width && "standard-list" != $tag_layout_type ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_tag_sidebar' ) ) :
		function daze_control_tag_sidebar($control) {
			$tag_custom			= $control->manager->get_setting( 'daze_custom_tag_layout' )->value();
			$tag_layout_width	= $control->manager->get_setting( 'daze_tag_layout_width' )->value();
			$tag_layout_type	= $control->manager->get_setting( 'daze_tag_layout_type' )->value();
			if( $tag_custom && !( "full-width" === $tag_layout_width && "standard-list" != $tag_layout_type ) ) {
				return true;
			}
			return false;
		}
	endif;
	
// Date controls
	if ( !function_exists( 'daze_control_date_layout_type' ) ) :
		function daze_control_date_layout_type($control) {
			if( true === $control->manager->get_setting( 'daze_custom_date_layout' )->value() ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_date_masonry_list' ) ) :
		function daze_control_date_masonry_list($control) {
			$date_custom		= $control->manager->get_setting( 'daze_custom_date_layout' )->value();
			$date_layout_type	= $control->manager->get_setting( 'daze_date_layout_type' )->value();
			if( true === $date_custom && "standard-list" != $date_layout_type ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_date_cols_narrow' ) ) :
		function daze_control_date_cols_narrow($control) {
			$date_custom			= $control->manager->get_setting( 'daze_custom_date_layout' )->value();
			$date_layout_type		= $control->manager->get_setting( 'daze_date_layout_type' )->value();
			$date_layout_width		= $control->manager->get_setting( 'daze_date_layout_width' )->value();
			$date_include_sidebar	= $control->manager->get_setting( 'daze_date_include_sidebar' )->value();
			if( $date_custom && "standard-list" != $date_layout_type && "narrow" === $date_layout_width && false === $date_include_sidebar ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_date_cols_full' ) ) :
		function daze_control_date_cols_full($control) {
			$date_custom		= $control->manager->get_setting( 'daze_custom_date_layout' )->value();
			$date_layout_type	= $control->manager->get_setting( 'daze_date_layout_type' )->value();
			$date_layout_width	= $control->manager->get_setting( 'daze_date_layout_width' )->value();
			if( $date_custom && "full-width" === $date_layout_width && "standard-list" != $date_layout_type ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_date_sidebar' ) ) :
		function daze_control_date_sidebar($control) {
			$date_custom		= $control->manager->get_setting( 'daze_custom_date_layout' )->value();
			$date_layout_width	= $control->manager->get_setting( 'daze_date_layout_width' )->value();
			$date_layout_type	= $control->manager->get_setting( 'daze_date_layout_type' )->value();
			if( $date_custom && !( "full-width" === $date_layout_width && "standard-list" != $date_layout_type ) ) {
				return true;
			}
			return false;
		}
	endif;
	
// Author controls
	if ( !function_exists( 'daze_control_author_layout_type' ) ) :
		function daze_control_author_layout_type($control) {
			if( true === $control->manager->get_setting( 'daze_custom_author_layout' )->value() ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_author_masonry_list' ) ) :
		function daze_control_author_masonry_list($control) {
			$author_custom		= $control->manager->get_setting( 'daze_custom_author_layout' )->value();
			$author_layout_type	= $control->manager->get_setting( 'daze_author_layout_type' )->value();
			if( true === $author_custom && "standard-list" != $author_layout_type ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_author_cols_narrow' ) ) :
		function daze_control_author_cols_narrow($control) {
			$author_custom			= $control->manager->get_setting( 'daze_custom_author_layout' )->value();
			$author_layout_type		= $control->manager->get_setting( 'daze_author_layout_type' )->value();
			$author_layout_width	= $control->manager->get_setting( 'daze_author_layout_width' )->value();
			$author_include_sidebar	= $control->manager->get_setting( 'daze_author_include_sidebar' )->value();
			if( $author_custom && "standard-list" != $author_layout_type && "narrow" === $author_layout_width && false === $author_include_sidebar ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_author_cols_full' ) ) :
		function daze_control_author_cols_full($control) {
			$author_custom			= $control->manager->get_setting( 'daze_custom_author_layout' )->value();
			$author_layout_type		= $control->manager->get_setting( 'daze_author_layout_type' )->value();
			$author_layout_width	= $control->manager->get_setting( 'daze_author_layout_width' )->value();
			if( $author_custom && "full-width" === $author_layout_width && "standard-list" != $author_layout_type ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_author_sidebar' ) ) :
		function daze_control_author_sidebar($control) {
			$author_custom			= $control->manager->get_setting( 'daze_custom_author_layout' )->value();
			$author_layout_width	= $control->manager->get_setting( 'daze_author_layout_width' )->value();
			$author_layout_type		= $control->manager->get_setting( 'daze_author_layout_type' )->value();
			if( $author_custom && !( "full-width" === $author_layout_width && "standard-list" != $author_layout_type ) ) {
				return true;
			}
			return false;
		}
	endif;
	
// Category controls
	if ( !function_exists( 'daze_control_category_layout_type' ) ) :
		function daze_control_category_layout_type($control) {
			if( true === $control->manager->get_setting( 'daze_custom_category_layout' )->value() ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_category_masonry_list' ) ) :
		function daze_control_category_masonry_list($control) {
			$category_custom		= $control->manager->get_setting( 'daze_custom_category_layout' )->value();
			$category_layout_type	= $control->manager->get_setting( 'daze_category_layout_type' )->value();
			if( true === $category_custom && "standard-list" != $category_layout_type ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_category_cols_narrow' ) ) :
		function daze_control_category_cols_narrow($control) {
			$category_custom			= $control->manager->get_setting( 'daze_custom_category_layout' )->value();
			$category_layout_type		= $control->manager->get_setting( 'daze_category_layout_type' )->value();
			$category_layout_width		= $control->manager->get_setting( 'daze_category_layout_width' )->value();
			$category_include_sidebar	= $control->manager->get_setting( 'daze_category_include_sidebar' )->value();
			if( $category_custom && "standard-list" != $category_layout_type && "narrow" === $category_layout_width && false === $category_include_sidebar ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_category_cols_full' ) ) :
		function daze_control_category_cols_full($control) {
			$category_custom		= $control->manager->get_setting( 'daze_custom_category_layout' )->value();
			$category_layout_type	= $control->manager->get_setting( 'daze_category_layout_type' )->value();
			$category_layout_width	= $control->manager->get_setting( 'daze_category_layout_width' )->value();
			if( $category_custom && "full-width" === $category_layout_width && "standard-list" != $category_layout_type ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_category_sidebar' ) ) :
		function daze_control_category_sidebar($control) {
			$category_custom			= $control->manager->get_setting( 'daze_custom_category_layout' )->value();
			$category_layout_width		= $control->manager->get_setting( 'daze_category_layout_width' )->value();
			$category_layout_type		= $control->manager->get_setting( 'daze_category_layout_type' )->value();
			if( $category_custom && !( "full-width" === $category_layout_width && "standard-list" != $category_layout_type ) ) {
				return true;
			}
			return false;
		}
	endif;
	
// Search controls
	if ( !function_exists( 'daze_control_search_layout_type' ) ) :
		function daze_control_search_layout_type($control) {
			if( true === $control->manager->get_setting( 'daze_custom_search_layout' )->value() ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_search_masonry_list' ) ) :
		function daze_control_search_masonry_list($control) {
			$search_custom		= $control->manager->get_setting( 'daze_custom_search_layout' )->value();
			$search_layout_type	= $control->manager->get_setting( 'daze_search_layout_type' )->value();
			if( true === $search_custom && "standard-list" != $search_layout_type ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_search_cols_narrow' ) ) :
		function daze_control_search_cols_narrow($control) {
			$search_custom			= $control->manager->get_setting( 'daze_custom_search_layout' )->value();
			$search_layout_type		= $control->manager->get_setting( 'daze_search_layout_type' )->value();
			$search_layout_width	= $control->manager->get_setting( 'daze_search_layout_width' )->value();
			$search_include_sidebar	= $control->manager->get_setting( 'daze_search_include_sidebar' )->value();
			if( $search_custom && "standard-list" != $search_layout_type && "narrow" === $search_layout_width && false === $search_include_sidebar ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_search_cols_full' ) ) :
		function daze_control_search_cols_full($control) {
			$search_custom			= $control->manager->get_setting( 'daze_custom_search_layout' )->value();
			$search_layout_type		= $control->manager->get_setting( 'daze_search_layout_type' )->value();
			$search_layout_width	= $control->manager->get_setting( 'daze_search_layout_width' )->value();
			if( $search_custom && "full-width" === $search_layout_width && "standard-list" != $search_layout_type ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_search_sidebar' ) ) :
		function daze_control_search_sidebar($control) {
			$search_custom			= $control->manager->get_setting( 'daze_custom_search_layout' )->value();
			$search_layout_width	= $control->manager->get_setting( 'daze_search_layout_width' )->value();
			$search_layout_type		= $control->manager->get_setting( 'daze_search_layout_type' )->value();
			if( $search_custom && !( "full-width" === $search_layout_width && "standard-list" != $search_layout_type ) ) {
				return true;
			}
			return false;
		}
	endif;
	
// Other archives controls
	if ( !function_exists( 'daze_control_archives_layout_type' ) ) :
		function daze_control_archives_layout_type($control) {
			if( true === $control->manager->get_setting( 'daze_custom_archives_layout' )->value() ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_archives_masonry_list' ) ) :
		function daze_control_archives_masonry_list($control) {
			$archives_custom		= $control->manager->get_setting( 'daze_custom_archives_layout' )->value();
			$archives_layout_type	= $control->manager->get_setting( 'daze_archives_layout_type' )->value();
			if( true === $archives_custom && "standard-list" != $archives_layout_type ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_archives_cols_narrow' ) ) :
		function daze_control_archives_cols_narrow($control) {
			$archives_custom			= $control->manager->get_setting( 'daze_custom_archives_layout' )->value();
			$archives_layout_type		= $control->manager->get_setting( 'daze_archives_layout_type' )->value();
			$archives_layout_width		= $control->manager->get_setting( 'daze_archives_layout_width' )->value();
			$archives_include_sidebar	= $control->manager->get_setting( 'daze_archives_include_sidebar' )->value();
			if( $archives_custom && "standard-list" != $archives_layout_type && "narrow" === $archives_layout_width && false === $archives_include_sidebar ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_archives_cols_full' ) ) :
		function daze_control_archives_cols_full($control) {
			$archives_custom		= $control->manager->get_setting( 'daze_custom_archives_layout' )->value();
			$archives_layout_type	= $control->manager->get_setting( 'daze_archives_layout_type' )->value();
			$archives_layout_width	= $control->manager->get_setting( 'daze_archives_layout_width' )->value();
			if( $archives_custom && "full-width" === $archives_layout_width && "standard-list" != $archives_layout_type ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_archives_sidebar' ) ) :
		function daze_control_archives_sidebar($control) {
			$archives_custom			= $control->manager->get_setting( 'daze_custom_archives_layout' )->value();
			$archives_layout_width		= $control->manager->get_setting( 'daze_archives_layout_width' )->value();
			$archives_layout_type		= $control->manager->get_setting( 'daze_archives_layout_type' )->value();
			if( $archives_custom && !( "full-width" === $archives_layout_width && "standard-list" != $archives_layout_type ) ) {
				return true;
			}
			return false;
		}
	endif;

// Special Boxes
	if ( !function_exists( 'daze_control_bannerad_box' ) ) :
		function daze_control_bannerad_box($control) {
			if( $control->manager->get_setting( 'daze_inc_bannerad_box' )->value() === true ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_bannerad_2' ) ) :
		function daze_control_bannerad_2($control) {
			$inc_bannerad = $control->manager->get_setting( 'daze_inc_bannerad_box' )->value();
			$inc_bannerad_2 = $control->manager->get_setting( 'daze_inc_bannerad_2' )->value();
			if( true === $inc_bannerad && true === $inc_bannerad_2 ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_bannerad_3' ) ) :
		function daze_control_bannerad_3($control) {
			$inc_bannerad = $control->manager->get_setting( 'daze_inc_bannerad_box' )->value();
			$inc_bannerad_2 = $control->manager->get_setting( 'daze_inc_bannerad_2' )->value();
			$inc_bannerad_3 = $control->manager->get_setting( 'daze_inc_bannerad_3' )->value();
			if( true === $inc_bannerad && true === $inc_bannerad_2 && true === $inc_bannerad_3 ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_bannerad_4' ) ) :
		function daze_control_bannerad_4($control) {
			$inc_bannerad = $control->manager->get_setting( 'daze_inc_bannerad_box' )->value();
			$inc_bannerad_2 = $control->manager->get_setting( 'daze_inc_bannerad_2' )->value();
			$inc_bannerad_3 = $control->manager->get_setting( 'daze_inc_bannerad_3' )->value();
			$inc_bannerad_4 = $control->manager->get_setting( 'daze_inc_bannerad_4' )->value();
			if( true === $inc_bannerad && true === $inc_bannerad_2 && true === $inc_bannerad_3 && true === $inc_bannerad_4 ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_bannerad_5' ) ) :
		function daze_control_bannerad_5($control) {
			$inc_bannerad = $control->manager->get_setting( 'daze_inc_bannerad_box' )->value();
			$inc_bannerad_2 = $control->manager->get_setting( 'daze_inc_bannerad_2' )->value();
			$inc_bannerad_3 = $control->manager->get_setting( 'daze_inc_bannerad_3' )->value();
			$inc_bannerad_4 = $control->manager->get_setting( 'daze_inc_bannerad_4' )->value();
			$inc_bannerad_5 = $control->manager->get_setting( 'daze_inc_bannerad_5' )->value();
			if( true === $inc_bannerad && true === $inc_bannerad_2 && true === $inc_bannerad_3 && true === $inc_bannerad_4 && true === $inc_bannerad_5 ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_social_box' ) ) :
		function daze_control_social_box($control) {
			if( $control->manager->get_setting( 'daze_inc_social_box' )->value() === true ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_top_posts' ) ) :
		function daze_control_top_posts($control) {
			if( $control->manager->get_setting( 'daze_inc_top_posts_box' )->value() === true ) {
				return true;
			}
			return false;
		}
	endif;
	
	if ( !function_exists( 'daze_control_latest_comments_box' ) ) :
		function daze_control_latest_comments_box($control) {
			if( $control->manager->get_setting( 'daze_inc_latest_comments_box' )->value() === true ) {
				return true;
			}
			return false;
		}
	endif;	

/*	Sanitization
================== */
// Sanitize checkbox
	if ( !function_exists( 'daze_sanitize_checkbox' ) ) :
		function daze_sanitize_checkbox( $input ) {
			if ( $input === true ) {
				return true;
			} else {
				return false;
			}
		}
	endif;	

// Sanitize dropdown selection & Radio buttons
	if( !function_exists( 'daze_sanitize_choices' ) ) :
		function daze_sanitize_choices( $input, $setting ) {
			global $wp_customize;
		 
			$control = $wp_customize->get_control( $setting->id );
		 
			if ( array_key_exists( $input, $control->choices ) ) {
				return $input;
				
			} else {
				return $setting->default;
			}
		}
	endif;

/*	Dynamic styles
==================== */
	include_once( get_template_directory() . '/admin/customizer/dynamic-styles.php' );
	

/*	Customizer scripts & styles
================================= */	
	if ( !function_exists( 'daze_customizer_styles' ) ) :
		function daze_customizer_styles() {
			wp_enqueue_style( 'daze_customizer', get_template_directory_uri() . '/admin/customizer/css/customizer.css' );
		}
	endif;
	
	add_action( 'customize_controls_print_styles', 'daze_customizer_styles' );
	
	function daze_customizer_enqueue() {
		wp_enqueue_script( 'daze_customizer', get_template_directory_uri() . '/admin/customizer/js/customizer.js', array( 'jquery', 'customize-controls' ), false, true );
	}
	add_action( 'customize_controls_enqueue_scripts', 'daze_customizer_enqueue' );
	
	
	add_action( 'customize_preview_init', 'daze_customizer_preview' );
	
	if( !function_exists( 'daze_customizer_preview' ) ) :
		function daze_customizer_preview() {
			wp_enqueue_script(
				'daze_customizer_preview',
				get_template_directory_uri() . '/admin/customizer/js/customizer-preview.js',
				array( 'customize-preview', 'jquery' ),
				false,
				true
			);
		}
	endif;
?>