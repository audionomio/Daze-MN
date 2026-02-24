/* ==============================================
	Scripts for masonry layout
	Daze - Premium WordPress Theme, by NordWood
================================================= */
jQuery( document ).ready( function($) {
	"use strict";
	
// Adjust the image size on "cover" items
	function item_resize() {
	   $('.masonry-item .cover-item').each( function() {
			var featured_area = $(this).find('.featured-area');
			
			if( !featured_area.is(':empty') ) {
				var item_h = $(this).find('.post-header').height(),
					item_w = $(this).width(),
					featured_img = $(this).find('.featured-img img');
				
				if( window.innerWidth > 1279 ) {
					$(this).css({ "height": ( featured_img.height()*item_w/featured_img.width() ) });
					
					if( featured_img.height() < $(this).height() ) {
						featured_img.css({ "height":"100%", "width":"auto" });
					}					
					
					if( featured_img.width() > featured_area.width() ) {
						var pull = -( featured_img.width() - featured_area.width() )/2;
						featured_img.css({ "margin-left":pull });						
					}
					
				} else {
					$(this).css({ "height": "auto" });
					featured_img.css({ "width":"100%", "height":"auto" });
				}
			}
		});
	}
	
	$(window).on('load', function(){
		list_container.imagesLoaded(function(){
			item_resize();
			$container.masonry();	
		});
	});
			
	var list_container = $('.masonry-list-wrapper');
	
	var anim_bgr_off = list_container.hasClass( 'no-anim-bgr' );
	
	var $container = list_container.masonry({
		initLayout: false,
		itemSelector: '.masonry-item-wrapper',
		columnWidth: '.masonry-item-sizer',
		percentPosition: true,
		originLeft: $('body').hasClass( 'rtl' ) ? false : true
	});

	$container.masonry( 'once', 'layoutComplete', function(items) {
		var elems = $container.masonry('getItemElements');
		
		$(elems).css({ "visibility":"hidden" });
		
		if( true === anim_bgr_off ) {
			$(elems).css({"visibility":"visible"}).find( '.masonry-content' ).css({ "opacity":1 });				
			
		} else {
			var i = 0;
			var timing = setInterval(
				function() {
					if( i > elems.length-1 ) {
						clearInterval(timing);
						
					} else {
						$(elems[i]).css({"visibility":"visible"});
						$(elems[i]).find('.drop-overlay').addClass('animate');
						$(elems[i]).find('.masonry-content').delay(800).queue(
							function (next) {
								$(this).css({"opacity":1});
								next();
							}
						);
						i++;
					}
				},
				400
			);
		}		
	});

	list_container.imagesLoaded( function(){
		$container.masonry();	
	});
	
    $(window).on( 'resize', function() {
		item_resize();
    }).trigger('resize');	
});