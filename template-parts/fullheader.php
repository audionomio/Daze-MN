<?php
/* ========================================================
	Post header, template part for a full header display
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
?>
	<header class="post-header shareable-selections"><?php
	if( daze_is_categorized( get_the_ID() ) && $show_cat ) {
	?>
		<h6 class="post-category"><?php daze_post_categories( get_the_ID() ); ?></h6>
	<?php
	}
	
// Link Post Format	
	if( $post_format === "link" ) {
		if( !is_single() ) {
		?>
		<h3>
			<a class="post-title" href="<?php echo esc_url( get_permalink() ); ?>"><?php
				echo wp_kses(
					daze_highlight_searched_terms( get_the_title() ),
					array( 'span' => array( 'class' => array() ) )
				);
			?></a>
		</h3>
		<?php
		} else {
		?>
		<h3><?php
			echo wp_kses(
				daze_highlight_searched_terms( get_the_title() ),
				array( 'span' => array( 'class' => array() ) )
			);
		?></h3>
		<?php
		}
	?>
		<span class="post-format-icon"><?php echo daze_post_format_icon( get_the_ID() ); ?></span>
		
	<?php
		if( function_exists( 'daze_featured_area_get_meta' ) ) {
			if( $featured_link = daze_featured_area_get_meta( 'daze_featured_link' ) ) {
			?>
				<a class="featured-link" href="<?php echo esc_url( $featured_link ); ?>" target="_blank"><?php
					echo wp_kses(
						daze_highlight_searched_terms( $featured_link ),
						array( 'span' => array( 'class' => array() ) )
					);
				?></a>
			<?php
			}
		}
	
// Quote Post Format
	} else if( $post_format === "quote" ) {
	
		if( function_exists( 'daze_featured_area_get_meta' ) ) {
			if( $featured_quote = daze_featured_area_get_meta( 'daze_featured_quote' ) ) {
				if( !is_single() ) {
				?>
				<h3>
					<a class="post-title" href="<?php echo esc_url( get_permalink() ); ?>" target="_blank">&ldquo;<?php
						echo wp_kses(
							daze_highlight_searched_terms( $featured_quote ),
							array( 'span' => array( 'class' => array() ) )
						);
					?>&rdquo;</a>
				</h3>
				<?php
				} else {
				?>
				<h3>&ldquo;<?php
					echo wp_kses(
						daze_highlight_searched_terms( $featured_quote ),
						array( 'span' => array( 'class' => array() ) )
					);
				?>&rdquo;</h3>
				<?php
				}
				?>
				
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
			}
		} else {
			if( !is_single() ) {
			?>
			<h3>
				<a class="post-title" href="<?php echo esc_url( get_permalink() ); ?>" target="_blank">&ldquo;<?php
					echo wp_kses(
						daze_highlight_searched_terms( get_the_title() ),
						array( 'span' => array( 'class' => array() ) )
					);
				?>&rdquo;</a>
			</h3>
			<?php
			} else {
			?>
			<h3>&ldquo;<?php
				echo wp_kses(
					daze_highlight_searched_terms( get_the_title() ),
					array( 'span' => array( 'class' => array() ) )
				);
			?>&rdquo;</h3>
			<?php
			}
		?>
			<span class="post-format-icon"><?php echo daze_post_format_icon( get_the_ID() ); ?></span>
		<?php
		}
		
// Standard Post Format
	} else {
		if( !is_single() ) {
		?>
			<h1>
				<a class="post-title" href="<?php echo esc_url( get_permalink() ); ?>"><?php
				echo wp_kses(
					daze_highlight_searched_terms( get_the_title() ),
					array( 'span' => array( 'class' => array() ) )
				);
				?></a>
			</h1>
		<?php
		} else {
		?>
			<h1><?php
				echo wp_kses(
					daze_highlight_searched_terms( get_the_title() ),
					array( 'span' => array( 'class' => array() ) )
				);
			?></h1>
		<?php
		}
	}
	
	if( $show_date || $show_comments_count || $show_author ) {
?>
		<div class="post-meta"><?php
		if( $show_date ) {
			echo date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) );
		}
		
		if( $show_comments_count ) {
			if( $show_date ) {
				echo '<span class="separator"></span>';
			}
			
			printf(
				'<a href="%1$s" class="smooth-scroll">%2$s %3$s</a>',
				esc_url( get_comments_link( get_the_ID() ) ),
				daze_get_svg_comments_cloud(),
				absint( get_comments_number( get_the_ID() ) )
			);
		}
		
		if( $show_author ) {
			if( $show_date || $show_comments_count ) {
				echo '<span class="separator"></span> ';
			}
			
			$author_id = get_the_author_meta( "ID" );
					
			if ( "show" === get_user_meta( $author_id, 'daze_show_avatar_in_archive', true ) ) {
				if ( $img_id = get_user_meta( $author_id, 'daze_user_img', true ) ) {
					is_rtl() ?
					printf(
						'<a class="author-name" href="%2$s">%3$s <span class="user-photo-tiny">%4$s</span></a> %1$s',
						get_theme_mod( 'daze_author_name_text', esc_html__( 'Posted by', 'daze' ) ),
						esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ),
						esc_html( get_the_author_meta( "nickname" ) ),
						daze_giffy_attachment( $img_id, 'thumbnail' )
					) :
					printf(
						'%1$s <a class="author-name" href="%2$s"><span class="user-photo-tiny">%4$s</span> %3$s</a>',
						get_theme_mod( 'daze_author_name_text', esc_html__( 'Posted by', 'daze' ) ),
						esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ),
						esc_html( get_the_author_meta( "nickname" ) ),
						daze_giffy_attachment( $img_id, 'thumbnail' )
					);
					
				} else {
					is_rtl() ?
					printf(
						'<a class="author-name" href="%2$s">%3$s <span class="user-photo-tiny">%4$s</span></a> %1$s',
						get_theme_mod( 'daze_author_name_text', esc_html__( 'Posted by', 'daze' ) ),
						esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ),
						esc_html( get_the_author_meta( "nickname" ) ),
						get_avatar( get_the_author_meta( 'ID' ), 'thumbnail' )
					) :
					printf(
						'%1$s <a class="author-name" href="%2$s"><span class="user-photo-tiny">%4$s</span> %3$s</a>',
						get_theme_mod( 'daze_author_name_text', esc_html__( 'Posted by', 'daze' ) ),
						esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ),
						esc_html( get_the_author_meta( "nickname" ) ),
						get_avatar( get_the_author_meta( 'ID' ), 'thumbnail' )
					);
				}
				
			} else {
				is_rtl() ?
				printf(
					'<a class="author-name" href="%2$s">%3$s</a> %1$s',
					get_theme_mod( 'daze_author_name_text', esc_html__( 'Posted by', 'daze' ) ),
					esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ),
					esc_html( get_the_author_meta( "nickname" ) )
				) :
				printf(
					'%1$s <a class="author-name" href="%2$s">%3$s</a>',
					get_theme_mod( 'daze_author_name_text', esc_html__( 'Posted by', 'daze' ) ),
					esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ),
					esc_html( get_the_author_meta( "nickname" ) )
				);
			}
		}
		?></div>
	<?php
	}			
	// Edit
		daze_edit_post();
			
	// Get the sidebar 'single_header' if it has active widgets
		if ( is_active_sidebar( 'sidebar-single_header' )  ) {
	?>
		<div id="sidebar-single_header" class="sidebar"><?php dynamic_sidebar( 'sidebar-single_header' ); ?></div>
	<?php
		}
	?></header><!-- .post-header -->