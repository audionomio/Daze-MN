jQuery(function($){
	"use strict";
	
// Control social profiles
	$( '.daze-social-profiles-controls' ).each( function() {
		var socialsCtrl		= $(this),
			iconsList		= $(this).find('.daze-social-profiles-icon'),
			overlay			= $(this).find('.daze-social-profiles-popout'),
			profile			= overlay.find('label'),
			profileField	= $(this).find('.daze-social-profiles-active'),
			socialsCombined	= $(this).find('.daze-social-profiles-combined'),
			profilesBU		= $(this).find('.daze-social-profiles-bu').val(),
			activeNetwork,
			networkName,
			newSocials,
			icon;
		
	// Get saved profiles from old Daze version
		socialsCtrl.on( 'click', '.daze-social-profiles-get-bu', function(e) {
			if( '' !== profilesBU ) {
				var splitProfilesBU = profilesBU.split('-network-');
				splitProfilesBU.shift();
				
				$.each( splitProfilesBU, function(k, v) {
					var pairBU = v.split('-link-');
					
					networkName = pairBU[0];
					
					socialsCtrl.find( '.daze-social-profiles-icon[data-network-name="' + networkName + '"]' ).attr( 'data-profile-url', pairBU[1] ).attr( 'data-has-profile', 'active' );
					
					update_socialsCombined();
				});
			}
		});
		
		socialsCtrl.on( 'click', '.daze-social-profiles-icon', function(e) {			
		// Prepare popout for chosen network	
			activeNetwork = $(e.target).closest( '.daze-social-profiles-icon' );				
			networkName = activeNetwork.attr( 'data-network-name' );				
			profile.text( networkName + 'profile URL:' );
			profileField.val( '' );
			
			if( activeNetwork.attr( 'data-profile-url' ) ) {
				profileField.val( activeNetwork.attr( 'data-profile-url' ) );					
			}
			
			profile.text( networkName + ' profile URL:' );
			
		// Open popout
			overlay.fadeIn(200);
			profileField.focus();

		// Update data value on change
			overlay.on( 'keyup', '.daze-social-profiles-active', function() {
				activeNetwork.attr( "data-profile-url", profileField.val() );
				
				update_socialsCombined();
			});				
		});

		function update_socialsCombined() {
			newSocials = '';
			
			iconsList.each( function() {
				icon = $(this);
				
				if( icon.attr( 'data-profile-url' ) ) {
					icon.attr( 'data-has-profile', 'active' );
					newSocials += '-network-' + icon.attr( 'data-network-name' ) + '-link-' + icon.attr( 'data-profile-url' );
				
				} else {
					icon.attr( 'data-has-profile', '' );
				}
			});
			
			socialsCombined.val( newSocials );
			socialsCombined.change();
		}
		
	// Close when close button is clicked
		overlay.on( 'click', '.daze-close-button', function(e) {
			overlay.fadeOut(100);
		});
		
	// Close on click outside the popout	
		$(document).on( 'click', function(e) {
			if( $(e.target).closest( $('.daze-social-profiles-icon') ).length === 0 && $(e.target).closest( $('.daze-social-profiles-popout') ).length === 0 ) {
				overlay.fadeOut(100);
			}
		});
		
	// Close on hitting the "Enter" key
		$(document).keypress(function(e) {
			if( e.keyCode == 10 || e.keyCode == 13 ) {
				e.preventDefault();
				overlay.fadeOut(100);
			}
		});	
	});
	
// Control sharing links
	$( '.daze-sharing-links-controls' ).each( function() {
		var socialsCtrl		= $(this),
			iconsList		= $(this).find('.daze-sharing-links-icon'),
			socialsCombined	= $(this).find('.daze-sharing-links-combined'),
			activeNetwork,
			newSocials,
			icon;
		
		socialsCtrl.on( 'click', '.daze-sharing-links-icon', function(e) {			
		// Prepare popout for chosen network	
			icon = $( this );
				
			if ( 'on' === icon.attr( 'data-is-active' ) ) {
				icon.attr( 'data-is-active', 'off' );
				
			} else if ( 'off' === icon.attr( 'data-is-active' ) ) {
				icon.attr( 'data-is-active', 'on' );
			}

					
		// Update data value on change
			updateSharingButtons();
		});

		function updateSharingButtons() {
			newSocials = '';
			
			iconsList.each( function() {
				icon = $(this);
				
				if ( 'on' === icon.attr( 'data-is-active' ) ) {
					newSocials += '-network-' + icon.attr( 'data-network-name' );				
				}
			});
			
			socialsCombined.val( newSocials );
			socialsCombined.change();
		}
	});
});