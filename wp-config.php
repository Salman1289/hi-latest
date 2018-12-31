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
define('DB_NAME', 'elearning_db');

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
define('AUTH_KEY',         'r!+.vHl`_4G2:!JB*Y-Qy4PH|$(U[EE+V81 S,ciX:_OiEy05Od856jOHYeb}]H,');
define('SECURE_AUTH_KEY',  '+@zjF_Y/1>}OP<2@&EZHfP(A]K;`R 0N_M452#DX1=MdQCNL4Q)Hz=f[M8D8JS3-');
define('LOGGED_IN_KEY',    'F&/iy2^HF!m?fV*`~iz( Cnl&Nm-5RQ6uJ9 t?y0=o?JL5w2XZ0PYmYi`Y-(yze6');
define('NONCE_KEY',        'j|SQJ~fchrN?_=0U@pKl24cHThs0}(fJ,|$qZm0w;{sr=X>..s=,s**E^;&@I*v-');
define('AUTH_SALT',        'yUcfPfy%#eJp(2#XAp>s5w3k_I&][TWOK?4/tbcncU%/s>IsGgIw]Dx.+}`dNzj:');
define('SECURE_AUTH_SALT', 'FEH~,eaCTNb{W{lvS^:C8faL#{B`j4$2x Y.jc*8IqBri?&g}G+AKP($[*4!(-Ci');
define('LOGGED_IN_SALT',   '}-7Me6mlB&kIrxl!z:[]w0VC|e|#o3sJu;?n8b@PH*V_[N3QTG @i{AMv_~%*87n');
define('NONCE_SALT',       'rL[2:wQvCE7ZCE-6i.FS3$qqC^%mwm5Moeum II=RiZ&@dTMKi3{81HC5v_tM%nD');

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

ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
