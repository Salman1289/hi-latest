<?php

/**
 * Class Course_Categories_Widget
 *
 * Widget Name: Course Categories
 *
 * Author: Ken
 */
class Course_Categories_Widget extends Thim_Widget {

	function __construct() {
		parent::__construct(
			'course-categories',
			__( 'Thim: Course Categories', 'elearningwp' ),
			array(
				'description' => __( 'Show course categories', 'elearningwp' ),
				'help'        => '',
			),
			array(),
			array(
				'title'          => array(
					'type'  => 'text',
					'label' => esc_html__( 'Title', 'elearningwp' ),
				),
				'layout'         => array(
					'type'          => 'select',
					'label'         => esc_html__( 'Layout', 'elearningwp' ),
					'options'       => array(
						'slider' => esc_html__( 'Slider', 'elearningwp' ),
						'base'   => esc_html__( 'List Categories', 'elearningwp' ),
					),
					'default'       => 'base',
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'layout_type' )
					),
				),
				'slider-options' => array(
					'type'          => 'section',
					'label'         => esc_html__( 'Slider Layout Options', 'elearningwp' ),
					'hide'          => true,
					"class"         => "clear-both",
					'state_handler' => array(
						'layout_type[slider]' => array( 'show' ),
						'layout_type[list]'   => array( 'hide' ),
					),
					'fields'        => array(
						'limit'           => array(
							'type'    => 'number',
							'label'   => esc_html__( 'Limit categories', 'elearningwp' ),
							'default' => '15'
						),
						'show_pagination' => array(
							'type'    => 'checkbox',
							'label'   => esc_html__( 'Show Pagination', 'elearningwp' ),
							'default' => false
						),
						'show_navigation' => array(
							'type'    => 'checkbox',
							'label'   => esc_html__( 'Show Navigation', 'elearningwp' ),
							'default' => true
						),
						'item_visible'    => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Items Visible', 'elearningwp' ),
							'options' => array(
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'4' => '4',
								'5' => '5',
								'6' => '6',
								'7' => '7',
								'8' => '8',
							),
							'default' => '7'
						),
						'auto_play'       => array(
							'type'        => 'number',
							'label'       => esc_html__( 'Auto Play Speed (in ms)', 'elearningwp' ),
							'description' => esc_html__( 'Set 0 to disable auto play.', 'elearningwp' ),
							'default'     => '0'
						),
					),

				),

				'list-options' => array(
					'type'          => 'section',
					'label'         => esc_html__( 'List Layout Options', 'elearningwp' ),
					'hide'          => true,
					"class"         => "clear-both",
					'state_handler' => array(
						'layout_type[list]'   => array( 'show' ),
						'layout_type[slider]' => array( 'hide' ),
					),
					'fields'        => array(
						'show_counts'  => array(
							'type'    => 'checkbox',
							'label'   => esc_html__( 'Show course count', 'elearningwp' ),
							'default' => false,
						),
						'hierarchical' => array(
							'type'    => 'checkbox',
							'label'   => esc_html__( 'Show hierarchy', 'elearningwp' ),
							'default' => false,
						),
					),

				),
			)
		);
	}

	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}
}

/**
 * Register widget
 */
function thim_course_categories_register_widget() {
	register_widget( 'Course_Categories_Widget' );
}

add_action( 'widgets_init', 'thim_course_categories_register_widget' );
