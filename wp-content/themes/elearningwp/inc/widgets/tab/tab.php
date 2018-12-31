<?php
class Tab_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'tab',
			__( 'Thim: Tab', 'elearningwp' ),
			array(
				'description' => __( 'Add tab', 'elearningwp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon' => 'dashicons dashicons-welcome-learn-more thim_widgets_tab'
			),
			array(),
			array(
				'tab' => array(
					'type'      => 'repeater',
					'label'     => __( 'Tab', 'elearningwp' ),
					'item_name' => __( 'Tab', 'elearningwp' ),
					'fields'    => array(
						'title'   => array(
							"type"    => "text",
							"label"   => __( "Tab Title", "elearningwp" ),
							"default" => "Tab Title",
						),
						'content' => array(
							"type"  => "textarea",
							"label" => __( "Content", "elearningwp" ),
							"allow_html_formatting"=>true
						),
					),
				),
			),
			THIM_DIR . 'inc/widgets/tab/'
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
function thim_tab_register_widget() {
	register_widget( 'Tab_Widget' );
}

add_action( 'widgets_init', 'thim_tab_register_widget' );