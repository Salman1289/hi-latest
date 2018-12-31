<?php
/*
 * Post and Page Display Settings
 */
thim_customizer()->add_section( array(
	'title'    => __( 'Archive', 'elearningwp' ),
	'panel'    => 'display',
	'id'       => 'display_archive',
	'priority' => 2,
) );

thim_customizer()->add_field( array(
	'label'   => __( 'Front Page Layout', 'elearningwp' ),
	'id'      => 'thim_archive_cate_layout',
	'type'    => 'radio-image',
	'section' => 'display_archive',
	'choices' => array(
		'full-content'  => THIM_URI . 'assets/images/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/layout/sidebar-right.png',
	),
	'default' => 'sidebar-left'
) );

thim_customizer()->add_field( array(
	'label'   => __( 'Hide Breadcrumbs?', 'elearningwp' ),
	'id'      => 'thim_archive_cate_hide_breadcrumbs',
	'type'    => 'switch',
	'section' => 'display_archive',
	'tooltip' => 'Check this box to hide/unhide',
	'default' => false,
	'choices' => array(
		true  => __( 'On', 'elearningwp' ),
		false => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'   => __( 'Hide Title', 'elearningwp' ),
	'id'      => 'thim_archive_cate_hide_title',
	'type'    => 'switch',
	'section' => 'display_archive',
	'tooltip' => 'Check this box to hide/unhide',
	'default' => false,
	'choices' => array(
		true  => __( 'On', 'elearningwp' ),
		false => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'       => __( 'Background Heading Image', 'elearningwp' ),
	'id'          => 'thim_archive_cate_top_image',
	'type'        => 'upload',
	'default'     => THIM_URI . 'assets/images/page-title.jpg',
	'section'     => 'display_archive',
	'tooltip'     => 'Enter URL or Upload an top image file for header',
	'livepreview' => ''
) );

thim_customizer()->add_field( array(
	'label'       => __( 'Background Heading Color', 'elearningwp' ),
	'id'          => 'thim_archive_cate_heading_bg_color',
	'type'        => 'color',
	'section'     => 'display_archive',
	'livepreview' => ''
) );

thim_customizer()->add_field( array(
	'label'   => __( 'Color Heading', 'elearningwp' ),
	'id'      => 'thim_archive_cate_heading_text_color',
	'type'    => 'color',
	'section' => 'display_archive',
	'default' => '#fff',
) );

thim_customizer()->add_field( array(
	'label'   => __( 'Color Sub Heading', 'elearningwp' ),
	'id'      => 'thim_archive_cate_sub_heading_text_color',
	'type'    => 'color',
	'section' => 'display_archive',
	'default' => '#ffffff',
) );

thim_customizer()->add_field( array(
	'label'   => 'Sub Title',
	'id'      => 'thim_archive_cate_sub_title',
	'type'    => 'text',
	'section' => 'display_archive',
	'default' => '',
) );

thim_customizer()->add_field( array(
	'label'   => __( 'Excerpt Length', 'elearningwp' ),
	'id'      => 'thim_archive_excerpt_length',
	'type'    => 'number',
	'section' => 'display_archive',
	"desc"    => __( 'Enter the number of words you want to cut from the content to be the excerpt of search and archive and portfolio page.', 'elearningwp' ),
	'default' => '20',
	'max'     => '1000',
	'min'     => '10',
) );


thim_customizer()->add_field( array(
	'label'   => __( 'Show Author', 'elearningwp' ),
	'id'      => 'thim_show_author',
	'type'    => 'switch',
	'section' => 'display_archive',
	'tooltip' => 'Check this box to hide/unhide',
	'default' => false,
	'choices' => array(
		true  => __( 'On', 'elearningwp' ),
		false => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'   => __( 'Show Date', 'elearningwp' ),
	'id'      => 'thim_show_date',
	'type'    => 'switch',
	'section' => 'display_archive',
	'tooltip' => 'Check this box to hide/unhide',
	'default' => true,
	'choices' => array(
		true  => __( 'On', 'elearningwp' ),
		false => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'   => __( 'Show Comment', 'elearningwp' ),
	'id'      => 'thim_show_comment',
	'type'    => 'switch',
	'tooltip' => 'Check this box to hide/unhide',
	'section' => 'display_archive',
	'default' => true,
	'choices' => array(
		true  => __( 'On', 'elearningwp' ),
		false => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'   => __( 'Show Categories', 'elearningwp' ),
	'id'      => 'thim_show_categories',
	'type'    => 'switch',
	'section' => 'display_archive',
	'tooltip' => 'Check this box to hide/unhide',
	'default' => false,
	'choices' => array(
		true  => __( 'On', 'elearningwp' ),
		false => __( 'Off', 'elearningwp' ),
	),
) );