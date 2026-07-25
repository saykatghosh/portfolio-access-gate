<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Activator {

	public static function activate() {

		require_once PAG_PLUGIN_PATH . 'includes/database/class-leads-db.php';

		PAG_Leads_DB::create_table();

	}

}