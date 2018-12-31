<?php
/**
 * Template for displaying the instructor of a course
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$course = learn_press_get_the_course();
?>
<div class="author" itemprop="creator">
	<span class="avatar"><?php echo get_avatar( get_post_field( 'post_author', get_the_ID() ), 50 ); ?></span>
	<div class="info">
		<label><?php echo __( 'Teacher', 'elearningwp' ); ?></label>
		<a href="<?php echo esc_url( learn_press_user_profile_link( $course->post->post_author ) ); ?>">
			<span><?php echo get_the_author_meta( 'display_name', $course->post->post_author ); ?></span>
		</a>
	</div>
</div>