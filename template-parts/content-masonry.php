<?php
/* ========================================================
	Post articles, template part displayed on masonry list
	Daze - Premium WordPress Theme, by NordWood
=========================================================== */
	$post_format = get_post_format();	
	$ignore_g = ( 'ignore-global' === daze_posts_get_meta( 'daze_ignore_global' ) ) ? true : false;
	
	$show_cat = false;
	
	if( $ignore_g ) {
		if( 'show-cat' === daze_posts_get_meta( 'daze_posts_show_cat' ) ) {
			$show_cat = true;
		}
		
	} else {
		if( true === get_theme_mod( 'daze_show_category', true ) ) {
			$show_cat = true;
		}
	}
	
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
	<div class="featured-area"><?php	
		global $wp_embed;
		
		$featured_on_list = daze_posts_get_meta( 'daze_posts_featured_on_list_id' );
		
		if( function_exists( 'daze_featured_area_get_meta' ) ) :
			$featured_video = daze_featured_area_get_meta( 'daze_featured_video_url' );
			$featured_audio = daze_featured_area_get_meta( 'daze_featured_audio_url' );
			$featured_gallery = daze_featured_area_get_meta( 'daze_featured_gallery' );
				
			switch( $post_format ) :
				case 'video':
					if( $featured_on_list ) :
				?>
					<div class="featured-img">
						<a href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php
							echo daze_giffy_attachment( daze_posts_get_meta( 'daze_posts_featured_on_list_id' ), 'medium_large' );
						?></a>
						<div class="overlay"></div>
					</div>
				<?php
					elseif( has_post_thumbnail() ) :
				?>
					<div class="featured-img">
						<a href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php
							echo daze_giffy_featured_img( get_the_ID(), 'medium_large' );
						?></a>
						<div class="overlay"></div>
					</div>
				<?php
					elseif( $featured_video && ( 0 === strpos( $featured_video, 'http' ) ) && !in_array( "cover-item", get_post_class() ) ) :
				?>
					<div class="featured-media video"><?php echo wp_oembed_get( esc_url( $featured_video ) ); ?></div>
				<?php
					endif;
					break;
					
				case 'audio':
					if( $featured_on_list ) :
				?>
					<div class="featured-img">
						<a href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php
							echo daze_giffy_attachment( daze_posts_get_meta( 'daze_posts_featured_on_list_id' ), 'medium_large' );
						?></a>
						<div class="overlay"></div>
					</div>
				<?php
					elseif( has_post_thumbnail() ) :
				?>
					<div class="featured-img">
						<a href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php
							echo daze_giffy_featured_img( get_the_ID(), 'medium_large' );
						?></a>
						<div class="overlay"></div>
					</div>
				<?php
					elseif( $featured_audio && ( 0 === strpos( $featured_audio, 'http' ) ) && !in_array( "cover-item", get_post_class() ) ) :
				?>
					<div class="featured-media audio"><?php echo wp_oembed_get( esc_url( $featured_audio ) ); ?></div>
				<?php
					endif;
					break;
					
				case 'gallery':
					if( $featured_on_list ) :
				?>
					<div class="featured-img">
						<a href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php
							echo daze_giffy_attachment( daze_posts_get_meta( 'daze_posts_featured_on_list_id' ), 'medium_large' );
						?></a>
						<div class="overlay"></div>
					</div>
				<?php
					elseif( has_post_thumbnail() ) :
				?>
					<div class="featured-img">
						<a href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php
							echo daze_giffy_featured_img( get_the_ID(), 'medium_large' );
						?></a>
						<div class="overlay"></div>
					</div>
				<?php
					elseif( $featured_gallery && !in_array( "cover-item", get_post_class() ) ) :				
						$get_gallery_imgs = explode(', ', $featured_gallery);						
							
						if( $get_gallery_imgs == array("") ) {
							$get_gallery_imgs = array();
						}
						
						$num_of_gallery_imgs = sizeof( $get_gallery_imgs );
						$gallery_limit = 9;
						
						if( $num_of_gallery_imgs < 9 ) {
							if( $num_of_gallery_imgs < 3 ) {
								$gallery_limit = $num_of_gallery_imgs;
								
							} elseif( $num_of_gallery_imgs > 2 && $num_of_gallery_imgs < 6 ) {
								$gallery_limit = 3;
								
							} elseif( $num_of_gallery_imgs > 5 ) {
								$gallery_limit = 6;
							}
						}				
						?>
						<div class="featured-gallery">
							<a class="clearfix" href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>">
						<?php				
							if( is_array( $get_gallery_imgs ) ) {
								$i = 0;
								
								while( $i < $gallery_limit ) :
								?>						
								<div class="img-wrapper">
									<div class="overlay-wrapper"><?php
										echo wp_get_attachment_image( $get_gallery_imgs[$i], 'daze_small' );
										if( $i == $gallery_limit-1 && $num_of_gallery_imgs > $gallery_limit) :
									?>									
									<div class="overlay va-middle">
										<span class="see-all"><?php
											echo daze_get_svg_eye();
											echo absint( $num_of_gallery_imgs );
										?></span>
									</div>
									<?php
										endif;
									?></div>
								</div>
								<?php
									$i++;
								endwhile;
							}
							?>
							</a>
						</div>
					<?php
					endif;
					break;
					
				default:
					if( $featured_on_list ) {
				?>
					<div class="featured-img">
						<a href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php
							echo daze_giffy_attachment( daze_posts_get_meta( 'daze_posts_featured_on_list_id' ), 'medium_large' );
						?></a>
						<div class="overlay"></div>
					</div>
				<?php
					} else if( has_post_thumbnail() ) {
				?>
					<div class="featured-img">
						<a href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php
							echo daze_giffy_featured_img( get_the_ID(), 'medium_large' );
						?></a>
						<div class="overlay"></div>
					</div>
				<?php
					}
					
			endswitch;
			
		else :
			if( $featured_on_list ) {
		?>
			<div class="featured-img">
				<a href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php
					echo daze_giffy_attachment( daze_posts_get_meta( 'daze_posts_featured_on_list_id' ), 'medium_large' );
				?></a>
				<div class="overlay"></div>
			</div>
		<?php
			} elseif( has_post_thumbnail() ) {
		?>
			<div class="featured-img">
				<a href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php
					echo daze_giffy_featured_img( get_the_ID(), 'medium_large' );
				?></a>
				<div class="overlay"></div>
			</div>
		<?php
			}
		endif;
	?></div><!-- .featured-area -->
	
	<header class="post-header shareable-selections"><?php
		if( daze_is_categorized( get_the_ID() ) && $show_cat ) :
	?>
		<h6 class="post-category"><?php daze_post_categories( get_the_ID() ); ?></h6>
	<?php
		endif;
	
// Link Post Format	
	if( $post_format === "link" ) {
	?>		
		<h3>
			<a class="post-title" href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php
				echo wp_kses(
					daze_highlight_searched_terms( get_the_title() ),
					array( 'span' => array( 'class' => array() ) )
				);
			?></a>
		</h3>
		
		<span class="post-format-icon"><?php echo daze_post_format_icon( get_the_ID() ); ?></span>
		
	<?php
		if( function_exists( 'daze_featured_area_get_meta' ) ) {
			$featured_link = daze_featured_area_get_meta( 'daze_featured_link' );
		?><a class="featured-link" href="<?php echo esc_url( $featured_link ); ?>" target="_blank"><?php
				echo wp_kses(
					daze_highlight_searched_terms( $featured_link ),
					array( 'span' => array( 'class' => array() ) )
				);
		?></a>	
		<?php
		}
	}	
// Quote Post Format
	elseif( $post_format === "quote" ) {
		if( function_exists( 'daze_featured_area_get_meta' ) ) {
			$featured_quote = daze_featured_area_get_meta( 'daze_featured_quote' );
		?>		
			<h3>
				<a class="post-title" href="<?php echo esc_url( $custom_thumb_link ); ?>"  target="<?php echo esc_attr( $custom_thumb_target ); ?>">&ldquo;<?php
					echo wp_kses(
						daze_highlight_searched_terms( $featured_quote ),
						array( 'span' => array( 'class' => array() ) )
					);
				?>&rdquo;</a>
			</h3>
			
			<span class="post-format-icon"><?php echo daze_post_format_icon( get_the_ID() ); ?></span>
		<?php				
			if( $featured_quote_author = daze_featured_area_get_meta( 'daze_featured_quote_author' ) ) {
			?>
				<span class="featured-quote-author">&mdash;<?php
					echo wp_kses(
						daze_highlight_searched_terms( $featured_quote_author ),
						array( 'span' => array( 'class' => array() ) )
					);
				?></span>
			<?php
			}
		} else {
		?>		
			<h3>
				<a class="post-title" href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php
					echo wp_kses(
						daze_highlight_searched_terms( get_the_title() ),
						array( 'span' => array( 'class' => array() ) )
					);
				?></a>
			</h3>
			
			<span class="post-format-icon"><?php echo daze_post_format_icon( get_the_ID() ); ?></span>			
		<?php
		}
	}
	
// Standard Post Format
	else {
	?>
		<h3>
			<a class="post-title" href="<?php echo esc_url( $custom_thumb_link ); ?>" target="<?php echo esc_attr( $custom_thumb_target ); ?>"><?php
				echo wp_kses(
					daze_highlight_searched_terms( get_the_title() ),
					array( 'span' => array( 'class' => array() ) )
				);
			?></a>
		</h3>		
	<?php
	}
	
// Edit
	daze_edit_post();
	?></header><!-- .post-header -->
	
<?php
	if( !in_array( "cover-item", get_post_class() ) ) :
		get_template_part( 'template-parts/content', 'excerpt' );
		
		if( $show_date || $show_comments_count || $show_author ) :
		?>
		<div class="post-meta">
		<?php
			if( $show_author ) :
		?>
			<a class="author-name" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ); ?>">
				<?php
					$author_id = get_the_author_meta( "ID" );
					
					if ( "show" === get_user_meta( $author_id, 'daze_show_avatar_in_archive', true ) ) {
						if ( $img_id = get_user_meta( $author_id, 'daze_user_img', true ) ) {
							printf(
								'<span class="user-photo-tiny">%s</span>',
								daze_giffy_attachment( $img_id, 'thumbnail' )
							);
							
						} else {
							printf(
								'<span class="user-photo-tiny">%s</span>',
								get_avatar( get_the_author_meta( 'ID' ), 'thumbnail' )
							);
						}
					}
				?>
				<?php echo esc_html( get_the_author_meta( "nickname" ) ); ?>
			</a>
		<?php
			endif;
			
			if( $show_date ) :				
				if( $show_author )
					echo '<span class="separator"></span> ';
				
				echo date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) );
			endif;			
		
			if( $show_comments_count ) :
				if( $show_author || $show_date ) {
					echo '<span class="separator"></span>';
				}
				
				printf(
					'<a href="%1$s">%2$s %3$s</a>',
					esc_url( get_comments_link( get_the_ID() ) ),
					daze_get_svg_comments_cloud(),
					absint( get_comments_number( get_the_ID() ) )
				);
			endif;
		?>
		</div>
		<?php
		endif;		
	endif;	
	?>
</article>