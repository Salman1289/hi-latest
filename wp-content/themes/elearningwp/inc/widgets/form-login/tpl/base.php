<?php
if ( ! is_user_logged_in() ) {
	echo '<a class="register_link" href="' . esc_url( thim_get_register_url() ) . '">' . esc_html__( 'Register', 'elearningwp' ) . '</a>';
	echo '<div class="thim-link-login btn btn-primary"><a href="' . esc_url( thim_get_login_page_url() ) . '">' . $instance['text_login'] . '</a></div>';
} else {
	?>
	<?php if ( thim_plugin_active( 'learnpress' ) ) : ?>
		<a class="profile" href="<?php echo esc_url( learn_press_user_profile_link( get_current_user_id() ) ); ?>"><?php esc_html_e( 'Profile', 'elearningwp' ); ?></a>
	<?php endif; ?>
	<?php
	echo '<div class="btn btn-primary"><a href="' . wp_logout_url( get_home_url() ) . '">' . $instance['text_logout'] . '</a></div>';
}