/* =================================================
	Scripts for Instagram carousel
	Daze - Premium WordPress Theme, by NordWood
==================================================== */
jQuery(document).ready(function($) {
	"use strict";
	
	$( '.insta-car .carousel.mini' ).slick({
		lazyLoad: 'ondemand',
		slidesToShow: 2,
		slidesToScroll: 2,
		infinite: true,
		dots: false,
		arrows: false,
		mobileFirst: true
	});
	
	$( '.insta-car .carousel.spread' ).slick({
		lazyLoad: 'ondemand',
		slidesToShow: 3,
		slidesToScroll: 3,
		infinite: true,
		dots: false,
		arrows: false,
		mobileFirst: true,
		responsive: [{
			breakpoint: 600,
			settings: {
				slidesToShow: 4,
				slidesToScroll: 4
			}			
		},
		{	
			breakpoint: 1024,
			settings: {
				slidesToShow: 6,
				slidesToScroll: 6
			}	
		}]
	});
});