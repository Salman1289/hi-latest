<?php

class Our_Team_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'our-team',
			__( 'Thim: Our Team', 'elearningwp' ),
			array(
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon' => 'dashicons dashicons-welcome-learn-more thim_widgets_team'
			),
			array(),
			array(
				'cat_id'        => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Select Category', 'elearningwp' ),
					'default' => 'all',
					'options' => $this->thim_get_team_categories(),
				),
 				'number_post'        => array(
					'type'    => 'number',
					'label'   => __( 'Number Posts', 'elearningwp' ),
					'default' => '5'
 				),
				'layout'        => array(
					"type"    => "select",
					"label"   => __( "Layout", "elearningwp" ),
					"options" => array(
						"list1" => __( "List-01", "elearningwp" )
					),
				),
				'columns'        => array(
					"type"    => "select",
					"label"   => __( "Column", "elearningwp" ),
					"options" => array(
						"2" => __( "2", "elearningwp" ),
						"3" => __( "3", "elearningwp" ),
						"4" => __( "4", "elearningwp" )
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
			THIM_DIR . 'inc/widgets/our-team/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */
	// Get list category
	function thim_get_team_categories() {
		global $wpdb;
		$query = $wpdb->get_results( $wpdb->prepare(
			"
				  SELECT      t1.term_id, t2.name
				  FROM        $wpdb->term_taxonomy AS t1
				  INNER JOIN $wpdb->terms AS t2 ON t1.term_id = t2.term_id
				  WHERE t1.taxonomy = %s
				  AND t1.count > %d
				  ",
			'our_team_category', 0
		) );

		$cats        = array();
		$cats['all'] = 'All';
		if ( ! empty( $query ) ) {
			foreach ( $query as $key => $value ) {
				$cats[ $value->term_id ] = $value->name;
			}
		}

		return $cats;
	}

	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}
}
function thim_our_team_register_widget() {
	register_widget( 'Our_Team_Widget' );
}

add_action( 'widgets_init', 'thim_our_team_register_widget' );