<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Cookie {

	const COOKIE_PREFIX = 'pag_access_';

	/**
	 * Get cookie lifetime in seconds.
	 */
	private static function lifetime() {

		$options = PAG_Settings_Manager::get();

		$hours = ! empty( $options['cookie_hours'] )
			? absint( $options['cookie_hours'] )
			: 24;

		return $hours * HOUR_IN_SECONDS;

	}

	/**
	 * Check access.
	 */
	public static function has_access( $page_id ) {

		$name = self::COOKIE_PREFIX . absint( $page_id );

		return isset( $_COOKIE[ $name ] ) &&
			'1' === $_COOKIE[ $name ];

	}

	/**
	 * Grant access.
	 */
	public static function grant( $page_id ) {

		$name = self::COOKIE_PREFIX . absint( $page_id );

		$expire = time() + self::lifetime();

		setcookie(
			$name,
			'1',
			array(
				'expires'  => $expire,
				'path'     => COOKIEPATH,
				'domain'   => COOKIE_DOMAIN,
				'secure'   => is_ssl(),
				'httponly' => true,
				'samesite' => 'Lax',
			)
		);

		$_COOKIE[ $name ] = '1';

	}

	/**
	 * Remove access.
	 */
	public static function revoke( $page_id ) {

		$name = self::COOKIE_PREFIX . absint( $page_id );

		setcookie(
			$name,
			'',
			array(
				'expires'  => time() - HOUR_IN_SECONDS,
				'path'     => COOKIEPATH,
				'domain'   => COOKIE_DOMAIN,
				'secure'   => is_ssl(),
				'httponly' => true,
				'samesite' => 'Lax',
			)
		);

		unset( $_COOKIE[ $name ] );

	}

	/**
	 * Remove all Portfolio Access cookies.
	 */
	public static function revoke_all() {

		foreach ( $_COOKIE as $key => $value ) {

			if ( strpos( $key, self::COOKIE_PREFIX ) !== 0 ) {
				continue;
			}

			setcookie(
				$key,
				'',
				array(
					'expires'  => time() - HOUR_IN_SECONDS,
					'path'     => COOKIEPATH,
					'domain'   => COOKIE_DOMAIN,
					'secure'   => is_ssl(),
					'httponly' => true,
					'samesite' => 'Lax',
				)
			);

			unset( $_COOKIE[ $key ] );

		}

	}

}