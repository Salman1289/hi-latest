<?php
/**
 * Template Name: Home Page
 *
 **/
get_header();?>
	<div id="main-home-content" class="home-content home-page container" role="main">
		<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
		?>


		<div class="events-div">

<div class="widget-box-title"><h2 style="color:#111111;font-size:24px;line-height:24px;font-weight:600" class="title">Events</h2>
<p style="color: #878787;font-size: 16px;font-weight: normal;"> Pellentesque cursus arcu id magna euismod in elementum purus molestie.</p>
<a href="http://localhost/hybrid-ins/courses/" class="browse-all-courses">View All Events<i class="fa fa-angle-double-right"></i></a>
</div>
<?php
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'category_name' => 'events',
    'posts_per_page' => 2,
);

$arr_posts = new WP_Query( $args );
 
 ?>

<div class="events-display row">

<?php if ( $arr_posts->have_posts() ) :
 
    while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();
        ?>
    <div class="single-event col-md-6 col-sm-6 col-xs-6">


	<div class="event-img">

		<a href="<?php the_permalink(); ?>">
		
		<?php
            if ( has_post_thumbnail() ) :
                the_post_thumbnail();
            endif;
            ?>

		</a>

	</div>

	<div class="event-content">

		<h3>

			<a href="<?php the_permalink(); ?>">

				<?php the_title(); ?>
					
				</a>

		</h3>

		<div class="event-meta">

			<span style="margin-right: 5px"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
			<span style="margin-right: 5px"><?php echo get_post_meta(get_the_ID(), 'event_date', TRUE);?></span>

			<span style="margin-left: 15px"><?php echo get_post_meta(get_the_ID(), 'event_time', TRUE);?></span>

			<!-- to show the content of post to only 20 words -->

			<p class="post-content"><?php  echo wp_trim_words(get_the_content(), 20, '...' ); ?></p>

		</div>

		<div class="view-link">

			<a href="<?php the_permalink(); ?>" class="view-event-link">View Event

				<i class="fa fa-angle-double-right">
					
				</i>

			</a>

		
		</div>
	
	</div>


</div>
        <?php
    
    endwhile;

endif;

?>

</div>


</div>


	</div><!-- #main-content -->
<?php get_footer();
