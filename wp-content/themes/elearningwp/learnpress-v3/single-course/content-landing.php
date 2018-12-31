<?php
/**
 * Template for displaying content of landing course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/content-landing.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$review_is_enable = thim_plugin_active( 'learnpress-course-review' );
?>

<div id="course-landing" class="course-landing-summary">

	<div id="learn-press-course-lesson">
		<?php do_action( 'learn-press/content-landing-summary' ); ?>
	</div>

	<div class="row_course" id="row-course-instructor">
		<?php learn_press_course_instructor(); ?>
	</div>

	<?php if ( $review_is_enable ) : ?>
		<div class="row_course" id="row-course-review">
			<?php thim_course_review(); ?>
		</div>
	<?php endif; ?>

</div>
