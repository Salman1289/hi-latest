<?php

thim_customizer()->add_section(
	array(
		'id'       => 'forum_archive',
		'panel'    => 'forum',
		'title'    => esc_html__( 'Forum', 'elearningwp' ),
		'priority' => 10,
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'thim_forum_cate_layout',
		'type'     => 'radio-image',
		'label'    => esc_html__( 'Layout', 'elearningwp' ),
		'tooltip'  => esc_html__( 'Allows you to choose a layout for all forum archive pages.', 'elearningwp' ),
		'section'  => 'forum_archive',
		'priority' => 12,
		'default'  => 'sidebar-right',
		'choices'  => array(
			'sidebar-left'  => THIM_URI . 'assets/images/layout/sidebar-left.png',
			'full-content'  => THIM_URI . 'assets/images/layout/body-full.png',
			'sidebar-right' => THIM_URI . 'assets/images/layout/sidebar-right.png',
		),
	)
);

// Enable or disable breadcrumbs
thim_customizer()->add_field(
	array(
		'id'       => 'thim_forum_cate_hide_breadcrumbs',
		'type'     => 'switch',
		'label'    => esc_html__( 'Hide Breadcrumbs?', 'elearningwp' ),
		'tooltip'  => esc_html__( 'Check this box to hide/show breadcrumbs.', 'elearningwp' ),
		'section'  => 'forum_archive',
		'default'  => false,
		'priority' => 15,
		'choices'  => array(
			true  => esc_html__( 'On', 'elearningwp' ),
			false => esc_html__( 'Off', 'elearningwp' ),
		),
	)
);

// Enable or disable title
thim_customizer()->add_field(
	array(
		'id'       => 'thim_forum_cate_hide_title',
		'type'     => 'switch',
		'label'    => esc_html__( 'Hide Title', 'elearningwp' ),
		'tooltip'  => esc_html__( 'Check this box to hide/show title.', 'elearningwp' ),
		'section'  => 'forum_archive',
		'default'  => false,
		'priority' => 18,
		'choices'  => array(
			true  => esc_html__( 'On', 'elearningwp' ),
			false => esc_html__( 'Off', 'elearningwp' ),
		),
	)
);

thim_customizer()->add_field( array(
	'label'    => esc_html__( 'Sub Title', 'elearningwp' ),
	'id'       => 'thim_forum_cate_sub_title',
	'type'     => 'text',
	'section'  => 'forum_archive',
	'priority' => 19,
	'default'  => '',
) );

thim_customizer()->add_field(
	array(
		'type'      => 'image',
		'id'        => 'thim_forum_cate_top_image',
		'label'     => esc_html__( 'Background Heading Image', 'elearningwp' ),
		'priority'  => 30,
		'transport' => 'postMessage',
		'section'   => 'forum_archive',
		'default'   => THIM_URI . 'assets/images/page-title.jpg',
	)
);

// Page Title Background Color
thim_customizer()->add_field(
	array(
		'id'        => 'thim_forum_cate_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Background Heading Color', 'elearningwp' ),
		'tooltip'   => esc_html__( 'If you do not use background image, then can use background color for page title on heading top. ', 'elearningwp' ),
		'section'   => 'forum_archive',
		'default'   => 'rgba(0,0,0,0.5)',
		'priority'  => 35,
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top_site_main>.overlay-top-header',
				'property' => 'background',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_forum_cate_title_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Title Color', 'elearningwp' ),
		'tooltip'   => esc_html__( 'Allows you can select a color make text color for title.', 'elearningwp' ),
		'section'   => 'forum_archive',
		'default'   => '#ffffff',
		'priority'  => 40,
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top_site_main h1, .top_site_main h2',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_forum_cate_sub_title_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Sub Title Color', 'elearningwp' ),
		'tooltip'   => esc_html__( 'Allows you can select a color make sub title color page title.', 'elearningwp' ),
		'section'   => 'forum_archive',
		'default'   => '#999',
		'priority'  => 45,
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top_site_main .banner-description',
				'property' => 'color',
			)
		)
	)
);