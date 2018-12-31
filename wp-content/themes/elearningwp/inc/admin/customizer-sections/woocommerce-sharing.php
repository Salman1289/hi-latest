<?php
thim_customizer()->add_section( array(
	'title'     => __( 'Sharing', 'elearningwp' ),
	'id'       => 'woo_share',
	'panel'    => 'woocommerce',
	'priority' => 4,
) );


thim_customizer()->add_field( array(
	'label'    => __( 'Facebook', 'elearningwp' ),
	'id'      => 'thim_woo_sharing_facebook',
	'type'    => 'switch',
	'section'     => 'woo_share',
	'tooltip'    => 'Check this box to hide/unhide',
	'default' => true,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Twitter', 'elearningwp' ),
	'id'      => 'thim_woo_sharing_twitter',
	'type'    => 'switch',
	'section'     => 'woo_share',
	'tooltip'    => 'Check this box to hide/unhide',
	'default' => true,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );


thim_customizer()->add_field( array(
	'label'    => __( 'Google Plus', 'elearningwp' ),
	'id'      => 'thim_woo_sharing_google',
	'type'    => 'switch',
	'section'     => 'woo_share',
	'tooltip'    => 'Check this box to hide/unhide',
	'default' => true,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Pinterest', 'elearningwp' ),
	'id'      => 'thim_woo_sharing_pinterest',
	'type'    => 'switch',
	'section'     => 'woo_share',
	'tooltip'    => 'Check this box to hide/unhide',
	'default' => true,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

