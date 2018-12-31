<?php

class Post_Display_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'post-display',
			__( 'Thim: Post Display', 'elearningwp' ),
			array(
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon'   => 'dashicons dashicons-welcome-learn-more thim_widgets_list_post'
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
							'default'               => __( "Latest News", "elearningwp" ),
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
						'description'               => array(
							'type'                  => 'text',
							'label'                 => __( 'Heading Description', 'elearningwp' ),
							'allow_html_formatting' => true
						),
					),
				),

				't_config'      => array(
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
				'layout'        => array(
					"type"    => "select",
					"label"   => __( "Layout", "elearningwp" ),
					"options" => array(
						"base"   => __( 'Default', 'elearningwp' ),
						"layout-slider" => __( 'Slider', 'elearningwp' ),
					),
				),
				'number_posts'  => array(
					'type'    => 'number',
					'label'   => __( 'Number Posts', 'elearningwp' ),
					'default' => __( "4", "elearningwp" )
				),
				'columns'       => array(
					'type'    => 'select',
					'label'   => __( 'Columns', 'elearningwp' ),
					"options" => array(
						"1" => __( "1", "elearningwp" ),
						"2" => __( "2", "elearningwp" )
					),
					'default' => __( "1", "elearningwp" )
				),

				'orderby'       => array(
					"type"    => "select",
					"label"   => __( "Order by", "elearningwp" ),
					"options" => array(
						"date"    => __( "Date", "elearningwp" ),
						"title"   => __( "Title", "elearningwp" ),
						"comment" => __( "Comment", "elearningwp" ),
						"random"  => __( "Random", "elearningwp" ),
					),
				),
				'order'         => array(
					"type"    => "select",
					"label"   => __( "Order", "elearningwp" ),
					"options" => array(
						"asc"  => __( "ASC", "elearningwp" ),
						"desc" => __( "DESC", "elearningwp" )
					),
				),
				'css_animation' => array(
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
			THIM_DIR . 'inc/widgets/post-display/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */


	function get_template_name( $instance ) {
		if( !empty($instance['layout']) ) {
			return $instance['layout'];
		} else {
			return 'base';
		}
	}

	function get_style_name( $instance ) {
		//return 'basic';
	}

	function enqueue_frontend_scripts() {
		wp_enqueue_script( 'thim-owl-carousel' );
	}
}

function thim_post_display_register_widget() {
	register_widget( 'Post_Display_Widget' );
}

add_action( 'widgets_init', 'thim_post_display_register_widget' );