<?php

/**
 * Class Courses_Searching_Widget
 *
 * Widget Name: Courses Searching
 *
 * Author: Ken
 */
class Courses_Searching_Widget extends Thim_Widget {

	function __construct() {
		parent::__construct(
			'courses-searching',
			__( 'Thim: Courses Searching', 'elearningwp' ),
			array(
				'description'   => __( 'Search courses', 'elearningwp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon'   => 'dashicons dashicons-welcome-learn-more thim_widgets_courses_searching'
			),
			array(),
			array(
				'label'  => array(
					'type'    => 'text',
					'default' => __( 'What do you want to learn today?', 'elearningwp' ),
					'label'   => __( 'Searching Label', 'elearningwp' ),
				),
				'layout' => array(
					'type'    => 'select',
					'label'   => __( 'Layout', 'elearningwp' ),
					"options" => array(
						"layout-01" => __( "Layout 01", "elearningwp" ),
						"layout-02" => __( "Layout 02", "elearningwp" ),
						"layout-top" => __( "Layout Top", "elearningwp" ),
					),
					"default" => "layout-01"
				)
			)
		);
	}

	function enqueue_frontend_scripts() {
		wp_enqueue_script( 'thim-courses-searching', THIM_URI . 'inc/widgets/courses-searching/js/live-search.js', array( 'jquery' ), '', true );
	}

	function get_template_name( $instance ) {
		if ( $instance['layout'] == 'layout-top' ) {
			return $instance['layout'];
		}
		else{
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
function thim_courses_searching_register_widget() {
	register_widget( 'Courses_Searching_Widget' );
}

add_action( 'widgets_init', 'thim_courses_searching_register_widget' );
