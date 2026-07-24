<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Hooks {

	public static function init() {

		add_action(
			'plugins_loaded',
			array(
				__CLASS__,
				'load_textdomain',
			)
		);

	}

	public static function load_textdomain() {

		load_plugin_textdomain(
			'portfolio-access-gate',
			false,
			dirname( PAG_PLUGIN_BASENAME ) . '/languages'
		);

	}

}