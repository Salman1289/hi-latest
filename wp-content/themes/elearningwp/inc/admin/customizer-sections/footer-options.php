<?php
thim_customizer()->add_section(
	array(
		'id'       => 'footer_options',
		'title'    => esc_html__( 'Settings', 'elearningwp' ),
		'panel'    => 'display_footer',
		'priority' => 10,
	)
);
thim_customizer()->add_field( array(
	'label'    => __( 'Select a Layout', 'elearningwp' ),
	'id'      => 'thim_footer_style',
	'type'    => 'radio-image',
	'section' => 'footer_options',
	'choices' => array(
		"footer_v1" => THIM_URI . 'assets/images/footer/footer_1.jpg',
		"footer_v2" => THIM_URI . 'assets/images/footer/footer_2.jpg',
	),
	'default' => 'footer_v1',
) );
thim_customizer()->add_field(
	array(
		'type'      => 'color',
		'id'        => 'thim_footer_title_font_color',
		'label'     => esc_html__( 'Footer Title Color', 'elearningwp' ),
		'section'   => 'footer_options',
		'default'   => '#00BCE4',
	)
);

thim_customizer()->add_field(
	array(
		'type'      => 'color',
		'id'        => 'thim_footer_text_font_color',
		'label'     => __( 'Footer Text Color', 'elearningwp' ),
		'section'   => 'footer_options',
		'default'   => '#989898',
	)
);

thim_customizer()->add_field( array(
	'label'     => __( 'Background Color', 'elearningwp' ),
	'id'        => 'thim_footer_bg_color',
	'type'      => 'color',
	'section'  	=> 'footer_options',
	'default'   => '#2C3238',
	'alpha'     => true,
	'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'choice'   => 'color',
			'element'  => '.site-footer',
			'property' => 'background-color',
		)
	)
) );

thim_customizer()->add_field(
	array(
		'id'       		=> 'thim_footer_background_img',
		'type'          => 'image',
		'section'  		=> 'footer_options',
		'label'    		=> __( 'Background image', 'elearningwp' ),
	)
);

thim_customizer()->add_field( array(
	"label"    => __( "Background Position", "elearningwp" ),
	"id"      => "thim_footer_bg_position",
	"section" => "footer_options",
	"default" => "center center",
	"type"    => "select",
	"choices" => array(
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
) );