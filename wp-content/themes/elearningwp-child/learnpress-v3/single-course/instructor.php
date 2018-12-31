<?php
/**
 * Template for displaying instructor of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/instructor.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$course = LP_Global::course();
$author = $course->get_instructor();

$lp_info = get_the_author_meta( 'lp_info', $author->get_id() );
$profile_link = learn_press_user_profile_link( get_post_field( 'post_author', $author->get_id() ) );
?>

<?php do_action( 'learn-press/before-single-course-instructor' ); ?>

<h3 class="title_row_course"><?php echo esc_html__( 'Instructors', 'elearningwp' ); ?></h3>
<div class="thim-about-author">
	<div class="author-wrapper clearfix">
		<div class="author-avatar">
			<?php echo get_avatar( $author->get_id(), 150 ); ?>
			<ul class="thim-author-social">
				<?php if ( isset( $lp_info['facebook'] ) && $lp_info['facebook'] ) : ?>
					<li>
						<a href="<?php echo esc_url( $lp_info['facebook'] ); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
					</li>
				<?php endif; ?>

				<?php if ( isset( $lp_info['twitter'] ) && $lp_info['twitter'] ) : ?>
					<li>
						<a href="<?php echo esc_url( $lp_info['twitter'] ); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
					</li>
				<?php endif; ?>

				<?php if ( isset( $lp_info['google'] ) && $lp_info['google'] ) : ?>
					<li>
						<a href="<?php echo esc_url( $lp_info['google'] ); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
					</li>
				<?php endif; ?>

				<?php if ( isset( $lp_info['linkedin'] ) && $lp_info['linkedin'] ) : ?>
					<li>
						<a href="<?php echo esc_url( $lp_info['linkedin'] ); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
					</li>
				<?php endif; ?>

				<?php if ( isset( $lp_info['youtube'] ) && $lp_info['youtube'] ) : ?>
					<li>
						<a href="<?php echo esc_url( $lp_info['youtube'] ); ?>" class="youtube"><i class="fa fa-youtube"></i></a>
					</li>
				<?php endif; ?>
			</ul>
		</div>

		<div class="author-bio">
			<div class="author-top">
				<a class="name" href="<?php echo esc_url($profile_link); ?>"><?php echo esc_html($course->get_instructor_name()); ?></a>
				<?php if ( isset( $lp_info['major'] ) && $lp_info['major'] ) : ?>
					<p class="job"><?php echo esc_html( $lp_info['major'] ); ?></p>
				<?php endif; ?>
			</div>
			<div class="author-description">
				<?php echo get_the_author_meta( 'description' ); ?>
			</div>
		</div>
	</div>
</div>

<?php do_action( 'learn-press/after-single-course-instructor' ); ?>

