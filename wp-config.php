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
define('DB_NAME', 'trolycobap');

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
define('AUTH_KEY',         '?ur@@u[C<*QaN.L>:6Ug7oz4eSUu%@Y^#ya7/)4o$Idp%`RB?;P;f`xJ{$|/LHuV');
define('SECURE_AUTH_KEY',  '%^KhsBBd-3&!R6/(.4*|-DR^R%3/QX1ZqesiKQbryK= .Enwcyo65kiyzntg%K`Y');
define('LOGGED_IN_KEY',    'IYLL7Gf;:r4-c6;~e)O#-)PCt+#3Eu4O]$FBSc3]:IUTsM4[AbTJ@j:7:XX5rHKW');
define('NONCE_KEY',        'I-$enxsO:YUKs|iT1rG (;hF%In[NRyYR) zl=X9W=syo/hG<RpDS>9W>*cZVq/C');
define('AUTH_SALT',        ' ;KqE$2Xny,DR/wXY E-iVs=iGNAQ]Q[qgV.xpvs:$uJfY}%-dch&M.YRrs+Ueom');
define('SECURE_AUTH_SALT', '@7-L}wHd5lyotu9%#=c-BF<kdRS|(N#Y~Iu#a:5k1v5w_!+;Lh2$fVsSwL+EBsPa');
define('LOGGED_IN_SALT',   'yx@TRGyAEf>o7@kq|(BY)C$I8waiP~/usID|}0]gRq#2VV<PDvm.hVzXQMa(A<y_');
define('NONCE_SALT',       'nxe0c-KR?)}{a@[a|<W.FsCi) aO0_f^;I]-%,[TLJ>_3X^.zZ:KeOYW1W(ecO39');

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
