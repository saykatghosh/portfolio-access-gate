<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use YahnisElsts\PluginUpdateChecker\v5p7\PucFactory;

class PAG_Update_Checker {

	public static function init() {

		require_once PAG_PLUGIN_PATH . 'vendor/plugin-update-checker/load-v5p7.php';

		$update_checker = PucFactory::buildUpdateChecker(
			'https://github.com/saykatghosh/portfolio-access-gate',
			PAG_PLUGIN_FILE,
			'portfolio-access-gate'
		);

		$update_checker->setBranch( 'main' );

	}

}