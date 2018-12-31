<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package thim
 */
?><!DOCTYPE html>
<?php
$theme_options_data = get_theme_mods();
?>
<html <?php language_attributes(); ?><?php if ( (isset( $theme_options_data['thim_rtl_support'] ) && $theme_options_data['thim_rtl_support'] == '1') && is_rtl() ) {
	echo "dir=\"rtl\"";
} ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
	<?php
	$custom_sticky = $class_header = '';
	if ( isset( $theme_options_data['thim_rtl_support'] ) && $theme_options_data['thim_rtl_support'] == '1' ) {
		$class_header .= 'rtl';
	}
	if ( isset( $theme_options_data['thim_config_att_sticky'] ) && $theme_options_data['thim_config_att_sticky'] == 'sticky_custom' ) {
		$custom_sticky .= ' bg-custom-sticky';
	}
	if ( isset( $theme_options_data['thim_header_sticky'] ) && $theme_options_data['thim_header_sticky'] == 1 ) {
		$custom_sticky .= ' sticky-header';
	}
	if ( isset( $theme_options_data['thim_header_position'] ) ) {
		$custom_sticky .= ' ' . $theme_options_data['thim_header_position'];
	}
	if ( isset( $theme_options_data['thim_header_style'] ) ) {
		$custom_sticky .= ' ' . $theme_options_data['thim_header_style'];
	}
	// mobile menu custom class
	if ( isset( $theme_options_data['thim_config_logo_mobile'] ) && $theme_options_data['thim_config_logo_mobile'] == 'custom_logo' ) {
		if ( ( isset( $theme_options_data['thim_logo_mobile'] ) && $theme_options_data['thim_logo_mobile'] <> '' ) ||
		     ( isset( $theme_options_data['thim_sticky_logo_mobile'] ) && $theme_options_data['thim_sticky_logo_mobile'] <> '' )
		) {
			$custom_sticky .= ' mobile-logo-custom';
		}
	}

	$content_layout = 'content-pusher';

	if ( get_theme_mod( 'box_layout' ) == 'boxed' ) {
		$content_layout .= ' boxed-area';
	}
	?>

	<?php
	wp_head();
	?>
	
</head>

<body <?php body_class( $class_header ); ?>>

<?php do_action( 'thim_before_body' ); ?>

<!-- menu for mobile-->
<div id="wrapper-container" class="wrapper-container">
	<!-- Mobile Menu-->
	<nav class="visible-xs mobile-menu-container mobile-effect" role="navigation" id="mobile-menu">
		<?php get_template_part( 'templates/header/menu-mobile' ); ?>
	</nav>

	<div id="content-pusher" class="<?php echo esc_attr( $content_layout ); ?>">

		<?php
		// stick header
		$data_height = '';
		if ( isset( $theme_options_data['thim_margin_top_header'] ) && $theme_options_data['thim_margin_top_header'] != '0' ) {
			$data_height = ' data-height-sticky="' . $theme_options_data['thim_margin_top_header'] . '"';
		}
		?>
		<header id="masthead" class="site-header affix-top<?php echo esc_attr( $custom_sticky ); ?>" role="banner"<?php echo esc_attr( $data_height ); ?>>
			<?php
			// Drawer
			if ( isset( $theme_options_data['thim_show_drawer'] ) && $theme_options_data['thim_show_drawer'] == '1' && is_active_sidebar( 'drawer_top' ) ) {
				get_template_part( 'templates/header/drawer' );
			}
			if ( isset( $theme_options_data['thim_header_style'] ) && $theme_options_data['thim_header_style'] ) {
				get_template_part( 'templates/header/' . $theme_options_data['thim_header_style'] );
			} else {
				get_template_part( 'templates/header/header_v1' );
			}
			?>
		</header>

		<a id="overlay-menu" class="overlay-menu"></a>

		<div id="main-content" <?php thim_main_content_class(); ?>>