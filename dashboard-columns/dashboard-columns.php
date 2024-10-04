<?php
/**
 * Plugin Name:       Dashboard Columns
 * Plugin URI:        https://wordpress.org/plugins/dashboard-columns
 * Author:            Polygon Themes
 * Author URI:        https://polygonthemes.com
 * Description:       Easily change the number of dashboard columns from Screen Options.
 * Version:           1.3.1
 * Requires PHP:      7.4
 * Requires at least: 5.8
 *
 * Text Domain:       dashboard-columns
 * Domain Path:       /languages/
 *
 * License:           GPLv3 or later
 * License URI:       https://choosealicense.com/licenses/gpl-3.0
 *
 * This program is free software.
 * You can redistribute it and/or modify it under the terms of GNU General Public License,
 * as published by the Free Software Foundation, either version 3 of the License, or any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY.
 * Without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * For more details, see the GNU General Public License.
 *
 * @since   1.0.0
 * @package Dashboard_Columns
 */

defined( 'ABSPATH' ) || exit;





define( 'DASHBOARD_COLUMNS_VERSION', '1.3.1' );
define( 'DASHBOARD_COLUMNS_SLUG', 'dashboard-columns' );

define( 'DASHBOARD_COLUMNS_FILE', __FILE__ );
define( 'DASHBOARD_COLUMNS_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'DASHBOARD_COLUMNS_DIR_PATH', plugin_dir_path( __FILE__ ) );

define( 'DASHBOARD_COLUMNS_MIN_PHP_VERSION', '7.4' );
define( 'DASHBOARD_COLUMNS_REC_PHP_VERSION', '8.0' );





/**
 * Code that runs during the plugin activation.
 *
 * @since 1.0.0
 * @param bool $network_wide Boolean value with the network-wide activation status.
 */
function activate_dashboard_columns( $network_wide ) {
	require_once DASHBOARD_COLUMNS_DIR_PATH . 'includes/class-dashboard-columns-activator.php';
	Dashboard_Columns_Activator::activate( $network_wide );
}
register_activation_hook( DASHBOARD_COLUMNS_FILE, 'activate_dashboard_columns' );





/**
 * Code that runs during the plugin deactivation.
 *
 * @since 1.0.0
 * @param bool $network_wide Boolean value with the network-wide activation status.
 */
function deactivate_dashboard_columns( $network_wide ) {
	require_once DASHBOARD_COLUMNS_DIR_PATH . 'includes/class-dashboard-columns-deactivator.php';
	Dashboard_Columns_Deactivator::deactivate( $network_wide );
}
register_deactivation_hook( DASHBOARD_COLUMNS_FILE, 'deactivate_dashboard_columns' );





/**
 * Load and execute if all requirements are met.
 *
 * @since 1.0.0
 */
function run_dashboard_columns() {
	require_once DASHBOARD_COLUMNS_DIR_PATH . 'includes/class-dashboard-columns.php';
	require_once DASHBOARD_COLUMNS_DIR_PATH . 'includes/class-dashboard-columns-textdomain.php';
	require_once DASHBOARD_COLUMNS_DIR_PATH . 'includes/class-dashboard-columns-requirements.php';

	$textdomain = new Dashboard_Columns_Textdomain();
	$textdomain->init();

	$requirements = new Dashboard_Columns_Requirements();
	$requirements->init();

	if ( $requirements->check() ) {
		$plugin = new Dashboard_Columns();
		$plugin->run();
	}
}
add_action( 'plugins_loaded', 'run_dashboard_columns' );
