<?php

/* Template Name : Articles Page */

?>

<div class="articles-archive-main">

	<?php
$args = array(
    'post_type' => 'events',
    'post_status' => 'publish',
    'posts_per_page' => 4,
);

$arr_posts = new WP_Query( $args );
 
 if ( $arr_posts->have_posts() ) :
 
    while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();

 ?>

<div class="row">
	
<div class="col-md-12 article-img">


		<?php
            if ( has_post_thumbnail() ) :
                the_post_thumbnail();
            endif;
            ?>
	
<!-- <img src="<?php echo bloginfo('stylesheet_directory');?>/images/articleimg1.jpg" /> -->


</div>
<div class="col-md-12 article-content-meta ">
	
	<div class="article-title">

		<h3>
			<a href="<?php the_permalink(); ?>">

				<?php the_title(); ?>
					
	
				</a>
				
			</h3>
	
	</div>


	<div class="article-meta">
		
		<span style="margin-right: 35px;"><i class="fa fa-calendar" aria-hidden="true" style="margin-right: 8px;"></i><?php echo get_the_date(); ?></span>
		<span>

		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>

		 Posted by: <?php $author_detail = get_the_author_meta('user_nicename'); 

				echo $author_detail;?>

			</span>

	</div>

	<div class="article-content">

		<p>
		<?php  echo wp_trim_words(get_the_content(), 50, '.' ); ?>
		<span><u><a href="<?php the_permalink(); ?>">Read more</a></u></span>
		<!-- Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.  -->
		</p>
	</div>

</div>	

</div>	


  <?php
    
    endwhile;

endif;

wp_reset_query();

?>

</div>