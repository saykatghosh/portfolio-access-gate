<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Dashboard_Analytics {

	/**
	 * Dashboard statistics.
	 *
	 * @return array
	 */
	public static function status() {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		$total = (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM {$table}"
		);

		$today = (int) $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(*) FROM {$table} WHERE DATE(created_at) = %s",
				current_time( 'Y-m-d' )
			)
		);

		$week = (int) $wpdb->get_var(
			"SELECT COUNT(*)
			FROM {$table}
			WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)"
		);

		return array(
			'total' => $total,
			'today' => $today,
			'week'  => $week,
		);

	}

	/**
	 * Top protected pages.
	 *
	 * @param int $limit Number of rows.
	 * @return array
	 */
	public static function top_pages( $limit = 5 ) {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT page_title,
						COUNT(*) AS total
				 FROM {$table}
				 GROUP BY page_title
				 ORDER BY total DESC
				 LIMIT %d",
				$limit
			)
		);

	}

	/**
	 * Recent leads.
	 *
	 * @param int $limit Number of rows.
	 * @return array
	 */
	public static function recent( $limit = 5 ) {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT *
				 FROM {$table}
				 ORDER BY id DESC
				 LIMIT %d",
				$limit
			)
		);

	}

}