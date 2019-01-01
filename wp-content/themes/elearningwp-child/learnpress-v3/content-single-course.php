<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-single-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}
$course = LP_Global::course();
$user   = LP_Global::user();

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}
$course_info_button = get_post_meta( get_the_ID(), 'thim_course_info_button', true );
$course_includes    = get_post_meta( get_the_ID(), 'thim_course_includes', true );
?>

<?php do_action( 'learn-press/before-main-content' ); ?>

<?php do_action( 'learn-press/before-single-course' ); ?>

<div class="row">
	<div class="col-md-9 col-sm-12">
		<div class="single-content">
			<?php learn_press_get_template( 'single-course/thumbnail.php' ); ?>

			<div class="course-summary">

				<?php if ( $user->has_course_status( $course->get_id(), array(
						'enrolled',
						'finished'
					) ) || ! $course->is_require_enrollment() ) { ?>
					<?php learn_press_get_template( 'single-course/content-learning.php' ); ?>
				<?php } else { ?>
					<?php learn_press_get_template( 'single-course/content-landing.php' ); ?>
				<?php } ?>

				<?php thim_related_courses(); ?>

			</div>
		</div>
	</div>

	<div id="sing-button-sidebar" class="col-md-3 col-sm-12 sticky-sidebar">
		<div class="single-button">
			<div class="price-box">
				<div class="course-title-box">
					<?php learn_press_course_title();?>
				</div>
				<?php learn_press_course_price(); ?>
			</div>
			<?php if ( ! empty( $course_includes ) ) { ?>
				<div class="button-box">
					<div class="includes-box">
						<?php
						if ( learn_press_is_learning_course() ) {
							learn_press_course_remaining_time();
						} else {
							if ( ! empty( $course_includes ) ) {
								echo( $course_includes );
							}
						}
						?>
					</div>
					
					<?php learn_press_course_buttons(); ?>
					<?php if ( ! empty( $course_info_button ) ) { ?>
						<p class="intro"><?php echo $course_info_button; ?></p>
					<?php } else { ?>
						<p class="intro"><?php echo esc_html__( '30-Day Money-Back Guarantee', 'elearningwp' );; ?></p>
					<?php } ?>

					
				</div>
			<?php } ?>
			<?php if ( function_exists( 'thim_course_wishlist_button' ) ) { ?>
				<div class="wishlist-box">
					<?php
					if ( function_exists( 'thim_course_wishlist_button' ) ) {
						thim_course_wishlist_button();
					}; ?>
					<div class="share">
						<?php do_action( 'thim_social_share' ); ?>
					</div>
				</div>
			<?php } ?>

		</div>
	</div>
</div>

<?php do_action( 'learn-press/after-main-content' ); ?>

<?php do_action( 'learn-press/after-single-course' ); ?>

