<?php
/**
 * Template part for displaying single.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php edit_post_link(); ?>
	<div class="content-inner">
		<div class="entry-top">
			<?php do_action( 'thim_entry_top', 'full' ); ?>
		</div><!-- .entry-top -->
		<div class="entry-content">
			<header class="entry-header">
				<?php
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}
				?>
				<?php thim_entry_meta(); ?>
			</header><!-- .entry-header -->

			<div class="entry-description">
				<?php
				// Get post content
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elearningwp' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>

		</div><!-- .entry-content -->

	</div><!-- .content-inner -->

	<?php get_template_part( 'templates/template-parts/related-posts' ); ?>

</article><!-- #post-## -->