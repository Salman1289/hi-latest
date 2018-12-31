<?php

$column  = 'col-sm-4';
$limit   = $instance['limit'];
$columns = $instance['columns'];
if ( $columns ) {
	$column = 'col-sm-' . ( 12 / $columns );
}
global $wpdb;

?>
<?php
$css = $desc_css = '';
// css header
$css .= ( $instance['heading_group']['textcolor'] ) ? 'color:' . $instance['heading_group']['textcolor'] . ';' : '';
if ( $instance['heading_group']['font_heading'] == 'custom' ) {
	$css .= ( $instance['heading_group']['custom_font_heading']['custom_font_size'] ) ? 'font-size:' . $instance['heading_group']['custom_font_heading']['custom_font_size'] . 'px;line-height:' . $instance['heading_group']['custom_font_heading']['custom_font_size'] . 'px;' : '';
	$css .= ( $instance['heading_group']['custom_font_heading']['custom_font_weight'] ) ? 'font-weight:' . $instance['heading_group']['custom_font_heading']['custom_font_weight'] : '';
}
$css = ( $css ) ? 'style="' . $css . '"' : '';
//end css header
// css desc
$desc_css .= ( $instance['desc_group']['des_color'] != '' ) ? 'color: ' . $instance['desc_group']['des_color'] . ';' : '';
$desc_css .= ( $instance['desc_group']['des_font_size'] != '' ) ? 'font-size: ' . $instance['desc_group']['des_font_size'] . 'px;' : '';
$desc_css .= ( $instance['desc_group']['des_font_weight'] != '' ) ? 'font-weight: ' . $instance['desc_group']['des_font_weight'] . ';' : '';
$desc_css = ( $desc_css ) ? 'style="' . $desc_css . '"' : '';
//end css desc
if ( $instance['heading_group']['title'] ) {
	echo '<div class="widget-box-title">';
	echo '<' . $instance['heading_group']['size'] . ' ' . $css . ' class="title">' . $instance['heading_group']['title'] . '</' . $instance['heading_group']['size'] . '>';
	if ( $instance['desc_group']['des'] ) {
		echo '<p ' . $desc_css . '>' . $instance['desc_group']['des'] . '</p>';
	}
	if ( $instance['text_all'] != '' ) {
		echo '<a href="' . esc_url( $instance['link_all'] ) . '" class="browse-all-courses">' . $instance['text_all'] . '<i class="fa fa-angle-double-right"></i></a>';
	}
	echo '</div>';
}

$days_in_month = date( 't', mktime( 0, 0, 0, date( 'm' ), 1, date( 'Y' ) ) );
$start         = date( 'Y-m-d H:i:s', mktime( 0, 0, 0, date( 'm' ), 1, date( 'Y' ) ) );
$end           = date( 'Y-m-d H:i:s', mktime( 23, 59, 59, date( 'm' ), $days_in_month, date( 'Y' ) ) );

if ( $instance['type'] == 'popular' ) { // get instructor has popular courses (enrolled or finished)
	$query = $wpdb->prepare(
		"SELECT p.post_author as user_id
				FROM {$wpdb->prefix}learnpress_user_items ui
				INNER JOIN {$wpdb->posts} p ON p.ID = ui.item_id
				WHERE ui.item_type = %s AND ui.status IN (%s,%s) AND p.post_status = %s
				GROUP BY p.post_author",
		LP_COURSE_CPT,
		'enrolled',
		'finished',
		'publish'
	);
} else { // get all instructor
	$query = $wpdb->prepare( "SELECT * FROM {$wpdb->usermeta} WHERE meta_value LIKE %s", '%lp_teacher%' );
}

$instructor = $wpdb->get_results( $query );

$i             = 0;
$class_columns = '';

?>
<?php echo '<div class="wrapper-instruction row">';
foreach ( $instructor as $key => $users ) {
	$author  = learn_press_get_user( $users->user_id );
	$courses = $author->get( 'own-courses', array( 'limit' => 10 ) );

	//	echo '<pre>'; print_r( $courses ); echo '</pre>';
	$courses_quantity = sizeof( $courses );

	$i ++;
	if ( ( $i - 1 ) % $columns == 0 ) {
		$class_columns = 'first';
	} else {
		$class_columns = 'last';
	}
	if ( $i > $limit ) {
		break;
	}

	$user_social = get_the_author_meta( 'lp_info', $users->user_id );

	echo '<div class="' . esc_attr( $column ) . ' ' . esc_attr( $class_columns ) . '">';
	echo '<div class="avatar-instructors">' . get_avatar( $users->user_id, '480' );
	echo '<span class="number-courses">' . __( 'Courses by instructors', 'elearningwp' ) . ' <b>' . $courses_quantity . '</b></span>';
	echo '</div>';
	echo '<h5><a href="' . learn_press_user_profile_link( $users->user_id ) . '">' . get_the_author_meta( 'display_name', $users->user_id ) . '</a></h5>';
	echo '<div class="author-major">';
	echo '<span>' . ( isset( $user_social['major'] ) ? $user_social['major'] : __( 'Instructor', 'elearningwp' ) ) . '</span>';
	echo '</div>';
	echo '<div class="author-social">';

	if ( ! empty( $user_social['facebook'] ) ) {
		echo '<a href="' . esc_url( $user_social['facebook'] ) . '"><i class="fa fa-facebook"></i></a>';
	}

	if ( ! empty( $user_social['twitter'] ) ) {
		echo '<a href="' . esc_url( $user_social['twitter'] ) . '"><i class="fa fa-twitter"></i></a>';
	}

	if ( ! empty( $user_social['youtube'] ) ) {
		echo '<a href="' . esc_url( $user_social['youtube'] ) . '"><i class="fa fa-youtube-play"></i></a>';
	}

	if ( ! empty( $user_social['google'] ) ) {
		echo '<a href="' . esc_url( $user_social['google'] ) . '"><i class="fa fa-google-plus"></i></a>';
	}

	if ( ! empty( $user_social['linkedin'] ) ) {
		echo '<a href="' . esc_url( $user_social['linkedin'] ) . '"><i class="fa fa-linkedin"></i></a>';
	}

	echo '</div>';
	echo '</div>';
}
echo '</div>';
