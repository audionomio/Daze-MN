/* =================================================
	Scripts for gallery slider
	Daze - Premium WordPress Theme, by NordWood
==================================================== */
(function($) {
	"use strict";
	
	var icon_prev = gall_args.icon_prev,
		icon_next = gall_args.icon_next;
	
	$(".gallery-slider").slick({
		autoplay: false,
		lazyLoad: 'ondemand',
		dots: true,
		dotsClass: 'slick-dots clearfix',
		arrows: true,
		prevArrow: '<span class="slick-prev slick-arrow arrow va-middle">'+icon_prev+'</span>',
		nextArrow: '<span class="slick-next slick-arrow arrow va-middle">'+icon_next+'</span>',
		customPaging : function(slider, i) {
			var thumb = $(slider.$slides[i]).data('thumb'); 
			return '<a><img src="'+thumb+'"></a>';
		}
	});	
})(jQuery);