<?php
thim_customizer()->add_section( array(
	'title'     => __( 'LearnPress Archive', 'elearningwp' ),
	'id'       => 'display_learnpress',
	'panel'    => 'learnpress',
	'priority' => 2,
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Layout', 'elearningwp' ),
	'id'      => 'thim_learnpress_cate_layout',
	'type'    => 'radio-image',
	'section'     => 'display_learnpress',
	'choices' => array(
		'full-content'  => THIM_URI . 'assets/images/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/layout/sidebar-right.png',
	),
	'default' => 'sidebar-right'
) );

thim_customizer()->add_field( array(
	'label'    => __('Hide Breadcrumbs?','elearningwp'),
	'id'      => 'thim_learnpress_cate_hide_breadcrumbs',
	'type'    => 'switch',
	'section'     => 'display_learnpress',
	'tooltip'    => 'Check this box to hide/unhide',
	'default' => false,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'    => __('Hide Title','elearningwp'),
	'id'      => 'thim_learnpress_cate_hide_title',
	'type'    => 'switch',
	'section'     => 'display_learnpress',
	'tooltip'    => 'Check this box to hide/unhide',
	'default' => false,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Heading Layout', 'elearningwp' ),
	'id'      => 'thim_learnpress_cate_heading_layout',
	'type'    => 'radio-image',
	'section'     => 'display_learnpress',
	'choices' => array(
		'archive_1'  => THIM_URI . 'assets/images/heading/heading_course-1.jpg',
		'archive_2'  => THIM_URI . 'assets/images/heading/heading_course-2.jpg',
	),
	'default' => 'sidebar-right'
) );

thim_customizer()->add_field( array(
	'label'        => __('Background Heading Image','elearningwp'),
	'id'          => 'thim_learnpress_cate_top_image',
	'type'        => 'upload',
	'default'     => THIM_URI . 'assets/images/page-title.jpg',
	'section'     => 'display_learnpress',
	'desc'        => 'Enter URL or Upload an top image file for header',
	'livepreview' => ''
) );

thim_customizer()->add_field( array(
	'label'        => __('Background Heading Color','elearningwp'),
	'id'          => 'thim_learnpress_cate_heading_bg_color',
	'type'        => 'color',
	'section'     => 'display_learnpress',
	'livepreview' => ''
) );

thim_customizer()->add_field( array(
	'label'    => __('Color Heading','elearningwp'),
	'id'      => 'thim_learnpress_cate_heading_text_color',
	'type'    => 'color',
	'section'     => 'display_learnpress',
	'default' => '#fff',
) );

thim_customizer()->add_field( array(
	'label'    => __('Color Sub Heading','elearningwp'),
	'id'      => 'thim_learnpress_cate_sub_heading_text_color',
	'type'    => 'color',
	'section'     => 'display_learnpress',
	'default' => '#fff',
) );

thim_customizer()->add_field( array(
	'label'    => __('Sub Title','elearningwp'),
	'id'      => 'thim_learnpress_cate_sub_title',
	'type'    => 'text',
	'section'     => 'display_learnpress',
	'default' => '',
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Grid Column', 'elearningwp' ),
	'id'      => 'thim_learnpress_cate_grid_column',
	'type'    => 'select',
	'section'     => 'display_learnpress',
	'choices' => array(
		'2' => __( '2', 'elearningwp' ),
		'3' => __( '3', 'elearningwp' ),
		'4' => __( '4', 'elearningwp' )
	),
	'default' => '3',
) );

