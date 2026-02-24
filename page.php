<?php
/* ==============================================
	Single page template
	Daze - Premium WordPress Theme, by NordWood
================================================= */
	get_header();
?>
	<div class="main-holder content-wrapper clearfix">
		<div class="post-header"><?php
			if ( 'hide-title' !== daze_get_meta( 'daze_pages_hide_title' ) ) {
				the_title( '<h1>', '</h1>' );
			}
			
			daze_edit_page();
			
		// Get the sidebar 'single_header' if it has active widgets
			if ( is_active_sidebar( 'sidebar-single_header' )  ) {
		?>
			<div id="sidebar-single_header" class="sidebar"><?php dynamic_sidebar( 'sidebar-single_header' ); ?></div>
		<?php
			}
		?></div>		
		
		<div class="featured-area"><?php
			if( has_post_thumbnail() && !( daze_get_meta( 'daze_hide_featured_image' ) ) ) :
		?>
			<div class="featured-img"><?php echo get_the_post_thumbnail(); ?></div>
		<?php
			else :
				if ( 'hide-title' !== daze_get_meta( 'daze_pages_hide_title' ) ) {
			?>
				<div class="h-line"></div>
			<?php
				}
			endif;
		?></div><!-- .featured-area -->
		
		<main id="main" <?php daze_main_class(); ?> ><?php		
		while( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );
			
			if( false === get_theme_mod( 'daze_disable_wp_comments', false ) && comments_open() ) {
				comments_template();
			}
			
			if( 'allow-fb-comments' === daze_get_meta( 'daze_allow_fb_comments' ) ) :
		?>
			<div class="fb-comments" data-href="<?php echo esc_url( get_permalink() ); ?>" data-numposts="5"></div>
		<?php
			endif;
		endwhile;
		?></main><!-- #main -->
		
		<?php
			if( 'include-sidebar' === daze_get_meta( 'daze_include_sidebar' ) ) {
				get_sidebar();
			}
		?>
	</div><!-- .main-holder -->		
<?php
	get_footer();
?>