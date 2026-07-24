<?php
/**
 * Plugin Name: Portfolio Access Gate
 * Plugin URI: https://github.com/yourcompany/portfolio-access-gate
 * Description: Protect selected WordPress pages with business email verification.
 * Version: 0.3.0
 * Requires at least: 6.5
 * Requires PHP: 8.0
 * Author: Your Company
 * License: GPL-2.0+
 * Text Domain: portfolio-access-gate
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
|--------------------------------------------------------------------------
| Plugin Constants
|--------------------------------------------------------------------------
*/

define( 'PAG_VERSION', '0.3.0' );
define( 'PAG_PLUGIN_FILE', __FILE__ );
define( 'PAG_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PAG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PAG_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/*
|--------------------------------------------------------------------------
| Core
|--------------------------------------------------------------------------
*/

require_once PAG_PLUGIN_PATH . 'includes/core/class-activator.php';
require_once PAG_PLUGIN_PATH . 'includes/core/class-deactivator.php';
require_once PAG_PLUGIN_PATH . 'includes/core/class-plugin.php';
require_once PAG_PLUGIN_PATH . 'includes/admin/class-dashboard-analytics.php';
require_once PAG_PLUGIN_PATH . 'includes/security/class-rate-limiter.php';
require_once PAG_PLUGIN_PATH . 'includes/security/class-honeypot.php';
require_once PAG_PLUGIN_PATH . 'includes/security/class-session.php';

/*
|--------------------------------------------------------------------------
| Activation
|--------------------------------------------------------------------------
*/

register_activation_hook(
	__FILE__,
	array(
		'PAG_Activator',
		'activate',
	)
);

register_deactivation_hook(
	__FILE__,
	array(
		'PAG_Deactivator',
		'deactivate',
	)
);

/*
|--------------------------------------------------------------------------
| Boot Plugin
|--------------------------------------------------------------------------
*/

function pag_boot() {

	$plugin = new PAG_Plugin();
	$plugin->run();

}

pag_boot();