                                         <?php
/**
 * Template for displaying course content within the loop
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 2.0
 */


$theme_options_data = get_theme_mods();
$column_product     = 3;
if ( isset( $theme_options_data['thim_learnpress_cate_grid_column'] ) && $theme_options_data['thim_learnpress_cate_grid_column'] <> '' ) {
	$column_product = 12 / $theme_options_data['thim_learnpress_cate_grid_column'];
}
if ( ! empty( $_REQUEST['cols'] ) ) {
	$column_product = 12 / $_REQUEST['cols'];
}

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$classes   = array();
$classes[] = 'col-md-' . $column_product . ' col-sm-6 col-xs-6 lpr-course';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?> itemprop="itemListElement">

	<div class="inner-course">
		<?php do_action( 'learn_press_before_course_header' ); ?>

		<div class="wrapper-course-thumbnail">
			<?php do_action( 'learn_press_before_courses_loop_item' ); ?>

			<?php
			$lp_featured = get_post_meta( get_the_ID(), '_lp_featured', true );
			if ( $lp_featured == 'yes' ) {
				echo '<label>' . esc_html__( 'Featured', 'elearningwp' ) . '</label>';
			} ?>
			<div class="teacher_course">
				<?php
				if ( thim_plugin_active( 'learnpress' ) ) {
					thim_author_courses();
				}
				?>
			</div>
		</div>
		<div class="item-list-center">
			<div class="course-title">
				<?php
				do_action( 'learn_press_courses_loop_item_title' );
				?>
			</div>
			<div class="course-description">
				<?php
				do_action( 'learn_press_before_course_content' );
				echo thim_excerpt( 20 );
				do_action( 'learn_press_after_course_content' );
				?>
			</div>
			<div class="course-price"><?php learn_press_courses_loop_item_price(); ?></div>

			<div class="course-students">
				<span>
					<?php learn_press_course_students(); ?>
				</span>
				<div class="course-rating">
					<?php thim_course_ratings_count(); ?>
				</div>
			</div>
		</div>
	</div>
</article>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               