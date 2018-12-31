<?php

/**
 * Class Instructor_Of_Month_Widget
 *
 * Widget Name: Instructor Of Month
 *
 * Author: Ken
 */
class Instructor_Of_Month_Widget extends Thim_Widget {

	function __construct() {
		parent::__construct(
			'instructor-of-month',
			__( 'Thim: Instructor Of Month', 'elearningwp' ),
			array(
				'description'   => __( 'Show instructor of month who created popular courses.', 'elearningwp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon'   => 'dashicons dashicons-welcome-learn-more thim_widgets_top_instructor'
			),
			array(),
			array(
				'heading_group' => array(
					'type'   => 'section',
					'label'  => __( 'Heading', 'elearningwp' ),
					'hide'   => true,
					'fields' => array(
						'title'               => array(
							'type'                  => 'text',
							'label'                 => __( 'Heading Text', 'elearningwp' ),
							'default'               => __( "Instructor of the month", "elearningwp" ),
							'allow_html_formatting' => true
						),
						'textcolor'           => array(
							'type'  => 'color',
							'label' => __( 'Text Heading color', 'elearningwp' ),
							"class" => "color-mini",
						),
						'size'                => array(
							"type"    => "select",
							"label"   => __( "Size Heading", "elearningwp" ),
							"default" => "h3",
							"options" => array(
								"h2" => __( "h2", "elearningwp" ),
								"h3" => __( "h3", "elearningwp" ),
								"h4" => __( "h4", "elearningwp" ),
								"h5" => __( "h5", "elearningwp" ),
								"h6" => __( "h6", "elearningwp" )
							),
							"class"   => "color-mini",
						),
						'font_heading'        => array(
							"type"          => "select",
							"label"         => __( "Font Heading", "elearningwp" ),
							"default"       => "default",
							"options"       => array(
								"default" => __( "Default", "elearningwp" ),
								"custom"  => __( "Custom", "elearningwp" )
							),
							"description"   => __( "Select Font heading.", "elearningwp" ),
							'state_emitter' => array(
								'callback' => 'select',
								'args'     => array( 'font_heading_type' )
							),
							"class"         => "color-mini",
						),
						'custom_font_heading' => array(
							'type'          => 'section',
							'label'         => __( 'Custom Font Heading', 'elearningwp' ),
							'hide'          => true,
							"class"         => "clear-both",
							'state_handler' => array(
								'font_heading_type[custom]'  => array( 'show' ),
								'font_heading_type[default]' => array( 'hide' ),
							),
							'fields'        => array(
								'custom_font_size'   => array(
									"type"        => "number",
									"label"       => __( "Font Size", "elearningwp" ),
									"suffix"      => "px",
									"default"     => "18",
									"description" => __( "custom font size", "elearningwp" ),
									"class"       => "color-mini",
								),
								'custom_font_weight' => array(
									"type"        => "select",
									"label"       => __( "Custom Font Weight", "elearningwp" ),
									"options"     => array(
										"normal" => __( "Normal", "elearningwp" ),
										"bold"   => __( "Bold", "elearningwp" ),
										"100"    => __( "100", "elearningwp" ),
										"200"    => __( "200", "elearningwp" ),
										"300"    => __( "300", "elearningwp" ),
										"400"    => __( "400", "elearningwp" ),
										"500"    => __( "500", "elearningwp" ),
										"600"    => __( "600", "elearningwp" ),
										"700"    => __( "700", "elearningwp" ),
										"800"    => __( "800", "elearningwp" ),
										"900"    => __( "900", "elearningwp" )
									),
									"description" => __( "Select Custom Font Weight", "elearningwp" ),
									"class"       => "color-mini",
								),
							),
						),
					),
				),
				'desc_group'    => array(
					'type'   => 'section',
					'label'  => __( 'Description', 'elearningwp' ),
					'hide'   => true,
					'fields' => array(
						'des'             => array(
							'type'                  => 'textarea',
							'label'                 => __( 'Descriptions', 'elearningwp' ),
							"description"           => __( "descriptions", "elearningwp" ),
							'allow_html_formatting' => true
						),
						'des_color'       => array(
							'type'    => 'color',
							'label'   => __( 'Description color', 'elearningwp' ),
							'default' => '',
							"class"   => "color-mini",
						),
						'des_font_size'   => array(
							"type"        => "number",
							"label"       => __( "Font Size", "elearningwp" ),
							"suffix"      => "px",
							"default"     => "16",
							"description" => __( "custom font size", "elearningwp" ),
							"class"       => "color-mini",
						),
						'des_font_weight' => array(
							"type"        => "select",
							"label"       => __( "Custom Font Weight", "elearningwp" ),
							"options"     => array(
								"normal" => __( "Normal", "elearningwp" ),
								"bold"   => __( "Bold", "elearningwp" ),
								"100"    => __( "100", "elearningwp" ),
								"200"    => __( "200", "elearningwp" ),
								"300"    => __( "300", "elearningwp" ),
								"400"    => __( "400", "elearningwp" ),
								"500"    => __( "500", "elearningwp" ),
								"600"    => __( "600", "elearningwp" ),
								"700"    => __( "700", "elearningwp" ),
								"800"    => __( "800", "elearningwp" ),
								"900"    => __( "900", "elearningwp" )
							),
							"description" => __( "Select Custom Font Weight", "elearningwp" ),
							"class"       => "color-mini",
						),
					),
				),
				'limit'         => array(
					'type'    => 'number',
					'label'   => __( 'Number Of Feature courses', 'elearningwp' ),
					'default' => '4'
				)
			)
		);
	}

	function get_template_name( $instance ) {
		if ( thim_is_new_learnpress( '2.0' ) ) {
			return 'base-v2';
		} else if ( thim_is_new_learnpress( '1.0' ) ) {
			return 'base-v1';
		}else{
			return 'base';
		}
	}

	function get_style_name( $instance ) {
		return false;
	}
}

/**
 * Register widget
 */
function thim_instructor_of_month_register_widget() {
	register_widget( 'Instructor_Of_Month_Widget' );
}

add_action( 'widgets_init', 'thim_instructor_of_month_register_widget' );
