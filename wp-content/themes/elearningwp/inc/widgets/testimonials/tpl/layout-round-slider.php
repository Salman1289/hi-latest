<?php
$link         = $regency = '';
$limit        = ( $instance['limit'] && '' <> $instance['limit'] ) ? (int) $instance['limit'] : 10;
$item_visible = ( $instance['item_visible'] && '' <> $instance['item_visible'] ) ? (int) $instance['item_visible'] : 2;
$autoplay     = $instance['autoplay'] ? 'true' : 'false';
$mousewheel   = $instance['mousewheel'] ? 1 : 0;

$testomonial_args = array(
	'post_type'      => 'testimonials',
	'posts_per_page' => $limit,
	'ignore_sticky_posts' => true
);

$testimonial = new WP_Query( $testomonial_args );

?>
<div class="thim-round-testimonial">
	<div class="thim-round-testimonial-slider">
		<?php
		if ( $testimonial->have_posts() ) {
			if ( $instance['title'] ) {
				echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
			}
			//$html = '<div class="thim-testimonial-carousel layout-1 round_slider" data-tablet="'.$item_visible.'" data-visible="'.$item_visible.'" data-auto="' . $autoplay . '" data-pagination="true">';
			while ( $testimonial->have_posts() ) : $testimonial->the_post();
				$regency = get_post_meta( get_the_ID(), 'regency', true );
				$author = get_post_meta( get_the_ID(), 'author', true );
				$facebook = get_post_meta( get_the_ID(), 'thim_testimonials_facebook', true );
				$google = get_post_meta( get_the_ID(), 'thim_testimonials_google', true );
				$twitter = get_post_meta( get_the_ID(), 'thim_testimonials_twitter', true );
				$pinterest = get_post_meta( get_the_ID(), 'thim_testimonials_printerest', true );
				?>
				<?php
				$html = '<div class="image">';
				$html .= thim_get_feature_image( get_post_thumbnail_id(), 'full', 331, 326 );
				$html .= '</div>';
				$html .= '<div class="content">';
				$html .= '<ul class="socials">';
				$html .= '<li><a class="face" href="'.esc_url($facebook).'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
				$html .= '<li><a class="google" href="'.esc_url($google).'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
				$html .= '<li><a class="twitter" href="'.esc_url($twitter).'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
				$html .= '<li><a class="pinterest" href="'.esc_url($pinterest).'" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>';
				$html .= '</ul>';
				$html .= '<div class="description">"' . thim_excerpt(40) . '"</div>';
				$html .= '<div class="title">' . get_the_title() . ',</div>';
				$html .= '<div class="regency">' . esc_attr( $regency ) . '</div>';
				$html .= '</div>';
				?>
				<div class="item">
					<?php echo ent2ncr( $html ); ?>
				</div>
				<?php
			endwhile;
			//$html .= '</div>';
		}

		wp_reset_postdata();
		?>
	</div>
</div>


