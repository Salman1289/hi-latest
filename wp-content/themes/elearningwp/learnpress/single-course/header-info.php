<?php
$course_id = get_the_ID();
$course    = learn_press_get_the_course();
if ( function_exists( "learn_press_get_course_rate" ) ) {
	$course_rate = learn_press_get_course_rate( $course_id );
} else {
	$course_rate = '';
}
$user  = learn_press_get_current_user();
$count = $course->count_users_enrolled( 'append' ) ? $course->count_users_enrolled( 'append' ) : 0;

?>
<div class="heading_info">
	<ul>
		<li>
			<?php learn_press_course_instructor(); ?>
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
