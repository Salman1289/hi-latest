<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-inner">
		<?php
		if ( has_post_format( 'link' ) && thim_meta( 'thim_url' ) && thim_meta( 'thim_text' ) ) {
			$url  = thim_meta( 'thim_url' );
			$text = thim_meta( 'thim_text' );
			if ( $url && $text ) { ?>
				<header class="entry-header">
					<h3 class="blog_title">
						<a class="link" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $text ); ?></a>
						<h3>
				</header>

				<?php
			}
			?>
		<?php } elseif ( has_post_format( 'quote' ) && thim_meta( 'thim_quote' ) && thim_meta( 'thim_author_url' ) ) {
			$quote      = thim_meta( 'thim_quote' );
			$author     = thim_meta( 'thim_author' );
			$author_url = thim_meta( 'thim_author_url' );
			if ( $author_url ) {
				$author = ' <a href=' . esc_url( $author_url ) . '>' . $author . '</a>';
			}
			if ( $quote && $author ) {
				?>
				<header class="entry-header">
					<div class="box-header box-quote">
						<blockquote><?php echo esc_html( $quote ); ?><cite><?php echo esc_html( $author ); ?></cite>
						</blockquote>
					</div>
				</header>
				<?php
			}
		} else {
			?>
			<header class="entry-header">
				<?php if ( get_theme_mod( 'thim_show_date', true ) ) : ?>
					<div class="entry-date">
						<?php
						echo '<span class="day">' . get_the_date( 'd' ) . '</span>';
						echo '<span class="month">' . get_the_date( 'M' ) . '</span>';
						?>
					</div>
				<?php endif; ?>
				<?php the_title( sprintf( '<h3 class="blog_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
				<?php thim_entry_meta(); ?>
			</header>
		<?php }; ?>

		<?php if ( has_post_format( 'audio' ) || has_post_format( 'video' ) || has_post_format( 'gallery' ) ) { ?>
			<div class="post-formats-wrapper">
				<?php do_action( 'thim_entry_top', 'full' ); ?>
			</div>
		<?php } else { ?>
			<div class="post-formats-wrapper">
				<?php thim_feature_image( 849, 450, true ); ?>
			</div>
		<?php }; ?>

		<div class="entry-content">
			<div class="entry-summary">
				<?php
				$limit = 30;
				if ( isset( $theme_options_data['thim_archive_excerpt_length'] ) && $theme_options_data['thim_archive_excerpt_length'] <> '' ) {
					$limit = $theme_options_data['thim_archive_excerpt_length'];
				}
				echo thim_excerpt( $limit );
				?>
			</div><!-- .entry-summary -->
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="readmore"><?php esc_html_e( 'Read more', 'elearningwp' ); ?></a>

			<?php thim_post_social_share(); ?>
		</div>
	</div>
</article><!-- #post-## -->