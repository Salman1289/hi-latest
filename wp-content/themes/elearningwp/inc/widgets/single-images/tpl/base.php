<?php
$link_before      = $after_link = $image = $thim_animation = '';
$images_size = $instance['image_size'] ? $instance['image_size'] : 'thumbnail';
$default_img_size = array( 'thumbnail', 'medium', 'large', 'full' );

if ( ! in_array( $images_size, $default_img_size ) ) {
	preg_match_all( '!\d+!', $images_size, $custom_img_size );
	$src_args = wp_get_attachment_image_src( $instance['image'], 'full' );
	$src_link = thim_aq_resize($src_args[0],$custom_img_size[0][0],$custom_img_size[0][1],true);
}else{
	$src_args = wp_get_attachment_image_src( $instance['image'], $images_size );
	$src_link = $src_args[0];
}

$thim_animation .= thim_getCSSAnimation( $instance['css_animation'] );

if ( $src_link ) {
	$image       = '<img src ="' . $src_link . '" />';
}

if ( $instance['image_link'] ) {
	$link_before = '<a href="' . esc_url( $instance['image_link'] ) . '" target="' . esc_attr($instance['link_target']) . '">';
	$after_link  = "</a>";
}
if ( $instance['image_stype'] == "style-title" ) {
	echo '<div class="single-image-title ' . $instance['image_alignment'] . $thim_animation . '">';
	echo '<div class="single-image">' . $link_before . $image . $after_link . '</div>';
	echo '<div class="single-content">';
	echo '<h3>' . esc_html( $instance['image_title'] ) . '</h3>';
	echo '<div class="description">' . esc_html( $instance['image_description'] ) . '</div>';
	echo '<a class="link" href="' . esc_url( $instance['image_link'] ) . '">' . esc_html( $instance['image_button'] ) . '</a>';
	echo '</div>';
	echo '</div>';
} else {
	echo '<div class="single-image ' . $instance['image_alignment'] . $thim_animation . '">' . $link_before . $image . $after_link . '</div>';
}
