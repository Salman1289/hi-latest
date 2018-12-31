<?php
/*
 * Creating a logo Options
 */

thim_customizer()->add_section(
	array(
		'id'             => 'title_tagline',
		'panel'    => 'general',
		'title'          => __( 'Logo', 'elearningwp' ),
		'priority'       => 1,
	)
);

thim_customizer()->add_field(
	array(
		'id'       		=> 'thim_logo',
		'type'          => 'image',
		'section'  		=> 'title_tagline',
		'label'    		=> __( 'Upload your logo', 'elearningwp' ),
		'tooltip'     	=> '',
		'priority' 		=> 10,
		'default'       => THIM_URI . "assets/images/logo.png",
	)
);
// Header Sticky Logo
thim_customizer()->add_field(
	array(
		'id'       		=> 'thim_sticky_logo',
		'type'          => 'image',
		'section'  		=> 'title_tagline',
		'label'    		=> __( 'Upload your sticky logo', 'elearningwp' ),
		'tooltip'     	=> '',
		'priority' 		=> 15,
		'default'       => THIM_URI . "assets/images/sticky-logo.png",
	)
);

thim_customizer()->add_field( array(
	'id'      => 'thim_width_logo',
	'type'    => 'number',
	'label'   => __( 'Width Logo', 'elearningwp' ),
	'section' => 'title_tagline',
	'default' => '127',
	'max'     => '1024',
	'min'     => '0',
	'step'    => '1',
	'desc'    => 'width logo (px)',
	'priority' 		=> 16,
) );
