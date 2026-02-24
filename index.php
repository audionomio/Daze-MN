<?php
/* ==============================================
	HOME PAGE, displaying the latest posts
	Daze - Premium WordPress Theme, by NordWood
================================================= */
	get_header();
	
	$exclude_cat = array();
	$exclude_cat = explode( ',', get_theme_mod( 'daze_hide_posts_by_cat' ) );
	
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	
	$latest_args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'category__not_in' => $exclude_cat,
		'posts_per_page' => get_option( 'posts_per_page' ),
		'paged' => $paged,
		'ignore_sticky_posts' => 0
	);

	$latest_query = new WP_Query( $latest_args );
	
	if( $latest_query->have_posts() ) :
		$post_order = 0;
		
		$layout_type = get_theme_mod( 'daze_blog_layout_type', 'masonry' );
		$layout_width = get_theme_mod( 'daze_blog_layout_width', 'narrow' );
		
		$show_sidebar = (
				( 'masonry' === $layout_type || 'masonry-mini' === $layout_type ) &&
				( 'full-width' === $layout_width )
			) ?
			false :
			get_theme_mod( 'daze_include_sidebar', false );
	?>
		<div class="clearfix main-holder content-wrapper">
			<div class="content-wrapper featured-area"></div>
		<?php
			$first_post = get_theme_mod( 'daze_first_post', 'nothing' );
			
			if( 'nothing' != $first_post && 'full-width' != $layout_width && 1 === $paged ) {
				$latest_query->the_post();
				
				$post_format = get_post_format();
			?>
				<div class="latest-enlarged">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
						get_template_part( 'template-parts/fullheader' );
						
						if( !(
							( $post_format === "quote" || $post_format === "link" ) &&
							'enlarge_plus_excerpt' === $first_post )
						) {
							get_template_part( 'template-parts/featuredarea' );
						}
						
						if( 'enlarge_plus_full' === $first_post ) {
							get_template_part( 'template-parts/content', 'full' );
							
						} else if( !( "quote" === $post_format || "link" === $post_format ) ) {
							get_template_part( 'template-parts/content', 'excerpt' );
						}
					?>
					</article><!-- .post-content / .post-excerpt -->
				</div>
			<?php
			}
			
		// Get the sidebar 'blog_top' if it has active widgets
			if ( is_active_sidebar( 'sidebar-blog_top' )  ) {
		?>
			<div id="sidebar-blog_top" class="sidebar"><?php dynamic_sidebar( 'sidebar-blog_top' ); ?></div>
		<?php
			}
		?>
			<main id="main" <?php daze_main_class(); ?>>			
				<div <?php daze_layout_class(); ?>><?php 
				if( 'masonry' === $layout_type || 'masonry-mini' === $layout_type ) :
				?>
					<div class="masonry-item-sizer"></div>
				<?php
					/* Special boxes */
					$inc_bnnr = get_theme_mod( 'daze_inc_bannerad_box', false );
					$inc_bnnr_2 = $inc_bnnr && get_theme_mod( 'daze_inc_bannerad_2', false );
					$inc_bnnr_3 = $inc_bnnr_2 && get_theme_mod( 'daze_inc_bannerad_3', false );
					$inc_bnnr_4 = $inc_bnnr_3 && get_theme_mod( 'daze_inc_bannerad_4', false );
					$inc_bnnr_5 = $inc_bnnr_4 && get_theme_mod( 'daze_inc_bannerad_5', false );					
					$inc_soc = get_theme_mod( 'daze_inc_social_box', false );					
					$inc_tp = get_theme_mod( 'daze_inc_top_posts_box', false );
					$inc_lc = get_theme_mod( 'daze_inc_latest_comments_box', false );
				
					while ( $latest_query->have_posts() ) :
						$latest_query->the_post();
						
						$item_order = ($paged-1)*get_option( 'posts_per_page' ) + $post_order;					
						
						daze_special_widgets( $item_order );
						
					// Image banners (Customizer)
						if ( true === $inc_bnnr ) {
							$bnnr_start = absint( get_theme_mod( 'daze_bannerad_box_start', 3 ) );
							$bnnr_step = absint( get_theme_mod( 'daze_bannerad_box_interval', 5 ) );
							
							if ( daze_special_widget_order( true, $bnnr_start, $bnnr_step, $item_order ) ) {
								daze_special_box_bnnr_1();
							}
						}
						
						if ( true === $inc_bnnr_2 ) {
							$bnnr_2_start = absint( get_theme_mod( 'daze_bannerad_2_start', 3 ) );
							$bnnr_2_step = absint( get_theme_mod( 'daze_bannerad_2_interval', 5 ) );
							
							if ( daze_special_widget_order( true, $bnnr_2_start, $bnnr_2_step, $item_order ) ) {
								daze_special_box_bnnr_2();
							}
						}
						
						if ( true === $inc_bnnr_3 ) {
							$bnnr_3_start = absint( get_theme_mod( 'daze_bannerad_3_start', 3 ) );
							$bnnr_3_step = absint( get_theme_mod( 'daze_bannerad_3_interval', 5 ) );
							
							if ( daze_special_widget_order( true, $bnnr_3_start, $bnnr_3_step, $item_order ) ) {
								daze_special_box_bnnr_3();
							}
						}
						
						if ( true === $inc_bnnr_4 ) {
							$bnnr_4_start = absint( get_theme_mod( 'daze_bannerad_4_start', 3 ) );
							$bnnr_4_step = absint( get_theme_mod( 'daze_bannerad_4_interval', 5 ) );
							
							if ( daze_special_widget_order( true, $bnnr_4_start, $bnnr_4_step, $item_order ) ) {
								daze_special_box_bnnr_4();
							}
						}
						
						if ( true === $inc_bnnr_5 ) {
							$bnnr_5_start = absint( get_theme_mod( 'daze_bannerad_5_start', 3 ) );
							$bnnr_5_step = absint( get_theme_mod( 'daze_bannerad_5_interval', 5 ) );
							
							if ( daze_special_widget_order( true, $bnnr_5_start, $bnnr_5_step, $item_order ) ) {
								daze_special_box_bnnr_5();
							}
						}
						
					// Social profiles (Customizer)
						if ( true === $inc_soc ) {
							$soc_start = absint( get_theme_mod( 'daze_social_box_start', 3 ) );
							$soc_step = absint( get_theme_mod( 'daze_social_box_interval', 5 ) );
							
							if ( daze_special_widget_order( true, $soc_start, $soc_step, $item_order ) ) {
								daze_special_box_social();
							}
						}
						
					// Popular/Latest posts (Customizer)
						if ( true === $inc_tp ) {
							$tp_start = absint( get_theme_mod( 'daze_top_posts_box_start', 3 ) );
							$tp_step = absint( get_theme_mod( 'daze_top_posts_box_interval', 5 ) );
							
							if ( daze_special_widget_order( true, $tp_start, $tp_step, $item_order ) ) {
								daze_special_box_top_posts();
							}
						}
						
					// Latest comments (Customizer)
						if ( true === $inc_lc ) {
							$lc_start = absint( get_theme_mod( 'daze_latest_comments_box_start', 3 ) );
							$lc_step = absint( get_theme_mod( 'daze_latest_comments_box_interval', 5 ) );
							
							if ( daze_special_widget_order( true, $lc_start, $lc_step, $item_order ) ) {
								daze_special_box_latest_comments();
							}
						}
						
					/* Posts list */
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
									get_template_part( 'template-parts/content', 'masonry' );
								?></div>
							</div>
						</div>
					<?php
						$post_order++;
					endwhile;
					
				else:
					while ( $latest_query->have_posts() ) :
						$latest_query->the_post();
						
						$post_format = get_post_format();						
						$post_length = get_theme_mod( 'daze_post_length' );	
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
						get_template_part( 'template-parts/fullheader' );
						
						if( !( ( "quote" === $post_format || "link" === $post_format ) && 'post-excerpts' === $post_length ) ) {
							get_template_part( 'template-parts/featuredarea' );
						}
						
						if( 'full-posts' === $post_length ) {
							get_template_part( 'template-parts/content', 'full' );
							
						} else if( !( $post_format === "quote" || $post_format === "link" ) ) {
							get_template_part( 'template-parts/content', 'excerpt' );
						}
					?></article><!-- .post-content / .post-excerpt -->
					<?php
					endwhile;
				endif;
				?></div>
				<?php
				daze_posts_pagination( $latest_query->max_num_pages,"2",$paged );				
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