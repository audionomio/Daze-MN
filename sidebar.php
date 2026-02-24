<?php
/* ===================================================
	Sidebar template, displaying the main widget area
	Daze - Premium WordPress Theme, by NordWood
====================================================== */
	if( is_active_sidebar( 'sidebar-1' )  ) :
?>
	<aside id="sidebar" class="sidebar"><?php
		dynamic_sidebar( 'sidebar-1' );
	?></aside>
<?php
	endif;
?>