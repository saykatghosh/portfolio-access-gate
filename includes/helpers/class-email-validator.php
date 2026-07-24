<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Email_Validator {

	/**
	 * Common free email providers.
	 */
	private $free_domains = array(

		'gmail.com',
		'yahoo.com',
		'outlook.com',
		'hotmail.com',
		'live.com',
		'icloud.com',
		'aol.com',
		'proton.me',
		'protonmail.com',
		'zoho.com',

	);

	/**
	 * Disposable email domains.
	 */
	private $temp_domains = array(

		'mailinator.com',
		'10minutemail.com',
		'guerrillamail.com',
		'tempmail.com',
		'yopmail.com',
		'trashmail.com',
		'maildrop.cc',
		'dispostable.com',
		'temp-mail.org',
		'fakeinbox.com',

	);

	/**
	 * Validate email.
	 */
	public function validate( $email ) {

		$options = PAG_Settings_Manager::get();

		if ( ! is_email( $email ) ) {

			return array(
				'status'  => false,
				'message' => 'Please enter a valid business email.',
			);

		}

		$domain = strtolower(
			substr(
				strrchr( $email, '@' ),
				1
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Temporary Email
		|--------------------------------------------------------------------------
		*/

		if (
			! empty( $options['block_temp_email'] ) &&
			in_array( $domain, $this->temp_domains, true )
		) {

			return array(
				'status'  => false,
				'message' => 'Temporary email addresses are not allowed.',
			);

		}

		/*
		|--------------------------------------------------------------------------
		| Free Email
		|--------------------------------------------------------------------------
		*/

		if (
			! empty( $options['block_free_email'] ) &&
			in_array( $domain, $this->free_domains, true )
		) {

			return array(
				'status'  => false,
				'message' => 'Please use your business email address.',
			);

		}

		/*
		|--------------------------------------------------------------------------
		| MX Record
		|--------------------------------------------------------------------------
		*/

		if ( ! empty( $options['mx_validation'] ) ) {

			if ( function_exists( 'checkdnsrr' ) ) {

				if ( ! checkdnsrr( $domain, 'MX' ) ) {

					return array(
						'status'  => false,
						'message' => 'Business email domain could not be verified.',
					);

				}

			}

		}

		return array(
			'status'  => true,
			'message' => 'Business email verified.',
			'domain'  => $domain,
		);

	}

}