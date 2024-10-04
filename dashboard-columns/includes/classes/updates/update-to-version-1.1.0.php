<?php
/**
 * Update plugin to version 1.1.0
 *
 * @since   1.1.0
 * @package Dashboard_Columns
 */

defined( 'ABSPATH' ) || exit;





// Migrate.
$dashboard_columns = get_option( 'dashboard_columns' );

$dashboard_columns['onboarding-notice'] = false;

update_option( 'dashboard_columns', $dashboard_columns );
