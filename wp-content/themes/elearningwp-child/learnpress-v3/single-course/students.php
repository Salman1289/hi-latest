<?php
/**
 * Template for displaying students of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/students.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course = isset($course_id) ? learn_press_get_course($course_id) : learn_press_get_course();

// Do not show if course is no require enrollment
if ( ! $course || ! $course->is_required_enroll() ) {
	return;
}

$count = $course->count_students();
?>
<span>
	<strong class="students">
		<?php printf( _n( '%d Student', '%d Students', $count, 'elearningwp' ), $count ); ?>
	</strong>
</span>