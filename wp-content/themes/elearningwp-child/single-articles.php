<?php

// Single Article Template

?>

<div class="page-content article-single-post">
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
		
		<span style="margin-right: 35px;"><i class="fa fa-calendar" aria-hidden="true" style="margin-right: 8px;"></i><?php echo get_the_date(); ?></span>
		<span>

		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>

		 Posted by: <?php $author_detail = get_the_author_meta('user_nicename'); 

				echo $author_detail;?>

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