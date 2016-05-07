<?php
/**
 * LS init
 *
 * Start LS plugin.
 *
 * @since 	1.0.0
 * @package LS
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ThemeForest Init.
 *
 * @since 1.0.0
 */
if ( file_exists( LS_DIR . '/assets/tf/tf-init.php' ) ) {
    require_once( LS_DIR . '/assets/tf/tf-init.php' );
}

/**
 * ThemeForest Init.
 *
 * @since 1.0.0
 */
if ( file_exists( LS_DIR . '/assets/tfnew/class.shortcode.php' ) ) {
    require_once( LS_DIR . '/assets/tfnew/class.shortcode.php' );
}
