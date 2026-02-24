<?php
/* ==============================================
	Site header template
	Daze - Premium WordPress Theme, by NordWood
================================================= */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<div class="mobile top-bar clearfix">
		<?php
			daze_show_site_logo_mobile();
			
			if ( get_theme_mod( 'daze_show_search_in_top_mobile', true ) ) {
				daze_search_button( false );
			}
		?>
		
		<span class="menu-button"><?php
			echo daze_get_svg_menu_bar();
			echo daze_get_svg_close_menu();
		?></span>
		
		<?php get_search_form(); ?>
	
		<div class="menu-overlay inactive">			
		<?php
			if( has_nav_menu( 'main' ) ) :
		?>
			<nav class="main-menu clearfix" aria-label="<?php esc_attr_e( 'Main Menu', 'daze' ); ?>">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'main',
					'container'     => '',
				 ) );
			?>
				<span class="v-line"></span>
			</nav>			
		<?php
			endif;
		?><!-- .mobile .main-menu -->			
						
		<?php
			if( get_theme_mod( 'daze_social_in_topbar' ) ) :
		?>
		<div class="social"><?php
			echo daze_get_links_2_social_profiles();
		?></div>
		<?php
			endif;
		?><!-- .mobile .social -->
			
		<?php
			if( has_nav_menu( 'top' ) ) :
		?>
		<nav class="top-menu" aria-label="<?php esc_attr_e( 'Top Menu', 'daze' ); ?>">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'top',
					'container'     => '',
				));
			?>
		</nav>
		<?php
			endif;
		?><!-- .mobile .top-menu -->
						
		<?php
			if( get_theme_mod( 'daze_copyright' ) ) :
		?>
			<div class="copyright"><?php
				echo esc_html( get_theme_mod( 'daze_copyright' ) );
			?></div>
		<?php
			endif;
		?><!-- .mobile .copyright -->
		</div>
	</div><!-- .mobile.top-bar -->
	
	<?php 
		$search_button_top = get_theme_mod( 'daze_show_search_in_top', 1 );
		$search_button_menu = get_theme_mod( 'daze_show_search_in_menu', false );
		$social_links_top = get_theme_mod( 'daze_social_in_topbar', 1 );
		$show_tagline = get_theme_mod( 'daze_show_tagline', false ) && get_bloginfo('description');
		
		$total = 0;
		
		if( has_nav_menu( 'top' ) || ( get_bloginfo('description') && $show_tagline ) || $search_button_top || $search_button_menu || $social_links_top ) :		
			if( has_nav_menu( 'top' ) ) {
				$total++;
			}
			
			if( $show_tagline ) {
				$total++;
			}
			
			if( $search_button_top || $social_links_top ) {
				$total++;
			}
	?>
	<div class="desktop top-bar clearfix total-<?php echo absint( $total ); ?>">
	<?php
		if( has_nav_menu( 'top' ) ) :
	?>
		<nav class="top-menu" aria-label="<?php esc_attr_e( 'Top Menu', 'daze' ); ?>"><?php
			wp_nav_menu( array(
				'theme_location' => 'top',
				'container'     => '',
			));
		?></nav>
	<?php
		endif;
	?><!-- .desktop .top-menu -->		
		
	<?php
		if( $show_tagline ) :
	?>
		<div class="tagline"><?php
			echo get_bloginfo('description', 'display');
		?></div>
	<?php
		endif;
	?><!-- .desktop .tagline -->
		
	<?php		
		if( $search_button_top || $social_links_top ) :
	?>
		<div class="right"><?php
			if( get_theme_mod( 'daze_show_search_in_top', 1 ) ) {
				daze_search_button();
			}
			
			if( get_theme_mod( 'daze_social_in_topbar', 1 ) ) :
		?>
			<div class="social"><?php
				echo daze_get_links_2_social_profiles(true, false);
			?></div>
		<?php
			endif;
		?></div><!-- .desktop .right -->
	<?php	
		endif;
		get_search_form();	
	?>		
	</div><!-- .desktop.top-bar -->
	<?php endif; ?>
	
	<div id="central-wrapper" class="clearfix">
		<div id="site-header" <?php daze_site_header_class(); ?>>
		<?php
		// Get the sidebar 'site_header' if it has active widgets
			if ( is_active_sidebar( 'sidebar-site_header' )  ) {
		?>
			<div id="sidebar-site_header" class="sidebar"><?php dynamic_sidebar( 'sidebar-site_header' ); ?></div>
		<?php
			}
		?>
			<div class="content-wrapper clearfix"><?php
				$logo_position = get_theme_mod( 'daze_logo_position', 'logo-above-menu' );
				
				if( 'logo-above-menu' === $logo_position || 'logo-left-to-menu' === $logo_position ) {
					daze_show_site_logo();
				}
				
				if( has_nav_menu( 'main' ) ) :
				?>
				<nav class="main-menu clearfix" aria-label="<?php esc_attr_e( 'Main Menu', 'daze' ); ?>"><?php
					wp_nav_menu( array(
						'theme_location' => 'main',
						'container'     => '',
						'menu_class' => 'menu clearfix'
					));
					
					if( get_theme_mod( 'daze_show_search_in_menu' ) ) {
						daze_search_button();
					}
				?></nav><!-- main menu -->
				<?php
				endif;
				
				if( 'logo-bellow-menu' === $logo_position || 'logo-right-to-menu' === $logo_position ) {
					daze_show_site_logo();
				}
			?></div>
		</div><!-- #site-header -->
		
		<?php
		$slider_on = get_theme_mod( 'daze_nwps_on', false );
		$slider_on_page = false;
		
		if( is_page() ) {
			if( 'show-nwps' === daze_pages_get_meta( 'daze_pages_show_nwps', false ) ) {
				$slider_on_page = true;
				
			} else {
				$slider_on_page = false;
			}
		}
		
		if( $slider_on && ( is_home() || true === $slider_on_page ) ) {
			$slider_type = get_theme_mod( 'daze_nwps_type', 'columns' );
		?>
		<div id="nwps"><div class="nwps-wrapper">
			<div class="nwps-loader"></div>
			<?php
				( 'columns' === $slider_type ) ? daze_post_slider_columns() : daze_post_slider_simple();
			?>
		</div></div>
		<?php
		}
		
	?>