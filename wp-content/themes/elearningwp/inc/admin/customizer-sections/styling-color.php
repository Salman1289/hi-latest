<?php
thim_customizer()->add_section( array(
	'title'     => __( 'Color', 'elearningwp' ),
	'panel'    => 'styling',
	'id'       => 'styling_color',
	'position' => 10,
) );


thim_customizer()->add_field( array(
	'label'        => __( 'Body Background Color', 'elearningwp' ),
	'id'          => 'thim_body_bg_color',
	'type'        => 'color',
	'section'     => 'styling_color',
	'default'     => '#ffffff',
	'priority'    => 10,
	'alpha'       => true,
	'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'choice'   => 'color',
			'element'  => 'body',
			'property' => 'background-color',
		)
	)
) );

thim_customizer()->add_field( array(
	'label'        => __( 'Theme Primary Color', 'elearningwp' ),
	'id'          => 'thim_body_primary_color',
	'type'        => 'color',
	'section'     => 'styling_color',
	'default'     => '#00BCE4',
	'priority'    => 15,
	'alpha'       => true,
	'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'choice'   => 'color',
			'element'  => 'body',
			'property' => 'background-color',
		)
	)
) );

thim_customizer()->add_field( array(
	'id'   => 'thim_body_bg_upload',
	'label' => __( 'Upload Background', 'elearningwp' ),
	'type' => 'upload',
	'section' => 'styling_color',
	'default'  => '',
) );

thim_customizer()->add_field( array(
	'label'    => 'Background Repeat',
	'id'      => 'thim_body_bg_repeat',
	'type'    => 'select',
	'section'  => 'styling_color',
	'choices' => array(
		'repeat'    => 'repeat',
		'repeat-x'  => 'repeat-x',
		'repeat-y'  => 'repeat-y',
		'no-repeat' => 'no-repeat'
	),
	'default' => 'no-repeat'
) );

thim_customizer()->add_field( array(
	'label'    => 'Background Position',
	'id'      => 'thim_body_bg_position',
	'type'    => 'select',
	'section'  => 'styling_color',
	'choices' => array(
		'left top'      => 'Left Top',
		'left center'   => 'Left Center',
		'left bottom'   => 'Left Bottom',
		'right top'     => 'Right Top',
		'right center'  => 'Right Center',
		'right bottom'  => 'Right Bottom',
		'center top'    => 'Center Top',
		'center center' => 'Center Center',
		'center bottom' => 'Center Bottom'
	),
	'default' => 'center center'
) );

thim_customizer()->add_field( array(
	'label'    => 'Background Attachment',
	'id'      => 'thim_body_bg_attachment',
	'type'    => 'select',
	'section'  => 'styling_color',
	'choices' => array(
		'scroll'  => 'scroll',
		'fixed'   => 'fixed',
		'local'   => 'local',
		'initial' => 'initial',
		'inherit' => 'inherit'
	),
	'default' => 'inherit'
) );

thim_customizer()->add_field( array(
	'label'    => 'Background Size',
	'id'      => 'thim_body_bg_size',
	'type'    => 'select',
	'section'  => 'styling_color',
	'choices' => array(
		'100% 100%' => '100% 100%',
		'contain'   => 'contain',
		'cover'     => 'cover',
		'inherit'   => 'inherit',
		'initial'   => 'initial'
	),
	'default' => 'inherit'
) );