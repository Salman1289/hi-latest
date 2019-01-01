<?php
/**
 * The sidebar containing the main widget area.
 * Note : Sidebar is divided into 3 parts, one for custom post types like articles and events,second for admission pages like admission requirements and third for all other pages, because they all have different sidebars
 * @package thim
 */
if (!is_active_sidebar('sidebar-1')) {
    return;
}
$theme_options_data = get_theme_mods();
$sticky_sidebar     = ( !isset( $theme_options_data['thim_sticky_sidebar'] ) || $theme_options_data['thim_sticky_sidebar'] === true ) ? ' sticky-sidebar' : '';
?>

<div id="sidebar" class="widget-area col-md-3<?php echo esc_attr( $sticky_sidebar ); ?> col-sm-4" role="complementary">
	<?php 
 
    $post_type = get_post_type();

    if($post_type == 'articles' || $post_type == 'events'){  // agr post type jo hai wo article ya events ki ho gee to sidebar show nahi krega, uski jagah hum yeh show krwayn gy




	?>

<div class="articles-sidebar">


	<?php
$args = array(
    'post_type' => $post_type,
    'post_status' => 'publish',
    'posts_per_page' => 4,
);

$arr_posts = new WP_Query( $args );

 
 if ( $arr_posts->have_posts() ) :
 
    while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();

 ?>

<div class="row article-main-row">
	
<div class="article-img">

	<a href="<?php the_permalink(); ?>">
		<?php
            if ( has_post_thumbnail() ) :
                the_post_thumbnail();
            endif;
            ?>
	</a>
<!-- <img src="<?php echo bloginfo('stylesheet_directory');?>/images/articleimg1.jpg" /> -->


</div>   <!-- image div ends here -->  

<div class="article-content-meta ">
	
	<div class="article-content">
	
		<p>
		<?php  echo wp_trim_words(get_the_content(), 10, '....' ); ?>
		<!-- <span><u><a href="<?php the_permalink(); ?>">Read more</a></u></span> -->
		<!-- Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.  -->
		</p>

	</div>

 
	<div class="article-meta">
		
		<?php if($post_type == 'articles'){ ?>
<!-- agr post type articles hogee to author or date show kry ga,agr post type jo hai wo events hogee to place or time how krega -->

		<span style="margin-right: 35px;"><?php echo get_the_date(); ?></span>
		<span><?php echo get_the_time();?></span>
		<span>

		 Posted by: <?php $author_detail = get_the_author_meta('user_nicename'); 

				echo $author_detail;?>

			</span>

			<?php }else{ ?>

			<span style="margin-right: 5px"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
			<span style="margin-right: 15px">

				
				<?php echo get_post_meta(get_the_ID(), 'event_time', TRUE);?>
					
				</span><br>
				<span style="margin-right: 5px"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
				<span style="margin-right: 15px">
					<?php echo get_post_meta(get_the_ID(), 'event_location', TRUE);?>
					
				</span>

				<?php } ?>

	</div> <!-- article meta ends here -->

	

</div>	

</div>   <!-- inner row ends here -->  


<?php
    
    endwhile;

endif;

wp_reset_query();

?>

</div>	

	<?php }

	// elseif($post_type == 'events'){







	// }  

	else{

	
	$pagename = get_query_var('pagename'); //this is the slug of page

	if($pagename == 'admission-requirements'){
	
	?>



<?php

		// end sidebar widget area 
	}
	
	// if of admission pages ends here
	}else{

if ( ! dynamic_sidebar( 'sidebar-courses' ) ) :
		dynamic_sidebar( 'sidebar-courses' );
	endif; // end sidebar widget area 
	
// if of others ends here

	}


}

	?>
</div><!-- #secondary -->
