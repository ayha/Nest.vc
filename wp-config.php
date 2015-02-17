<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'nestvc_wp' );

/** MySQL database username */
define( 'DB_USER', 'nestvc_wp' );

/** MySQL database password */
define( 'DB_PASSWORD', 'cim.123.' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Y6`pKmQ^9V:c`f8x-4q/7@ cI.{`y~:elW~,bRD13T9!`Mpbuw8-v|mk5I%0kVNM');
define('SECURE_AUTH_KEY',  'dai<sQ`cvT/|g|(-<nNYT[=h`wWx}J{&dMfv+o>|Kt1:4yK5T(&UXxJKY#:yo;)c');
define('LOGGED_IN_KEY',    'zD$||NSp`v-?|IXer]b+b.lB^ %iETS1n<~aaJxRBveHE+?Ql@v)-i)&KYQ(kvr|');
define('NONCE_KEY',        'D<-aiC+xPMWmUUGlSLIK }.yrW.7FnieF]3Z:[)5y-L+Oc;b+|1(8DNo,*k+T|H-');
define('AUTH_SALT',        '$ w#O4!||J;D=Yu.{&_GJs%->UoXDswTy_+-5Z!]f3-j+?y9M%yBpQm5^m|7=u;T');
define('SECURE_AUTH_SALT', 'LaMNXi_Pp5_QRqYaA]=9P@TcN8;Rr$GY(SJNDph3R0++;=IcV&xR9W+,|y9 jX#>');
define('LOGGED_IN_SALT',   'v6T%QY5f]+g(kmKbT@O2:[dw|A3U0+~]tdw`.]V)Rp Q>V ?H-|AH1bOAs`DGIvQ');
define('NONCE_SALT',       'Jr7Ys|n12,9G/F^EZ?4N44T}EV/&?Z&kl,.)~tn(4tT@YiLTx>SI @w&|Cr<L~DY');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
