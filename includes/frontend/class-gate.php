<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Gate {

	public function __construct() {

		add_action(
			'template_redirect',
			array( $this, 'init' )
		);

	}

	public function init() {

		if ( is_admin() ) {
			return;
		}

		if ( ! is_page() ) {
			return;
		}

		$page_id = get_queried_object_id();

		// Page already unlocked
		if (
			class_exists( 'PAG_Cookie' ) &&
			PAG_Cookie::has_access( $page_id ) &&
			PAG_Session::valid()
		) {
			return;
		}

		$protected = get_option(
			'pag_protected_pages',
			array()
		);

		if ( ! in_array( $page_id, $protected, true ) ) {
			return;
		}

		add_action(
			'wp_enqueue_scripts',
			array( $this, 'enqueue' )
		);

		add_action(
			'wp_footer',
			array( $this, 'render_popup' )
		);

	}

	public function enqueue() {

		wp_enqueue_style(
			'pag-popup',
			PAG_PLUGIN_URL . 'assets/css/popup.css',
			array(),
			PAG_VERSION
		);

		wp_enqueue_script(
			'pag-popup',
			PAG_PLUGIN_URL . 'assets/js/popup.js',
			array(),
			PAG_VERSION,
			true
		);

		wp_localize_script(
			'pag-popup',
			'pag_ajax',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'pag_nonce' ),
			)
		);

	}

	public function render_popup() {

		include PAG_PLUGIN_PATH . 'resources/views/popup.php';

	}

}