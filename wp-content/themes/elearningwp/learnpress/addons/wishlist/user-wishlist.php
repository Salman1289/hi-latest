<?php
/**
 * Template for displaying the list of course is in wishlist
 *
 * @author ThimPress
 */

defined( 'ABSPATH' ) || exit();

global $post;

$has_courses = $wishlist ? true : false;
?>
<div id="learn-press-profile-tab-course-wishlist" class="<?php echo $has_courses ? 'has-courses' : '';?>">
<?php if ( $has_courses ) { ?>
	<div class="learn-press-wishlist-courses archive-courses">
		<?php foreach( $wishlist as $post ) { ?>
			<?php learn_press_course_wishlist_template( 'wishlist-content.php' ); ?>
		<?php } ?>
	</div>
<?php } else { ?>
	<?php learn_press_display_message( apply_filters( 'learn_press_wishlist_empty_course', __( 'No courses in your wishlist!', 'elearningwp' ) ) ); ?>
<?php }?>
</div>
<?php
wp_reset_postdata();