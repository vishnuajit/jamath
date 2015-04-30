<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

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
define('AUTH_KEY',         '<y!;U9ihBKr5~l:Wfb~Gz3*vFYH9=IhI&([7wDn:[XVf|{%V(m?|X-:wqpEkZ(PO');
define('SECURE_AUTH_KEY',  '1)C(Y&RK-^)MON@AE|HV?!*^Lw%@k}&lz%WanT6o$G4_D,A<4T,>tBUU9X8PF11,');
define('LOGGED_IN_KEY',    'J;)!6-,/1>0lchTR8~`U$7%4T_W2fcc%1-ZbwbpC3C{ErAX~9u5(>n38x#,vbk/A');
define('NONCE_KEY',        'w_BZ`g0-Ipe;O:!x<SQ;$IiHSxp,zzVoA~pwbQCe,,(<6rL%o(E{i%*Wl-%]:PY?');
define('AUTH_SALT',        'zp!0|xHH=`}6Bp}m|M@XE].6iUh2gF{%NV3SJldW8nJYdk0w3W[b{IDN@`f!d].o');
define('SECURE_AUTH_SALT', '@D_UB+h*1p^QEW9/Jf9[&p[~h;pr1fTdny`_ZEk3V{uO,9W&0PnQ)RI8e&A<V2])');
define('LOGGED_IN_SALT',   'Om?Jc>I9n>r3`>!)f>w(}K02-hCmu]/>RR-7Ns(a+3* !i5b&g2uCPsEc_|gO0(&');
define('NONCE_SALT',       '>S6n9^T^sAqiq.?sf^=*9SQsQ0ucJK54<H*+|e4sRQ V;A-VurQ13(EFdix_E)We');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
