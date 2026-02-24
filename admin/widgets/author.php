<?php
/* ==============================================
	Daze author widget
	Daze - Premium WordPress Theme, by NordWood
================================================= */
add_action('widgets_init', 'daze_author_widget_init');
 
if( !function_exists( 'daze_author_widget_init' ) ) :
	function daze_author_widget_init() {
		register_widget( 'daze_author_widget' );
	}
endif;

// Widget class
class Daze_Author_Widget extends WP_Widget {
    public function __construct() {
        $widget_ops = array(
            'description' => esc_html__( 'Info about the site owner', 'daze' )
        );

        parent::__construct( 'daze_author_widget', esc_html__( 'Daze author widget', 'daze' ), $widget_ops );

        add_action( 'admin_enqueue_scripts', array($this, 'daze_author_widget_assets') );
    }

	public function daze_author_widget_assets() {
		wp_enqueue_media();
		wp_enqueue_script( 'daze_img_upload' );
	}

// Widget frontend content
    function widget($args, $instance) {
        $before_widget = $args['before_widget'];
        $after_widget  = $args['after_widget'];
        $before_title  = $args['before_title'];
        $after_title   = $args['after_title'];
		
		echo wp_kses(
			$before_widget,
			array(
				'section' => array(
					'id' 	=> array(),
					'class' => array()
				)
			)
		);
		
		$get_title = isset( $instance['title'] ) ? strip_tags( $instance['title'] ) : esc_html__( 'About me', 'daze' );
			
		if ( '' != $get_title ) {
			echo wp_kses(
				$before_title,
				array(
					'h6' => array(
						'class' => array()
					)
				)
			);
			
			echo apply_filters( 'widget_title', $get_title );
			
			echo wp_kses(
				$after_title,
				array(
					'h6' => array()
				)
			);
		}
		
		$archive = '';
		
		if ( isset( $instance['nick'] ) && '' != $instance['nick'] ) {
			$user = get_user_by( 'login', $instance['nick'] );
			
			if ( $user ) {
				$user_id = $user->ID;				
				$archive = get_author_posts_url( $user_id );
			}
		}
		
		if ( '' !== $archive ) {
			printf(
				'<a href="%1$s">%2$s</a>',
				esc_url( $archive ),
				daze_giffy_attachment( absint( $instance['img_id'] ), 'medium_large' )
			);
			
		} else {
			echo daze_giffy_attachment( absint( $instance['img_id'] ), 'medium_large' );
		}
		
		if ( isset( $instance['about_text'] ) ) {
			printf(
				'<p>%s</p>',
				esc_html( $instance['about_text'] )
			);
		}
		
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
			'title' => esc_html__( 'About me', 'daze' ),
			'about_text' => '',
			'img_url' => '',
			'img_id' => '',
			'nick' => ''
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
			<label for="<?php echo esc_attr( $this->get_field_id('about_text') ); ?>"><?php esc_html_e( 'Info:', 'daze' ); ?></label>
			<textarea class="widefat" rows="7"
				name="<?php echo esc_attr( $this->get_field_name('about_text') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('about_text') ); ?>"
			><?php echo esc_textarea( $instance['about_text'] ); ?></textarea>
		</p>
			
		<div class="img-upload-wrapper clearfix">				
			<div class="img-preview">
			<?php
				if ( '' != $instance['img_id'] && 0 != $instance['img_id'] ) :
					echo wp_get_attachment_image( absint( $instance['img_id'] ), 'thumbnail' );
				endif;
			?>
			</div>
			<p></p>
			
			<?php
				$img_arr = wp_get_attachment_image_src( absint( $instance['img_id'] ) );
			?>
			<label for="<?php echo esc_attr( $this->get_field_name('img_url') ); ?>"><?php esc_html_e( 'Image URL:', 'daze' ); ?></label>
			<input type="text" class="img-url widefat"
				name="<?php echo esc_attr( $this->get_field_name('img_url') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('img_url') ); ?>"
				value="<?php echo esc_url( $img_arr[0] ); ?>"
			>
			
			<input type="hidden" class="img-id"
				name="<?php echo esc_attr( $this->get_field_name('img_id') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('img_id') ); ?>"						
				value="<?php echo esc_attr( $instance['img_id'] ); ?>"
			>
			<p></p>
			
			<input type="button" class="button upload-img <?php if( $instance['img_id'] != '' ) echo 'hidden'; ?>"
				name="<?php echo esc_attr( $this->get_field_name('upload_img') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('upload_img') ); ?>"
				value="<?php esc_attr_e('Upload Image', 'daze'); ?>"
			>			
			<input type="button" class="button remove-img <?php if( $instance['img_id'] == '' ) echo 'hidden'; ?>"
				name="<?php echo esc_attr( $this->get_field_name('remove_img') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('remove_img') ); ?>"
				value="<?php esc_attr_e('Remove Image', 'daze'); ?>"
			>
			<p></p>
		</div>
		
		<p><?php esc_html_e( 'Add the author\'s nickname if you want to link the image to author\'s archive.', 'daze' ); ?></p>
		
		<p>	
			<label for="<?php echo esc_attr( $this->get_field_name('nick') ); ?>"><?php esc_html_e( 'Nickname:', 'daze' ); ?></label>			
			<input type="text" class="widefat"
				name="<?php echo esc_attr( $this->get_field_name('nick') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('nick') ); ?>"
				value="<?php echo esc_attr( $instance['nick'] ); ?>"
			>
		</p>
	<?php
    }

    // widget update
    function update($new_instance, $old_instance) {
        $instance = $old_instance;		
		
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['about_text'] = sanitize_text_field( $new_instance['about_text'] );
        $instance['img_id'] = sanitize_text_field( $new_instance['img_id'] );
        $instance['img_url'] = esc_url_raw( $new_instance['img_url'] );
        $instance['nick'] = sanitize_text_field( $new_instance['nick'] );

        return $instance;
    }
}
?>