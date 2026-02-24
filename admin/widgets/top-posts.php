<?php
/* ==============================================
	Daze popular/latest posts widget
	Daze - Premium WordPress Theme, by NordWood
================================================= */
add_action( 'widgets_init', 'daze_top_posts_init' );
 
if( !function_exists( 'daze_top_posts_init' ) ) :
	function daze_top_posts_init() {
		register_widget( 'daze_top_posts' );
	}
endif;
 
class Daze_Top_Posts extends WP_Widget {
    public function __construct() {
        $widget_ops = array(
            'classname' => 'top-posts',
            'description' => esc_html__( 'Shows the latest and most viewed posts', 'daze' )
        );
 
        parent::__construct( 'daze_top_posts', esc_html__( 'Daze popular/latest posts', 'daze' ), $widget_ops );
		
		add_action( 'wp_enqueue_scripts', array($this, 'daze_top_posts_assets') );
    }

	public function daze_top_posts_assets() {
		wp_enqueue_style( 'daze_top_posts' );
		wp_enqueue_script( 'daze_top_posts' );
	}
	
// Widget frontend
    function widget( $arg, $instance ) {
        $before_widget = $arg['before_widget'];
        $after_widget  = $arg['after_widget'];
        $before_title  = $arg['before_title'];
        $after_title   = $arg['after_title'];
		
		echo wp_kses(
			$before_widget,
			array(
				'section' => array(
					'id' 	=> array(),
					'class' => array()
				)
			)
		);
		
		$show_popular = isset( $instance['tp_show_popular'] ) ? $instance['tp_show_popular'] : 1;
		$show_latest = isset( $instance['tp_show_latest'] ) ? $instance['tp_show_latest'] : 1;
		
		$tp_title_length = isset( $instance['tp_title_length'] ) ? $instance['tp_title_length'] : 8;
		$tp_hide_views = isset( $instance['tp_hide_views'] ) ? $instance['tp_hide_views'] : 0;
		$tp_hide_date = isset( $instance['tp_hide_date'] ) ? $instance['tp_hide_date'] : 0;	
		$tp_hide_comments = isset( $instance['tp_hide_comments'] ) ? $instance['tp_hide_comments'] : false;
		
		$exclude_cat = array();
		$exclude_cat = explode(',', get_theme_mod('daze_hide_posts_by_cat'));
		
		$tp_popular_title = isset( $instance['tp_popular_title'] ) ? $instance['tp_popular_title'] : esc_html__( 'Popular', 'daze' );
		$tp_latest_title = isset( $instance['tp_latest_title'] ) ? $instance['tp_latest_title'] : esc_html__( 'Latest', 'daze' );
		
		if ( $show_popular == 1 && $show_latest != 1 ) :
		?>
			<h3><?php echo esc_html( $tp_popular_title ); ?></h3>
		<?php
		endif;
		
		if ( $show_popular != 1 && $show_latest == 1 ) :
		?>
			<h3><?php echo esc_html( $tp_latest_title ); ?></h3>
		<?php
		endif;
				
	?>	
		<div class="nav-container"></div>
		
		<div class="top-posts-slider">
		<?php
		
		if( 1 == $show_popular ) {
		?>
			<div data-thumb="<?php echo esc_attr( $tp_popular_title ); ?>">
		<?php			
			global $post;
			$backup = $post;
			
			$popular_args = array(
				'posts_per_page' => isset( $instance['tp_num_of_posts'] ) ? absint( $instance['tp_num_of_posts'] ) : 4,
				'post_status' => 'publish',
				'post_type' => 'post',
				'orderby' => 'meta_value_num',
				'meta_key' => 'daze_post_views_count',
				'order' => 'DESC',
				'category__not_in' => $exclude_cat,
				'ignore_sticky_posts' => 1
			);
				
			$popular_query = new WP_Query( $popular_args );
			
			if( $popular_query->have_posts() ) {				
				while( $popular_query->have_posts() ) {
					$popular_query->the_post();
				?>
				<article class="clearfix">
					<div class="thumb">
						<a class="va-middle" href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"><?php						
							if ( has_post_thumbnail( get_the_ID()) ) {
								echo get_the_post_thumbnail( get_the_ID(), 'daze_small' );
								
							} else if( 'gallery' === get_post_format(get_the_ID()) ) {
								$featured_gallery = get_post_meta( get_the_ID(), 'daze_featured_gallery', true );
								$get_gallery_imgs = explode(', ', $featured_gallery);
								
								if( $get_gallery_imgs == array("") ) {
									$get_gallery_imgs = array();
								}
								
								if( is_array( $get_gallery_imgs ) && !empty( $get_gallery_imgs ) ) {
									echo wp_get_attachment_image( $get_gallery_imgs[0], 'daze_small' );								
								}
								
							} else {
								echo daze_post_format_icon( get_the_ID() );
							}
						?></a>
					</div>
					
					<div class="content">
						<header>
						<?php
							$popular_title = get_the_title();
							if ( strlen( $popular_title ) > 59 ) {
								$popular_title = wp_trim_words( $popular_title, $tp_title_length, '&hellip;' );
							}
						?>
							<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"><h6><?php echo esc_html( $popular_title ); ?></h6></a>
						</header>
						
						<footer class="post-meta">
							<?php
								if( !$tp_hide_views ) {
									printf(
										'%1$s<span>%2$d</span>',
										daze_get_svg_eye(),
										absint( daze_get_post_views( get_the_ID() ) )
									);
								}
								
								$comments_available = false;
								
								if( false === get_theme_mod( 'daze_disable_wp_comments', false ) && comments_open( get_the_ID() ) ) {
									$comments_available = true;
								}
								
								if( $comments_available && false === $tp_hide_comments ) {									
									$n = get_comments_number( get_the_ID() );
									
									if( 0 < $n ) {
										if( !$tp_hide_views ) {
										?>
										<span class="separator"></span>
										<?php
										}
										
										printf(
											'%1$s<span class="comments-count">%2$d</span>',
											daze_get_svg_comments_cloud(),
											absint($n)
										);
									}
								}
							?>
						</footer>
					</div>
				</article>
				<?php
				}
				
				wp_reset_postdata();
				$post = $backup;
			}
		?>
			</div>
		<?php
		}
		?>
			
		<?php
		if( 1 == $show_latest ) :
		?>
			<div data-thumb="<?php echo esc_attr( $tp_latest_title ); ?>">
		<?php
			$latest_args = array(
				'numberposts' => isset( $instance['tp_num_of_posts'] ) ? absint( $instance['tp_num_of_posts'] ) : 4,
				'post_status' => 'publish',
				'post_type' => 'post',
				'orderby' => 'date',
				'order' => 'DESC',
				'category__not_in' => $exclude_cat,
				'ignore_sticky_posts' => 1
			);
			
			$latest_posts = get_posts( $latest_args );
			if( $latest_posts ) :
				foreach( $latest_posts as $latest ) :
			?>
				<article class="clearfix">
					<div class="thumb">
						<a class="va-middle" href="<?php echo esc_url( get_permalink( $latest->ID ) ); ?>"><?php						
							if ( has_post_thumbnail( $latest->ID) ) {
								echo get_the_post_thumbnail( $latest->ID, 'daze_small' );
								
							} else if( 'gallery' === get_post_format(get_the_ID()) ) {
								$featured_gallery = get_post_meta( $latest->ID, 'daze_featured_gallery', true );
								$get_gallery_imgs = explode(', ', $featured_gallery);
								
								if( $get_gallery_imgs == array("") ) {
									$get_gallery_imgs = array();
								}
								
								if( is_array( $get_gallery_imgs ) && !empty( $get_gallery_imgs ) ) {
									echo wp_get_attachment_image( $get_gallery_imgs[0], 'daze_small' );								
								}
								
							} else {
								echo daze_post_format_icon( $latest->ID );
							}
						?></a>
					</div>
					
					<div class="content">
						<header>
						<?php
							$latest_title = $latest->post_title;
							if ( strlen( $latest_title) > 59 ) {
								$latest_title = wp_trim_words( $latest_title, $tp_title_length, '&hellip;' );
							}
						?>
							<a href="<?php echo esc_url( get_permalink( $latest->ID ) ); ?>"><h6><?php echo esc_html( $latest_title ); ?></h6></a>
						</header>
						
						<footer class="post-meta">
							<?php
								if( !$tp_hide_date ) {
									echo esc_html( get_the_date( get_option( 'date_format' ), $latest->ID ) );
								}
								
								$comments_available = false;
								
								if( false === get_theme_mod( 'daze_disable_wp_comments', false ) && comments_open( $latest->ID ) ) {
									$comments_available = true;
								}
								
								if( $comments_available && false === $tp_hide_comments ) {
									$n = get_comments_number();
									
									if( 0 < $n ) {									
										if( !$tp_hide_date ) {
										?>
										<span class="separator"></span>
										<?php
										}
										
										printf(
											'%1$s<span class="comments-count">%2$d</span>',
											daze_get_svg_comments_cloud(),
											absint($n)
										);
									}
								}
							?>
						</footer>
					</div>
				</article>
			<?php 
				endforeach;
			endif;
			?>
			</div>
		<?php
		endif;
		?>
		</div>
	<?php
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
			'tp_num_of_posts'	=> 4,
			'tp_show_latest'	=> 1,
			'tp_show_popular'	=> 1,
			'tp_popular_title'	=> esc_attr__( 'Popular', 'daze' ),
			'tp_latest_title'	=> esc_attr__( 'Latest', 'daze' ),
			'tp_title_length'	=> 8,
			'tp_hide_views'		=> 0,
			'tp_hide_comments'	=> false,
			'tp_hide_date'		=> 0
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>	
		<p>
			<input type="number"
				name="<?php echo esc_attr( $this->get_field_name('tp_num_of_posts') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('tp_num_of_posts') ); ?>"
				value="<?php echo esc_attr( $instance['tp_num_of_posts'] ); ?>"
			>
			<label for="<?php echo esc_attr( $this->get_field_id('tp_num_of_posts') ); ?>"><?php esc_html_e( 'Number of posts', 'daze' ); ?></label>
		</p>
			
		<p>
			<input type="number"
				name="<?php echo esc_attr( $this->get_field_name('tp_title_length') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('tp_title_length') ); ?>"
				value="<?php echo esc_attr( $instance['tp_title_length'] ); ?>"
			>
			<label for="<?php echo esc_attr( $this->get_field_id('tp_title_length') ); ?>"><?php esc_html_e( 'Post title word count', 'daze' ); ?></label>
		</p>
			
		<p>
			<input type="checkbox" value="true"
				name="<?php echo esc_attr( $this->get_field_name('tp_hide_comments') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('tp_hide_comments') ); ?>"
				<?php checked( $instance['tp_hide_comments'], true ); ?>
			>
			<label for="<?php echo esc_attr( $this->get_field_id('tp_hide_comments') ); ?>"><?php esc_html_e( 'Hide comments count', 'daze' ); ?></label>
		</p>
		
		<p>
			<input type="checkbox" value="1"
				name="<?php echo esc_attr( $this->get_field_name('tp_show_popular') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('tp_show_popular') ); ?>"
				<?php checked( $instance['tp_show_popular'], 1 ); ?>
			>
			<label for="<?php echo esc_attr( $this->get_field_id('tp_show_popular') ); ?>"><?php esc_html_e( 'Show popular posts', 'daze' ); ?></label>
		</p>
			
		<p>	
			<label for="<?php echo esc_attr( $this->get_field_name( 'tp_popular_title' ) ); ?>"><?php esc_html_e( 'Title for the most visited posts:', 'daze' ); ?></label>			
			<input type="text" class="widefat"
				name="<?php echo esc_attr( $this->get_field_name( 'tp_popular_title' ) ); ?>"
				id="<?php echo esc_attr( $this->get_field_id( 'tp_popular_title' ) ); ?>"
				value="<?php echo esc_attr( $instance['tp_popular_title'] ); ?>"
				placeholder="<?php esc_attr_e( 'Popular', 'daze' ); ?>"
			>
		</p>
		
		<p>
			<input type="checkbox" value="1"
				name="<?php echo esc_attr( $this->get_field_name('tp_hide_views') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('tp_hide_views') ); ?>"
				<?php checked( $instance['tp_hide_views'], 1 ); ?>
			>
			<label for="<?php echo esc_attr( $this->get_field_id('tp_hide_views') ); ?>"><?php esc_html_e( 'Hide post views', 'daze' ); ?></label>
		</p>
			
		<p>
			<input type="checkbox" value="1"
				name="<?php echo esc_attr( $this->get_field_name('tp_show_latest') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('tp_show_latest') ); ?>"
				<?php checked( $instance['tp_show_latest'], 1 ); ?>
			>
			<label for="<?php echo esc_attr( $this->get_field_id('tp_show_latest') ); ?>"><?php esc_html_e( 'Show latest posts', 'daze' ); ?></label>
		</p>
			
		<p>	
			<label for="<?php echo esc_attr( $this->get_field_name( 'tp_latest_title' ) ); ?>"><?php esc_html_e( 'Title for the most recent posts:', 'daze' ); ?></label>			
			<input type="text" class="widefat"
				name="<?php echo esc_attr( $this->get_field_name( 'tp_latest_title' ) ); ?>"
				id="<?php echo esc_attr( $this->get_field_id( 'tp_latest_title' ) ); ?>"
				value="<?php echo esc_attr( $instance['tp_latest_title'] ); ?>"
				placeholder="<?php esc_attr_e( 'Latest', 'daze' ); ?>"
			>
		</p>
			
		<p>
			<input type="checkbox" value="1"
				name="<?php echo esc_attr( $this->get_field_name('tp_hide_date') ); ?>"
				id="<?php echo esc_attr( $this->get_field_id('tp_hide_date') ); ?>"
				<?php checked( $instance['tp_hide_date'], 1 ); ?>
			>
			<label for="<?php echo esc_attr( $this->get_field_id('tp_hide_date') ); ?>"><?php esc_html_e( 'Hide date', 'daze' ); ?></label>
		</p>
	<?php
    }
	
//saving widget data 
    function update( $new_instance, $old_instance ) {  
        $instance = $old_instance;		
		
        $instance['tp_num_of_posts']	= absint( $new_instance['tp_num_of_posts'] );
		$instance['tp_show_latest']		= isset( $new_instance['tp_show_latest'] ) ? esc_attr( $new_instance['tp_show_latest'] ) : 0;
		$instance['tp_show_popular']	= isset( $new_instance['tp_show_popular'] ) ? esc_attr( $new_instance['tp_show_popular'] ) : 0;
		$instance['tp_title_length']	= absint( $new_instance['tp_title_length'] );
		$instance['tp_hide_views']		= isset( $new_instance['tp_hide_views'] ) ? esc_attr( $new_instance['tp_hide_views'] ) : 0;
		$instance['tp_hide_comments']	= isset( $new_instance['tp_hide_comments'] ) ? esc_attr( $new_instance['tp_hide_comments'] ) : false;
		$instance['tp_hide_date']		= isset( $new_instance['tp_hide_date'] ) ? esc_attr( $new_instance['tp_hide_date'] ) : 0;
		$instance['tp_latest_title']	= sanitize_text_field( $new_instance['tp_latest_title'] );
		$instance['tp_popular_title']	= sanitize_text_field( $new_instance['tp_popular_title'] );

        return $instance;
    }
}
?>