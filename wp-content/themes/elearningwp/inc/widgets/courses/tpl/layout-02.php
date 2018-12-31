<?php

global $post;

$kind      = $instance['kind'];
$limit     = $instance['limit'];
$cat       = $instance['cat'];

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

$arr_query = array(
	'post_type'      => 'lp_course',
	'post_status'    => 'publish',
	'posts_per_page' => $limit,
	'tax_query'      => $tax_query_value,
);
if ( $kind == 'latest' ) {
	$arr_query['orderby'] = 'post_date';
	$arr_query['order']   = 'DESC';
}

if ( $kind == 'popular' ) {
	global $wpdb;

	$the_query = $wpdb->get_col(
		$wpdb->prepare( "
			SELECT p.ID, if(pm.meta_value, pm.meta_value, 0) + (select count(item_id) from {$wpdb->prefix}learnpress_user_items where item_id=p.ID) as students
			FROM {$wpdb->posts} p
			LEFT JOIN {$wpdb->postmeta} AS pm ON p.ID = pm.post_id  AND pm.meta_key = %s
			LEFT JOIN {$wpdb->prefix}learnpress_user_items AS uc ON p.ID = uc.item_id
			WHERE p.post_type = %s and p.post_status='publish'
			ORDER BY students DESC
		", '_lp_students', 'lp_course' )
	);

	$arr_query['post__in'] = $the_query;
	$arr_query['orderby']  = 'post__in';
}


$courses = new WP_Query( $arr_query );

?>
<?php
$css = $desc_css = '';
// css header
$css .= ( $instance['heading_group']['textcolor'] ) ? 'color:' . $instance['heading_group']['textcolor'] . ';' : '';
if ( $instance['heading_group']['font_heading'] == 'custom' ) {
	$css .= ( $instance['heading_group']['custom_font_heading']['custom_font_size'] ) ? 'font-size:' . $instance['heading_group']['custom_font_heading']['custom_font_size'] . 'px;line-height:' . $instance['heading_group']['custom_font_heading']['custom_font_size'] . 'px;' : '';
	$css .= ( $instance['heading_group']['custom_font_heading']['custom_font_weight'] ) ? 'font-weight:' . $instance['heading_group']['custom_font_heading']['custom_font_weight'] . 'px' : '';
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
	echo '<div class="widget-box-title layout-02">';
	echo '<' . $instance['heading_group']['size'] . ' ' . $css . ' class="title">' . $instance['heading_group']['title'] . '</' . $instance['heading_group']['size'] . '>';
	if ( $instance['desc_group']['des'] ) {
		echo '<p ' . $desc_css . '>' . $instance['desc_group']['des'] . '</p>';
	}
	echo '</div>';
}
?>
<?php if ( $courses->have_posts() ) :
	echo '<ul class="courses-layout-02">';
	while ( $courses->have_posts() ) : $courses->the_post();

		$course      = LP_Course::get_course( $post->ID );
		$is_required = $course->is_required_enroll();
		?>
		<li>
			<div class="course-thumbnail">
				<?php
				if ( has_post_thumbnail( $post->ID ) ) {
					echo '<a href="' . get_the_permalink( $post->ID ) . '"> ';
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
					$width_data      = $large_image_url[1];
					$height_data     = $large_image_url[2];
					if ( ! ( $width_data > 60 ) || ! ( $height_data > 50 ) ) {
						echo '<img src="' . $large_image_url[0] . '" alt= "' . get_the_title( $post->ID ) . '" title = "' . get_the_title( $post->ID ) . '" />';
					} else {
						$crop       = ( $height_data < 50 ) ? false : true;
						$image_crop = thim_aq_resize( $large_image_url[0], 60, 50, $crop );
						echo '<img src="' . $image_crop . '" alt= "' . get_the_title( $post->ID ) . '" title = "' . get_the_title( $post->ID ) . '" width="60" height="50" />';
					}
					echo '</a>';
				} ?>
			</div>
			<div class="inner-course">
				<h2 class="course-title">
					<a href="<?php the_permalink( $post->ID ); ?>">
						<?php echo get_the_title( $post->ID ); ?>
					</a>
				</h2>
				<div class="course-price">
					<?php if ( $course->is_free() || ! $is_required ) : ?>
						<?php esc_html_e( 'Free', 'elearningwp' ); ?>
					<?php else: $price = learn_press_format_price( $course->get_price(), true ); ?>
						<?php echo esc_html( $price ); ?>
					<?php endif; ?>
					<meta itemprop="priceCurrency" content="<?php echo learn_press_get_currency_symbol(); ?>" />
				</div>
			</div>
		</li>
		<?php
	endwhile;
	echo '</ul><!--end-->';
endif;
wp_reset_query();
?>
