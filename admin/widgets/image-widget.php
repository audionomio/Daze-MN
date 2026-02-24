<?php
/* ==============================================
	Daze image widget
	Daze - Premium WordPress Theme, by NordWood
=================================================*/
add_action('widgets_init', 'daze_img_widget_init');

if( !function_exists( 'daze_img_widget_init' ) ) :
	function daze_img_widget_init() {
		register_widget( 'daze_img_widget' );
	}
endif;

// Widget class
class Daze_Img_Widget extends WP_Widget {
    public function __construct() {
        $widget_ops = array(
            'description' => esc_html__( 'Single image banner', 'daze' )
        );

        parent::__construct( 'daze_img_widget', esc_html__( 'Daze image widget', 'daze' ), $widget_ops );

        add_action('admin_enqueue_scripts', array( $this, 'daze_img_widget_assets' ));
    }

	public function daze_img_widget_assets() {
		wp_enqueue_media();
		wp_enqueue_script( 'daze_upload_img' );
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
		
		if( isset( $instance['img_id'] ) ) {
			if ( !empty( $instance['img_link'] ) ) {
				$get_target = isset( $instance['img_link_new_tab'] ) ? esc_attr( $instance['img_link_new_tab'] ) : 1;
			
			?>	
				<a href="<?php echo esc_url( $instance['img_link'] ); ?>" <?php if( $get_target == 1 ) echo 'target="_blank"'; ?>><?php
					echo daze_giffy_attachment( absint( $instance['img_id'] ), 'medium_large' );
				?></a>				
			<?php	
			
			} else {
				echo daze_giffy_attachment( absint( $instance['img_id'] ), 'medium_large' );
			}				
		}
		
		echo wp_kses(
			$after_widget,
			array(
				'section' => array()
			)
		);
	}

// Widget backend
	function form($instance) {
		$defaults = array( 
			'img_link' => '',
			'img_link_new_tab' => 1,
			'img_id' => '',
			'img_uri' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name('img_link') ); ?>"><?php esc_html_e( 'Link URL:', 'daze' ); ?></label>			
			<input type="url" class="widefat"
				name="<?php echo esc_attr( $this->get_field_name('img_link') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('img_link') ); ?>"
				value="<?php echo esc_attr( $instance['img_link'] ); ?>"
			>
		</p>	
		
		<p>
			<input type="checkbox"
				name="<?php echo esc_attr( $this->get_field_name('img_link_new_tab') ); ?>" 
				id="<?php echo esc_attr( $this->get_field_id('img_link_new_tab') ); ?>"
				value="1" <?php checked( $instance['img_link_new_tab'], 1 ); ?>
			>
			<label for="<?php echo esc_attr( $this->get_field_id('img_link_new_tab') ); ?>"><?php esc_html_e( 'Open link in new tab', 'daze' ); ?></label>
		</p>		
		
		<div class="img-upload-wrapper clearfix">				
			<div class="img-preview">
			<?php
				if ( $instance['img_id'] != '' ) :
					echo wp_get_attachment_image( absint( $instance['img_id'] ), 'thumbnail' );
				endif;
			?>
			</div>
			<p></p>
			
			<label for="<?php echo esc_attr( $this->get_field_name('img_uri') ); ?>"><?php esc_html_e( 'Image URL:', 'daze' ); ?></label>
			<input type="url" class="img-url widefat"
				name="<?php echo esc_attr( $this->get_field_name('img_uri') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('img_uri') ); ?>"
				value="<?php echo esc_attr( $instance['img_uri'] ); ?>"
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
				value="<?php esc_attr_e( 'Upload Image', 'daze' ); ?>"
			>			
			<input type="button" class="button remove-img <?php if( $instance['img_id'] == '' ) echo 'hidden'; ?>"
				name="<?php echo esc_attr( $this->get_field_name('remove_img') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('remove_img') ); ?>"
				value="<?php esc_attr_e( 'Remove Image', 'daze' ); ?>"
			>
			<p></p>
		</div>

	<?php
    }

// Widget update
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;		
		
        $instance['img_link'] = sanitize_text_field( $new_instance['img_link'] );
		$instance['img_link_new_tab']		= isset( $new_instance['img_link_new_tab'] ) ? esc_attr( $new_instance['img_link_new_tab'] ) : 0;
        $instance['img_id'] = sanitize_text_field( $new_instance['img_id'] );
        $instance['img_uri'] = sanitize_text_field( $new_instance['img_uri'] );
		
        return $instance;
    }
}
?>