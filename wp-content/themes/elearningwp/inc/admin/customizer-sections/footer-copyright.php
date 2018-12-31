<?php
thim_customizer()->add_section( array(
	'title'     => __( 'Copyright', 'elearningwp' ),
	'id'       => 'display_copyright',
	'panel'    => 'display_footer',
	'position' => 3,
) );

thim_customizer()->add_field( array(
	'label'        => __( 'Background Color', 'elearningwp' ),
	'id'          => 'thim_copyright_bg_color',
	'type'        => 'color',
	'section'  => 'display_copyright',
	'default'     => '#2C3238',
	'alpha'       => true,
	'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'choice'   => 'color',
			'element'  => '.copyright-area',
			'property' => 'background-color',
		)
	)
) );

thim_customizer()->add_field( array(
	'label'        => __( 'Text Color', 'elearningwp' ),
	'id'          => 'thim_copyright_text_color',
	'type'        => 'color',
	'section'  => 'display_copyright',
	'default'     => '#666666',
	'alpha'       => true,
	'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'choice'   => 'color',
			'element'  => '.copyright-area,.copyright-area a',
			'property' => 'color',
		)
	)
) );

$copy_right = 'http://www.thimpress.com';
thim_customizer()->add_field( array(
	'label'   	=> __( 'Copyright Text', 'elearningwp' ),
	'id'    	=> 'thim_copyright_text',
	'type'		=> 'textarea',
	'section'   => 'display_copyright',
	'default'   => 'eLearningWP &copy;2017. Powered By <a href="' . $copy_right . '">ThimPress.</a>',
) );

thim_customizer()->add_field( array(
	'id'          => 'thim_show_to_top',
	'type'        => 'switch',
	'label'       => __( 'Back To Top', 'elearningwp' ),
	'section'     => 'display_copyright',
	'default'     => true,
	'choices'     => array(
		true  	  => esc_html__( 'On', 'elearningwp' ),
		false	  => esc_html__( 'Off', 'elearningwp' ),
	),
) );