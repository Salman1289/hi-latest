<?php
/**
 * Template for displaying content of learning course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/content-learning.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div id="course-learning" class="course-learning-summary">

	<div class="course-learning-summary">

		<?php do_action( 'learn-press/content-learning-summary' ); ?>

	</div>

	<?php if ( class_exists('LP_Addon_Course_Review_Preload') ) : ?>
		<div class="row_course" id="row-course-review">
			<?php thim_course_review(); ?>
		</div>
	<?php endif; ?>

</div>


