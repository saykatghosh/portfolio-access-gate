<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Export {

	public function __construct() {

		add_action(
			'admin_post_pag_export_csv',
			array( $this, 'export' )
		);

	}

	public function export() {

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Permission denied.' );
		}

		check_admin_referer( 'pag_export_csv' );

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		$rows = $wpdb->get_results(
			"SELECT * FROM {$table} ORDER BY id DESC",
			ARRAY_A
		);

		header( 'Content-Type: text/csv; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=portfolio-leads-' . date( 'Y-m-d' ) . '.csv' );

		$output = fopen( 'php://output', 'w' );

		fputcsv(
			$output,
			array(
				'ID',
				'Name',
				'Email',
				'Domain',
				'Page',
				'IP',
				'User Agent',
				'Date'
			)
		);

		foreach ( $rows as $row ) {

			fputcsv(
				$output,
				array(
					$row['id'],
					$row['full_name'],
					$row['email'],
					$row['email_domain'],
					$row['page_title'],
					$row['ip_address'],
					$row['user_agent'],
					$row['created_at'],
				)
			);

		}

		fclose( $output );

		exit;

	}

}