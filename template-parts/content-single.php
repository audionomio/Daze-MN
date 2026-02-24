<?php 
/* =======================================================================
	Single post content, template part displayed on single post page
	Daze - Premium WordPress Theme, by NordWood
========================================================================== */
?>				
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-content shareable-selections clearfix"><?php
		the_content();
	?>						
		<div class="clearfix"></div>
	<?php
		wp_link_pages( array(
			'before'      => '<div class="page-links"><h6>' . esc_html__( 'Pages:', 'daze' ) . '</h6>',
			'after'       => '</div>',
			'link_before' => '<span class="screen-reader-text page-num">',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">%</span>',
			'separator'   => '<span class="separator"></span>',
		) );
	?></div><!-- .post-content -->
	
	<footer class="post-footer"><?php
		$show_tagcloud = false;
	
		if( 'ignore-global' === daze_posts_get_meta( 'daze_ignore_global' ) ) {
			if( 'show-tagcloud' === daze_posts_get_meta( 'daze_posts_show_tagcloud' ) ) {
				$show_tagcloud = true;
			}
			
		} else {
			if( true === get_theme_mod( 'daze_show_tagcloud', true ) ) {
				$show_tagcloud = true;
			}
		}
		
		if( $show_tagcloud ) {
			$posttag_args = array(
				'orderby' => 'count',
				'order' => 'DESC'
			);
			
			$posttags = wp_get_post_tags( $post->ID, $posttag_args );
			
			if( $posttags ) {
				echo '<div class="tagcloud">';
				
				foreach( $posttags as $tag ) {
					$tag_link = get_tag_link( $tag->term_id );
				?>
					<a href="<?php echo esc_url( $tag_link ); ?>" class="tag">
						<span class="tag-name"><?php echo esc_html( $tag->name ); ?></span>
						<span class="separator"></span>
						<span class="count"><?php echo absint( $tag->count ); ?></span>
					</a>
				<?php
				}
				
				echo '</div>';
			}
		}
		
	// Get the sidebar 'single_footer' if it has active widgets
		if ( is_active_sidebar( 'sidebar-single_footer' )  ) {
	?>
		<div id="sidebar-single_footer" class="sidebar"><?php dynamic_sidebar( 'sidebar-single_footer' ); ?></div>
	<?php
		}
	?></footer><!-- .tagcloud -->
</article>