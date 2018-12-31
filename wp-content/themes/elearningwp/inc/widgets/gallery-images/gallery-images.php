<?php

class Gallery_Images_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'gallery-images',
			__( 'Thim: Gallery Images', 'elearningwp' ),
			array(
				'description' => __( 'Add gallery image', 'elearningwp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon' => 'dashicons dashicons-welcome-learn-more thim_widgets_gallery_images'
			),
			array(),
			array(
				'image'         => array(
					'type'        => 'multimedia',
					'label'       => __( 'Image', 'elearningwp' ),
					'description' => __( 'Select image from media library.', 'elearningwp' )
				),

				'image_size'    => array(
					'type'        => 'text',
					'label'       => __( 'Image size', 'elearningwp' ),
					'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full"', 'elearningwp' )
				),
//				'image_link'    => array(
//					'type'        => 'text',
//					'label'       => __( 'Image Link', 'elearningwp' ),
//					'description' => __( 'Enter URL if you want this image to have a link. These links are separated by comma (Ex: #,#,#,#)', 'elearningwp' )
//				),
				'number'        => array(
					'type'    => 'number',
					'default' => '4',
					'label'   => __( 'Number Image Per View', 'elearningwp' ),
				),
				'link_target'   => array(
					"type"    => "select",
					"label"   => __( "Link Target", "elearningwp" ),
					"options" => array(
						"_self"  => __( "Same window", "elearningwp" ),
						"_blank" => __( "New window", "elearningwp" ),
					),
				),
				'gallery_layout'   => array(
					"type"    => "select",
					"label"   => __( "Gallery Layout", "elearningwp" ),
					"options" => array(
						"default"  => __( "Default", "elearningwp" ),
						"slider" => __( "Slider", "elearningwp" ),
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
			THIM_DIR . 'inc/widgets/gallery-images/'
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
		wp_enqueue_script( 'thim-owl-carousel' );
		wp_enqueue_script( 'gallery-images', THIM_URI . 'inc/widgets/gallery-images/js/gallery-images.js', array( 'jquery' ), '', false );
	}
}


function thim_gallery_images_widget() {
	register_widget( 'Gallery_Images_Widget' );
}

add_action( 'widgets_init', 'thim_gallery_images_widget' );