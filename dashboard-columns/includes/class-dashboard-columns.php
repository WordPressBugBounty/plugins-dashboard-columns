<?php
/**
 * The core plugin class
 *
 * @since   1.0.0
 * @package Dashboard_Columns
 */

defined( 'ABSPATH' ) || exit;





/**
 * The core plugin class.
 *
 * This class is used to load all dependencies, prepare the plugin for translation
 * and register all actions and filters with WordPress.
 *
 * @since 1.0.0
 */
class Dashboard_Columns {

	/**
	 * Get things started.
	 *
	 * @since 1.0.0
	 */
	public function run() {
		$this->includes();
		$this->init();
	}





	/**
	 * Load required dependencies.
	 *
	 * Load the files required to create our plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function includes() {
		require_once DASHBOARD_COLUMNS_DIR_PATH . 'includes/classes/class-dashboard-columns-admin.php';
		require_once DASHBOARD_COLUMNS_DIR_PATH . 'includes/classes/class-dashboard-columns-updates.php';
	}





	/**
	 * Register hooks with WordPress.
	 *
	 * Create objects from classes and hook into actions and filters.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function init() {
		$admin = new Dashboard_Columns_Admin();
		$admin->init();

		$updates = new Dashboard_columns_Updates();
		$updates->init();
	}
}
