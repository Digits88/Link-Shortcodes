<?php
/**
 * WP_TF_Shortcodes
 *
 * Class for TF shortcodes.
 *
 * @since 	1.0.0
 * @package LS
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * WP_TF_Shortcodes.
 *
 * TF Shortcodes.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'WP_TF_Shortcodes' ) ) :

class WP_TF_Shortcodes {

	/**
	 * Instance
	 *
	 */

	/**
	 * Instance.
	 *
	 * @var 	instance
	 * @since 	1.0.0
	 */
	private static $instance = null;

	/**
	 * Single instance.
	 *
	 * @since 1.0.0
	 */
	public static function get_instance() {
	    if ( ! self::$instance )
	        self::$instance = new self;
	    return self::$instance;
	}

	/**
	 * Init.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		// Backend related stuff
		// add_action( 'admin_init', array( $this, 'init_plugin' ), 20 );

		// The shortcode.
        add_shortcode( 'tf', array( $this, 'tf_shortcode' ) );

	}

	/**
	 * Init backend stuff.
	 *
	 * This plugin is a back-end admin ehancement for posts and pages
	 *
	 * @since 1.0.0
	 */
	public function init_plugin() {
    	if ( current_user_can('edit_posts') || current_user_can('edit_pages') ) {
			// Add MCE plugin.
			add_filter( 'mce_external_plugins', array( $this, 'mce_plugin' ) );

			// Add MCE button.
			add_filter( 'mce_buttons', array( $this, 'mce_button' ) );

			// AJAX the `ls_mce_tf_button` shortcode.
			add_action( 'wp_ajax_ls_mce_tf_button', array( $this, 'wp_ajax_ls_mce_tf_button' ) );

			// Add MCE template.
			add_action( 'print_media_templates', array( $this, 'print_output' ) );

			// Add MCE JS.
			add_action( 'admin_head', array( $this, 'admin_head' ) );

		}
    }

	/**
	 * TF Link shortcode.
	 *
	 * @since 1.0.0
	 */
	public function tf_shortcode( $atts = array(), $innercontent = '' ) {
		// Save $atts.
		$the_atts = shortcode_atts( array(
		        'l' => '/',
		        't' => '_blank',
		        'r' => 'WPCouple',
		        'c' => '',
		    ), $atts );
		$url = strtok( $the_atts['l'], '?');
<<<<<<< HEAD
		return '<a rel="nofollow" href="' . $url . '?ref=' . $the_atts['r'] . '" target="' . $the_atts['t'] . '">' . $innercontent . '</a>';

		// Building view data object.
	    $the_atts = (object) $the_atts;

  //   	// Use Output Buffering feature to have PHP use it's own enging for templating
  //       ob_start();
  //       	/**
  //       	 * View.
  //       	 *
  //       	 * @since 1.0.0
  //       	 */
  //       	// if ( file_exists( LS_DIR . '/assets/tf/view/tf_shortcode_view.php' ) ) {
  //       	//     include( LS_DIR . '/assets/tf/view/tf_shortcode_view.php' );
  //       	// }
  //       return ob_get_clean();

=======
		return '<a class="shortbutton large ' . $the_atts['c'] . '" rel="nofollow" href="' . $url . '?ref=' . $the_atts['r'] . '" target="' . $the_atts['t'] . '">' . $content . '</a>';
>>>>>>> V1
	}

	/**
	 * MCE Plugin.
	 *
	 * @since 1.0.0
	 */
	public function mce_plugin( $plugin_array ) {
		// Add a new plugin to MCE
		$plugin_array['ls_mce_tf'] = LS_URL . '/assets/tf/js/mce-button-tf-inline.js';
		// $plugin_array['ls_mce_tf'] = plugins_url( '/assets/tf/js/mce-button-tf-inline.js', __FILE__ );
		return $plugin_array;
	}

	/**
	 * MCE Button.
	 *
	 * @since 1.0.0
	 */
<<<<<<< HEAD
	public function mce_button( $buttons ) {
        array_push( $buttons, 'ls_mce_tf_button');
		return $buttons;
	}
=======
	public function popup() { ?>
		<div id="my_shortcode_popup" style="display:none;">
			<!--".wrap" class div is needed to make thickbox content look good-->
			<div class="wrap">
				<div>
					<h2>Envato!</h2>
					<div class="my_shortcode_add">
						<div  style="margin:1rem 0;width: 100%">
							<fieldset>Link:</fieldset>
							<input id="tf_link" style="padding:1.5rem;width: 100%" /></div>
						<!-- <div><input id="tf_refarral" value="WPCouple" style="padding:1.5rem;" /></div> -->
						<div  style="margin:1rem 0;width: 100%">
							<fieldset>Link Text:</fieldset>
							<input id="tf_content" value="Demo" style="padding:1.5rem;width: 100%" />
						</div>

						<div><button class="button-primary" id="id_of_button_clicked">Add Envato Link</button></div>
					</div>
				</div>
			</div>
		</div>

	<?php }

>>>>>>> V1

	/**
	 * Print.
	 *
	 * Outputs the view inside the WP editor.
	 *
	 * @since 1.0.0
	 */
    public function print_output() {
        if ( ! isset( get_current_screen()->id ) || get_current_screen()->base != 'post' ) {
            return;
        }

        /**
         * Template.
         *
         * @since 1.0.0
         */
        if ( file_exists( LS_DIR . '/assets/tf/template/tmpl-editor-tf.html' ) ) {
            include_once( LS_DIR . '/assets/tf/template/tmpl-editor-tf.html' );
        }
    }

    /**
     * JS for TinyMCE
     *
     * @since  1.0.0
     */

    public function admin_head() {
		// Current screen.
		$current_screen = get_current_screen();

		//
		if ( ! isset( $current_screen->id ) || $current_screen->base !== 'post' ) {
			return;
		}

		// MCE JS.
		wp_enqueue_script(
		    'tf-editor-view',
		    LS_URL . '/assets/tf/js/tf-editor-view.js',
		    array( 'shortcode', 'wp-util', 'jquery' ),
		    false,
		    true
		);
    }

}

endif;

// Init the class...
WP_TF_Shortcodes::get_instance()->init();

