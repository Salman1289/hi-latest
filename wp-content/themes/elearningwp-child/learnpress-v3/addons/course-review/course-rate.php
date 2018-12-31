<?php
/**
 * Template for displaying course rate.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/course-review/course-rate.php.
 *
 * @author ThimPress
 * @package LearnPress/Course-Review/Templates
 * @version 3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

$course_id       = get_the_ID();
$course_rate_res = learn_press_get_course_rate( $course_id, false );
$course_rate     = $course_rate_res['rated'];
$total           = $course_rate_res['total'];
?>

<div class="course-rate">
	<?php
	learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) );

	if ( is_single() ) {
		$text = $total ? sprintf( _n( '(%1$s Review)', '(%1$s Reviews)', $total, 'elearningwp' ), number_format_i18n( $total ) ) : esc_html__( '(0 Reviews)', 'elearningwp' );
	} else {
		$text = sprintf( _n( '( %s Rating )', '( %s Rating )', $total, 'elearningwp' ), $total );
	}
	?>
	<p class="review-number">

		<?php do_action( 'learn_press_before_total_review_number' ); ?>

		<?php echo $text; ?>

		<?php do_action( 'learn_press_after_total_review_number' ); ?>

	</p>
</div>
