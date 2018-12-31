<?php
$theme_options_data = get_theme_mods();
?>
</div><!-- #main-content -->
<?php
if ( isset( $theme_options_data['thim_footer_style'] ) && $theme_options_data['thim_footer_style'] ) {
	get_template_part( 'templates/footer/' . $theme_options_data['thim_footer_style'] );
} else {
	get_template_part( 'templates/footer/footer_v2' );
}
?>
<!-- #colophon -->
</div></div><!-- end wrapper-container and content-pusher-->

<?php if ( isset( $theme_options_data['thim_show_offcanvas_sidebar'] ) && $theme_options_data['thim_show_offcanvas_sidebar'] == '1' && is_active_sidebar( 'offcanvas_sidebar' ) ) { ?>
	<div class="slider-sidebar">
		<?php dynamic_sidebar( 'offcanvas_sidebar' ); ?>
	</div>  <!--slider_sidebar-->
<?php } ?>

<?php wp_footer(); ?>

<script src="http://localhost/hybrid-ins/wp-content/themes/elearningwp-child/js/custom-js.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>