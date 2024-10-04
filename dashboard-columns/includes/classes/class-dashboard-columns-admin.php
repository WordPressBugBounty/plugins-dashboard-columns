<?php
/**
 * Do things in the admin area
 *
 * @since   1.0.0
 * @package Dashboard_Columns
 */

defined( 'ABSPATH' ) || exit;





/**
 * Do things in the admin area.
 *
 * This class is used to maintain the functionality for the admin-facing side
 * of our website.
 *
 * @since 1.0.0
 */
class Dashboard_Columns_Admin {

	/**
	 * Hook into actions and filters.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'network_admin_notices', array( $this, 'onboarding_notice' ) );
		add_action( 'admin_notices', array( $this, 'onboarding_notice' ) );
		add_action( 'load-index.php', array( $this, 'add_columns' ) );
	}





	/**
	 * Register and enqueue stylesheets for the admin area.
	 *
	 * @since 1.0.0
	 * @param string $hook Hook name for the current admin page.
	 */
	public function enqueue_styles( $hook ) {
		if ( $hook === 'index.php' ) {
			wp_register_style( 'dashboard-columns', plugins_url( 'assets/stylesheets/dashboard-columns-admin.css', DASHBOARD_COLUMNS_FILE ), false, DASHBOARD_COLUMNS_VERSION, 'all' );
			wp_enqueue_style( 'dashboard-columns' );
		}
	}





	/**
	 * Add columns to Screen Options.
	 *
	 * Add the option to change the number of columns from Screen Options.
	 *
	 * @since 1.0.0
	 */
	public function add_columns() {
		$args = array(
			'max'     => 4,
			'default' => 4,
		);

		add_screen_option( 'layout_columns', $args );
	}





	/**
	 * Display a warning about premium assets.
	 *
	 * This plugin uses premium assets purchased from Creative Market and Graphic River.
	 * Display a warning to all admin users notifying them that they must purchase their own
	 * licenses before using this plugin.
	 * Allow people to disable the plugin straight from the notification, without going
	 * to the Plugins page.
	 *
	 * @since 1.0.0
	 */
	public function onboarding_notice() {
		if ( current_user_can( 'manage_options' ) ) {
			$dashboard_columns = get_option( 'dashboard_columns' );
			$onboarding_notice = isset( $dashboard_columns['onboarding-notice'] ) ? $dashboard_columns['onboarding-notice'] : true;



			// Hide notice if the button Ignore Notice is clicked by adding a flag.
			// phpcs:ignore -- no need to use nonces for this
			if ( isset( $_GET['dashboard_columns_hide_notice'] ) && ( $_GET['dashboard_columns_hide_notice'] === 'true' ) ) {
				$dashboard_columns['onboarding-notice'] = false;

				update_option( 'dashboard_columns', $dashboard_columns );

				return; // Do not display the notice on page reload.
			}



			// Display the actual notice if the user didn't click on the Hide Notice button.
			if ( $onboarding_notice ) {
				?>
					<div class="notice notice-info">
						<p></p>
						<p>
							<b><?php echo esc_html__( 'New options available under Screen Options!', 'dashboard-columns' ); ?></b>
						</p>
						<p>
							<?php echo esc_html__( 'Dashboard Columns is now active on your website.', 'dashboard-columns' ); ?><br>
							<?php echo esc_html__( 'To change the number of columns you see on the main WordPress Dashboard, go to Screen Options and select your preferred layout!', 'dashboard-columns' ); ?><br>
							<?php echo esc_html__( 'The plugin has no options page, in case you\'re looking for one.', 'dashboard-columns' ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( add_query_arg( 'dashboard_columns_hide_notice', 'true' ) ); ?>">
								<b><?php echo esc_html__( 'Hide Notice', 'dashboard-columns' ); ?></b>
							</a>
						</p>
						<p></p>
					</div>
				<?php
			}
		}
	}
}
