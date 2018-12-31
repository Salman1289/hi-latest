<?php

$heading = $instance['heading_group'];
$kind    = $instance['kind'];
$cat     = $instance['cat'];
$limit   = $instance['limit'];


/*$courses_slider = $instance['slider-options']['courses_slider'];
$page_nav       = $instance['slider-options']['show_page_nav'];
$nav            = $instance['slider-options']['show_navigation'];*/

// Get courses
$query_course_args = array(
	'post_type'      => 'lp_course',
	'post_status'    => 'publish',
	'posts_per_page' => $limit,
	//	'fields' => 'ids',
);

if ( $cat ) {
	$query_course_args['tax_query'] = array(
		array(
			'taxonomy' => 'course_category',
			'field'    => 'slug',
			'terms'    => $cat,
		)
	);
}

switch ( $kind ) {
	case 'latest':
		$query_course_args['orderby'] = 'date';
		break;
	case 'popular':
		$query_course_args['post__in'] = lp_get_courses_popular();
		break;
	case 'commingsoon':
		if ( class_exists( 'LP_Addon_Coming_Soon_Course' ) ) {
			$query_course_args['meta_key']   = '_lp_coming_soon';
			$query_course_args['meta_value'] = 'yes';
		}
		break;
	default:
		$query_course_args['orderby'] = 'date';
		break;
}

$courses = new WP_Query( $query_course_args );
?>

<div class="thim-courses-megamenu">
	<?php
	if ( $heading['title'] ) {
		$heading_style = "color: {$heading['textcolor']};";
		if ( $heading['font_heading'] == 'custom' ) {
			if ( isset( $heading['custom_font_heading']['custom_font_size'] ) ) {
				$heading_style .= "font-size: {$heading['custom_font_heading']['custom_font_size']}px;";
			}
			if ( isset( $heading['custom_font_heading']['custom_font_weight'] ) ) {
				$heading_style .= "font-weight: {$heading['custom_font_heading']['custom_font_weight']};";
			}
		}
		echo '<' . $heading['size'] . ' style="' . $heading_style . '" class="widget-title">' . $heading['title'] . '</' . $heading['size'] . '>';
	}
	?>

	<?php if ( $courses->have_posts() ): ?>
		<div class="courses-wrapper">
			<?php while ( $courses->have_posts() ): $courses->the_post(); ?>
				<div class="course-item">
					<div class="featured-img">
						<a href="<?php the_permalink(); ?>"  itemprop="url" class="course-thumbnail">
							<span class="more-detail"><?php esc_html_e('Read More','elearningwp'); ?></span>
						</a>

						<?php echo thim_get_feature_image( get_post_thumbnail_id(), 'full', 180, 180, get_the_title() ); ?>
					</div>
					<a href="<?php the_permalink(); ?>" itemprop="url"><h5 class="title" ><?php the_title(); ?></h5></a>
					<div class="course-price">
						<?php learn_press_courses_loop_item_price(); ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
</div>

