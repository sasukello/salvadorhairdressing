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
define('DB_NAME', 'sopor907_boutique');

/** MySQL database username */
define('DB_USER', 'sopor907');

/** MySQL database password */
define('DB_PASSWORD', 'H@Th9r9R5VH9');

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
define('AUTH_KEY',         '@7#vtR5Z0Cvl@TIB,o7AZM-qUzHM>t9ya!@>Q.$>QiLK|%k;|9gHJIkIfS.|qA.p');
define('SECURE_AUTH_KEY',  '[t2i=1f4sfBFtR;g O BW^iWkl3$?[re!kPY$j#(7DJ$f%2*r?[U:p#^MXV-KdEj');
define('LOGGED_IN_KEY',    '>TTk~G0YFYJ!Ji?[Q~H[m~eAlG*<Dw/Dx9?% VmbbQ}`l[7xT$V>9cOe!<W7|5Y6');
define('NONCE_KEY',        'w4%utCq3vLS;tX2{I%f]7sH;=^7PeDp8iKO)Z@_0NrZkd;:MoM|`Jp]Nq[!R06HD');
define('AUTH_SALT',        '>.Y@lR,!R+Avp4{ca `kK/7#522I9#gsV/:;Ab=*t?Fjw5R;.3^_7N0-.V){@*FL');
define('SECURE_AUTH_SALT', 'C-~h?^oPfU@/WmO#{Fm{NMh~T7Be}t%@%8XvtC^W6uvTAe|4b13x8+:a9=a:XZ^2');
define('LOGGED_IN_SALT',   'Q2D-9tfSpKKUvC%x<CW`-Ns2zpzmk!(gAl2XDZDZc{|Z_7ALx<Wd4:tv>er,SfRt');
define('NONCE_SALT',       '1GN8Gm?V4MNxB/@9Gmiv%lat5gg=0.,^7o%L1-M<h@-X.JkIo*(wbQWa4@&$a->7');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
