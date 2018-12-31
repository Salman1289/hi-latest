<?php
/**
 * Template for displaying archive course content
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post, $wp_query;


if ( is_tax() ) {
	$total = get_queried_object();
	$total = $total->count;
} elseif ( !empty( $_REQUEST['s'] ) ) {
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
	if ( !empty( $_REQUEST['number'] ) ) {
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
?>
<?php //get_header(); ?>

<?php //do_action( 'learn_press_before_main_content' ); ?>

<?php if ( $wp_query->have_posts() ) : ?>


	<div class="thim-course-top">
		<div class="row">
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
					<form method="get" action="<?php echo esc_url( get_post_type_archive_link('lp_course') ); ?>">
						<input type="text" value="" name="s" placeholder="<?php esc_html_e( 'Search our courses', 'elearningwp' ) ?>" class="thim-s form-control courses-search-input" autocomplete="off" />
						<input type="hidden" value="course" name="ref" />
						<button type="submit"><i class="fa fa-search"></i></button>
						<span class="widget-search-close"></span>
					</form>
					<ul class="courses-list-search list-unstyled"></ul>
				</div>
			</div>
		</div>
	</div>

<div class="archive-courses course-list archive_switch" itemscope itemtype="http://schema.org/ItemList">

	<?php do_action( 'learn_press_before_courses_loop' ); ?>

	<div class="row content_archive wrapper-item">

		<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

			<?php learn_press_get_template_part( 'content', 'course' ); ?>

		<?php endwhile; ?>

	</div>

	<?php do_action( 'learn_press_after_courses_loop' ); ?>

</div>

<?php endif; ?>

<?php //do_action( 'learn_press_after_main_content' ); ?>

<?php //get_footer(); ?>
