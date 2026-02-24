<?php
/* ==============================================
	TAG ARCHIVE
	Daze - Premium WordPress Theme, by NordWood
================================================= */
	get_header();

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	
	if ( have_posts() ) :	
		$layout_type = get_theme_mod( 'daze_custom_tag_layout',  false ) ?
			get_theme_mod( 'daze_tag_layout_type', 'tiny' ) :
			get_theme_mod( 'daze_blog_layout_type', 'masonry' );
		
		$layout_width = get_theme_mod( 'daze_custom_tag_layout', false ) ?
			get_theme_mod( 'daze_tag_layout_width', 'narrow' ) :
			get_theme_mod( 'daze_blog_layout_width', 'narrow' );
		
		$s = get_theme_mod( 'daze_custom_tag_layout', false ) ?
			get_theme_mod( 'daze_tag_include_sidebar', false ) :
			get_theme_mod( 'daze_include_sidebar', false );		
		
		$show_sidebar = ( 'standard-list' != $layout_type && 'full-width' === $layout_width ) ? false : $s;
?>
		<div class="archive-header-holder content-wrapper clearfix">
			<div class="archive-header post-header">
				<h6><?php esc_html_e( 'Tag:', 'daze' ); ?></h6>
				<h1><?php echo esc_html( single_tag_title( '', false ) ); ?></h1>
				<div class="post-meta"><?php
					echo wp_kses(
						term_description(),
						array(
							'p' => array()
						)
					);
				?></div>
			</div>
		</div>
			
		<div class="main-holder content-wrapper clearfix">
			<div class="content-wrapper featured-area"></div>
		<?php
		// Get the sidebar 'blog_top' if it has active widgets
			if ( is_active_sidebar( 'sidebar-blog_top' )  ) {
		?>
			<div id="sidebar-blog_top" class="sidebar"><?php dynamic_sidebar( 'sidebar-blog_top' ); ?></div>
		<?php
			}
		?>
			<main id="main" <?php daze_main_class(); ?>>
				<div <?php daze_layout_class(); ?>><?php
				if( 'standard-list' != $layout_type ) :
				?>
					<div class="masonry-item-sizer"></div>
				<?php
					while ( have_posts() ) :
						the_post();
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
									if( 'tiny' === $layout_type ) {
										get_template_part( 'template-parts/content', 'tiny' );
										
									} else {
										get_template_part( 'template-parts/content', 'masonry' );
									}								
								?></div>
							</div>
						</div>
				<?php
					endwhile;
				else:
					while ( have_posts() ) :
						the_post();
							
						$post_format = get_post_format();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
							get_template_part( 'template-parts/fullheader' );
							
							if( !( "quote" === $post_format || "link" === $post_format ) ) {
								get_template_part( 'template-parts/featuredarea' );
							}
							
							get_template_part( 'template-parts/content', 'excerpt' );
						?>
						</article><!-- .post-content / .post-excerpt -->
						<?php
					endwhile;
				endif;
				?></div>
			<?php				
				daze_posts_pagination( $wp_query->max_num_pages, "2", $paged );				
				wp_reset_postdata();
				echo daze_posts_loading_animation();
			?>
			</main>
	<?php
		if ( true === $show_sidebar ) {
			get_sidebar();
		}
	?>
		</div>
<?php		
	endif;
	get_footer();
?>