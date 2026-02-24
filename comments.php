<?php
/* ==============================================
	Comments template
	Daze - Premium WordPress Theme, by NordWood
================================================= */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if( post_password_required() || !post_type_supports( get_post_type(), 'comments' ) ) {
	return;
}
?>
<section id="comments" class="comments-area">
	<?php $comments_number = get_comments_number(); ?>
	
	<header class="comments-header">	
	<?php
	if( !( comments_open() ) ) {
		esc_html_e( 'Comments are closed.', 'daze' );
		
	} else if( comments_open() && !$comments_number ) {
		esc_html_e( 'No comments yet. Be the first one to leave a thought.', 'daze' );
		
	} else {
	?>
		<span class="comments-number"><?php echo esc_html( number_format_i18n( $comments_number ) ); ?></span>
		
		<span class="comments-heading-text">
		<?php
			printf(
				esc_html(_nx(
					'Comment',
					'Comments',
					get_comments_number(),
					'comments title',
					'daze'
				)),
				get_comments_number()
			);
		?>
		</span>
	<?php
	}
	?>
	</header>
	
	<?php if( have_comments() && comments_open() ) : ?>
	<ol class="comment-list">
	<?php
		wp_list_comments( array(
			'style'       	=> 'ol',
			'short_ping'  	=> true,
			'avatar_size' 	=> 96,
			'max_depth'		=> 2,
			'style'			=> 'ul',
			'callback'		=> 'daze_comments_list'
		));
	?>
	</ol>

	<?php
	$arrow_left = daze_get_svg_arrow_left();
	$arrow_right = daze_get_svg_arrow_right();
	?>
	<div class="comments-nav clearfix">
		<div class="prev"><?php
			if( is_rtl() ) {
				previous_comments_link( esc_html__( 'Older Comments', 'daze' ) . $arrow_left );
				
			} else {
				previous_comments_link( $arrow_left . esc_html__( 'Older Comments', 'daze' ) );
			}
		?></div>
		
		<div class="next"><?php
			if( is_rtl() ) {
				next_comments_link( $arrow_right . esc_html__( 'Newer Comments', 'daze' ) );
				
			} else {
				next_comments_link( esc_html__( 'Newer Comments', 'daze' ) . $arrow_right );
			}
		?></div>
	</div>	
	<?php endif; ?>

	<?php	
	$comment_form_args = array(
		'title_reply'			=> esc_html__( 'Leave a Comment','daze' ),
		'title_reply_before'	=> '<h4>',
		'title_reply_after'		=> '</h4>',
		'title_reply_to'		=> esc_html__( 'Reply to %s','daze' ),
		'cancel_reply_link'		=> esc_html__( 'Cancel Reply','daze' ),
		'label_submit'			=> esc_html__( 'Post a comment','daze' ),
		'class_submit'			=> 'button-link',
		'fields'				=> apply_filters(
			'comment_form_default_fields', array(
				'author' =>'<input type="text"
									class="cfield-name"
									name="author"
									placeholder="' . esc_attr__( 'Your name', 'daze' ) . '"
									value="' . esc_attr( $commenter['comment_author'] ) . '"
							>',
				'email'  => '<input type="email" class="cfield-email"
									name="email"
									placeholder="' . esc_attr__( 'Your E-mail address', 'daze' ) . '"
									value="' . esc_attr(  $commenter['comment_author_email'] ) . '"
									aria-describedby="email-notes"
							>',
				'url'    => '<input type="url" class="cfield-url"
									name="url"
									placeholder="' . esc_attr__( 'Your website', 'daze' ) . '"
									value="' . esc_attr( $commenter['comment_author_url'] ) . '"
							>'
			)
		),
		'comment_field'			=> '<textarea id="comment"
									name="comment"
									placeholder="' . esc_attr__( 'Enter your comment here', 'daze' ) . '"
									rows="8"
									aria-required="true"
									required="required"></textarea>',
		'comment_notes_before'	=> '',
		'comment_notes_after'	=> '',
		'class_form'			=> 'comment-form clearfix'
	);
	
	comment_form( $comment_form_args );	
	?>
</section>