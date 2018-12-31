<?php
thim_customizer()->add_section( array(
	'title'    => __( 'Layout', 'elearningwp' ),
	'id'       => 'styling_layout',
	'panel'    => 'styling',
	'position' => 15,
) );
thim_customizer()->add_field( array(
	'label'    => esc_html__( 'Body layout','elearningwp' ),
	'id'      => 'box_layout',
	'type'    => 'select',
	'section'  => 'styling_layout',
	'choices' => array(
		'boxed' => 'Boxed',
		'wide'  => 'Wide',
	),
	'default' => 'wide'
) );
