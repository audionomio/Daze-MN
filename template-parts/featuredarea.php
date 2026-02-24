<?php
/* =======================================================================================================
	Featured area, template part for displaying featured area on standard lists and single posts
	Daze - Premium WordPress Theme, by NordWood
====================================================================================================== */
	$post_format = get_post_format();
	
	$custom_thumb_link = daze_posts_get_meta( 'daze_featured_img_link' ) ?
		daze_posts_get_meta( 'daze_featured_img_link' ) :
		get_permalink( get_the_ID() );
	
	$custom_thumb_target = ( 'new-tab' === daze_posts_get_meta( 'daze_featured_img_target' ) ) ? '_blank' : '_self';
?>
	<div class="featured-area"><?php
		if( function_exists( 'daze_featured_area_get_meta' ) ) {
			$featured_video = daze_featured_area_get_meta( 'daze_featured_video_url' );
			$featured_audio = daze_featured_area_get_meta( 'daze_featured_audio_url' );
			$featured_gallery = daze_featured_area_get_meta( 'daze_featured_gallery' );
			
			global $wp_embed;
				
			switch( $post_format ) :
				case 'video':
					if( $featured_video && ( 0 === strpos( $featured_video, 'http' ) ) ) {
				?>
					<div class="featured-media video"><?php echo wp_oembed_get( esc_url( $featured_video ) ); ?></div>
				<?php
					}
					break;
					
				case 'audio':					
					if( $featured_audio && ( 0 === strpos( $featured_audio, 'http' ) ) ) {
				?>
					<div class="featured-media audio"><?php echo wp_oembed_get( esc_url( $featured_audio ) ); ?></div>
				<?php
					}
					break;
					
				case 'gallery':				
					if( $featured_gallery ) {
						echo do_shortcode( '[gallery include="' . $featured_gallery . '"]' );
					}
					break;
					
				default:
					if(
						has_post_thumbnail()
						&& !(
							( is_singular() || ( is_home() && 'full-posts' === get_theme_mod( 'daze_post_length' ) && 'standard-list' === get_theme_mod( 'daze_blog_layout_type' ) ) ) &&
							( daze_get_meta('daze_hide_featured_image') || ( true === get_theme_mod( 'daze_hide_featured_image' ) && !( daze_posts_get_meta( 'daze_ignore_global' ) ) ) )
						)
						&& !( $featured_video || $featured_audio )
					) {
				?>
					<div class="featured-img"><a href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php echo daze_giffy_featured_img( get_the_ID(), 'size-daze_wrapper_width' ); ?></a></div>
				<?php
					}
			endswitch;
			
		} else if( has_post_thumbnail() ) {
		?>
			<div class="featured-img"><a href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php echo daze_giffy_featured_img( get_the_ID(), 'size-daze_wrapper_width' ); ?></a></div>
		<?php
		}
	?></div>