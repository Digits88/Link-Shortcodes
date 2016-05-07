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
	 * Construct.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Add the shortcodes.
		add_action( 'plugins_loaded', array( $this, 'shortcodes' ) );

		// Add the button to the tinymce editor.
		add_action( 'media_buttons_context', array( $this, 'tinymce_button' ) );

		// Popup.
		add_action('admin_footer', array( $this, 'popup' ) );

		// Javascript code needed to make shortcode appear in TinyMCE edtor
		add_action( 'admin_footer', array( $this, 'js' ) );

	}

	/**
	 * Shortcodes.
	 *
	 * @since 1.0.0
	 */
	public function shortcodes() {
		add_shortcode( 'tf', array( $this, 'tf_shortcode' ) );
	}

	/**
	 * TF Link shortcode.
	 *
	 * @since 1.0.0
	 */
	public function tf_shortcode( $atts, $content='' ) {
		// Save $atts.
		$the_atts = shortcode_atts( array(
		        'l' => '/', 		// link.
		        't' => '_blank',	// target.
		        'r' => 'WPCouple',	// referral.
		        'b' => 'y',			// button
		        'c' => '',			// button color.
		    ), $atts );

		// Clean the URL.
		$url = strtok( $the_atts['l'], '?');

		// Is it a button?
		$is_btn = ( 'y' == $the_atts['b'] ) ? 'shortbutton large' : '';

		// Return it.
		return '<a class=" ' . $is_btn . ' ' . $the_atts['c'] . '" rel="nofollow" href="' . $url . '?ref=' . $the_atts['r'] . '" target="' . $the_atts['t'] . '">' . $content . '</a>';
	}

	/**
	 * Button.
	 *
	 * @since 1.0.0
	 */
	public function tinymce_button( $context ) {
		return $context.=__('
			<a href="#TB_inline?width=480&inlineId=my_shortcode_popup&width=500&height=300" class="button thickbox" id="my_shortcode_popup_button"><span class="" style="padding: 0.2rem 0.1rem 0 0;
			"></span>TF Link</a>');
	}



	/**
	 * Button Popup.
	 *
	 * Generate inline content for the popup window when the "my shortcode" button is clicked
	 *
	 * @since 1.0.0
	 */
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


	/**
	 * JS Popup.
	 *
	 * @since 1.0.0
	 */
	public function js(){?>
		<script>
		jQuery('#id_of_button_clicked ').on('click',function(){

			// Building the shortcode.
			var tf_link = jQuery('#tf_link').val();
			// var tf_refarral = jQuery('#tf_refarral').val();
			var tf_content = jQuery('#tf_content').val();
			var shortcode = '[tf l="' + tf_link + '"]' + tf_content + '[/tf]';

			// Add shortcode to the content area.
			if( !tinyMCE.activeEditor || tinyMCE.activeEditor.isHidden()) {
				jQuery('textarea#content').val(shortcode);
			} else {
				tinyMCE.execCommand('mceInsertContent', false, shortcode);
			}
			//close the thickbox after adding shortcode to editor
			self.parent.tb_remove();
		});
		</script>

	<?php }

}

endif;

new WP_TF_Shortcodes();
