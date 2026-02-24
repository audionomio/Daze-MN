<?php
/* ===============================================================
	No content template part, displayed when no posts are found
	Daze - Premium WordPress Theme, by NordWood
================================================================== */
?>
<div class="main-holder content-wrapper clearfix">
	<div class="no-results search-header post-header">
		<h1><?php esc_html_e( 'Nothing found', 'daze' ); ?></h1>

		<h6><?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) :
				printf(
					'1%$s <a href="%2$s">%3$s</a>.',
					esc_html__( 'Ready to publish your first post?', 'daze' ),
					esc_url( admin_url( 'post-new.php' ) ),
					esc_html__( 'Get started here', 'daze' )
				);
				
			elseif ( is_search() ) :
				esc_html_e( 'Sorry, there are no results for this, try something else', 'daze' );
				
			else :
				esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'daze' );
				
			endif;
		?></h6>
		
		<?php get_search_form(); ?>
	</div>	
</div>