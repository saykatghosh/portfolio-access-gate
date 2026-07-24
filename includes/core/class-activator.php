<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Activator {

	public static function activate() {

		if ( class_exists( 'PAG_Leads_DB' ) ) {

			PAG_Leads_DB::create_table();

		}

	}

}