<?php

if ( is_admin() ) {
	/*
	   * prefix of meta keys, optional
	   */
	$prefix = 'thim_';

	/*
	   * configure your meta box
	   */
	$config = array(
		'id'             => 'category_meta_box',
		// meta box id, unique per meta box
		'title'          => esc_html__('Category Meta Box', 'elearningwp'),
		// meta box title
		'pages'          => array( 'category', 'product_cat', 'course_category' ),
		// taxonomy name, accept categories, post_tag and custom taxonomies
		'context'        => 'normal',
		// where the meta box appear: normal (default), advanced, side; optional
		'fields'         => array(),
		// list of meta fields (can be added by field arrays)
		'local_images'   => false,
		// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => get_template_directory_uri() . '/inc/libs/Tax-meta-class'
		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	$taxonomy = !empty( $_REQUEST['taxonomy'] ) ? $_REQUEST['taxonomy'] : 'category';
	if ( $taxonomy == 'product_cat' ) {
		$top_prefix = 'woo_';
		$cate_prefix = 'woo_cate_';
	} elseif ( $taxonomy == 'course_category' ) {
		$top_prefix = 'learnpress_';
		$cate_prefix = 'learnpress_cate_';
	} else {
		$top_prefix = 'archive_';
		$cate_prefix = '';
	}

	$my_meta            = new Tax_Meta_Class( $config );


	$my_meta->addSelect( $prefix . 'layout', array(
		''              => esc_html__('Using in Theme Option', 'elearningwp'),
		'full-content'  => esc_html__('No Sidebar', 'elearningwp'),
		'sidebar-left'  => esc_html__('Left Sidebar', 'elearningwp'),
		'sidebar-right' => esc_html__('Right Sidebar', 'elearningwp')
	), array( 'name' => esc_html__( 'Custom Layout ', 'elearningwp' ), 'std' => array( '' ) ) );

	$my_meta->addSelect( $prefix . 'custom_heading', array(
		''       => esc_html__('Using in Theme Option', 'elearningwp'),
		'custom' => esc_html__('Custom',  'elearningwp'),
	), array( 'name' => esc_html__( 'Custom Heading ', 'elearningwp' ), 'std' => array( '' ) ) );

	//$my_meta->addImage( $prefix . $top_prefix . 'top_image', array( 'name' => esc_html__( 'Background Image Heading', 'elearningwp' ) ) );
	//$my_meta->addColor( $prefix . $cate_prefix . 'heading_bg_color', array( 'name' => esc_html__( 'Background Color Heading', 'elearningwp' ) ) );
	//$my_meta->addColor( $prefix . $cate_prefix . 'heading_text_color', array( 'name' => esc_html__( 'Text Color Heading', 'elearningwp' ) ) );
	//$my_meta->addColor( $prefix . $cate_prefix . 'sub_heading_text_color', array( 'name' => esc_html__( 'Color Description Category', 'elearningwp' ) ) );
	//$my_meta->addCheckbox( $prefix . $cate_prefix . 'hide_title', array( 'name' => esc_html__( 'Hide Title', 'elearningwp' ) ) );
	//$my_meta->addCheckbox( $prefix . $cate_prefix . 'hide_breadcrumbs', array( 'name' => esc_html__( 'Hide Breadcrumbs', 'elearningwp' ) ) );
	//$my_meta->addText( $prefix . $cate_prefix . 'sub_title', array( 'name' => esc_html__( 'Sub Title', 'elearningwp' ) ) );
	$my_meta->Finish();
}
