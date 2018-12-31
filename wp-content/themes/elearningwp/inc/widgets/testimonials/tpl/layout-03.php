<?php
$thim_animation = $html = $layout = '';
$thim_animation .= thim_getCSSAnimation( $instance['css_animation'] );
$layout = $instance['layout'];
$number = 4;
if ( $instance['number'] <> '' ) {
	$number = $instance['number'];
}

$testomonial_args = array(
	'post_type'      => 'testimonials',
	'posts_per_page' => $number
);

$lop_testimonial = new WP_Query( $testomonial_args );
$css             = $content_css = $title_css = $regency_css = '';
// css header
$css .= ( $instance['heading_group']['textcolor'] ) ? 'color:' . $instance['heading_group']['textcolor'] . ';' : '';
if ( $instance['heading_group']['font_heading'] == 'custom' ) {
	$css .= ( $instance['heading_group']['custom_font_heading']['custom_font_size'] ) ? 'font-size:' . $instance['heading_group']['custom_font_heading']['custom_font_size'] . 'px;line-height:' . $instance['heading_group']['custom_font_heading']['custom_font_size'] . 'px;' : '';
	$css .= ( $instance['heading_group']['custom_font_heading']['custom_font_weight'] ) ? 'font-weight:' . $instance['heading_group']['custom_font_heading']['custom_font_weight'] : '';
}
$css = ( $css ) ? 'style="' . $css . '"' : '';
// end css header
// css content
$content_css .= ( $instance['t_config']['bg-color'] ) ? 'background:' . $instance['t_config']['bg-color'] . ';' : '';
$content_css .= ( $instance['t_config']['t_text_color'] ) ? 'color:' . $instance['t_config']['t_text_color'] : '';
$content_css = ( $content_css ) ? 'style="' . $content_css . '"' : '';
$arrow_css   = ( $instance['t_config']['bg-color'] ) ? 'style="border-top: 15px solid ' . $instance['t_config']['bg-color'] . '"' : '';
// end  css content
$title_css .= ( $instance['t_config']['author_color'] ) ? 'style="color:' . $instance['t_config']['author_color'] . '"' : '';
$regency_css .= ( $instance['t_config']['regency_color'] ) ? 'style="color:' . $instance['t_config']['regency_color'] . '"' : '';

if ( $instance['heading_group']['title'] ) {
	echo '<div class="widget-box-title">';
	echo '<' . $instance['heading_group']['size'] . ' ' . $css . ' class="title">' . $instance['heading_group']['title'] . '</' . $instance['heading_group']['size'] . '>';
	echo '</div>';
}
if ( $lop_testimonial->have_posts() ) {
	$html .= '<div class="sc-testimonials ' . $layout . $thim_animation . ' owl-carousel owl-theme">';
	while ( $lop_testimonial->have_posts() ): $lop_testimonial->the_post();
		$html .= '<div class="item_testimonial clearfix">';
		$web_link        = get_post_meta( get_the_ID(), 'website_url', true );
		$before_web_link = $after_web_link = '';
		if ( $web_link <> '' ) {
			$before_web_link = '<a href="' . $web_link . '">__';
			$after_web_link  = ",</a>";
		}
		$regency = get_post_meta( get_the_ID(), 'regency', true );
		$html .= '<div class="testimonial-image">';
		if ( has_post_thumbnail() ) {
			$html .= '<div class="avatar-testimonial">';
			$html .= get_the_post_thumbnail( get_the_ID(), 'full');
			$html .= '</div>';
		}
		$html .= '</div>';
		$html .= '<div class="testimonial_content" ' . $content_css . '>';
		$html .= get_the_content();
		$html .= '<div class="title-regency">';
		$html .= '<h6 ' . $title_css . '> ' . $before_web_link . the_title( ' ', ' ', false ) . $after_web_link . ' </h6>';
		if ( $regency <> '' ) {
			$html .= '<div class="regency" ' . $regency_css . '>' . $regency . '</div>';
		}
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
	endwhile;
	$html .= '</div>';
}
wp_reset_postdata();
echo ent2ncr( $html );