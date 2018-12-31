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
<div class="footer-social-widget">
	<h3 class="widget-title">Stay Connected</h3>
<ul>
	<li><a href=""><span><i class="fa fa-facebook-f"></i></span>Facebook</a></li>
	<li><a href=""><span><i class="fa fa-twitter" aria-hidden="true"></i></span>Twitter</a></li>
	<li><a href=""><span><i class="fa fa-instagram"></i></span>Instagram</a></li>
	<li><a href=""><span><i class="fa fa-youtube-play"></i></span>Youtube</a></li>
	<li><a href=""><span><i class="fa fa-linkedin"></i></span>Linked</a></li>

</ul>
</div>
	</div><!-- #main-content -->
<?php get_footer();
