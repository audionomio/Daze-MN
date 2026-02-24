<?php
/* ===============================================
	Daze Instagram grid widget (Graph API)
	Daze MN - Modernized fork of Daze by NordWood
================================================== */
add_action( 'widgets_init', 'daze_insta_grid_init' );

if( !function_exists( 'daze_insta_grid_init' ) ) :
	function daze_insta_grid_init() {
		register_widget( 'daze_insta_grid' );
	}
endif;

class Daze_Insta_Grid extends WP_Widget {
    public function __construct() {
        $widget_ops = array(
            'classname' => 'insta insta-grid social-instagram clearfix',
            'description' => esc_html__( 'Show Instagram feed (grid)', 'daze' )
        );

        parent::__construct( 'daze_insta_grid', esc_html__( 'Daze Instagram grid', 'daze' ), $widget_ops );
    }

// Widget frontend
    function widget( $arg, $instance ) {
        $before_widget = $arg['before_widget'];
        $after_widget  = $arg['after_widget'];
        $before_title  = $arg['before_title'];
        $after_title   = $arg['after_title'];

		$num = isset( $instance['num'] ) ? absint( $instance['num'] ) : 9;

		$media = Daze_Instagram_API::get_media( $num );

		if ( is_wp_error( $media ) || empty( $media ) ) {
			if ( current_user_can( 'manage_options' ) ) {
				$message = is_wp_error( $media ) ? $media->get_error_message() : __( 'No media found.', 'daze' );
				echo '<p class="daze-instagram-notice" style="padding: 10px; background: #fff3cd; border-left: 4px solid #ffc107;">';
				printf(
					esc_html__( 'Instagram: %s Configure your token in Settings > Instagram.', 'daze' ),
					esc_html( $message )
				);
				echo '</p>';
			}
			return;
		}

		$username = Daze_Instagram_API::get_username();
		$profile_url = is_wp_error( $username ) ? 'https://instagram.com/' : 'https://instagram.com/' . $username;

		echo wp_kses(
			$before_widget,
			array(
				'section' => array(
					'id' 	=> array(),
					'class' => array()
				)
			)
		);

		$get_title = isset( $instance['title'] ) ? strip_tags( $instance['title'] ) : esc_html__( 'Follow me on Instagram', 'daze' );

		if ( '' != $get_title ) {
			echo wp_kses(
				$before_title,
				array(
					'h6' => array(
						'class' => array()
					)
				)
			);

			printf(
				'<a href="%1$s" target="_blank">%2$s%3$s</a>',
				esc_url( $profile_url ),
				daze_get_svg_instagram(),
				apply_filters( 'widget_title', $get_title )
			);

			echo wp_kses(
				$after_title,
				array(
					'h6' => array()
				)
			);
		}

		foreach ( $media as $item ) {
			$image_url = Daze_Instagram_API::get_image_url( $item );
			$permalink = isset( $item['permalink'] ) ? $item['permalink'] : '#';

			if ( empty( $image_url ) ) {
				continue;
			}
		?>
			<div class="item">
				<a style="background-image: url('<?php echo esc_url( $image_url ); ?>');"
				   href="<?php echo esc_url( $permalink ); ?>" target="_blank"></a>
			</div>
		<?php
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
			'title' => esc_html__( 'Follow me on Instagram', 'daze' ),
			'num'   => 9,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$token = get_option( Daze_Instagram_API::TOKEN_OPTION, '' );
	?>
		<?php if ( empty( $token ) ) : ?>
			<p style="color: #d63638;">
				<?php printf(
					esc_html__( 'No Instagram token configured. %s', 'daze' ),
					'<a href="' . esc_url( admin_url( 'options-general.php?page=daze-instagram' ) ) . '">' .
					esc_html__( 'Configure in Settings > Instagram', 'daze' ) . '</a>'
				); ?>
			</p>
		<?php endif; ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_name('title') ); ?>"><?php esc_html_e( 'Title:', 'daze' ); ?></label>
			<input type="text" class="widefat"
				name="<?php echo esc_attr( $this->get_field_name('title') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('title') ); ?>"
				value="<?php echo esc_attr( $instance['title'] ); ?>"
			>
		</p>

		<p>
			<input type="number" min="1" max="25"
				name="<?php echo esc_attr( $this->get_field_name('num') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('num') ); ?>"
				value="<?php echo absint( $instance['num'] ); ?>"
			>
			<label for="<?php echo esc_attr( $this->get_field_id('num') ); ?>"><?php esc_html_e( 'Number of items', 'daze' ); ?></label>
		</p>
	<?php
    }

// Saving widget data
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['num']   = absint( $new_instance['num'] );

        // Clear cache when widget settings change
        Daze_Instagram_API::clear_cache();

        return $instance;
    }
}
?>
