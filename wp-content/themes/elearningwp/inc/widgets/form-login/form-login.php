<?php
require get_template_directory() . '/inc/widgets/form-login/lib/function-form.php';

class Thim_Form_Login_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'form-login',
			__( 'Thim: Form Login', 'elearningwp' ),
			array(
				'description'   => __( 'Login Form Popup', 'elearningwp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon' => 'dashicons dashicons-welcome-learn-more thim_widgets_form_login'
			),
			array(),
			array(
				'text_login'  => array(
					'type'    => 'text',
					'label'   => __( 'Text before login', 'elearningwp' ),
					'default' => 'Login',
				),
				'text_logout' => array(
					'type'    => 'text',
					'label'   => __( 'Text after login', 'elearningwp' ),
					'default' => 'Logout',
				)
			),
			THIM_DIR . 'inc/widgets/form-login/'
		);
		add_action('wp_footer', array( $this, 'form_login' ) );
	}
	
	//function widget(){
		//thim_social_login_callback();
	//}
	
	function form_login(){
		///if( ! is_user_logged_in() && ! did_action( 'thim_form_login_loaded' ) ){
			thim_social_login_callback();
			do_action( 'thim_form_login_loaded', $this );
		//}
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

	function enqueue_frontend_scripts() {
		wp_enqueue_script( 'thim-form-login', THIM_URI . 'inc/widgets/form-login/js/form-login.js', array( 'jquery' ), '', true );
		thim_social_login_callback();
	}
}
function thim_form_login_register_widget() {
	register_widget( 'Thim_Form_Login_Widget' );
	
}

add_action( 'widgets_init', 'thim_form_login_register_widget' );

