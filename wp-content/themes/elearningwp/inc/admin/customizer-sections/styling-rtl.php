<?php

thim_customizer()->add_section( array(
    'title'     => __('Support','elearningwp'),
	'id'       => 'styling_rtl',
	'panel'    => 'styling',
	'priority' => 25,
) );

thim_customizer()->add_field( array(
	'label'    => __('RTL Support','elearningwp'),
	'id'      => 'thim_rtl_support',
	'type'    => 'switch',
	'section'     => 'styling_rtl',
	'default' => false,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'    => __('Preload','elearningwp'),
    'id'      => 'thim_preload',
    'type'    => 'switch',
	'section'     => 'styling_rtl',
    'default' => false,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

// Feature: Preload
thim_customizer()->add_field( array(
	'type'     => 'radio-image',
	'id'       => 'thim_display_preloading',
	'section'  => 'styling_rtl',
	'label'    => esc_html__( 'Preloading', 'elearningwp' ),
	'default'  => 'wandering-cubes',
	'priority' => 70,
	'choices'  => array(
		'off'             => THIM_URI . 'assets/images/preloading/off.jpg',
		'chasing-dots'    => THIM_URI . 'assets/images/preloading/chasing-dots.gif',
		'circle'          => THIM_URI . 'assets/images/preloading/circle.gif',
		'cube-grid'       => THIM_URI . 'assets/images/preloading/cube-grid.gif',
		'double-bounce'   => THIM_URI . 'assets/images/preloading/double-bounce.gif',
		'fading-circle'   => THIM_URI . 'assets/images/preloading/fading-circle.gif',
		'folding-cube'    => THIM_URI . 'assets/images/preloading/folding-cube.gif',
		'rotating-plane'  => THIM_URI . 'assets/images/preloading/rotating-plane.gif',
		'spinner-pulse'   => THIM_URI . 'assets/images/preloading/spinner-pulse.gif',
		'three-bounce'    => THIM_URI . 'assets/images/preloading/three-bounce.gif',
		'wandering-cubes' => THIM_URI . 'assets/images/preloading/wandering-cubes.gif',
		'wave'            => THIM_URI . 'assets/images/preloading/wave.gif',
	),
) );

// Feature: Preload Colors
thim_customizer()->add_field( array(
	'type'            => 'multicolor',
	'id'              => 'thim_display_preloading_style',
	'label'           => esc_html__( 'Preloading Style', 'elearningwp' ),
	'section'         => 'styling_rtl',
	'priority'        => 90,
	'choices'         => array(
		'background' => esc_html__( 'Background color', 'elearningwp' ),
		'color'      => esc_html__( 'Icon color', 'elearningwp' ),
	),
	'default'         => array(
		'background' => '#ffffff',
		'color'      => '#00BCE4',
	),
	'active_callback' => array(
		array(
			'setting'  => 'thim_display_preloading',
			'operator' => '!=',
			'value'    => 'off',
		),
	),
) );
