<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Admin_Assets {

	public function __construct() {

		add_action(
			'admin_enqueue_scripts',
			array(
				$this,
				'enqueue',
			)
		);

	}

	public function enqueue( $hook ) {

		/*
		|--------------------------------------------------------------------------
		| Load Only Portfolio Access Gate Pages
		|--------------------------------------------------------------------------
		*/

		if ( strpos( $hook, 'portfolio-access-gate' ) === false ) {
			return;
		}

		/*
		|--------------------------------------------------------------------------
		| Google Font
		|--------------------------------------------------------------------------
		*/

		wp_enqueue_style(
			'pag-font-inter',
			'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
			array(),
			null
		);

// 		if ( file_exists( PAG_PLUGIN_PATH . 'assets/css/popup-builder.css' ) ) {

// 			wp_enqueue_style(

// 				'pag-popup-builder',

// 				PAG_PLUGIN_URL . 'assets/css/popup-builder.css',

// 				array(),

// 				PAG_VERSION

// 			);

// }

// if ( file_exists( PAG_PLUGIN_PATH . 'assets/js/popup-builder.js' ) ) {

// 	wp_enqueue_media();

// 	wp_enqueue_script(

// 		'pag-popup-builder',

// 		PAG_PLUGIN_URL . 'assets/js/popup-builder.js',

// 		array( 'jquery' ),

// 		PAG_VERSION,

// 		true

// 	);

// }

		/*
		|--------------------------------------------------------------------------
		| Design System
		|--------------------------------------------------------------------------
		*/

		$styles = array(

			'01-variables',
			'02-reset',
			'03-layout',
			'04-components',
			'05-dashboard',
			'06-leads',
			'07-settings',
			'08-dark',
			'09-responsive',

		);

		foreach ( $styles as $style ) {

			wp_enqueue_style(

				'pag-' . $style,

				PAG_PLUGIN_URL . 'assets/css/admin/' . $style . '.css',

				array(),

				PAG_VERSION

			);

		}



		/*
		|--------------------------------------------------------------------------
		| Legacy CSS
		|--------------------------------------------------------------------------
		|
		| Keep this temporarily.
		| We will remove it after migrating all pages.
		|
		*/

		if ( file_exists( PAG_PLUGIN_PATH . 'assets/css/admin.css' ) ) {

			wp_enqueue_style(

				'pag-admin-legacy',

				PAG_PLUGIN_URL . 'assets/css/admin.css',

				array(

					'pag-09-responsive',

				),

				PAG_VERSION

			);

		}

		/*
|--------------------------------------------------------------------------
| Scripts
|--------------------------------------------------------------------------
*/

if (
	'portfolio-access-gate_page_pag-protected-pages' === $hook &&
	file_exists( PAG_PLUGIN_PATH . 'assets/js/protected-pages.js' )
) {

	wp_enqueue_script(

		'pag-protected-pages',

		PAG_PLUGIN_URL . 'assets/js/protected-pages.js',

		array(),

		PAG_VERSION,

		true

	);

}

if ( file_exists( PAG_PLUGIN_PATH . 'assets/js/theme.js' ) ) {

	wp_enqueue_script(

		'pag-theme',

		PAG_PLUGIN_URL . 'assets/js/theme.js',

		array(),

		PAG_VERSION,

		true

	);

}

wp_enqueue_script(

	'pag-admin',

	PAG_PLUGIN_URL . 'assets/js/admin.js',

	array(),

	PAG_VERSION,

	true

);

wp_localize_script(

	'pag-admin',

	'pagAdmin',

	array(

		'ajax_url' => admin_url( 'admin-ajax.php' ),

		'nonce' => wp_create_nonce( 'pag_admin' ),

	)

);

	}

}