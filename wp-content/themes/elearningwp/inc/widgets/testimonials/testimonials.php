<?php
if ( class_exists( 'THIM_Testimonials' ) ) {
	class Testimonials_Widget extends Thim_Widget {
		function __construct() {
			$link_images = get_template_directory_uri() . '/inc/widgets/testimonials/images/';
			parent::__construct(
				'testimonials',
				__( 'Thim: Testimonials', 'elearningwp' ),
				array(
					'help'          => '',
					'panels_groups' => array( 'thim_widget_group' ),
					'panels_icon'   => 'dashicons dashicons-welcome-learn-more thim_widgets_testimonial'
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
								'default'               => __( "Testimonials", "elearningwp" ),
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

					// config
					't_config'      => array(
						'type'   => 'section',
						'label'  => __( 'Config', 'elearningwp' ),
						'hide'   => true,
						'fields' => array(
							// text color
							'bg-color'      => array(
								'type'  => 'color',
								'label' => __( 'Background Content Color', 'elearningwp' ),
								"class" => "color-mini"

							),
							't_text_color'  => array(
								'type'  => 'color',
								'label' => __( 'Text Content color', 'elearningwp' ),
								"class" => "color-mini"
							),
							'author_color'  => array(
								'type'  => 'color',
								'label' => __( 'Author color', 'elearningwp' ),
								"class" => "color-mini"
							),

							'regency_color' => array(
								'type'  => 'color',
								'label' => __( 'Regency color', 'elearningwp' ),
								"class" => "color-mini"
							),
						),
					),
					'number'        => array(
						'type'    => 'number',
						'label'   => __( 'Number Posts', 'elearningwp' ),
						'default' => '4'
					),
					'layout'        => array(
						"type"    => "radioimage",
						"label"   => __( "Layout", "elearningwp" ),
						"default" => "default",
						"options" => array(
							"default"   => $link_images . 'default.jpg',
							"layout-01" => $link_images . 'layout-01.jpg',
							"layout-03" => $link_images . 'layout-03.jpg',
							"layout-round-slider" => $link_images . 'layout-round-slider.jpg',
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
				THIM_DIR . 'inc/widgets/testimonials/'
			);
		}

		/**
		 * Initialize the CTA widget
		 */


		function get_template_name( $instance ) {
			if( $instance['layout'] != 'default' && $instance['layout'] != 'layout-01' ) {
				return $instance['layout'];
			} else {
				return 'base';
			}
		}

		function get_style_name( $instance ) {
			return false;
		}

		function enqueue_frontend_scripts() {
			wp_enqueue_script( 'thim-owl-carousel' );
			wp_enqueue_script( 'thim-testimonial', THIM_URI . 'inc/widgets/testimonials/js/testimonials.js', array( 'jquery' ), '', true );
		}
	}

	function thim_testimonials_register_widget() {
		register_widget( 'Testimonials_Widget' );
	}

	add_action( 'widgets_init', 'thim_testimonials_register_widget' );
}