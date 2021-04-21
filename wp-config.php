<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'mukpaemy_WPSXU');

/** MySQL database username */
define('DB_USER', 'mukpaemy_WPSXU');

/** MySQL database password */
define('DB_PASSWORD', '?VZ4EbOSWq]7>FF=y');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '88bb73c35824884f80496fbbb2fec3e67dc22e95d5724905f0b0ffcc2a53ec0d');
define('SECURE_AUTH_KEY', '5e1b7006d4ed7a35b35060042b2bc5dc8d6dd899fbc546e75d600d85c88e0bf2');
define('LOGGED_IN_KEY', '3ecf6116adb3dd10b4b924421eebe8981067229a1644804b5fee4bf4f40863a0');
define('NONCE_KEY', 'cf309e839ecbe5af17be62d6898fa47c6de62c94e2f827276aaca4ff5926e919');
define('AUTH_SALT', '79455177721c46781ae5306ea261b537c30f0de3c4df9da6da8c19d0bd7c5e13');
define('SECURE_AUTH_SALT', 'ec4b9b7109705523665e04d798b879dcfb903a32ff8a236cce9f7c85f288b42c');
define('LOGGED_IN_SALT', '7a25e6e26a1043b1f7512566e82385426268e6d3eb063486546e55aad5fb79a6');
define('NONCE_SALT', '6557fdaa7ee67348ba3b1a471d8896aae45dd14012dba7023ef1cee04941ad08');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'eea_';
define('WP_CRON_LOCK_TIMEOUT', 120);
define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', 5);
define('EMPTY_TRASH_DAYS', 7);
define('WP_AUTO_UPDATE_CORE', true);

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
