<?php

/* Template Name : Events Page */

?>



<div class="events-main-div">
	<div class="row tabs-div">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item active">
    <a class="nav-link active" id="happening-tab" data-toggle="tab" href="#happening" role="tab" aria-controls="happening" aria-selected="true">Happening</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="upcomming-tab" data-toggle="tab" href="#upcomming" role="tab" aria-controls="upcomming" aria-selected="false">Upcomming</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="expired-tab" data-toggle="tab" href="#expired" role="tab" aria-controls="expired" aria-selected="false">Expired</a>
  </li>
</ul>
	</div>


<div class="tab-content" id="myTabContent">

	<div class="events-content-div tab-pane fade active in" id="happening" role="tabpanel" aria-labelledby="happening-tab">

	<div class="row events-content"> <!-- this row will be repeated -->


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

	</div> <!-- events=-content-row ends -->
	



	</div>  <!-- events-content-div ends -->


<!-- ============================ upcomming event tab content =================== -->
<div class="events-content-div tab-pane fade" id="upcomming" role="tabpanel" aria-labelledby="upcomming-tab">

	<div class="row events-content"> <!-- this row will be repeated -->


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

	</div> <!-- events=-content-row ends -->
	



	</div>  <!-- events-content-div ends -->


<!-- ================= upcomming events tab ends here ======================= -->

<!-- ============================ expired event tab content =================== -->
<div class="events-content-div tab-pane fade" id="expired" role="tabpanel" aria-labelledby="expired-tab">

	<div class="row events-content"> <!-- this row will be repeated -->


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

	</div> <!-- events=-content-row ends -->
	



	</div>  <!-- events-content-div ends -->


<!-- ================= upcomming events tab ends here ======================= -->

</div> <!-- tab-content ends -->


</div>