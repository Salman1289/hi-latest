<?php

class Icon_Box_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'icon-box',
			__( 'Thim: Icon Box', 'elearningwp' ),
			array(
				'description'   => __( 'Add icon box', 'elearningwp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon' => 'dashicons dashicons-welcome-learn-more thim_widgets_icon_box'
			),
			array(),
			array(
				'title_group'         => array(
					'type'   => 'section',
					'label'  => __( 'Title Options', 'elearningwp' ),
					'hide'   => true,
					'fields' => array(
						'title'            => array(
							'type'                  => 'text',
							'label'                 => __( 'Title', 'elearningwp' ),
							"default"               => "This is an icon box.",
							"description"           => __( "Provide the title for this icon box.", "elearningwp" ),
							'allow_html_formatting' => true
						),
						'color_title'      => array(
							'type'  => 'color',
							'label' => __( 'Color Title', 'elearningwp' ),
						),
						'size'             => array(
							"type"        => "select",
							"label"       => __( "Size Heading", "elearningwp" ),
							"default"     => "h3",
							"options"     => array(
								"h2" => __( "h2", "elearningwp" ),
								"h3" => __( "h3", "elearningwp" ),
								"h4" => __( "h4", "elearningwp" ),
								"h5" => __( "h5", "elearningwp" ),
								"h6" => __( "h6", "elearningwp" )
							),
							"description" => __( "Select size heading.", "elearningwp" )
						),
						'font_heading'     => array(
							"type"          => "select",
							"label"         => __( "Font Heading", "elearningwp" ),
							"options"       => array(
								"default" => __( "Default", "elearningwp" ),
								"custom"  => __( "Custom", "elearningwp" )
							),
							"description"   => __( "Select Font heading.", "elearningwp" ),
							'state_emitter' => array(
								'callback' => 'select',
								'args'     => array( 'custom_font_heading' )
							)
						),
						'custom_heading'   => array(
							'type'          => 'section',
							'label'         => __( 'Custom Heading Option', 'elearningwp' ),
							'hide'          => true,
							'state_handler' => array(
								'custom_font_heading[custom]'  => array( 'show' ),
								'custom_font_heading[default]' => array( 'hide' ),
							),
							'fields'        => array(
								'custom_font_size'   => array(
									"type"        => "number",
									"label"       => __( "Font Size", "elearningwp" ),
									"suffix"      => "px",
									"default"     => "14",
									"description" => __( "custom font size", "elearningwp" ),
									"class"       => "color-mini"
								),
								'custom_font_weight' => array(
									"type"        => "select",
									"label"       => __( "Custom Font Weight", "elearningwp" ),
									"class"       => "color-mini",
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
								),
								'custom_mg_bt'       => array(
									"type"   => "number",
									"class"  => "color-mini",
									"label"  => __( "Margin Bottom Value", "elearningwp" ),
									"value"  => 0,
									"suffix" => "px",
								),
							)
						),
						'line_after_title' => array(
							'type'  => 'checkbox',
							'label' => __( 'Border bottom title', 'elearningwp' ),
						),
					),
				),
				'desc_group'          => array(
					'type'   => 'section',
					'label'  => __( 'Description', 'elearningwp' ),
					'hide'   => true,
					'fields' => array(
						'content'              => array(
							"type"                  => "textarea",
							"label"                 => __( "Add description", "elearningwp" ),
							"default"               => "Write a short description, that will describe the title or something informational and useful.",
							"description"           => __( "Provide the description for this icon box.", "elearningwp" ),
							'allow_html_formatting' => true
						),
						'custom_font_size_des' => array(
							"type"        => "number",
							"label"       => __( "Custom Font Size", "elearningwp" ),
							"suffix"      => "px",
							"default"     => "",
							"description" => __( "custom font size", "elearningwp" ),
							"class"       => "color-mini",
						),
						'custom_font_weight'   => array(
							"type"        => "select",
							"label"       => __( "Custom Font Weight", "elearningwp" ),
							"class"       => "color-mini",
							"options"     => array(
								""     => __( "Normal", "elearningwp" ),
								"bold" => __( "Bold", "elearningwp" ),
								"100"  => __( "100", "elearningwp" ),
								"200"  => __( "200", "elearningwp" ),
								"300"  => __( "300", "elearningwp" ),
								"400"  => __( "400", "elearningwp" ),
								"500"  => __( "500", "elearningwp" ),
								"600"  => __( "600", "elearningwp" ),
								"700"  => __( "700", "elearningwp" ),
								"800"  => __( "800", "elearningwp" ),
								"900"  => __( "900", "elearningwp" )
							),
							"description" => __( "Select Custom Font Weight", "elearningwp" ),
						),
						'color_description'    => array(
							"type"  => "color",
							"label" => __( "Color Description", "elearningwp" ),
							"class" => "color-mini",
						),
					),
				),

				'read_more_group'     => array(
					'type'   => 'section',
					'label'  => __( 'Link Icon Box', 'elearningwp' ),
					'hide'   => true,
					'fields' => array(
						// Add link to existing content or to another resource
						'link'                   => array(
							"type"        => "text",
							"label"       => __( "Add Link", "elearningwp" ),
							"description" => __( "Provide the link that will be applied to this icon box.", "elearningwp" )
						),
						// Select link option - to box or with read more text
						'read_more'              => array(
							"type"          => "select",
							"label"         => __( "Apply link to:", "elearningwp" ),
							"options"       => array(
								"complete_box" => "Complete Box",
								"title"        => "Box Title",
								"more"         => "Display Read More"
							),
							"description"   => __( "Select whether to use color for icon or not.", "elearningwp" ),
							'state_emitter' => array(
								'callback' => 'select',
								'args'     => array( 'read_more_op' )
							)
						),
						// Link to traditional read more
						'button_read_more_group' => array(
							'type'          => 'section',
							'label'         => __( 'Option Button Read More', 'elearningwp' ),
							'hide'          => true,
							'state_handler' => array(
								'read_more_op[more]'         => array( 'show' ),
								'read_more_op[complete_box]' => array( 'hide' ),
								'read_more_op[title]'        => array( 'hide' ),
							),
							'fields'        => array(
								'read_text'                   => array(
									"type"        => "text",
									"label"       => __( "Read More Text", "elearningwp" ),
									"default"     => "Read More",
									"description" => __( "Customize the read more text.", "elearningwp" ),
								),
								'read_more_text_color'        => array(
									"type"        => "color",
									"class"       => "",
									"label"       => __( "Text Color Read More", "elearningwp" ),
									"default"     => "#fff",
									"description" => __( "Select whether to use text color for Read More Text or default.", "elearningwp" ),
									"class"       => "color-mini",
								),
								'border_read_more_text'       => array(
									"type"        => "color",
									"label"       => __( "Border Color Read More Text:", "elearningwp" ),
									"description" => __( "Select whether to use border color for Read More Text or none.", "elearningwp" ),
									"class"       => "color-mini",
								),
								'bg_read_more_text'           => array(
									"type"        => "color",
									"class"       => "mini",
									"label"       => __( "Background Color Read More Text:", "elearningwp" ),
									"description" => __( "Select whether to use background color for Read More Text or default.", "elearningwp" ),
									"class"       => "color-mini",
								),
								'read_more_text_color_hover'  => array(
									"type"        => "color",
									"class"       => "",
									"label"       => __( "Text Hover Color Read More", "elearningwp" ),
									"default"     => "#fff",
									"description" => __( "Select whether to use text color for Read More Text or default.", "elearningwp" ),
									"class"       => "color-mini",
								),

								'bg_read_more_text_hover'     => array(
									"type"        => "color",
									"label"       => __( "Background Hover Color Read More Text:", "elearningwp" ),
									"description" => __( "Select whether to use background color when hover Read More Text or default.", "elearningwp" ),
									"class"       => "color-mini",
								),

							)
						),
					),
				),
				// Play with icon selector
				'icon_type'           => array(
					"type"          => "select",
					"class"         => "",
					"label"         => __( "Icon to display:", "elearningwp" ),
					"default"       => "font-awesome",
					"options"       => array(
						"font-awesome"  => "Font Awesome Icon",
						"font-7-stroke" => "Font 7 stroke Icon",
						"custom"        => "Custom Image Icon",
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'icon_type_op' )
					)
				),
				'font_7_stroke_group' => array(
					'type'          => 'section',
					'label'         => __( 'Font 7 Stroke Icon', 'elearningwp' ),
					'hide'          => true,
					'state_handler' => array(
						'icon_type_op[font-awesome]'  => array( 'hide' ),
						'icon_type_op[custom]'        => array( 'hide' ),
						'icon_type_op[font-7-stroke]' => array( 'show' ),
					),
					'fields'        => array(
						'icon'      => array(
							"type"        => "icon-7-stroke",
							"class"       => "",
							"label"       => __( "Select Icon:", "elearningwp" ),
							"description" => __( "Select the icon from the list.", "elearningwp" ),
							"class_name"  => 'font-7-stroke',
						),
						// Resize the icon
						'icon_size' => array(
							"type"        => "number",
							"class"       => "",
							"label"       => __( "Icon Font Size ", "elearningwp" ),
							"suffix"      => "px",
							"default"     => "14",
							"description" => __( "Select the icon font size.", "elearningwp" ),
							"class_name"  => 'font-7-stroke'
						),
					),
				),
				'font_awesome_group'  => array(
					'type'          => 'section',
					'label'         => __( 'Font Awesome Icon', 'elearningwp' ),
					'hide'          => true,
					'state_handler' => array(
						'icon_type_op[font-awesome]'  => array( 'show' ),
						'icon_type_op[custom]'        => array( 'hide' ),
						'icon_type_op[font-7-stroke]' => array( 'hide' ),
					),
					'fields'        => array(
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
							"label"       => __( "Icon Font Size ", "elearningwp" ),
							"suffix"      => "px",
							"default"     => "14",
							"description" => __( "Select the icon font size.", "elearningwp" ),
							"class_name"  => 'font-awesome'
						),
					),
				),
				'font_image_group'    => array(
					'type'          => 'section',
					'label'         => __( 'Custom Image Icon', 'elearningwp' ),
					'hide'          => true,
					'state_handler' => array(
						'icon_type_op[font-awesome]'  => array( 'hide' ),
						'icon_type_op[custom]'        => array( 'show' ),
						'icon_type_op[font-7-stroke]' => array( 'hide' ),
					),
					'fields'        => array(
						// Play with icon selector
						'icon_img' => array(
							"type"        => "media",
							"label"       => esc_html__( "Upload Image Icon:", "elearningwp" ),
							"description" => esc_html__( "Upload the custom image icon.", "elearningwp" ),
							"class_name"  => 'custom',
						),
					),
				),
				// // Resize the icon
				'width_icon_box'      => array(
					"type"    => "number",
					"class"   => "",
					"default" => "100",
					"label"   => __( "Width Box Icon", "elearningwp" ),
					"suffix"  => "px",
				),
				'color_group'         => array(
					'type'   => 'section',
					'label'  => __( 'Color Options', 'elearningwp' ),
					'hide'   => true,
					'fields' => array(
						// Customize Icon Color
						'icon_color'              => array(
							"type"        => "color",
							"class"       => "color-mini",
							"label"       => __( "Select Icon Color:", "elearningwp" ),
							"description" => __( "Select the icon color.", "elearningwp" ),
						),
						'icon_border_color'       => array(
							"type"        => "color",
							"label"       => __( "Icon Border Color:", "elearningwp" ),
							"description" => __( "Select the color for icon border.", "elearningwp" ),
							"class"       => "color-mini",
						),
						'icon_bg_color'           => array(
							"type"        => "color",
							"label"       => __( "Icon Background Color:", "elearningwp" ),
							"description" => __( "Select the color for icon background.", "elearningwp" ),
							"class"       => "color-mini",
						),
						'icon_hover_color'        => array(
							"type"        => "color",
							"label"       => __( "Hover Icon Color:", "elearningwp" ),
							"description" => __( "Select the color hover for icon.", "elearningwp" ),
							"class"       => "color-mini",
						),
						'icon_border_color_hover' => array(
							"type"        => "color",
							"label"       => __( "Hover Icon Border Color:", "elearningwp" ),
							"description" => __( "Select the color hover for icon border.", "elearningwp" ),
							"class"       => "color-mini",
						),
					// Give some background to icon
						'icon_bg_color_hover'     => array(
							"type"        => "color",
							"label"       => __( "Hover Icon Background Color:", "elearningwp" ),
							"description" => __( "Select the color hover for icon background .", "elearningwp" ),
							"class"       => "color-mini",
						),
					)
				),
				'layout_group'        => array(
					'type'   => 'section',
					'label'  => __( 'Layout Options', 'elearningwp' ),
					'hide'   => true,
					'fields' => array(
						'box_icon_style' => array(
							"type"    => "select",
							"class"   => "",
							"label"   => __( "Icon Shape", "elearningwp" ),
							"options" => array(
								""       => __( "None", "elearningwp" ),
								"circle" => __( "Circle", "elearningwp" ),
								//	"square" => __( "square", "elearningwp" ),
							),
							"std"     => "circle",
						),
						'pos'            => array(
							"type"        => "select",
							"class"       => "",
							"label"       => __( "Box Style:", "elearningwp" ),
							"default"     => "top",
							"options"     => array(
								"left"  => "Icon at Left",
								"right" => "Icon at Right",
								"top"   => "Icon at Top"
							),
							"description" => __( "Select icon position. Icon box style will be changed according to the icon position.", "elearningwp" ),
						),
						'text_align_sc'  => array(
							"type"    => "select",
							"class"   => "",
							"label"   => __( "Text Align Shortcode:", "elearningwp" ),
							"options" => array(
								"text-left"   => "Text Left",
								"text-right"  => "Text Right",
								"text-center" => "Text Center"
							)
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
				)
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

	function enqueue_frontend_scripts() {
		//wp_enqueue_script( 'icon-box', THIM_URI . 'inc/widgets/icon-box/js/icon-box.js', array( 'jquery' ), '', true );
	}
}

function icon_box_register_widget() {
	register_widget( 'Icon_Box_Widget' );
}

add_action( 'widgets_init', 'icon_box_register_widget' );