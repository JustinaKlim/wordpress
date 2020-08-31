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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'Rw<p&06~rC*B==5CI8]q{f?n&D=<$)M6,Gh5<02lkz8FP#M4WtAxE[n)7IvCsy]F' );
define( 'SECURE_AUTH_KEY',  'k3P#HmK`k2yLGL!CwJ)*a2lVg;4i9j,c7Vua#;z<KrAcG,drY#c-d7!6m_`>TT1V' );
define( 'LOGGED_IN_KEY',    'B&md8UD|`S~f{A(wwNd!r<Knyco >p&^w>go(,LCTWHsu,)a.k]Xg8+!,K/Wj9TE' );
define( 'NONCE_KEY',        '7e86q5tCR_x2i#/5yLHq_AW`N&1Pbe%!9GLfTo!3W|.9u1S`M2g^o;$NLtwK]>?2' );
define( 'AUTH_SALT',        'uV#KoU!nN:qb_.[UWa6q ( -^]g:0EG]?|g2BF]1#Z3H#-D*P,qNg+!@ky]/!Js9' );
define( 'SECURE_AUTH_SALT', 'dzp]>K<d)duS&A{w.rma;}{_pYIYA|aSAwhE,BaU}#iXQf6|B329@w+v]YvReyHe' );
define( 'LOGGED_IN_SALT',   '^_+CrZOaso5suFj#@ >M~$d=Tj:X)e#uSg5}2fpV!$~>zU{vW.4Pht6LUJ5Fcyix' );
define( 'NONCE_SALT',       '0F!.Y%SC>uj>DtYX^Mo?pURnAeacx|s_2tu;:{]n#7PN=PUO+FN7%v1o(Y4/PXuF' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
