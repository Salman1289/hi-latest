<?php
/**
 * Template for displaying archive course content.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-archive-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

global $post, $wp_query, $lp_tax_query, $wp_query;

if ( is_tax() ) {
	$total = get_queried_object();
	$total = $total->count;
} elseif ( ! empty( $_REQUEST['s'] ) ) {
	$total = $wp_query->found_posts;
} else {
	$total = wp_count_posts( 'lp_course' );
	$total = $total->publish;
}

if ( $total == 0 ) {
	echo '<p class="message message-error">' . esc_html__( 'There are no available courses!', 'elearningwp' ) . '</p>';

	return;
} elseif ( $total == 1 ) {
	$index = esc_html__( 'Showing only one result', 'elearningwp' );
} else {
	$courses_per_page = absint( LP()->settings->get( 'archive_course_limit' ) );
	if ( ! empty( $_REQUEST['number'] ) ) {
		$courses_per_page = $_REQUEST['number'];
	}

	if ( is_front_page() ) {
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
	} else {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	}

	$from = 1 + ( $paged - 1 ) * $courses_per_page;
	$to   = ( $paged * $courses_per_page > $total ) ? $total : $paged * $courses_per_page;

	if ( $from == $to ) {
		$index = sprintf(
			esc_html__( 'Showing last course of %s results', 'elearningwp' ),
			$total
		);
	} else {
		$index = sprintf(
			esc_html__( 'Showing %s-%s of %s results', 'elearningwp' ),
			$from,
			$to,
			$total
		);
	}
}

/**
 * @since 3.0.0
 */
do_action( 'learn-press/before-main-content' );

/**
 * @since 3.0.0
 */
do_action( 'learn-press/archive-description' );

if ( LP()->wp_query->have_posts() ) {
	?>
	<div class="thim-course-top row">
		<div class="col-xs-6">
			<div class="display grid-list-switch lpr_course-switch" data-cookie="lpr_course-switch">
				<a href="javascript:;" class="list switchToGrid"><i class="fa fa-th-large"></i></a>
				<a href="javascript:;" class="grid switchToList"><i class="fa fa-list-ul"></i></a>
			</div>
			<div class="course-index">
				<span><?php echo( $index ); ?></span>
			</div>
		</div>
		<div class="col-xs-6">
			<div class="courses-searching">
				<form method="get" action="<?php echo esc_url( get_post_type_archive_link( 'lp_course' ) ); ?>">
					<input type="text" value="" name="s" placeholder="<?php esc_html_e( 'Search our courses', 'elearningwp' ) ?>" class="thim-s form-control courses-search-input" autocomplete="off" />
					<input type="hidden" value="course" name="ref" />
					<button type="submit"><i class="fa fa-search"></i></button>
					<span class="widget-search-close"></span>
				</form>
				<ul class="courses-list-search list-unstyled"></ul>
			</div>
		</div>
	</div>

	<div class="archive-courses course-list archive_switch" itemscope itemtype="http://schema.org/ItemList">

		<?php do_action( 'learn-press/before-courses-loop' ); ?>

		<div class="row content_archive wrapper-item">

			<?php
			while ( LP()->wp_query->have_posts() ) : LP()->wp_query->the_post();

				learn_press_get_template_part( 'content', 'course' );

			endwhile;
			?>

		</div>

		<?php do_action( 'learn-press/after-courses-loop' ); ?>

	</div>
	<?php
} else {
	learn_press_display_message( __( 'No course found.', 'elearningwp' ), 'error' );
}

do_action( 'learn-press/after-main-content' );

