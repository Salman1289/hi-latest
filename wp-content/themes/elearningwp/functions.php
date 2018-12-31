<?php
/**
 * thim functions and definitions
 *
 * @package thim
 */

define( 'THIM_THEME_VERSION', '3.1.0' );
define( 'THIM_DIR', trailingslashit( get_template_directory() ) );
define( 'THIM_URI', trailingslashit( get_template_directory_uri() ) );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

load_theme_textdomain( 'elearningwp', get_template_directory() . '/languages' );

if ( ! function_exists( 'thim_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thim_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on thim, use a find and replace
		 * to change 'elearningwp' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'elearningwp', get_template_directory() . '/languages' );
		add_theme_support( 'title-tag' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'   => __( 'Primary Menu', 'elearningwp' ),
			'copyright' => __( 'Copyright Menu', 'elearningwp' ),
		) );

		// register menu for header layout 02
		$theme_options_data = get_theme_mods();
		if ( isset( $theme_options_data['thim_header_style'] ) && $theme_options_data['thim_header_style'] == "header_v2" ) {
			register_nav_menus( array(
				'primary-right' => __( 'Primary Menu Right', 'elearningwp' ),
			) );
		}
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		/* Add WooCommerce support */
		add_theme_support( 'woocommerce' );

		/* Add ThimCore support */
		add_theme_support( 'thim-core' );

		add_theme_support( 'elearningwp-demo-data' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio'
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'thim_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_editor_style();
		add_theme_support( "custom-header" );
	}
endif; // thim_setup
add_action( 'after_setup_theme', 'thim_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function thim_widgets_inits() {
	register_sidebar( array(
		'name'          => __( 'Sidebar 1', 'elearningwp' ),
		'id'            => 'sidebar-1',
		'description'   => 'Left Sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => 'Top Drawer',
		'id'            => 'drawer_top',
		'description'   => __( 'Drawer Top', 'elearningwp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => 'Search Sidebar',
		'id'            => 'search_sidebar',
		'description'   => __( 'Search Sidebar', 'elearningwp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Offcanvas', 'elearningwp' ),
		'id'            => 'offcanvas_sidebar',
		'description'   => 'Drawer Right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => 'Menu Right',
		'id'            => 'menu_right',
		'description'   => __( 'Menu Right', 'elearningwp' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => 'footer',
		'description'   => __( 'Footer Sidebar', 'elearningwp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => 'Copyright',
		'id'            => 'copyright',
		'description'   => __( 'Copyright', 'elearningwp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar Shop', 'elearningwp' ),
		'id'            => 'shop',
		'description'   => 'Shop Sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	if ( class_exists( 'LearnPress' ) ) {
		register_sidebar( array(
			'name'          => 'Top Sidebar Courses',
			'id'            => 'top_sidebar_courses',
			'description'   => __( 'Top Sidebar Courses', 'elearningwp' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => 'Sidebar Courses',
			'id'            => 'sidebar_courses',
			'description'   => __( 'Sidebar Courses', 'elearningwp' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
}

add_action( 'widgets_init', 'thim_widgets_inits' );

/**
 * Enqueue styles.
 */
if ( ! function_exists( 'thim_styles' ) ) {
	function thim_styles() {
		global $current_blog;
		$theme_options_data = get_theme_mods();
		// Style default
		if ( ! thim_plugin_active( 'thim-core' ) ) {
			wp_enqueue_style( 'thim-default', THIM_URI . 'inc/data/default.css', array() );
		}
		if ( is_multisite() ) {
			if ( file_exists( THIM_DIR . 'style-' . $current_blog->blog_id . '.css' ) ) {
				wp_enqueue_style( 'thim-style', get_template_directory_uri() . '/style-' . $current_blog->blog_id . '.css', array(), THIM_THEME_VERSION );
			} else {
				wp_enqueue_style( 'thim-style', get_stylesheet_uri(), array(), THIM_THEME_VERSION );
			}
		} else {
			wp_enqueue_style( 'thim-style', get_stylesheet_uri(), array(), THIM_THEME_VERSION );
		}

		//    RTL
		if ( get_theme_mod( 'thim_rtl_support', false ) && is_rtl() ) {
			wp_deregister_style( 'thim-style' );
			wp_register_style( 'thim-style', get_template_directory_uri() . '/rtl.css', array() );
			wp_enqueue_style( 'thim-style' );
		} else {
			wp_enqueue_style( 'thim-style' );
			wp_style_add_data( 'thim-style', 'rtl', 'replace' );
		}

		wp_enqueue_style( 'dashicons' );
	}

	add_action( 'wp_enqueue_scripts', 'thim_styles' );
}
/**
 * Enqueue scripts.
 */
if ( ! function_exists( 'thim_scripts' ) ) {
	function thim_scripts() {
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_dequeue_script( 'thim-jquery.boostrap' );
		wp_register_script( 'thim-jquery.boostrap', THIM_URI . '/assets/js/bootstrap.min.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'thim-jquery.boostrap' );

		if ( is_page_template( 'page-templates/one-courses.php' ) || is_page_template( 'page-templates/one-courses-v1.php' ) ) {
			wp_enqueue_style( 'lpr-learnpress-css' );
			wp_enqueue_style( 'lpr-time-circle-css' );

			wp_enqueue_script( 'learn-press-js' );
			wp_enqueue_script( 'lpr-alert-js' );
			wp_enqueue_script( 'lpr-time-circle-js' );
		}


		wp_dequeue_script( 'thim-jquery.imagesloaded.pkgd' );
		wp_register_script( 'thim-jquery.imagesloaded.pkgd', THIM_URI . 'assets/js/imagesloaded.pkgd.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'thim-jquery.imagesloaded.pkgd' );

		wp_enqueue_script( 'thim-jquery.isotope.pkgd', THIM_URI . 'assets/js/isotope.pkgd.min.js', array( 'jquery', ), '', true );

		wp_dequeue_script( 'thim-jquery.flexslider' );
		wp_register_script( 'thim-jquery.flexslider', THIM_URI . 'assets/js/jquery.flexslider-min.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'thim-jquery.flexslider' );

		wp_dequeue_script( 'thim-magnific-popup' );
		wp_register_script( 'thim-magnific-popup', THIM_URI . 'assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'thim-magnific-popup' ); /* quick view */


		// Register the isotope script plugin:

		wp_dequeue_script( 'thim-jplayer' );
		wp_register_script( 'thim-jplayer', THIM_URI . 'assets/js/jplayer/jquery.jplayer.min.js', array( 'jquery' ), '', true );

		wp_dequeue_script( 'thim-waypoints' );
		wp_register_script( 'thim-waypoints', THIM_URI . 'assets/js/waypoints.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'thim-waypoints' );

		/* woo */
		wp_dequeue_script( 'thim-owl-carousel' );
		wp_register_script( 'thim-owl-carousel', THIM_URI . 'assets/js/owl.carousel.min.js', array( 'jquery' ), '', true );

		wp_dequeue_script( 'thim-retina' );
		wp_register_script( 'thim-retina', THIM_URI . 'assets/js/jquery.retina.min.js', array( 'jquery' ), '', true );

		if ( ! class_exists( 'WooCommerce' ) ) {
			wp_enqueue_script( 'thim-cookie', THIM_URI . 'assets/js/js.cookie.min.js', array( 'jquery' ), '', true );
		}

		wp_register_script( 'thim-contentslider', THIM_URI . 'assets/js/thim-contentslider.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'thim-contentslider' );

		wp_register_script( 'thim-theia-sticky', THIM_URI . 'assets/js/theia-sticky-sidebar.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'thim-theia-sticky' );

		wp_dequeue_script( 'thim-custom-script' );
		wp_register_script( 'thim-custom-script', THIM_URI . 'assets/js/custom-script.js', array( 'jquery' ), THIM_THEME_VERSION, true );
		wp_enqueue_script( 'thim-custom-script' );

		if ( is_post_type_archive( 'product' ) ) {
			wp_enqueue_script( 'wc-add-to-cart-variation' );
		}

		wp_enqueue_script( 'prettyPhoto' );
		wp_enqueue_script( 'prettyPhoto-init' );
		wp_enqueue_style( 'woocommerce_prettyPhoto_css' );
	}

	add_action( 'wp_enqueue_scripts', 'thim_scripts' );
}


function thim_custom_stylesheet_for_developer( $stylesheet, $stylesheet_dir ) {
	if ( defined( 'THIM_DEBUG' ) && ! is_child_theme() ) {
		$stylesheet = $stylesheet_dir . '/style.unminify.css';
	}

	return $stylesheet;
}

add_filter( 'stylesheet_uri', 'thim_custom_stylesheet_for_developer', 10, 2 );


/**
 * Implement the theme wrapper.
 */
require THIM_DIR . 'inc/libs/theme-wrapper.php';

/**
 * Custom wrapper layout for theme
 */
require THIM_DIR . 'inc/wrapper-layout.php';

/**
 * Functions.
 */
require THIM_DIR . '/inc/custom-functions.php';

/**
 * Customizer additions.
 */
require THIM_DIR . 'inc/customizer.php';

/**
 * Require plugins
 */
if ( is_admin() && current_user_can( 'manage_options' ) ) {
	require THIM_DIR . 'inc/admin/plugins-require.php';
	require THIM_DIR . 'inc/admin/require-thim-core.php';
}

require_once THIM_DIR . 'inc/upgrade_thimcore.php';

/************************* Compatible LP 3 ***************************************/

if ( thim_plugin_active( 'learnpress' ) ) {
	/**
	 * Filter Learnpress override path.
	 *
	 * @return string
	 */
	function thim_lp_template_path() {
		if ( thim_is_new_learnpress( '3.0' ) ) {
			return 'learnpress-v3';
		}

		return 'learnpress';
	}

	add_filter( 'learn_press_template_path', 'thim_lp_template_path', 999 );
}

/**
 * LearnPress custom functions
 */
if ( class_exists( 'LearnPress' ) ) {
	$path = thim_is_new_learnpress( '3.0' ) ? 'learnpress-v3/' : 'learnpress/';
	require_once THIM_DIR . $path . 'learnpress-functions.php';
}