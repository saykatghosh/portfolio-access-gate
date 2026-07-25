<?php
/**
 * Plugin Name: Portfolio Access Gate
 * Plugin URI: https://github.com/saykatghosh/portfolio-access-gate
 * Description: Protect WordPress pages with business email verification, secure lead capture, and professional access management.
 * Version: 1.0.1
 * Requires at least: 6.5
 * Requires PHP: 8.0
 * Author: Saykat Ghosh
 * Author URI: https://saykatghosh.com/
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
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

define( 'PAG_VERSION', '1.0.1' );
define( 'PAG_PLUGIN_FILE', __FILE__ );
define( 'PAG_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PAG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PAG_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/*
|--------------------------------------------------------------------------
| Core Bootstrap
|--------------------------------------------------------------------------
|
| Only the core bootstrap files are loaded here.
| All other plugin dependencies are loaded by
| includes/core/class-plugin.php
|
*/

require_once PAG_PLUGIN_PATH . 'includes/core/class-activator.php';
require_once PAG_PLUGIN_PATH . 'includes/core/class-deactivator.php';
require_once PAG_PLUGIN_PATH . 'includes/core/class-plugin.php';
require_once PAG_PLUGIN_PATH . 'vendor/plugin-update-checker/plugin-update-checker.php';


/*
|--------------------------------------------------------------------------
| Activation / Deactivation
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