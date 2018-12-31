<?php

class Thim_Login_Form_Widget extends Thim_Widget {

	function __construct() {
		parent::__construct(
			'login-form',
			esc_html__( 'Thim: Login Form', 'elearningwp' ),
			array(
				'description'   => esc_html__( 'Add login form', 'elearningwp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon'   => 'dashicons dashicons-welcome-learn-more thim_widgets_form_login'
			),
			array(),
			array(
				'captcha' => array(
					'type'        => 'radio',
					'label'       => esc_html__( 'Captcha', 'elearningwp' ),
					'description' => esc_html__( 'Use captcha in register form', 'elearningwp' ),
					'default'     => 'no',
					'options'     => array(
						'no'  => esc_html__( 'No', 'elearningwp' ),
						'yes' => esc_html__( 'Yes', 'elearningwp' ),
					)
				),
			),
			THIM_DIR . 'inc/widgets/login-form/'
		);
	}

	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}

}

function thim_login_form_widget() {
	register_widget( 'Thim_Login_Form_Widget' );
}

add_action( 'widgets_init', 'thim_login_form_widget' );