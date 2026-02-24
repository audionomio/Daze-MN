/* ===============================================
	CUSTOMIZER PREVIEW
	Daze - Premium WordPress Theme, by NordWood
================================================== */
(function($) {
	"use strict";
	$(document).ready( function() {
	// Site frame color
		wp.customize( 'daze_main_color_frame', function(value) {
			value.bind( function(v) {
				if ( v ) {
					$('html').css({ "border-color":v });
					$('.top-bar.mobile').find( '.menu-overlay.active' ).css({ "border-color":v });
				}
			});
		});
		
	// Placeholder text color
		wp.customize( 'daze_bgr_pattern_text', function(value) {
			value.bind( function(v) {
				if ( v ) {
					$('.animated-bgr.search-form').find( 'input[type="search"]' ).css({ "color":v });
				}
			});
		});
		
	// Sticky banner height
		wp.customize( 'daze_sticky_banner_height', function(value) {
			value.bind( function(v) {
				if(v) {
					$( '.sticky-banner img' ).css({ "height":v });					
				}
			});
		});
		
	// Sticky banner position
		wp.customize( 'daze_sticky_banner_position', function(value) {
			value.bind( function(v) {
				if( 'bottom-right' === v ) {
					$( '.sticky-banner' ).css({ "right":"7px", "left":"auto" });					
				}
				
				if( 'bottom-left' === v ) {
					$( '.sticky-banner' ).css({ "left":"7px", "right":"auto" });	
				}
			});
		});
		
	// Sticky banner close button
		wp.customize( 'daze_sticky_banner_close', function(value) {
			value.bind( function(v) {
				if ( v ) {
					$( '.sticky-banner' ).find( '.close' ).fadeIn();
					
				} else {					
					$( '.sticky-banner' ).find( '.close' ).fadeOut();
				}
				
			});
		});		
	});	
})(jQuery);