<?php
/**
 * Daze Instagram Settings Page
 *
 * Provides admin UI for configuring the Instagram Graph API access token.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Daze_Instagram_Settings {

	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'add_menu_page' ) );
		add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
		add_action( 'wp_ajax_daze_test_instagram', array( __CLASS__, 'ajax_test_connection' ) );
		add_action( 'wp_ajax_daze_clear_instagram_cache', array( __CLASS__, 'ajax_clear_cache' ) );
	}

	public static function add_menu_page() {
		add_options_page(
			__( 'Instagram Settings', 'daze' ),
			__( 'Instagram', 'daze' ),
			'manage_options',
			'daze-instagram',
			array( __CLASS__, 'render_page' )
		);
	}

	public static function register_settings() {
		register_setting( 'daze_instagram', Daze_Instagram_API::TOKEN_OPTION, array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
		) );
	}

	public static function ajax_test_connection() {
		check_ajax_referer( 'daze_instagram_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( __( 'Unauthorized.', 'daze' ) );
		}

		$result = Daze_Instagram_API::test_connection();

		if ( is_wp_error( $result ) ) {
			wp_send_json_error( $result->get_error_message() );
		}

		$username = Daze_Instagram_API::get_username();
		$username_text = is_wp_error( $username ) ? '' : $username;

		wp_send_json_success( sprintf(
			__( 'Connected successfully to @%s', 'daze' ),
			esc_html( $username_text )
		) );
	}

	public static function ajax_clear_cache() {
		check_ajax_referer( 'daze_instagram_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( __( 'Unauthorized.', 'daze' ) );
		}

		Daze_Instagram_API::clear_cache();
		wp_send_json_success( __( 'Cache cleared.', 'daze' ) );
	}

	public static function render_page() {
		$token  = get_option( Daze_Instagram_API::TOKEN_OPTION, '' );
		$expiry = get_option( Daze_Instagram_API::TOKEN_EXPIRY, 0 );
		$nonce  = wp_create_nonce( 'daze_instagram_nonce' );
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Instagram Settings', 'daze' ); ?></h1>

			<form method="post" action="options.php">
				<?php settings_fields( 'daze_instagram' ); ?>

				<table class="form-table">
					<tr>
						<th scope="row">
							<label for="daze_instagram_access_token">
								<?php esc_html_e( 'Access Token', 'daze' ); ?>
							</label>
						</th>
						<td>
							<input type="text" id="daze_instagram_access_token"
								name="<?php echo esc_attr( Daze_Instagram_API::TOKEN_OPTION ); ?>"
								value="<?php echo esc_attr( $token ); ?>"
								class="large-text" autocomplete="off" />
							<p class="description">
								<?php esc_html_e( 'Enter your Instagram Graph API long-lived access token.', 'daze' ); ?>
							</p>
						</td>
					</tr>

					<?php if ( $expiry > 0 ) : ?>
					<tr>
						<th scope="row"><?php esc_html_e( 'Token Expires', 'daze' ); ?></th>
						<td>
							<?php
							$expiry_date = date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), $expiry );
							$days_left   = max( 0, round( ( $expiry - time() ) / DAY_IN_SECONDS ) );

							if ( $days_left < 7 ) {
								printf(
									'<span style="color: #d63638;">%s (%s)</span>',
									esc_html( $expiry_date ),
									sprintf( esc_html__( '%d days left', 'daze' ), $days_left )
								);
							} else {
								printf(
									'%s (%s)',
									esc_html( $expiry_date ),
									sprintf( esc_html__( '%d days left', 'daze' ), $days_left )
								);
							}
							?>
							<p class="description">
								<?php esc_html_e( 'Tokens are automatically refreshed every 50 days.', 'daze' ); ?>
							</p>
						</td>
					</tr>
					<?php endif; ?>
				</table>

				<?php submit_button( __( 'Save Token', 'daze' ) ); ?>
			</form>

			<hr />

			<h2><?php esc_html_e( 'Actions', 'daze' ); ?></h2>
			<p>
				<button type="button" class="button" id="daze-test-instagram">
					<?php esc_html_e( 'Test Connection', 'daze' ); ?>
				</button>
				<button type="button" class="button" id="daze-clear-instagram-cache">
					<?php esc_html_e( 'Clear Cache', 'daze' ); ?>
				</button>
				<span id="daze-instagram-result" style="margin-left: 10px;"></span>
			</p>

			<hr />

			<h2><?php esc_html_e( 'How to get an Access Token', 'daze' ); ?></h2>
			<ol>
				<li><?php esc_html_e( 'Make sure your Instagram account is a Business or Creator account (convert in Instagram app under Settings > Account > Switch to Professional Account).', 'daze' ); ?></li>
				<li><?php printf(
					/* translators: %s: URL to Meta Developer portal */
					esc_html__( 'Go to %s and create a new app (select "Business" type).', 'daze' ),
					'<a href="https://developers.facebook.com/apps/" target="_blank">Meta for Developers</a>'
				); ?></li>
				<li><?php esc_html_e( 'In your app, add the "Instagram" product and configure "Instagram API with Instagram Login".', 'daze' ); ?></li>
				<li><?php esc_html_e( 'Generate a User Token with instagram_basic and instagram_content_publish permissions.', 'daze' ); ?></li>
				<li><?php esc_html_e( 'Exchange it for a long-lived token (valid 60 days, auto-refreshed by this theme).', 'daze' ); ?></li>
				<li><?php esc_html_e( 'Paste the long-lived token above and click "Save Token".', 'daze' ); ?></li>
			</ol>
		</div>

		<script>
		jQuery(function($) {
			$('#daze-test-instagram').on('click', function() {
				var $btn = $(this), $result = $('#daze-instagram-result');
				$btn.prop('disabled', true);
				$result.text('Testing...');
				$.post(ajaxurl, {
					action: 'daze_test_instagram',
					nonce: '<?php echo esc_js( $nonce ); ?>'
				}, function(response) {
					$btn.prop('disabled', false);
					if (response.success) {
						$result.css('color', '#00a32a').text(response.data);
					} else {
						$result.css('color', '#d63638').text('Error: ' + response.data);
					}
				}).fail(function() {
					$btn.prop('disabled', false);
					$result.css('color', '#d63638').text('Request failed.');
				});
			});

			$('#daze-clear-instagram-cache').on('click', function() {
				var $btn = $(this), $result = $('#daze-instagram-result');
				$btn.prop('disabled', true);
				$.post(ajaxurl, {
					action: 'daze_clear_instagram_cache',
					nonce: '<?php echo esc_js( $nonce ); ?>'
				}, function(response) {
					$btn.prop('disabled', false);
					$result.css('color', '#00a32a').text(response.data);
				});
			});
		});
		</script>
		<?php
	}
}

Daze_Instagram_Settings::init();
