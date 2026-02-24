/* ==============================================
	Scripts for posts slider (columns)
	Daze - Premium WordPress Theme, by NordWood
================================================= */
(function($) {
	"use strict";
	
	if( 0 < $( "#nwps" ).length ) {
		var nwps_ratio = 8/3,
			nwps_w,
			nwps_h,
			mod = 3;		
			
		if( window.innerWidth >= 768 ) {
			mod = 3;
			nwps_ratio = 8/3;
			
		} else {
			mod = 1;
			nwps_ratio = 11/8;
		}
		
		$('#nwps .holder').addClass('slide-in');
		
		$('.nwps.columns').on('init', function(event, slick){
			$(this).delay(1000).fadeTo(1000,1);
			$(this).find('.nwps-content').delay(2000).fadeIn();
		});
		
		var icon_prev = nwps_args.icon_prev,
			icon_next = nwps_args.icon_next;
		
		var auto_play = nwps_args.autoplay;
		if ( auto_play ) {
			auto_play = true;
			
		} else {
			auto_play = false;
		}

		$('.nwps.columns').slick({
			autoplay: auto_play,
			autoplaySpeed: 9000,
			lazyLoad: 'ondemand',
			infinite: true,
			fade: false,
			slide: '.nwps-slide',
			slidesToShow: 3,
			slidesToScroll: 3,
			focusOnSelect: false,
			prevArrow: icon_prev,
			nextArrow: icon_next,
			arrows: false,
			dots: true,
			customPaging: function(slider, i) {
				return '<button type="button" data-role="none" role="button" aria-required="false" tabindex="0"></button>';
			},
			useTransform: false,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						arrows: true,
						dots: false
					}
				}
			]
		});
		
		var slides_to_show = $('.nwps.columns').slick('getSlick')['options']['slidesToShow'],
			slides_sum = $('.nwps.columns').slick('getSlick')['slideCount'],
			diff = slides_sum % slides_to_show,
			slider_timeout,
			slider_clicked = 0,
			autoreveal;	
				
		$(window).on('resize', function() {
			slides_to_show = $('.nwps.columns').slick('getSlick')['options']['slidesToShow'];
			slides_sum = $('.nwps.columns').slick('getSlick')['slideCount'];
			diff = slides_sum % slides_to_show;
			
			if( window.innerWidth >= 768 ) {
				mod = 3;
				nwps_ratio = 8/3;
				
			} else {
				mod = 1;
				nwps_ratio = 11/8;
			}
			
			nwps_w = $('.nwps-loader').width();
			nwps_h = nwps_w/nwps_ratio;
				
			$('#nwps .holder').width(nwps_w).height(nwps_h);		
			$('.nwps .slick-slide.nwps-slide').height(nwps_h);		
			
		}).trigger('resize');
		
		reveal_slide(0);

		if(auto_play && ( 0 === slider_clicked )) {
			var prepare_slider = function () {
				var r = $.Deferred();
				
				autoreveal = setTimeout(function () {
					reveal_slide(1);
					r.resolve();
				}, 5000);
				
				return r;
			};
			
			var auto_slider = function () {
				reveal_slides_auto(0);
			};
			
			prepare_slider().done(auto_slider);
		}	
		
	// Reveal the post column on click
		$('.nwps.columns h3').on( 'click', function(e) {
			e.preventDefault();
			
			clearTimeout(slider_timeout);
			
			var current_column = $(this).closest('.nwps-slide').data("slickIndex");
			
			$('.nwps.columns .nwps-img:not([data-curr-slide='+current_column+'])').fadeTo(400, 0);
			$('.nwps.columns').find('.nwps-img[data-curr-slide='+current_column+']').fadeTo(400, 1);
			
			$('.nwps.columns .nwps-slide:not([data-curr-slide='+current_column+']) .nwps-content').fadeTo(200, 0.5);
			$('.nwps.columns .nwps-slide[data-curr-slide='+current_column+'] .nwps-content').fadeTo(200, 1, function() {
				$(this).find('.read-more').fadeTo(800, 1).addClass('draw');
			});
		});
		
		
	// Pause auto sliding on hover, resume on mouse leave and stop permanently on mouse interaction
		$(".nwps.columns").on( 'mouseenter', function(){
			clearTimeout($(this).data('in_slider'));
			
			var slider_holder = $(this),
				out_of_slider = setTimeout(function(){
					clearTimeout(slider_timeout);
				}, 400);
			slider_holder.data('out_of_slider', out_of_slider);
			
		}).on( 'mousedown', function(){
			clearTimeout(autoreveal);
			
			var slider_holder = $(this),
				click_on_slider = setTimeout(function(){
					slider_clicked++;
				}, 400);
			slider_holder.data('click_on_slider', click_on_slider);
			
		}).on( 'mouseleave', function(){
			clearTimeout($(this).data('out_of_slider'));
			
			var slider_holder = $(this),
				in_slider = setTimeout(function(){
					if(auto_play && slider_clicked === 0) {
						reveal_slides_auto($('.nwps.columns').slick('slickCurrentSlide'));
					}
				}, 400);
			slider_holder.data('in_slider', in_slider); 
		});
		
		$('.nwps.columns').on('afterChange', function(event, slick, currentSlide) {
			$('.nwps.columns .nwps-img:not([data-curr-slide='+currentSlide+'])').fadeTo(400, 0);
			$('.nwps.columns').find('.nwps-img[data-curr-slide='+currentSlide+']').fadeTo(400, 1);
							
			$('.nwps.columns .nwps-slide:not([data-curr-slide='+currentSlide+']) .nwps-content').fadeTo(200, 0.5);
			$('.nwps.columns .nwps-slide[data-curr-slide='+currentSlide+'] .nwps-content').fadeTo(200, 1, function() {
				$(this).find('.read-more').fadeTo(800, 1).addClass('draw');
			});
		});
		
		function reveal_slide(sl) {
			$('.nwps.columns .nwps-img:not([data-curr-slide='+sl+'])').fadeTo(800, 0);
			
			$('.nwps.columns .nwps-img[data-curr-slide='+sl+']').fadeTo(400, 1, function() {
				
				$('.nwps.columns .nwps-slide[data-curr-slide='+sl+'] .nwps-content').fadeTo(100, 1, function() {
					$(this).find('.read-more').fadeTo(100, 1).addClass('draw');
					
					$('.nwps.columns .nwps-slide[data-curr-slide='+sl+']').next().find('.nwps-content').fadeTo(200, 0.5, function() {
						$('.nwps.columns .nwps-slide[data-curr-slide='+sl+']').next().next().find('.nwps-content').fadeTo(200, 0.5);
					});
				});
			});
		}
		
		function reveal_slides_auto(current_column) {
			clearTimeout(slider_timeout);
			current_column++;
			
			if( current_column % mod === 0 ) {
				$('.nwps.columns').slick('slickNext');
			}
			if( current_column === slides_sum ) {
				$('.nwps.columns').slick('slickGoTo', 0);
				current_column = 0;
			}	
			
			$('.nwps.columns .nwps-img:not([data-curr-slide='+current_column+'])').fadeTo(400, 0);
			$('.nwps.columns').find('.nwps-img[data-curr-slide='+current_column+']').fadeTo(400, 1);
							
			$('.nwps.columns .nwps-slide:not([data-curr-slide='+current_column+']) .nwps-content').fadeTo(200, 0.5);
			$('.nwps.columns .nwps-slide[data-curr-slide='+current_column+'] .nwps-content').fadeTo(200, 1, function() {
				$(this).find('.read-more').fadeTo(800, 1).addClass('draw');
			});
			
			slider_timeout = setTimeout(reveal_slides_auto, 5000, current_column);
		}	
		
		function reveal_column(current_column) {
			current_column++;
			
			$('.nwps.columns .nwps-img:not([data-curr-slide='+current_column+'])').fadeTo(800, 0);
			$('.nwps.columns').find('.nwps-img[data-curr-slide='+current_column+']').fadeTo(800, 1);
			
			$('.nwps.columns .nwps-slide:not([data-curr-slide='+current_column+']) .nwps-content').fadeTo(400, 0.5);				
			$('.nwps.columns .nwps-slide[data-curr-slide='+current_column+'] .nwps-content').fadeTo(200, 1);
		}
	}	
})(jQuery);