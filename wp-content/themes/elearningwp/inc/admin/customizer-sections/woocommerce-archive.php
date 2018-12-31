<?php
thim_customizer()->add_section( array(
	'title'     => __('Category Products','elearningwp'),
	'id'       => 'woo_archive',
	'panel'    => 'woocommerce',
	'priority' => 1,
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Archive Layout','elearningwp'),
	'id'      => 'thim_woo_cate_layout',
	'type'    => 'radio-image',
	'section'     => 'woo_archive',
	'choices' => array(
		'full-content'  => THIM_URI . 'assets/images/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/layout/sidebar-right.png',
	),
	'default' => 'sidebar-left'
) );

thim_customizer()->add_field( array(
	'label'    => __('Hide Breadcrumbs?','elearningwp'),
	'id'      => 'thim_woo_cate_hide_breadcrumbs',
	'type'    => 'switch',
	'section'     => 'woo_archive',
	'tooltip'    => 'Check this box to hide/unhide',
	'default' => false,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'    => __('Hide Title','elearningwp'),
	'id'      => 'thim_woo_cate_hide_title',
	'type'    => 'switch',
	'section'     => 'woo_archive',
	'tooltip'    => 'Check this box to hide/unhide',
	'default' => false,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'        => __('Background Heading Image','elearningwp'),
	'id'          => 'thim_woo_cate_top_image',
	'type'        => 'upload',
	'default'     => THIM_URI . 'assets/images/page-title.jpg',
	'section'     => 'woo_archive',
	'desc'        => 'Enter URL or Upload an top image file for header',
	'livepreview' => ''
) );

thim_customizer()->add_field( array(
	'label'        => __('Background Heading Color','elearningwp'),
	'id'          => 'thim_woo_cate_heading_bg_color',
	'type'        => 'color',
	'section'     => 'woo_archive',
	'livepreview' => ''
) );

thim_customizer()->add_field( array(
	'label'    => __('Color Heading','elearningwp'),
	'id'      => 'thim_woo_cate_heading_text_color',
	'type'    => 'color',
	'section'     => 'woo_archive',
	'default' => '#fff',
) );

thim_customizer()->add_field( array(
	'label'    => __('Color Sub Heading','elearningwp'),
	'id'      => 'thim_woo_cate_sub_heading_text_color',
	'type'    => 'color',
	'section'     => 'woo_archive',
	'default' => '#fff',
) );


thim_customizer()->add_field( array(
	'label'    => __('sub Title','elearningwp'),
	'id'      => 'thim_woo_cate_sub_title',
	'type'    => 'text',
	'section'     => 'woo_archive',
	'default' => '',
) );