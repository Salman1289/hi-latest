<?php
class Collapse_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'collapse',
			__( 'Thim: Collapse', 'elearningwp' ),
			array(
				'description' => __( 'Add Collapse', 'elearningwp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon' => 'dashicons dashicons-welcome-learn-more',
			),
			array(),
			array(
				'collapse' => array(
					'type'      => 'repeater',
					'label'     => __( 'Collapse', 'elearningwp' ),
					'item_name' => __( 'Collapse', 'elearningwp' ),
					'fields'    => array(
						'title'   => array(
							"type"    => "text",
							"label"   => __( "Collapse Title", "elearningwp" ),
							"default" => "Collapse Title",
						),
						'content' => array(
							"type"  => "textarea",
							"label" => __( "Content", "elearningwp" ),
						),
					),
				),
			),
			THIM_DIR . 'inc/widgets/collapse/'
		);
	}
	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}
}
function thim_collapse_register_widget() {
	register_widget( 'Collapse_Widget' );
}

add_action( 'widgets_init', 'thim_collapse_register_widget' );