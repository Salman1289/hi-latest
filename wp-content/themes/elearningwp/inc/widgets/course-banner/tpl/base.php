<?php
$title   = $instance['title'];
$cols   = $instance['cols'];

?>
<div class="course_banners">
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
    <div class="grid_type">
        <?php
        foreach ( $instance['banner_frames'] as $frame ) {
            if ( empty( $frame['bg_image'] ) ) {
                $background_image = false;
            } else {
                $background_image     = wp_get_attachment_image_src( $frame['bg_image'], 'full' );
                $background_image_url = 'background-image: url(' . esc_url( $background_image['0'] ) . ');';
            }
            $cat = get_term_by('id', $frame['cat_id'], 'course_category');
        ?>
        <div class="item_col_<?php echo $cols;?>">
            <div class="item_inner <?php echo $frame['type_banner'];?>" style="<?php echo $background_image_url;?>">
                <div class="content_banner">
                    <?php
                    if($frame['type_banner'] == 'horizontal') echo '<div class="wrap_horizontal">';
                    ?>
                    <?php
                    if ( !empty( $frame['icon'] ) ) {
                        $icon_image     = wp_get_attachment_image_src( $frame['icon'], 'full' );
                        $icon_image_url = esc_url( $icon_image['0'] );
                        echo '<img src="'.$icon_image_url.'" alt="">';
                    }
                    ?>
                    <div class="info_course">
                        <h2>
                            <a href="<?php echo esc_url( get_category_link( $frame['cat_id'] ) );?>"><?php echo $cat->name;?></a>
                        </h2>
                        <span><?php echo $cat->description;?></span>
                    </div>
                    <?php
                    if($frame['type_banner'] == 'horizontal') echo '</div>';
                    ?>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
