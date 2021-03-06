<?php
$column           = 'col-sm-4';
$data_column      = $class = '';
$kind             = $instance['kind'];
$cat              = $instance['cat'];
$limit            = $instance['limit'];
$columns          = $instance['columns'];
$courses_slider   = $instance['slider-options']['courses_slider'];
$row              = $instance['slider-options']['row'];
$page_nav         = $instance['slider-options']['show_page_nav'];
$nav              = $instance['slider-options']['show_navigation'];
$thum_course_page = LP()->settings->get( 'course_thumbnail_image_size' );
if ( $courses_slider == 'yes' ) {
	$column = "col-sm-12";
	$class  = " courses-slider owl-carousel owl-theme";
	if ( $columns ) {
		$data_column = ' data-column ="' . $columns . '"';
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
	$arr_query['orderby'] = 'date';
	$arr_query['order']   = 'DESC';
}

if ( $kind == 'popular' ) {
	$arr_query['post__in'] = lp_get_courses_popular();
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
	echo '<div class="widget-box-title">';
	echo '<' . $instance['heading_group']['size'] . ' ' . $css . ' class="title">' . $instance['heading_group']['title'] . '</' . $instance['heading_group']['size'] . '>';
	if ( $instance['desc_group']['des'] ) {
		echo '<p ' . $desc_css . '>' . $instance['desc_group']['des'] . '</p>';
	}
	if ( $instance['link_all_courses'] == '1' ) {
		echo '<a href="' . get_post_type_archive_link( 'lp_course' ) . '" class="browse-all-courses">' . __( "Browse All Courses", "elearningwp" ) . '<i class="fa fa-angle-double-right"></i></a>';
	}
	echo '</div>';
}

?>
<?php if ( $courses->have_posts() ) :
	echo '<div class="wrapper-item archive-courses row' . $class . '"' . $data_column . ' itemscope itemtype="http://schema.org/CreativeWork">';

	while ( $courses->have_posts() ) : $courses->the_post();

		$course = LP_Course::get_course( get_the_ID() );

		// Get image size
		$image_size = '';
		if ( $instance['image_size'] ) {
			preg_match_all( '/\d+/', $instance['image_size'], $size_matches );
			if ( $size_matches[0] ) {
				if ( isset ( $size_matches[0][0] ) && isset ( $size_matches[0][1] ) ) {
					$image_size = array( $size_matches[0][0], $size_matches[0][1] );
				} else {
					$image_size = array( 436, 300 );
				}
			}
		}
		$thumb_width = $thumb_height = '';
		if ( $image_size ) {
			$thumb_width  = $image_size[0];
			$thumb_height = $image_size[1];
		} else {
			$thumb_width  = isset( $thum_course_page['width'] ) ? $thum_course_page['width'] : 450;
			$thumb_height = isset( $thum_course_page['height'] ) ? $thum_course_page['height'] : 450;
		}

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
					<?php
					$lp_featured = get_post_meta( get_the_ID(), '_lp_featured', true );
					if ( $lp_featured == 'yes' ) {
						echo '<label>' . esc_html__( 'Featured', 'elearningwp' ) . '</label>';
					} ?>
					<div class="teacher_course">
						<?php thim_author_courses(); ?>
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
					<?php learn_press_courses_loop_item_price(); ?>
				</div>
				<div class="course-students">
					<?php learn_press_course_students(); ?>

					<?php if ( class_exists( 'LP_Addon_Course_Review' ) ): ?>
						<div class="course-rating">
							<?php learn_press_course_review_template( 'course-rate.php' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</article>
	<?php
	endwhile;
	echo '</div><!--end-->';
endif;
wp_reset_query(); ?>
