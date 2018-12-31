<?php

// Single Article Template

?>

<div class="page-content event-single-post">
	<?php
	while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-thumbnail">
		<?php
            if ( has_post_thumbnail() ) :
                the_post_thumbnail();
            endif;
            ?>

	</div>

	<header class="entry-header">
		<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
	</header><!-- .entry-header -->

	<div class="post-meta-detail">
		
		<span style="margin-right: 5px"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
		<span style="margin-right: 15px">

				
				<?php echo get_post_meta(get_the_ID(), 'event_time', TRUE);?>
					
				</span>
				<span style="margin-right: 5px"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
				<span style="margin-right: 15px">
					<?php echo get_post_meta(get_the_ID(), 'event_location', TRUE);?>
				
				</span>

	</div>

	<div class="entry-content">
		<?php
			the_content();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->

		<?php //get_template_part( 'templates/template-parts/content', 'single' ); ?>
		<?php
		// If comments are open or we have at least one comment, load up the comment template
		// if ( comments_open() || '0' != get_comments_number() ) :
		// 	comments_template();
		// endif;
		?>
	<?php endwhile; ?>
</div><!-- .page-conten t-->