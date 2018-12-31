<?php

class Thim_Social_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'social',
			__( 'Thim: Social Links', 'elearningwp' ),
			array(
				'description' => __( 'Social Links', 'elearningwp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon' => 'dashicons dashicons-welcome-learn-more thim_widgets_social'
			),
			array(),
			array(
				'title'          => array(
					'type'  => 'text',
					'label' => __( 'Title', 'elearningwp' )
				),
				'link_face'      => array(
					'type'  => 'text',
					'label' => __( 'Facebook Url', 'elearningwp' )
				),
				'link_twitter'   => array(
					'type'  => 'text',
					'label' => __( 'Twitter Url', 'elearningwp' )
				),
				'link_google'    => array(
					'type'  => 'text',
					'label' => __( 'Google Url', 'elearningwp' )
				),
				'link_dribble'   => array(
					'type'  => 'text',
					'label' => __( 'Dribble Url', 'elearningwp' )
				),
				'link_linkedin'  => array(
					'type'  => 'text',
					'label' => __( 'Linked in Url', 'elearningwp' )
				),
				'link_pinterest' => array(
					'type'  => 'text',
					'label' => __( 'Pinterest Url', 'elearningwp' )
				),
				'link_digg'      => array(
					'type'  => 'text',
					'label' => __( 'Digg Url', 'elearningwp' )
				),
				'link_youtube'   => array(
					'type'  => 'text',
					'label' => __( 'Youtube Url', 'elearningwp' )
				),
				'link_target'    => array(
					"type"    => "select",
					"label"   => __( "Link Target", "elearningwp" ),
					"options" => array(
						"_self"  => __( "Same window", "elearningwp" ),
						"_blank" => __( "New window", "elearningwp" ),
					),
				),

			),
			THIM_DIR . 'inc/widgets/social/'
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

function thim_social_register_widget() {
	register_widget( 'Thim_Social_Widget' );
}

add_action( 'widgets_init', 'thim_social_register_widget' );