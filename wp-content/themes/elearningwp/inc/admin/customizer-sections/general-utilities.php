<?php
/*
 * Group Utilities
 */

thim_customizer()->add_section(
	array(
		'id'       => 'utilities',
		'panel'    => 'general',
		'title'    => esc_html__( 'Utilities', 'elearningwp' ),
		'priority' => 10,
	)
);

// Login Redirect
thim_customizer()->add_field(
	array(
		'type'     => 'text',
		'id'       => 'thim_login_redirect',
		'section'  => 'utilities',
		'label'    => esc_html__( 'Login Redirect', 'elearningwp' ),
		'tooltip'  => esc_html__( 'Allows login redirect url. Blank will redirect to home page.', 'elearningwp' ),
		'priority' => 5,
	)
);