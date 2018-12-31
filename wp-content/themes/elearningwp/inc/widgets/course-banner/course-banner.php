<?php

/**
 * Class Course_Banner_Widget
 *
 * Widget Name: Course Banner
 *
 * Author: vinhnq
 */
class Course_Banner_Widget extends Thim_Widget {

    function __construct() {
        parent::__construct(
            'course-banner',
            __( 'Thim: Course Banner', 'elearningwp' ),
            array(
                'description' => __( 'Show course banner', 'elearningwp' ),
                'help'        => '',
            ),
            array(),
            array(
                'heading_group'    => array(
                    'type'   => 'section',
                    'label'  => __( 'Heading', 'elearningwp' ),
                    'hide'   => true,
                    'fields' => array(
                        'title'               => array(
                            'type'                  => 'text',
                            'label'                 => __( 'Heading Text', 'elearningwp' ),
                            'default'               => __( "Popular Courses", "elearningwp" ),
                            'allow_html_formatting' => true
                        ),
                        'textcolor'           => array(
                            'type'  => 'color',
                            'label' => __( 'Text Heading color', 'elearningwp' ),
                            "class" => "color-mini",
                        ),
                        'size'                => array(
                            "type"    => "select",
                            "label"   => __( "Size Heading", "elearningwp" ),
                            "default" => "h3",
                            "options" => array(
                                "h2" => __( "h2", "elearningwp" ),
                                "h3" => __( "h3", "elearningwp" ),
                                "h4" => __( "h4", "elearningwp" ),
                                "h5" => __( "h5", "elearningwp" ),
                                "h6" => __( "h6", "elearningwp" )
                            ),
                            "class"   => "color-mini",
                        ),
                        'font_heading'        => array(
                            "type"          => "select",
                            "label"         => __( "Font Heading", "elearningwp" ),
                            "default"       => "default",
                            "options"       => array(
                                "default" => __( "Default", "elearningwp" ),
                                "custom"  => __( "Custom", "elearningwp" )
                            ),
                            "description"   => __( "Select Font heading.", "elearningwp" ),
                            'state_emitter' => array(
                                'callback' => 'select',
                                'args'     => array( 'font_heading_type' )
                            ),
                            "class"         => "color-mini",
                        ),
                        'custom_font_heading' => array(
                            'type'          => 'section',
                            'label'         => __( 'Custom Font Heading', 'elearningwp' ),
                            'hide'          => true,
                            "class"         => "clear-both",
                            'state_handler' => array(
                                'font_heading_type[custom]'  => array( 'show' ),
                                'font_heading_type[default]' => array( 'hide' ),
                            ),
                            'fields'        => array(
                                'custom_font_size'   => array(
                                    "type"        => "number",
                                    "label"       => __( "Font Size", "elearningwp" ),
                                    "suffix"      => "px",
                                    "default"     => "18",
                                    "description" => __( "custom font size", "elearningwp" ),
                                    "class"       => "color-mini",
                                ),
                                'custom_font_weight' => array(
                                    "type"        => "select",
                                    "label"       => __( "Custom Font Weight", "elearningwp" ),
                                    "options"     => array(
                                        "normal" => __( "Normal", "elearningwp" ),
                                        "bold"   => __( "Bold", "elearningwp" ),
                                        "100"    => __( "100", "elearningwp" ),
                                        "200"    => __( "200", "elearningwp" ),
                                        "300"    => __( "300", "elearningwp" ),
                                        "400"    => __( "400", "elearningwp" ),
                                        "500"    => __( "500", "elearningwp" ),
                                        "600"    => __( "600", "elearningwp" ),
                                        "700"    => __( "700", "elearningwp" ),
                                        "800"    => __( "800", "elearningwp" ),
                                        "900"    => __( "900", "elearningwp" )
                                    ),
                                    "description" => __( "Select Custom Font Weight", "elearningwp" ),
                                    "class"       => "color-mini",
                                ),
                            ),
                        ),
                    ),
                ),
                'banner_frames'  => array(
                    'type'      => 'repeater',
                    'label'     => __( 'Banner Frames', 'elearningwp' ),
                    'item_name' => __( 'Frame', 'elearningwp' ),
                    'fields'    => array(
                        'bg_image' => array(
                            'type'    => 'media',
                            'library' => 'image',
                            'label'   => __( 'Background Image', 'elearningwp' ),
                        ),
                        'icon' => array(
                            'type'    => 'media',
                            'library' => 'image',
                            'label'   => __( 'Icon', 'elearningwp' ),
                        ),
                        'cat_id'           => array(
                            'type'          => 'select',
                            'label'         => esc_html__( 'Select Category', 'elearningwp' ),
                            'default'       => 'all',
                            'hide'          => true,
                            'options'       => $this->thim_get_course_categories(),
                        ),
                        'type_banner'         => array(
                            'type'          => 'select',
                            'label'         => esc_html__( 'Type Banner', 'elearningwp' ),
                            'options'       => array(
                                'normal' => esc_html__( 'Normal', 'elearningwp' ),
                                'horizontal' => esc_html__( 'Horizontal', 'elearningwp' ),
                            ),
                            'default'       => 'normal',
                        ),
                    ),
                ),
                'cols'         => array(
                    'type'          => 'select',
                    'label'         => esc_html__( 'Column', 'elearningwp' ),
                    'options'       => array(
                        '1' => esc_html__( '1 Column', 'elearningwp' ),
                        '2' => esc_html__( '2 Columns', 'elearningwp' ),
                        '3' => esc_html__( '3 Columns', 'elearningwp' ),
                        '4' => esc_html__( '4 Columns', 'elearningwp' ),
                        '6' => esc_html__( '6 Columns', 'elearningwp' ),
                    ),
                    'default'       => '2',
                ),
            )
        );
    }

    function get_template_name( $instance ) {
        return 'base';
    }

    function get_style_name( $instance ) {
        return false;
    }

    // Get list category
    function thim_get_course_categories() {
        global $wpdb;
        $query = $wpdb->get_results( $wpdb->prepare(
            "
				  SELECT      t1.term_id, t2.name
				  FROM        $wpdb->term_taxonomy AS t1
				  INNER JOIN $wpdb->terms AS t2 ON t1.term_id = t2.term_id
				  WHERE t1.taxonomy = %s
				  AND t1.count > %d
				  ",
            'course_category', 0
        ) );

        $cats        = array();
        $cats['all'] = 'All';
        if ( ! empty( $query ) ) {
            foreach ( $query as $key => $value ) {
                $cats[ $value->term_id ] = $value->name;
            }
        }

        return $cats;
    }

}

/**
 * Register widget
 */
function thim_course_banner_register_widget() {
    register_widget( 'Course_Banner_Widget' );
}

add_action( 'widgets_init', 'thim_course_banner_register_widget' );
