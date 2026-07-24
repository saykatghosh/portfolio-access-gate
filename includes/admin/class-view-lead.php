<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_View_Lead {

	public function render() {

		$id = isset( $_GET['id'] )
			? absint( $_GET['id'] )
			: 0;

		echo '<div class="wrap">';

		echo '<h1>View Lead</h1>';

		echo '<p>Lead ID: ' . esc_html( $id ) . '</p>';

		echo '</div>';

	}

}