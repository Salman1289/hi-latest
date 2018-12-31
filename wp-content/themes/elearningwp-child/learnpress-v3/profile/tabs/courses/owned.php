<?php
/**
 * Template for displaying own courses in courses tab of user profile page.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/courses/own.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile       = learn_press_get_profile();
$filter_status = LP_Request::get_string( 'filter-status' );
$query         = $profile->query_courses( 'own', array( 'status' => $filter_status ) );
?>

<div class="learn-press-subtab-content">
	<div class="thim-subtab-content-heading">
		<h3 class="profile-heading">
			<?php _e( 'My Courses', 'learnpress' ); ?>
		</h3>

		<?php if ( $filters = $profile->get_own_courses_filters( $filter_status ) ) { ?>
			<ul class="lp-sub-menu">
				<?php foreach ( $filters as $class => $link ) { ?>
					<li class="<?php echo $class; ?>"><?php echo $link; ?></li>
				<?php } ?>
			</ul>
		<?php } ?>
	</div>

	<?php if ( ! $query['total'] ) {
		learn_press_display_message( __( 'No courses!', 'learnpress' ) );
	} else { ?>

		<div class="learn-press-courses profile-courses-list archive-courses course-grid">
			<div class="row">
				<?php
				global $post;
				foreach ( $query['items'] as $item ) {
					$course = learn_press_get_course( $item );
					$post   = get_post( $item );
					setup_postdata( $post );
					learn_press_get_template( 'content-course.php' );
				}
				wp_reset_postdata();
				?>
			</div>
		</div>

		<?php $query->get_nav( '', true ); ?>

	<?php } ?>
</div>
