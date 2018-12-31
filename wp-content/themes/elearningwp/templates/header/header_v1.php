<!-- <div class="main-menu"> -->
<div class="container">
	<div class="row">
		<div class="navigation col-sm-12">
			<div class="tm-table">
				<a class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="width-logo table-cell sm-logo">
					<?php
					do_action( 'thim_logo' );
					do_action( 'thim_sticky_logo' );
					?>
				</div>
				<nav class="width-navigation table-cell table-right" role="navigation">
					<?php get_template_part( 'templates/header/main-menu' ); ?>
				</nav>
				<ul class="width-sidebar-right table-cell">
					<?php
					//sidebar menu_right
					if ( is_active_sidebar( 'menu_right' ) || ( isset( $theme_options_data['thim_show_offcanvas_sidebar'] ) && $theme_options_data['thim_show_offcanvas_sidebar'] == '1' && is_active_sidebar( 'offcanvas_sidebar' ) ) ) {
						echo '<li class="menu-right"><ul>';
						if ( is_active_sidebar( 'menu_right' ) ) {
							dynamic_sidebar( 'menu_right' );
						}
						if ( isset( $theme_options_data['thim_show_offcanvas_sidebar'] ) && $theme_options_data['thim_show_offcanvas_sidebar'] == '1' && is_active_sidebar( 'offcanvas_sidebar' ) ) {
							?>
							<li class="sliderbar-menu-controller">
								<?php
								$icon = '';
								if ( isset( $theme_options_data['thim_icon_offcanvas_sidebar'] ) ) {
									$icon = 'fa ' . $theme_options_data['thim_icon_offcanvas_sidebar'];
								}
								?>
								<span>
									<i class="<?php echo esc_attr($icon); ?>"></i>
								</span>
							</li>

							<?php
						}
						echo '</ul></li>';
					}
					?>
				</ul>
			</div>
			<!--end .row-->
		</div>
	</div>
</div>