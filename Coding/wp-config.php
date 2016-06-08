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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'nhakhuong');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'TS5?6]+HVjja{kg_zL+ My jZC 2vVJIlsl1+4f#18=3^3UZo>i&/}J,=KK5=-i]');
define('SECURE_AUTH_KEY',  '1*x:c4H$ns3FebuU=2@z2U;DtFO((njjTngG`n|`{djvjAXO$6MjxOS-+]O {[m<');
define('LOGGED_IN_KEY',    '6X=J+%tq_>[$k[{Mvh8<fo9~jYa=pT$3Wb3wNPs(?U?0yF*YJ9-aXK(t@/|-BZr0');
define('NONCE_KEY',        'bSsp_vm4>$HB0#=w]Y,9eM1ibzw[$Ku5VX~!6+BfF>a+xS,%w}_FFz(^kK*u,1bY');
define('AUTH_SALT',        '-1M0=lLrZBUI#>n$_bLR?=S!])n@Pf=h;f kfWnt>gLxx?[Vt8okeOh!dNVKzMO[');
define('SECURE_AUTH_SALT', '^?tD/e)4;b*q,[s:s/[9rOpdSNf_8XL9XkXp6guEE~s#P(T%1ELZf?v_-3Y-Undi');
define('LOGGED_IN_SALT',   '+WxyQ&c91xiFYEbET$*T<nG;@,$V1=>p55)1a4m&/7PPzdjc=N.}cHw&-%NkjPRR');
define('NONCE_SALT',       'Md+hv|Q|:E^bY_q{Y[`_7Kw<AB`Nt`I8wewJIU1*t1i|D}/Y*@ac?/f`-nbeH.=Y');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'nkh_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
