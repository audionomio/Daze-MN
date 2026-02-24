<?php
/* ===============================================
	Welcome page with description
	Daze - Premium WordPress Theme, by NordWood
================================================== */
	
	if ( ! function_exists( 'daze_welcome_screen' ) ) :
		function daze_welcome_screen() {
			add_theme_page(
				esc_html__( 'Welcome to Daze', 'daze' ),
				esc_html__( 'Welcome to Daze', 'daze' ),
				'read',
				'daze-welcome',
				'daze_welcome_page'
			);
		}
	endif;
	
	add_action( 'admin_menu', 'daze_welcome_screen' );
	
	function daze_welcome_page() {
	?>
		<div class="daze-welcome-wrapper clearfix">
			<div class="daze-welcome-img">
				<img src="<?php echo get_template_directory_uri(); ?>/admin/welcome/img/daze-4-0.jpg" alt="Daze 4.1" title="Daze 4.1" />
			</div>
			
			<div class="daze-welcome-content">
				<div class="daze-welcome-header">
					<h2><?php esc_html_e( 'Welcome to Daze 4.1', 'daze' ); ?></h2>
					<h6><a href="https://themeforest.net/user/nordwood/portfolio" target="_blank"><?php esc_html_e( 'By NordWood Themes', 'daze' ); ?></a></h6>
				</div>
				
				<div class="daze-welcome-section">
					<h6><?php
						$current_user = wp_get_current_user();
						$user_name = $current_user->display_name;
						
						printf(
							'%1$s, %2$s!',
							esc_html__( 'Hello', 'daze' ),
							esc_html( $user_name )
						);
					?></h6>
				
					<p><?php esc_html_e( 'We added this panel so you can have a quick overview on theme new options. We hope you\'re gonna enjoy Daze even more now :)', 'daze' ); ?></p>				
					<p><?php esc_html_e( 'So, here\'s what\'s new since Daze 3.0:', 'daze' ); ?></p>
				</div>
				
				<div class="daze-welcome-section">
					<h3><?php esc_html_e( 'Daze 4.1', 'daze' ); ?></h3>
				</div>
				
				<div class="daze-welcome-section">					
					<ul>
						<li><?php esc_html_e( 'Daze Featured Area fields are moved down below the main editor, so they can work with the new WordPress editor.', 'daze' ); ?></li>
						<li><?php esc_html_e( 'Search button in top bar is now optional for mobile views as well. This option can be found in Customizer, under', 'daze' ); $query_opt['autofocus[control]'] = 'daze_show_search_in_top_mobile'; ?> <a href="<?php echo esc_url( add_query_arg( $query_opt, admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Daze header & top bar section', 'daze' ); ?></a></li>
						<li><?php esc_html_e( 'Fixed: Spare gap in page header, when the page title is hidden.', 'daze' ); ?></li>
						<li><?php esc_html_e( 'Minor security fixes in widgets and Popout pages', 'daze' ); ?></li>
					</ul>
				</div>
				
				<div class="daze-welcome-section">
					<h3><?php esc_html_e( 'Daze 4.0', 'daze' ); ?></h3>
				</div>
				
				<div class="daze-welcome-section">
					<h3><?php esc_html_e( 'Authors', 'daze' ); ?></h3>
					
					<p><?php esc_html_e( 'Each user can now have a custom image uploaded via', 'daze' ); ?> <a href="<?php echo admin_url( 'profile.php' ); ?>" target="_blank"><?php esc_html_e( 'User profile panel', 'daze' ); ?></a> <?php esc_html_e( 'to appear instead of default WP avatar. You will also find additional options to display the image near author\'s name and/or on author\'s archive page.', 'daze' ); ?></p>
				</div>
				
				<div class="daze-welcome-section">
					<h3><?php esc_html_e( 'Site optimization', 'daze' ); ?></h3>
					
					<p><?php esc_html_e( 'We added a few options that can be of great help for decreasing the site loading time and you can find them in the new Customizer\'s section, named', 'daze' ); $query_opt['autofocus[control]'] = 'daze_opt_note'; ?> <a href="<?php echo esc_url( add_query_arg( $query_opt, admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Daze optimization', 'daze' ); ?></a> <?php esc_html_e( 'To get more useful info on how to improve site performance, please read the documentation provided with Daze.', 'daze' ); ?></p>
				</div>
				
				<div class="daze-welcome-section">
					<h3><?php esc_html_e( 'Other improvements', 'daze' ); ?></h3>
					
					<ul>
						<li><?php esc_html_e( 'Option to hide likes and comments on Instagram widgets', 'daze' ); ?></li>
						<li><?php esc_html_e( 'Removed dynamic inline styles, when they match the default values', 'daze' ); ?></li>
						<li><?php esc_html_e( 'Modified category/tag description filters, that were causing issues with some page builders', 'daze' ); ?></li>
						<li><?php esc_html_e( 'Updated scripts for Facebook SDK, Masonry, ImagesLoaded and Slick slider assets.', 'daze' ); ?></li>
					</ul>
				</div>
				
				<div class="daze-welcome-section">
					<h3><?php esc_html_e( 'Daze 3.0.1', 'daze' ); ?></h3>
					
					<ul>
						<li><?php esc_html_e( 'Instagram widgets adjusted to be compatible with the recent Instagram update', 'daze' ); ?></li>
					</ul>
				</div>
				
				<div class="daze-welcome-section">
					<h3><?php esc_html_e( 'Daze 3.0', 'daze' ); ?></h3>
				</div>
				
				<div class="daze-welcome-section">
					<h3><?php esc_html_e( 'Six additional sidebars', 'daze' ); ?></h3>
				
					<p><?php esc_html_e( 'More sidebar areas for your ads, or widgets per choice! One of those is "Special" - check out the following features ;)', 'daze' ); ?></p>
				</div>
				
				<div class="daze-welcome-section">
					<h3><?php esc_html_e( 'Special Widgets', 'daze' ); ?></h3>
					
					<p><?php esc_html_e( 'Two widgets are new ("Daze popout widget" and "Daze social widget"), but many became "special".', 'daze' ); ?></p>
					<p><?php esc_html_e( 'Our "Special Boxes" for masonry layout are now extended to support any number of Special Widgets! Find out more about this in the', 'daze' ); ?> <a href="<?php echo admin_url( 'widgets.php' ); ?>" target="_blank"><?php esc_html_e( 'Widgets panel', 'daze' ); ?></a>.</p>
				</div>
				
				<div class="daze-welcome-section">
					<h3><?php esc_html_e( 'Extended set of share icons', 'daze' ); ?></h3>
					
					<p><?php esc_html_e( 'Now you can choose which sharing buttons you want to show on posts and there are more than 20 networks available in the ', 'daze' ); $query_soc['autofocus[control]'] = 'daze_sharing_links'; ?> <a href="<?php echo esc_url( add_query_arg( $query_soc, admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Daze social section', 'daze' ); ?></a>.</p>
				</div>
				
				<div class="daze-welcome-section">
					<h3><?php esc_html_e( 'Daze Custom Login Page plugin', 'daze' ); ?></h3>
					
					<p><?php esc_html_e( 'Yep, WP login page no longer has to be so dull. Select your own background image and colors, and paint it as you like. All the controls are now available in the Customizer - if you have this plugin activated, the section will show up.', 'daze' ); ?></p>
				</div>
				
				<div class="daze-welcome-section">
					<h3><?php esc_html_e( 'Minor additional options', 'daze' ); ?></h3>
					
					<ul>
						<li><?php esc_html_e( 'Hide page title (Edit Page)', 'daze' ); ?></li>
						<li><?php esc_html_e( 'Link to author\'s archive on Daze author widget', 'daze' ); ?></li>
						<li><?php esc_html_e( 'Close sticky banner (Customizer -> Daze Sticky Banner)', 'daze' ); ?></li>
					</ul>
				</div>
				
				<div class="daze-welcome-section">
					<h3><?php esc_html_e( 'Fixed issues', 'daze' ); ?></h3>
					
					<ul>
						<li><?php esc_html_e( 'Mobile menu overlay being cut at the bottom', 'daze' ); ?></li>
						<li><?php esc_html_e( 'Padding in Popular/Latest special box', 'daze' ); ?></li>
						<li><?php esc_html_e( 'The author box (on single posts) appearing while its checkbox is turned off', 'daze' ); ?></li>
					</ul>
				</div>
				
				<div class="daze-welcome-section clearfix">
					<div class="nw-promo-img">
						<a href="https://creativemarket.com/NordWood/2052844-DAZE-Social-Media-Designs" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/admin/welcome/img/daze-social-pack.jpg" alt="Daze Social Pack" title="Daze Social Pack" /></a>
					</div>
					
					<div class="nw-promo-content">
						<h3><?php esc_html_e( 'Social Media Pack now compatible with Daze', 'daze' ); ?></h3>
						
						<p><?php esc_html_e( 'Want to run a marketing campaign for your brand, or promote your recent posts?', 'daze' ); ?></p>
						
						<p><a href="https://creativemarket.com/NordWood/2052844-DAZE-Social-Media-Designs" target="_blank"><?php esc_html_e( 'Daze Social Media', 'daze' ); ?></a> <?php esc_html_e( 'comes with an outstanding pack of banners for sales and discounts, new arrivals, event announcements, quotes, galleries and more!', 'daze' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	<?php
	}	
	
	add_action( 'after_setup_theme', 'daze_theme_on_update' );
	
	function daze_theme_on_update() {
		$current_version = wp_get_theme()->get( 'Version' );
		$old_version = get_option( 'daze_theme_version' );

		if ( $old_version !== $current_version ) {
			update_option( 'daze_theme_version', $current_version );
			
			wp_redirect( admin_url( 'themes.php?page=daze-welcome' ) );
		}
	}
?>