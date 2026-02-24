<?php
/* ==============================================
	Daze latest comments widget
	Daze - Premium WordPress Theme, by NordWood
================================================= */
add_action( 'widgets_init', 'daze_latest_comments_init' );
 
if( !function_exists( 'daze_latest_comments_init' ) ) :
	function daze_latest_comments_init() {
		register_widget( 'daze_latest_comments' );
	}
endif;
 
class Daze_Latest_Comments extends WP_Widget { 	
    public function __construct() {
        $widget_ops = array(
            'classname' => 'latest-comments',
            'description' => esc_html__( 'Show recently commented posts', 'daze' )
        );
 
        parent::__construct( 'daze_top_comments', esc_html__( 'Daze latest comments', 'daze' ), $widget_ops ); 
    }
	
// Widget frontend
    function widget( $arg, $instance ) {
        $before_widget = $arg['before_widget'];
        $after_widget  = $arg['after_widget'];
        $before_title  = $arg['before_title'];
        $after_title   = $arg['after_title'];
		
	// Scripts and styles
		wp_enqueue_style( 'daze_latest_comments' );
		
		echo wp_kses(
			$before_widget,
			array(
				'section' => array(
					'id' 	=> array(),
					'class' => array()
				)
			)
		);
		
		$get_title = isset( $instance['title'] ) ? strip_tags( $instance['title'] ) : esc_html__( 'Latest Comments', 'daze' );
		
		if ( '' != $get_title ) {
			printf(
				'<h3>%s</h3>',
				apply_filters( 'widget_title', $get_title )
			);
		}
		
		$comments_args = array(
			'number' => isset( $instance['num_of_posts'] ) ? absint( $instance['num_of_posts'] ) : 4,
			'orderby' => 'comment_date',
			'order' => 'DESC',
			'status' => 'approve'
		);
		
		$comments = get_comments( $comments_args );
		if( $comments ) :
			foreach( $comments as $comment ){
			?>
			<article class="clearfix">
				<div class="thumb">
					<?php echo get_avatar( $comment->comment_author_email ); ?>
				</div>
				
				<div class="content">
					<header class="post-meta">
						<p><?php
							$comment_author = ( $comment->comment_author ) ? ( $comment->comment_author ) : 'Anonymous';
							echo esc_html( $comment_author );
						?></p>
					</header>
					<?php 
						$post_id = $comment->comment_post_ID;
						$post_title = get_the_title( $post_id );
						if ( strlen( $post_title ) > 39 ) {
							$post_title = substr( $post_title, 0, 36 );
							$post_title .= '...';
						}
					?>
						<p>
							<?php esc_html_x( 'on', 'preposition, used on Latest Comments widget', 'daze' ); ?>
							<a href="<?php echo esc_url( get_permalink( $comment->comment_post_ID ) ); ?>">
								<strong><?php echo esc_html( $post_title ); ?></strong>
							</a>
						</p>
					
					<footer class="post-meta">						
						<p><?php echo esc_html( date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), strtotime( $comment->comment_date ) ) ); ?></p>
					</footer>
				</div>
			</article>
			<?php 
			}
		endif;
		
		echo wp_kses(
			$after_widget,
			array(
				'section' => array()
			)
		);
    }
	
// Widget backend
    function form( $instance ) {
		$defaults = array(
			'title' => esc_html__( 'Latest Comments', 'daze' ),
			'num_of_posts' => 4
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>	
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name('title') ); ?>"><?php esc_html_e( 'Title:', 'daze' ); ?></label>			
			<input type="text" class="widefat"
				name="<?php echo esc_attr( $this->get_field_name('title') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('title') ); ?>"
				value="<?php echo esc_attr( $instance['title'] ); ?>"
			>
		</p>
		
		<p>
			<input type="number"
				name="<?php echo esc_attr( $this->get_field_name('num_of_posts') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('num_of_posts') ); ?>"
				value="<?php echo esc_attr( $instance['num_of_posts'] ); ?>"
			>
			<label for="<?php echo esc_attr( $this->get_field_id('num_of_posts') ); ?>"><?php esc_html_e( 'Number of posts', 'daze' ); ?></label>
		</p>
	<?php
    }
	
// Saving widget data 
    function update( $new_instance, $old_instance ) {  
        $instance = $old_instance;		
		
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['num_of_posts'] = absint( $new_instance['num_of_posts'] );

        return $instance;
    }
}
?>