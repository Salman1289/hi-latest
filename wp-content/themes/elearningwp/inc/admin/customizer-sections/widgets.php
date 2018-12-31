<?php

thim_customizer()->add_panel(
	array(
		'id'       => 'widgets',
		'priority' => 100,
		'title'    => esc_html__( 'Widgets', 'elearningwp' ),
		'icon'     => 'dashicons-welcome-widgets-menus'
	)
);