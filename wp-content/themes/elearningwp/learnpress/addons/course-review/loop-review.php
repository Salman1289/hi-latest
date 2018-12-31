<li>
    <span class="avatar">
        <?php echo get_avatar( $review->ID, 80 ); ?>
    </span>
    <div class="review-right">
        <div class="user-name">
            <i class="fa fa-user"></i><?php echo $review->user_login; ?>
            <?php learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $review->rate ) );?>
        </div>
        <div class="review-content">
            <?php do_action( 'learn_press_before_review_title' );?>
            <h6>
            <?php echo $review->title ?>
            </h6>
            <?php do_action( 'learn_press_after_review_title' );?>
            <?php do_action( 'learn_press_before_review_content' );?>
            <?php echo $review->content ?>
            <?php do_action( 'learn_press_after_review_content' );?>
        </div>
    </div>
</li>