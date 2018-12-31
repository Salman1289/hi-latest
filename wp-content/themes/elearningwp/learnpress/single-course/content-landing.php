<?php
/**
 * Template for displaying content of landing course
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$course = LP()->global['course'];
$user   = learn_press_get_current_user();
$review_is_enable = thim_plugin_active( 'learnpress-course-review' );
$student_list_enable = thim_plugin_active( 'learnpress-students-list' );
?>

<?php do_action( 'learn_press_before_content_landing' ); ?>

<div id="course-landing" class="course-landing-summary">

	<div id="learn-press-course-lesson">
		<?php do_action( 'learn_press_course_content_lesson' ); ?>
		<?php do_action( 'learn_press_content_landing_summary' ); ?>
	</div>

	<div class="row_course" id="row-course-instructor">
		<?php thim_about_author(); ?>
	</div>

	<?php if ( $review_is_enable ) : ?>
		<div class="row_course" id="row-course-review">
			<?php thim_course_review(); ?>
		</div>
	<?php endif; ?>

</div>

<?php do_action( 'learn_press_after_content_landing' ); ?>