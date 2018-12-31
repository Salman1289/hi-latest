<?php
/**
 * Template for displaying add review form
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

defined( 'ABSPATH' ) || exit();
?>
<div class="course-review-wrapper" id="course-review">
	<div class="review-overlay"></div>
	<div class="review-form" id="review-form">
		<form>
			<h3>
				<?php _e( 'Write a review', 'elearningwp' ); ?>
				<a href="" class="close dashicons dashicons-no-alt"></a>
			</h3>
			<ul class="review-fields">
				<?php do_action( 'learn_press_before_review_fields' ); ?>
				<li>
					<input type="text" name="review_title" placeholder="Title" />
				</li>
				<li>
					<textarea name="review_content" placeholder="Content"></textarea>
				</li>
				<li>
					<label><?php _e( 'Rating', 'elearningwp' ); ?></label>
					<ul class="review-stars">
						<?php for ( $i = 1; $i <= 5; $i ++ ) { ?>
							<li class="review-title" title="<?php echo $i; ?>">
								<span class="dashicons dashicons-star-empty"></span></li>
						<?php } ?>
					</ul>
				</li>
				<?php do_action( 'learn_press_after_review_fields' ); ?>
				<li class="review-actions">
					<button type="button" class="submit-review" data-id="<?php the_ID(); ?>"><?php _e( 'Add review', 'elearningwp' ); ?></button>
					<button type="button" class="close"><?php _e( 'Cancel', 'elearningwp' ); ?></button>
					<span class="ajaxload"><?php _e( 'Please wait...', 'elearningwp' ); ?></span>
					<span class="error"></span>
					<?php wp_nonce_field( 'learn_press_course_review_' . get_the_ID(), 'review-nonce' ); ?>
					<input type="hidden" name="rating" value="0">
					<input type="hidden" name="lp-ajax" value="add_review">
					<input type="hidden" name="id" value="<?php echo get_the_ID(); ?>">
				</li>
			</ul>
		</form>
	</div>
</div>