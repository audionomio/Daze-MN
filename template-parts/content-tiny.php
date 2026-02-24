<?php
/* ======================================================
	Post articles, template part displayed on tiny list
	Daze - Premium WordPress Theme, by NordWood
========================================================= */
	$ignore_g = ( 'ignore-global' === daze_posts_get_meta( 'daze_ignore_global' ) ) ? true : false;
	
	$show_date = false;
	
	if( $ignore_g ) {
		if( 'show-date' === daze_posts_get_meta( 'daze_posts_show_date' ) ) {
			$show_date = true;
		}
		
	} else {
		if( true === get_theme_mod( 'daze_show_date', true ) ) {
			$show_date = true;
		}
	}
	
	$show_author = false;
	
	if( $ignore_g ) {
		if( 'show-author' === daze_posts_get_meta( 'daze_posts_show_author' ) ) {
			$show_author = true;
		}
		
	} else {
		if( true === get_theme_mod( 'daze_show_author_name', true ) ) {
			$show_author = true;
		}
	}
	
	$show_comments_count = false;
	
	if( false === get_theme_mod( 'daze_disable_wp_comments', false ) ) {
		if( $ignore_g ) {
			if( comments_open( get_the_ID() ) && 'show-comments-count' === daze_posts_get_meta( 'daze_posts_show_comments_count' ) ) {	
				if( 0 < get_comments_number( get_the_ID() ) ) {
					$show_comments_count = true;
				}
			}
			
		} else {
			if( comments_open( get_the_ID() ) && true === get_theme_mod( 'daze_show_comments', true ) ) {
				if( 0 < get_comments_number( get_the_ID() ) ) {
					$show_comments_count = true;
				}
			}
		}
	}
	
	$custom_thumb_link = daze_posts_get_meta( 'daze_featured_img_link' ) ?
		daze_posts_get_meta( 'daze_featured_img_link' ) :
		get_permalink( get_the_ID() );
	
	$custom_thumb_target = ( 'new-tab' === daze_posts_get_meta( 'daze_featured_img_target' ) ) ? '_blank' : '_self';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="thumb"><?php
		$custom_thumb_link = get_post_meta( get_the_ID(), 'daze_featured_img_link', true )
							? get_post_meta( get_the_ID(), 'daze_featured_img_link', true )
							: get_permalink( get_the_ID() );
		
		$custom_thumb_target = get_post_meta( get_the_ID(), 'daze_featured_img_target', true )
							? '_blank'
							: '_self';
	?>
		<a class="va-middle" href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php		
			if ( daze_posts_get_meta( 'daze_posts_featured_on_list_id' ) ) {
				echo wp_get_attachment_image( daze_posts_get_meta( 'daze_posts_featured_on_list_id' ), 'daze_small' );
				
			} else if( has_post_thumbnail( get_the_ID() ) ) {
				echo get_the_post_thumbnail( get_the_ID(), 'daze_small' );
				
			} else if( 'gallery' === get_post_format(get_the_ID()) ) {
				$featured_gallery = get_post_meta( get_the_ID(), 'daze_featured_gallery', true );
				$get_gallery_imgs = explode(', ', $featured_gallery);			
								
				if( $get_gallery_imgs == array("") ) {
					$get_gallery_imgs = array();
				}
				
				if ( is_array( $get_gallery_imgs ) && !empty( $get_gallery_imgs ) ) {
					echo wp_get_attachment_image( $get_gallery_imgs[0], 'daze_small' );								
				}
				
			} else {
				echo daze_post_format_icon( get_the_ID() );
			}
		?></a>
	</div>
	
	<div class="content">
		<header><?php
			$post_title = get_the_title();
			if ( strlen( $post_title) > 59 ) {
				$post_title = substr( $post_title, 0, 56 );
				$post_title .= '...';
			}
		?>
			<a href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><h6><?php echo esc_html( $post_title ); ?></h6></a>
		</header>
		
		<footer><?php
			if( $show_date ) {
				echo esc_html( get_the_date() );
			}
			
			if( $show_comments_count ) {
				if( $show_date ) {
					echo '<span class="separator"></span> ';
				}
				
				printf(
					'%1$s<span class="comments-count">%2$d</span>',
					daze_get_svg_comments_cloud(),
					absint( get_comments_number( get_the_ID() ) )
				);
			}
			
			if( $show_author && ! is_author() ) {
				if( $show_date || $show_comments_count ) {
					echo '<span class="separator"></span> ';
				}
				
				is_rtl()
				? printf(
					'<a class="author-name" href="%2$s">%3$s</a> %1$s',
					esc_html_x( 'by', 'preposition, before the name of the author', 'daze' ),
					esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ),
					esc_html( get_the_author_meta( "nickname" ) )
				)
				: printf(
					'%1$s <a class="author-name" href="%2$s">%3$s</a>',
					esc_html_x( 'by', 'preposition, before the name of the author', 'daze' ),
					esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ),
					esc_html( get_the_author_meta( "nickname" ) )
				);
			}			
		?></footer>
	</div>
</article>