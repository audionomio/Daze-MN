<?php
/* ==============================================
	CUSTOM FIELDS FOR USERS
	Daze - Premium WordPress Theme, by NordWood
================================================= */
	if ( ! function_exists( 'daze_add_user_profile_fields' ) ) :
		function daze_add_user_profile_fields( $user ) {
			$img_id = get_the_author_meta( 'daze_user_img', $user->ID );
	?>
		<table class="form-table">
			<tr>
				<th>
					<label for="daze_user_img"><?php esc_html_e( 'User image', 'daze' ); ?></label>
				</th>
				 
				<td>
					<div class="img-upload-wrapper clearfix">
						<div class="img-preview"><?php
							if ( '' !== $img_id ) :
								echo wp_get_attachment_image( $img_id, 'thumbnail' );
							endif;
						?></div>
						
						<input type="hidden" class="img-id"
							name="daze_user_img"
							id="daze_user_img"						
							value="<?php echo esc_attr( get_the_author_meta( 'daze_user_img', $user->ID ) ); ?>"
						>				
						
						<input type="button" class="button upload-img <?php if ( '' !== $img_id ) { echo 'hidden'; } ?>"
							name="daze_user_img_upload"
							id="daze_user_img_upload"
							value="<?php esc_attr_e( 'Upload image', 'daze' ); ?>"
						>
						
						<input type="button" class="button remove-img <?php if ( '' === $img_id ) { echo 'hidden'; } ?>"
							name="daze_user_img_remove"
							id="daze_user_img_remove"
							value="<?php esc_attr_e( 'Remove image', 'daze' ); ?>"
						>
						
						<p class="description"><?php esc_html_e( 'If no image is uploaded, gravatar will be used.', 'daze' ); ?></p>
					</div>
					<br>
					<label for="daze_show_avatar_in_archive">
						<input name="daze_show_avatar_in_archive" type="checkbox" id="daze_show_avatar_in_archive" value="show" <?php checked( get_the_author_meta( 'daze_show_avatar_in_archive', $user->ID ), "show" ); ?> />
						<?php esc_html_e( 'Show user image in author\'s archive header', 'daze' ); ?>
					</label>
					<br>
					<label for="daze_show_avatar_everywhere">
						<input name="daze_show_avatar_everywhere" type="checkbox" id="daze_show_avatar_everywhere" value="show" <?php checked( get_the_author_meta( 'daze_show_avatar_everywhere', $user->ID ), "show" ); ?> />
						<?php esc_html_e( 'Show user image near author\'s name on blog and single posts', 'daze' ); ?>
					</label>
				</td>
			</tr>
		</table>
	<?php
		}
	endif;	
	
	add_action( 'show_user_profile', 'daze_add_user_profile_fields', 10, 1 );
	add_action( 'edit_user_profile', 'daze_add_user_profile_fields', 10, 1 );
	
/* Save custom fields to users */
	if ( ! function_exists( 'daze_update_user_profile_fields' ) ) :
		function daze_update_user_profile_fields( $user_id ) {
			if ( current_user_can( 'edit_user', $user_id ) ) {
				update_user_meta( $user_id, 'daze_user_img', $_POST['daze_user_img'] );
				update_user_meta( $user_id, 'daze_show_avatar_in_archive', empty( $_POST['daze_show_avatar_in_archive'] ) ? 0 : "show" );
				update_user_meta( $user_id, 'daze_show_avatar_everywhere', empty( $_POST['daze_show_avatar_everywhere'] ) ? 0 : "show" );
			}
		}
	endif;
	
	add_action( 'edit_user_profile_update', 'daze_update_user_profile_fields' );
	add_action( 'personal_options_update', 'daze_update_user_profile_fields' );
		
/* Enqueue scripts for User screens */
	add_action( 'admin_enqueue_scripts', 'daze_users_scripts' );
	
	if ( ! function_exists( 'daze_users_scripts' ) ):
		function daze_users_scripts( $hook ) {
			if ( 'user-new.php' != $hook && 'user-edit.php' != $hook && 'profile.php' != $hook ) {
				return;
			}
			
			wp_enqueue_media();
			wp_enqueue_script( 'daze_img_upload' );
		}
	endif;
?>