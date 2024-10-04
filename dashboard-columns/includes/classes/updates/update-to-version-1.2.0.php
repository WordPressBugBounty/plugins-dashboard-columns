<?php
/**
 * Update plugin to version 1.2.0
 *
 * @since   1.2.0
 * @package Dashboard_Columns
 */

defined( 'ABSPATH' ) || exit;





// Migrate.
$dashboard_columns = get_option( 'dashboard_columns' );

if ( isset( $dashboard_columns['plugin-version'] ) ) {
	unset( $dashboard_columns['plugin-version'] );
}

if ( isset( $dashboard_columns['last-updated-version'] ) ) {
	unset( $dashboard_columns['last-updated-version'] );
}

update_option( 'dashboard_columns', $dashboard_columns );
