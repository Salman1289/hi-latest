<?php

class Thim_Login_Menu_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'login-menu',
			esc_html__( 'Thim: Login Menu', 'elearningwp' ),
			array(
				'description'   => esc_html__( 'Display Login Menu', 'elearningwp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon' => 'dashicons dashicons-welcome-learn-more'
			),
			array(),
			array(
				'text_login'  => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Text Login', 'elearningwp' ),
					'default' => esc_html__('Login', 'elearningwp'),
				),
				'text_register' => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Text for Register', 'elearningwp' ),
					'default' => esc_html__('Register', 'elearningwp'),
				),
				'text_logout' => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Text Logout', 'elearningwp' ),
					'default' => esc_html__('Logout', 'elearningwp'),
				)
			),
			THIM_DIR . 'inc/widgets/login-menu/'
		);
	}


	/**
	 * Initialize the CTA widget
	 */


	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}

}
function thim_login_menu_register_widget() {
	register_widget( 'Thim_Login_Menu_Widget' );
	
}

add_action( 'widgets_init', 'thim_login_menu_register_widget' );

