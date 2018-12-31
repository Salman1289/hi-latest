<?php
$theme_options_data = get_theme_mods();
?>
<footer id="colophon" class="site-footer site-footer2" role="contentinfo">
	<?php if ( is_active_sidebar( 'footer' ) ) : ?>
		<div class="footer">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<!--==============================powered=====================================-->
	<?php if ( isset( $theme_options_data['thim_copyright_text'] ) || is_active_sidebar( 'copyright' ) ) { ?>
		<div class="copyright-area">
			<div class="container">
				<div class="row">
					<?php
					if ( isset( $theme_options_data['thim_copyright_text'] ) ) {
						echo '<div class="col-sm-6"><p class="text-copyright">' . $theme_options_data['thim_copyright_text'] . '</p></div>';
					}
					if ( is_active_sidebar( 'copyright' ) ) : ?>
						<div class="col-sm-6 text-right">
							<?php dynamic_sidebar( 'copyright' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php
			if ( isset( $theme_options_data['thim_show_to_top'] ) && $theme_options_data['thim_show_to_top'] == 1 ) { ?>
				<a href="#" id="back-to-top">
					<i class="fa fa-chevron-up"></i>
				</a>
			<?php } ?>
		</div>
	<?php } ?>
</footer>