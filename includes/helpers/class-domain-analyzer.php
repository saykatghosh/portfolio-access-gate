<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Domain_Analyzer {

	/**
	 * Top company domains.
	 */
	public static function top_domains( $limit = 10 ) {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		return $wpdb->get_results(

			$wpdb->prepare(

				"SELECT
					email_domain,
					COUNT(*) AS total
				FROM {$table}
				WHERE email_domain <> ''
				GROUP BY email_domain
				ORDER BY total DESC
				LIMIT %d",

				$limit

			)

		);

	}

	/**
	 * Total unique company domains.
	 */
	public static function unique_domains() {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		return (int) $wpdb->get_var(

			"SELECT COUNT(DISTINCT email_domain)
			FROM {$table}
			WHERE email_domain <> ''"

		);

	}

	/**
	 * Total companies.
	 */
	public static function total_companies() {

		return self::unique_domains();

	}

	/**
	 * Top domain.
	 */
	public static function top_domain() {

		$domains = self::top_domains( 1 );

		if ( empty( $domains ) ) {
			return null;
		}

		return $domains[0];

	}

}