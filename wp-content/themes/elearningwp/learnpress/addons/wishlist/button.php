<?php
/**
 * Template for displaying button to toggle course wishlist on/off
 *
 * @author ThimPress
 */
global $post;

defined( 'ABSPATH' ) || exit();
$class = learn_press_user_wishlist_has_course($course_id) ? 'course-wishlisted' : 'course-wishlist';
echo '<div class="course-wishlist-box">';
printf(
		'<span class="%s" data-id="%s" data-nonce="%s" title="%s"><i class="fa fa-heart-o"></i> <span class="text">'.esc_html__('Save to Wishlist','elearningwp').'</span></span>',
		$class,
		$course_id,
		wp_create_nonce( 'course-toggle-wishlist' ),
		$title
);
echo '</div>';
