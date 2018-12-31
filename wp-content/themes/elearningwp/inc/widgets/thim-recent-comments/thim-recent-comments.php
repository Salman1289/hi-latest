<?php

class Recent_Comments_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'thim-recent-comments',
			__( 'Thim: Recent Comments', 'elearningwp' ),
			array(
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon'   => 'dashicons dashicons-welcome-learn-more'
			),
			array(),
			array(
				'heading_group'   => array(
					'type'   => 'section',
					'label'  => __( 'Heading', 'elearningwp' ),
					'hide'   => true,
					'fields' => array(
						'title'               => array(
							'type'                  => 'text',
							'label'                 => __( 'Heading Text', 'elearningwp' ),
							'default'               => __( "Recent Comments", "elearningwp" ),
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
							"default" => "h4",
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

				't_config'        => array(
					'type'   => 'section',
					'label'  => __( 'Config Color', 'elearningwp' ),
					'hide'   => true,
					'fields' => array(
						// text color
						'title_color' => array(
							'type'  => 'color',
							'label' => __( 'Title Color', 'elearningwp' ),
							"class" => "color-mini"

						),
						'meta_color'  => array(
							'type'  => 'color',
							'label' => __( 'Meta color', 'elearningwp' ),
							"class" => "color-mini"
						),
					),
				),
				'number_comments' => array(
					'type'    => 'number',
					'label'   => __( 'Number Comments', 'elearningwp' ),
					'default' => __( "4", "elearningwp" )
				),
				'css_animation'   => array(
					"type"    => "select",
					"label"   => __( "CSS Animation", "elearningwp" ),
					"options" => array(
						""            => __( "No", "elearningwp" ),
						"top-to-bottom" => __( "Top to bottom", "elearningwp" ),
						"bottom-to-top" => __( "Bottom to top", "elearningwp" ),
						"left-to-right" => __( "Left to right", "elearningwp" ),
						"right-to-left" => __( "Right to left", "elearningwp" ),
						"appear"        => __( "Appear from center", "elearningwp" )
					),
					'default' => ''
				)

			),
			THIM_DIR . 'inc/widgets/recent-comments/'
		);
	}


	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return 'basic';
	}
}

function thim_recent_comments_register_widget() {
	register_widget( 'Recent_Comments_Widget' );
}

add_action( 'widgets_init', 'thim_recent_comments_register_widget' );