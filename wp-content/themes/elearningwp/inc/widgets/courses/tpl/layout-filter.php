<?php

global $post;

$column = "col-md-" . 12/$instance['columns'];
$kind      = $instance['kind'];
$limit     = $instance['limit'];
$thum_course_page = LP()->settings->get( 'course_thumbnail_image_size' );
$courses_page_id = learn_press_get_page_id( 'courses' );
$courses_page    = get_post( $courses_page_id );
$arr_query = array(
    'post_type'      => 'lp_course',
    'post_status'    => 'publish',
    'posts_per_page' => $limit
);
if ( $kind == 'latest' ) {
    $arr_query['orderby'] = 'post_date';
    $arr_query['order']   = 'DESC';
}
global $wpdb;
if ( $kind == 'popular' ) {


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

$query = $wpdb->get_results( $wpdb->prepare(
    "
				  SELECT      t1.term_id, t2.name
				  FROM        $wpdb->term_taxonomy AS t1
				  INNER JOIN $wpdb->terms AS t2 ON t1.term_id = t2.term_id
				  WHERE t1.taxonomy = %s
				  AND t1.count > %d
				  ",
    'course_category', 0
) );

$cats        = array();
$cats['all'] = 'All';

?>
<div class="filter_courses">
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
        echo '</div>';
    }
    ?>

    <ul class="filter">
        <li class="active" rel="<?php echo esc_url( home_url() ) . '/' . $courses_page->post_name;?>/?cols=<?php echo $instance['columns'];?>&number=<?php echo $limit;?>"><a href=""><?php echo esc_html__( 'All', 'elearningwp' );?></a></li>
        <?php
        if ( ! empty( $query ) ) {
            foreach ( $query as $key => $value ) {
                ?>
                <li rel="<?php echo esc_url( get_category_link( $value->term_id ) );?>/?cols=<?php echo $instance['columns'];?>&number=<?php echo $limit;?>"><a href=""><?php echo $value->name;?></a></li>
                <?php
            }
        }
        ?>

    </ul>

    <?php if ( $courses->have_posts() ) :
        echo '<div class="wrapper-item cols_num_' . $instance['columns'] . ' archive-courses row' . $class . '"' . $data_column . ' itemscope itemtype="http://schema.org/CreativeWork">';
        $i             = 1;
        $courses_count = $courses->found_posts;
        if ( $courses_count > $limit ) {
            $courses_count = $limit;
        }

	    // Get all ids of courses to an array and count student for that courses
	    //
	    $course_ids = wp_list_pluck($courses->posts, 'ID');
	    _learn_press_count_users_enrolled_courses($course_ids);

        while ( $courses->have_posts() ) : $courses->the_post();

            $course      = LP_Course::get_course( get_the_ID() );
            $is_required = $course->is_required_enroll();
            $thumb_width = isset($thum_course_page['width']) ? $thum_course_page['width'] : 450;
            $thumb_height = isset($thum_course_page['height']) ? $thum_course_page['height'] : 450;

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
                        if($lp_featured == 'yes') {
                            echo '<label>'.esc_html__('Featured', 'elearningwp').'</label>';
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

            $i ++;
        endwhile;
        echo '</div><!--end-->';
    endif;
    wp_reset_query(); ?>
</div>