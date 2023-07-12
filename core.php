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


require VIP_DIR . 'includes/vip.php';
function run_vr() {
	$plugin = new Vip();
	$plugin->run();
}
run_vr();
