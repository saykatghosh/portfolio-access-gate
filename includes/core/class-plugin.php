<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Plugin {

	public function __construct() {

		$this->load_dependencies();

	}

	private function load_dependencies() {

		$files = array(

			/*
			|--------------------------------------------------------------------------
			| Core
			|--------------------------------------------------------------------------
			*/

			'includes/core/class-hooks.php',
			'includes/core/class-settings-manager.php',
			'includes/core/class-loader.php',
			'includes/core/class-update-checker.php',
			'includes/core/class-popup-settings.php',

			/*
			|--------------------------------------------------------------------------
			| Security
			|--------------------------------------------------------------------------
			*/

			'includes/security/class-rate-limiter.php',
			'includes/security/class-honeypot.php',
			'includes/security/class-session.php',

			/*
			|--------------------------------------------------------------------------
			| Helpers
			|--------------------------------------------------------------------------
			*/

			'includes/helpers/class-cookie.php',
			'includes/helpers/class-email-validator.php',
			'includes/helpers/class-domain-analyzer.php',
			'includes/helpers/class-company-intelligence.php',

			/*
			|--------------------------------------------------------------------------
			| Database
			|--------------------------------------------------------------------------
			*/

			'includes/database/class-leads-db.php',

			/*
			|--------------------------------------------------------------------------
			| AJAX
			|--------------------------------------------------------------------------
			*/

			'includes/ajax/class-submit.php',
			'includes/ajax/class-popup-save.php',
			/*
			|--------------------------------------------------------------------------
			| Frontend
			|--------------------------------------------------------------------------
			*/

			'includes/frontend/class-gate.php',

			/*
			|--------------------------------------------------------------------------
			| Admin Assets
			|--------------------------------------------------------------------------
			*/

			'includes/admin/class-admin-assets.php',

			'includes/admin/class-view-lead.php',

			/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

			'includes/admin/dashboard/class-dashboard-components.php',
			'includes/admin/dashboard/class-dashboard-analytics.php',
			'includes/admin/dashboard/class-dashboard-chart.php',
			'includes/admin/dashboard/class-dashboard-status.php',
			'includes/admin/dashboard/class-dashboard.php',

			'includes/admin/class-chart-data.php',

			/*
			|--------------------------------------------------------------------------
			| Leads
			|--------------------------------------------------------------------------
			*/

			'includes/admin/leads/class-leads-components.php',
			'includes/admin/leads/class-leads-toolbar.php',
			'includes/admin/leads/class-leads-table.php',
			'includes/admin/leads/class-leads.php',

			/*
			|--------------------------------------------------------------------------
			| Other Admin
			|--------------------------------------------------------------------------
			*/

			'includes/admin/class-protected-pages.php',
			'includes/admin/class-export.php',
			'includes/admin/class-delete-leads.php',
			'includes/admin/class-bulk-delete.php',
			'includes/admin/class-popup-builder.php',
			'includes/admin/class-settings.php',

		);

		foreach ( $files as $file ) {

			$file = PAG_PLUGIN_PATH . $file;

			if ( file_exists( $file ) ) {

				require_once $file;

			}

		}

	}

	public function run() {

		PAG_Hooks::init();
		
		PAG_Update_Checker::init();

		$loader = new PAG_Loader();

		$loader->run();

	}

}