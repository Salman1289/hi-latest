<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$user = LP_Global::user();

$theme_options_data = get_theme_mods();
$column_product     = 3;
if ( isset( $theme_options_data['thim_learnpress_cate_grid_column'] ) && $theme_options_data['thim_learnpress_cate_grid_column'] <> '' ) {
	$column_product = 12 / $theme_options_data['thim_learnpress_cate_grid_column'];
}
if ( ! empty( $_REQUEST['cols'] ) ) {
	$column_product = 12 / $_REQUEST['cols'];
}

if ( learn_press_is_profile() ) {
	$column_product = 3;
}

$classes   = array();
$classes[] = 'col-md-' . $column_product . ' col-sm-6 col-xs-6 lpr-course';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?> itemprop="itemListElement">
	<div class="inner-course">
		<div class="wrapper-course-thumbnail">
			<?php do_action( 'learn-press/before-courses-loop-item' ); ?>

			<?php
			$lp_featured = get_post_meta( get_the_ID(), '_lp_featured', true );
			if ( $lp_featured == 'yes' ) {
				echo '<label>' . esc_html__( 'Featured', 'elearningwp' ) . '</label>';
			} ?>
			<div class="teacher_course">
				<?php thim_author_courses(); ?>
			</div>

			<?php

			// @since 3.0.0
			//			do_action( 'learn-press/after-courses-loop-item' );
			?>
		</div>

		<div class="item-list-center">
			<div class="course-title">
				<?php do_action( 'learn-press/courses-loop-item-title' ); ?>
			</div>

			<div class="course-description">
				<?php
				do_action( 'thim_lp_before_course_content' );
				echo thim_excerpt( 20 );
				do_action( 'thim_lp_after_course_content' );
				?>
			</div>

			<div class="course-price">
				<?php learn_press_courses_loop_item_price(); ?>
			</div>

			<div class="course-students">
				<?php learn_press_course_students(); ?>
			</div>
		</div>
	</div>
</article>