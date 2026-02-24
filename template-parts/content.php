<?php
/* =========================================================
	Post content, template part displayed on standard list
	Daze - Premium WordPress Theme, by NordWood
============================================================ */
	$post_format = get_post_format();	
	$post_length = get_theme_mod( 'daze_post_length' );	
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
	get_template_part('template-parts/fullheader');
	
	if( !( ( "quote" === $post_format || "link" === $post_format ) && 'post-excerpts' === $post_length ) ) {
		get_template_part('template-parts/featuredarea');
	}
	
	$post_order = get_post_field( 'menu_order', get_the_ID() );
	
	if( 1 === $post_order && 'enlarge_plus_full' === get_theme_mod( 'daze_first_post', 'nothing' ) ) {
		get_template_part('content-full');
		
	} else if( 1 === $post_order && 'enlarge_plus_excerpt' === get_theme_mod( 'daze_first_post', 'nothing' ) ) {
		get_template_part('content-excerpt');
		
	} else {
		if( is_home() && 'full-posts' === $post_length ) {
			get_template_part('content-full');
			
		} else if( !( $post_format === "quote" || $post_format === "link" ) ) {
			get_template_part('content-excerpt');
		}
	}
?></article><!-- .post-content / .post-excerpt -->