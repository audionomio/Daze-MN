<?php
/* ==============================================
	SEARCH RESULTS
	Daze - Premium WordPress Theme, by NordWood
================================================= */
	get_header();
	
//	Get the queried term
	$search_query = get_search_query();
	
// Get the results from post content
	$a1 = array(
		'post_type' => 'post',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		's' => $search_query,
		'ignore_sticky_posts' => 1
	);
	
// Get the results from quote and link fields
	$a2 = array(
		'post_type' => 'post',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'meta_query' => array(
			'relation' => 'OR',
			array(
			   'key' => 'daze_featured_quote',
			   'value' => $search_query,
			   'compare' => 'LIKE'
			),
			array(
			   'key' => 'daze_featured_quote_author',
			   'value' => $search_query,
			   'compare' => 'LIKE'
			),
			array(
			   'key' => 'daze_featured_link',
			   'value' => $search_query,
			   'compare' => 'LIKE'
			)
		 ),
		'ignore_sticky_posts' => 1
	);
	
// Get the results from categories and tags
	$a3 = array(
		'post_type' => 'post',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'tax_query' => array(
			'relation' => 'OR',
			array(
			   'taxonomy' => 'category',
			   'field' => 'name',
			   'terms' => $search_query
			),			
			array(
			   'taxonomy' => 'post_tag',
			   'field' => 'name',
			   'terms' => $search_query
			)
		 ),
		'ignore_sticky_posts' => 1
	);
	
// Compile all the search results and remove the duplicates
	$q1 = new WP_Query( $a1 );
	$q2 = new WP_Query( $a2 );
	$q3 = new WP_Query( $a3 );
	
	$total = array();
	$total = array_merge( $q1->posts, $q2->posts, $q3->posts );

	$ids = array();
	
	foreach( $total as $item ) {
		$ids[] = $item->ID;
	}
	$s = array_unique( $ids );
	
	if( !empty( $s ) ) :
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		
		$a = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'post__in' => $s,
			'posts_per_page' => get_option( 'posts_per_page' ),
			'paged' => $paged,		
			'ignore_sticky_posts' => 1
		);
		
		$results = new WP_Query( $a );
						
		if ( $results->have_posts() ) :	
			$layout_type = get_theme_mod( 'daze_custom_search_layout',  false ) ?
				get_theme_mod( 'daze_search_layout_type', 'tiny' ) :
				get_theme_mod( 'daze_blog_layout_type', 'masonry' );
			
			$layout_width = get_theme_mod( 'daze_custom_search_layout', false ) ?
				get_theme_mod( 'daze_search_layout_width', 'narrow' ) :
				get_theme_mod( 'daze_blog_layout_width', 'narrow' );
			
			$sidebar = get_theme_mod( 'daze_custom_search_layout', false ) ?
				get_theme_mod( 'daze_search_include_sidebar', false ) :
				get_theme_mod( 'daze_include_sidebar', false );		
			
			$show_sidebar = ( 'standard-list' != $layout_type && 'full-width' === $layout_width ) ? false : $sidebar;
			?>		
			<div class="search-header-holder content-wrapper clearfix">
				<div class="search-header post-header">
					<h6><?php
						printf(
							esc_html__( '%s search results for:', 'daze' ),
							count($s)
						);
					?></h6>
					
					<?php get_search_form(); ?>
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
						while ( $results->have_posts() ) :
							$results->the_post();
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
						while ( $results->have_posts() ) :
							$results->the_post();
								
							$post_format = get_post_format();
							?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
								get_template_part( 'template-parts/fullheader' );
								
								if( !( "quote" === $post_format || "link" === $post_format ) ) {
									get_template_part( 'template-parts/featuredarea' );
								}
								
								get_template_part( 'template-parts/content', 'excerpt' );
							?></article><!-- .post-content / .post-excerpt -->
							<?php
						endwhile;
					endif;
					?></div>
				<?php				
					daze_posts_pagination( $results->max_num_pages, "2", $paged );					
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
		
	else :
		get_template_part( 'template-parts/content', 'none' );
		
	endif;
	get_footer();
?>