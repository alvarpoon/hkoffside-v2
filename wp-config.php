<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'hkoffside_v2');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define ('WPLANG', 'zh_TW');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         't-Ox.7v#%TukQ^%Jyzb4t/H/3~mHiS<5Tre <E|/d6m[I2<eh>0p@nsH IMq67Jw');
define('SECURE_AUTH_KEY',  ':;WO*l?U(^fO-n_v@c3f)K/I<Jay_?T]iE7fj6$ne6+P&|mZmxRh8r[f)-&QO0ov');
define('LOGGED_IN_KEY',    '6A{BQo-~kJxS-VArY)m>iU9{d37@c;%_wSVr~[7pvBU2d+Lb/u| C:<81IFu}&;>');
define('NONCE_KEY',        'V9pmni&Fy|d3>H!jkw>zf&^n%+7[;3kdRaik[:m]P3x;/x2U_I`eA|`?ktS/H3`K');
define('AUTH_SALT',        ' ,.Myn/:mG.#r?4^r)#0UGi!S]B@#-YRbAx:LDU>6aWJQ2Ms6*?|tK+K,VhK-l{8');
define('SECURE_AUTH_SALT', '_|Cq+W:K1:UJOa.pL%k~kwPHU-_,a Sw[TDQ$Cn8>t(%~OTq0(M]h,7N_Ak+r1-]');
define('LOGGED_IN_SALT',   'r7A?B24,.eD[?sS*}Y;ca.[-3)v(03YXqq-%._Y;UfOo)mclr}V|U|0G)Wh?fWBC');
define('NONCE_SALT',       '#R;SP31-c|TxIMT|AD3LyS>=!Fmgdv-l];^6ba[!T[2|pt?+r>30h-49,fU*e$!%');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
