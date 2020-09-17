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
define( 'DB_NAME', 'elanshop' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'yu{Lpn]n|;jeX80=}Kg!.-5mBwh*ga7wC`pUuo=wn9R!k}|&3Q<rTeAs6A4Rm[>`' );
define( 'SECURE_AUTH_KEY',  '1f G@R^drb[Wyd@[?DEnR>Ei656jRnTP,?2cJ/HOzb0$g}4aY[2z`PprH$`G@ME|' );
define( 'LOGGED_IN_KEY',    'pw8-F~=o M[C+>#x_vZV;XO84|m;Ca.IUI=)<N!~F/f.EzC/G8uV2ZpFrOJ-.Di}' );
define( 'NONCE_KEY',        '%6!x*R9Z49fjws.kUtc`3=p_NuW~xW!u/Jj+x9jR&E3l/Dja&Tszsm>oQIZ*AfL<' );
define( 'AUTH_SALT',        'H5hcB}C5BUhs&J]d|E:Ny[6rT018hSS3ELmaqS~;dqTMyX|d0 T]hpm~rKD(W|.I' );
define( 'SECURE_AUTH_SALT', '_X:U!,Nw5&G:pxJ~dT|#]Ims3!l!uT7?w~kCC+{2k((Lz0yI{NUpe~+9qu*<xxSu' );
define( 'LOGGED_IN_SALT',   'j=keY<}&C1y00z*7/No2Y)>FZ`8{/0W.uQ#0#Gt16%W!;s.&K-wp5zM@nU6G4!GO' );
define( 'NONCE_SALT',       'Xi|B v9l~a~o4)fslC~qUP}O#}LX(~}F9@^4SWE)2AG1={?=|k!sOxeU?9?ZB$ 2' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'e_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
