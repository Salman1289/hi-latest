<?php
/**
 * Template for displaying the thumbnail of a course
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 2.0.6
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $post, $course;
$thum_course_page = LP()->settings->get( 'course_thumbnail_image_size' );
$thumb_width = isset($thum_course_page['width']) ? $thum_course_page['width'] : 436;
$thumb_height = isset($thum_course_page['height']) ? $thum_course_page['height'] : 300;

if ( is_singular() ) {
    $video_intro = get_post_meta( get_the_ID(), 'thim_course_media', true );
    $check_iframe = preg_match  ('/<iframe(.+)\"/', $video_intro, $check_iframe);
    if ( !empty( $video_intro ) ) {
        if( has_post_thumbnail() ) :
        ?>
            <div class="course-thumbnail">
                <?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
                <!-- Like so: -->
                <?php if($check_iframe == 0) { ?>
                    <a href="<?php echo esc_url($video_intro); ?>" class="open-popup-media media-link"><i class="ion-ios-play-outline"></i></a>
                <?php } else { ?>
                    <a href="#iframe-popup" class="open-popup-media media-iframe"><i class="ion-ios-play-outline"></i></a>
                    <div id="iframe-popup" class="white-popup mfp-hide">
                        <?php echo $video_intro; ?>
                    </div>
                <?php } ?>
            </div>
            <?php
        endif;?>
        <?php
    } else {
        if( has_post_thumbnail() ) :
            ?>
            <div class="course-thumbnail">
                <?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
            </div>
            <?php
        endif;
    }

} else {
    ?>
    <div class="course-thumbnail">
        <a href="<?php echo get_the_permalink(); ?>">
            <?php
            echo thim_get_feature_image( get_post_thumbnail_id( get_the_ID() ), 'full', $thumb_width, $thumb_height, get_the_title() );
            ?>
        </a>
        <?php thim_course_wishlist_button(); ?>
        <?php echo '<a class="course-readmore" href="' . esc_url( get_the_permalink() ) . '">' . esc_html__( 'Read More', 'elearningwp' ) . '</a>'; ?>
    </div>
    <?php
}

?>