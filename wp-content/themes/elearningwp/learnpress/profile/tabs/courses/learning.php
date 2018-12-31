<?php
/**
 * User Courses enrolled
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 2.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

?>

<?php if ( $courses ) : ?>

	<h3 class="box-title"><?php echo esc_html__( 'Enrolled Courses', 'elearningwp' ); ?></h3>

	<div class="archive-courses course-grid">

		<div class="row">
			<?php foreach( $courses as $post ){ setup_postdata( $post );?>
				<?php setup_postdata($post);?>
				<?php learn_press_get_template( 'profile/tabs/courses/loop.php', array( 'subtab' => 'learning', 'user' => $user, 'course_id' => $post->ID ) ); ?>

			<?php } ?>
		</div>

	</div>

<?php endif ?>

<?php wp_reset_postdata(); // do not forget to call this function here! ?>