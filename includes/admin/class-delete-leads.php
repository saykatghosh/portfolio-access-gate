<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Delete_Leads {

	public function __construct() {

		add_action(
			'admin_post_pag_delete_lead',
			array( $this, 'delete' )
		);

	}

	public function delete() {

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Permission denied.' );
		}

		check_admin_referer( 'pag_delete_lead' );

		$id = isset( $_GET['lead_id'] ) ? absint( $_GET['lead_id'] ) : 0;

		if ( ! $id ) {
			wp_safe_redirect( admin_url( 'admin.php?page=pag-leads' ) );
			exit;
		}

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		$wpdb->delete(
			$table,
			array(
				'id' => $id,
			),
			array(
				'%d',
			)
		);

		wp_safe_redirect( admin_url( 'admin.php?page=pag-leads&deleted=1' ) );

		exit;

	}

}