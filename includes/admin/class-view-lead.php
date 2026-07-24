<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_View_Lead {

	public static function get( $id ) {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		return $wpdb->get_row(

			$wpdb->prepare(

				"SELECT * FROM {$table} WHERE id=%d",

				$id

			)

		);

	}

}