<?php
/**
 * Plugin Name: Timeline and History slider
 * Plugin URI: http://www.wponlinesupport.com/
 * Text Domain: timeline-and-history-slider
 * Domain Path: /languages/
 * Description: Easy to add and display history OR timeline for your WordPress website. Also support WordPress POST post type.  
 * Author: WP Online Support
 * Version: 1.2.4
 * Author URI: http://www.wponlinesupport.com/
 *
 * @package WordPress
 * @author WP Online Support
 */

if( !defined('WPOSTAHS_VERSION') ){
	define( 'WPOSTAHS_VERSION', '1.2.4' ); // Plugin version
}
if( !defined( 'WPOSTAHS_DIR' ) ) {
	define( 'WPOSTAHS_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPOSTAHS_URL' ) ) {
    define( 'WPOSTAHS_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPOSTAHS_POST_TYPE' ) ) {
    define( 'WPOSTAHS_POST_TYPE', 'timeline_slider_post' ); // Plugin post type
}

add_action('plugins_loaded', 'wpostahs_load_textdomain');
function wpostahs_load_textdomain() {
	load_plugin_textdomain( 'timeline-and-history-slider', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
} 

/**
 * Function to get plugin image sizes array
 * 
 * @package Timeline and History slider
 * @since 1.0.0
 */
function wpostahs_get_unique() {
  static $unique = 0;
  $unique++;

  return $unique;
}
 
require_once( 'includes/class-tahs-script.php' );
require_once( 'includes/wpostahs-slider-custom-post.php' );
require_once( 'shortcode/wpsisac-template.php' );

// How it work file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( WPOSTAHS_DIR . '/includes/admin/wpostahs-how-it-work.php' );
}