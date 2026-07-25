<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Settings_Manager {

	const OPTION_NAME = 'pag_options';

	public function __construct() {

		add_action(
			'admin_init',
			array(
				$this,
				'register',
			)
		);

	}

	public function register() {

		register_setting(

			'pag_settings_group',

			self::OPTION_NAME,

			array(
				'type'              => 'array',
				'default'           => $this->defaults(),
				'sanitize_callback' => array(
					$this,
					'sanitize',
				),
			)

		);

	}

	public function defaults() {

		return array(

			/*
			|--------------------------------------------------------------------------
			| Cookie
			|--------------------------------------------------------------------------
			*/

			'cookie_hours'       => 24,
			'cookie_minutes'     => 0,

			/*
			|--------------------------------------------------------------------------
			| Redirect
			|--------------------------------------------------------------------------
			*/

			'redirect_type'      => 'reload',
			'redirect_url'       => '',

			/*
			|--------------------------------------------------------------------------
			| Email Validation
			|--------------------------------------------------------------------------
			*/

			'block_free_email'   => 0,
			'block_temp_email'   => 1,
			'mx_validation'      => 0,

			/*
			|--------------------------------------------------------------------------
			| Access
			|--------------------------------------------------------------------------
			*/

			'remember_access'    => 1,

			/*
			|--------------------------------------------------------------------------
			| Privacy
			|--------------------------------------------------------------------------
			*/

			'collect_ip'         => 1,
			'collect_user_agent' => 1,

		);

	}

	public function sanitize( $input ) {

		$output = $this->defaults();

		/*
		|--------------------------------------------------------------------------
		| Cookie Duration
		|--------------------------------------------------------------------------
		*/

		$output['cookie_hours'] = max(
			0,
			absint( $input['cookie_hours'] ?? 24 )
		);

		$output['cookie_minutes'] = min(
			59,
			max(
				0,
				absint( $input['cookie_minutes'] ?? 0 )
			)
		);

		// At least 1 minute.
		if (
			0 === $output['cookie_hours'] &&
			0 === $output['cookie_minutes']
		) {

			$output['cookie_minutes'] = 1;

		}

		/*
		|--------------------------------------------------------------------------
		| Redirect
		|--------------------------------------------------------------------------
		*/

		$output['redirect_type'] = sanitize_text_field(
			$input['redirect_type'] ?? 'reload'
		);

		$output['redirect_url'] = esc_url_raw(
			$input['redirect_url'] ?? ''
		);

		/*
		|--------------------------------------------------------------------------
		| Email Validation
		|--------------------------------------------------------------------------
		*/

		$output['block_free_email'] = ! empty(
			$input['block_free_email']
		) ? 1 : 0;

		$output['block_temp_email'] = ! empty(
			$input['block_temp_email']
		) ? 1 : 0;

		$output['mx_validation'] = ! empty(
			$input['mx_validation']
		) ? 1 : 0;

		/*
		|--------------------------------------------------------------------------
		| Access
		|--------------------------------------------------------------------------
		*/

		$output['remember_access'] = ! empty(
			$input['remember_access']
		) ? 1 : 0;

		/*
		|--------------------------------------------------------------------------
		| Privacy
		|--------------------------------------------------------------------------
		*/

		$output['collect_ip'] = ! empty(
			$input['collect_ip']
		) ? 1 : 0;

		$output['collect_user_agent'] = ! empty(
			$input['collect_user_agent']
		) ? 1 : 0;

		return $output;

	}

	public static function get() {

		$defaults = ( new self() )->defaults();

		return wp_parse_args(

			get_option(
				self::OPTION_NAME,
				array()
			),

			$defaults

		);

	}

}