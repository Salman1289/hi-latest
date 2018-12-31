<?php
function thim_allowAuthorEditing() {
	add_post_type_support( 'lp_course', 'author' );
}

add_action( 'init', 'thim_allowAuthorEditing' );

/**
 * Display ratings count
 */
if ( ! function_exists( 'thim_course_ratings_count' ) ) {
	function thim_course_ratings_count( $course_id = null ) {
		if ( ! thim_plugin_active( 'learnpress-course-review' ) || ! class_exists( 'LP_Addon_Course_Review' ) ) {
			return;
		}

		learn_press_course_review_template( 'course-rate.php' );
	}
}

/**
 * Breadcrumb for LearnPress
 */
if ( ! function_exists( 'thim_learnpress_breadcrumb' ) ) {
	function thim_learnpress_breadcrumb() {

		// Do not display on the homepage
		if ( is_front_page() || is_404() ) {
			return;
		}

		// Get the query & post information
		global $post;

		// Build the breadcrums
		echo '<ul itemprop="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs" class="breadcrumbs">';

		// Home page
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr__( 'Home', 'elearningwp' ) . '"><span itemprop="name">' . esc_html__( 'Home', 'elearningwp' ) . '</span></a></li>';

		if ( is_single() ) {

			$categories = get_the_terms( $post, 'course_category' );

			if ( get_post_type() == 'lp_course' ) {
				// All courses
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_post_type_archive_link( 'lp_course' ) ) . '" title="' . esc_attr__( 'All courses', 'elearningwp' ) . '"><span itemprop="name">' . esc_html__( 'All courses', 'elearningwp' ) . '</span></a></li>';
			} else {
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( get_post_meta( $post->ID, '_lp_course', true ) ) ) . '" title="' . esc_attr( get_the_title( get_post_meta( $post->ID, '_lp_course', true ) ) ) . '"><span itemprop="name">' . esc_html( get_the_title( get_post_meta( $post->ID, '_lp_course', true ) ) ) . '</span></a></li>';
			}

			// Single post (Only display the first category)
			if ( isset( $categories[0] ) ) {
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_term_link( $categories[0] ) ) . '" title="' . esc_attr( $categories[0]->name ) . '"><span itemprop="name">' . esc_html( $categories[0]->name ) . '</span></a></li>';
			}
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';

		} else if ( is_tax( 'course_category' ) || is_tax( 'course_tag' ) ) {
			// All courses
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_post_type_archive_link( 'lp_course' ) ) . '" title="' . esc_attr__( 'All courses', 'elearningwp' ) . '"><span itemprop="name">' . esc_html__( 'All courses', 'elearningwp' ) . '</span></a></li>';

			// Category page
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( single_term_title( '', false ) ) . '">' . esc_html( single_term_title( '', false ) ) . '</span></li>';
		} else if ( ! empty( $_REQUEST['s'] ) && ! empty( $_REQUEST['ref'] ) && ( $_REQUEST['ref'] == 'course' ) ) {
			// All courses
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_post_type_archive_link( 'lp_course' ) ) . '" title="' . esc_attr__( 'All courses', 'elearningwp' ) . '"><span itemprop="name">' . esc_html__( 'All courses', 'elearningwp' ) . '</span></a></li>';

			// Search result
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__( 'Search results for:', 'elearningwp' ) . ' ' . esc_attr( get_search_query() ) . '">' . esc_html__( 'Search results for:', 'elearningwp' ) . ' ' . esc_html( get_search_query() ) . '</span></li>';
		} else {
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__( 'All courses', 'elearningwp' ) . '">' . esc_html__( 'All courses', 'elearningwp' ) . '</span></li>';
		}

		echo '</ul>';
	}
}

/**
 * Update template hook, remove hook to reorder html structure
 */
if ( ! function_exists( 'thim_update_template_hook' ) ) {
	function thim_update_template_hook() {
		remove_action( 'learn-press/courses-loop-item-title', 'learn_press_courses_loop_item_thumbnail', 10 );
		add_action( 'learn-press/before-courses-loop-item', 'learn_press_courses_loop_item_thumbnail', 10 );


		remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_students', 20 );
		remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_instructor', 25 );
		remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_introduce', 30 );

		remove_action( 'learn-press/before-main-content', 'learn_press_breadcrumb' );
		remove_action( 'learn-press/before-main-content', 'learn_press_search_form', 15 );


		//Landing course
		remove_action( 'learn-press/content-landing-summary', 'learn_press_course_meta_start_wrapper', 5 );
		remove_action( 'learn-press/content-landing-summary', 'learn_press_course_students', 10 );
		remove_action( 'learn-press/content-landing-summary', 'learn_press_course_meta_end_wrapper', 15 );
		remove_action( 'learn-press/content-landing-summary', 'learn_press_course_tabs', 20 );
		remove_action( 'learn-press/content-landing-summary', 'learn_press_course_price', 25 );
		remove_action( 'learn-press/content-landing-summary', 'learn_press_course_buttons', 30 );

		if ( function_exists( 'learn_press_course_wishlist_button' ) ) {
			remove_action( 'learn_press_entry_footer_archive', 'learn_press_course_wishlist_button', 10 );
			remove_action( 'learn_press_course_landing_content', 'learn_press_course_wishlist_button', 10 );
			remove_action( 'learn_press_course_learning_content', 'learn_press_course_wishlist_button', 10 );
			remove_action( 'learn-press/content-landing-summary', 'learn_press_course_wishlist_button', 10 );
			remove_action( 'learn-press/content-learning-summary', 'learn_press_course_wishlist_button', 10 );
		}

		if ( thim_plugin_active( 'learnpress-course-review' ) && class_exists( 'LP_Addon_Course_Review' ) ) {
			$addon_review = LP_Addon_Course_Review::instance();
			add_action( 'learn-press/content-learning-summary', array( $addon_review, 'add_review_button' ), 5 );
		}

		add_action( 'learn-press/content-landing-summary', 'learn_press_course_overview_tab', 35 );
		add_action( 'learn-press/content-landing-summary', 'learn_press_course_curriculum_tab', 40 );

		add_action( 'learn_press_menu_course_landing', 'learn_press_course_price', 20 );

		//Learning course
		remove_action( 'learn-press/content-learning-summary', 'learn_press_course_thumbnail', 5 );

		remove_action( 'learn-press/content-learning-summary', 'learn_press_course_meta_start_wrapper', 10 );
		remove_action( 'learn-press/content-learning-summary', 'learn_press_course_students', 15 );
		remove_action( 'learn-press/content-learning-summary', 'learn_press_course_meta_end_wrapper', 20 );
		remove_action( 'learn-press/content-learning-summary', 'learn_press_course_remaining_time', 30 );
		remove_action( 'learn-press/content-learning-summary', 'learn_press_course_buttons', 40 );

		if ( thim_plugin_active( 'learnpress-bbpress' && class_exists( 'LP_Addon_BBPress_Course_Forum' ) ) ) {
			$addon_bbpress = LP_Addon_BBPress_Course_Forum::instance();
			remove_action( 'learn_press_after_single_course_summary', array( $addon_bbpress, 'forum_link' ) );
		}

		//Profile Page
		remove_action( 'learn_press_user_profile_summary', 'learn_press_output_user_profile_info', 5, 4 ); // TODO: recheck hook

//		add_action( 'learn_press_profile_get_count_courses', 'learn_press_profile_get_count_courses', 5, 2 );
//		add_action( 'learn_press_profile_get_courses_intructor', 'learn_press_profile_get_courses_intructor', 1 );

	}
}
add_action( 'init', 'thim_update_template_hook' );

function thim_learnpress_scripts() {
	wp_dequeue_style( 'course-review' );
	wp_enqueue_script( 'single-course' );
}

add_action( 'wp_enqueue_scripts', 'thim_learnpress_scripts', 1001 );

if ( ! function_exists( 'learnpress_page_title' ) ) {
	function learnpress_page_title() {
		if ( get_post_type() == "lp_course" ) {
			if ( is_tax() ) {
				echo single_term_title( "", false );
			} else {
				echo __( 'Courses', 'elearningwp' );
			}
		}
		if ( get_post_type() == "lp_quiz" ) {
			if ( is_tax() ) {
				echo single_term_title( "", false );
			} else {
				echo __( 'Quiz', 'elearningwp' );
			}
		}
	}
}

function thim_breadcrumb_for_learn_press( $breadcrumb, $start, $middle, $end, $separator ) {
	if ( get_post_type() === 'lp_course' ) {
		if ( is_archive() ) {
			$end = '<li class="item-current" itemprop="itemListElement"><strong class="bread-current">' . __( 'Courses', 'elearningwp' ) . '</strong></li>';
		}
		if ( is_single() ) {
			$middle = '<li class="item-courses" itemprop="itemListElement"><a class="bread-courses" href="' . get_post_type_archive_link( 'lp_course' ) . '">' . __( 'Courses', 'elearningwp' ) . '</a></li>';
			$middle .= $separator;
		}
	}
	$breadcrumb = $start . $middle . $end . '</ul>';

	return $breadcrumb;
}

add_filter( 'thim_get_breadcrumb', 'thim_breadcrumb_for_learn_press', 10, 5 );

/**
 * Get lesson duration in hours
 *
 * @param $lesson_id
 *
 * @return string
 */
if ( ! function_exists( 'thim_lesson_duration' ) ) {
	function thim_lesson_duration( $lesson_id ) {

		$duration = absint( get_post_meta( $lesson_id, '_lp_duration', true ) );
		$hour     = floor( $duration / 60 );
		if ( $hour == 0 ) {
			$hour = '';
		} else {
			$hour = $hour . esc_html__( 'h', 'elearningwp' );
		}
		$minute = $duration % 60;
		$minute = $minute . esc_html__( 'm', 'elearningwp' );

		return $hour . $minute;
	}
}

/**
 * Create ajax handle for courses searching
 */
function courses_searching_callback() {
	ob_start();
	$keyword = $_REQUEST['keyword'];
	if ( $keyword ) {
		$keyword   = strtoupper( $keyword );
		$arr_query = array(
			'post_type'           => 'lp_course',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			's'                   => $keyword
		);
		$search    = new WP_Query( $arr_query );

		$newdata = array();
		foreach ( $search->posts as $post ) {
			$newdata[] = array(
				'id'    => $post->ID,
				'title' => $post->post_title,
				'guid'  => get_permalink( $post->ID ),
			);
		}

		ob_end_clean();
		if ( count( $search->posts ) ) {
			echo json_encode( $newdata );
		} else {
			$newdata[] = array(
				'id'    => '',
				'title' => __( 'No course found', 'elearningwp' ),
				'guid'  => '#',
			);
			echo json_encode( $newdata );
		}
	}
	die();
}

add_action( 'wp_ajax_nopriv_courses_searching', 'courses_searching_callback' );
add_action( 'wp_ajax_courses_searching', 'courses_searching_callback' );

/**
 * Display co instructors
 *
 * @param $course_id
 */
if ( ! function_exists( 'thim_co_instructors' ) ) {
	function thim_co_instructors( $course_id, $author_id, $single = false ) {
		if ( ! $course_id ) {
			return;
		}

		if ( thim_plugin_active( 'learnpress-co-instructor' ) ) {
			$instructors = get_post_meta( $course_id, '_lp_co_teacher' );
			$instructors = array_diff( $instructors, array( $author_id ) );
			if ( $instructors ) {
				foreach ( $instructors as $instructor ) {
					$lp_info = get_the_author_meta( 'lp_info', $instructor );
					$link    = learn_press_user_profile_link( $instructor );
					?>
					<div class="thim-about-author thim-co-instructor" itemprop="contributor" itemscope itemtype="http://schema.org/Person">
						<div class="author-wrapper clearfix">
							<div class="author-avatar">
								<a itemprop="url" href="<?php echo esc_url( $link ); ?>">
									<?php echo get_avatar( $instructor, 150 ); ?>
								</a>
								<?php if ( $single ) { ?>
									<ul class="thim-author-social">
										<?php if ( isset( $lp_info['facebook'] ) && $lp_info['facebook'] ) : ?>
											<li>
												<a href="<?php echo esc_url( $lp_info['facebook'] ); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
											</li>
										<?php endif; ?>

										<?php if ( isset( $lp_info['twitter'] ) && $lp_info['twitter'] ) : ?>
											<li>
												<a href="<?php echo esc_url( $lp_info['twitter'] ); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
											</li>
										<?php endif; ?>

										<?php if ( isset( $lp_info['google'] ) && $lp_info['google'] ) : ?>
											<li>
												<a href="<?php echo esc_url( $lp_info['google'] ); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
											</li>
										<?php endif; ?>

										<?php if ( isset( $lp_info['linkedin'] ) && $lp_info['linkedin'] ) : ?>
											<li>
												<a href="<?php echo esc_url( $lp_info['linkedin'] ); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
											</li>
										<?php endif; ?>

										<?php if ( isset( $lp_info['youtube'] ) && $lp_info['youtube'] ) : ?>
											<li>
												<a href="<?php echo esc_url( $lp_info['youtube'] ); ?>" class="youtube"><i class="fa fa-youtube"></i></a>
											</li>
										<?php endif; ?>
									</ul>
								<?php } ?>
							</div>
							<div class="author-bio">
								<div class="author-top">
									<a class="name" href="<?php echo esc_url( $link ); ?>">
										<span><?php esc_html_e( 'Teacher: ', 'elearningwp' ); ?></span><?php echo get_the_author_meta( 'display_name', $instructor ); ?>
									</a>
									<?php if ( $single ) { ?>
										<?php if ( isset( $lp_info['major'] ) && $lp_info['major'] ) : ?>
											<p class="job"><?php echo esc_html( $lp_info['major'] ); ?></p>
										<?php endif; ?>
									<?php } ?>
								</div>
								<?php if ( $single ) { ?>
									<div class="author-description">
										<?php echo get_the_author_meta( 'description', $instructor ); ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php
				}
			}
		}
	}
}

if ( ! function_exists( 'thim_author_courses' ) ) {
	function thim_author_courses() {
		$lp_info = get_the_author_meta( 'lp_info' );
		$link    = '#';
		if ( get_post_type() == 'lpr_course' ) {
			$link = apply_filters( 'learn_press_instructor_profile_link', '#', $user_id = null, get_the_ID() );
		} elseif ( get_post_type() == 'lp_course' ) {
			$link = learn_press_user_profile_link( get_the_author_meta( 'ID' ) );
		} elseif ( is_single() ) {
			$link = get_author_posts_url( get_the_author_meta( 'ID' ) );
		}
		?>
		<div class="thim-about-author thim-co-instructor">
			<div class="author-wrapper clearfix">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?>
				</div>
				<div class="author-bio">
					<div class="author-top">
						<a class="name" href="<?php echo esc_url( $link ); ?>">
							<?php
							$author_data = get_userdata( get_the_author_meta( 'ID' ) );
							$author_name = $author_data->data->user_login;
							if ( $author_data ) {
								if ( ! empty( $author_data->data->display_name ) ) {
									$author_name = $author_data->data->display_name;
								}
							}
							echo( $author_name );
							?>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

/**
 * Display course review
 */
if ( ! function_exists( 'thim_course_review' ) ) {
	function thim_course_review() {
		if ( ! thim_plugin_active( 'learnpress-course-review' ) ) {
			return;
		}

		$course_id     = get_the_ID();
		$course_review = learn_press_get_course_review( $course_id, isset( $_REQUEST['paged'] ) ? $_REQUEST['paged'] : 1, 5, true );
		$course_rate   = learn_press_get_course_rate( $course_id );
		$total         = learn_press_get_course_rate_total( $course_id );
		$reviews       = $course_review['reviews'];

		?>
		<div class="course-rating">
			<h3 class="title_row_course"><?php esc_html_e( 'Reviews', 'elearningwp' ); ?></h3>

			<div class="average-rating" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">

				<div class="rating-box">
					<div class="average-value" itemprop="ratingValue"><?php echo ( $course_rate ) ? esc_html( round( $course_rate, 1 ) ) : 0; ?></div>
					<div class="review-star">
						<?php thim_print_rating( $course_rate ); ?>
					</div>
					<div class="review-amount" itemprop="ratingCount">
						<?php $total ? printf( _n( '%1$s rating', '%1$s ratings', $total, 'elearningwp' ), number_format_i18n( $total ) ) : esc_html_e( '0 rating', 'elearningwp' ); ?>
					</div>
				</div>
			</div>
			<div class="detailed_rating">

				<div class="rating-box">
					<?php thim_detailed_rating( $course_id, $total ); ?>
				</div>
			</div>
		</div>

		<?php if ( $reviews ) { ?>
			<div class="course-review">
				<div id="course-reviews" class="content-review">
					<ul class="course-reviews-list">
						<?php foreach ( $reviews as $review ) : ?>
							<li>
								<div class="review-container" itemprop="review" itemscope itemtype="http://schema.org/Review">
									<div class="review-author">
										<?php echo get_avatar( $review->ID, 95 ); ?>
									</div>
									<div class="review-text">
										<h4 class="author-name" itemprop="author"><?php echo esc_html( $review->display_name ); ?></h4>

										<div class="review-star">
											<?php thim_print_rating( $review->rate ); ?>
										</div>
										<p class="review-time">
											<i class="fa fa-clock-o"></i> <?php echo date( 'F j, Y', strtotime( $review->user_registered ) ); ?> <?php echo esc_html__( 'at', 'elearningwp' ); ?> <?php echo date( 'h:i a', strtotime( $review->user_registered ) ); ?>
										</p>

										<div class="description" itemprop="reviewBody">
											<p><?php echo esc_html( $review->content ); ?></p>
										</div>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		<?php if ( empty( $course_review['finish'] ) && $total ) : ?>
			<div class="review-load-more">
				<span id="course-review-load-more" data-paged="<?php echo esc_attr( $course_review['paged'] ); ?>"><i class="fa fa-angle-double-down"></i></span>
			</div>
		<?php endif; ?>
		<?php thim_review_button( $course_id ); ?>
		<?php
	}
}

/**
 * Display review button
 *
 * @param $course_id
 */
if ( ! function_exists( 'thim_review_button' ) ) {
	function thim_review_button( $course_id ) {
		if ( ! thim_plugin_active( 'learnpress-course-review' ) ) {
			return;
		}

		if ( ! get_current_user_id() ) {
			return;
		}

		$user = LP_Global::user();
//		$user = learn_press_get_current_user();

		if ( $user->has( 'enrolled-course', $course_id ) || get_post_meta( $course_id, '_lp_required_enroll', true ) == 'no' ) {
			if ( ! learn_press_get_user_rate( $course_id ) ) {
				?>
				<div class="add-review">
					<h3 class="title"><?php esc_html_e( 'Leave A Review', 'elearningwp' ); ?></h3>

					<p class="description"><?php esc_html_e( 'Please provide as much detail as you can to justify your rating and to help others.', 'elearningwp' ); ?></p>
					<?php do_action( 'learn_press_before_review_fields' ); ?>
					<form method="post">
						<div>

							<label><?php esc_html_e( 'Rating', 'elearningwp' ); ?>
								<span class="required">*</span></label>

							<div class="review-stars-rated">
								<ul class="review-stars">
									<li><span class="fa fa-star-o"></span></li>
									<li><span class="fa fa-star-o"></span></li>
									<li><span class="fa fa-star-o"></span></li>
									<li><span class="fa fa-star-o"></span></li>
									<li><span class="fa fa-star-o"></span></li>
								</ul>
								<ul class="review-stars filled" style="width: 100%">
									<li><span class="fa fa-star"></span></li>
									<li><span class="fa fa-star"></span></li>
									<li><span class="fa fa-star"></span></li>
									<li><span class="fa fa-star"></span></li>
									<li><span class="fa fa-star"></span></li>
								</ul>
							</div>
						</div>
						<div>
							<label for="review-content"><?php esc_html_e( 'Comment', 'elearningwp' ); ?>
								<span class="required">*</span></label>
							<textarea required id="review-content" name="review-course-content"></textarea>
						</div>
						<input type="hidden" id="review-course-value" name="review-course-value" value="5" />
						<input type="hidden" id="comment_post_ID" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" />
						<button type="submit"><?php esc_html_e( 'Submit Review', 'elearningwp' ); ?></button>
					</form>
					<?php do_action( 'learn_press_after_review_fields' ); ?>
				</div>
				<?php
			}
		}
	}
}

/**
 * Process review
 */
if ( ! function_exists( 'thim_process_review' ) ) {
	function thim_process_review() {

		if ( ! thim_plugin_active( 'learnpress-course-review' ) ) {
			return;
		}

		$user_id     = get_current_user_id();
		$course_id   = isset ( $_POST['comment_post_ID'] ) ? $_POST['comment_post_ID'] : 0;
		$user_review = learn_press_get_user_rate( $course_id, $user_id );
		if ( ! $user_review && $course_id ) {
			$review_title   = isset ( $_POST['review-course-title'] ) ? $_POST['review-course-title'] : 0;
			$review_content = isset ( $_POST['review-course-content'] ) ? $_POST['review-course-content'] : 0;
			$review_rate    = isset ( $_POST['review-course-value'] ) ? $_POST['review-course-value'] : 0;
			learn_press_add_course_review( array(
				'title'     => $review_title,
				'content'   => $review_content,
				'rate'      => $review_rate,
				'user_id'   => $user_id,
				'course_id' => $course_id
			) );
		}
	}
}
add_action( 'learn_press_before_main_content', 'thim_process_review' );

/**
 * Display table detailed rating
 *
 * @param $course_id
 * @param $total
 */
if ( ! function_exists( 'thim_detailed_rating' ) ) {
	function thim_detailed_rating( $course_id, $total ) {
		global $wpdb;
		$query = $wpdb->get_results( $wpdb->prepare(
			"
		SELECT cm2.meta_value AS rating, COUNT(*) AS quantity FROM $wpdb->posts AS p
		INNER JOIN $wpdb->comments AS c ON p.ID = c.comment_post_ID
		INNER JOIN $wpdb->users AS u ON u.ID = c.user_id
		INNER JOIN $wpdb->commentmeta AS cm1 ON cm1.comment_id = c.comment_ID AND cm1.meta_key=%s
		INNER JOIN $wpdb->commentmeta AS cm2 ON cm2.comment_id = c.comment_ID AND cm2.meta_key=%s
		WHERE p.ID=%d AND c.comment_type=%s AND c.comment_approved=%s
		GROUP BY cm2.meta_value",
			'_lpr_review_title',
			'_lpr_rating',
			$course_id,
			'review',
			'1'
		), OBJECT_K
		);
		?>
		<div class="detailed-rating">
			<?php for ( $i = 5; $i >= 1; $i -- ) : ?>
				<div class="stars">
					<div class="key"><?php ( $i === 1 ) ? printf( esc_html__( '%s star', 'elearningwp' ), $i ) : printf( esc_html__( '%s stars', 'elearningwp' ), $i ); ?></div>
					<div class="bar">
						<div class="full_bar">
							<div style="<?php echo ( $total && ! empty( $query[ $i ]->quantity ) ) ? esc_attr( 'width: ' . ( $query[ $i ]->quantity / $total * 100 ) . '%' ) : 'width: 0%'; ?>"></div>
						</div>
					</div>
					<div class="value"><?php echo empty( $query[ $i ]->quantity ) ? '0' : esc_html( $query[ $i ]->quantity ); ?></div>
				</div>
			<?php endfor; ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'thim_print_rating' ) ) {
	function thim_print_rating( $rate ) {
		if ( ! thim_plugin_active( 'learnpress-course-review' ) ) {
			return;
		}

		?>
		<div class="review-stars-rated">
			<ul class="review-stars">
				<li><span class="fa fa-star-o"></span></li>
				<li><span class="fa fa-star-o"></span></li>
				<li><span class="fa fa-star-o"></span></li>
				<li><span class="fa fa-star-o"></span></li>
				<li><span class="fa fa-star-o"></span></li>
			</ul>
			<ul class="review-stars filled" style="<?php echo esc_attr( 'width: ' . ( $rate * 20 ) . '%' ) ?>">
				<li><span class="fa fa-star"></span></li>
				<li><span class="fa fa-star"></span></li>
				<li><span class="fa fa-star"></span></li>
				<li><span class="fa fa-star"></span></li>
				<li><span class="fa fa-star"></span></li>
			</ul>
		</div>
		<?php
	}
}

/**
 * About the author
 */
if ( ! function_exists( 'thim_about_author' ) ) {
	function thim_about_author() {
		$lp_info = get_the_author_meta( 'lp_info' );
		$link    = '#';
		if ( get_post_type() == 'lpr_course' ) {
			$link = apply_filters( 'learn_press_instructor_profile_link', '#', $user_id = null, get_the_ID() );
		} elseif ( get_post_type() == 'lp_course' ) {
			$link = learn_press_user_profile_link( get_the_author_meta( 'ID' ) );
		} elseif ( is_single() ) {
			$link = get_author_posts_url( get_the_author_meta( 'ID' ) );
		}
		?>
		<h3 class="title_row_course"><?php echo esc_html__( 'Instructors', 'elearningwp' ); ?></h3>
		<div class="thim-about-author">
			<div class="author-wrapper clearfix">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?>
					<ul class="thim-author-social">
						<?php if ( isset( $lp_info['facebook'] ) && $lp_info['facebook'] ) : ?>
							<li>
								<a href="<?php echo esc_url( $lp_info['facebook'] ); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
							</li>
						<?php endif; ?>

						<?php if ( isset( $lp_info['twitter'] ) && $lp_info['twitter'] ) : ?>
							<li>
								<a href="<?php echo esc_url( $lp_info['twitter'] ); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
							</li>
						<?php endif; ?>

						<?php if ( isset( $lp_info['google'] ) && $lp_info['google'] ) : ?>
							<li>
								<a href="<?php echo esc_url( $lp_info['google'] ); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
							</li>
						<?php endif; ?>

						<?php if ( isset( $lp_info['linkedin'] ) && $lp_info['linkedin'] ) : ?>
							<li>
								<a href="<?php echo esc_url( $lp_info['linkedin'] ); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
							</li>
						<?php endif; ?>

						<?php if ( isset( $lp_info['youtube'] ) && $lp_info['youtube'] ) : ?>
							<li>
								<a href="<?php echo esc_url( $lp_info['youtube'] ); ?>" class="youtube"><i class="fa fa-youtube"></i></a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="author-bio">
					<div class="author-top">
						<a class="name" href="<?php echo esc_url( $link ); ?>">
							<?php echo get_the_author(); ?>
						</a>
						<?php if ( isset( $lp_info['major'] ) && $lp_info['major'] ) : ?>
							<p class="job"><?php echo esc_html( $lp_info['major'] ); ?></p>
						<?php endif; ?>
					</div>
					<div class="author-description">
						<?php echo get_the_author_meta( 'description' ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		if ( thim_plugin_active( 'learnpress-co-instructor' ) ) {
			thim_co_instructors( get_the_ID(), get_the_author_meta( 'ID' ), true );
		}

	}
}

add_action( 'thim_about_author', 'thim_about_author' );

/**
 * @param $user
 */
if ( ! function_exists( 'thim_extra_user_profile_fields' ) ) {
	function thim_extra_user_profile_fields( $user ) {
		$user_info = get_the_author_meta( 'lp_info', $user->ID );
		?>
		<h3><?php esc_html_e( 'LearnPress Profile', 'elearningwp' ); ?></h3>

		<table class="form-table">
			<tbody>
			<tr>
				<th>
					<label for="lp_phone"><?php esc_html_e( 'Phone', 'elearningwp' ); ?></label>
				</th>
				<td>
					<input id="lp_phone" class="regular-text" type="text" value="<?php echo isset( $user_info['phone'] ) ? $user_info['phone'] : ''; ?>" name="lp_info[phone]">
				</td>
			</tr>
			<tr>
				<th>
					<label for="lp_location"><?php esc_html_e( 'Location', 'elearningwp' ); ?></label>
				</th>
				<td>
					<input id="lp_location" class="regular-text" type="text" value="<?php echo isset( $user_info['location'] ) ? $user_info['location'] : ''; ?>" name="lp_info[location]">
				</td>
			</tr>
			<tr>
				<th>
					<label for="lp_major"><?php esc_html_e( 'Major', 'elearningwp' ); ?></label>
				</th>
				<td>
					<input id="lp_major" class="regular-text" type="text" value="<?php echo isset( $user_info['major'] ) ? $user_info['major'] : ''; ?>" name="lp_info[major]">
				</td>
			</tr>
			<tr>
				<th>
					<label for="lp_facebook"><?php esc_html_e( 'Facebook Account', 'elearningwp' ); ?></label>
				</th>
				<td>
					<input id="lp_facebook" class="regular-text" type="text" value="<?php echo isset( $user_info['facebook'] ) ? $user_info['facebook'] : ''; ?>" name="lp_info[facebook]">
				</td>
			</tr>
			<tr>
				<th>
					<label for="lp_twitter"><?php esc_html_e( 'Twitter Account', 'elearningwp' ); ?></label>
				</th>
				<td>
					<input id="lp_twitter" class="regular-text" type="text" value="<?php echo isset( $user_info['twitter'] ) ? $user_info['twitter'] : ''; ?>" name="lp_info[twitter]">
				</td>
			</tr>
			<tr>
				<th>
					<label for="lp_google"><?php esc_html_e( 'Google Plus Account', 'elearningwp' ); ?></label>
				</th>
				<td>
					<input id="lp_google" class="regular-text" type="text" value="<?php echo isset( $user_info['google'] ) ? $user_info['google'] : ''; ?>" name="lp_info[google]">
				</td>
			</tr>
			<tr>
				<th>
					<label for="lp_linkedin"><?php esc_html_e( 'LinkedIn Plus Account', 'elearningwp' ); ?></label>
				</th>
				<td>
					<input id="lp_linkedin" class="regular-text" type="text" value="<?php echo isset( $user_info['linkedin'] ) ? $user_info['linkedin'] : ''; ?>" name="lp_info[linkedin]">
				</td>
			</tr>
			<tr>
				<th>
					<label for="lp_youtube"><?php esc_html_e( 'Youtube Account', 'elearningwp' ); ?></label>
				</th>
				<td>
					<input id="lp_youtube" class="regular-text" type="text" value="<?php echo isset( $user_info['youtube'] ) ? $user_info['youtube'] : ''; ?>" name="lp_info[youtube]">
				</td>
			</tr>
			</tbody>
		</table>
		<?php
	}
}

add_action( 'show_user_profile', 'thim_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'thim_extra_user_profile_fields' );

function thim_save_extra_user_profile_fields( $user_id ) {

	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	update_user_meta( $user_id, 'lp_info', $_POST['lp_info'] );
}

add_action( 'personal_options_update', 'thim_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'thim_save_extra_user_profile_fields' );

function thim_update_user_profile_basic_information() {
	$user_id     = learn_press_get_current_user_id();
	$update_data = array(
		'ID'           => $user_id,
		'first_name'   => filter_input( INPUT_POST, 'first_name', FILTER_SANITIZE_STRING ),
		'last_name'    => filter_input( INPUT_POST, 'last_name', FILTER_SANITIZE_STRING ),
		'display_name' => filter_input( INPUT_POST, 'display_name', FILTER_SANITIZE_STRING ),
		'nickname'     => filter_input( INPUT_POST, 'nickname', FILTER_SANITIZE_STRING ),
		'description'  => filter_input( INPUT_POST, 'description', FILTER_SANITIZE_STRING ),
	);
	update_user_meta( $user_id, 'lp_info', $_POST['lp_info'] );
	$res = wp_update_user( $update_data );
	if ( $res ) {
		$message = __( 'Your change is saved', 'learnpress' );
	} else {
		$message = __( 'Error on update your profile info', 'learnpress' );
	}
	$current_url = learn_press_get_current_url();
	learn_press_add_message( $message );
	wp_redirect( $current_url );
	exit();
}

add_action( 'learn_press_update_user_profile_basic-information', 'thim_update_user_profile_basic_information' );

/**
 * Display related courses
 */
if ( ! function_exists( 'thim_related_courses' ) ) {

	function thim_related_courses() {
		$related_courses  = thim_get_related_courses( 3 );
		$thum_course_page = LP()->settings->get( 'course_thumbnail_image_size' );
		if ( $related_courses ) {
			?>
			<div class="thim-ralated-course">
				<h3 class="related-title"><?php esc_html_e( 'Related Courses', 'elearningwp' ); ?></h3>

				<div class="row archive-courses course-grid cols_num_3">
					<?php foreach ( $related_courses as $course_item ) : ?>
						<?php
						$course_id    = $course_item->ID;
						$course       = LP_Course::get_course( $course_item->ID );
						$is_required  = $course->is_required_enroll();
						$thumb_width  = isset( $thum_course_page['width'] ) ? $thum_course_page['width'] : 450;
						$thumb_height = isset( $thum_course_page['height'] ) ? $thum_course_page['height'] : 450;
						?>
						<article class="col-md-4 col-sm-6">
							<div class="inner-course">
								<?php do_action( 'learn_press_before_course_header' ); ?>

								<div class="wrapper-course-thumbnail">
									<?php
									echo '<a class="course-thumbnail" href="' . esc_url( get_the_permalink( $course_item->ID ) ) . '" >';
									echo thim_get_feature_image( get_post_thumbnail_id( $course_item->ID ), 'full', $thumb_width, $thumb_height, get_the_title() );
									echo '</a>';
									?>
									<div class="teacher_course">
										<?php
										if ( thim_plugin_active( 'learnpress' ) ) {
											thim_author_courses();
										}
										?>
									</div>
								</div>
								<div class="item-list-center">
									<div class="course-title">
										<h2>
											<a href="<?php echo esc_url( get_the_permalink( $course_item->ID ) ); ?>"> <?php echo get_the_title( $course_item->ID ); ?></a>
										</h2>
									</div>
									<div class="course-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
										<?php if ( $course->is_free() || ! $is_required ) : ?>
											<div class="value free-course" itemprop="price" content="<?php esc_attr_e( 'Free', 'elearningwp' ); ?>">
												<?php esc_html_e( 'Free', 'elearningwp' ); ?>
											</div>
										<?php else: $price = learn_press_format_price( $course->get_price(), true ); ?>
											<div class="value " itemprop="price" content="<?php echo esc_attr( $price ); ?>">
												<?php echo esc_html( $price ); ?>
											</div>
										<?php endif; ?>
										<meta itemprop="priceCurrency" content="<?php echo learn_press_get_currency_symbol(); ?>" />

									</div>
									<?php
									$count = $course->count_students() ? $course->count_students() : 0;
									?>
									<div class="course-students">
										<?php learn_press_get_template( 'single-course/students.php', array( 'course_id' => $course_id ) ) ?>
										<div class="course-rating">
											<?php thim_course_ratings_count( $course_item->ID ); ?>
										</div>
									</div>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'thim_course_wishlist_button' ) ) {
	function thim_course_wishlist_button( $course_id = null ) {
		if ( ! thim_plugin_active( 'learnpress-wishlist' ) ) {
			return;
		}
		LP_Addon_Wishlist::instance()->wishlist_button( $course_id );
	}
}

function thim_get_related_courses( $limit ) {
	if ( ! $limit ) {
		$limit = 3;
	}
	$course_id = get_the_ID();

	$tag_ids = array();
	$tags    = get_the_terms( $course_id, 'course_tag' );

	if ( $tags ) {
		foreach ( $tags as $individual_tag ) {
			$tag_ids[] = $individual_tag->slug;
		}
	}

	$args = array(
		'posts_per_page'      => $limit,
		'paged'               => 1,
		'ignore_sticky_posts' => 1,
		'post__not_in'        => array( $course_id ),
		'post_type'           => 'lp_course'
	);

	if ( $tag_ids ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'course_tag',
				'field'    => 'slug',
				'terms'    => $tag_ids
			)
		);
	}
	$related = array();
	if ( $posts = new WP_Query( $args ) ) {
		global $post;
		while ( $posts->have_posts() ) {
			$posts->the_post();
			$related[] = $post;
		}
	}
	wp_reset_query();

	return $related;
}

/**
 * Get number of lessons of a quiz
 *
 * @param $quiz_id
 *
 * @return string
 */
if ( ! function_exists( 'thim_quiz_questions' ) ) {
	function thim_quiz_questions( $quiz_id ) {
		$questions = learn_press_get_quiz_questions( $quiz_id );
		if ( $questions ) {
			return count( $questions );
		}

		return 0;
	}
}

//pre get posts filters post per page
if ( ! function_exists( 'thim_pre_get_query_posts_per_page' ) ) {
	/**
	 * @param $query WP_Query
	 */
	function thim_pre_get_query_posts_per_page( $query ) {
		if ( ! empty( $_REQUEST['number'] ) ) {
			$courses_per_page = $_REQUEST['number'];
			$query->set( 'posts_per_page', $courses_per_page );
		}
	}
}
add_action( 'pre_get_posts', 'thim_pre_get_query_posts_per_page', 1000 );

/**
 * Add some meta data for a course
 *
 * @param $meta_box
 */
if ( ! function_exists( 'thim_add_course_meta' ) ) {
	function thim_add_course_meta( $meta_box ) {
		$fields             = $meta_box['fields'];
		$fields[]           = array(
			'name' => esc_html__( 'Media', 'elearningwp' ),
			'id'   => 'thim_course_media',
			'type' => 'text',
			'desc' => esc_html__( 'Link or iframe media of Course.', 'elearningwp' ),
		);
		$fields[]           = array(
			'name' => esc_html__( 'Includes', 'elearningwp' ),
			'id'   => 'thim_course_includes',
			'type' => 'wysiwyg',
			'desc' => esc_html__( 'Includes infomation of Courses', 'elearningwp' ),
		);
		$fields[]           = array(
			'name' => esc_html__( 'Info Button Box', 'elearningwp' ),
			'id'   => 'thim_course_info_button',
			'type' => 'text',
			'desc' => esc_html__( 'Add text info button', 'elearningwp' ),
		);
		$meta_box['fields'] = $fields;

		return $meta_box;
	}
}
add_filter( 'learn_press_course_settings_meta_box_args', 'thim_add_course_meta' );

if ( ! function_exists( 'thim_add_lesson_meta' ) ) {
	function thim_add_lesson_meta( $meta_box ) {
		$fields             = $meta_box['fields'];
		$fields[]           = array(
			'name' => esc_html__( 'Media', 'elearningwp' ),
			'id'   => '_lp_lesson_video_intro',
			'type' => 'textarea',
			'desc' => esc_html__( 'Add an embed link like video, PDF, slider...', 'elearningwp' ),
		);
		$fields[]           = array(
			'name' => esc_html__( 'Includes', 'elearningwp' ),
			'id'   => '_lp_lesson_video_includes',
			'type' => 'textarea',
			'desc' => esc_html__( 'Add an embed link like video, PDF, slider...', 'elearningwp' ),
		);
		$meta_box['fields'] = $fields;

		return $meta_box;
	}
}
add_filter( 'learn_press_lesson_meta_box_args', 'thim_add_lesson_meta' );

if ( ! function_exists( 'learn_press_profile_get_count_courses' ) ) {
	/**
	 * Display list info course
	 *
	 * @param LP_User
	 */
	function learn_press_profile_get_count_courses( $user ) {
		if ( thim_plugin_active( 'learnpress-co-instructor' ) ) {
			$caps = $user->user->caps;
			if ( ! empty( $caps['lp_teacher'] ) ) {
				$is_teacher = $caps['lp_teacher'];
				if ( $is_teacher ) {
					global $wpdb;
					$id_courses     = $wpdb->get_col(
						$wpdb->prepare(
							"SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s and meta_key = %s",
							$user->user->data->ID,
							'_lp_co_teacher'
						)
					);
					$number_course  = count( $id_courses );
					$count_students = 0;
					for ( $i = 0; $i < count( $id_courses ); $i ++ ) {
						$course         = learn_press_setup_object_data( (int) $id_courses[ $i ] );
						$count          = $course->count_users_enrolled( 'append' ) ? $course->count_users_enrolled( 'append' ) : 0;
						$count_students += $count;
					}
					?>
					<div class="info_constructor">
						<ul>
							<li>
								<label><?php echo esc_html__( 'Students', 'elearningwp' ); ?></label>
								<?php echo $count_students; ?>
							</li>
							<li>
								<label><?php echo esc_html__( 'Courses', 'elearningwp' ); ?></label>
								<?php echo $number_course; ?>
							</li>
						</ul>
					</div>
					<?php
				}
			}
		}
	}
}

if ( ! function_exists( 'learn_press_profile_get_courses_intructor' ) ) {
	/*
	 * Display list courses of Instructor
	 *
	 * @param LP_User
	 */
	function learn_press_profile_get_courses_intructor( $user ) {
		if ( thim_plugin_active( 'learnpress-co-instructor' ) ) {
			$column           = "col-md-3";
			$thum_course_page = LP()->settings->get( 'course_thumbnail_image_size' );
			$caps             = $user->user->caps;
			if ( ! empty( $caps['lp_teacher'] ) ) {
				$is_teacher = $caps['lp_teacher'];
				if ( $is_teacher ) {

					$arr_query = array(
						'post_type'      => 'lp_course',
						'post_status'    => 'publish',
						'posts_per_page' => 20,
						'meta_query'     => array(
							array(
								'key'     => '_lp_co_teacher',
								'value'   => $user->user->data->ID,
								'compare' => '='
							)
						),
					);
					$courses   = new WP_Query( $arr_query );
					if ( $courses->have_posts() ) {
						echo '<div class="list_courses_by_instructor">';
						echo '<h3>' . esc_html( 'Courses Taught By', 'elearningwp' ) . ' ' . learn_press_get_profile_display_name( $user ) . '</h3>';
						echo '<div class="wrapper-item cols_num_4 archive-courses row" itemscope itemtype="http://schema.org/CreativeWork">';
						while ( $courses->have_posts() ) : $courses->the_post();
							$course       = LP_Course::get_course( get_the_ID() );
							$thumb_width  = isset( $thum_course_page['width'] ) ? $thum_course_page['width'] : 450;
							$thumb_height = isset( $thum_course_page['height'] ) ? $thum_course_page['height'] : 450;
							?>
							<article class="<?php echo esc_attr( $column ); ?>">
								<div class="inner-course">
									<div class="wrapper-course-thumbnail">
										<?php
										if ( has_post_thumbnail() ) {
											echo '<a itemprop="url" class="course-thumbnail" href="' . get_the_permalink( get_the_ID() ) . '"> ';
											$attr = array(
												'itemprop' => 'image'
											);
											echo thim_get_feature_image( get_post_thumbnail_id(), 'full', $thumb_width, $thumb_height, get_the_title() );
											echo '</a>';
										} ?>
										<div class="teacher_course">
											<?php
											if ( thim_plugin_active( 'learnpress' ) ) {
												thim_author_courses();
											}
											?>
										</div>
									</div>
									<div class="course-title" itemprop="name">
										<h2>
											<a href="<?php the_permalink(); ?>" itemprop="url">
												<?php the_title(); ?>
											</a>
										</h2>
									</div>

									<div class="course-price">
										<?php if ( $course->is_free() ) : ?>
											<?php esc_html_e( 'Free', 'elearningwp' ); ?>
										<?php else: $price = learn_press_format_price( $course->get_price(), true ); ?>
											<?php echo esc_html( $price ); ?>
										<?php endif; ?>
										<meta itemprop="priceCurrency" content="<?php echo learn_press_get_currency_symbol(); ?>" />
									</div>
									<div class="course-student">
                                    <span>
                                        <i class="ion-person-stalker"></i>
	                                    <?php learn_press_course_students(); ?>
                                    </span>
										<span class="course-rating">
                                        <?php thim_course_ratings_count(); ?>
                                    </span>
									</div>
								</div>
							</article>
						<?php
						endwhile;
						echo '</div>';
						echo '</div>';
					}
				}
			}
		}
	}
}

/**
 * Add format icon before curriculum items
 *
 * @param $lesson_or_quiz
 * @param $enrolled
 */
if ( ! function_exists( 'thim_add_format_icon' ) ) {
	function thim_add_format_icon( $item ) {
		$format = get_post_format( $item->item_id );
		if ( get_post_type( $item->item_id ) == 'lp_quiz' ) {
			echo '<span class="course-format-icon"><i class="fa fa-puzzle-piece"></i></span>';
		} elseif ( $format == 'video' ) {
			echo '<span class="course-format-icon"><i class="fa fa-play-circle"></i></span>';
		} else {
			echo '<span class="course-format-icon"><i class="fa fa-file-o"></i></span>';
		}
	}
}

add_action( 'learn_press_before_section_item_title', 'thim_add_format_icon', 10, 1 );

/**
 * Display the link to course forum
 */
if ( ! function_exists( 'thim_course_forum_link' ) ) {
	function thim_course_forum_link() {

		if ( thim_plugin_active( 'bbpress' ) && thim_plugin_active( 'learnpress-bbpress' ) ) {
			LP_Addon_BBPress_Course_Forum::instance()->forum_link();
		}
	}
}

/*
 * Get popular course
 * */
if ( ! function_exists( 'lp_get_courses_popular' ) ) {
	function lp_get_courses_popular() {
		global $wpdb;
		$popular_courses_query = $wpdb->prepare(
			"SELECT po.*, count(*) as number_enrolled 
					FROM {$wpdb->prefix}learnpress_user_items ui
					INNER JOIN {$wpdb->posts} po ON po.ID = ui.item_id
					WHERE ui.item_type = %s
						AND ( ui.status = %s OR ui.status = %s )
						AND po.post_status = %s
					GROUP BY ui.item_id 
					ORDER BY ui.item_id DESC
				",
			LP_COURSE_CPT,
			'enrolled',
			'finished',
			'publish'
		);
		$popular_courses       = $wpdb->get_results(
			$popular_courses_query
		);

		$temp_arr = array();
		foreach ( $popular_courses as $course ) {
			array_push( $temp_arr, $course->ID );
		}

		return $temp_arr;
	}
}

/**
 * Get course, lesson, ... duration in hours
 *
 * @param $id
 *
 * @param $post_type
 *
 * @return string
 */

if ( ! function_exists( 'thim_duration_time_calculator' ) ) {
	function thim_duration_time_calculator( $id, $post_type = 'lp_course' ) {
		if ( $post_type == 'lp_course' ) {
			$course_duration_meta = get_post_meta( $id, '_lp_duration', true );
			$course_duration_arr  = array_pad( explode( ' ', $course_duration_meta, 2 ), 2, 'minute' );

			list( $number, $time ) = $course_duration_arr;

			switch ( $time ) {
				case 'week':
					$course_duration_text = sprintf( _n( "%s week", "%s weeks", $number, 'course-builder' ), $number );
					break;
				case 'day':
					$course_duration_text = sprintf( _n( "%s day", "%s days", $number, 'course-builder' ), $number );
					break;
				case 'hour':
					$course_duration_text = sprintf( _n( "%s hour", "%s hours", $number, 'course-builder' ), $number );
					break;
				default:
					$course_duration_text = sprintf( _n( "%s minute", "%s minutes", $number, 'course-builder' ), $number );
			}

			return $course_duration_text;
		} else { // lesson, quiz duration
			$duration = get_post_meta( $id, '_lp_duration', true );

			if ( ! $duration ) {
				return '';
			}
			$duration = ( strtotime( $duration ) - time() ) / 60;
			$hour     = floor( $duration / 60 );
			$minute   = $duration % 60;

			if ( $hour && $minute ) {
				$time = $hour . esc_html__( 'h', 'course-builder' ) . ' ' . $minute . esc_html__( 'm', 'course-builder' );
			} elseif ( ! $hour && $minute ) {
				$time = $minute . esc_html__( 'm', 'course-builder' );
			} elseif ( ! $minute && $hour ) {
				$time = $hour . esc_html__( 'h', 'course-builder' );
			} else {
				$time = '';
			}

			return $time;
		}
	}
}