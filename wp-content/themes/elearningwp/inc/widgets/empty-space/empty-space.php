<?php
class Empty_Space_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'empty-space',
			__( 'Thim: Empty Space', 'elearningwp' ),
			array(
				'description' => __( 'Add space width custom height', 'elearningwp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon' => 'dashicons dashicons-welcome-learn-more'
			),
			array(),
			array(
				'height' => array(
					'type'  => 'number',
					'label' => __( 'Height', 'elearningwp' ),
					'default'=>'30',
					'desc'  => __( "Enter empty space height.", "elearningwp" ),
					'suffix'     => 'px',
				)
  			),
			THIM_DIR . 'inc/widgets/empty-space/'
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
function thim_empty_space_register_widget() {
	register_widget( 'Empty_Space_Widget' );
}

add_action( 'widgets_init', 'thim_empty_space_register_widget' );