<?php
/**
 * Panel General
 * 
 * @package Hair_Salon
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'general',
		'priority' => 1,
		'title'    => esc_html__( 'General', 'elearningwp' ),
		'icon'     => 'dashicons-admin-generic',
	)
);