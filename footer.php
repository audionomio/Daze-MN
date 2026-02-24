<?php
/* ==============================================
	Footer template
	Daze - Premium WordPress Theme, by NordWood
================================================= */
?>
	</div><!-- .central-wrapper -->	
<?php
// Sticky banner
	if( $sticky_banner = get_theme_mod( 'daze_sticky_banner_img' ) ) {
	?>
	<div class="sticky-banner">
	<?php
		if( $sticky_banner_link = get_theme_mod( 'daze_sticky_banner_link' ) ) {
	?>
		<a href="<?php echo esc_url( $sticky_banner_link ); ?>" target="_blank"><?php
			echo daze_get_giffy_img_by_url( $sticky_banner );
		?></a>
	<?php
			
		} else {
			echo daze_get_giffy_img_by_url( $sticky_banner );
		}
		
		if ( true === get_theme_mod( 'daze_sticky_banner_close', false ) ) {
			printf(
				'<div class="close">%s</div>',
				daze_get_svg_close()
			);
		}
	?>
	</div>
<?php
	}
?>
	<div id="site-footer"><?php
	// Get the sidebar '2' (Footer Instagram area) if it has active widgets
		if ( is_active_sidebar( 'sidebar-2' )  ) :
			dynamic_sidebar( 'sidebar-2' );
		endif;
		
		$social_in_footer = get_theme_mod( 'daze_social_in_footer' );
		$copyright = get_theme_mod( 'daze_copyright' );
			
		if( $social_in_footer ) :
		?>
		<div class="social"><div class="content-wrapper"><?php
			echo daze_get_links_2_social_profiles( false, true );
		?></div></div>
		<?php
		endif;
		
	// Get the sidebar '2' (Footer Instagram area) if it has active widgets
		if ( is_active_sidebar( 'sidebar-site_footer' )  ) {
	?>
		<div id="sidebar-site_footer" class="sidebar"><?php dynamic_sidebar( 'sidebar-site_footer' ); ?></div>
	<?php
		}
		
		if( $copyright ) :		
			if( is_active_sidebar( 'sidebar-site_footer' ) || $social_in_footer ) {
				echo '<div class="h-line"></div>';
			}
		?>
		<div class="copyright"><div class="content-wrapper"><?php
			echo esc_html( $copyright );
		?></div></div>
		<?php
		endif;
	?></div><!-- #site-footer -->
	
	<div id="to-top" class="va-middle"><?php echo daze_get_svg_arrow_up(); ?></div>	
<?php wp_footer(); ?>
</body>
</html>