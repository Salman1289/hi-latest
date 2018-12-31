<?php
/**
 * Widget Name: Button.
 * Author: ThimPress.
 */
class Button_Widget extends Thim_Widget {

	function __construct() {
		parent::__construct(
			'button',
			__( 'Thim: Button', 'elearningwp' ),
			array(
				'description' => __( 'Add Button', 'elearningwp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon' => 'dashicons dashicons-welcome-learn-more thim_widgets_button'
			),
			array(),
			array(
				'title'     => array(
					"type"    => "text",
					"default" => "READ MORE",
					"label"   => __( "Button Text", "elearningwp" ),
				),
				'url'     => array(
					"type"    => "text",
					"default" => "#",
					"label"   => __( "Destination URL", "elearningwp" ),
				),
				'new_window'     => array(
					"type"    => "checkbox",
					"default" => false,
					"label"   => __( "Open in New Window", "elearningwp" ),
				),
				'icon' => array(
					'type'   => 'section',
					'label'  => __( 'Icon', 'elearningwp' ),
					'hide'   => true,
					'fields' => array(
						'icon'      => array(
							"type"        => "icon",
							"class"       => "",
							"label"       => __( "Select Icon:", "elearningwp" ),
							"description" => __( "Select the icon from the list.", "elearningwp" ),
							"class_name"  => 'font-awesome',
						),
						// Resize the icon
						'icon_size' => array(
							"type"        => "number",
							"class"       => "",
							"label"       => __( "Icon Size ", "elearningwp" ),
							"suffix"      => "px",
							"default"     => "14",
							"description" => __( "Select the icon font size.", "elearningwp" ),
							"class_name"  => 'font-awesome'
						),
					),
				),
				'layout'        => array(
					'type'   => 'section',
					'label'  => __( 'Layout', 'elearningwp' ),
					'hide'   => true,
					'fields' => array(
						'button_size'          => array(
							"type"        => "select",
							"class"       => "",
							"label"       => __( "Button Size", "elearningwp" ),
							"options"     => array(
								"normal" => "Normal",
								"medium"       => "Medium",
								"large"       => "Large",
							),
						),
						'rounding'          => array(
							"type"        => "select",
							"class"       => "",
							"label"       => __( "Rounding", "elearningwp" ),
							"options"     => array(
								"" => "None",
								"very-rounded"       => "Very Rounded",
							),
						),
					)
				),

			),
			THIM_DIR . 'inc/widgets/icon-box/'
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
function thim_button_register_widget() {
	register_widget( 'Button_Widget' );
}

add_action( 'widgets_init', 'thim_button_register_widget' );