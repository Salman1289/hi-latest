<?php
$column  = 'col-sm-4';
$limit   = $instance['limit'];
$columns = $instance['columns'];
if ( $columns ) {
	$column = 'col-sm-' . ( 12 / $columns );
}
global $wpdb;

if ($instance['type'] == 'popular'){ // get instructor has popular courses (enrolled or finished)
	$courses   = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT p.ID, pm.meta_value FROM $wpdb->posts AS p
			INNER JOIN $wpdb->postmeta AS pm ON p.ID = pm.post_id
			WHERE p.post_type = %s
			AND p.post_status = %s
			AND pm.meta_key = %s",
			'lpr_course',
			'publish',
			'_lpr_course_user'
		)
	);
}else{ // get all instructor
	$courses = $wpdb->get_results(
		$wpdb->prepare("SELECT * FROM {$wpdb->usermeta} WHERE meta_value LIKE %s", '%lp_teacher%')
	);
}

$course_in = array();
if ( $courses ) {
	foreach ( $courses as $course ) {
		$course_in[$course->ID] = count( unserialize( $course->meta_value ) );
	}
	arsort( $course_in );
}

$instructor = array();
foreach ( $course_in as $course_id => $students ) {
	if ( count( $instructor ) == $limit ) {
		break;
	}
	$instructor_id = get_post_field( 'post_author', $course_id );
	if ( !isset( $instructor[$instructor_id] ) ) {
		$instructor[$instructor_id] = 1;
	}
}
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
	echo '</div>';
}
?>
<?php echo '<div class="wrapper-instruction row">';
foreach ( $instructor as $user_id => $course_id ) {
	$user_social = get_the_author_meta( 'lp_info', $user_id );
	$courses     = 0;
	if ( function_exists( 'learn_press_get_own_courses' ) ) {
		$courses = learn_press_get_own_courses( $user_id );
		if ( isset( $courses->post_count ) ) {
			$courses = $courses->post_count;
		}
	}

	echo '<div class="' . esc_attr( $column ) . '">';
	echo '<div class="avatar-instructors">' . get_avatar( $user_id, '480' );
	echo '<span class="number-courses">' . __( 'Courses by instructors', 'elearningwp' ) . ' <b>' . $courses . '</b></span>';
	echo '</div>';
	echo '<h5><a href="' . apply_filters( 'learn_press_instructor_profile_link', '#', $user_id, $course_id ) . '">' . get_the_author_meta( 'display_name', $user_id ) . '</a></h5>';
	echo '<div class="author-major">';
	echo '<span>' . ( isset( $user_social['major'] ) ? $user_social['major'] : __( 'Instructor', 'elearningwp' ) ) . '</span>';
	echo '</div>';
	echo '<div class="author-social">';
	echo '<a href="' . ( isset( $user_social['facebook'] ) ? $user_social['facebook'] : '#' ) . '"><i class="fa fa-facebook"></i></a>';
	echo '<a href="' . ( isset( $user_social['twitter'] ) ? $user_social['twitter'] : '#' ) . '"><i class="fa fa-twitter"></i></a>';
	echo '<a href="' . ( isset( $user_social['youtube'] ) ? $user_social['youtube'] : '#' ) . '"><i class="fa fa-youtube-play"></i></a>';
	echo '<a href="' . ( isset( $user_social['google'] ) ? $user_social['google'] : '#' ) . '"><i class="fa fa-google-plus"></i></a>';
	echo '<a href="' . ( isset( $user_social['linkedin'] ) ? $user_social['linkedin'] : '#' ) . '"><i class="fa fa-linkedin"></i></a>';
	echo '</div>';
	echo '</div>';
}
echo '</div>';
