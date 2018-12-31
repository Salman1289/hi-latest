<?php

$column         = 'col-sm-4';
$data_column    = $class = '';
$kind           = $instance['kind'];
$limit          = $instance['limit'];
$columns        = $instance['columns'];
$courses_slider = $instance['slider-options']['courses_slider'];
$row            = $instance['slider-options']['row'];
$page_nav       = $instance['slider-options']['show_page_nav'];
$nav            = $instance['slider-options']['show_navigation'];
$cat            = $instance['cat'];

if ( $cat ) {
	$tax_query_value = array(
		array(
			'taxonomy' => 'course_category',
			'field'    => 'slug',
			'terms'    => $cat,
		)
	);
} else {
	$tax_query_value = '';
}

if ( $courses_slider == 'yes' ) {
	$column = "col-sm-12";
	$class  = " courses-slider owl-carousel owl-theme";
	if ( $row ) {
		$data_column = ' data-column ="' . $row . '"';
	}
} else {
	if ( $columns ) {
		$column = 'col-sm-' . ( 12 / $columns );
	}
}

if ( $page_nav ) {
	$data_column .= ' data-show-page-nav ="' . $page_nav . '"';
}

if ( $nav ) {
	$data_column .= ' data-show-nav = "' . $nav . '"';
}

$arr_query = array(
	'post_type'      => 'lp_course',
	'post_status'    => 'publish',
	'posts_per_page' => $limit,
	'tax_query'      => $tax_query_value,
);

if ( $kind == 'latest' ) {
	$arr_query['orderby'] = 'date';
	$arr_query['order']   = 'DESC';
}


if ( $kind == 'popular' ) {
	global $wpdb;

	$the_query = $wpdb->prepare( "
	  SELECT ID, a+IF(b IS NULL, 0, b) AS students FROM(
		SELECT p.ID as ID, IF(pm.meta_value, pm.meta_value, 0) as a, (
	SELECT COUNT(*)
  FROM (SELECT COUNT(item_id), item_id, user_id FROM wp_learnpress_user_items GROUP BY item_id, user_id) AS Y
  GROUP BY item_id
  HAVING item_id = p.ID
) AS b
FROM wp_posts p
LEFT JOIN wp_postmeta AS pm ON p.ID = pm.post_id  AND pm.meta_key = %s
WHERE p.post_type = %s AND p.post_status = %s
GROUP BY ID
) AS Z
ORDER BY students DESC
 ", '_lp_students', 'lp_course', 'publish' );

	$post_in = $wpdb->get_col( $the_query );

	$arr_query['post__in'] = $post_in;
	$arr_query['orderby']  = 'post__in';

}

if ( $kind == 'commingsoon' ) {
	global $wpdb;

	$the_query = $wpdb->prepare( "
	  SELECT p.ID, p.post_type, pm.*
	  FROM wp_posts as p LEFT JOIN wp_postmeta AS pm ON p.ID = pm.post_id
	  WHERE p.post_type = %s and pm.meta_key = %s and pm.meta_value = %s
 ", 'lp_course', '_lp_coming_soon', 'yes' );

	//var_dump($the_query);

	$post_in = $wpdb->get_col( $the_query );

	$arr_query['post__in'] = $post_in;
	$arr_query['orderby']  = 'post__in';

}

//var_dump($arr_query);

$courses = new WP_Query( $arr_query );
?>
<?php
$css = $desc_css = '';
// css header
$css .= ( $instance['heading_group']['textcolor'] ) ? 'color:' . $instance['heading_group']['textcolor'] . ';' : '';
if ( $instance['heading_group']['font_heading'] == 'custom' ) {
	$css .= ( $instance['heading_group']['custom_font_heading']['custom_font_size'] ) ? 'font-size:' . $instance['heading_group']['custom_font_heading']['custom_font_size'] . 'px;line-height:' . $instance['heading_group']['custom_font_heading']['custom_font_size'] . 'px;' : '';
	$css .= ( $instance['heading_group']['custom_font_heading']['custom_font_weight'] ) ? 'font-weight:' . $instance['heading_group']['custom_font_heading']['custom_font_weight'] : '';
}
$css = ( $css ) ? 'style="' . $css . '"' : '';
//end css header
// css desc
$desc_css .= ( $instance['desc_group']['des_color'] != '' ) ? 'color: ' . $instance['desc_group']['des_color'] . ';' : '';
$desc_css .= ( $instance['desc_group']['des_font_size'] != '' ) ? 'font-size: ' . $instance['desc_group']['des_font_size'] . 'px;' : '';
$desc_css .= ( $instance['desc_group']['des_font_weight'] != '' ) ? 'font-weight: ' . $instance['desc_group']['des_font_weight'] . ';' : '';
$desc_css = ( $desc_css ) ? 'style="' . $desc_css . '"' : '';
//end css desc
if ( $instance['heading_group']['title'] ) {
	echo '<div class="widget-box-title tCenter">';
	echo '<' . $instance['heading_group']['size'] . ' ' . $css . ' class="title">' . $instance['heading_group']['title'] . '</' . $instance['heading_group']['size'] . '>';
	if ( $instance['desc_group']['des'] ) {
		echo '<p ' . $desc_css . '>' . $instance['desc_group']['des'] . '</p>';
	}
	echo '</div>';
}
?>
<?php if ( $courses->have_posts() ) :
	echo '<div class="' . $class . ' tCenter"' . $data_column . ' itemscope itemtype="http://schema.org/CreativeWork">';
	$i             = 1;
	$courses_count = $courses->found_posts;
	if ( $courses_count > $limit ) {
		$courses_count = $limit;
	}

	// Get all ids of courses to an array and count student for that courses
	//
	$course_ids = wp_list_pluck( $courses->posts, 'ID' );
	_learn_press_count_users_enrolled_courses( $course_ids );

	while ( $courses->have_posts() ) : $courses->the_post();

		$course      = LP_Course::get_course( get_the_ID() );
		$is_required = $course->is_required_enroll();
		$user        = learn_press_get_current_user();

		?>
		<article class="">
			<div class="wrapper-course-thumbnail">
				<?php
				if ( has_post_thumbnail() ) {
					echo '<a itemprop="url" class="course-thumbnail" href="' . get_the_permalink( get_the_ID() ) . '"> ';
					$attr = array(
						'itemprop' => 'image'
					);
					echo thim_get_feature_image( get_post_thumbnail_id(), 'full', '850', '500', get_the_title() );
					echo '</a>';
				} ?>
				<div class="info_course">
					<?php
					if ( learn_press_is_coming_soon( $course->id ) && learn_press_is_show_coming_soon_countdown( $course->id ) ) {
						$end_time = learn_press_get_coming_soon_end_time( $course->id, 'Y-m-d H:i:s' );
						$datetime = new DateTime( $end_time );
						$timezone = get_option( 'gmt_offset' );
						?>
						<div class="countdown learnpress-course-coming-soon" data-desktopsmall="1" data-itemtablet="1" data-itemmobile_horizontal="1" data-itemmobile="1" data-showtext="1" data-time="<?php echo esc_attr( $datetime->format( DATE_ATOM ) ) ?>" data-speed="500" data-timezone="<?php echo $timezone; ?>"></div>
					<?php } ?>
					<div class="course_title" itemprop="name">
						<h2>
							<a href="<?php the_permalink(); ?>" itemprop="url">
								<?php the_title(); ?>
							</a>
						</h2>
					</div>
					<span class="course_rating">
						<?php thim_course_ratings_count(); ?>
					</span>
				</div>
			</div>
			<div class="meta_course page-title courses_single">
				<div class="heading_info">
					<ul>
						<li>
							<?php learn_press_course_instructor(); ?>
						</li>
						<li>
							<label><?php echo __( 'Students', 'elearningwp' ); ?></label>
							<?php learn_press_course_students(); ?>
						</li>
						<li>
							<?php learn_press_course_price(); ?>
						</li>
						<li>
							<?php learn_press_course_buttons(); ?>
						</li>
					</ul>
				</div>
			</div>
		</article>
		<?php

		$i ++;
	endwhile;
	echo '</div><!--end-->';
endif;
wp_reset_query(); ?>
