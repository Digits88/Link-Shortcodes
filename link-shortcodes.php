<?php
/**
 * Plugin Name: AA Link Shortcodes
 * Plugin URI: https://github.com/ahmadawais/Link-Shortcodes
 * Description: Adds referral links via shortcodes.
 * Author: mrahmadawais, WPTie
 * Author URI: http://AhmadAwais.com/
 * Version: 1.0.2
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * GitHub Plugin URI: https://github.com/ahmadawais/Link-Shortcodes/
 *
 * @package LS
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Define global constants.
 *
 * @since 1.0.0
 */
// Plugin version.
if ( ! defined( 'LS_VERSION' ) ) {
    define( 'LS_VERSION', '1.0.0' );
}

if ( ! defined( 'LS_NAME' ) ) {
    define( 'LS_NAME', trim( dirname( plugin_basename( __FILE__ ) ), '/' ) );
}

if ( ! defined('LS_DIR' ) ) {
    define( 'LS_DIR', WP_PLUGIN_DIR . '/' . LS_NAME );
}

if ( ! defined('LS_URL' ) ) {
    define( 'LS_URL', WP_PLUGIN_URL . '/' . LS_NAME );
}

/**
 * Base file.
 *
 * @since 1.0.0
 */
if ( file_exists( LS_DIR . '/assets/ls-init.php' ) ) {
    require_once( LS_DIR . '/assets/ls-init.php' );
}
