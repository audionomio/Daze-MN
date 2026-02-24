<?php
/* ==============================================
	Daze social widget
	Daze - Premium WordPress Theme, by NordWood
================================================= */
add_action( 'widgets_init', 'daze_social_widget_init' );
 
if ( ! function_exists( 'daze_social_widget_init' ) ) :
	function daze_social_widget_init() {
		register_widget( 'Daze_Social_Widget' );
	}
endif;

// Widget class
class Daze_Social_Widget extends WP_Widget {
    public function __construct() {
        $widget_ops = array(
            'description' => esc_html__( 'Links to social profiles', 'daze' )
        );

        parent::__construct( 'daze_social', esc_html__( 'Daze social widget', 'daze' ), $widget_ops );
    }

// Widget frontend content
    function widget( $args, $instance ) {
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
		
		if ( isset( $instance['desc'] ) && '' != $instance['desc'] ) {
			printf(
				'<h6>%s</h6>',
				esc_html( $instance['desc'] )
			);
		}
		
		if ( isset( $instance['heading'] ) && '' != $instance['heading'] ) {
			printf(
				'<h2>%s</h2>',
				esc_html( $instance['heading'] )
			);
		}
		
		printf(
			'<div class="social">%s</div>',
			daze_get_links_2_social_profiles( false, false )
		);
		
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
			'desc'		=> esc_html__( 'Follow me', 'daze' ),
			'heading'	=> esc_html__( 'Connect', 'daze' )
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>	
			<label for="<?php echo esc_attr( $this->get_field_name('desc') ); ?>"><?php esc_html_e( 'Short description:', 'daze' ); ?></label>			
			<input type="text" class="widefat"
				name="<?php echo esc_attr( $this->get_field_name('desc') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('desc') ); ?>"
				value="<?php echo esc_attr( $instance['desc'] ); ?>"
			>
		</p>
		
		<p>	
			<label for="<?php echo esc_attr( $this->get_field_name('heading') ); ?>"><?php esc_html_e( 'Heading:', 'daze' ); ?></label>			
			<input type="text" class="widefat"
				name="<?php echo esc_attr( $this->get_field_name('heading') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('heading') ); ?>"
				value="<?php echo esc_attr( $instance['heading'] ); ?>"
			>
		</p>
	<?php
    }

// Widget update
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;		
		
        $instance['desc'] = sanitize_text_field( $new_instance['desc'] );
        $instance['heading'] = sanitize_text_field( $new_instance['heading'] );

        return $instance;
    }
}
?>