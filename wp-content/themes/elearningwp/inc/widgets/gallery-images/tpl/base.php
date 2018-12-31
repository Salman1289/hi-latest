<?php
$theme_options_data = get_theme_mods();
$color_opacity = thim_hex2rgb( $theme_options_data['thim_body_primary_color'] );
$overlay_primary = 'rgba(' . $color_opacity[0] . ',' . $color_opacity[1] . ',' . $color_opacity[2] . ',0.6)';
$link_before = $after_link = $image = $css_animation = $number = $style_width = '';
if ( $instance['image'] ) {
	if ( $instance['link_target'] ) {
		$t = 'target="_blank"';
	} else {
		$t = '';
	}
	if ( $instance['number'] ) {
		$number = 'data-column-slider="' . $instance['number'] . '"';
	}

	$img_id = explode( ",", $instance['image'] );
//	if ( $instance['image_link'] ) {
//		$img_url = explode( ",", $instance['image_link'] );
//	}

	$css_animation = $instance['css_animation'];
	$css_animation = thim_getCSSAnimation( $css_animation );
	if ( $instance['gallery_layout'] == 'default' ) {
		$width       = 100 / $instance['number'];
		$style_width = ' style="width:' . $width . '%"';
	}
	echo '<div class="thim-gallery-images-' . $instance['gallery_layout'] . ' number_cols_' . $instance['number'] . ' ' . $instance['widget-class'] . ' gallery-img ' . esc_attr( $css_animation ) . '" ' . $number . '>';
	$i = 0;
	foreach ( $img_id as $id ) {
		$src = wp_get_attachment_image_src( $id, $instance['image_size'] );
		if ( $src ) {
			$img_size = '';
			$src_size = @getimagesize( $src['0'] );
			$image    = '<img src ="' . esc_url( $src['0'] ) . '" ' . $src_size[3] . ' alt=""/>';
		}
		if ( $instance['image_link'] ) {
			$link_before = '<a class="image-popup" ' . $t . ' href="' . esc_url( $src['0'] ) . '">';
			$after_link  = "<span class='mark' style='background-color: ". $overlay_primary ."'></span></a>";
		}
		echo '<div class="item"' . $style_width . '>' . $link_before . $image . $after_link . "</div>";
		$i ++;
	}
	echo "</div>";
}