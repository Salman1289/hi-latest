<?php
/**
 * Template for displaying thumbnail of course within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/loop/course/thumbnail.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! has_post_thumbnail() ) {
	return;
}

$course = LP_Global::course();

$thum_course_page = LP()->settings->get( 'course_thumbnail_image_size' );
$thumb_width      = isset( $thum_course_page['width'] ) ? $thum_course_page['width'] : 450;
$thumb_height     = isset( $thum_course_page['height'] ) ? $thum_course_page['height'] : 450;
?>

<a class="course-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
	<?php
	echo thim_get_feature_image( get_post_thumbnail_id(), 'full', $thumb_width, $thumb_height, get_the_title() );
	?>
</a>