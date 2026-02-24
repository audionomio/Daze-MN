<?php
/* ==============================================
	Template Name: Contact page
	Daze - Premium WordPress Theme, by NordWood
================================================= */
	get_header();
	
	$layout_class = "";
	if( 'include-sidebar' === daze_get_meta( 'daze_include_sidebar' ) ) {
		$layout_class = "include-sidebar";
	}
?>
	<div class="main-holder content-wrapper clearfix">
		<div class="post-header"><?php
			if ( 'hide-title' !== daze_get_meta( 'daze_pages_hide_title' ) ) {
				the_title( '<h1>', '</h1>' );
			}
			
		// Edit
			daze_edit_page();
		?></div>
		
		<div class="featured-area">
		<?php
			if(
				has_post_thumbnail() &&
				!(
					daze_get_meta( 'daze_hide_featured_image' ) ||
					( true === get_theme_mod( 'daze_hide_featured_image' ) && !( daze_posts_get_meta( 'daze_ignore_global' ) ) )
				)
			) :
		?>
			<div class="featured-img"><?php echo get_the_post_thumbnail(); ?></div>
		<?php elseif ( 'hide-title' !== daze_get_meta( 'daze_pages_hide_title' ) ) : ?>
			<div class="h-line"></div>
		<?php endif; ?>
		</div><!-- .featured-area -->
		
		<main id="main" class="clearfix <?php echo esc_attr( $layout_class ); ?>">
		<?php
		while ( have_posts() ) :
			the_post();
			
			get_template_part( 'template-parts/content', 'page' );
				
			$contact_form = "";
			$contact_photo = "";
			$contact_map = "";
			$contact_section = 0;
			$contact_sections = 0;
			
			if( $get_contact_form = html_entity_decode ( daze_pages_get_meta( 'daze_contact_form_shortcode' ) ) ) {
				$contact_sections++;
			}
			
			if( $get_contact_photo_id = daze_pages_get_meta( 'daze_contact_photo_id' ) ) {
				$contact_sections++;
			}
			
			if( $get_contact_map = ( daze_pages_get_meta( 'daze_contact_gmap_lat' ) && daze_pages_get_meta( 'daze_contact_gmap_lng' ) ) || daze_pages_get_meta( 'daze_contact_gmap_addr' ) ) {
				$contact_sections++;
			}			
			
		// Contact form		
			if( $get_contact_form ) :
				$contact_section++;
			?>
			<div class="contact-form section-<?php echo absint( $contact_section ); ?>-of-<?php echo absint( $contact_sections ); ?>">
			<?php				
				if( $contact_form_heading = daze_pages_get_meta( 'daze_contact_form_heading' ) ) {
			?>
				<div class="section-heading"><h4><?php echo esc_html( $contact_form_heading ); ?></h4></div>
			<?php
				}
				
				echo do_shortcode( $get_contact_form );
			?>
			</div>
			<?php				
			endif;
			
		// Contact photo		
			if ( $get_contact_photo_id ) :
				$contact_section++;
			?>
			<div class="contact-photo section-<?php echo absint( $contact_section ); ?>-of-<?php echo absint( $contact_sections ); ?>">
			<?php				
				if( $contact_photo_heading = daze_pages_get_meta( 'daze_contact_photo_heading' ) ) {
			?>
				<div class="section-heading"><h4><?php echo esc_html( $contact_photo_heading ); ?></h4></div>
			<?php
				}
				
				echo wp_get_attachment_image( $get_contact_photo_id, 'full' );
			?>
			</div>
			<?php				
				if( $contact_section == 2 ) :
			?>
			<div class="clearfix"></div>
			<?php
				endif;
			endif;
			
			
		// Contact map
			if ( $get_contact_map ) :
				$contact_section++;
			?>
			<div class="contact-map section-<?php echo absint( $contact_section ); ?>-of-<?php echo absint( $contact_sections ); ?>">
			<?php				
				if( $contact_map_heading = daze_pages_get_meta( 'daze_contact_gmap_heading' ) ) {
			?>
				<div class="section-heading"><h4><?php echo esc_html( $contact_map_heading ); ?></h4></div>
			<?php
				}
				
				echo '<div class="g-map"></div>';
			?>
			</div>
			<?php
				if( $contact_sections == 2 ) :
			?>
			<div class="clearfix"></div>
			<?php
				endif;
			endif;			
				
			if( false === get_theme_mod( 'daze_disable_wp_comments', false ) && comments_open() ) {
				comments_template();
			}
			
			if( daze_get_meta( 'daze_allow_fb_comments' ) ) :
			?>
			<div class="fb-comments" data-href="<?php echo esc_url( get_permalink() ); ?>" data-numposts="5"></div>
			<?php
			endif;
			
		endwhile;
		?>
		</main><!-- #main -->
	
		<?php
			if( daze_get_meta( 'daze_include_sidebar' ) ) {
				get_sidebar();
			}
		?>
	</div><!-- .main-holder -->
		
<?php get_footer(); ?>