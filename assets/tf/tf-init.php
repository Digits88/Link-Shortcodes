<?php
/**
 * TF init
 *
 * ThemeForest init.
 *
 * @since 	1.0.0
 * @package LS
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * TF Shortcodes.
 *
 * @since 1.0.0
 */
if ( file_exists( LS_DIR . '/assets/tf/class-tf-shortcodes.php' ) ) {
    require_once( LS_DIR . '/assets/tf/class-tf-shortcodes.php' );
}
