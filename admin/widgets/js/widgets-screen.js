/* ==============================================
	WIDGETS SCREEN SCRPITS
	Skin - Premium WordPress Theme, by NordWood
================================================= */	
jQuery( function($){
	"use strict";	
		
	var specials = [ "categories", "custom_html", "search'", "text", "daze_author_widget", "daze_img_widget", "daze_tagcloud_widget", "daze_insta_grid", "daze_top_posts", "daze_top_comments", "daze_social", "daze_popout_widget", "media_gallery"  ];
	
	$( '#widgets-left, #widgets-right' ).find( '.widget' ).each( function(i, el) {
		var widget = $(el),
			widgetID = widget.attr('id'),
			widgetBase = widget.find( 'input[name="id_base"]' ).attr( 'value' ),
			widgetTitle = widget.find( 'h3' );
		
		if ( -1 != $.inArray( widgetBase, specials ) ) {
			widget.addClass( 'daze-special' );
		}
		
		if ( widgetID.includes('daze') ) {
			widgetTitle.addClass( 'daze-widget' );			
			
			widgetTitle.html( function() {
				return $(this).html().replace( "Daze", "<span class='daze-mark'>Daze</span>"); 
			} );
		}
	});
	
	$( '#sidebar-specials' ).find( '.sidebar-name' ).find( 'h2' ).html( function() {
		return $(this).html().replace( $(this)[0].innerHTML.charAt(0), "<span class='daze-mark'>" + $(this)[0].innerHTML.charAt(0) + "</span>"); 
	} );

	var specDesc 		= areas.spec_desc,
		sbDesc 			= areas.sb_desc,
		sbListTitle		= areas.sb_list_title,
		sbListPreview	= areas.sb_list_preview,
		sbSingleTitle	= areas.sb_single_title,
		sbSinglePreview	= areas.sb_single_preview;
	
	var guide = '<div class="clearfix"></div>';
	
// Open Help wrapper
	guide += '<div class="daze-widgets-help clearfix">';
	
// Specials description
	guide += specDesc;
	
// Sidebars description
	guide += sbDesc;
	
// Sidebars previews
	guide += '<div class="positions"><h4>' + sbListTitle + '</h4><img src="' + sbListPreview + '" /></div>';
	guide += '<div class="positions"><h4>' + sbSingleTitle + '</h4><img src="' + sbSinglePreview + '" /></div>';
	
// Close Help wrapper
	guide += '</div>';
	
// Append the Help to Widgets screen
	$( '#widgets-right' ).append( guide );	
});