jQuery( document ).ready( function($) {
	"use strict";
	
	var metabox = $('#daze_meta_boxes-daze-meta-boxes'),
		post_status = postinfo.status,
		post_type = postinfo.type,
		page_template = $('#daze_get_page_template').val(),
		metabox_pages = $('#daze_meta_boxes_pages-daze-meta-boxes-pages'),
		contact_fieldset = metabox_pages.find('.daze-pages-contact');
		
	if( 'page-templates/contact.php' === page_template ) {
		contact_fieldset.show(200, "swing");
	}
				
// Default settings for new posts and pages		
	if( post_status == "auto-draft" ) {
		$("#daze_drop_caps").prop('checked', false);
		$("#daze_enlarge_galleries").prop('checked', true);
		$("#daze_enlarge_media").prop('checked', true);
		
		contact_fieldset.hide(200, "swing");
		
		switch(post_type) {
			case "post":
				$("#daze_include_sidebar").prop('checked', true);
				$("#daze_posts_show_cat").prop('checked', true);
				$("#daze_posts_show_date").prop('checked', true);
				$("#daze_posts_show_comments_count").prop('checked', true);
				$("#daze_posts_show_author").prop('checked', false);
				$("#daze_posts_show_in_nwps").prop('checked', true);
				break;
			case "page":
				$("#daze_include_sidebar").prop('checked', false);
				$("#daze_pages_show_nwps").prop('checked', false);
				break;
			default:
		}
	}	
	
// Switch default settings for certain post formats
	$(document).on("change", "input:radio[name=post_format]", function() {
		switch($(this).val()) {	
			case "quote":
				$("#daze_posts_show_date").prop('checked', false);
				$("#daze_posts_show_comments_count").prop('checked', false);
				$("#daze_posts_show_author").prop('checked', false);
				break;		
			case "link":
				$("#daze_posts_show_date").prop('checked', false);
				$("#daze_posts_show_comments_count").prop('checked', false);
				$("#daze_posts_show_author").prop('checked', false);
				break;
			default:
				$("#daze_include_sidebar").prop('checked', true);
				$("#daze_posts_show_cat").prop('checked', true);
				$("#daze_posts_show_date").prop('checked', true);
				$("#daze_posts_show_comments_count").prop('checked', true);
				$("#daze_posts_show_author").prop('checked', false);
				$("#daze_posts_show_in_nwps").prop('checked', true);
		}		
	});

    $(document).on("change", "#page_template", function() {
		if( $(this).val() == 'page-templates/contact.php' ) {
			contact_fieldset.show(200, "swing");
			
		} else {
			contact_fieldset.hide(200, "swing");
		}
    }).change();
});