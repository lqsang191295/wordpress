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
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\xampp\htdocs\surehcs1\wp-content\plugins\wp-super-cache/' );
define('DB_NAME', 'surehcs');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY', 'IeogJ=XJog{Ysu=tuDXIAJ{UhuDV+JwtP<[Gn]Rh|Pwb^CP?%eJC=-TE/@=<mhiI>wY@k-Ji)a;AF&TTp)Nh_W*nNaTgh@Jpaj}$fi>HnGtXIQi%_FZxS)Td)RDyKB)s');
define('SECURE_AUTH_KEY', 'L%MtCBImv&=h$iLMoG}eN?SpFFF)J?ra^y>p@JVEoM}Fw]hy+yf=!;QdmZMn%)yg}>zI]>]agPa+aYM>kBet$/wN<gGVt%]KaUeiimKNNriC[PMii{A&Dh]*P_$mT)F*');
define('LOGGED_IN_KEY', '&j!}WflCN&ZZ<iP{=p-j{INI%}uRvI{-tc$dzskwihVPqJkLr@%)gkE<*zNAIqIOKl^zE(NP%MFgTmYHFO*FAk{n$QrNsuzNJ?]B!Wlmyrg<<QKCZfrqX/}DY^<Ros^M');
define('NONCE_KEY', '-=FC<V?BpgO>VVxqX@{!)^yNAtR}^>Zqb?qVMQBXz>rhX[+hp})gog([XRPeu+Js@g](I&Irow}yO)bbq)_ry<NlZ{d?{(jRp_Gi!kCKRoNFWMn/[S>?kY[]dCfLbLE_');
define('AUTH_SALT', 'NuxdsJ<CotJ]c@OKHJ)KSE>WPn/ITbPUKZR?lf^UwNX;KLl%f?*PNV^mc*T&wGGr=-*&L{fgcT&Lbz@TIF{FOR)%]VWX?*Wa%GtOg;a]JBQxFgs(A(JO[)}%Hh+H&Y*Y');
define('SECURE_AUTH_SALT', 'K&LPw$r{>shiA>Z}uB/YoKhK^p|Ka?[hiCYCQGzKQa*?vln$qWTn=![V=voIsAhFkhBc%BsbXaL$?y=?ax$BV?>hg&nC(uGzcJQ{x@rTdgV@tthkqoQ=UbI)Kh;MI&+A');
define('LOGGED_IN_SALT', 'MPu*%xREd-%{fROhN<?u?U=lWYyTvI^-/i)H(ZcAo|&kXsm_MRe*FaIi}=m}rN-XJ+yIy*tb%Dwfev-_d]}_gmntDY;zrS_YEW*aE!D&oUkO)?[MKA|[Vbj+O+>A_Jrc');
define('NONCE_SALT', '}vAl}a{IQFXp&PhX=oK$qnnIK^LRDHPYoWNNdhjphD=&SFClsBl*]}tch?{eG^V$[wfd_$uz/n%_Y[|JR)(HRpBPOep[MoWao?qedXwWxO|+MRVPGBl-sWkp!zI+l!M+');

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
