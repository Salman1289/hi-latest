<?php
/**
 * The template for display the content of single course
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$course = learn_press_get_the_course();
$user   = learn_press_get_current_user();
if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
$course_info_button = get_post_meta( get_the_ID(), 'thim_course_info_button', true );
$course_includes = get_post_meta( get_the_ID(), 'thim_course_includes', true );
?>

<?php do_action( 'learn_press_before_main_content' ); ?>

<?php do_action( 'learn_press_before_single_course' ); ?>

<?php do_action( 'learn_press_before_single_course_summary' ); ?>

<div class="row">
	<div class="col-md-9 col-sm-12">
		<div class="single-content">
			<?php learn_press_get_template( 'single-course/thumbnail.php' ); ?>

			<div class="course-summary">

				<?php if ( $user->has_course_status( $course->id, array( 'enrolled', 'finished' ) ) || !$course->is_require_enrollment() ) { ?>
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
			<?php if ( function_exists( 'learn_press_course_price' ) ) { ?>
			<div class="price-box">
				<?php learn_press_course_price(); ?>
			</div>
			<?php } ?>
			<?php if ( function_exists( 'learn_press_course_buttons' ) || !empty( $course_includes ) ) { ?>
			<div class="button-box">
				<?php learn_press_course_buttons(); ?>
				<?php if( !empty( $course_info_button)){ ?>
				<p class="intro"><?php echo $course_info_button; ?></p>
				<?php } else { ?>
					<p class="intro"><?php echo esc_html__('30-Day Money-Back Guarantee','elearningwp');; ?></p>
				<?php } ?>
				<?php if( !empty( $course_includes)){ ?>
					<div class="includes-box">
						<?php echo $course_includes; ?>
					</div>
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

<?php do_action( 'learn_press_after_single_course_summary' ); ?>

<?php do_action( 'learn_press_after_single_course' ); ?>

<?php do_action( 'learn_press_after_main_content' ); ?>


