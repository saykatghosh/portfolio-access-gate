<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Leads_Table {

	/**
	 * Get paginated leads.
	 */
	public static function get_data(
		$search = '',
		$page = 1,
		$per_page = 20
	) {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		$search = sanitize_text_field( $search );

		$page = max( 1, absint( $page ) );

		$per_page = max( 1, absint( $per_page ) );

		$where = '';

		$args = array();

		if ( '' !== $search ) {

			$where = "
				WHERE
					full_name LIKE %s
					OR email LIKE %s
					OR page_title LIKE %s
			";

			$like = '%' . $wpdb->esc_like( $search ) . '%';

			$args[] = $like;
			$args[] = $like;
			$args[] = $like;

		}

		$offset = ( $page - 1 ) * $per_page;

		$sql = "
			SELECT *
			FROM {$table}
			{$where}
			ORDER BY id DESC
			LIMIT %d OFFSET %d
		";

		$args[] = $per_page;
		$args[] = $offset;

		return $wpdb->get_results(
			$wpdb->prepare(
				$sql,
				$args
			)
		);

	}

	/**
	 * Get total leads.
	 */
	public static function total(
		$search = ''
	) {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		$search = sanitize_text_field( $search );

		if ( '' === $search ) {

			return (int) $wpdb->get_var(
				"SELECT COUNT(*) FROM {$table}"
			);

		}

		$like = '%' . $wpdb->esc_like( $search ) . '%';

		return (int) $wpdb->get_var(

			$wpdb->prepare(

				"
				SELECT COUNT(*)
				FROM {$table}
				WHERE
					full_name LIKE %s
					OR email LIKE %s
					OR page_title LIKE %s
				",

				$like,
				$like,
				$like

			)

		);

	}

	/**
	 * Get single lead by ID.
	 */
	public static function get(
		$id
	) {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		return $wpdb->get_row(

			$wpdb->prepare(

				"
				SELECT *
				FROM {$table}
				WHERE id = %d
				LIMIT 1
				",

				absint( $id )

			)

		);

	}

}