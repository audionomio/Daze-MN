<?php 
/* =========================================================
	Post content, template part for a full content display
	Daze - Premium WordPress Theme, by NordWood
============================================================ */
?>
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
	?></div>
<?php		
	if ( true === get_theme_mod( 'daze_show_share_buttons', true ) ) {
		echo daze_share_buttons();
	}
?>