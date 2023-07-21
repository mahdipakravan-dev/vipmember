<?php

/**
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name:       VipMember
 * Plugin URI:        http://mahdipakravan.ir/plugins/vipmember
 * Description:       a vipMember plugin
 * Version:           0.01
 * Author:            Mahdipakravan
 * Author URI:        http://mahdipakravan.ir
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       VipMember
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'VIP_VERSION', '1.0.0' );
define("VIP_DIR" , plugin_dir_path( __FILE__ ));
define("VIP_URL" , plugin_dir_url(__FILE__));


require_once VIP_DIR . "vendor/autoload.php";
require VIP_DIR . 'includes/vip.php';
function activate_vip() {
	require_once  VIP_DIR . 'includes/vip.activator.php';
	VipActivator::activate();
}
function deactivate_vip() {
	require_once VIP_DIR . 'includes/vip.deactivator.php';
	VipDeActivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_vip' );
register_deactivation_hook( __FILE__, 'deactivate_vip' );


function start() {
	$plugin = new Vip();
	$plugin->run();
}
start();
