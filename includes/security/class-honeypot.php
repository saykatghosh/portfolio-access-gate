<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Honeypot {

	/**
	 * Render hidden honeypot field.
	 */
	public static function field() {

		?>

		<div
			style="position:absolute;left:-9999px;opacity:0;pointer-events:none;">

			<label for="pag_company">

				Company

			</label>

			<input
				type="text"
				id="pag_company"
				name="company"
				value=""
				autocomplete="off">

		</div>

		<?php

	}

	/**
	 * Validate honeypot.
	 */
	public static function passed() {

		if ( empty( $_POST['company'] ) ) {
			return true;
		}

		return false;

	}

}