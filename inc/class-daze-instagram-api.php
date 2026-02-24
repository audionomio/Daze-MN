<?php
/**
 * Daze Instagram API Helper
 *
 * Handles communication with the Instagram Graph API,
 * including media fetching, caching, and token management.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Daze_Instagram_API {

	const TRANSIENT_KEY    = 'daze_instagram_media';
	const USERNAME_KEY     = 'daze_instagram_username';
	const TOKEN_OPTION     = 'daze_instagram_access_token';
	const TOKEN_EXPIRY     = 'daze_instagram_token_expiry';
	const CACHE_TTL        = 2 * HOUR_IN_SECONDS;

	/**
	 * Fetch media from the Instagram Graph API.
	 *
	 * @param int $count Number of items to return.
	 * @return array|WP_Error Array of media items or error.
	 */
	public static function get_media( $count = 12 ) {
		$cached = get_transient( self::TRANSIENT_KEY );
		if ( false !== $cached && is_array( $cached ) ) {
			return array_slice( $cached, 0, $count );
		}

		$token = get_option( self::TOKEN_OPTION, '' );
		if ( empty( $token ) ) {
			return new WP_Error( 'no_token', __( 'Instagram access token not configured.', 'daze' ) );
		}

		$url = add_query_arg(
			array(
				'fields'       => 'id,caption,media_type,media_url,thumbnail_url,permalink,timestamp',
				'access_token' => $token,
				'limit'        => 50,
			),
			'https://graph.instagram.com/me/media'
		);

		$response = wp_remote_get( $url, array( 'timeout' => 15 ) );

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$code = wp_remote_retrieve_response_code( $response );
		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( $code !== 200 || isset( $body['error'] ) ) {
			$message = isset( $body['error']['message'] ) ? $body['error']['message'] : __( 'Unknown API error.', 'daze' );
			return new WP_Error( 'api_error', $message );
		}

		$media = isset( $body['data'] ) ? $body['data'] : array();

		// Filter out Reels / Videos — keep only IMAGE and CAROUSEL_ALBUM
		$media = array_values( array_filter( $media, function( $item ) {
			return isset( $item['media_type'] ) && 'VIDEO' !== $item['media_type'];
		} ) );

		set_transient( self::TRANSIENT_KEY, $media, self::CACHE_TTL );

		return array_slice( $media, 0, $count );
	}

	/**
	 * Get the Instagram username for the connected account.
	 *
	 * @return string|WP_Error Username or error.
	 */
	public static function get_username() {
		$cached = get_transient( self::USERNAME_KEY );
		if ( false !== $cached ) {
			return $cached;
		}

		$token = get_option( self::TOKEN_OPTION, '' );
		if ( empty( $token ) ) {
			return new WP_Error( 'no_token', __( 'Instagram access token not configured.', 'daze' ) );
		}

		$url = add_query_arg(
			array(
				'fields'       => 'username',
				'access_token' => $token,
			),
			'https://graph.instagram.com/me'
		);

		$response = wp_remote_get( $url, array( 'timeout' => 15 ) );

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( isset( $body['error'] ) ) {
			return new WP_Error( 'api_error', $body['error']['message'] );
		}

		$username = isset( $body['username'] ) ? sanitize_text_field( $body['username'] ) : '';

		if ( $username ) {
			set_transient( self::USERNAME_KEY, $username, DAY_IN_SECONDS );
		}

		return $username;
	}

	/**
	 * Refresh the long-lived access token.
	 * Should be called periodically (tokens last 60 days).
	 */
	public static function refresh_token() {
		$token = get_option( self::TOKEN_OPTION, '' );
		if ( empty( $token ) ) {
			return;
		}

		$url = add_query_arg(
			array(
				'grant_type'   => 'ig_refresh_token',
				'access_token' => $token,
			),
			'https://graph.instagram.com/refresh_access_token'
		);

		$response = wp_remote_get( $url, array( 'timeout' => 15 ) );

		if ( is_wp_error( $response ) ) {
			return;
		}

		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( isset( $body['access_token'] ) ) {
			update_option( self::TOKEN_OPTION, sanitize_text_field( $body['access_token'] ) );

			if ( isset( $body['expires_in'] ) ) {
				update_option( self::TOKEN_EXPIRY, time() + intval( $body['expires_in'] ) );
			}
		}
	}

	/**
	 * Test if the current token is valid.
	 *
	 * @return true|WP_Error
	 */
	public static function test_connection() {
		$token = get_option( self::TOKEN_OPTION, '' );
		if ( empty( $token ) ) {
			return new WP_Error( 'no_token', __( 'No access token configured.', 'daze' ) );
		}

		$url = add_query_arg(
			array(
				'fields'       => 'username,account_type',
				'access_token' => $token,
			),
			'https://graph.instagram.com/me'
		);

		$response = wp_remote_get( $url, array( 'timeout' => 15 ) );

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( isset( $body['error'] ) ) {
			return new WP_Error( 'api_error', $body['error']['message'] );
		}

		return true;
	}

	/**
	 * Clear cached media data.
	 */
	public static function clear_cache() {
		delete_transient( self::TRANSIENT_KEY );
		delete_transient( self::USERNAME_KEY );
	}

	/**
	 * Get the image URL for a media item.
	 *
	 * @param array $item Media item from the API.
	 * @return string Image URL.
	 */
	public static function get_image_url( $item ) {
		if ( 'VIDEO' === $item['media_type'] && ! empty( $item['thumbnail_url'] ) ) {
			return $item['thumbnail_url'];
		}
		return isset( $item['media_url'] ) ? $item['media_url'] : '';
	}
}
