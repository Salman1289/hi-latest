<?php

thim_customizer()->add_section( array(
	'title'     => esc_html__( 'Pattern','elearningwp' ),
	'id'       => 'styling_pattern',
	'panel'    => 'styling',
	'position' => 20,
) );


thim_customizer()->add_field( array(
	'label'    => __( 'Background Pattern', 'elearningwp' ),
	'id'      => 'thim_user_bg_pattern',
	'type'    => 'switch',
	'tooltip'    => __( 'Check the box to display a pattern in the background. If checked, select the pattern from below.', 'elearningwp' ),
	'section'  => 'styling_pattern',
	'default' => false,
	'choices'  => array(
		true  => __( 'On', 'elearningwp' ),
		false => __( 'Off', 'elearningwp' ),
	),
) );

thim_customizer()->add_field( array(
	'label'    => __( 'Select a Background Pattern', 'elearningwp' ),
	'id'      => 'thim_bg_pattern',
	'type'    => 'radio-image',
	'section'  => 'styling_pattern',
	'default'         => THIM_URI . "assets/images/patterns/pattern1.png",
	'choices' => array(
		THIM_URI . "assets/images/patterns/pattern1.png"  => THIM_URI . "assets/images/patterns/pattern1.png",
		THIM_URI . "assets/images/patterns/pattern2.png"  => THIM_URI . "assets/images/patterns/pattern2.png",
		THIM_URI . "assets/images/patterns/pattern3.png"  => THIM_URI . "assets/images/patterns/pattern3.png",
		THIM_URI . "assets/images/patterns/pattern4.png"  => THIM_URI . "assets/images/patterns/pattern4.png",
		THIM_URI . "assets/images/patterns/pattern5.png"  => THIM_URI . "assets/images/patterns/pattern5.png",
		THIM_URI . "assets/images/patterns/pattern6.png"  => THIM_URI . "assets/images/patterns/pattern6.png",
		THIM_URI . "assets/images/patterns/pattern7.png"  => THIM_URI . "assets/images/patterns/pattern7.png",
		THIM_URI . "assets/images/patterns/pattern8.png"  => THIM_URI . "assets/images/patterns/pattern8.png",
		THIM_URI . "assets/images/patterns/pattern9.png"  => THIM_URI . "assets/images/patterns/pattern9.png",
		THIM_URI . "assets/images/patterns/pattern10.png" => THIM_URI . "assets/images/patterns/pattern10.png",
	)
) );