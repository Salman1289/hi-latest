<?php

/* Template Name : Events Page */

?>


<div class="events-main-div">
	<div class="row tabs-div">
		
	</div>
<?php
$args = array(
    'post_type' => 'events',
    'post_status' => 'publish',
    'posts_per_page' => 2,
);

$arr_posts = new WP_Query( $args );
 
 ?>

	<div class="events-content-div">

<?php if ( $arr_posts->have_posts() ) :
 
    while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();
        ?>
	<div class="row events-content">
	<div class="col-md-2 date-div"><span>01</span><br><span>December</span></div>
	<div class="col-md-7 events-middle-div">
		<div class="heading-div">
		<h3>Education Autumn Tour 2018</h3>
	 </div>
	 <div class="time-date-div">
	 		<span style="margin-right: 5px"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
			<span style="margin-right: 15px">

				10:00PM-09:00AM
				<?php echo get_post_meta(get_the_ID(), 'event_time', TRUE);?>
					
				</span>
				<span style="margin-right: 5px"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
				<span style="margin-right: 15px">
					<?php echo get_post_meta(get_the_ID(), 'event_time', TRUE);?>
					Paris, France
				</span>

			<!-- to show the content of post to only 20 words -->

			<p class="post-content"><?php  echo wp_trim_words(get_the_content(), 20, '...' ); ?>
				Lorem Ipsum is simply dummy text of the printing and typesetting industry.
			</p>
	 </div>
	</div>
	<div class="col-md-3 events-right">
		
		<div class="event-inner-image">
			
			<img src="<?php echo bloginfo('stylesheet_directory');?>/images/event-1.jpg" alt="event-image"/>

		</div>
	</div>
	</div>
	
	  <?php
    
    endwhile;

endif;

wp_reset_query();

?>
	</div>



</div>