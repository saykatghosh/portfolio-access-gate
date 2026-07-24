<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Rate_Limiter {

	const PREFIX = 'pag_rate_';

	/**
	 * Maximum attempts.
	 */
	private static function max_attempts() {

		return 10;

	}

	/**
	 * Lock duration (seconds).
	 */
	private static function lock_time() {

		return 15 * MINUTE_IN_SECONDS;

	}

	/**
	 * Check request.
	 */
	public static function allowed() {

		$key = self::PREFIX . md5( self::ip() );

		$data = get_transient( $key );

		if ( ! is_array( $data ) ) {

			return true;

		}

		if (

			$data['count'] >= self::max_attempts()

			&&

			time() < $data['expires']

		) {

			return false;

		}

		return true;

	}

	/**
	 * Increase attempts.
	 */
	public static function hit() {

		$key = self::PREFIX . md5( self::ip() );

		$data = get_transient( $key );

		if ( ! is_array( $data ) ) {

			$data = array(

				'count' => 0,

				'expires' => time() + self::lock_time(),

			);

		}

		$data['count']++;

		$data['expires'] = time() + self::lock_time();

		set_transient(

			$key,

			$data,

			self::lock_time()

		);

	}

	/**
	 * Client IP.
	 */
	private static function ip() {

		if ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {

			return sanitize_text_field(

				wp_unslash(

					$_SERVER['REMOTE_ADDR']

				)

			);

		}

		return 'unknown';

	}

}