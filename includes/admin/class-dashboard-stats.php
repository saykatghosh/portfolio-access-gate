<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Dashboard_Stats {

	public static function get() {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		$total_leads = (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM {$table}"
		);

		$today_leads = (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM {$table}
			WHERE DATE(created_at)=CURDATE()"
		);

		$total_pages = count(
			get_option(
				'pag_protected_pages',
				array()
			)
		);

		return array(

			'total_leads' => $total_leads,

			'today_leads' => $today_leads,

			'protected_pages' => $total_pages,

		);

	}

}