<?php

thim_customizer()->add_section( array(
	'title'     => esc_html__( 'Sharing', 'elearningwp' ),
	'panel'    => 'display',
	'id'       => 'display_sharing',
	'desc'     => esc_html__( 'Show social sharing button.', 'elearningwp' ),
	'position' => 6,
) );

thim_customizer()->add_field( array(
	'label'    => esc_html__('Facebook', 'elearningwp'),
	'id'      => 'thim_sharing_facebook',
	'section' => 'display_sharing',
	'type'    => 'checkbox',
	'default' => true,
) );

thim_customizer()->add_field( array(
	'label'    => esc_html__('Twitter', 'elearningwp'),
	'id'      => 'thim_sharing_twitter',
	'section' => 'display_sharing',
	'type'    => 'checkbox',
	'default' => true,
) );

thim_customizer()->add_field( array(
	'label'    => esc_html__('Google Plus', 'elearningwp'),
	'id'      => 'thim_sharing_google',
	'section' => 'display_sharing',
	'type'    => 'checkbox',
	'default' => true,
) );

thim_customizer()->add_field( array(
	'label'    => esc_html__('Pinterest', 'elearningwp'),
	'id'      => 'thim_sharing_pinterest',
	'section' => 'display_sharing',
	'type'    => 'checkbox',
	'default' => true,
) );

