/* =================================================
	Scripts for Google Map (with given coordinates)
	Daze - Premium WordPress Theme, by NordWood
==================================================== */
(function($) {
	"use strict";
	
	var map,
		get_lat = parseFloat(mapargs.lat),
		get_lng = parseFloat(mapargs.lng);
	
	function init_map_coords() {
		map = new google.maps.Map(
			document.querySelector('.g-map'), {
			zoom: 14,
			center: {lat: get_lat, lng: get_lng},
			scrollwheel: false,
			zoomControl: true,
			mapTypeControl: true,
			scaleControl: false,
			streetViewControl: false,
			rotateControl: false,
			fullscreenControl: false
		});
				
		var marker_image = mapargs.pin,
			marker_title = mapargs.title,
			pin_title = ( marker_title != undefined ) ? marker_title : '';
		
		if( marker_image != undefined ) {
			var marker = new google.maps.Marker({
				map: map,
				position: {lat: get_lat, lng: get_lng},
				icon: marker_image,
				title: pin_title
			});
		}
	}
	init_map_coords();

    $(window).on( 'resize', function() {		
		$('.g-map').css({"height":"300px"});
		if( window.innerWidth >= 768 && $('.contact-map').hasClass('section-2-of-2') ) {
			$('.g-map').css({"height":$('.section-1-of-2').height()-$('.section-2-of-2').find('.section-heading').height()});
		}
    }).trigger('resize');	
})(jQuery);