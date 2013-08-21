<?php
// ===================================================
// Load database info and local development parameters
// ===================================================
if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
	define( 'WP_LOCAL_DEV', true );
	include( dirname( __FILE__ ) . '/local-config.php' );
} else {
	define( 'WP_LOCAL_DEV', false );
	define( 'DB_NAME', '%%DB_NAME%%' );
	define( 'DB_USER', '%%DB_USER%%' );
	define( 'DB_PASSWORD', '%%DB_PASSWORD%%' );
	define( 'DB_HOST', '%%DB_HOST%%' ); // Probably 'localhost'
}

// =======================================
// Check that we actually have a DB config
// =======================================
if (strpos(DB_HOST, '%%') !== false) {
	header('X-WP-Error: dbconf', true, 500);
	echo '<h1>Database configuration is incomplete.</h1>';
	echo "<p>If you're developing locally, ensure you have a local-config.php.
	If this is in production, deployment is broken.</p>";
	die();
}

// ========================
// Custom Content Directory
// ========================
defined('WP_CONTENT_DIR') or define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
defined('WP_CONTENT_URL') or define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
define( 'AUTH_KEY',         'put your unique phrase here' );
define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
define( 'NONCE_KEY',        'put your unique phrase here' );
define( 'AUTH_SALT',        'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
define( 'NONCE_SALT',       'put your unique phrase here' );

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
if ( ! empty( $table_prefix ) )
	$table_prefix  = 'sz_';

// =====================================
// Errors
// Show/hide errors for local/production
// =====================================
if ( WP_LOCAL_DEV ) {
	defined( 'WP_DEBUG' ) or define( 'WP_DEBUG', true );
}
// Only override if not already set
elseif ( ! defined( 'WP_DEBUG_DISPLAY' ) ) {
	ini_set( 'display_errors', 0 );
	define( 'WP_DEBUG_DISPLAY', false );
}

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );

require_once( ABSPATH . 'wp-settings.php' );
