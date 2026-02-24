/* ==============================================
	Share selection scripts
	Daze - Premium WordPress Theme, by NordWood
================================================= */
jQuery(document).ready(function($) {
	"use strict";

	var share_cloud_text = shareselection.cloudtext;
	var iconTwitter = shareselection.icon_twitter;
		
	function getRightClick(e) {
		var rightclick;
		
		if (!e) var e = window.event;
		
		if (e.which) {
			rightclick = (e.which == 3);
			
		} else if (e.button) {
			rightclick = (e.button == 2);
		}
		
		return rightclick;
	}

	function getSelectionText() {
	    var text = "";
		
	    if (window.getSelection) {
	        text = window.getSelection().toString();
			
	    } else if ( document.selection && document.selection.type != "Control" ) {
	        text = document.selection.createRange().text;
	    }
		
	    return text;
	}
	
	$.fn.close_share_cloud = function() {
		$(this).mousedown( function (event) {
			$('body').attr( 'mouse-top', event.clientY+window.pageYOffset );
			$('body').attr( 'mouse-left', event.clientX );

			if(!getRightClick(event) && getSelectionText().length > 0) {
				$('.share-cloud').remove();
				document.getSelection().removeAllRanges();
			}
		});
	}
	
	$.fn.open_share_cloud = function() {
		$(this).mouseup( function (event) {
			var t = $(event.target),
				st = getSelectionText();

			if( st.length > 3 && !getRightClick(event) ) {
				var mts = $('body').attr( 'mouse-top' ),
					mte = event.clientY+window.pageYOffset,
					mt;
				
				if( parseInt(mts) < parseInt(mte) ) {
					mt = mts;
					
				} else {
					mt = mte;
				}

				var mlp = $('body').attr( 'mouse-left' ),
					mrp = event.clientX,
					ml = parseInt(mlp)+(parseInt(mrp)-parseInt(mlp))/2,
					sl = window.location.href.split('?')[0],
					maxl = 107;
				st = st.substring(0,maxl);
				
				var share_cloud = '<span class="share-cloud">';
					share_cloud += '<a class="social-twitter bw" href="https://twitter.com/intent/tweet?url=' + encodeURIComponent(sl) + '&text=' + encodeURIComponent(st) + '" target="_blank"';
					share_cloud += ' onclick="window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;">';
					share_cloud += '<span class="share-text">' + share_cloud_text + '</span>';
					share_cloud += iconTwitter;
					share_cloud += '</a>';
					share_cloud += '</span>';
				
				$('body').append(share_cloud);			
				
				$('.share-cloud').css({
					position: 'absolute',
					top: parseInt(mt)-60,
					left: parseInt(ml)
					
				}).delay(10).queue(function(){
					$(this).addClass("reveal").dequeue();
				});
			}
		});
	}
	
	$('.shareable-selections').open_share_cloud();
	
	$('.shareable-selections').close_share_cloud();
	
  
	// remove the share cloud on esc
	$(document).keyup(function(e) {
		if (e.keyCode === 27) {
			$('.share-cloud').remove();
		}
	});
});