<?php
/**
 * Template for displaying the students of a course
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $course;
$count = $course->count_users_enrolled( 'append' ) ? $course->count_users_enrolled( 'append' ) : 0;

if ( $count > 1 ) {
	echo $count . ' ' . __( 'students', 'elearningwp' );
} else {
	echo $count . ' ' . __( 'student', 'elearningwp' );
}

?>