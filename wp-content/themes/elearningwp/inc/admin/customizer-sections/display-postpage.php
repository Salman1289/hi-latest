<?php
/*
 * Post and Page Display Settings
 */
thim_customizer()->add_section( array(
	'title'     =>  __( 'Post & Page', 'elearningwp' ),
	'panel'    => 'display',
	'id'       => 'display_postpage',
	'position' => 3,
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Single Layout', 'elearningwp' ),
	'id'      => 'thim_archive_single_layout',
	'type'    => 'radio-image',
	'section'       => 'display_postpage',
	'choices' => array(
		'full-content'  => THIM_URI . 'assets/images/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/layout/sidebar-right.png',
	),
	'default' => 'sidebar-left'
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Hide Breadcrumbs?', 'elearningwp' ),
	'id'      => 'thim_archive_single_hide_breadcrumbs',
	'type'    => 'switch',
	'section'       => 'display_postpage',
	'tooltip'    => 'Check this box to hide/unhide',
	'default' => false,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Hide Title', 'elearningwp' ),
	'id'      => 'thim_archive_single_hide_title',
	'type'    => 'switch',
	'section'       => 'display_postpage',
	'tooltip'    => 'Check this box to hide/unhide',
	'default' => false,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'        => __( 'Background Heading Image', 'elearningwp' ),
	'id'          => 'thim_archive_single_top_image',
	'type'        => 'upload',
	'default'     => THIM_URI . 'assets/images/page-title.jpg',
	'section'       => 'display_postpage',
	'desc'        => 'Enter URL or Upload an top image file for header',
	'livepreview' => ''
) );

thim_customizer()->add_field( array(
	'label'        => __( 'Background Heading Color', 'elearningwp' ),
	'id'          => 'thim_archive_single_heading_bg_color',
	'type'        => 'color',
	'section'       => 'display_postpage',
	'tooltip'   => esc_html__( 'If you do not use background image, then can use background color for page title on heading top. ', 'elearningwp' ),
	'livepreview' => ''
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Color Heading', 'elearningwp' ),
	'id'      => 'thim_archive_single_heading_text_color',
	'type'    => 'color',
	'section'       => 'display_postpage',
	'default' => '#fff',
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Color Sub Heading', 'elearningwp' ),
	'id'      => 'thim_archive_single_sub_heading_text_color',
	'type'    => 'color',
	'section'       => 'display_postpage',
	'default' => '#fff',
) );