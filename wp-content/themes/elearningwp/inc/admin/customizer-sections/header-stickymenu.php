<?php

// header Options
thim_customizer()->add_section( array(
	'title'     => __( 'Sticky Menu', 'elearningwp' ),
	'id'       => 'header-menu',
	'panel'	   => 'header',
	'priority' => 20,
) );

thim_customizer()->add_field( array(
	'id'          => 'thim_header_sticky',
	'type'        => 'switch',
	'label'       => __( 'Sticky Menu on scroll', 'elearningwp' ),
	'tooltip'     => __( 'Check to enable a fixed header when scrolling, uncheck to disable.', 'elearningwp' ),
	'section'     => 'header-menu',
	'default'     => true,
	'choices'     => array(
		true  	  => esc_html__( 'On', 'elearningwp' ),
		false	  => esc_html__( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Config Sticky Menu?', 'elearningwp' ),
	'desc'    => '',
	'section' => 'header-menu',
	'id'      => 'thim_config_att_sticky',
	'choices' => array(
		'sticky_same'   => 'The same with main menu',
		'sticky_custom' => 'Custom'
	),
	'type'    => 'select'
) );

// Background Header
thim_customizer()->add_field(
	array(
		'type'        => 'color',
		'label'    => __( 'Sticky Background color', 'elearningwp' ),
		'desc'    => __( 'Pick a background color for main menu', 'elearningwp' ),
		'section' => 'header-menu',
		'id'      => 'thim_sticky_bg_main_menu_color',
		'default' => '#222222',
		'alpha'       => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'body header#masthead.site-header.custom-sticky.affix',
				'property' => 'background-color',
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_config_att_sticky',
				'operator' => '===',
				'value'    => 'sticky_custom',
			),
		),
	)
);
// Text Color
thim_customizer()->add_field(
	array(
		'type'        => 'color',
		'label'    => __( 'Text color', 'elearningwp' ),
		'desc'    => __( 'Pick a text color for main menu', 'elearningwp' ),
		'section' => 'header-menu',
		'id'      => 'thim_sticky_main_menu_text_color',
		'default' => '#fff',
		'alpha'       => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'body header#masthead.site-header.affix.custom-sticky #primary-menu >li >a,
                               header#masthead.site-header.affix.custom-sticky #primary-menu >li >span',
				'property' => 'color',
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_config_att_sticky',
				'operator' => '===',
				'value'    => 'sticky_custom',
			),
		),
	)
);
// Text Hover Color
thim_customizer()->add_field(
	array(
		'type'        => 'color',
		'label'    => __( 'Text Hover color', 'elearningwp' ),
		'desc'    => __( 'Pick a text hover color for main menu', 'elearningwp' ),
		'section' => 'header-menu',
		'id'      => 'thim_sticky_main_menu_text_hover_color',
		'default' => '#00BCE4',
		'alpha'       => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'body header#masthead.site-header.affix.custom-sticky #primary-menu >li >a:hover,
                               body header#masthead.site-header.affix.custom-sticky #primary-menu >li >span:hover',
				'property' => 'color',
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_config_att_sticky',
				'operator' => '===',
				'value'    => 'sticky_custom',
			),
		),
	)
);