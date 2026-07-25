<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Popup_Save {

	public function __construct() {

		add_action(
			'wp_ajax_pag_save_popup',
			array( $this, 'save' )
		);

	}

	public function save() {

		check_ajax_referer(
			'pag_admin',
			'nonce'
		);

		if ( ! current_user_can( 'manage_options' ) ) {

			wp_send_json_error();

		}

		$options = PAG_Popup_Settings::get();

		$options['title'] = sanitize_text_field(
			wp_unslash( $_POST['title'] ?? '' )
		);

		$options['subtitle'] = sanitize_text_field(
			wp_unslash( $_POST['subtitle'] ?? '' )
		);

		$options['description'] = sanitize_textarea_field(
			wp_unslash( $_POST['description'] ?? '' )
		);

		$options['button_text'] = sanitize_text_field(
			wp_unslash( $_POST['button'] ?? '' )
		);
		$options['logo'] = esc_url_raw(
		wp_unslash( $_POST['logo'] ?? '' )
	);

	$options['background'] = esc_url_raw(
	wp_unslash( $_POST['background'] ?? '' )
);

		PAG_Popup_Settings::save( $options );

		wp_send_json_success(
			array(
				'message' => 'Saved.'
			)
		);

	}

}