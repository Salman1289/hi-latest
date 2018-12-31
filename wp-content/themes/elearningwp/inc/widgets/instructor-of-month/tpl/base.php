<?php
$limit = $instance['limit'];

global $wpdb;
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
$course_in = array();
if ( $courses ) {
	foreach ( $courses as $course ) {
		$course_in[ $course->ID ] = count( unserialize( $course->meta_value ) );
	}
	arsort( $course_in );
}

$instructor_id = 0;
foreach ( $course_in as $course_id => $students ) {
	$uid = get_post_field( 'post_author', $course_id );
	if ( isset( $uid ) ) {
		$instructor_id = $uid;
		break;
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
echo '<div class="wrapper-instruction-of-month row">';
$user_social = get_the_author_meta( 'lp_info', $instructor_id );
$courses     = 0;
if ( function_exists( 'learn_press_get_own_courses' ) ) {
	$courses = learn_press_get_own_courses( $instructor_id );
	if ( isset( $courses->post_count ) ) {
		$courses = $courses->post_count;
	}
}
?>
<div class="col-sm-6 wrapper-author">
	<div class="avatar-instructors">
		<?php echo get_avatar( $instructor_id, 480 ); ?>
	</div>
	<div class="author-right"><h5>
			<a href="<?php echo apply_filters( 'learn_press_instructor_profile_link', '#', $instructor_id, '' ); ?>"><?php echo get_the_author_meta( 'display_name', $instructor_id ); ?></a>
		</h5>

		<div class="author-major"><?php echo '<span>' . ( isset( $user_social['major'] ) ? $user_social['major'] : __( 'Instructor', 'elearningwp' ) ) . '</span>'; ?></div>
			<span class="number-courses"><?php esc_html_e( 'Courses by instructors ', 'elearningwp' ); ?>
				<b><?php echo $courses ?></b></span>

		<div class="desc-author"><?php echo get_the_author_meta( 'description', $instructor_id ) ?></div>
		<div class="author-social">
			<?php
			echo '<a href="' . ( isset( $user_social['facebook'] ) ? $user_social['facebook'] : '#' ) . '"><i class="fa fa-facebook"></i></a>';
			echo '<a href="' . ( isset( $user_social['twitter'] ) ? $user_social['twitter'] : '#' ) . '"><i class="fa fa-twitter"></i></a>';
			echo '<a href="' . ( isset( $user_social['youtube'] ) ? $user_social['youtube'] : '#' ) . '"><i class="fa fa-youtube-play"></i></a>';
			?>
		</div>
	</div>
</div>
<div class="col-sm-6">
	<?php
	if ( function_exists( 'learn_press_get_own_courses' ) ) {
		$courses     = learn_press_get_own_courses( $instructor_id );
		$all_courses = $courses->posts;
	}
	$count = 0;
	foreach ( $all_courses as $is => $course ) {
		$count ++;
		if ( $count > $limit ) {
			break;
		}
		?>
		<div class="item-course">
			<div class="wrapper-course-thumbnail">
				<a class="course-thumbnail" href="<?php echo get_the_permalink( $course->ID ) ?>" aria-hidden="true">
					<?php echo get_the_post_thumbnail( $course->ID, array( 126, 126 ) ); ?>
				</a>
			</div>
			<div class="item-course-right">
				<h2 class="course-title" itemprop="name">
					<a href="<?php echo get_the_permalink( $course->ID ) ?>" rel="bookmark"><?php echo $course->post_title ?></a>
				</h2>
				<!-- .entry-header -->
				<div class="author" aria-hidden="true">
					<?php esc_html_e( 'Teacher:', 'elearningwp' ); ?>
					<a href="#" itemprop="url"><?php echo get_the_author_meta( 'display_name', $instructor_id ); ?></a>
				</div>
				<?php
				$rated = learn_press_get_course_rate( $course->ID );
				?>
				<div class="review-stars-rated">
					<div class="review-stars thim-review">
						<span style="width:<?php echo esc_attr( $rated ) * 20; ?>%;"></span>
					</div>
				</div>
				<!-- .entry-footer -->
			</div>
		</div>
		<?php
	}
	?>
	<a href="<?php echo apply_filters( 'learn_press_instructor_profile_link', '#', $instructor_id, '' ); ?>" class="link-readmore"><?php esc_html_e( 'Browse All Courses by ', 'elearningwp' ); ?><?php echo get_the_author_meta( 'display_name', $instructor_id ) ?>
		<i class="fa fa-angle-double-right"></i></a>
</div>
</div>