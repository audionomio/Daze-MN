/* ==============================================
	Scripts for infinite scroll on posts list
	Daze - Premium WordPress Theme, by NordWood
================================================= */
jQuery( document ).ready( function($) {
	"use strict";
	
	var layout = infinite.blog_layout_type,
		total_pages = infinite.max_pages,
		gallPrev = infinite.icon_prev,
		gallNext = infinite.icon_next,
		shareable_selection = ( infinite.share_selection ) ? true : false;
		
	var widget_gall_ratio = 3/4;
		
	function item_resize() {
	   $('.masonry-item .cover-item').each(function() {
			var featured_area = $(this).find('.featured-area');
			
			if( !featured_area.is(':empty') ) {
				var item_h = $(this).find('.post-header').height(),
					item_w = $(this).width(),
					featured_img = $(this).find('.featured-img img');
				
				if( window.innerWidth > 1279 ) {						
					$(this).css({ "height": ( featured_img.height()*item_w/featured_img.width() ) });
					
					if( featured_img.height() < $(this).height() ) {
						featured_img.css({"height":"100%","width":"auto"});
					}					
					
					if( featured_img.width() > featured_area.width() ) {
						var pull = -( featured_img.width() - featured_area.width() )/2;
						featured_img.css({ "margin-left":pull });						
					}
					
				} else {
					$(this).css({ "height": "auto" });
					featured_img.css({"width":"100%","height":"auto"});
				}
			}
		});
	}
	
// Masonry layout
	if( 'masonry' === layout || 'masonry-mini' === layout || 'tiny' === layout ) {
	// Adjust the image size on "cover" items
		item_resize();
		
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
			stamp: '.stamp',
			percentPosition: true,
			originLeft: $('body').hasClass( 'rtl' ) ? false : true
		});

		$container.masonry( 'once', 'layoutComplete', function(items) {
			var elems = $container.masonry('getItemElements');
			
			$(elems).css({"visibility":"hidden"});
			
			if( true === anim_bgr_off ) {
				$(elems).css({"visibility":"visible"}).find('.masonry-content').css({"opacity":1});				
				
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

		list_container.imagesLoaded(function(){
			$container.masonry();	
		});
		
		if( total_pages > 1 ) {
			list_container.infinitescroll({
				navSelector: '.page-numbers',
				nextSelector: '.page-numbers a',
				itemSelector: '.masonry-item-wrapper',
				loading: {
						finishedMsg: '',
						selector: '.loading',		
						msgText: ''
					},		
				maxPage: total_pages
				},
				
				function( get_new_items, opts ) {
					if ( opts.state.currPage == total_pages ) {
						$('.loader').hide();
					}
						
					var new_items = $( get_new_items ).css({ "visibility":"hidden" });
					
					new_items.imagesLoaded( list_container, function(){
						new_items.each(function() {
							if ( $(this).find('.masonry-item .cover-item').length > 0 ) {					
								item_resize();					
							}
							
							if ( $(this).find('iframe').length > 0 ) {
								var iframe = $(this).find("iframe"),
									iframeSRC = iframe.attr("src");
								
								if( $(this).hasClass("enlarge-media") ) {
									iframe.each(function(){
										if ( iframeSRC.indexOf("vine.co") >= 0 ) {
											iframe.attr({"width":content_w}).css({"margin-left":0});
											
										} else {
											iframe.attr({"width":main_w});
										}									
									});
								}	
								
								$( ".main-holder" ).find("iframe").each( function() {
									$(this).iframe_size();
								} );							
							}
							
							if ( $(this).find( '.gallery-slider' ).length > 0 ) {
								var gall = $(this).find( '.gallery-slider' );
		
								gall.slick({
									autoplay: false,
									lazyLoad: 'ondemand',
									dots: true,
									dotsClass: 'slick-dots clearfix',
									arrows: true,
									prevArrow: '<span class="slick-prev slick-arrow arrow va-middle">'+gallPrev+'</span>',
									nextArrow: '<span class="slick-next slick-arrow arrow va-middle">'+gallNext+'</span>',
									customPaging : function(slider, i) {
										var thumb = $(slider.$slides[i]).data('thumb'); 
										return '<a><img src="'+thumb+'"></a>';
									}
								});
								
								gall.find(".slick-track").css({ "height":gall.width()*widget_gall_ratio });
							}
							
							if( $(this).find('.top-posts-slider').length > 0 ) {
								$(this).find('.top-posts-slider').slick({
									autoplay: false,
									autoplaySpeed: 6000,
									lazyLoad: 'ondemand',
									appendDots: $(this).find('.top-posts-slider').siblings('.nav-container'),
									dots: true,
									arrows: false,
									customPaging : function(slider, i) {
										var thumb = $( slider.$slides[i] ).data( 'thumb' );
										return '<h3>'+thumb+'</h3>';
									}
								});
							}
							
							if( 0 < $(this).find( '.insta-grid' ).length ) {
								$(this).find( '.insta-grid' ).each( function(i, el) {
									var item = $( el ).find('.item'),
										item_h = item.width();
										
									item.height(item_h);
								} );
							}
							
							if( 0 < $(this).find( '.social' ).length ) {
								$(this).find( '.social' ).each( function(i, el) {
									var item = $( el );
									
									$( el ).on( 'mouseenter', 'a', function() {
										var icon = $(this),
											path = icon.find('path');
										
										if( path.length < 1 ) {
											path = icon.find('polygon');
										}
										
										icon.removeClass('bw').css({ "color":path.attr('fill') });
										
									}).on( 'mouseleave', 'a', function(){
										$(this).addClass('bw').css({ "color":"inherit" });
									});									
								} );
							}
						});
						
						$container.masonry( 'on', 'layoutComplete', function(new_items) {
							var elems = new_items;
							
							if( true === anim_bgr_off ) {
								$(elems).each( function() {
									var it = $(this)[0].element;
									
									$(it).css({"visibility":"visible"}).find('.masonry-content').css({"opacity":1});
								});
								
							} else {
								var i = 0;
								
								var timing = setInterval(
									function() {
										if( i > elems.length-1 ) {
											clearInterval(timing);
											
										} else {
											$(elems[i].element).css({"visibility":"visible"});
							
											$(elems[i].element).find('.drop-overlay').addClass('animate');
										
											$(elems[i].element).find('.masonry-content').delay(800).queue(
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
							
						list_container.imagesLoaded(function(){
							$container.masonry('appended', new_items, true);
							
							$('.post-content li').wrapInner('<span></span>');
							
							if( shareable_selection ) {
								$('.shareable-selections').open_share_cloud();
								$('.shareable-selections').close_share_cloud();
							}
						});
					});
				}
			);
			
		} else {
			$('.loader').hide();
		}
		
		$(window).on('resize', function() {
			item_resize();		
		}).trigger('resize');		
	}
	
// Standard layout
	else if( layout === 'standard-list' ) {
		
		var list_container = $('#main .standard-list'),
			main_w = $('#main').width(),
			content_w = $('#main .post-content').width(),		
			footer_h = $('#site-footer').outerHeight(),
			central_wrapper = $('#central-wrapper');
		
		if( total_pages > 1 ) {
			list_container.infinitescroll({
				navSelector: '.page-numbers',
				nextSelector: '.page-numbers a',
				itemSelector: 'article.post',
				loading: {
						finishedMsg: '',
						selector: '.loading',		
						msgText: ''
					},
				maxPage: total_pages
				},

				function( get_new_items, opts ) {
					if( opts.state.currPage == total_pages ) {
						$('.loader').hide();
					}
					
					var new_items = $( get_new_items ).css({ "visibility":"hidden" });
					
					new_items.imagesLoaded( list_container, function(){
						new_items.each(function() {							
						// Embedded media
							if( $(this).find('iframe').length > 0 ) {
								
								var iframe = $(this).find("iframe"),
									iframeSRC = iframe.attr("src");
								
								if( $(this).hasClass("enlarge-media") ) {
									iframe.each(function(){
										if ( iframeSRC.indexOf("vine.co") >= 0 ) {
											iframe.attr({"width":content_w}).css({"margin-left":0});
											
										} else {
											iframe.attr({"width":main_w});
										}									
									});
								}								
																
								$( ".main-holder" ).find("iframe").each( function() {
									$(this).iframe_size();
								} );
							}							
							
						// Enlarged images				
							$(this).find("#main img.size-daze_wrapper_width").each(function(){
								$(this).css({"width":main_w}).addClass("reveal");
								
								if ( $(this).parents("figure").length == 1 ) { 
									$(this).parent("figure").addClass("size-daze_wrapper_width").css({"width":main_w});
								}
							});
									
							if( $(this).hasClass('enlarge-galleries') ) {
								$(this).find('.post-content .gallery-slider').css({ "width":main_w }).addClass("reveal");
							}
							
						// Gallery slider
							
							if ( $(this).find( '.gallery-slider' ).length > 0 ) {
								var gall = $(this).find( '.gallery-slider' );
		
								gall.slick({
									autoplay: false,
									lazyLoad: 'ondemand',
									dots: true,
									dotsClass: 'slick-dots clearfix',
									arrows: true,
									prevArrow: '<span class="slick-prev slick-arrow arrow va-middle">'+gallPrev+'</span>',
									nextArrow: '<span class="slick-next slick-arrow arrow va-middle">'+gallNext+'</span>',
									customPaging : function(slider, i) {
										var thumb = $(slider.$slides[i]).data('thumb'); 
										return '<a><img src="'+thumb+'"></a>';
									}
								});
							}
							
						// Enlarged galleries	
							$(this).find(".featured-area .gallery-slider").find(".slick-track").css({ "height":$(".featured-area .gallery-slider").width()*daze_gall_ratio });
							
							if( $(this).hasClass('enlarge-galleries') ) {
								$(this).find('.post-content .gallery-slider').find(".slick-track").css({ "height":main_w*daze_gall_ratio });
							}
							
							$(this).find(".gallery-slider").find(".slick-arrow").css({ "top":$(".gallery-slider").find(".slick-track").height()/2 });
						});
						
						$(new_items).css({ "visibility":"visible", "opacity": 1 });
							
						$('.post-content li').wrapInner('<span></span>');
						
						if( shareable_selection ) {
							$('.shareable-selections').open_share_cloud();
							$('.shareable-selections').close_share_cloud();
						}
					});			
				}
			);
			
		} else {
			$('.loader').hide();
		}
	}	
});