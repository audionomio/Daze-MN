/* ==============================================
	Main scripts
	Daze - Premium WordPress Theme, by NordWood
================================================= */
"use strict";

var daze_gall_ratio = 0.54,
	daze_ratio_4_3 = 4/3, // 1.33
	daze_ratio_4_3 = 16/9; // 1.78

var $ = jQuery.noConflict();

// Convert SVG images to inline SVG
$.fn.img_to_svg = function() {
	var $img = $(this),
		imgID = $img.attr('id'),
		imgClass = $img.attr('class'),
		imgURL = $img.attr('src');

	$.get( imgURL, function(data) {
		var $svg = $(data).find('svg');

		if(typeof imgID !== 'undefined') {
			$svg = $svg.attr('id', imgID);
		}
		
		if(typeof imgClass !== 'undefined') {
			$svg = $svg.attr('class', imgClass+' replaced-svg');
		}

		$svg = $svg.removeAttr('xmlns:a');

		$img.replaceWith($svg);

	}, 'xml');
}

$.fn.iframe_size = function() {
	var iframeSRC = $(this).attr("src");
	
	if( undefined != iframeSRC ) {	
		// Ratio 16/9: Vimeo, YouTube, TED, DailyMotion, Animoto, WordPress.tv
		var iframe_16_9 = ( iframeSRC.indexOf("vimeo.com") >= 0 )
						|| ( iframeSRC.indexOf("youtube.com") >= 0 )
						|| ( iframeSRC.indexOf("ted.com") >= 0 )
						|| ( iframeSRC.indexOf("dailymotion.com") >= 0 )
						|| ( iframeSRC.indexOf("animoto.com") >= 0 )
						|| ( iframeSRC.indexOf("wordpress.tv") >= 0 )
						|| ( iframeSRC.indexOf("funnyordie.com") >= 0 )
						|| ( iframeSRC.indexOf("facebook.com") >= 0 )
						|| ( iframeSRC.indexOf("videopress.com") >= 0 );
		
		if( iframe_16_9 ) {
			$(this).attr({ "height":$(this).width()/daze_ratio_4_3 });
		}						
		
		// Ratio 4/3: KickStarter
		if( iframeSRC.indexOf("kickstarter.com") >= 0 ) {
			$(this).attr({"height":$(this).width()/daze_ratio_4_3});
		}			
		
		// Ratio 1/1: Vine
		if( iframeSRC.indexOf("vine.co") >= 0 ) {
			$(this).attr({"height":$(this).width()});
		}
		
		// SoundCloud
		if( iframeSRC.indexOf("soundcloud.com") >= 0 ) {
			if( iframeSRC.indexOf("visual=true") >= 0 ) {
				$(this).attr({"height":"450"});
				
			} else {
				$(this).attr({"height":"166"});
			}
		}			
		
		// MixCloud
		if( iframeSRC.indexOf("mixcloud.com") >= 0 ) {
			if( iframeSRC.indexOf("hide_cover=1") >= 0 ) {
				if( iframeSRC.indexOf("mini=1") >= 0 ) {
					$(this).attr({"height":"60"});
					
				} else {
					$(this).attr({"height":"120"});
				}
				
			} else {
				$(this).attr({"height":"400"});
			}
		}
		
		// AudioMack
		if( iframeSRC.indexOf("audiomack.com") >= 0 ) {
			$("#wrap.embed").css({"max-width":"none"});
			
			if( iframeSRC.indexOf("large") >= 0 ) {
				$(this).attr({"height":"250"});
				
			} else if( iframeSRC.indexOf("thin") >= 0 ) {
				$(this).attr({"height":"62"});
				
			} else {
				$(this).attr({"height":"110"});
			}
		}
	}
}
	
jQuery( document ).ready( function($) {
	"use strict";
	
	var main_w = $('#main').width(),
		content_w = $('#main .post-content').width(),
		top_bar_mobile_h = $('.mobile.top-bar').outerHeight(),
		top_bar_desktop_h = $('.desktop.top-bar').outerHeight(),
		footer_h = $('#site-footer').outerHeight(),
		central_wrapper = $('#central-wrapper');
		
// Convert SVG images to inline SVG
	$('img.svg').each( function() {
		$(this).img_to_svg();
	});
		
// Reveal color of social icons on hover
	$('.social').on( 'mouseenter', 'a', function() {
		var icon = $(this),
			path = icon.find('path');
		
		if ( path.length < 1 ) {
			path = icon.find('polygon');
		}
		
		icon.removeClass('bw').css({ "color":path.attr('fill') });
		
	}).on( 'mouseleave', 'a', function(){
		$(this).addClass('bw').css({ "color":"inherit" });
	});
	
// 	Add sticky marker to sticky posts
	$('.masonry-list-wrapper .sticky').prepend('<span class="sticky-marker"><svg x="0px" y="0px" width="10px" height="22px" viewBox="0 0 25.411 54.523" enable-background="new 0 0 25.411 54.523"><path fill="#fff" d="M0,0h25.411v54.528L12.705,41.823L0,54.529V0z M1.694,50.505l11.011-11.012l11.012,11.012V1.695H1.694V50.505z"/></svg></span>');
	
	$('.standard-list .sticky .post-title').append('<span class="sticky-marker"><svg x="0px" y="0px" width="10px" height="22px" viewBox="0 0 25.411 54.523" enable-background="new 0 0 25.411 54.523"><path fill="#fff" d="M0,0h25.411v54.528L12.705,41.823L0,54.529V0z M1.694,50.505l11.011-11.012l11.012,11.012V1.695H1.694V50.505z"/></svg></span>');
	
// Assign data attribute to each cell for responsive tables
	$(".post-content table").each( function() {
		var table = $(this),
			thead = table.find("thead"),
			theaders = thead.find("th"),
			trows = table.find("tr");
			
		trows.each(function (index) {
			$(this).children().attr('data-th', function () {
				return theaders.eq($(this).index()).text();
			});
		});
	});
	
/* Smooth scroll */
	$(".smooth-scroll").on( 'click', function(event) {
		if( "" !== this.hash ) {
			event.preventDefault();

			var hash = this.hash;

			$('html, body').animate({
				scrollTop: $(hash).offset().top
				
			}, 200, function(){
				window.location.hash = hash;
			});
		}
	});
	
// Scroll to top
	$(window).scroll(function(){
		if ($(this).scrollTop() > 768) {
			$('#to-top').fadeIn();
			
		} else {
			$('#to-top').fadeOut();
		}
	});
	
	$('#to-top').click(function(){
		$('html, body').animate({scrollTop : 0},400);
		return false;
	});
	
// Close sticky banner	
	$( '.sticky-banner' ).on( 'click', '.close', function(e) {
		$(this).closest( '.sticky-banner' ).fadeOut();
	});
	
// Central wrapper
	if( window.innerWidth < 1180 ) {
		central_wrapper.css({"min-height":window.innerHeight-top_bar_mobile_h-footer_h-10});
	}
	
	if( window.innerWidth >= 1180 ) {
		central_wrapper.css({"min-height":window.innerHeight-top_bar_desktop_h-footer_h-14});
	}
		
// Lists
	$('.post-content li').wrapInner('<span></span>');
		
// Top bar and menu
	var mobile_top_search_button = $(".top-bar.mobile .search-button"),
		mobile_top_search = $(".top-bar.mobile .search-form"),
		desktop_top_search_button = $(".top-bar.desktop .search-button"),
		desktop_menu_search_button = $("#site-header nav .search-button"),
		desktop_top_search = $(".top-bar.desktop .search-form"),
		no_results_search = $(".no-results .search-form"),
		search_results = $(".search-header .search-form"),
		menu_overlay_button = $(".top-bar.mobile .menu-button"),
		menu_overlay = $(".top-bar.mobile .menu-overlay");
	
	no_results_search.addClass('animated-bgr');
	search_results.addClass('animated-bgr');
	
// Top bar search
	desktop_top_search.addClass('animated-bgr');
	
	$('.top-bar.desktop .search-button, #site-header nav .search-button').on('click', function(e) {
		e.preventDefault();
		
		$('.search-button').find('.search, .close').fadeToggle();
		desktop_top_search.slideToggle(100).find('.search-field').focus();
	});
	
	$(document).on('click', function (e) {
		if (
			0 === $(e.target).closest(desktop_top_search_button).length
			&& 0 === $(e.target).closest(desktop_menu_search_button).length
			&& 0 === $(e.target).closest(desktop_top_search).length
			&& 0 === $(e.target).closest(mobile_top_search_button).length
			&& 0 === $(e.target).closest(mobile_top_search).length
			&& 'none' != $('.search-form.animated-bgr').css('display')
			
		) {
			$(desktop_top_search).slideUp(100);
			
			$('.search-button').find('.close').fadeOut();
			$('.search-button').find('.search').fadeIn();
		}
	});
	
	$(document).keyup(function(e) {
		if ( 27 === e.keyCode ) {
			$(desktop_top_search).slideUp(100);
			
			$('.search-button').find('.close').fadeOut();
			$('.search-button').find('.search').fadeIn();
		}
	});
	
	mobile_top_search_button.on('click', function(e) {
		e.preventDefault();
		
		$('.search-button').find('.search').fadeToggle();
		$('.search-button').find('.close').fadeToggle();
		mobile_top_search.fadeToggle();
	});
	
// Mobile menu overlay
	menu_overlay_button.on('click', function(e) {
		e.preventDefault();
		
		$(this).find('.menu-icon').fadeToggle();
		$(this).find('.close').fadeToggle();
		$('body').toggleClass("menu-overlay-active");		
		$('html').toggleClass("menu-overlay-active");
		
		menu_overlay.toggleClass("active").toggleClass("inactive");
		
		var bottomBorderWidth = $('html').css("border-top-width");
		var borderWidth = Math.round(parseFloat(bottomBorderWidth));
		
		$('.top-bar.mobile .menu-overlay.active').animate({"height":window.innerHeight - $(".top-bar.mobile").innerHeight() - borderWidth},300);
		$('.top-bar.mobile .menu-overlay.inactive').animate({"height":0},100);

		$('.top-bar.mobile li.menu-item-has-children > a').on( 'click', function(e) {
			e.preventDefault();
			
			$(this).parent().toggleClass("active");
			$(this).next("ul").slideToggle();
		});
	});
	
// Menu dropdown icons
	$('.top-bar.mobile .main-menu li.menu-item-has-children, #site-header .main-menu > ul > li.menu-item-has-children').append('<svg x="0px" y="0px" width="35.5px" height="18.5px" viewBox="21.938 50.125 35.5 18.5" enable-background="new 21.938 50.125 35.5 18.5"><polyline fill="none" stroke="none" stroke-width="2" stroke-linejoin="bevel" stroke-miterlimit="10" points="56.749,67.938 39.749,50.938 22.749,67.938"/></svg>');
	
	$('#site-header .sub-menu li.menu-item-has-children').append('<svg x="0px" y="0px" width="18.5px" height="35.5px" viewBox="30.438 41.625 18.5 35.5" enable-background="new 30.438 41.625 18.5 35.5"><polyline fill="none" stroke="none" stroke-width="2" stroke-linejoin="bevel" stroke-miterlimit="10" points="31.25,76.438 48.25,59.438 31.25,42.438"/></svg>');
	
// Instagram grid	
	if ( 0 < $( '.insta-grid' ).length ) {
		$( '.insta-grid' ).each( function(i, el) {
			$( el ).imagesLoaded( function() {
				var item = $( el ).find('.item'),
					item_h = item.width();
					
				item.height(item_h);
			});
		} );
	}
	
// On window resize
    $(window).on('resize', function() {		
		var main_w = $('#main').width(),
			content_w = $('#main .post-content').width(),			
			top_bar_mobile_h = $('.mobile.top-bar').outerHeight(),
			top_bar_desktop_h = $('.desktop.top-bar').outerHeight(),
			footer_h = $('#site-footer').outerHeight(),
			central_wrapper = $('#central-wrapper'),
			latest_main_w,
			latest_content_w;
		
	// Central wrapper
		if( window.innerWidth < 1180 ) {
			central_wrapper.css({"min-height":window.innerHeight-top_bar_mobile_h-footer_h-10});
		}
		
		if( window.innerWidth >= 1180 ) {
			central_wrapper.css({"min-height":window.innerHeight-top_bar_desktop_h-footer_h-14});
		}
	
	// Enlarge images and galleries
		$("#main img.size-daze_wrapper_width").each(function(){
			$(this).css({"width":main_w}).addClass('reveal');
			
			if ( $(this).parents("figure").length == 1 ) { 
				$(this).parent("figure").addClass("size-daze_wrapper_width").css({"width":main_w}).addClass('reveal');
			}
		});
		
		var widget_gall_ratio = 3/4;
		
		$(".widget_media_gallery .gallery-slider").find(".slick-track").css({ "height":$(".widget_media_gallery .gallery-slider").width()*widget_gall_ratio });
		
		$(".featured-area .gallery-slider").find(".slick-track").css({ "height":$(".featured-area .gallery-slider").width()*daze_gall_ratio });
		
		$("article:not(.enlarge-galleries) .post-content .gallery-slider").find(".slick-track").css({ "height":content_w*daze_gall_ratio });
		
		$(".enlarge-galleries .post-content .gallery-slider").css({ "width":main_w }).addClass('reveal');
		$(".enlarge-galleries .post-content .gallery-slider").find(".slick-track").css({ "height":main_w*daze_gall_ratio });
		
		latest_main_w = $('.latest-enlarged').width();
		latest_content_w = $('.latest-enlarged').find('.post-content').width();
		$(".latest-enlarged img.size-daze_wrapper_width").each(function(){
			
			$(this).css({ "width":latest_main_w }).addClass('reveal');
			
			if ( $(this).parents("figure").length == 1 ) { 
				$(this).parent("figure").addClass("size-daze_wrapper_width").css({ "width":latest_main_w }).addClass('reveal');
			}
		});
		
		$(".latest-enlarged .enlarge-galleries .post-content .gallery-slider").css({ "width":latest_main_w }).addClass('reveal');
		$(".latest-enlarged .post-content .gallery-slider").find(".slick-track").css({ "height":latest_content_w*daze_gall_ratio });
		
		$(".gallery-slider").each( function() {
			var h = $(this).find(".slick-track").height(),
				mid = h/2;
			
			$(this).find(".slick-arrow").css({ "top":mid });
		});
		
	// Embedded media			
		$(".enlarge-media .post-content iframe").each(function(){
			var iframeSRC = $(this).attr("src");
			
			if ( iframeSRC.indexOf("vine.co") >= 0 ) {
				$(this).attr({"width":content_w}).css({"margin-left":0});
				
			} else if( $(this).parents('.latest-enlarged').length > 0 ) {
				$(this).attr({"width":latest_main_w});
				
			} else {
				$(this).attr({"width":main_w});
			}
		});
		
		$( ".main-holder" ).find("iframe").each( function() {
			$(this).iframe_size();
		} );
		
	// Mobile menu overlay
		if( window.innerWidth < 1180 ) {
			var mobile_top_bar_W = $(".top-bar.mobile").outerWidth(),
				mobile_top_bar_H = $(".top-bar.mobile").outerHeight(),
				menu_overlay_H = window.innerHeight - mobile_top_bar_H - 9;
				
			mobile_top_search.addClass('animated-bgr').css({"width":mobile_top_bar_W - 140});
			
			$('.top-bar.mobile .menu-overlay.active').animate({"height":menu_overlay_H},300);
		}
    }).trigger('resize');
});