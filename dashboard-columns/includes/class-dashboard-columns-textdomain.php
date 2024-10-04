<?php
/**
 * Prepare the plugin for translation
 *
 * @since   1.0.0
 * @package Dashboard_Columns
 */

defined( 'ABSPATH' ) || exit;





/**
 * Prepare the plugin for translation.
 *
 * Load and define the internationalization files making the plugin ready for
 * translation.
 *
 * @since 1.0.0
 */
class Dashboard_Columns_Textdomain {

	/**
	 * Hook into actions and filters.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}





	/**
	 * Load the plugin textdomain.
	 *
	 * The plugin tries to load the files from the global /languages/ folder first.
	 * If it can't find any, it will load the files from the local /languages/ folder.
	 *
	 * @since 1.0.0
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'dashboard-columns', false, plugin_basename( DASHBOARD_COLUMNS_DIR_PATH ) . '/languages/' );
	}
}
