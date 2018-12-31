<?php
/**
 * Template for displaying content of learning course
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$review_is_enable = thim_plugin_active( 'learnpress-course-review' );
$student_list_enable = thim_plugin_active( 'learnpress-students-list' );
?>

<?php do_action( 'learn_press_before_content_learning' ); ?>

<div id="course-learning" class="course-learning-summary">

	<div class="course-learning-summary">

		<?php do_action( 'learn_press_content_learning_summary' ); ?>

	</div>

	<?php if ( $review_is_enable ) : ?>
		<div class="row_course" id="row-course-review">
			<?php thim_course_review(); ?>
		</div>
	<?php endif; ?>

</div>

<?php do_action( 'learn_press_after_content_learning' ); ?>

