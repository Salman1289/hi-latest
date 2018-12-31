<?php
/**
 * Template for displaying course content within the loop
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$course = LP()->global['course'];
?>

<div class="author" itemprop="creator">
	<span class="avatar"><?php echo get_avatar( get_post_field( 'post_author', $course->post->ID ), 32 ); ?></span>
	<?php echo sprintf( __( 'By %s', 'elearningwp' ), $course->get_instructor_html() ); ?>
</div>