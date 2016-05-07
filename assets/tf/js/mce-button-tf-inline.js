/* global tinymce */
( function() {
	tinymce.PluginManager.add( 'ls_mce_tf', function( editor ) {
		editor.addButton( 'ls_mce_tf_button', {
			text: 'TF',
			icon: false,
			onclick: function() {
				wp.mce.tf.popupwindow(editor);
			}
		});
	});
})();
