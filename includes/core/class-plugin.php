<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Plugin {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->load_dependencies();

	}

	/**
	 * Load all plugin dependencies.
	 */
	private function load_dependencies() {

		$files = array(

			// Core
			'includes/core/class-hooks.php',
			'includes/core/class-settings-manager.php',
			'includes/core/class-loader.php',

			// Security
			'includes/security/class-rate-limiter.php',

			// Helpers
			'includes/helpers/class-cookie.php',
			'includes/helpers/class-email-validator.php',

			// Database
			'includes/database/class-leads-db.php',

			// AJAX
			'includes/ajax/class-submit.php',

			// Frontend
			'includes/frontend/class-gate.php',

			// Admin
			'includes/admin/class-dashboard.php',
			'includes/admin/class-dashboard-analytics.php',
			'includes/admin/class-protected-pages.php',
			'includes/admin/class-leads.php',
			'includes/admin/class-export.php',
			'includes/admin/class-delete-leads.php',
			'includes/admin/class-bulk-delete.php',
			'includes/admin/class-view-lead.php',
			'includes/admin/class-settings.php',

		);

		foreach ( $files as $file ) {

			$file = PAG_PLUGIN_PATH . $file;

			if ( file_exists( $file ) ) {
				require_once $file;
			}

		}

	}

	/**
	 * Start plugin.
	 */
	public function run() {

		PAG_Hooks::init();

		$loader = new PAG_Loader();

		$loader->run();

	}

}