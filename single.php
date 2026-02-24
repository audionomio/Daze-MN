<?php
/* ==============================================
	Single post template
	Daze - Premium WordPress Theme, by NordWood
================================================= */
	get_header();
	
	while ( have_posts() ) :
		the_post();
		
		daze_set_post_views( get_the_ID() );
	?>
		<div class="main-holder content-wrapper clearfix">
		<?php
			get_template_part('template-parts/fullheader');
			get_template_part('template-parts/featuredarea');
		?>			
			<main id="main" <?php daze_main_class(); ?> ><?php
				get_template_part( 'template-parts/content', 'single' );
			?>				
				<div class="posts-nav clearfix">
				<?php
					if( get_previous_post_link( '%link', '', false, '' ) ) {
						is_rtl() ?
						previous_post_link(
							'<div class="prev">%link</div>',
							daze_get_svg_arrow_right() . esc_html__( 'Previous', 'daze' ),
							false,
							''
						) :
						previous_post_link(
							'<div class="prev">%link</div>',
							daze_get_svg_arrow_left() . esc_html__( 'Previous', 'daze' ),
							false,
							''
						);
						
					} else {
						if( is_rtl() ) {
						?>
						<div class="prev inactive"><?php echo daze_get_svg_arrow_right() . esc_html__( 'Previous', 'daze' ); ?></div>						
						<?php
						} else {
						?>
						<div class="prev inactive"><?php echo daze_get_svg_arrow_left() . esc_html__( 'Previous', 'daze' ); ?></div>
						<?php
						}
					}
					
					if( get_next_post_link( '%link', '', false, '' ) ) {
						is_rtl() ?
						next_post_link(
							'<div class="next">%link</div>',
							esc_html__( 'Next', 'daze' ) . daze_get_svg_arrow_left(),
							false,
							''
						) :
						next_post_link(
							'<div class="next">%link </div>',
							esc_html__( 'Next', 'daze' ) . daze_get_svg_arrow_right(),
							false,
							''
						);
						
					} else {
						if( is_rtl() ) {
						?>
						<div class="next inactive"><?php echo esc_html__( 'Next', 'daze') . daze_get_svg_arrow_left(); ?></div>						
						<?php
						} else {
						?>
						<div class="next inactive"><?php echo esc_html__( 'Next', 'daze') . daze_get_svg_arrow_right(); ?></div>
						<?php
						}
					}
											
					if ( true === get_theme_mod( 'daze_show_share_buttons', true ) ) {
						echo daze_share_buttons();
					}
				?>
				</div><!-- .posts-nav -->
				
				<?php				 
				if ( true === get_theme_mod( 'daze_show_author_info', true ) && ( '' !== get_the_author_meta( 'description' ) ) ) {
					get_template_part( 'template-parts/author' );
				}
				
				if( false === get_theme_mod( 'daze_disable_wp_comments', false ) ) {
					comments_template();
				}
				
				$allow_fb_comments = false;
				
				if( 'ignore-global' === daze_posts_get_meta( 'daze_ignore_global' ) ) {
					if( 'allow-fb-comments' === daze_get_meta( 'daze_allow_fb_comments' ) ) {
						$allow_fb_comments = true;
					}
					
				} else {
					if( true === get_theme_mod( 'daze_allow_fb_comments', false ) ) {
						$allow_fb_comments = true;
					}
				}
	
				if( true === $allow_fb_comments ) {
					echo '<div class="fb-comments" data-href="' . esc_url( get_permalink() ) . '" data-numposts="5"></div>';
				}
				
		?></main><!-- #main -->
		
		<?php
			if(
				( 'include-sidebar' === get_theme_mod( 'daze_include_sidebar_on_posts' ) && !( daze_posts_get_meta( 'daze_ignore_global' ) ) )
				|| ( daze_get_meta( 'daze_include_sidebar' ) && daze_posts_get_meta( 'daze_ignore_global' ) )
			) {
				get_sidebar();
			}
		?>
		</div>		
<?php
	endwhile;
	get_footer();
?>