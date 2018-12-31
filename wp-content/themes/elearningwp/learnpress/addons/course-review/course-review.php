<?php
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$course_id     = get_the_ID();
$course_review = learn_press_get_course_review( $course_id );
if ( $course_review['total'] ) {
	$course_rate = learn_press_get_course_rate( $course_id );
	$reviews     = $course_review['reviews'];
	?>
	<div id="course-reviews">
		<h3 class="course-review-head"><?php _e( 'Reviews', 'elearningwp' ); ?></h3>
		<p class="course-average-rate"><?php printf( __( 'Average rate: <span>%.1f</span>', 'elearningwp' ), $course_rate ); ?></p>
		<ul class="course-reviews-list">
			<?php foreach ( $reviews as $review ) { ?>
				<?php
				learn_press_course_review_template( 'loop-review.php', array( 'review' => $review ) );
				?>
			<?php } ?>
			<?php if ( empty( $course_review['finish'] ) ) { ?>
				<li class="loading"><?php _e( 'Loading...', 'elearningwp' ); ?></li>
			<?php }
			//else?>
			<!-- <li><?php _e( 'No review to load', 'elearningwp' ); ?></li> -->
		</ul>
		<?php if ( empty( $course_review['finish'] ) ) { ?>
			<button class="button" id="course-review-load-more" data-paged="<?php echo $course_review['paged']; ?>"><?php _e( 'Load More', 'elearningwp' ); ?></button>
		<?php } ?>
	</div>
	<?php
}