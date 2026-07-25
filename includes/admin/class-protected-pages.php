<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Protected_Pages {

	public function render() {

		if ( isset( $_POST['pag_save_pages'] ) ) {

			if (
				! isset( $_POST['pag_nonce'] ) ||
				! wp_verify_nonce(
					$_POST['pag_nonce'],
					'pag_save_protected_pages'
				)
			) {
				wp_die( 'Security check failed.' );
			}

			$selected = array();

			if ( isset( $_POST['protected_pages'] ) ) {

				$selected = array_map(
					'absint',
					wp_unslash( $_POST['protected_pages'] )
				);

			}

			update_option(
				'pag_protected_pages',
				$selected
			);

			echo '<div class="notice notice-success is-dismissible"><p>Protected Pages updated successfully.</p></div>';

		}

		$pages = get_pages();

		$saved = get_option(
			'pag_protected_pages',
			array()
		);

		?>

		<div class="wrap pag-dashboard">

			<form method="post">

				<?php
				wp_nonce_field(
					'pag_save_protected_pages',
					'pag_nonce'
				);

				include PAG_PLUGIN_PATH . 'resources/views/protected-pages/header.php';

				include PAG_PLUGIN_PATH . 'resources/views/protected-pages/toolbar.php';

				include PAG_PLUGIN_PATH . 'resources/views/protected-pages/table.php';

				include PAG_PLUGIN_PATH . 'resources/views/protected-pages/footer.php';
				?>

			</form>

		</div>

		<?php

	}

}