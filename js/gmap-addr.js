/* =================================================
	Scripts for Google Map (with given address)
	Daze - Premium WordPress Theme, by NordWood
==================================================== */
(function($) {
	"use strict";
	
	var map,
		geocoder = new google.maps.Geocoder();
		
	geocodeAddress(geocoder, map);
	
	function geocodeAddress(geocoder, resultsMap) {
		var address = mapargs.addr;
		
		geocoder.geocode({'address': address}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map = new google.maps.Map(
					document.querySelector('.g-map'), {
					zoom: 14,
					center: results[0].geometry.location,
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
				marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon: marker_image,
					title: marker_title
				});

			} else {
				console.log('Geocode was not successful for the following reason: ' + status);
			}
		});
	}

    $(window).on('resize', function() {		
		$('.g-map').css({"height":"300px"});
		if( window.innerWidth >= 768 && $('.contact-map').hasClass('section-2-of-2') ) {
			$('.g-map').css({"height":$('.section-1-of-2').height()-$('.section-2-of-2').find('.section-heading').height()});
		}
    }).trigger('resize');	
})(jQuery);