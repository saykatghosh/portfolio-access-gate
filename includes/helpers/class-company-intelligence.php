<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Company_Intelligence {

	/**
	 * Get company info from email.
	 */
	public static function analyze( $email ) {

		$email = sanitize_email( $email );

		if ( ! is_email( $email ) ) {

			return false;

		}

		$domain = strtolower(
			substr(
				strrchr( $email, '@' ),
				1
			)
		);

		return array(

			'domain'        => $domain,
			'website'       => 'https://' . $domain,
			'company_name'  => self::company_name( $domain ),
			'is_free_email' => self::is_free( $domain ),

		);

	}

	/**
	 * Guess company name.
	 */
	private static function company_name( $domain ) {

		$name = explode( '.', $domain );

		$name = reset( $name );

		return ucwords(
			str_replace(
				array(
					'-',
					'_',
				),
				' ',
				$name
			)
		);

	}

	/**
	 * Free email provider.
	 */
	private static function is_free( $domain ) {

		$list = array(

			'gmail.com',
			'yahoo.com',
			'hotmail.com',
			'outlook.com',
			'icloud.com',
			'live.com',
			'aol.com',
			'proton.me',
			'protonmail.com',

		);

		return in_array(
			$domain,
			$list,
			true
		);

	}

}