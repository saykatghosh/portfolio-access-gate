<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Admin_Assets {

	public function __construct() {

		add_action(
			'admin_enqueue_scripts',
			array(
				$this,
				'enqueue',
			)
		);

	}

	public function enqueue( $hook ) {

		if ( strpos( $hook, 'portfolio-access-gate' ) === false ) {
			return;
		}

		wp_enqueue_style(
			'pag-admin',
			PAG_PLUGIN_URL . 'assets/css/admin.css',
			array(),
			PAG_VERSION
		);

		wp_enqueue_script(
			'pag-admin',
			PAG_PLUGIN_URL . 'assets/js/admin.js',
			array(),
			PAG_VERSION,
			true
		);

	}

}