<div class="thim-link-login">
	<?php if ( is_user_logged_in() ): ?>
		<?php if ( thim_plugin_active( 'learnpress' ) ) : ?>
			<a class="profile" href="<?php echo esc_url( learn_press_user_profile_link( get_current_user_id() ) ); ?>"><?php esc_html_e( 'Profile', 'elearningwp' ); ?></a>
		<?php endif; ?>
		<a class="logout" href="<?php echo wp_logout_url( home_url() ); ?>"><?php echo esc_html( $instance['text_logout'] ); ?></a>
	<?php else : ?>
		<?php
		$registration_enabled = get_option( 'users_can_register' );
		if ( $registration_enabled ) :
			?>
			<a class="register" href="<?php echo esc_url( thim_get_register_url() ); ?>"><?php echo esc_html( $instance['text_register'] ); ?></a>
		<?php endif; ?>
		<a class="login" href="<?php echo esc_url( thim_get_login_page_url() ); ?>"><?php echo esc_html( $instance['text_login'] ); ?></a>
	<?php endif; ?>
</div>