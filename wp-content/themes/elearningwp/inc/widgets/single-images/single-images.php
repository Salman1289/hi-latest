<?php

class Single_Images_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'single-images',
			__( 'Thim: Single Images', 'elearningwp' ),
			array(
				'description'   => __( 'Add heading text', 'elearningwp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon'   => 'dashicons dashicons-welcome-learn-more thim_widgets_single_image'
			),
			array(),
			array(
				'image' => array(
					'type'        => 'media',
					'label'       => __( 'Image', 'elearningwp' ),
					'description' => __( 'Select image from media library.', 'elearningwp' )
				),

				'image_size'        => array(
					'type'        => 'text',
					'label'       => __( 'Image size', 'elearningwp' ),
					'default'     => 'thumbnail',
					'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'elearningwp' )
				),
				'image_link'        => array(
					'type'        => 'text',
					'label'       => __( 'Image Link', 'elearningwp' ),
					'description' => __( 'Enter URL if you want this image to have a link.', 'elearningwp' )
				),
				'link_target'       => array(
					"type"    => "select",
					"label"   => __( "Link Target", "elearningwp" ),
					"options" => array(
						"_self"  => __( "Same window", "elearningwp" ),
						"_blank" => __( "New window", "elearningwp" ),
					),
				),
				'image_alignment'   => array(
					"type"        => "select",
					"label"       => __( "Image alignment", "elearningwp" ),
					"description" => "Select image alignment.",
					"options"     => array(
						"left"   => __( "Align Left", "elearningwp" ),
						"right"  => __( "Align Right", "elearningwp" ),
						"center" => __( "Align Center", "elearningwp" )
					),
				),
				'image_stype'       => array(
					"type"          => "select",
					"label"         => __( "Image style", "elearningwp" ),
					"description"   => "Select image style.",
					"default"       => "style-normal",
					"options"       => array(
						"style-normal" => __( "Normal", "elearningwp" ),
						"style-title"  => __( "Title", "elearningwp" ),
					),
					"state_emitter" => array(
						'callback' => "select",
						'args'     => array( 'image_stype_options' )
					),
				),
				'image_title'       => array(
					'type'          => 'text',
					'label'         => __( 'Image Title', 'elearningwp' ),
					'description'   => __( 'Image Title', 'elearningwp' ),
					'state_handler' => array(
						'image_stype_options[style-normal]' => array( 'hide' ),
						'image_stype_options[style-title]'  => array( 'show' ),
					),
				),
				'image_description' => array(
					'type'          => 'text',
					'label'         => __( 'Image Description', 'elearningwp' ),
					'description'   => __( 'Image Description', 'elearningwp' ),
					'state_handler' => array(
						'image_stype_options[style-normal]' => array( 'hide' ),
						'image_stype_options[style-title]'  => array( 'show' ),
					),
				),
				'image_button'      => array(
					'type'          => 'text',
					'label'         => __( 'Image Button', 'elearningwp' ),
					'description'   => __( 'Image Button', 'elearningwp' ),
					'state_handler' => array(
						'image_stype_options[style-normal]' => array( 'hide' ),
						'image_stype_options[style-title]'  => array( 'show' ),
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
				),
			),
			THIM_DIR . 'inc/widgets/single-images/'
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

function thim_single_images_register_widget() {
	register_widget( 'Single_Images_Widget' );
}

add_action( 'widgets_init', 'thim_single_images_register_widget' );