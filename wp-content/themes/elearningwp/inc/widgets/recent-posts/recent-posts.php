<?php

/**
 * Extend Recent Posts Widget
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */
Class Thim_Recent_Posts_Widgets extends WP_Widget_Recent_Posts {

	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$category  = isset( $instance['category'] ) ? $instance['category'] : - 1;

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'elearningwp' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to show:', 'elearningwp' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>

		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php esc_html_e( 'Display post date?', 'elearningwp' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Select category', 'elearningwp' ); ?>:</label>
			<?php wp_dropdown_categories( array(
				'show_option_none' => ' ',
				'name'             => $this->get_field_name( 'category' ),
				'selected'         => $category
			) ); ?>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['category']  = isset( $new_instance['category'] ) ? $new_instance['category'] : - 1;

		return $instance;
	}

	function widget( $args, $instance ) {

		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_attr__( 'Recent Posts', 'kita' ) : $instance['title'], $instance, $this->id_base );

		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
			$number = 10;
		}

		$queru_args = array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		);

		$instance['category'] = !empty($instance['category']) ? $instance['category'] : '-1';
		if ( '-1' != $instance['category'] ) {
			$queru_args['cat'] = $instance['category'];
		}

		$r = new WP_Query( apply_filters( 'widget_posts_args', $queru_args ) );
		if ( $r->have_posts() ) :

			echo ent2ncr( $before_widget );
			if ( $title ) {
				echo ent2ncr( $before_title . $title . $after_title );
			} ?>
			<ul class="list-unstyled">
				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<li class="entry-wrap media">
						<div class="entry-thumbnail mr-3">
							<?php
							$postid = get_the_ID();
							echo thim_feature_image( 50, 50, true ); ?>
						</div>
						<div class="entry-body media-body">
							<h5 class="entry-title">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</h5>
							<?php if ( isset( $instance['show_date'] ) ) : ?>
								<div class="entry-meta"><?php echo get_the_date(); ?></div>
							<?php endif; ?>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>

			<?php
			echo ent2ncr( $after_widget );

			wp_reset_postdata();

		endif;
	}
}

function thim_recent_widget_registration() {
	unregister_widget( 'WP_Widget_Recent_Posts' );
	register_widget( 'Thim_Recent_Posts_Widgets' );
}

add_action( 'widgets_init', 'thim_recent_widget_registration' );