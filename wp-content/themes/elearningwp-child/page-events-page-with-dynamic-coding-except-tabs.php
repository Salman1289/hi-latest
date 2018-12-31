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
    'posts_per_page' => 10,
);

$arr_posts = new WP_Query( $args );
 
 ?>

	<div class="events-content-div">

<?php if ( $arr_posts->have_posts() ) :
 
    while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();
        ?>
	<div class="row events-content">
	<div class="col-md-2 date-div">
			<?php 

			$event_date =  get_post_meta(get_the_ID(), 'event_date', TRUE);
			$time = strtotime($event_date);
			$date = date("d", $time); 
			$month=date("F",$time);
			$year=date("Y",$time);
 
 // $month;
// echo $year;
			// $newformat = date('Y-m-d',$time);


			?>
		<span><?php echo $date; ?></span><br><span><?php echo $month." ".$year; ?></span>

	</div>
	<div class="col-md-7 events-middle-div">
		<div class="heading-div">
		<h3><a href="<?php the_permalink(); ?>">

				<?php the_title(); ?>
					
				</a></h3>
	 </div>
	 <div class="time-date-div">
	 		<span style="margin-right: 5px"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
			<span style="margin-right: 15px">

				
				<?php echo get_post_meta(get_the_ID(), 'event_time', TRUE);?>
					
				</span>
				<span style="margin-right: 5px"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
				<span style="margin-right: 15px">
					<?php echo get_post_meta(get_the_ID(), 'event_location', TRUE);?>
				
				</span>

			<!-- to show the content of post to only 20 words -->

			<p class="post-content"><?php  echo wp_trim_words(get_the_content(), 20, '.' ); ?>
				
			</p>
	 </div>
	</div>
	<div class="col-md-3 events-right">
		
		<div class="event-inner-image">

			<a href="<?php the_permalink(); ?>">
		
		<?php
            if ( has_post_thumbnail() ) :
                the_post_thumbnail();
            endif;
            ?>

		</a>
			
			<!-- <img src="<?php echo bloginfo('stylesheet_directory');?>/images/event-1.jpg" alt="event-image"/> -->

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