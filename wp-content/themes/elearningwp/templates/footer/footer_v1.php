<?php
$theme_options_data = get_theme_mods();
?>
<footer id="colophon" class="site-footer" role="contentinfo">
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
					<div class="copyright-wrapper">
						<?php
						if ( isset( $theme_options_data['thim_copyright_text'] ) ) {
							echo '<div class="col-sm-6"><p class="text-copyright">' . $theme_options_data['thim_copyright_text'] . '</p></div>';
						} ?>
						<div class="col-sm-6 copyright-menu">
							<?php
							if ( isset( $theme_options_data['thim_show_to_top'] ) && $theme_options_data['thim_show_to_top'] == 1 ) { ?>
								<a href="#" id="back-to-top">
									<i class="fa fa-chevron-up"></i>
								</a>
							<?php } ?>
							<?php echo wp_nav_menu(array('theme_location' => 'copyright','depth' => 1, 'fallback_cb' => true)); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</footer>

<?php if ( is_active_sidebar( 'copyright' ) ) : ?>
	<div class="copyright-bottom">
		<?php dynamic_sidebar( 'copyright' ); ?>
	</div>
<?php endif; ?>