/* =================================================
	Scripts for image upload
	Daze - Premium WordPress Theme, by NordWood
==================================================== */
jQuery(function($){
	"use strict";
	
	var frame,
		add_img_bttn = $('.upload-img'),
		remove_img_bttn = $('.remove-img');
		
// Add image		
	$(document).on('click', '.upload-img', function( event ) {			
		add_img_bttn = $(this);
		event.preventDefault();
		
		if (frame) {
			frame.open();
			return;
		}
		
		frame = wp.media({
			title: 'Select or upload your image',
			button: {
				text: 'Use this image'
			},
			multiple: false
		});
		
		frame.on('select', function() {			
			var attachment = frame.state().get( 'selection' ).first().toJSON(),
				img_preview = add_img_bttn.siblings( '.img-preview' ),
				img_id = add_img_bttn.siblings( '.img-id' ),
				img_url = add_img_bttn.siblings( '.img-url' ),
				attachment_url = attachment.url;
			
			if( attachment.sizes.thumbnail !== undefined )
				attachment_url = attachment.sizes.thumbnail.url;
				
			remove_img_bttn = add_img_bttn.siblings( '.remove-img' );
				
			img_preview.append( '<img src="'+attachment_url+'" alt="'+attachment.alt+'" title="'+attachment.title+'" />' );				
			img_id.val( attachment.id );
			img_url.val( attachment.url );			
			add_img_bttn.addClass( 'hidden' );
			remove_img_bttn.removeClass( 'hidden' );
		});
		
		frame.open();
	});
  
// Remove image		
	$(document).on('click', '.remove-img', function(event) {
		remove_img_bttn = $(this);
		event.preventDefault();
		
		var img_preview = remove_img_bttn.siblings( '.img-preview' ),
			img_id = remove_img_bttn.siblings( '.img-id' ),
			img_url = remove_img_bttn.siblings( '.img-url' );
		
		add_img_bttn = remove_img_bttn.siblings( '.upload-img' );
		
		img_preview.html('');		
		img_id.val('');
		img_url.val('');	
		remove_img_bttn.addClass( 'hidden' );
		add_img_bttn.removeClass( 'hidden' );
	});
});