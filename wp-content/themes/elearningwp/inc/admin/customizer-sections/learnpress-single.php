<?php
thim_customizer()->add_section( array(
	'title'     => __( 'LearnPress Single', 'elearningwp' ),
	'id'       => 'display_learnpress_single',
	'panel'    => 'learnpress',
	'priority' => 3,
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Layout', 'elearningwp' ),
	'id'      => 'thim_learnpress_single_layout',
	'type'    => 'radio-image',
	'section'     => 'display_learnpress_single',
	'choices' => array(
		'full-content'  => THIM_URI . 'assets/images/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/layout/sidebar-right.png',
	),
	'default' => 'full-content'
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Hide Breadcrumbs?', 'elearningwp' ),
	'id'      => 'thim_learnpress_single_hide_breadcrumbs',
	'type'    => 'switch',
	'section'     => 'display_learnpress_single',
	'tooltip'    => 'Check this box to hide/unhide',
	'default' => false,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Hide Title', 'elearningwp' ),
	'id'      => 'thim_learnpress_single_hide_title',
	'type'    => 'switch',
	'section'     => 'display_learnpress_single',
	'tooltip'    => 'Check this box to hide/unhide',
	'default' => false,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'        => __( 'Background Heading Image', 'elearningwp' ),
	'id'          => 'thim_learnpress_single_top_image',
	'type'        => 'upload',
	'default'     => THIM_URI . 'assets/images/page-title.jpg',
	'section'     => 'display_learnpress_single',
	'desc'        => 'Enter URL or Upload an top image file for header',
	'livepreview' => ''
) );

thim_customizer()->add_field( array(
	'label'        => __( 'Background Heading Color', 'elearningwp' ),
	'id'          => 'thim_learnpress_single_heading_bg_color',
	'type'        => 'color',
	'section'     => 'display_learnpress_single',
	'livepreview' => ''
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Color Heading', 'elearningwp' ),
	'id'      => 'thim_learnpress_single_heading_text_color',
	'type'    => 'color',
	'section'     => 'display_learnpress_single',
	'default' => '#fff',
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Color Sub Heading', 'elearningwp' ),
	'id'      => 'thim_learnpress_single_sub_heading_text_color',
	'type'    => 'color',
	'section'     => 'display_learnpress_single',
	'default' => '#fff',
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Sub Title', 'elearningwp' ),
	'id'      => 'thim_learnpress_single_sub_title',
	'type'    => 'text',
	'section'     => 'display_learnpress_single',
	'default' => '',
) );