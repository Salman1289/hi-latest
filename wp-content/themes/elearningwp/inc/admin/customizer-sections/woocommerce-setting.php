<?php
thim_customizer()->add_section( array(
	'title'     => 'Setting',
	'id'       => 'woo_setting',
	'panel'    => 'woocommerce',
	'priority' => 3,
) );

thim_customizer()->add_field( array(
	'label'    => 'Column',
	'id'      => 'thim_woo_product_column',
	'type'    => 'select',
	'section'     => 'woo_setting',
	'choices' => array(
		'2' => '2',// column bootstrap
		'3' => '3',
		'4' => '4',
 	),
	'default' => '4'
) );
thim_customizer()->add_field( array(
	'label'    => 'Number of Products per Page',
	'id'      => 'thim_woo_product_per_page',
	'type'    => 'number',
	'section'     => 'woo_setting',
	'desc'    => 'Insert the number of posts to display per page.',
	'default' => '8',
	'max'     => '100',
) );

thim_customizer()->add_field( array(
	'label'    => 'Number of Related products',
	'id'      => 'thim_woo_related_number',
	'type'    => 'number',
	'section'     => 'woo_setting',
	'desc'    => 'Insert the number of related to display per page.',
	'default' => '3',
	'max'     => '100',
) );

thim_customizer()->add_field( array(
	'label'    => 'Show Wishlist in products list',
	'id'      => 'thim_woo_set_show_wishlist',
	'type'    => 'switch',
	'tooltip'    => 'Check this box to hide/unhide',
	'section'     => 'woo_setting',
	'default' => true,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'    => 'Show Compare in products list',
	'id'      => 'thim_woo_set_show_compare',
	'type'    => 'switch',
	'tooltip'    => 'Check this box to hide/unhide',
	'section'     => 'woo_setting',
	'default' => true,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );
thim_customizer()->add_field( array(
	'label'    => 'Show QuickView in products list',
	'id'      => 'thim_woo_set_show_qv',
	'type'    => 'switch',
	'tooltip'    => 'Check this box to hide/unhide',
	'section'     => 'woo_setting',
	'default' => true,
	'choices'     => array(
		true  	  => __( 'On', 'elearningwp' ),
		false	  => __( 'Off', 'elearningwp' ),
	),
) );
