<?php
/**
 * Custom Functions
 *
 */

function thim_hex2rgb( $hex ) {
	$hex = str_replace( "#", "", $hex );
	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );

	return $rgb; // returns an array with the rgb values
}

/**
 * Check a plugin active
 *
 * @param $plugin_var
 *
 * @return bool
 */
function thim_plugin_active( $plugin_dir, $plugin_file = null ) {
	$plugin_file = $plugin_file ? $plugin_file : ( $plugin_dir . '.php' );
	$plugin      = $plugin_dir . '/' . $plugin_file;

	$active_plugins_network = get_site_option( 'active_sitewide_plugins' );

	if ( isset( $active_plugins_network[ $plugin ] ) ) {
		return true;
	}

	$active_plugins = get_option( 'active_plugins' );

	if ( in_array( $plugin, $active_plugins ) ) {
		return true;
	}

	return false;
}

/**
 * Animation
 *
 * @param $css_animation
 *
 * @return string
 */
if ( ! function_exists( 'thim_getCSSAnimation' ) ) {
	function thim_getCSSAnimation( $css_animation ) {
		$output = '';
		if ( $css_animation != '' ) {
			wp_enqueue_script( 'thim-waypoints' );
			$output = ' wpb_animate_when_almost_visible wpb_' . $css_animation;
		}

		return $output;
	}
}

/********************************************************************
 * Get image attach
 ********************************************************************/
if ( ! function_exists( 'feature_images' ) ) {
	function feature_images( $width, $height ) {
		global $post;
		$post_thumbnail = get_the_post_thumbnail( $post->ID, 'full' );
		if ( has_post_thumbnail() ) {
			if ( ! empty( $post_thumbnail ) ) {
				$get_thumbnail = simplexml_load_string( get_the_post_thumbnail( $post->ID, 'full' ) );
				$thumbnail_src = $get_thumbnail->attributes()->src;
				$img_url       = $thumbnail_src;
				$data          = @getimagesize( $img_url );
				$width_data    = $data[0];
				$height_data   = $data[1];
				$image_crop    = thim_aq_resize( $img_url[0], $width, $height, true );

				return '<img src="' . $image_crop . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" />';
			} else {
				return '';
			}
		}
	}
}

/**
 * @param $tabs
 *
 * @return array
 */
if ( ! function_exists( 'thim_widget_group' ) ) {
	function thim_widget_group( $tabs ) {
		$tabs[] = array(
			'title'  => esc_html__( 'Thim Widget', 'elearningwp' ),
			'filter' => array(
				'groups' => array( 'thim_widget_group' )
			)
		);

		return $tabs;
	}
}
add_filter( 'siteorigin_panels_widget_dialog_tabs', 'thim_widget_group', 19 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function thim_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( get_theme_mod( 'thim_user_bg_pattern', true ) ) {
		$classes[] = 'bg-type-pattern';
	}

	if ( get_theme_mod( 'enable_responsive', true ) ) {
		$classes[] = 'responsive';
	} else {
		$classes[] = 'disable-responsive';
	}

	if ( get_theme_mod( 'enable_box_shadow', true ) ) {
		$classes[] = 'box-shadow';
	}

	if ( get_theme_mod( 'feature_rtl_support', true ) ) {
		$classes[] = 'class-rtl';
	}

	if ( get_theme_mod( 'mobile_menu_position' ) == 'creative-left' ) {
		$classes[] = 'creative-left';
	} else {
		$classes[] = 'creative-right';
	}

	if ( class_exists( 'LearnPress' ) ) {
		if ( thim_is_new_learnpress( '3.0' ) ) {
			$classes[] = 'learnpress-v3';
		}
	}

	return $classes;
}

add_filter( 'body_class', 'thim_body_classes' );

/**
 * Primary menu
 */
function thim_primary_menu() {
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'items_wrap'     => '%3$s'
		) );
	} else {
		wp_nav_menu( array(
			'theme_location' => '',
			'container'      => false,
			'items_wrap'     => '%3$s'
		) );
	}
}

/**
 * Display the classes for the #wrapper-container element.
 *
 * @param string|array $class One or more classes to add to the class list.
 */
function thim_wrapper_container_class( $class = '' ) {
	// Separates classes with a single space, collates classes for body element
	echo 'class="' . join( ' ', thim_get_wrapper_container_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the #wrapper-container element as an array.
 *
 * @param string|array $class One or more classes to add to the class list.
 *
 * @return array Array of classes.
 */
function thim_get_wrapper_container_class( $class = '' ) {

	$classes = array();

	if ( ! empty( $class ) ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	/**
	 * Filter the list of CSS #wrapper-container classes
	 *
	 * @param array $classes An array of #wrapper-container classes.
	 * @param array $class   An array of additional classes added to the #wrapper-container.
	 */
	$classes = apply_filters( 'thim_wrapper_container_class', $classes, $class );

	return array_unique( $classes );
}


/**
 * Adds custom classes to the array of #wrapper-container classes.
 *
 * @param array $classes Classes for the #wrapper-container element.
 *
 * @return array
 */
function thim_wrapper_container_classes( $classes ) {

	$classes[] = 'content-pusher';

	if ( get_theme_mod( 'box_content_layout' ) == 'boxed' ) {
		$classes[] = 'boxed-area';
	}

	return $classes;
}

add_filter( 'thim_wrapper_container_class', 'thim_wrapper_container_classes' );


/**
 * Display the classes for the #main-content element.
 *
 * @param string|array $class One or more classes to add to the class list.
 */
function thim_main_content_class( $class = '' ) {
	// Separates classes with a single space, collates classes for body element
	echo 'class="' . join( ' ', thim_get_main_content_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the #main-content element as an array.
 *
 * @param string|array $class One or more classes to add to the class list.
 *
 * @return array Array of classes.
 */
function thim_get_main_content_class( $class = '' ) {

	$classes = array();

	if ( ! empty( $class ) ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	/**
	 * Filter the list of CSS #main-content classes
	 *
	 * @param array $classes An array of #main-content classes.
	 * @param array $class   An array of additional classes added to the #main-content
	 */
	$classes = apply_filters( 'thim_main_content_class', $classes, $class );

	return array_unique( $classes );
}


/**
 * Adds custom classes to the array of #main-content classes.
 *
 * @param array $classes Classes for the #main-content element.
 *
 * @return array
 */
function thim_main_content_classes( $classes ) {

	$classes[] = 'bg-type-' . get_theme_mod( 'background_main_type', 'color' );

	return $classes;
}

add_filter( 'thim_main_content_class', 'thim_main_content_classes' );


/**
 * Add lang to html tag
 *
 * @return @string
 */
if ( ! function_exists( 'thim_language_attributes' ) ) {
	function thim_language_attributes() {
		echo 'lang="' . get_bloginfo( 'language' ) . '"';
	}

	add_filter( 'language_attributes', 'thim_language_attributes', 10 );
}


/**
 * Optimize: Remove Emoji scripts
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Optimize: script_version
 */

function thim_optimize_remove_script_version( $src ) {
	$parts = explode( '?ver', $src );

	return $parts[0];
}

add_filter( 'script_loader_src', 'thim_optimize_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'thim_optimize_remove_script_version', 15, 1 );


/**
 * Support SSL (https)
 */
function thim_ssl_secure_url( $sources ) {
	$scheme = parse_url( site_url(), PHP_URL_SCHEME );
	if ( 'https' == $scheme ) {
		if ( stripos( $sources, 'http://' ) === 0 ) {
			$sources = 'https' . substr( $sources, 4 );
		}

		return $sources;
	}

	return $sources;
}

function thim_ssl_secure_image_srcset( $sources ) {
	$scheme = parse_url( site_url(), PHP_URL_SCHEME );
	if ( 'https' == $scheme ) {
		foreach ( $sources as &$source ) {
			if ( stripos( $source['url'], 'http://' ) === 0 ) {
				$source['url'] = 'https' . substr( $source['url'], 4 );
			}
		}

		return $sources;
	}

	return $sources;
}

add_filter( 'wp_calculate_image_srcset', 'thim_ssl_secure_image_srcset' );
add_filter( 'wp_get_attachment_url', 'thim_ssl_secure_url', 1000 );
add_filter( 'image_widget_image_url', 'thim_ssl_secure_url' );

/**
 * Theme Feature: Preload
 *
 * @return bool
 * @return string HTML for preload
 */
if ( ! function_exists( 'thim_preloading' ) ) {
	function thim_preloading() {
		$preloading = get_theme_mod( 'thim_preload' );
		if ( $preloading ) {

			thim_preloading_icon();

		}
	}

	add_action( 'thim_before_body', 'thim_preloading', 10 );
}


/**
 * Theme Feature: Preload
 *
 * @return bool
 * @return string HTML for preload
 */
if ( ! function_exists( 'thim_preloading_icon' ) ) {
	function thim_preloading_icon() {
		$preloading = get_theme_mod( 'thim_display_preloading' );

		echo '<div id="thim-preloading">';

		if ( locate_template( 'templates/preloading/' . $preloading . '.php' ) ) {
			include locate_template( 'templates/preloading/' . $preloading . '.php' );
		}

		echo '</div>';

	}

}


/**
 * Get breadcrumb for page
 *
 * @return string
 */
function thim_get_breadcrumb_items_other() {
	global $author;
	$userdata   = get_userdata( $author );
	$categories = get_the_category();
	if ( is_front_page() ) { // Do not display on the homepage
		return;
	}
	if ( is_home() ) {
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_title() ) . '">' . esc_attr( get_the_title( get_option( 'page_for_posts', true ) ) ) . '</span></li>';
	} else if ( is_category() ) {
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html( $categories[0]->cat_name ) . '</span></li>';
	} else if ( is_tag() ) {
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( single_term_title( '', false ) ) . '">' . esc_html( single_term_title( '', false ) ) . '</span></li>';
	} else if ( is_year() ) {
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' ' . esc_html__( 'Archives', 'elearningwp' ) . '</span></li>';
	} else if ( is_author() ) {
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( $userdata->display_name ) . '">' . esc_html__( 'Author', 'elearningwp' ) . ' ' . esc_html( $userdata->display_name ) . '</span></li>';
	} else if ( get_query_var( 'paged' ) ) {
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__( 'Page', 'elearningwp' ) . ' ' . get_query_var( 'paged' ) . '">' . esc_html__( 'Page', 'elearningwp' ) . ' ' . esc_html( get_query_var( 'paged' ) ) . '</span></li>';
	} else if ( is_search() ) {
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__( 'Search results for:', 'elearningwp' ) . ' ' . esc_attr( get_search_query() ) . '">' . esc_html__( 'Search results for:', 'elearningwp' ) . ' ' . esc_html( get_search_query() ) . '</span></li>';
	} elseif ( is_404() ) {
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__( '404 Page', 'elearningwp' ) . '">' . esc_html__( '404 Page', 'elearningwp' ) . '</span></li>';
	}
}

function thim_excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	} else {
		$excerpt = implode( " ", $excerpt );
	}
	$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

	return $excerpt;
}

/**
 * Get content breadcrumbs
 *
 * @return string
 */
if ( ! function_exists( 'thim_breadcrumbs' ) ) {
	function thim_breadcrumbs() {
		global $post;
		$categories   = get_the_category();
		$thim_options = get_theme_mods();
		$icon         = '';
		if ( isset( $thim_options['breadcrumb_icon'] ) ) {
			$icon = html_entity_decode( get_theme_mod( 'breadcrumb_icon' ) );
		}
		// Build the breadcrums
		echo '<ul itemprop="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs" class="breadcrumbs">';
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( home_url() ) . '" title="' . esc_attr__( 'Home', 'elearningwp' ) . '"><span itemprop="name">' . esc_html__( 'Home', 'elearningwp' ) . '</span></a><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';
		if ( is_single() ) { // Single post (Only display the first category)
			if ( isset( $categories[0] ) ) {
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" title="' . esc_attr( $categories[0]->cat_name ) . '"><span itemprop="name">' . esc_html( $categories[0]->cat_name ) . '</span></a><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';
			}
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';
		} else if ( is_page() ) {
			// Standard page
			if ( $post->post_parent ) {
				$anc = get_post_ancestors( $post->ID );
				$anc = array_reverse( $anc );
				// Parent page loop
				foreach ( $anc as $ancestor ) {
					echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $ancestor ) ) . '" title="' . esc_attr( get_the_title( $ancestor ) ) . '"><span itemprop="name">' . esc_html( get_the_title( $ancestor ) ) . '</span></a><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';
				}
			}
			// Current page
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_title() ) . '"> ' . esc_html( get_the_title() ) . '</span></li>';
		} elseif ( is_day() ) {// Day archive
			// Year link
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_attr( get_the_time( 'Y' ) ) . '"><span itemprop="name">' . esc_html( get_the_time( 'Y' ) ) . ' ' . esc_html__( 'Archives', 'elearningwp' ) . '</span></a><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';
			// Month link
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '" title="' . esc_attr( get_the_time( 'M' ) ) . '"><span itemprop="name">' . esc_html( get_the_time( 'M' ) ) . ' ' . esc_html__( 'Archives', 'elearningwp' ) . '</span></a><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';
			// Day display
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_time( 'jS' ) ) . '"> ' . esc_html( get_the_time( 'jS' ) ) . ' ' . esc_html( get_the_time( 'M' ) ) . ' ' . esc_html__( 'Archives', 'elearningwp' ) . '</span></li>';

		} else if ( is_month() ) {
			// Year link
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_attr( get_the_time( 'Y' ) ) . '"><span itemprop="name">' . esc_html( get_the_time( 'Y' ) ) . ' ' . esc_html__( 'Archives', 'elearningwp' ) . '</span></a><span class="breadcrum-icon">' . ent2ncr( $icon ) . '</span></li>';
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr( get_the_time( 'M' ) ) . '">' . esc_html( get_the_time( 'M' ) ) . ' ' . esc_html__( 'Archives', 'elearningwp' ) . '</span></li>';
		}
		thim_get_breadcrumb_items_other();
		echo '</ul>';
	}
}

if ( ! function_exists( 'thim_archive_title' ) ) :
	/**
	 * Shim for `the_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 *
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after  Optional. Content to append to the title. Default empty.
	 */
	function thim_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			$title = sprintf( __( '%s', 'elearningwp' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( __( '%s', 'elearningwp' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( __( '%s', 'elearningwp' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( __( 'Year: %s', 'elearningwp' ), get_the_date( _x( 'Y', 'yearly archives date format', 'elearningwp' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( __( 'Month: %s', 'elearningwp' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'elearningwp' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( __( 'Day: %s', 'elearningwp' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'elearningwp' ) ) );
		} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'elearningwp' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'elearningwp' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'elearningwp' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'elearningwp' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'elearningwp' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'elearningwp' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'elearningwp' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'elearningwp' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'elearningwp' );
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( __( '%s', 'elearningwp' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( __( '%1$s: %2$s', 'elearningwp' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} elseif ( is_404() ) {
			$title = __( '404', 'elearningwp' );
		} elseif ( is_search() ) {
			$title = sprintf( __( 'Search Results for: %s', 'elearningwp' ), get_search_query() );
		} else {
			$title = __( 'Archives', 'elearningwp' );
		}

		/**
		 * Filter the archive title.
		 *
		 * @param string $title Archive title to be displayed.
		 */
		//$title = apply_filters( 'get_the_archive_title', $title );

		if ( ! empty( $title ) ) {
			echo ent2ncr( $before . $title . $after );
		}
	}
endif;

/**
 * Display feature image
 *
 * @param $attachment_id
 * @param $size_type
 * @param $width
 * @param $height
 * @param $alt
 * @param $title
 *
 * @return string
 */
function thim_get_feature_image( $attachment_id, $size_type = null, $width = null, $height = null, $alt = null, $title = null ) {

	if ( ! $size_type ) {
		$size_type = 'full';
	}
	$src   = wp_get_attachment_image_src( $attachment_id, $size_type );
	$style = '';
	if ( ! $src ) {
		// Get demo image
		global $wpdb;
		$attachment_id = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT p.ID FROM $wpdb->posts AS p INNER JOIN $wpdb->postmeta AS pm ON p.ID = pm.post_id
				WHERE 	pm.meta_key = %s
				AND 	pm.meta_value LIKE %s",
				'_wp_attached_file',
				'%demo_image.jpg'
			)
		);

		if ( empty( $attachment_id[0] ) ) {
			return;
		}

		$attachment_id = $attachment_id[0];
		$src           = wp_get_attachment_image_src( $attachment_id, 'full' );

	}

	if ( $width && $height ) {

		if ( $src[1] >= $width || $src[2] >= $height ) {

			$crop = ( $src[1] >= $width && $src[2] >= $height ) ? true : false;

			if ( $new_link = thim_aq_resize( $src[0], $width, $height, $crop ) ) {

				$src[0] = $new_link;

			}

		}
		$style = ' width="' . $width . '" height="' . $height . '"';
	} else {
		if ( ! empty( $src[1] ) && ! empty( $src[2] ) ) {
			$style = ' width="' . $src[1] . '" height="' . $src[2] . '"';
		}
	}

	if ( ! $alt ) {
		$alt = get_the_title( $attachment_id );
	}

	if ( ! $title ) {
		$title = get_the_title( $attachment_id );
	}

	return '<img src="' . esc_url( $src[0] ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $title ) . '" ' . $style . '>';

}

/**
 * Get login page url
 *
 * @return false|string
 */
if ( ! function_exists( 'thim_get_login_page_url' ) ) {
	function thim_get_login_page_url() {

		if ( ! thim_plugin_active( 'siteorigin-panels' ) ) {
			return wp_login_url();
		}

		if ( $page = get_option( 'thim_login_page' ) ) {
			return get_permalink( $page );
		} else {
			global $wpdb;
			$page = $wpdb->get_col(
				$wpdb->prepare(
					"SELECT p.ID FROM $wpdb->posts AS p INNER JOIN $wpdb->postmeta AS pm ON p.ID = pm.post_id
			WHERE 	pm.meta_key = %s
			AND 	pm.meta_value = %s
			AND		p.post_type = %s
			AND		p.post_status = %s",
					'thim_login_page',
					'1',
					'page',
					'publish'
				)
			);
			if ( ! empty( $page[0] ) ) {
				return get_permalink( $page[0] );
			}
		}

		return wp_login_url();

	}
}

/**
 * Get related posts
 *
 * @return WP_Query
 */
function thim_get_related_posts() {
	global $post;
	$number_posts  = 3;
	$tags          = wp_get_post_tags( $post->ID );
	$related_query = new WP_Query();

	if ( isset( $tags[0] ) ) {
		$first_tag = $tags[0]->term_id;

		$related_args  = array(
			'posts_per_page'      => $number_posts,
			'post__not_in'        => array( $post->ID ),
			'ignore_sticky_posts' => 0,
			'meta_key'            => '_thumbnail_id',
			'category__in'        => wp_get_post_categories( $post->ID )
		);
		$related_query = new WP_Query( $related_args );
	}

	return $related_query;
}

/**
 * Get related columns class
 *
 * @param string $class
 *
 * @return string
 */
function thim_get_related_columns_class( $class = '' ) {
	return $class . ' col-md-4';
}

/**
 * Get feature image
 *
 * @param int  $width
 * @param int  $height
 * @param bool $link
 *
 * @return string
 */
function thim_feature_image( $width = 1024, $height = 768, $link = true ) {
	global $post;
	if ( has_post_thumbnail() ) {
		if ( $link != true && $link != false ) {
			the_post_thumbnail( $post->ID, $link );
		} else {
			$get_thumbnail = simplexml_load_string( get_the_post_thumbnail( $post->ID, 'full' ) );
			if ( $get_thumbnail ) {
				$thumbnail_src = $get_thumbnail->attributes()->src;
				$img_url       = $thumbnail_src;
				$data          = @getimagesize( $img_url );
				$width_data    = $data[0];
				$height_data   = $data[1];
				if ( $link ) {
					if ( ( $width_data < $width ) || ( $height_data < $height ) ) {
						echo '<div class="thumbnail"><a href="' . esc_url( get_permalink() ) . '" title = "' . get_the_title() . '">';
						echo '<img src="' . $img_url[0] . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" />';
						echo '</a></div>';
					} else {
						$image_crop = thim_aq_resize( $img_url[0], $width, $height, true );
						echo '<div class="thumbnail"><a href="' . esc_url( get_permalink() ) . '" title = "' . get_the_title() . '">';
						echo '<img src="' . $image_crop . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" />';
						echo '</a></div>';
					}
				} else {
					if ( ( $width_data < $width ) || ( $height_data < $height ) ) {
						return '<img src="' . $img_url[0] . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" />';
					} else {
						$image_crop = thim_aq_resize( $img_url[0], $width, $height, true );

						return '<img src="' . $image_crop . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" />';
					}
				}
			}
		}
	}
}

/**
 * author meta
 *
 * @return void
 */
function thim_entry_meta_author() {
	echo thim_get_entry_meta_author();
}

/**
 * Get pagination
 *
 * @return string
 */

if ( ! function_exists( 'thim_paging_nav' ) ) :

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function thim_paging_nav() {
		global $wp_rewrite;
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $GLOBALS['wp_query']->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 2,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
			'type'      => 'array'
		) );

		if ( $links ) : ?>
			<ul class="loop-pagination">
				<?php foreach ( $links as $link ) {
					echo '<li>' . $link . '</li>';
				} ?>
			</ul><!-- .pagination -->
		<?php endif;
	}
endif;

/**
 * Show list comments
 *
 * @return string
 */
if ( ! function_exists( 'thim_comment' ) ) {
	function thim_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		//extract( $args, EXTR_SKIP );
		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo ent2ncr( $tag );
		echo ' '; ?><?php comment_class( 'description_comment' ) ?> id="comment-<?php comment_ID() ?>">
		<?php
		if ( $args['avatar_size'] != 0 ) {
			echo get_avatar( $comment, 70 );
		} ?>
		<div class="content-comment">
			<div class="author">
				<?php printf( '<span class="author-name">%s</span>', get_comment_author_link() ) ?>
				<span class="comment-extra-info">
					<?php
					printf( get_comment_date() );
					echo esc_html__( ' at ', 'elearningwp' );
					printf( get_comment_time() ) ?>
				</span>
				<span>
					<?php comment_reply_link( array_merge( $args, array(
						'add_below' => $add_below,
						'depth'     => $depth,
						'max_depth' => $args['max_depth']
					) ) ) ?>
					<?php edit_comment_link( esc_html__( 'Edit', 'elearningwp' ), '', '' ); ?>
				</span>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'elearningwp' ) ?></em>
			<?php endif; ?>
			<div class="message">
				<?php comment_text() ?>
			</div>
		</div>
		<div class="clear"></div>
		<?php
	}
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @return string HTML for meta tags
 */
if ( ! function_exists( 'thim_entry_meta' ) ) :
	function thim_entry_meta() {
		echo '<div class="entry-meta">';

		if ( get_theme_mod( 'thim_show_author', true ) ) :
			echo thim_get_entry_meta_author();
		endif;


		if ( get_theme_mod( 'thim_show_categories', false ) ) :
			echo thim_get_entry_meta_category();
		endif;

		if ( get_theme_mod( 'thim_show_comment', true ) ) :
			thim_entry_meta_comment_number();
		endif;

		echo '</div>';
	}
endif;

/**
 * Get author meta
 *
 * @return string
 */
function thim_get_entry_meta_author() {
	$html = '<span class="author vcard">';
	$html .= esc_html__( 'By ', 'elearningwp' ) . sprintf( '<a href="%1$s" rel="author">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) ) . '';
	$html .= '</span>';

	return $html;
}

/**
 * date meta
 *
 * @return void
 */
function thim_entry_meta_date() {
	echo thim_get_entry_meta_date();
}


/**
 * Get date meta
 *
 * @return string
 */
function thim_get_entry_meta_date() {
	$html = '<span class="entry-date">' . get_the_date( 'j F Y' ) . '</span>';

	return $html;
}


/**
 * Get category meta
 *
 * @return void
 */
function thim_entry_meta_category() {
	echo thim_get_entry_meta_category();
}

/**
 * Get category meta
 *
 * @return string
 */
function thim_get_entry_meta_category() {
	$html       = '<span class="meta-category">';
	$categories = get_the_category();
	if ( ! empty( $categories ) ) {
		$html .= esc_html__( 'in', 'elearningwp' );
		$html .= ' <a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
	}
	$html .= '</span>';

	return $html;
}

/**
 * Get tags meta
 *
 * @return void
 */
function thim_entry_meta_tags() {
	echo thim_get_entry_meta_tags();
}


/**
 * Get tags meta
 *
 * @return string
 */
function thim_get_entry_meta_tags() {
	$tags_list = get_the_tag_list( '', esc_html__( ', ', 'elearningwp' ) );
	if ( $tags_list ) {
		return sprintf( '<span class="tags-links">' . esc_html__( 'Tag: %1$s', 'elearningwp' ) . '</span>', $tags_list ); // WPCS: XSS OK.
	}

	return '';
}

/**
 * comment number
 *
 * @return void
 */
function thim_entry_meta_comment_number() {
	if ( comments_open() ) { ?>
		<span class="comment-total">
            <?php comments_popup_link( '0 Comment', '1 Comment', '% Comments', 'comments-link', 'Comments are off for this post' ); ?>
		</span>
		<?php
	}
}

/**
 * Filter register link
 *
 * @param $register_url
 *
 * @return string|void
 */
if ( ! function_exists( 'thim_get_register_url' ) ) {
	function thim_get_register_url() {
		$url = add_query_arg( 'action', 'register', thim_get_login_page_url() );

		return $url;
	}
}


if ( ! function_exists( 'thim_forum_title' ) ) :
	function thim_forum_title( $before = '', $after = '' ) {
		// Search page
		if ( function_exists( 'is_bbpress' ) ) {
			if ( bbp_is_search() ) {
				$pre_current_text = bbp_get_search_title();
				// Forum archive
			} elseif ( bbp_is_forum_archive() ) {
				$pre_current_text = bbp_get_forum_archive_title();
				// Topic archive
			} elseif ( bbp_is_topic_archive() ) {
				$pre_current_text = bbp_get_topic_archive_title();

				// View
			} elseif ( bbp_is_single_view() ) {
				$pre_current_text = bbp_get_view_title();

				// Single Forum
			} elseif ( bbp_is_single_forum() ) {
				$pre_current_text = bbp_get_forum_title();

				// Single Topic
			} elseif ( bbp_is_single_topic() ) {
				$pre_current_text = bbp_get_topic_title();

				// Single Topic
			} elseif ( bbp_is_single_reply() ) {
				$pre_current_text = bbp_get_reply_title();
				// Topic Tag (or theme compat topic tag)
			} elseif ( bbp_is_topic_tag() || ( get_query_var( 'bbp_topic_tag' ) && ! bbp_is_topic_tag_edit() ) ) {
				// Always include the tag name
				$tag_data[] = bbp_get_topic_tag_name();
				// If capable, include a link to edit the tag
				if ( current_user_can( 'manage_topic_tags' ) ) {
					$tag_data[] = '' . esc_html__( '(Edit)', 'elearningwp' ) . '';
				}

				// Implode the results of the tag data
				$pre_current_text = sprintf( __( 'Topic Tag: %s', 'elearningwp' ), implode( ' ', $tag_data ) );

				// Edit Topic Tag
			} elseif ( bbp_is_topic_tag_edit() ) {
				$pre_current_text = __( 'Edit', 'elearningwp' );
			} else {
				$pre_current_text = get_the_title();
			}
			if ( ! empty( $pre_current_text ) ) {
				echo ent2ncr( $before . $pre_current_text . $after );
			}
		}

	}
endif;

/**
 * Woo function
 */
if ( class_exists( 'WooCommerce' ) ) {
	// Woocomerce
	require get_template_directory() . '/woocommerce/woocommerce.php';
}

//logo
require_once get_template_directory() . '/templates/header/logo.php';

//custom logo mobile
require_once get_template_directory() . '/templates/header/logo-mobile.php';

/**
 * Widgets.
 */
if ( thim_plugin_active( 'thim-core' ) ) {
	require_once get_template_directory() . '/inc/widgets/widgets.php';
}

/**
 * Implement the tax-meta.
 */
require THIM_DIR . 'inc/libs/Tax-meta-class/Tax-meta-class.php';
/**
 * Tax meta.
 */
require_once get_template_directory() . '/inc/tax-meta.php';


// Update CSS within in Admin
function admin_style() {
	wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/inc/widgets/icon_widget.css' );
}

add_action( 'admin_enqueue_scripts', 'admin_style' );

/**
 * @param $settings
 *
 * @return array
 */
if ( ! function_exists( 'thim_import_add_basic_settings' ) ) {
	function thim_import_add_basic_settings( $settings ) {
		$settings[] = 'learn_press_archive_course_limit';
		$settings[] = 'learn_press_course_thumbnail_image_size[height]';
		$settings[] = 'learn_press_course_thumbnail_image_size[height]';
		$settings[] = 'wpb_js_margin';

		return $settings;
	}
}
add_filter( 'thim_importer_basic_settings', 'thim_import_add_basic_settings' );

/**
 * @param $settings
 *
 * @return array
 */
if ( ! function_exists( 'thim_import_add_page_id_settings' ) ) {
	function thim_import_add_page_id_settings( $settings ) {
		$settings[] = 'learn_press_courses_page_id';
		$settings[] = 'learn_press_profile_page_id';

		return $settings;
	}
}
add_filter( 'thim_importer_page_id_settings', 'thim_import_add_page_id_settings' );

//Add info for Dashboard Admin
add_filter( 'thim_theme_links_guide_user', function () {
	return array(
		'docs'      => 'http://docspress.thimpress.com/elearningwp/',
		'support'   => 'https://thimpress.com/forums/forum/elearningwp/',
		'knowledge' => 'https://thimpress.com/knowledge-base/',
	);
} );

add_filter( 'thim_envato_link_purchase', function () {
	return 'https://themeforest.net/item/lms-wordpress-theme-elearning-wp/11797847';
} );

add_filter( 'thim_envato_item_id', function () {
	return '11797847';
} );

/**
 * Check new version of LearnPress
 *
 * @return mixed
 */
if ( ! function_exists( 'thim_is_new_learnpress' ) ) {
	function thim_is_new_learnpress( $version ) {
		return version_compare( LEARNPRESS_VERSION, $version, '>=' );
	}
}

if ( ! function_exists( 'thim_check_is_course' ) ) {
	function thim_check_is_course() {

		if ( function_exists( 'learn_press_is_courses' ) && learn_press_is_courses() ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'thim_check_is_course_taxonomy' ) ) {
	function thim_check_is_course_taxonomy() {

		if ( function_exists( 'learn_press_is_course_taxonomy' ) && learn_press_is_course_taxonomy() ) {
			return true;
		} else {
			return false;
		}
	}
}

//Add Testimonials Socials

add_filter( 'rwmb_meta_boxes', 'thim_testimonials_socials' );
function thim_testimonials_socials( $meta_boxes ) {
	$prefix = 'thim_testimonials_';
	// 1st meta box
	$meta_boxes[] = array(
		'id'         => 'testimonials_socials',
		'title'      => __( 'Testimonials Socials', 'elearningwp' ),
		'post_types' => array( 'testimonials' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields'     => array(
			array(
				'name'  => __( 'Facebook', 'elearningwp' ),
				'id'    => $prefix . 'facebook',
				'type'  => 'text',
				'class' => 'custom-class',
				'clone' => false,
			),
			array(
				'name'  => __( 'Google', 'elearningwp' ),
				'id'    => $prefix . 'google',
				'type'  => 'text',
				'class' => 'custom-class',
				'clone' => false,
			),
			array(
				'name'  => __( 'Twitter', 'elearningwp' ),
				'id'    => $prefix . 'twitter',
				'type'  => 'text',
				'class' => 'custom-class',
				'clone' => false,
			),
			array(
				'name'  => __( 'Pinterest', 'elearningwp' ),
				'id'    => $prefix . 'pinterest',
				'type'  => 'text',
				'class' => 'custom-class',
				'clone' => false,
			),
		)
	);

	return $meta_boxes;
}

//Edit Post Page
function thim_admin_bar_link() {
	global $wp_admin_bar;
	global $post;
	if ( ! is_super_admin() || ! is_admin_bar_showing() ) {
		return;
	}
	if ( is_single() ) {
		$wp_admin_bar->add_menu( array(
			'id'     => 'edit_fixed',
			'parent' => false,
			'title'  => esc_html__( 'Edit Post', 'elearningwp' ),
			'href'   => get_edit_post_link( $post->id )
		) );
	};
	if ( is_page() ) {
		$wp_admin_bar->add_menu( array(
			'id'     => 'edit_fixed',
			'parent' => false,
			'title'  => esc_html__( 'Edit Page', 'elearningwp' ),
			'href'   => get_edit_post_link( $post->id )
		) );
	};
}

add_action( 'wp_before_admin_bar_render', 'thim_admin_bar_link' );


/**
 * Get social share
 *
 * @return string
 */
if ( ! function_exists( 'thim_post_social_share' ) ) {
	function thim_post_social_share() {

		$theme_options_data = get_theme_mods();

		$facebook  = isset( $theme_options_data['thim_sharing_facebook'] ) && $theme_options_data['thim_sharing_facebook'] ? $theme_options_data['thim_sharing_facebook'] : null;
		$twitter   = isset( $theme_options_data['thim_sharing_twitter'] ) && $theme_options_data['thim_sharing_twitter'] ? $theme_options_data['thim_sharing_twitter'] : null;
		$pinterest = isset( $theme_options_data['thim_sharing_pinterest'] ) && $theme_options_data['thim_sharing_pinterest'] ? $theme_options_data['thim_sharing_pinterest'] : null;
		$google    = isset( $theme_options_data['thim_sharing_google'] ) && $theme_options_data['thim_sharing_google'] ? $theme_options_data['thim_sharing_google'] : null;

		$socials = array();

		if ( $facebook ) {
			$socials[] = 'facebook';
		}
		if ( $twitter ) {
			$socials[] = 'twitter';
		}
		if ( $pinterest ) {
			$socials[] = 'pinterest';
		}
		if ( $google ) {
			$socials[] = 'google';
		}

		do_action( 'thim_post_socials' );

		$html = '<div class="thim-post-social-share popup" data-link="' . get_permalink() . '">';
		$html .= '<ul class="links">';
		foreach ( $socials as $key => $social ) {
			$html .= thim_render_social_share_link( $social );
		}
		$html .= '</ul>';
		$html .= '</div>';

		echo ent2ncr( $html );
	}
}

/**
 * Render social share
 *
 * @param $social_name
 *
 * @return string
 */
function thim_render_social_share_link( $social_name ) {
	switch ( $social_name ) {
		case 'facebook':
			return '<li><a class="link facebook" title="' . esc_html__( 'Facebook', 'one-business' ) . '" href="http://www.facebook.com/sharer/sharer.php?u=' . urlencode( get_permalink() ) . '" rel="nofollow"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
			break;

		case 'twitter':
			return '<li><a class="link twitter" title="' . esc_html__( 'Twitter', 'one-business' ) . '" href="https://twitter.com/intent/tweet?url=' . urlencode( get_permalink() ) . '&amp;text=' . esc_attr( urlencode( get_the_title() ) ) . '" rel="nofollow"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
			break;

		case 'pinterest':
			global $post;
			$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );

			return '<li><a class="link pinterest" title="' . esc_html__( 'Pinterest', 'one-business' ) . '" href="http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;media=' . ( ! empty( $src[0] ) ? $src[0] : '' ) . '&description=' . esc_attr( urlencode( get_the_title() ) ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>';
			break;

		case 'linkedin':
			return '<li><a class="link linkedin" target="_blank" title="' . esc_html__( 'LinkedIn', 'one-business' ) . '" href="http://www.linkedin.com/shareArticle?title=' . esc_attr( urlencode( get_the_title() ) ) . '&amp;url=' . esc_url( urlencode( get_permalink() ) ) . '" rel="nofollow"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>';
			break;


		case 'google':
			return '<li><a class="link google" title="' . esc_html__( 'Google', 'one-business' ) . '" href="https://plus.google.com/share?url=' . esc_url( urlencode( get_permalink() ) ) . '" rel="nofollow"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';
			break;

		default:
			do_action( 'thim_render_social_share_link' );
			break;
	}
}


/**
 * Social sharing
 */
if ( ! function_exists( 'thim_social_share' ) ) {
	function thim_social_share() {
		$theme_options_data = get_theme_mods();

		$facebook  = isset( $theme_options_data['thim_sharing_facebook'] ) && $theme_options_data['thim_sharing_facebook'] ? $theme_options_data['thim_sharing_facebook'] : null;
		$twitter   = isset( $theme_options_data['thim_sharing_twitter'] ) && $theme_options_data['thim_sharing_twitter'] ? $theme_options_data['thim_sharing_twitter'] : null;
		$pinterest = isset( $theme_options_data['thim_sharing_pinterest'] ) && $theme_options_data['thim_sharing_pinterest'] ? $theme_options_data['thim_sharing_pinterest'] : null;
		$google    = isset( $theme_options_data['thim_sharing_google'] ) && $theme_options_data['thim_sharing_google'] ? $theme_options_data['thim_sharing_google'] : null;

		if ( $facebook || $twitter || $pinterest || $google ) {
			echo '<ul class="thim-social-share">';
			do_action( 'thim_before_social_list' );
			if ( $facebook ) {

				echo '<li><div class="facebook-social"><a target="_blank" class="facebook"  href="https://www.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '" title="' . esc_attr__( 'Facebook', 'elearningwp' ) . '"><i class="fa fa-facebook"></i></a></div></li>';

			}
			if ( $google ) {
				echo '<li><div class="googleplus-social"><a target="_blank" class="googleplus" href="https://plus.google.com/share?url=' . urlencode( get_permalink() ) . '&amp;title=' . rawurlencode( esc_attr( get_the_title() ) ) . '" title="' . esc_attr__( 'Google Plus', 'elearningwp' ) . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'><i class="fa fa-google"></i></a></div></li>';

			}
			if ( $twitter ) {
				echo '<li><div class="twitter-social"><a target="_blank" class="twitter" href="https://twitter.com/share?url=' . urlencode( get_permalink() ) . '&amp;text=' . rawurlencode( esc_attr( get_the_title() ) ) . '" title="' . esc_attr__( 'Twitter', 'elearningwp' ) . '"><i class="fa fa-twitter"></i></a></div></li>';

			}

			if ( $pinterest ) {
				echo '<li><div class="pinterest-social"><a target="_blank" class="pinterest"  href="http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . rawurlencode( esc_attr( get_the_excerpt() ) ) . '&amp;media=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) . '" onclick="window.open(this.href); return false;" title="' . esc_attr__( 'Pinterest', 'elearningwp' ) . '"><i class="fa fa-pinterest-p"></i></a></div></li>';

			}
			do_action( 'thim_after_social_list' );

			echo '</ul>';
		}

	}
}
add_action( 'thim_social_share', 'thim_social_share' );

add_action( 'wp_ajax_thim_gallery_popup', 'thim_gallery_popup' );
add_action( 'wp_ajax_nopriv_thim_gallery_popup', 'thim_gallery_popup' );
/**
 * Function ajax widget gallery-posts
 */
if ( ! function_exists( 'thim_gallery_popup' ) ) {
	function thim_gallery_popup() {
		global $post;
		$post_id = $_POST["post_id"];
		$post    = get_post( $post_id );

		$format = get_post_format( $post_id->ID );

		$error = true;
		$link  = get_edit_post_link( $post_id );
		ob_start();

		if ( $format == 'video' ) {
			$url_video = get_post_meta( $post_id, 'thim_video', true );
			if ( empty( $url_video ) ) {
				echo '<div class="thim-gallery-message"><a class="link" href="' . $link . '">' . esc_html__( 'This post doesn\'t have config video, please add the video!', 'eduma' ) . '</a></div>';
			}
			// If URL: show oEmbed HTML
			if ( filter_var( $url_video, FILTER_VALIDATE_URL ) ) {
				if ( $oembed = @wp_oembed_get( $url_video ) ) {
					echo '<div class="video">' . $oembed . '</div>';
				}
			} else {
				echo '<div class="video">' . $url_video . '</div>';
			}

		} else {
			$images = thim_meta( 'thim_gallery', "type=image&single=false&size=full" );
			// Get category permalink


			if ( ! empty( $images ) ) {
				foreach ( $images as $k => $value ) {
					$url_image = $value['url'];
					if ( $url_image && $url_image != '' ) {
						echo '<a href="' . $url_image . '">';
						echo '<img src="' . $url_image . '" />';
						echo '</a>';
						$error = false;
					}
				}
			}
			if ( $error ) {
				if ( is_user_logged_in() ) {
					echo '<div class="thim-gallery-message"><a class="link" href="' . $link . '">' . esc_html__( 'This post doesn\'t have any gallery images, please add some!', 'eduma' ) . '</a></div>';
				} else {
					echo '<div class="thim-gallery-message">' . esc_html__( 'This post doesn\'t have any gallery images, please add some!', 'eduma' ) . '</div>';
				}

			}
		}

		$output = ob_get_contents();
		ob_end_clean();
		echo ent2ncr( $output );
		die();
	}
}

if ( get_theme_mod( 'thim_learnpress_hidden_ads' ) ) {
	remove_action( 'admin_footer', 'learn_press_advertise_in_admin', - 10 );
}

/**
 * Update password
 *
 * @param $user_id
 */
if ( ! function_exists( 'thim_register_extra_fields' ) ) {
	function thim_register_extra_fields( $user_id ) {

		if ( ! isset( $_POST['thim_register_form'] ) ) {
			return $user_id;
		}

		$user_data       = array();
		$user_data['ID'] = $user_id;
		if ( ! empty( $_POST['password'] ) ) {
			$user_data['user_pass'] = $_POST['password'];
			add_filter( 'send_password_change_email', '__return_false' );
		}
		$new_user_id = wp_update_user( $user_data );

		// Login after registered
		if ( ! is_admin() ) {
			wp_set_current_user( $user_id );
			wp_set_auth_cookie( $user_id );
			wp_new_user_notification( $user_id, null, 'both' );
			if ( ( isset( $_POST['billing_email'] ) && ! empty( $_POST['billing_email'] ) ) || ( isset( $_POST['bconfirmemail'] ) && ! empty( $_POST['bconfirmemail'] ) ) ) {
				return;
			} else {
				if ( ! empty( $_REQUEST['redirect_to'] ) ) {
					wp_redirect( $_REQUEST['redirect_to'] );
				} else {
					$theme_options_data = get_theme_mods();
					if ( ! empty( $_REQUEST['option'] ) && $_REQUEST['option'] == 'moopenid' ) {
						if ( isset( $_SERVER['HTTPS'] ) && ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) {
							$http = "https://";
						} else {
							$http = "http://";
						}
						$redirect_url = urldecode( html_entity_decode( esc_url( $http . $_SERVER["HTTP_HOST"] . str_replace( '?option=moopenid', '', $_SERVER['REQUEST_URI'] ) ) ) );
						if ( html_entity_decode( esc_url( remove_query_arg( 'ss_message', $redirect_url ) ) ) == wp_login_url() || strpos( $_SERVER['REQUEST_URI'], 'wp-login.php' ) !== false || strpos( $_SERVER['REQUEST_URI'], 'wp-admin' ) !== false ) {
							$redirect_url = site_url() . '/';
						}

						wp_redirect( $redirect_url );

						return;
					}

					if ( ! empty( $theme_options_data['thim_register_redirect'] ) ) {
						wp_redirect( $theme_options_data['thim_register_redirect'] );
					} else {
						wp_redirect( home_url() );
					}
				}
				exit();
			}
		}
	}
}
add_action( 'user_register', 'thim_register_extra_fields', 1000 );

if ( thim_plugin_active( 'paid-memberships-pro' ) ) {
	remove_action( 'login_init', 'pmpro_login_head' );
}


if ( ! function_exists( 'thim_multisite_register_redirect' ) ) {
	function thim_multisite_register_redirect( $url ) {

		if ( is_multisite() ) {
			$url = add_query_arg( 'action', 'register', thim_get_login_page_url() );
		}

		$user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : '';
		$user_email = isset( $_POST['user_email'] ) ? $_POST['user_email'] : '';
		$errors     = register_new_user( $user_login, $user_email );
		if ( ! is_wp_error( $errors ) ) {
			$redirect_to = ! empty( $_POST['redirect_to'] ) ? $_POST['redirect_to'] : 'wp-login.php?checkemail=registered';
			wp_safe_redirect( $redirect_to );
			exit();
		}

		return $url;
	}
}
add_filter( 'wp_signup_location', 'thim_multisite_register_redirect' );

/**
 * List child themes.
 *
 * @return array
 */
function thim_magwp_list_child_themes() {
	return array(
		'elearningwp-child' => array(
			'name'       => 'eLearningWP Child',
			'slug'       => 'elearningwp-child',
			'screenshot' => 'https://thimpresswp.github.io/demo-data/elearningwp/child-themes/elearningwp-child.png',
			'source'     => 'https://thimpresswp.github.io/demo-data/elearningwp/child-themes/elearningwp-child.zip',
			'version'    => '1.0.0'
		),
	);
}

add_filter( 'thim_core_list_child_themes', 'thim_magwp_list_child_themes' );


/*
 * Handle pagination for front page
 * */
add_action( 'pre_get_posts', function ( $q ) {
	if ( ! $q->is_main_query() || is_admin() || is_home() ) {
		return;
	}

	if ( isset( $q->query['paged'] ) ) {
		$q->set( 'paged', $q->query['paged'] );
		$q->set( 'page', $q->query['paged'] );
	}
}, 100000 );

add_filter( 'language_attributes', function ( $output ) {
	if ( get_theme_mod( 'thim_rtl_support', false ) && is_rtl() ) {
		$output .= ' dir="rtl"';
	}

	return $output;
} );