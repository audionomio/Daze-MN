/* =================================================
	Scripts for Popular/Latest posts slider
	Daze - Premium WordPress Theme, by NordWood
==================================================== */
jQuery(document).ready(function($) {
	"use strict";
	
	$('.top-posts-slider').each(function() {
		$(this).slick({
			autoplay: false,
			autoplaySpeed: 6000,
			lazyLoad: 'ondemand',
			appendDots: $(this).siblings('.nav-container'),
			dots: true,
			arrows: false,
			customPaging : function(slider, i) {
				var thumb = $( slider.$slides[i] ).data( 'thumb' );
				return '<h3>'+thumb+'</h3>';
			},
			rtl: $('body').hasClass( 'rtl' ) ? true : false
		});
	});
});