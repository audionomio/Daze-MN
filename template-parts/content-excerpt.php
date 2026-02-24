<?php 
/* =================================================================================
	Post excerpt, template part for a content excerpt display (on standard list)
	Daze - Premium WordPress Theme, by NordWood
================================================================================= */
?>
	<div class="post-excerpt shareable-selections clearfix"><p><?php
		global $post;
		
		$curr_post = get_post();
		$curr_excerpt = '';
		$has_more_tag = strpos( $post->post_content, '<!--more-->' );
		
		$custom_thumb_link = get_post_meta( get_the_ID(), 'daze_featured_img_link', true )
							? get_post_meta( get_the_ID(), 'daze_featured_img_link', true )
							: get_permalink( get_the_ID() );
		
		$custom_thumb_target = get_post_meta( get_the_ID(), 'daze_featured_img_target', true )
							? '_blank'
							: '_self';
		
		if( $curr_post->post_excerpt ) {
			$curr_excerpt = get_the_excerpt();
			
		} else if( $has_more_tag ) {
			$curr_excerpt = get_the_content();
			
		} else if( $curr_content = $curr_post->post_content ) {
			$word_count = get_theme_mod( 'daze_excerpt_length', 55 );
			$curr_excerpt = wp_trim_words( $curr_content, $word_count, '' );
			$curr_excerpt = strip_shortcodes( $curr_excerpt );
			$curr_excerpt .= '&hellip;';
		}
		
		echo wp_kses(
			daze_highlight_searched_terms( $curr_excerpt ),
			array(
				'a' => array( 'class' => array(), 'href' => array() ),
				'p' => array(),
				'span' => array( 'class' => array() ),
				'div' => array( 'class' => array() )
			)
		);
		
		if( false === get_theme_mod( 'daze_hide_readmore', false ) && !$has_more_tag ) {
		?>
		<div><a class="read-more button-link" href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php echo esc_html__( 'Read More', 'daze' ); ?></a></div>
		<?php
		}
	?></p></div>