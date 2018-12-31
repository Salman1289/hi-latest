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


<!-- =================== start =================== -->

			<div class="events-div">

<div class="widget-box-title"><h2 style="color:#111111;font-size:24px;line-height:24px;font-weight:600" class="title">Articles</h2>
<p style="color: #878787;font-size: 16px;font-weight: normal;"> Pellentesque cursus arcu id magna euismod in elementum purus molestie.</p>
<a href="http://localhost/hybrid-ins/courses/" class="browse-all-events">View All Articles<i class="fa fa-angle-double-right"></i></a>
</div>
<?php
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'category_name' => 'article',
    'posts_per_page' => 3,
);

$arr_posts = new WP_Query( $args );
 
 ?>

<div class="articles-display row">

<?php if ( $arr_posts->have_posts() ) :
 
    while ( $arr_posts->have_posts() ) :
        
        $arr_posts->the_post();

        $post_id = get_the_ID();

        ?>
    <div class="single-article col-md-4 col-sm-4 col-xs-4">


	<div class="article-img">

		<a href="<?php the_permalink(); ?>">
		
		<?php
            if ( has_post_thumbnail() ) :
                the_post_thumbnail();
            endif;
            ?>

		</a>

	</div>

	<div class="article-content">

		<p class="post-content">
			<?php  echo wp_trim_words(get_the_content(), 14, '.' ); ?>
			<span><u><a href="<?php the_permalink(); ?>">Read more</a></u></span>
			
		</p>

		<div class="article-meta">

			<span>

				<i class="fa fa-pencil-square-o" aria-hidden="true"></i>

				<?php $author_detail = get_the_author_meta('user_nicename'); 

				echo $author_detail;?>

			</span>

			<span>

				<i class="fa fa-calendar" aria-hidden="true"></i>

				<?php echo get_the_date(); ?>

			</span>

			<span>

				<i class="fa fa-share-alt" aria-hidden="true"></i>30

			</span>

			<span>

				<i class="fa fa-comments" aria-hidden="true"></i>

				<?php echo get_comments_number();?>

			</span>

		</div>
	
	</div>


</div>
        <?php
    
    endwhile;

endif;

?>

</div>


</div>
<!-- ==================end -->


	</div><!-- #main-content -->
<?php get_footer();
