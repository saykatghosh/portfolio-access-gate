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

			'cookie_hours'        => 24,

			'redirect_type'       => 'reload',

			'redirect_url'        => '',

			'block_free_email'    => 0,

			'block_temp_email'    => 1,

			'mx_validation'       => 0,

			'remember_access'     => 1,

			'collect_ip'          => 1,

			'collect_user_agent'  => 1,

		);

	}

	public function sanitize( $input ) {

		$output = $this->defaults();

		$output['cookie_hours'] = max(
			1,
			absint( $input['cookie_hours'] ?? 24 )
		);

		$output['redirect_type'] = sanitize_text_field(
			$input['redirect_type'] ?? 'reload'
		);

		$output['redirect_url'] = esc_url_raw(
			$input['redirect_url'] ?? ''
		);

		$output['block_free_email'] = ! empty(
			$input['block_free_email']
		) ? 1 : 0;

		$output['block_temp_email'] = ! empty(
			$input['block_temp_email']
		) ? 1 : 0;

		$output['mx_validation'] = ! empty(
			$input['mx_validation']
		) ? 1 : 0;

		$output['remember_access'] = ! empty(
			$input['remember_access']
		) ? 1 : 0;

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