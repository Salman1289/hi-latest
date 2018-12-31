<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package thim
 */
if (!is_active_sidebar('shop')) {
    return;
}
$theme_options_data = get_theme_mods();
$sticky_sidebar     = ( !isset( $theme_options_data['thim_sticky_sidebar'] ) || $theme_options_data['thim_sticky_sidebar'] === true ) ? ' sticky-sidebar' : '';
?>

<div id="sidebar" class="widget-area col-md-3<?php echo esc_attr( $sticky_sidebar ); ?> col-sm-4" role="complementary">
	<?php if ( ! dynamic_sidebar( 'shop' ) ) :
		dynamic_sidebar( 'shop' );
	endif; // end sidebar widget area ?>
</div><!-- #secondary-2 -->
