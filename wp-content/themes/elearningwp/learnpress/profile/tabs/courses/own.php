<?php
/**
 * User Courses own
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

<h3 class="box-title"><?php echo esc_html__( 'Own Courses', 'elearningwp' ); ?></h3>

<?php if ( $courses ) : ?>

	<div class="archive-courses course-grid">

		<div class="row">
			<?php foreach ( $courses as $post ): ?>
				<?php setup_postdata( $post ); ?>
				<?php learn_press_get_template( 'profile/tabs/courses/loop.php', array( 'subtab' => 'own', 'user' => $user, 'course_id' => $post->ID ) ); ?>

			<?php endforeach; ?>
		</div>


	</div>

<?php else: ?>

	<?php learn_press_display_message( esc_html__( 'No published courses.', 'elearningwp' ), 'notice' ); ?>

<?php endif ?>

<?php wp_reset_postdata(); // do not forget to call this function here! ?>