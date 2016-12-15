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
define('DB_NAME', 'jobsmark_multisite');

/** MySQL database username */
define('DB_USER', 'jobsmark_multi');

/** MySQL database password */
define('DB_PASSWORD', '5a682d74b');

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
define('AUTH_KEY',         'pf[mu:Kn_+v1Y(~!XxYt2u(=K:Kw+8`sp#~K4O[ntH27|l&A[PpMEAjv:H1yrb?h');
define('SECURE_AUTH_KEY',  'o&mgH~+MH&^k;3Qn%&!R$M4LS0+#v+l(O_:y&`@r1x2vP74#GKM#EFUc?Rq@d-SR');
define('LOGGED_IN_KEY',    'Tb}I=B:-F;~W$/qUs|VfO6zS%5}W:s<8%|=OUD>xR<4* ?9[pj&PcR8q}2g=yT?%');
define('NONCE_KEY',        'i1qxK-9731T={%O(}Ud)x-iyb6^5/K+;hgPd%Nk UlI^[+?S40k#[|NdeODAd8Cp');
define('AUTH_SALT',        'U|Opw@oy.Vq5Kyi `V#N{;7z9h|^Zg$n;sZf~QrsBT;!bu84*W=juufWU*12k/3p');
define('SECURE_AUTH_SALT', 'rK0AvU>)>/DA/Wd]d/gd[mw:LE]dBP5ObZ;ZLYWa0+W7vywj% dh$8$z~qj:/Hw[');
define('LOGGED_IN_SALT',   'TPy{~M(7G6M98qdmP|.Uy._j>&[?X^,joP|u!Cyo+Q2y*Zed_vsO+|p868[(:1Vc');
define('NONCE_SALT',       'UB8cd@b,+K+]#$97ZO2a8?v=Vz`&36sW>gSX/*F;D>eZy3WF)jUNfJMX.ElZe-pI');

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

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', 'jobsmarket.com');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
