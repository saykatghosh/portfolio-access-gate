<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Dashboard_Analytics {

	public static function stats() {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		return array(

			'total' => (int) $wpdb->get_var(
				"SELECT COUNT(*) FROM {$table}"
			),

			'today' => (int) $wpdb->get_var(
				"SELECT COUNT(*) FROM {$table}
				WHERE DATE(created_at)=CURDATE()"
			),

			'week' => (int) $wpdb->get_var(
				"SELECT COUNT(*) FROM {$table}
				WHERE created_at>=DATE_SUB(NOW(),INTERVAL 7 DAY)"
			),

			'month' => (int) $wpdb->get_var(
				"SELECT COUNT(*) FROM {$table}
				WHERE created_at>=DATE_SUB(NOW(),INTERVAL 30 DAY)"
			),

		);

	}

	public static function top_pages( $limit = 5 ) {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		return $wpdb->get_results(

			$wpdb->prepare(

				"SELECT
					page_title,
					COUNT(*) total
				FROM {$table}
				GROUP BY page_title
				ORDER BY total DESC
				LIMIT %d",

				$limit

			)

		);

	}

	public static function recent( $limit = 8 ) {

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