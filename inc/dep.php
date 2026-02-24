<?php
/* ===============================================
	Deprecated functions
	Daze - Premium WordPress Theme, by NordWood
================================================== */	
/* 9.2 Get social profiles (deprecated, since Daze 2.2) */
	if( !function_exists( 'daze_get_social_profiles' ) ) :
		function daze_get_social_profiles( $show_heading=false, $show_titles=false ) {			
			$social_heading = esc_html( get_theme_mod( 'daze_social_heading' ) );			
			$social_profiles_links = '';
		
		// Heading
			if( $show_heading && $social_heading && !is_rtl() ) {
				$social_profiles_links = $social_heading;
			}
			
		// Links
			if( get_theme_mod( 'daze_social_facebook', true ) && get_theme_mod( 'daze_facebook_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Facebook">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_facebook_profile' ) ),
					daze_get_svg_facebook(),
					( true === $show_titles ) ? '<span class="social-title">Facebook</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_twitter', true ) && get_theme_mod( 'daze_twitter_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Twitter">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_twitter_profile' ) ),
					daze_get_svg_twitter(),
					( true === $show_titles ) ? '<span class="social-title">Twitter</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_pinterest', true ) && get_theme_mod( 'daze_pinterest_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Pinterest">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_pinterest_profile' ) ),
					daze_get_svg_pinterest(),
					( true === $show_titles ) ? '<span class="social-title">Pinterest</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_instagram', true ) && get_theme_mod( 'daze_instagram_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Instagram">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_instagram_profile' ) ),
					daze_get_svg_instagram(),
					( true === $show_titles ) ? '<span class="social-title">Instagram</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_gplus', true ) && get_theme_mod( 'daze_gplus_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="GooglePlus">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_gplus_profile' ) ),
					daze_get_svg_googleplus(),
					( true === $show_titles ) ? '<span class="social-title">GooglePlus</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_500px' ) && get_theme_mod( 'daze_500px_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="500px">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_500px_profile' ) ),
					daze_get_svg_500px(),
					( true === $show_titles ) ? '<span class="social-title">500px</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_behance' ) && get_theme_mod( 'daze_behance_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Behance">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_behance_profile' ) ),
					daze_get_svg_behance(),
					( true === $show_titles ) ? '<span class="social-title">Behance</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_blogger' ) && get_theme_mod( 'daze_blogger_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Blogger">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_blogger_profile' ) ),
					daze_get_svg_blogger(),
					( true === $show_titles ) ? '<span class="social-title">Blogger</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_bloglovin' ) && get_theme_mod( 'daze_bloglovin_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="BlogLovin">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_bloglovin_profile' ) ),
					daze_get_svg_bloglovin(),
					( true === $show_titles ) ? '<span class="social-title">BlogLovin\'</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_dailymotion' ) && get_theme_mod( 'daze_dailymotion_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="DailyMotion">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_dailymotion_profile' ) ),
					daze_get_svg_dailymotion(),
					( true === $show_titles ) ? '<span class="social-title">DailyMotion</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_delicious' ) && get_theme_mod( 'daze_delicious_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Delicious">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_delicious_profile' ) ),
					daze_get_svg_delicious(),
					( true === $show_titles ) ? '<span class="social-title">Delicious</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_deviantart' ) && get_theme_mod( 'daze_deviantart_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="DeviantArt">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_deviantart_profile' ) ),
					daze_get_svg_deviantart(),
					( true === $show_titles ) ? '<span class="social-title">DeviantArt</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_digg' ) && get_theme_mod( 'daze_digg_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Digg">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_digg_profile' ) ),
					daze_get_svg_digg(),
					( true === $show_titles ) ? '<span class="social-title">Digg</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_dribbble' ) && get_theme_mod( 'daze_dribbble_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Dribbble">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_dribbble_profile' ) ),
					daze_get_svg_dribble(),
					( true === $show_titles ) ? '<span class="social-title">Dribbble</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_envato' ) && get_theme_mod( 'daze_envato_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Envato">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_envato_profile' ) ),
					daze_get_svg_envato(),
					( true === $show_titles ) ? '<span class="social-title">Envato</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_etsy' ) && get_theme_mod( 'daze_etsy_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Etsy">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_etsy_profile' ) ),
					daze_get_svg_etsy(),
					( true === $show_titles ) ? '<span class="social-title">Etsy</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_flickr' ) && get_theme_mod( 'daze_flickr_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Flickr">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_flickr_profile' ) ),
					daze_get_svg_flickr(),
					( true === $show_titles ) ? '<span class="social-title">Flickr</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_foursquare' ) && get_theme_mod( 'daze_foursquare_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="FourSquare">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_foursquare_profile' ) ),
					daze_get_svg_foursquare(),
					( true === $show_titles ) ? '<span class="social-title">FourSquare</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_github' ) && get_theme_mod( 'daze_github_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="GitHub">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_github_profile' ) ),
					daze_get_svg_github(),
					( true === $show_titles ) ? '<span class="social-title">GitHub</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_grooveshark' ) && get_theme_mod( 'daze_grooveshark_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="GrooveShark">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_grooveshark_profile' ) ),
					daze_get_svg_grooveshark(),
					( true === $show_titles ) ? '<span class="social-title">GrooveShark</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_hypem' ) && get_theme_mod( 'daze_hypem_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Hypem">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_hypem_profile' ) ),
					daze_get_svg_hypem(),
					( true === $show_titles ) ? '<span class="social-title">Hypem</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_kickstarter' ) && get_theme_mod( 'daze_kickstarter_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="KickStarter">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_kickstarter_profile' ) ),
					daze_get_svg_kickstarter(),
					( true === $show_titles ) ? '<span class="social-title">KickStarter</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_lastfm' ) && get_theme_mod( 'daze_lastfm_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Last.fm">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_lastfm_profile' ) ),
					daze_get_svg_lastfm(),
					( true === $show_titles ) ? '<span class="social-title">Last.fm</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_linkedin' ) && get_theme_mod( 'daze_linkedin_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="LinkedIn">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_linkedin_profile' ) ),
					daze_get_svg_linkedin(),
					( true === $show_titles ) ? '<span class="social-title">LinkedIn</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_medium' ) && get_theme_mod( 'daze_medium_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Medium">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_medium_profile' ) ),
					daze_get_svg_medium(),
					( true === $show_titles ) ? '<span class="social-title">Medium</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_mixcloud' ) && get_theme_mod( 'daze_mixcloud_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Mixcloud">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_mixcloud_profile' ) ),
					daze_get_svg_mixcloud(),
					( true === $show_titles ) ? '<span class="social-title">Mixcloud</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_myspace' ) && get_theme_mod( 'daze_myspace_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="MySpace">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_myspace_profile' ) ),
					daze_get_svg_myspace(),
					( true === $show_titles ) ? '<span class="social-title">MySpace</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_reddit' ) && get_theme_mod( 'daze_reddit_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Reddit">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_reddit_profile' ) ),
					daze_get_svg_reddit(),
					( true === $show_titles ) ? '<span class="social-title">Reddit</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_scribd' ) && get_theme_mod( 'daze_scribd_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Scribd">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_scribd_profile' ) ),
					daze_get_svg_scribd(),
					( true === $show_titles ) ? '<span class="social-title">Scribd</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_snapchat' ) && get_theme_mod( 'daze_snapchat_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="SnapChat">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_snapchat_profile' ) ),
					daze_get_svg_snapchat(),
					( true === $show_titles ) ? '<span class="social-title">SnapChat</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_soundcloud' ) && get_theme_mod( 'daze_soundcloud_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="SoundCloud">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_soundcloud_profile' ) ),
					daze_get_svg_soundcloud(),
					( true === $show_titles ) ? '<span class="social-title">SoundCloud</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_spotify' ) && get_theme_mod( 'daze_spotify_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Spotify">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_spotify_profile' ) ),
					daze_get_svg_spotify(),
					( true === $show_titles ) ? '<span class="social-title">Spotify</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_steam' ) && get_theme_mod( 'daze_steam_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Steam">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_steam_profile' ) ),
					daze_get_svg_steam(),
					( true === $show_titles ) ? '<span class="social-title">Steam</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_stumbleupon' ) && get_theme_mod( 'daze_stumbleupon_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="StumbleUpon">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_stumbleupon_profile' ) ),
					daze_get_svg_stumbleupon(),
					( true === $show_titles ) ? '<span class="social-title">StumbleUpon</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_tripadvisor' ) && get_theme_mod( 'daze_tripadvisor_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="TripAdvisor">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_tripadvisor_profile' ) ),
					daze_get_svg_tripadvisor(),
					( true === $show_titles ) ? '<span class="social-title">TripAdvisor</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_tumblr' ) && get_theme_mod( 'daze_tumblr_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Tumblr">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_tumblr_profile' ) ),
					daze_get_svg_tumblr(),
					( true === $show_titles ) ? '<span class="social-title">Tumblr</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_twitch' ) && get_theme_mod( 'daze_twitch_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Twitch">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_twitch_profile' ) ),
					daze_get_svg_twitch(),
					( true === $show_titles ) ? '<span class="social-title">Twitch</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_vimeo' ) && get_theme_mod( 'daze_vimeo_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Vimeo">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_vimeo_profile' ) ),
					daze_get_svg_vimeo(),
					( true === $show_titles ) ? '<span class="social-title">Vimeo</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_vk' ) && get_theme_mod( 'daze_vk_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="VK">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_vk_profile' ) ),
					daze_get_svg_vk(),
					( true === $show_titles ) ? '<span class="social-title">VK</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_xing' ) && get_theme_mod( 'daze_xing_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="XING">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_xing_profile' ) ),
					daze_get_svg_xing(),
					( true === $show_titles ) ? '<span class="social-title">XING</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_yelp' ) && get_theme_mod( 'daze_yelp_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="Yelp">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_yelp_profile' ) ),
					daze_get_svg_yelp(),
					( true === $show_titles ) ? '<span class="social-title">Yelp</span>' : ''
				);
			}
			
			if( get_theme_mod( 'daze_social_youtube' ) && get_theme_mod( 'daze_youtube_profile' ) ) {
				$social_profiles_links .= sprintf(
					'<a class="bw" href="%1$s" target="_blank" title="YouTube">%2$s%3$s</a>',
					esc_url( get_theme_mod( 'daze_youtube_profile' ) ),
					daze_get_svg_youtube(),
					( true === $show_titles ) ? '<span class="social-title">YouTube</span>' : ''
				);
			}			
			
		// Heading (rtl)
			if( $show_heading && $social_heading && is_rtl() ) {
				$social_profiles_links .= $social_heading;
			} 
			
			return $social_profiles_links;
		}
	endif;
?>