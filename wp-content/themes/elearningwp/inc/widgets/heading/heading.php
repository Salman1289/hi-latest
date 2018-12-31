<?php

class Heading_Widget extends Thim_Widget {

	function __construct() {
		parent::__construct(
			'heading',
			__( 'Thim: Heading', 'elearningwp' ),
			array(
				'description'   => __( 'Add heading text', 'elearningwp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon' => 'dashicons dashicons-welcome-learn-more thim_widgets_heading'
			),
			array(),
			array(
				'title'               => array(
					'type'    => 'text',
					'label'   => __( 'Heading Text', 'elearningwp' ),
					'default' => __( "Default value", "elearningwp" ),
					'allow_html_formatting' => true,
				),
				'textcolor'           => array(
					'type'    => 'color',
					'label'   => __( 'Text Heading color', 'elearningwp' ),
					'default' => '#333',
				),
				'size'                => array(
					"type"    => "select",
					"label"   => __( "Size Heading", "elearningwp" ),
					"options" => array(
						"h2" => __( "h2", "elearningwp" ),
						"h3" => __( "h3", "elearningwp" ),
						"h4" => __( "h4", "elearningwp" ),
						"h5" => __( "h5", "elearningwp" ),
						"h6" => __( "h6", "elearningwp" )
					),
					"default" => "h3"
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
					)
				),
				'custom_font_heading' => array(
					'type'          => 'section',
					'label'         => __( 'Custom Font Heading', 'elearningwp' ),
					'hide'          => true,
					'state_handler' => array(
						'font_heading_type[custom]'  => array( 'show' ),
						'font_heading_type[default]' => array( 'hide' ),
					),
					'fields'        => array(
						'custom_font_size'   => array(
							"type"        => "number",
							"label"       => __( "Font Size", "elearningwp" ),
							"suffix"      => "px",
							"default"     => "14",
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
						'custom_font_style'  => array(
							"type"        => "select",
							"label"       => __( "Custom Font Style", "elearningwp" ),
							"options"     => array(
								"inherit" => __( "inherit", "elearningwp" ),
								"initial" => __( "initial", "elearningwp" ),
								"italic"  => __( "italic", "elearningwp" ),
								"normal"  => __( "normal", "elearningwp" ),
								"oblique" => __( "oblique", "elearningwp" )
							),
							"description" => __( "Select Custom Font Style", "elearningwp" ),
							"class"       => "color-mini",
						),
					),
				),

				'bg_line'             => array(
					'type'  => 'color',
					'label' => __( 'Color Line', 'elearningwp' ),
				),

				'text_align'          => array(
					"type"    => "select",
					"label"   => __( "Text Align:", "elearningwp" ),
					"options" => array(
						"left"   => __( "Text at Left", "elearningwp" ),
						"right"  => __( "Text at Right", "elearningwp" ),
						"center" => __( "Text at Center", "elearningwp" )
					),
				),
				'desc_group'          => array(
					'type'   => 'section',
					'label'  => __( 'Description', 'elearningwp' ),
					'hide'   => true,
					'fields' => array(
						'des'           => array(
							'type'        => 'textarea',
							'label'       => __( 'Descriptions', 'elearningwp' ),
							"description" => __( "descriptions", "elearningwp" ),
						),
						'des_color'     => array(
							'type'    => 'color',
							'label'   => __( 'Description color', 'elearningwp' ),
							'default' => '#333',
						),
						'des_font_size' => array(
							"type"        => "number",
							"label"       => __( "Description Font Size", "elearningwp" ),
							"suffix"      => "px",
							"default"     => "14",
							"description" => __( "Description font size", "elearningwp" ),
						),
					),
				),
				'css_animation'       => array(
					"type"    => "select",
					"label"   => __( "CSS Animation", "elearningwp" ),
					"options" => array(
						""              => __( "No", "elearningwp" ),
						"top-to-bottom" => __( "Top to bottom", "elearningwp" ),
						"bottom-to-top" => __( "Bottom to top", "elearningwp" ),
						"left-to-right" => __( "Left to right", "elearningwp" ),
						"right-to-left" => __( "Right to left", "elearningwp" ),
						"appear"        => __( "Appear from center", "elearningwp" )
					),
				),
			),
			THIM_DIR . 'inc/widgets/heading/'
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

function thim_heading_register_widget() {
	register_widget( 'Heading_Widget' );
}

add_action( 'widgets_init', 'thim_heading_register_widget' );