<?php 
/* ==============================================
	DAZE POPOUT WIDGET
	Daze - Premium WordPress Theme, by NordWood
================================================= */
	add_action( 'widgets_init', 'daze_popout_widget_init' );
	
	if ( ! function_exists( 'daze_popout_widget_init' ) ) :
		function daze_popout_widget_init() {
			register_widget( 'Daze_Popout_Widget' );
		}
	endif;

	class Daze_Popout_Widget extends WP_Widget {
		public function __construct() {
			$widget_ops = array(
				'description' => esc_html__( 'Widget with a link to popoutout page.', 'daze' )
			);

			parent::__construct( 'daze_popout_widget', esc_html__( 'Daze Popout Widget', 'daze' ), $widget_ops );

			add_action( 'admin_enqueue_scripts', array($this, 'daze_popout_widget_assets') );
		}

		public function daze_popout_widget_assets() {
			wp_enqueue_media();
			wp_enqueue_script( 'daze_img_upload' );
		}

/*	Widget frontend
====================== */
		function widget( $args, $instance ) {
			$before_widget = $args['before_widget'];
			$after_widget  = $args['after_widget'];
			$before_title  = $args['before_title'];
			$after_title   = $args['after_title'];
			
			$popout_id = absint( $instance['popout_page'] );
			$popout_url = get_permalink( $popout_id );
			$popout_label = $instance['label'];
			$popout_img = get_post_meta( $popout_id, 'daze_popout_img_preview', true );
			$img_url = '';
			
			if ( '' != $popout_img ) {
				$img_url = daze_get_giffy_attachment_url( $popout_img, 'medium_large' );
				
			} else if ( has_post_thumbnail( $popout_id ) ) {
				$img_url = daze_get_giffy_featured_img_url( $popout_id, 'medium_large' );
			}
			
			if ( false === $popout_url ) {
				return '';
				
			} else {
				echo wp_kses(
					$before_widget,
					array(
						'section' => array(
							'id' 	=> array(),
							'class' => array()
						),
						'div' => array(
							'id' 	=> array(),
							'class' => array()
						)
					)
				);
				?>
				<a class="popout-page" href="<?php echo esc_url( $popout_url ); ?>">
					<svg class="svg-clipper clipper-shape" width="100%" height="100%" viewBox="0 0 200 200">
					  <defs>
							<clipPath id="clipper-romb" clipPathUnits="objectBoundingBox" transform="scale(0.005 0.005)">
								<polygon points="0 100 100 0 200 100 100 200"/>
							</clipPath>
					   </defs>
					</svg>
		
					<div class="masked-holder">
						<div class="clipped-item pop-img bgr-cover" style="background-image:url('<?php echo esc_url( $img_url ); ?>'); clip-path: url(#clipper-romb);"></div>
						<div class="icon"><?php echo daze_get_svg_arrow_45(); ?></div>
					</div>
				<?php
					if ( '' !==  $popout_label ) {
						printf(
							'<h3>%s</h3>',
							esc_html( $popout_label )
						);
					}
				?>
				</a>					
				<?php
				echo wp_kses(
					$after_widget,
					array(
						'section' 	=> array(),
						'div'		=> array()
					)
				);
			}
		}

/*	Widget backend
====================== */
		public function form( $instance ) {
			$defaults = array(
				'popout_page'	=> '',
				'label'		=> ''
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			$popout_args = array(
				'post_type' 	=> 'popout',
				'post_status'	=> 'publish'
			);
			
			$popouts = get_posts( $popout_args );
			
			if ( ! $popouts ) {
				printf(
					'<p>%1$s</p><p><a href="%2$s">%3$s</a></p>',
					esc_html__( 'Oops! It seems like you don\'t have any Popout page yet. Click on the link below to create a popout.', 'daze' ),
					esc_url( admin_url( 'post-new.php?post_type=popout' ) ),
					esc_html__( 'Add Popout Page', 'daze' )
				);
				
				return;
				
			} else {
		?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'popout_page' ) ); ?>"><?php esc_html_e( 'Popout page', 'daze' ); ?></label>
				
				<select name="<?php echo esc_attr( $this->get_field_name( 'popout_page' ) ); ?>"
					id="<?php echo esc_attr( $this->get_field_id( 'popout_page' ) ); ?>">
			<?php				
				foreach ( $popouts as $popout ) {
					$popout_name = $popout->post_title;
					$popout_id = $popout->ID;
			?>
					<option value="<?php echo esc_attr( $popout_id ); ?>" <?php echo ( $popout_id === absint( $instance['popout_page'] ) ) ? 'selected' : ''; ?>><?php
						echo esc_html( $popout_name );
					?></option>
			<?php
				}
			?>
				</select>
			</p>
		
			<p>	
				<label for="<?php echo esc_attr( $this->get_field_name( 'label' ) ); ?>"><?php esc_html_e( 'Popout link title:', 'daze' ); ?></label>			
				<input type="text" class="widefat"
					name="<?php echo esc_attr( $this->get_field_name( 'label' ) ); ?>"
					id="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>"
					value="<?php echo esc_attr( $instance['label'] ); ?>"
					placeholder="<?php esc_attr_e( 'Check this out', 'daze' ); ?>"
				>
			</p>
		<?php
			}
		}

/*	Widget update
==================== */
		public function update($new_instance, $old_instance) {
			$instance = $old_instance;
			
			$instance['popout_page'] 	= sanitize_text_field( $new_instance['popout_page'] );
			$instance['label'] 			= sanitize_text_field( $new_instance['label'] );
			
			return $instance;
		}	
	}
?>