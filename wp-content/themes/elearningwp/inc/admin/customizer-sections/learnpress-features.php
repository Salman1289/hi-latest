<?php
thim_customizer()->add_section( array(
	'title'     => esc_html__( 'LearnPress Features', 'elearningwp' ),
	'id'       => 'learnpress_features',
	'panel'    => 'learnpress',
	'priority' => 5,
) );

thim_customizer()->add_field( array(
	'label'    => esc_html__( 'Hidden Ads', 'elearningwp' ),
	'id'      => 'thim_learnpress_hidden_ads',
	'type'    => 'switch',
	'section'     => 'learnpress_features',
	'tooltip'    => 'Check this box to hide/unhide',
	'default' => false,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );