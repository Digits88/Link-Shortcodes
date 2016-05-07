/* global tinyMCE */
(function($){
	var media = wp.media, shortcode_string = 'tf';
	wp.mce = wp.mce || {};
	wp.mce.tf = {
		shortcode_data: {},
		template: media.template( 'editor-tf' ),
		getContent: function() {
			var options = this.shortcode.attrs.named;
			options.innercontent = this.shortcode.content;
			return this.template(options);
		},
		View: { // before WP 4.2:
			template: media.template( 'editor-tf' ),
			postID: $('#post_ID').val(),
			initialize: function( options ) {
				this.shortcode = options.shortcode;
				wp.mce.tf.shortcode_data = this.shortcode;
			},
			getHtml: function() {
				var options = this.shortcode.attrs.named;
				options.innercontent = this.shortcode.content;
				return this.template(options);
			}
		},
		edit: function( data ) {
			var shortcode_data = wp.shortcode.next(shortcode_string, data);
			var values = shortcode_data.shortcode.attrs.named;
			values.innercontent = shortcode_data.shortcode.content;
			wp.mce.tf.popupwindow(tinyMCE.activeEditor, values);
		},
		// this is called from our tinymce plugin, also can call from our "edit" function above
		// wp.mce.tf.popupwindow(tinyMCE.activeEditor, "bird");
		popupwindow: function(editor, values, onsubmit_callback){
			values = values || [];
			if(typeof onsubmit_callback !== 'function'){
				onsubmit_callback = function( e ) {
					// Insert content when the window form is submitted (this also replaces during edit, handy!)
					var args = {
							tag     : shortcode_string,
							type    : e.data.innercontent.length ? 'closed' : 'single',
							content : e.data.innercontent,
							attrs : {
								l     : e.data.l,
								t     : e.data.t,
								r     : e.data.r,
							}
						};
					editor.insertContent( wp.shortcode.string( args ) );
				};
			}
			editor.windowManager.open( {
				title: 'Envato',
				body: [
					{
						type: 'textbox',
						subtype: 'url',
						name: 'mce-button-tf-inline.js',
						label: 'Link/URL',
						value: values.l
					},
					{
						type: 'textbox',
						name: 'innercontent',
						label: 'Content',
						value: values.innercontent
					}
				],
				onsubmit: onsubmit_callback
			} );
		}
	};
	wp.mce.views.register( shortcode_string, wp.mce.tf );
}(jQuery));
