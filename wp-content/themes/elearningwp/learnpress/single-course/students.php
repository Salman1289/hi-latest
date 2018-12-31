<?php
/**
 * Template for displaying the students of a course
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 2.1.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$course = LP()->global['course'];
$count  = $course->count_users_enrolled( 'append' ) ? $course->count_users_enrolled( 'append' ) : 0;

echo $count . ' <strong class="students">' . esc_html__( 'Students', 'elearningwp' ) . '</strong>';