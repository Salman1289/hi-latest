<?php
// sub menu

thim_customizer()->add_section(
	array(
		'id'  		=> 'sub_menu',
		'title'  	=> __( 'Sub Menu', 'elearningwp' ),
		'panel'		=> 'header',
		'priority' 	=> 15,
	)
);
// Background Header
thim_customizer()->add_field(
	array(
		'id' 		=> 'thim_sub_menu_bg_color',
		'type' 		=> 'color',
		'label' 	=> __( 'Background color', 'elearningwp' ),
		'tooltip'     	=> __( 'Pick a background color for sub menu', ''),
		'section'   => 'sub_menu',
		'default'     => '#ffffff',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'header#masthead.site-header #primary-menu .sub-menu',
				'property' => 'background-color',
			)
		)
	)
);
// Text Color
thim_customizer()->add_field(
	array(
		'id'          => 'thim_sub_menu_text_color',
		'type'        => 'color',
		'label'       => __( "Text color", "elearningwp" ),
		'tooltip'     => __( "Pick a text color for sub menu", "elearningwp" ),
		'section'     => 'sub_menu',
		'default'     => '#AAAAAA',
		'alpha'       => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '#main_menu li .sub-menu li a',
				'property' => 'color',
			)
		)
	)
);
// Text Hover Color
thim_customizer()->add_field(
	array(
		'id'          => 'thim_sub_menu_text_color_hover',
		'type'        => 'color',
		'label'       => __( "Text color hover", "elearningwp" ),
		'tooltip'     => __( "Pick a text color hover for sub menu", "elearningwp" ),
		'section'     => 'sub_menu',
		'default'     => '#222222',
		'alpha'       => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'header#masthead.site-header .navigation #primary-menu .sub-menu a:hover,
                               header#masthead.site-header .navigation #primary-menu .sub-menu span:hover',
				'property' => 'color',
			)
		)
	)
);