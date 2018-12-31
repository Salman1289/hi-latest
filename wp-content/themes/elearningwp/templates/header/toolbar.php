<?php
$theme_options_data = get_theme_mods();
$width_clumn = (int) ( $theme_options_data['thim_width_left_top'] / 8.3 );

$width_top_sidebar_right = 12 - $width_clumn;
if ( $theme_options_data['thim_topbar_show'] ) { ?>
	<?php if ( ( is_active_sidebar( 'top_right_sidebar' ) ) || ( is_active_sidebar( 'top_left_sidebar' ) ) ) : ?>
		<div class="toolbar">
			<?php
			if ( isset( $theme_options_data['thim_toolbar_layout'] ) && $theme_options_data['thim_toolbar_layout'] == 'boxed' ) {
				echo "<div class=\"container\">";
			} ?>
			<div class="toolbar-inner">
				<?php
				if ( isset( $theme_options_data['thim_toolbar_layout'] ) && $theme_options_data['thim_toolbar_layout'] == 'wide' ) {
					echo "<div class=\"container\">";
				} ?>
				<div class="row">
					<?php if ( is_active_sidebar( 'top_left_sidebar' ) && $width_clumn > 0 ) : ?>
						<div class="col-sm-<?php echo esc_attr( $width_clumn ); ?> top-left">
							<ul class="top-left-menu">
								<?php dynamic_sidebar( 'top_left_sidebar' ); ?>
							</ul>
						</div><!-- col-sm-6 -->
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'top_right_sidebar' ) ) : ?>
						<div class="col-sm-<?php echo esc_attr( $width_top_sidebar_right ); ?> top-right">
							<ul class="top-right-menu">
								<?php dynamic_sidebar( 'top_right_sidebar' ); ?>
							</ul>
						</div><!-- col-sm-6 -->
					<?php endif; ?>
				</div>
				<?php
				if ( isset( $theme_options_data['thim_toolbar_layout'] ) && $theme_options_data['thim_toolbar_layout'] == 'wide' ) {
					echo "</div>";
				} ?>
			</div>
			<?php if ( isset( $theme_options_data['thim_toolbar_layout'] ) && $theme_options_data['thim_toolbar_layout'] == 'boxed' ) {
				echo "</div>";
			} ?>
		</div><!--End/div.top-->
	<?php
	endif;
}