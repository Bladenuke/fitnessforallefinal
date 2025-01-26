<?php
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
define( 'DB_NAME', 'fitnessforalle_no_wordpress' );

/** Database username */
define( 'DB_USER', 'fitnessforalle_no' );

/** Database password */
define( 'DB_PASSWORD', 'Fhj0dj9EaiMIOOt' );

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
define( 'AUTH_KEY',          '<(lCH[27>*A.]Wjq7umo5Abxut~=1F4s]`x&zn$5Mjn$djK+~<)!Bceu/&]*,rSA' );
define( 'SECURE_AUTH_KEY',   'B(YjG4ZT+Q]Bq9%oo.I{%N9!QBB,6 _1aV-Mwf&x1?c4?tB9`5%.9+H #Mb|(sK=' );
define( 'LOGGED_IN_KEY',     '!6%4LNi44)feNsoNwdV]:*U: `G0$BcRsTPgh4OK-+5]oFmg`fsZHuDG9gkA)|i:' );
define( 'NONCE_KEY',         'ieLiL+%7iaVJ*--5I5C-G@DJ^hy27G=wM$:{!h.fm#@{!UDuZsZ{=]`tLkr8a>YV' );
define( 'AUTH_SALT',         '1txC/dl<y*)rJF?E`I]vDx<|&;1wgW#.VpVPBBV7%8O9};&Nu@96e!+hzQi2U2}Q' );
define( 'SECURE_AUTH_SALT',  'q:NOE[iS6.9+ZbRS,Mcx=$&OTpmxt~ ~mI2<nGo|0[`|gYA6.eNf]8 k9V9*,-OZ' );
define( 'LOGGED_IN_SALT',    '5gAu(J&+g_j-kVu~Z[i)*QBJ?<(_*p}ajWRj*a@!B4nqMyy?^6ca^mujjRjWOVXQ' );
define( 'NONCE_SALT',        'dK6gp}&t9mT|TIH;vE8dl4;]A|G5&MKA$yjTx`6<ar7-gK//(0Yten{M03^YrmMA' );
define( 'WP_CACHE_KEY_SALT', 'O_%Jgt?L#9LIlD90cIic[qq[ZwAZK#n~?0$pK+by|Yh(-y4;&3lXOlz}x7}a7}h1' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */





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
// Aktiver feilsøking
define('WP_DEBUG', true);

// Logg feil til en fil i stedet for å vise dem på siden
define('WP_DEBUG_LOG', true);

// Vis feil i nettleseren (sett til false på produksjonssider)
define('WP_DEBUG_DISPLAY', true);
@ini_set('display_errors', 1);

// Aktiver feilsøking for skript og SQL-spørringer (valgfritt)
define('SAVEQUERIES', true);

}
define('JWT_AUTH_SECRET_KEY', '8b1c75e2db45e03fc7a4d96a96df7bb8c930ff02c2636c4f34c7c4b7ebdb3a15');
define('JWT_AUTH_CORS_ENABLE', true); // Tillat CORS, spesielt viktig hvis du bruker frontend og backend separat
define( 'WP_HOME', 'https://fitnessforalle.no' );
define( 'WP_SITEURL', 'https://fitnessforalle.no' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
