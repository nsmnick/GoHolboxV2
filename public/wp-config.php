<?php

define('VITE_DEV_SERVER_URL', 'http://localhost:5275');

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '_AY7RPfWx0EP2baQ]k:Y~!S`vxYM)en]|g@aznz%0W] (0[!_nDOTk6%V/|c%W}4' );
define( 'SECURE_AUTH_KEY',   ' [h7atoCw3bkl+</wr5B]7?FU${r?9m:k;#Us]f02}|f[GK0CwV5_&MvP~(t%0-N' );
define( 'LOGGED_IN_KEY',     'gQiAzUazNn9b69)*gVJ~-Nv`,(+_C:sZ=Q9mu-[b|O(RYjGm-yyT{X*X7.`ieEmK' );
define( 'NONCE_KEY',         'Gcj7Jd`~*SWH&^ >#H-L&UK;a}l.y!Y~d_X4MkHGOB;vP_B(uk3l@Cz](/tI^9<K' );
define( 'AUTH_SALT',         ']NzY$3?)C0h)a,6-O0};SZ3Z^wjdfB+B$0Acif];YX@y*fH1yKV[ywn~K2WaSTUZ' );
define( 'SECURE_AUTH_SALT',  'VdF,?o)n1`6iVZH,:0h{;e?KV$ydH5(yZw2D(BTrsXs^8G4TNNJBZ;}?rA^_1Y,+' );
define( 'LOGGED_IN_SALT',    ')3kXkYah^JfjeW/l&pCoo075qK&yaY_6NXpIU`qVulY:u90iUO!5~nBPmxSK8W$r' );
define( 'NONCE_SALT',        '{0tU7!TN6n%/NA,-!?jTA(p.w:.!M+})Av`X >C,5$oof$=EcN*Lg>eBD7K4oQ(V' );
define( 'WP_CACHE_KEY_SALT', 'q1LgN1o!Epj_8FMAL+E@q| Nr3ELC~#_Cr+P](%VEx0$h)a$E} /av1vodqowcDe' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */

// Server-side only — never expose this key to the browser. Restrict it in
// Google Cloud Console to this server's IP and to the Places API only.
define( 'GOOGLE_PLACES_API_KEY', '' );



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG_LOG', true );

define( 'WP_ENVIRONMENT_TYPE', 'local' );

define( 'WP_POST_REVISIONS', 3 );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
