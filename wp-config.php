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
define( 'DB_NAME', 'db2ebwbgpdoad8' );

/** MySQL database username */
define( 'DB_USER', 'uz23qb0nfckwc' );

/** MySQL database password */
define( 'DB_PASSWORD', 'svswfhz8ougu' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'wPYxH(S](^D(G#p8%`mHnas}XE?XKYu[z~2^E%)HlqSX~/ey]55zAA2=+*6p{M|r' );
define( 'SECURE_AUTH_KEY',   ']w?)#F 8l_K59rJGU=M*}epYTQ1f_S0V/b43MHNZTv=fqZJ(UcPWHaV6da~2XSdq' );
define( 'LOGGED_IN_KEY',     'j8ed>pFEvA>(>cz)vtk42=ao,>zr:lkMVhZT;8guSBh{^uiAiy1AX:T1nYf;[(H^' );
define( 'NONCE_KEY',         'hTx=^ZO}A*?)pc_ 7=ui9IcE,J/BwmxTNuA+kCBT65(J:SGM-VTQnqQj2#K;W#v<' );
define( 'AUTH_SALT',         '?yD/`.`ij7uzzD=voQm j,;N>Mbsa7L{B]Xh{ACb,T|[.S3UlLai`%o?Zx5^Rwy9' );
define( 'SECURE_AUTH_SALT',  'v4e1^j /{gPyzSI#20@hS#]e[Ar~kiJI~Vfi2s+Q3@X?{NK|CWS~GDn|]VyT!p^N' );
define( 'LOGGED_IN_SALT',    '5ReY{afrbBmV,8vu,j}YgNE3Eosm#&/7.WLT-,$ Oq#~[m-!?u+:bPGwJvBZ?^lG' );
define( 'NONCE_SALT',        'kQ0zHO}e}&o>Np|]cg!XRB)V>Nkvt7` kP,fD}V^*:|do?Vj@4nWuJZW8A@S~FEm' );
define( 'WP_CACHE_KEY_SALT', 'OE.U;JQJDy9=$Fa#v|BkMcK+FIt?w;T869a_>6%3m=jEKY)pKzt8nlRTQN3/*6)S' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'dag_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
