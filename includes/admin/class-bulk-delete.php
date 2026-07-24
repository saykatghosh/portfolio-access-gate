<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Bulk_Delete {

	public function __construct() {

		add_action(
			'admin_post_pag_bulk_delete',
			array( $this, 'delete' )
		);

	}

	public function delete() {

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Permission denied.' );
		}

		check_admin_referer( 'pag_bulk_delete' );

		if ( empty( $_POST['lead_ids'] ) || ! is_array( $_POST['lead_ids'] ) ) {

			wp_safe_redirect(
				admin_url( 'admin.php?page=pag-leads' )
			);

			exit;

		}

		$ids = array_map(
			'absint',
			wp_unslash( $_POST['lead_ids'] )
		);

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		$placeholders = implode(
			',',
			array_fill( 0, count( $ids ), '%d' )
		);

		$sql = "DELETE FROM {$table} WHERE id IN ($placeholders)";

		$wpdb->query(
			$wpdb->prepare( $sql, $ids )
		);

		wp_safe_redirect(
			admin_url( 'admin.php?page=pag-leads&bulk_deleted=1' )
		);

		exit;

	}

}