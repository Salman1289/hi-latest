<?php

$column         = 'col-sm-4';
$data_column    = $class = '';
$kind           = $instance['kind'];
$limit          = $instance['limit'];
$columns        = $instance['columns'];
$social_share   = $instance['social_share'];
$courses_slider = $instance['slider-options']['courses_slider'];
$row            = $instance['slider-options']['row'];
$page_nav       = $instance['slider-options']['show_page_nav'];
$nav            = $instance['slider-options']['show_navigation'];
if ( $courses_slider == 'yes' ) {
	$column = "col-sm-12";
	$class  = "courses-media-slider owl-carousel owl-theme";
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
);

if ( $kind == 'latest' ) {
	$arr_query['orderby'] = 'date';
	$arr_query['order']   = 'DESC';
}


if ( $kind == 'popular' ) {
	$arr_query['post__in'] = lp_get_courses_popular();
}

if ( $kind == 'commingsoon' ) {
	global $wpdb;

	$the_query = $wpdb->prepare( "
	  SELECT p.ID, p.post_type, pm.*
	  FROM wp_posts as p LEFT JOIN wp_postmeta AS pm ON p.ID = pm.post_id
	  WHERE p.post_type = %s and pm.meta_key = %s and pm.meta_value = %s
 ", 'lp_course', '_lp_coming_soon', 'yes' );

	$post_in = $wpdb->get_col( $the_query );

	$arr_query['post__in'] = $post_in;
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

	while ( $courses->have_posts() ) : $courses->the_post();

		$course = LP_Course::get_course( get_the_ID() );

		$user = learn_press_get_current_user();
		$url  = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
		$count = $course->count_students();

		?>
		<article class="">
			<div class="wrapper-course-thumbnail">
				<?php
				$video_intro = get_post_meta( get_the_ID(), 'thim_course_media', true );
				if ( ! empty( $video_intro ) ) {
					echo '<a itemprop="url" class="icon-video" href="' . get_the_permalink( get_the_ID() ) . '"><i class="ion-ios-play-outline"></i></a> ';
				}
				if ( has_post_thumbnail() ) {
					echo '<a itemprop="url" class="course-thumbnail" href="' . get_the_permalink( get_the_ID() ) . '"> ';
					$attr            = array(
						'itemprop' => 'image'
					);
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
					$image_crop      = thim_aq_resize( $large_image_url[0], 820, 500, true );
					echo '<img src="' . $image_crop . '" alt= "' . get_the_title( get_the_ID() ) . '" title = "' . get_the_title( get_the_ID() ) . '" />';

					echo '</a>';
				} ?>
				<div class="info_course">
					<div class="course_title" itemprop="name">
						<h2>
							<a href="<?php the_permalink(); ?>" itemprop="url">
								<?php the_title(); ?>
							</a>
						</h2>
					</div>
					<div class="course_rating">
						<?php thim_course_ratings_count(); ?>
					</div>
					<?php if ( $social_share == true ) { ?>
						<ul class="course-sharing">
							<li>
								<a class="face" target="_blank" title="Share on Facebook." href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink( get_the_ID() ); ?>"><i class="fa fa-facebook"></i></a>
							</li>
							<li>
								<a class="twitter" target="_blank" title="Tweet this!" href="https://twitter.com/home?status=<?php echo get_the_permalink( get_the_ID() ); ?>"><i class="fa fa-twitter"></i></a>
							</li>
							<li>
								<a class="pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo get_the_permalink( get_the_ID() ); ?>&media=<?php echo esc_url( $url ); ?>"><i class="fa fa-pinterest"></i></a>
							</li>
							<li>
								<a class="google" target="_blank" href="https://plus.google.com/share?url=<?php echo get_the_permalink( get_the_ID() ); ?>"><i class="fa fa-google-plus"></i></a>
							</li>
						</ul>
					<?php } ?>
				</div>
			</div>
			<div class="meta_course page-title courses_single">
				<div class="heading_info">
					<ul>
						<li>
							<div class="wrapper-meta">
								<div class="author" itemprop="creator">
									<span class="avatar"><?php echo get_avatar( get_post_field( 'post_author', get_the_ID() ), 50 ); ?></span>
									<div class="info">
										<label><?php echo __( 'Teacher', 'elearningwp' ); ?></label>
										<a href="<?php echo esc_url( learn_press_user_profile_link( $course->post->post_author ) ); ?>">
											<span><?php echo get_the_author_meta( 'display_name', $course->post->post_author ); ?></span>
										</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="wrapper-meta">
								<label><?php echo __( 'Students', 'elearningwp' ); ?></label>
								<strong class="students">
									<?php printf( _n( '%d Student', '%d Students', $count, 'elearningwp' ), $count ); ?>
								</strong>
							</div>
						</li>
						<li>
							<div class="wrapper-meta">
								<?php learn_press_course_price(); ?>
							</div>
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
