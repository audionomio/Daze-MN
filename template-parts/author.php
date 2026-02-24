<?php
/* =====================================================
	Template part containing the info about the author
	Daze - Premium WordPress Theme, by NordWood
======================================================== */
?>
<article class="author clearfix">
	<?php
		$author_id = get_post_field( 'post_author', get_the_ID() );
		
		if ( $img_id = get_user_meta( $author_id, 'daze_user_img', true ) ) {
			printf(
				'<span class="user-photo">%s</span>',
				daze_giffy_attachment( $img_id, 'daze_small' )
			);
			
		} else {
			echo get_avatar( get_the_author_meta( 'ID' ), 96 );
		}
	?>
	
	<div class="info">
		<h5><?php the_author_meta( 'nickname' ); ?></h5>
		<p><?php the_author_meta( 'description' ); ?></p>
	</div>
</article>