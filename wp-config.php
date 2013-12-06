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
define('DB_NAME', 'dev.layout.net');

/** MySQL database username */
define('DB_USER', 'monkeyboz');

/** MySQL database password */
define('DB_PASSWORD', 'ntisman1');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'WbEc$6O0hIy+YMU2-D_tLikr?Xbcn<]+$4W1f|M9a@0=h}hYq3*Km3I%C`buZB?%');
define('SECURE_AUTH_KEY',  'FF~we.VK@#Q`+t!$ENcU[k,&K`L?csA5&>U?IfIFf!2=I{QHpoTo(3QAQ7$z8imt');
define('LOGGED_IN_KEY',    '<mF?y!}2MWzhEP_+W|,S6z^gGIw| ?|&c&)L<0Jy@2F&5@}2M%c-7WU +g[U.?hb');
define('NONCE_KEY',        '<(lA BgrtUF}tc8WZBQ5^:Ui:c!)w)ZDyJ-nf{R|UZK3(REK%Q^cWdH1>|>N.ik7');
define('AUTH_SALT',        'ce|Z-_g=j:1!DZ2$<KOD65-|yGoHbG||z)rM9AtwBLh|g|rP`:~~w7J68@}DaT]o');
define('SECURE_AUTH_SALT', 'n_=l5>@0}lT~+yb!;KmI85~]9<+~JrP4/h@<ni7NHjl-MDw3EaHGwAeJ!XFD(SB{');
define('LOGGED_IN_SALT',   'gIe?-7nFRsacLd-BV$$@Rw$!+a 8|f0qO2Go^*6o[R>+nfVK*Z[A%95pbqq{Mv-$');
define('NONCE_SALT',       'xJJ)/wiS&URSt0R!BBP].sw|w}*f+tz}G1nmE>K@g+BLSBe[|?V@B5sr7N#9[VBa');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
