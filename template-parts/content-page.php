<?php 
/* =======================================================
	Page content, template part displayed on single page
	Daze - Premium WordPress Theme, by NordWood
========================================================== */
?>				
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-content clearfix"><?php
		the_content();
		
		if ( get_the_content() ) {
	?>		
		<div class="clearfix"></div>
	<?php
		}
		
		wp_link_pages( array(
			'before'      => '<div class="page-links"><h6>' . esc_html__( 'Pages:', 'daze' ) . '</h6>',
			'after'       => '</div>',
			'link_before' => '<span class="screen-reader-text page-num">',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">%</span>',
			'separator'   => '<span class="separator"></span>',
		) );
	?></div><!-- .post-content -->
</article>