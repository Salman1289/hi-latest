<?php

class Thim_Counters_Box_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'counters-box',
			esc_html__( 'Thim: Counters Box', 'elearningwp' ),
			array(
				'description'   => esc_html__( 'Counters Box', 'elearningwp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(

				'counters_label' => array(
					"type"  => "text",
					"label" => esc_html__( "Counters label", 'elearningwp' ),
				),

				'counters_value' => array(
					"type"    => "number",
					"label"   => esc_html__( "Counters Value", 'elearningwp' ),
					"default" => "20",
				),

				'icon'         => array(
					"type"  => "icon",
					"label" => esc_html__( "Icon", 'elearningwp' ),
				),
				'border_color' => array(
					"type"  => "color",
					"label" => esc_html__( "Border Color Icon", 'elearningwp' ),
				),

				'counter_color' => array(
					"type"  => "color",
					"label" => esc_html__( "Counters Box Icon", 'elearningwp' ),
				),

				'style' => array(
					"type"    => "select",
					"label"   => esc_html__( "Counter Style", 'elearningwp' ),
					"options" => array(
						"home-page" => esc_html__( "Home Page", 'elearningwp' ),
					),
					'default' => 'home-page'
				),

				'css_animation' => array(
					"type"    => "select",
					"label"   => esc_html__( "CSS Animation", 'elearningwp' ),
					"options" => array(
						""              => esc_html__( "No", 'elearningwp' ),
						"top-to-bottom" => esc_html__( "Top to bottom", 'elearningwp' ),
						"bottom-to-top" => esc_html__( "Bottom to top", 'elearningwp' ),
						"left-to-right" => esc_html__( "Left to right", 'elearningwp' ),
						"right-to-left" => esc_html__( "Right to left", 'elearningwp' ),
						"appear"        => esc_html__( "Appear from center", 'elearningwp' )
					),
				)
			),
			THIM_DIR . 'inc/widgets/counters-box/'
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
		wp_enqueue_script( 'thim-jquery-counter', THIM_URI . 'inc/widgets/counters-box/js/counters-box.js', array( 'jquery' ), '', true );
	}

}

function thim_counters_box_widget() {
	register_widget( 'Thim_Counters_Box_Widget' );
}

add_action( 'widgets_init', 'thim_counters_box_widget' );