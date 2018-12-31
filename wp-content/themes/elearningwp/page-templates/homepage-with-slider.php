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

<!-- =============== slider start ============== -->
<div class="custom-home-slider">

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">

    <div class="item active">
    	<div class="slide-content">
    		<div class="heading-para">
    			<h3>Credit Courses <br> Towards Degrees</h3>
    			<p>Pellentesque cursus arcu id magna euismod in elementum purus molestie.</p>
    		</div>
    		<div class="mini-images">
    			<span><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/student.png " alt="Student icon" />Over 7 million students.</span>
    			<span><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/course.png " alt="Student icon"  />More than 30,000 courses.</span>
    			<span><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/learn-online.png " alt="Student icon"  />Learn anything online.</span>

    		</div>
    	</div>
      <img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/slider-1.png " alt="Los Angeles">
    </div>


      <div class="item">
    	<div class="slide-content">
    		<div class="heading-para">
    			<h3>Credit Courses <br> Towards Degrees</h3>
    			<p>Pellentesque cursus arcu id magna euismod in elementum purus molestie.</p>
    		</div>
    		<div class="mini-images">
    			<span><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/student.png " alt="Student icon" />Over 7 million students.</span>
    			<span><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/course.png " alt="Student icon"  />More than 30,000 courses.</span>
    			<span><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/learn-online.png " alt="Student icon"  />Learn anything online.</span>

    		</div>
    	</div>
      <img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/slider-1.png " alt="Los Angeles">
    </div>

      <div class="item">
    	<div class="slide-content">
    		<div class="heading-para">
    			<h3>Credit Courses <br> Towards Degrees</h3>
    			<p>Pellentesque cursus arcu id magna euismod in elementum purus molestie.</p>
    		</div>
    		<div class="mini-images">
    			<span><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/student.png " alt="Student icon" />Over 7 million students.</span>
    			<span><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/course.png " alt="Student icon"  />More than 30,000 courses.</span>
    			<span><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/learn-online.png " alt="Student icon"  />Learn anything online.</span>

    		</div>
    	</div>
      <img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/slider-1.png " alt="Los Angeles">
    </div>

   
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
   
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
   
  </a>
</div>

</div>

<!-- ============== Slider end ======================== -->

	</div><!-- #main-content -->
<?php get_footer();
