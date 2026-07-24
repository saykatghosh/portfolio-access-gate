<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Session {

	const SESSION_KEY = 'pag_session';

	/**
	 * Create fingerprint.
	 */
	public static function create() {

		$fingerprint = md5(

			self::ip() . '|' .
			self::user_agent()

		);

		if ( ! session_id() ) {
			session_start();
		}

		$_SESSION[ self::SESSION_KEY ] = $fingerprint;

	}

	/**
	 * Validate fingerprint.
	 */
	public static function valid() {

		if ( ! session_id() ) {
			session_start();
		}

		if ( empty( $_SESSION[ self::SESSION_KEY ] ) ) {
			return true;
		}

		$current = md5(

			self::ip() . '|' .
			self::user_agent()

		);

		return hash_equals(

			$_SESSION[ self::SESSION_KEY ],

			$current

		);

	}

	private static function ip() {

		return isset( $_SERVER['REMOTE_ADDR'] )
			? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) )
			: '';

	}

	private static function user_agent() {

		return isset( $_SERVER['HTTP_USER_AGENT'] )
			? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) )
			: '';

	}

}