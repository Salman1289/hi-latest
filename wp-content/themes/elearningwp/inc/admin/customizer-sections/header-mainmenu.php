<?php
$font_sizes = array(
	'10px' => '10px',
	'11px' => '11px',
	'12px' => '12px',
	'13px' => '13px',
	'14px' => '14px',
	'15px' => '15px',
	'16px' => '16px',
	'17px' => '17px',
	'18px' => '18px',
	'19px' => '19px',
	'20px' => '20px',
	'21px' => '21px',
	'22px' => '22px',
	'23px' => '23px',
	'24px' => '24px',
	'25px' => '25px',
	'26px' => '26px',
	'27px' => '27px',
	'28px' => '28px',
	'29px' => '29px',
	'30px' => '30px',
	'31px' => '31px',
	'32px' => '32px',
	'33px' => '33px',
	'34px' => '34px',
	'35px' => '35px',
	'36px' => '36px',
	'37px' => '37px',
	'38px' => '38px',
	'39px' => '39px',
	'40px' => '40px',
	'41px' => '41px',
	'42px' => '42px',
	'43px' => '43px',
	'44px' => '44px',
	'45px' => '45px',
	'46px' => '46px',
	'47px' => '47px',
	'48px' => '48px',
	'49px' => '49px',
	'50px' => '50px',
);
// main menu
thim_customizer()->add_section( array(
	'title'     => __( 'Main Menu', 'elearningwp' ),
	'id'       => 'mainmenu',
	'panel'	   => 'header',
	'priority' => 10,
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Select a Layout', 'elearningwp' ),
	'id'      => 'thim_header_style',
	'type'    => 'radio-image',
	'section' => 'mainmenu',
	'choices' => array(
		"header_v1" => THIM_URI . 'assets/images/header/header_1.jpg',
		"header_v2" => THIM_URI . 'assets/images/header/header_2.jpg',
		"header_v3" => THIM_URI . 'assets/images/header/header_3.jpg',
		"header_v4" => THIM_URI . 'assets/images/header/header_4.jpg',
		"header_v5" => THIM_URI . 'assets/images/header/header_5.jpg',
	),
	'default' => 'header_v4',
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Header Position', 'elearningwp' ),
	'id'      => 'thim_header_position',
	'type'    => 'select',
	'section' => 'mainmenu',
	'choices' => array(
		'header_default' => __( 'Default', 'elearningwp' ),
		'header_overlay' => __( 'Overlay', 'elearningwp' ),
	),
	'default' => 'header_overlay',
) );

thim_customizer()->add_field( array(
	"label"     => __( "Background color", "elearningwp" ),
	"desc"      => __( "Pick a background color for main menu", "elearningwp" ),
	"id"        => "thim_bg_main_menu_color",
	'section'   => 'mainmenu',
	"default"   => "rgba(10,10,10,0.6)",
	"type"      => "color",
	"alpha"     => true,
	"transport" => "postMessage",
	"js_vars"   => array(
		array(
			"choice"   => "color",
			"element"  => "body #masthead.site-header",
			"property" => "background-color",
		)
	)
) );

thim_customizer()->add_field( array(
	"label"    => __( "Text color", "elearningwp" ),
	"desc"    => __( "Pick a text color for main menu", "elearningwp" ),
	"id"      => "thim_main_menu_text_color",
	'section' => 'mainmenu',
	"default" => "#C8C8C8",
	"type"      => "color",
	"alpha"     => true,
	"transport" => "postMessage",
	"js_vars"   => array(
		array(
			"choice"   => "color",
			"element"  => "body #masthead.site-header",
			"property" => "background-color",
		)
	)
) );

thim_customizer()->add_field( array(
	"label"    => __( "Text Hover color", "elearningwp" ),
	"desc"    => __( "Pick a text hover color for main menu", "elearningwp" ),
	"id"      => "thim_main_menu_text_hover_color",
	'section' => 'mainmenu',
	"default" => "#00BCE4",
	"type"      => "color",
	"alpha"     => true,
	"transport" => "postMessage",
	"js_vars"   => array(
		array(
			"choice"   => "color",
			"element"  => "body #masthead.site-header",
			"property" => "background-color",
		)
	)
) );

thim_customizer()->add_field( array(
	"label"    => __( "Font Size", "elearningwp" ),
	"desc"    => "Default is 13",
	"id"      => "thim_font_size_main_menu",
	'section' => 'mainmenu',
	"default" => "16px",
	"type"    => "select",
	"choices" => $font_sizes
) );

thim_customizer()->add_field( array(
	"label"    => __( "Font Weight", "elearningwp" ),
	"desc"    => "Default bold",
	"id"      => "thim_font_weight_main_menu",
	'section' => 'mainmenu',
	"default" => "700",
	"type"    => "select",
	"choices" => array(
		'bold'   => 'Bold',
		'normal' => 'Normal',
		'100'    => '100',
		'200'    => '200',
		'300'    => '300',
		'400'    => '400',
		'500'    => '500',
		'600'    => '600',
		'700'    => '700',
		'800'    => '800',
		'900'    => '900'
	),
) );