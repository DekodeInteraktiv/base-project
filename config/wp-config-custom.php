<?php
/**
 * The base configuration for WordPress
 *
 * @package Dekode
 */

declare( strict_types = 1 );

/**
 * Load environment variables
 */
$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load( $root_dir . '/.env' );

/**
 * Get env variable with empty fallback.
 *
 * @param string $key Variable key.
 * @param string $default Default value if key is not set.
 * @return string
 */
function env( string $key, string $default = '' ) : string {
	return $_ENV[ $key ] ?? $default;
}

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', env( 'DB_NAME', 'local' ) );

/** Database username */
define( 'DB_USER', env( 'DB_USER', 'root' ) );

/** Database password */
define( 'DB_PASSWORD', env( 'DB_PASSWORD', 'root' ) );

/** Database hostname */
define( 'DB_HOST', env( 'DB_HOST', 'localhost' ) );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', env( 'DB_CHARSET', 'utf8mb4' ) );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', env( 'DB_COLLATE', '' ) );

/**
 * Check required constants.
 */
$required_constants = [
	'DB_NAME',
	'DB_USER',
	'DB_PASSWORD',
	'DB_HOST',
];

foreach ( $required_constants as $constant ) {
	if ( ! defined( $constant ) ) {
		die( sprintf( 'Please define: %s in your .env file', esc_html( $constant ) ) );
	}
}

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', env( 'AUTH_KEY' ) );
define( 'SECURE_AUTH_KEY', env( 'SECURE_AUTH_KEY' ) );
define( 'LOGGED_IN_KEY', env( 'LOGGED_IN_KEY' ) );
define( 'NONCE_KEY', env( 'NONCE_KEY' ) );
define( 'AUTH_SALT', env( 'AUTH_SALT' ) );
define( 'SECURE_AUTH_SALT', env( 'SECURE_AUTH_SALT' ) );
define( 'LOGGED_IN_SALT', env( 'LOGGED_IN_SALT' ) );
define( 'NONCE_SALT', env( 'NONCE_SALT' ) );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = env( 'DB_PREFIX', 'wp_' ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', env( 'WP_DEBUG', false ) );
define( 'WP_DEBUG_DISPLAY', env( 'WP_DEBUG_DISPLAY', false ) );
define( 'SCRIPT_DEBUG', env( 'SCRIPT_DEBUG', false ) );
define( 'SAVEQUERIES', env( 'SAVEQUERIES', false ) );
define( 'WP_ENVIRONMENT_TYPE', env( 'WP_ENVIRONMENT_TYPE', 'production' ) );

/* Add any custom values between this line and the "stop editing" line. */

// Disable all file modifications including updates and update notifications.
define( 'DISALLOW_FILE_MODS', env( 'DISALLOW_FILE_MODS', true ) );

if ( defined( 'WP_CLI' ) && WP_CLI && env( 'MYSQLI_DEFAULT_SOCKET' ) ) {
	ini_set( 'mysqli.default_socket', env( 'MYSQLI_DEFAULT_SOCKET' ) ); // phpcs:ignore
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/public' );
}

/** Sets up WordPress vars and included files. */
require_once dirname( __DIR__ ) . '/vendor/autoload.php';
require_once ABSPATH . 'wp-settings.php';
