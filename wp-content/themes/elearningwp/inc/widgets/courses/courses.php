<?php

/**
 * Class Courses_Widget
 *
 * Widget Name: Courses
 *
 * Author: Ken
 */
class Courses_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'courses',
			__( 'Thim: Courses', 'elearningwp' ),
			array(
				'description'   => __( 'Display courses', 'elearningwp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon'   => 'dashicons dashicons-welcome-learn-more thim_widgets_courses'
			),
			array(),
			array(
				'heading_group'    => array(
					'type'   => 'section',
					'label'  => __( 'Heading', 'elearningwp' ),
					'hide'   => true,
					'fields' => array(
						'title'               => array(
							'type'                  => 'text',
							'label'                 => __( 'Heading Text', 'elearningwp' ),
							'default'               => __( "Latest Courses", "elearningwp" ),
							'allow_html_formatting' => true
						),
						'textcolor'           => array(
							'type'    => 'color',
							'label'   => __( 'Text Heading color', 'elearningwp' ),
							'default' => '#2c3339',
							"class"   => "color-mini",
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
				'desc_group'       => array(
					'type'          => 'section',
					'label'         => __( 'Description', 'elearningwp' ),
					'hide'          => true,
					'fields'        => array(
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
					'state_handler' => array(
						'layout_type[layout-01]'          => array( 'show' ),
						'layout_type[layout-02]'          => array( 'show' ),
						'layout_type[layout-filter]'      => array( 'hide' ),
						'layout_type[layout-commingsoon]' => array( 'show' ),
						'layout_type[layout-media]'       => array( 'hide' ),
						'layout_type[layout-megamenu]'    => array( 'hide' ),
					),
				),
				'kind'             => array(
					'type'    => 'select',
					'label'   => __( 'Kind Of Courses', 'elearningwp' ),
					'options' => array(
						'latest'      => __( 'Latest courses', 'elearningwp' ),
						'popular'     => __( 'Popular courses', 'elearningwp' ),
						'commingsoon' => __( 'Commingsoon courses', 'elearningwp' )
					),
				),
				'cat'              => array(
					'type'          => 'select',
					'label'         => __( 'Select Category', 'elearningwp' ),
					'options'       => self::get_categories(),
					'default'       => 0,
					'state_handler' => array(
						'layout_type[layout-01]'          => array( 'show' ),
						'layout_type[layout-02]'          => array( 'show' ),
						'layout_type[layout-filter]'      => array( 'hide' ),
						'layout_type[layout-commingsoon]' => array( 'show' ),
						'layout_type[layout-media]'       => array( 'hide' ),
					),
				),
				'layout'           => array(
					'type'          => 'select',
					'label'         => __( 'Widget Layout', 'elearningwp' ),
					'options'       => array(
						'layout-01'          => __( 'Layout 01', 'elearningwp' ),
						'layout-02'          => __( 'Layout 02', 'elearningwp' ),
						'layout-filter'      => __( 'Layout Filter', 'elearningwp' ),
						'layout-commingsoon' => __( 'Layout Commingsoon Slider', 'elearningwp' ),
						'layout-media'       => __( 'Layout Media Slider', 'elearningwp' ),
						'layout-megamenu'    => __( 'Layout Mega Menu', 'elearningwp' ),
					),
					'default'       => 'layout-01',
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'layout_type' )
					),
				),
				'image_size'       => array(
					'type'          => 'text',
					'label'         => __( 'Image size', 'elearningwp' ),
					'description'   => __( 'Other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" courses.', 'elearningwp' ),
					'state_handler' => array(
						'layout_type[layout-01]'          => array( 'show' ),
						'layout_type[layout-02]'          => array( 'hide' ),
						'layout_type[layout-filter]'      => array( 'hide' ),
						'layout_type[layout-commingsoon]' => array( 'hide' ),
						'layout_type[layout-media]'       => array( 'hide' ),
						'layout_type[layout-megamenu]'    => array( 'hide' ),
					),
				),
				'columns'          => array(
					'type'          => 'select',
					'label'         => __( 'Columns', 'elearningwp' ),
					'options'       => array(
						'2' => __( '2', 'elearningwp' ),
						'3' => __( '3', 'elearningwp' ),
						'4' => __( '4', 'elearningwp' )
					),
					'state_handler' => array(
						'layout_type[layout-01]'          => array( 'show' ),
						'layout_type[layout-02]'          => array( 'hide' ),
						'layout_type[layout-filter]'      => array( 'show' ),
						'layout_type[layout-commingsoon]' => array( 'hide' ),
						'layout_type[layout-media]'       => array( 'hide' ),
						'layout_type[layout-megamenu]'    => array( 'hide' ),
					),
				),
				'limit'            => array(
					'type'    => 'number',
					'label'   => __( 'Number Of Courses', 'elearningwp' ),
					'default' => '4'
				),
				'link_all_courses' => array(
					'type'          => 'checkbox',
					'label'         => __( 'Show Link All Courses', 'elearningwp' ),
					'default'       => true,
					'state_handler' => array(
						'layout_type[layout-01]'          => array( 'show' ),
						'layout_type[layout-02]'          => array( 'hide' ),
						'layout_type[layout-filter]'      => array( 'hide' ),
						'layout_type[layout-commingsoon]' => array( 'hide' ),
						'layout_type[layout-media]'       => array( 'hide' ),
						'layout_type[layout-megamenu]'    => array( 'hide' ),
					),
				),
				'social_share'     => array(
					'type'          => 'checkbox',
					'label'         => __( 'Show Social Share', 'elearningwp' ),
					'default'       => true,
					'state_handler' => array(
						'layout_type[layout-01]'          => array( 'hide' ),
						'layout_type[layout-02]'          => array( 'hide' ),
						'layout_type[layout-filter]'      => array( 'hide' ),
						'layout_type[layout-commingsoon]' => array( 'hide' ),
						'layout_type[layout-media]'       => array( 'true' ),
						'layout_type[layout-megamenu]'    => array( 'hide' ),
					),
				),
				'slider-options'   => array(
					'type'          => 'section',
					'label'         => __( 'Slider Options', 'elearningwp' ),
					'hide'          => true,
					"class"         => "clear-both",
					'state_handler' => array(
						'layout_type[layout-01]'          => array( 'show' ),
						'layout_type[layout-02]'          => array( 'hide' ),
						'layout_type[layout-filter]'      => array( 'hide' ),
						'layout_type[layout-commingsoon]' => array( 'show' ),
						'layout_type[layout-media]'       => array( 'show' ),
						'layout_type[layout-megamenu]'    => array( 'hide' ),
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'courses_slider_opt' )
					),
					'fields'        => array(
						'courses_slider'  => array(
							'type'    => 'radio',
							'label'   => __( 'Courses Slider', 'elearningwp' ),
							'options' => array(
								'yes' => __( 'Yes', 'elearningwp' ),
								'no'  => __( 'No', 'elearningwp' )
							),

							'default' => 'yes'
						),
						'row'             => array(
							'type'          => 'select',
							'label'         => __( 'Row of slider', 'elearningwp' ),
							'options'       => array(
								'1' => __( '1', 'elearningwp' ),
								'2' => __( '2', 'elearningwp' )
							),
							'state_handler' => array(
								'courses_slider_opt[yes]' => array( 'show' ),
								'courses_slider_opt[no]'  => array( 'hide' ),
							),
						),
						'show_page_nav'   => array(
							'type'          => 'checkbox',
							'label'         => __( 'Show Page Navigation', 'elearningwp' ),
							'state_handler' => array(
								'courses_slider_opt[yes]' => array( 'show' ),
								'courses_slider_opt[no]'  => array( 'hide' ),
							),
							'default'       => true
						),
						'show_navigation' => array(
							'type'          => 'checkbox',
							'label'         => __( 'Show Navigation Arrow', 'elearningwp' ),
							'state_handler' => array(
								'courses_slider_opt[yes]' => array( 'show' ),
								'courses_slider_opt[no]'  => array( 'hide' ),
							),
							'default'       => false
						),
					),
				),


			)
		);
	}

	/**
	 * Display the widget.
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$instance               = $this->modify_instance( $instance );
		$this->current_instance = $instance;

		$args = wp_parse_args( $args, array(
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		) );

		$style = $this->get_style_name( $instance );

		// Add any missing default values to the instance
		$instance = $this->add_defaults( $this->form_options, $instance );

		$upload_dir = wp_upload_dir();

		if ( $style !== false ) {
			$hash     = $this->get_style_hash( $instance );
			$css_name = $this->id_base . '-' . $style . '-' . $hash;

			if ( isset( $instance['is_preview'] ) && $instance['is_preview'] ) {
				thim_widget_add_inline_css( $this->get_instance_css( $instance ) );
			} else {
				if ( ! file_exists( $upload_dir['basedir'] . '/thim-widgets/' . $css_name . '.css' ) || ( defined( 'SITEORIGIN_WIDGETS_DEBUG' ) && SITEORIGIN_WIDGETS_DEBUG ) ) {
					// Attempt to recreate the CSS
					$this->save_css( $instance );
				}

				if ( file_exists( $upload_dir['basedir'] . '/thim-widgets/' . $css_name . '.css' ) ) {
					wp_enqueue_style(
						$css_name, $upload_dir['baseurl'] . '/thim-widgets/' . $css_name . '.css'
					);
				} else {
					// Fall back to using inline CSS if we can't find the cached CSS file.
					thim_widget_add_inline_css( $this->get_instance_css( $instance ) );
				}
			}
		} else {
			$css_name = $this->id_base . '-base';
		}


		$this->enqueue_frontend_scripts();
		$this->enqueue_instance_frontend_scripts( $instance );
		extract( $this->get_template_variables( $instance, $args ) );
		if ( thim_is_new_learnpress( '3.0' ) ) {
			$widget_template = TP_THEME_THIM_DIR . 'inc/widgets/' . $this->id_base . '/tpl/lp3/' . $this->get_template_name( $instance ) . '.php';
		} else {
			$widget_template = TP_THEME_THIM_DIR . 'inc/widgets/' . $this->id_base . '/tpl/' . $this->get_template_name( $instance ) . '.php';
		}
		$child_widget_template = TP_CHILD_THEME_THIM_DIR . 'inc/widgets/' . $this->id_base . '/' . $this->get_template_name( $instance ) . '.php';
		if ( file_exists( $child_widget_template ) ) {
			$widget_template = $child_widget_template;
		}

		echo ent2ncr( $args['before_widget'] );
		echo '<div class="thim-widget-' . $this->id_base . ' thim-widget-' . $css_name . '">';
		@ include $widget_template;
		echo '</div>';
		echo ent2ncr( $args['after_widget'] );
	}

	function get_template_name( $instance ) {
		if ( $instance['layout'] != 'layout-01' ) {
			$layout = $instance['layout'];
		} else {
			$layout = 'base';
		}

		return $layout;
	}

	function get_categories() {

		$categories = get_categories( 'taxonomy=course_category&type=lp_course' );
		$cats       = array();
		$cats[0]    = esc_attr__( 'All', 'elearningwp' );

		if ( ! empty( $categories ) ) {
			foreach ( $categories as $key => $value ) {
				$cats[ $value->slug ] = $value->name;
			}
		}

		return $cats;
	}

	function get_style_name( $instance ) {
		return false;
	}

	function enqueue_frontend_scripts() {
		wp_enqueue_script( 'thim-owl-carousel' );
	}
}

if ( class_exists( 'LearnPress' ) ) {
	function thim_courses_register_widget() {
		register_widget( 'Courses_Widget' );
	}

	add_action( 'init', 'thim_courses_register_widget', 30 );
}