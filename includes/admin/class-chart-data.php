<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Chart_Data {

	/**
	 * Last X days lead data.
	 */
	public static function last_days( $days = 7 ) {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		$data = array();

		for ( $i = $days - 1; $i >= 0; $i-- ) {

			$date = gmdate(
				'Y-m-d',
				strtotime( "-{$i} days" )
			);

			$count = (int) $wpdb->get_var(

				$wpdb->prepare(

					"SELECT COUNT(*)
					FROM {$table}
					WHERE DATE(created_at)=%s",

					$date

				)

			);

			$data[] = array(

				'label' => gmdate(
					'M d',
					strtotime( $date )
				),

				'value' => $count,

			);

		}

		return $data;

	}

	/**
	 * JSON for JS.
	 */
	public static function json( $days = 7 ) {

		return wp_json_encode(

			self::last_days( $days )

		);

	}

}