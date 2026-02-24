<?php
/* ==============================================
	404 PAGE TEMPLATE
	Daze - Premium WordPress Theme, by NordWood
================================================= */
	get_header(); ?>
	<div class="main-holder content-wrapper clearfix">
		<div class="post-header">			
			<h6 class="err404-desc"><?php
				echo esc_html( get_theme_mod( 'daze_page_404_desc', esc_html__( '404 error', 'daze' ) ) );
			?></h6>		
			
			<h1 class="err404-title"><?php
				echo esc_html( get_theme_mod( 'daze_page_404_heading', esc_html__( 'Oops! This page is not here anymore...', 'daze' ) ) );
			?></h1>
			
			<div class="post-meta err404-txt"><?php
				echo esc_html( get_theme_mod( 'daze_page_404_text' ) );
			?></div>
		</div>
		
	<?php
		if( '' !== $bttn_label = get_theme_mod( 'daze_page_404_bttn_label', esc_html__( 'Back to home', 'daze' ) ) ) {
	?>
		<main id="main" role="main">
			<a class="button-link err404-bttn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php
				echo esc_html( $bttn_label );
			?></a>
		</main>
	<?php
		}
	?>
	</div>	
<?php
	get_footer();
?>