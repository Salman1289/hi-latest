<?php

$course    = learn_press_get_course();
$course_id = $course->get_id();

if ( function_exists( "learn_press_get_course_rate" ) ) {
	$course_rate = learn_press_get_course_rate( $course_id );
} else {
	$course_rate = '';
}
$user  = learn_press_get_current_user();
$count = $course->count_students() ? $course->count_students() : 0;

?>
<div class="heading_info">
	<ul>
		<li>
			<div class="author" itemprop="creator">
				<span class="avatar"><?php echo $course->get_instructor()->get_profile_picture( '', 50 ); ?></span>
				<div class="info">
					<label><?php echo __( 'Teacher', 'elearningwp' ); ?></label>
					<a href="<?php echo esc_url( learn_press_user_profile_link( $course->post->post_author ) ); ?>">
						<span><?php echo $course->get_instructor_html(); ?></span>
					</a>
				</div>
			</div>
		</li>
		<li>
			<label><?php echo __( 'Students', 'elearningwp' ); ?></label>
			<?php echo esc_html( $count ); ?> (<?php echo __( 'Registered', 'elearningwp' ); ?>)
		</li>
		<?php if ( function_exists( "learn_press_get_course_rate" ) ) : ?>
			<li>
				<label><?php echo __( 'Review', 'elearningwp' ); ?></label>
				<?php thim_course_ratings_count(); ?>
			</li>
		<?php endif; ?>

		<?php if ( get_post_meta($course_id, '_lp_course_forum', true) ) : ?>
			<li>
				<?php thim_course_forum_link(); ?>
			</li>
		<?php endif; ?>
	</ul>
</div>
