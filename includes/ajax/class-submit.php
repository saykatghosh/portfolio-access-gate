<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Submit {

	public function __construct() {

		add_action(
			'wp_ajax_pag_submit',
			array( $this, 'submit' )
		);

		add_action(
			'wp_ajax_nopriv_pag_submit',
			array( $this, 'submit' )
		);

	}

	public function submit() {

		check_ajax_referer( 'pag_nonce', 'nonce' );

		/*
		|--------------------------------------------------------------------------
		| Honeypot
		|--------------------------------------------------------------------------
		*/

		if ( ! PAG_Honeypot::passed() ) {

			wp_send_json_error(
				array(
					'message' => 'Request blocked.',
				)
			);

		}

		/*
		|--------------------------------------------------------------------------
		| Rate Limit
		|--------------------------------------------------------------------------
		*/

		if ( ! PAG_Rate_Limiter::allowed() ) {

			wp_send_json_error(
				array(
					'message' => 'Too many attempts. Please try again after 15 minutes.',
				)
			);

		}

		$options = PAG_Settings_Manager::get();

		$name = isset( $_POST['name'] )
			? sanitize_text_field( wp_unslash( $_POST['name'] ) )
			: '';

		$email = isset( $_POST['email'] )
			? sanitize_email( wp_unslash( $_POST['email'] ) )
			: '';

		$page_id = isset( $_POST['page_id'] )
			? absint( $_POST['page_id'] )
			: 0;

		$page_title = isset( $_POST['page_title'] )
			? sanitize_text_field( wp_unslash( $_POST['page_title'] ) )
			: '';

		if ( empty( $name ) ) {

			PAG_Rate_Limiter::hit();

			wp_send_json_error(
				array(
					'message' => 'Please enter your full name.',
				)
			);

		}

		$validator = new PAG_Email_Validator();

		$result = $validator->validate( $email );

		if ( ! $result['status'] ) {

			PAG_Rate_Limiter::hit();

			wp_send_json_error(
				array(
					'message' => $result['message'],
				)
			);

		}

		$ip = '';

		if ( ! empty( $options['collect_ip'] ) ) {

			$ip = isset( $_SERVER['REMOTE_ADDR'] )
				? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) )
				: '';

		}

		$user_agent = '';

		if ( ! empty( $options['collect_user_agent'] ) ) {

			$user_agent = isset( $_SERVER['HTTP_USER_AGENT'] )
				? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) )
				: '';

		}

		PAG_Leads_DB::insert(
			array(
				'full_name'    => $name,
				'email'        => $email,
				'email_domain' => $result['domain'],
				'ip_address'   => $ip,
				'user_agent'   => $user_agent,
				'page_id'      => $page_id,
				'page_title'   => $page_title,
			)
		);

		if ( ! empty( $options['remember_access'] ) ) {

			PAG_Cookie::grant( $page_id );
			PAG_Session::create();

		}

		$redirect = get_permalink( $page_id );

		if (
			'custom' === $options['redirect_type'] &&
			! empty( $options['redirect_url'] )
		) {

			$redirect = esc_url_raw( $options['redirect_url'] );

		}

		wp_send_json_success(
			array(
				'message'  => 'Access Granted',
				'redirect' => $redirect,
			)
		);

	}

}