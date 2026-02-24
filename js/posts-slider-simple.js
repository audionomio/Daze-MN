/* ==============================================
	Scripts for posts slider (simple)
	Daze - Premium WordPress Theme, by NordWood
================================================= */
(function($) {
	"use strict";
	
	if( 0 < $( "#nwps" ).length ) {
		var nwps_ratio = 8/3,
			nwps_w = $('.nwps-loader').width(),
			nwps_h = nwps_w/nwps_ratio;		
			
		if( window.innerWidth >= 768 ) {
			nwps_ratio = 8/3;
			
		} else {
			nwps_ratio = 11/8;
		}
			
		$(window).on( 'resize', function() {
			if( window.innerWidth >= 768 ) {
				nwps_ratio = 8/3;
				
			} else {
				nwps_ratio = 11/8;
			}		
			
			nwps_w = $('.nwps-loader').width();
			nwps_h = nwps_w/nwps_ratio;
			
			$('#nwps .holder').css({"width":nwps_w, "height":nwps_h }).addClass('slide-in');
			$('.nwps .slick-track').height(nwps_h);
		}).trigger('resize');
		
		$('.nwps.simple').on( 'init', function(event, slick){
			$(this).find('.slick-track').height(nwps_h);
			$(this).delay(1000).fadeTo( 1000,1 );
			$(this).find('.nwps-slide[data-slick-index=0] .nwps-content').delay(2000).fadeIn();		
		});	
		
		$('.nwps.simple').on('beforeChange', function(event, slick, currentSlide, nextSlide){
			var next = $('.nwps-slide[data-slick-index=' + nextSlide + ']');		
			next.css({"zIndex":"11"});
			next.find('.inner-wrapper').animate({"left":0});
			next.find('.inner-wrapper').find('.nwps-content').delay(200).fadeIn(1000);
		});
		
		$('.nwps.simple').on('afterChange', function(event, slick, currentSlide){		
			$('.nwps-slide[data-slick-index=' + currentSlide + ']').prevAll().find('.inner-wrapper').css({"left":"-100%"});
			$('.nwps-slide[data-slick-index=' + currentSlide + ']').nextAll().find('.inner-wrapper').css({"left":"100%"});		
			$('.nwps-slide').css({"zIndex":"9"});
			$('.nwps-slide[data-slick-index=' + currentSlide + ']').css({"zIndex":"10"});
			$('.nwps-slide:not([data-slick-index=' + currentSlide + '])').find('.nwps-content').fadeOut();
		});
		
		var icon_prev = nwps_args.icon_prev,
			icon_next = nwps_args.icon_next;
		
		var auto_play = nwps_args.autoplay;
		
		if ( auto_play ) {
			auto_play = true;
			
		} else {
			auto_play = false;
		}

		$('.nwps.simple').slick({
			autoplay: auto_play,
			autoplaySpeed: 6000,
			slidesToShow: 1,
			slidesToScroll: 1,
			lazyLoad: 'ondemand',
			infinite: true,
			fade: false,
			arrows: true,
			prevArrow: icon_prev,
			nextArrow: icon_next,
			dots: true,
			useTransform: false,
			draggable: true,
			customPaging: function(slider, i) {
				return '<button type="button" data-role="none" role="button" aria-required="false" tabindex="0"></button>';
			},
			responsive: [
				{
					breakpoint: 768,
					settings: {
						dots: false
					}
				}
			]
		});
	}	
})(jQuery);