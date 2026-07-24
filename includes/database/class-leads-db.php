<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Leads_DB {

	const TABLE = 'pag_leads';

	public static function create_table() {

		global $wpdb;

		$table = $wpdb->prefix . self::TABLE;

		$charset = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE {$table} (

			id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

			full_name VARCHAR(255) NOT NULL,

			email VARCHAR(255) NOT NULL,

			email_domain VARCHAR(255) NOT NULL,

			ip_address VARCHAR(100) NOT NULL,

			user_agent TEXT NULL,

			page_id BIGINT UNSIGNED NOT NULL,

			page_title VARCHAR(255) NOT NULL,

			created_at DATETIME NOT NULL,

			PRIMARY KEY (id),

			KEY email (email),

			KEY page_id (page_id)

		) {$charset};";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		dbDelta( $sql );

	}

	public static function insert( $data ) {

		global $wpdb;

		$table = $wpdb->prefix . self::TABLE;

		return $wpdb->insert(

			$table,

			array(

				'full_name'    => $data['full_name'],

				'email'        => $data['email'],

				'email_domain' => $data['email_domain'],

				'ip_address'   => $data['ip_address'],

				'user_agent'   => $data['user_agent'],

				'page_id'      => $data['page_id'],

				'page_title'   => $data['page_title'],

				'created_at'   => current_time( 'mysql' ),

			)

		);

	}

}