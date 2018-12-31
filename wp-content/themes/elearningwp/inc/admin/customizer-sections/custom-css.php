<?php
/*thim_customizer()->add_section(
	array(
		'id'             => 'custom',
		'title'          => esc_html__( 'Custom CSS', 'elearningwp' ),
		'priority'       => 10,
	)
);

thim_customizer()->add_field( array(
	'type'            => 'textarea',
	'id'              => 'thim_custom-css',
	'label'           => esc_html__( 'Custom CSS', 'elearningwp' ),
	'tooltip'         => '',
	'section'         => 'custom',
	'default'         => '',
	'priority'        => 100,
	'transport'       => 'postMessage',
) );
*/

thim_customizer()->add_section(
	array(
		'id'       => 'custom_css',
		'priority' => 110,
		'title'    => esc_html__( 'Additional CSS', 'elearningwp' ),
		'icon'     => 'dashicons-edit'
	)
);
