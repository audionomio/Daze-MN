<?php
/* ==============================================
	Search form
	Daze - Premium WordPress Theme, by NordWood
================================================= */
	$search_placeholder = get_theme_mod( 'daze_search_placeholder', esc_attr__( 'Type your search', 'daze' ) );
?>
<form role="search" autocomplete="off" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field"
		name="s"
		title="<?php echo esc_attr( $search_placeholder ); ?>"
		placeholder="<?php echo esc_attr( $search_placeholder ); ?>"
		value="<?php echo get_search_query(); ?>"
	/>
	
	<button type="submit" class="search-submit"><?php
		echo is_rtl() ? daze_get_svg_arrow_left() : daze_get_svg_arrow_right();
	?></button>
</form>