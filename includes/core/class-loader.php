<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Loader {

	public function run() {

		$this->load_core();

		$this->load_admin();

		$this->load_frontend();

		$this->load_ajax();

	}

	private function load_core() {

		new PAG_Settings_Manager();

	}

	private function load_admin() {

		if ( ! is_admin() ) {
			return;
		}

		new PAG_Admin_Assets();

		new PAG_Export();

		new PAG_Delete_Leads();

		new PAG_Bulk_Delete();

		add_action(
			'admin_menu',
			array(
				$this,
				'register_admin_menu',
			)
		);

	}

	private function load_frontend() {

		if ( is_admin() ) {
			return;
		}

		new PAG_Gate();

	}

	private function load_ajax() {

		new PAG_Submit();
		new PAG_Popup_Save();

	}

	public function register_admin_menu() {

		add_menu_page(
			'Portfolio Access Gate',
			'Portfolio Access Gate',
			'manage_options',
			'portfolio-access-gate',
			array( $this, 'dashboard' ),
			'dashicons-lock',
			58
		);

		add_submenu_page(
			'portfolio-access-gate',
			'Dashboard',
			'Dashboard',
			'manage_options',
			'portfolio-access-gate',
			array( $this, 'dashboard' )
		);

		add_submenu_page(
			'portfolio-access-gate',
			'Protected Pages',
			'Protected Pages',
			'manage_options',
			'pag-protected-pages',
			array( $this, 'protected_pages' )
		);

		add_submenu_page(
			'portfolio-access-gate',
			'Leads',
			'Leads',
			'manage_options',
			'pag-leads',
			array( $this, 'leads' )
		);

		add_submenu_page(
			'portfolio-access-gate',
			'Popup Builder',
			'Popup Builder',
			'manage_options',
			'pag-popup-builder',
			array( $this, 'popup_builder' )
		);

		add_submenu_page(
			'portfolio-access-gate',
			'Settings',
			'Settings',
			'manage_options',
			'pag-settings',
			array( $this, 'settings' )
		);

		add_submenu_page(
			'portfolio-access-gate',
			'Tools',
			'Tools',
			'manage_options',
			'pag-tools',
			array( $this, 'coming_soon' )
		);
		add_submenu_page(

	null,

	'View Lead',

	'View Lead',

	'manage_options',

	'pag-view-lead',

	array(
		$this,
		'view_lead'
	)

);

	}

	public function dashboard() {

		$page = new PAG_Dashboard();
		$page->render();

	}

	public function protected_pages() {

		$page = new PAG_Protected_Pages();
		$page->render();

	}

	public function leads() {

		$page = new PAG_Leads();
		$page->render();

	}

	public function settings() {

		$page = new PAG_Settings();
		$page->render();

	}
	public function popup_builder() {

		$page = new PAG_Popup_Builder();
		$page->render();

	}

	public function coming_soon() {

		echo '<div class="wrap"><h1>Coming Soon</h1><p>Under Development</p></div>';

	}
	public function view_lead() {

	$page = new PAG_View_Lead();

	$page->render();

}

}