<?php
/**
 * Wrapper Layout
 *
 */

/**
 * Thim wrapper layout
 *
 * @return string
 */
if ( ! function_exists( 'thim_wrapper_layout' ) ) :
	function thim_wrapper_layout() {
		global $wp_query;
		$postid            = get_the_ID();
		$thim_options      = get_theme_mods();
		$wrapper_layout    = $using_custom_layout = $cat_ID = '';
		$wrapper_class_col = 'col-md-9 col-sm-8 alignleft';
		$prefix            = 'thim_';

		// get id category


		//Get layout from customizer
		if ( is_page() || is_single() ) {
			if ( isset( $thim_options[ $prefix . 'archive_single_layout' ] ) ) {
				$wrapper_layout = get_theme_mod( $prefix . 'archive_single_layout' );
			}
			// Get custom layout for page options ( metabox).
			$using_custom_layout = get_post_meta( $postid, $prefix . 'custom_layout', true );
			if ( $using_custom_layout ) {
				$wrapper_layout = get_post_meta( $postid, $prefix . 'custom_layout', true );
			}
		} else {
			if ( isset( $thim_options[ $prefix . 'archive_cate_layout' ] ) ) {
				$wrapper_layout = get_theme_mod( $prefix . 'archive_cate_layout' );
			}
			// Get custom layout for category,... from category options.
			// Code a here.
		}
		if ( is_category() ) {
			if ( isset( $thim_options[ $prefix . 'archive_cate_layout' ] ) ) {
				$wrapper_layout = get_theme_mod( $prefix . 'archive_cate_layout' );
			}
			$cat_obj = $wp_query->get_queried_object();
			if ( isset( $cat_obj->term_id ) ) {
				$cat_ID = $cat_obj->term_id;
				if ( get_term_meta( $cat_ID, $prefix . 'layout', true ) ) {
					$wrapper_layout = get_term_meta( $cat_ID, $prefix . 'layout', true );
				}
			}
		}
		if ( get_post_type() == 'lp_course' || get_post_type() == 'lp_quiz' || get_post_type() == 'product' || thim_check_is_course() || thim_check_is_course_taxonomy() ) {
			if ( is_tax() || is_archive() ) {
				$ext_prefix = 'learnpress_cate_';
				if ( get_post_type() == 'product' ) {
					$ext_prefix = 'woo_cate_';
				}
			} elseif ( is_single() ) {
				$ext_prefix = 'learnpress_single_';
				if ( get_post_type() == 'product' ) {
					$ext_prefix = 'woo_single_';
				}
			} else {
				$ext_prefix = '';
			}
			if ( ! empty( $thim_options[ $prefix . $ext_prefix . 'layout' ] ) ) {
				$wrapper_layout = get_theme_mod( $prefix . $ext_prefix . 'layout' );
			}
		}
		if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
			if ( get_post_type() == 'forum' ) {
				$wrapper_layout = $thim_options[ $prefix . 'forum_cate_layout' ];
			}
			if ( get_post_type() == 'topic' ) {
				$wrapper_layout = $thim_options[ $prefix . 'forum_topic_layout' ];
			}
		}
		if ( is_tax() ) {
			$taxonomy = ! empty( $_REQUEST['taxonomy'] ) ? $_REQUEST['taxonomy'] : 'category';
			if ( $taxonomy == 'product_cat' ) {
				$top_prefix  = 'woo_';
				$cate_prefix = 'woo_cate_';
			} elseif ( $taxonomy == 'course_category' ) {
				$top_prefix  = 'learnpress_';
				$cate_prefix = 'learnpress_cate_';
			} else {
				$top_prefix  = 'archive_';
				$cate_prefix = '';
			}
			$tax_object = get_queried_object();
			if ( get_term_meta( $tax_object->term_id, $prefix . 'layout', true ) ) {
				$wrapper_layout = get_term_meta( $tax_object->term_id, $prefix . 'layout', true );
			}
		}
		// Get layout for custom post type (testimonial, ourteam, ...) // Code a here.

		if ( isset( $_GET['layout'] ) ) {
			$wrapper_layout = trim( $_GET['layout'] );
		}
		// Get class layout

		if ( $wrapper_layout == 'sidebar-left' ) {
			$wrapper_class_col = "col-md-9 col-sm-8 alignright";
		} elseif ( $wrapper_layout == 'sidebar-right' ) {
			$wrapper_class_col = 'col-md-9 col-sm-8 alignleft';
		} elseif ( $wrapper_layout == 'full-sidebar' ) {
			$wrapper_class_col = 'col-sm-6 aligncenter';
		} else {
			$wrapper_class_col = "col-sm-12 full-width";
		}

		return $wrapper_class_col;
	}
endif;


add_action( 'thim_wrapper_loop_start', 'thim_wrapper_loop_start' );
/**
 * Get wrapper layout start
 *
 * @return string
 */
if ( ! function_exists( 'thim_wrapper_loop_start' ) ) :
	function thim_wrapper_loop_start() {
		$class_no_padding = '';
		if ( get_post_type() == "product" ) {
			$prefix = 'woocommerce_';
		} elseif ( get_post_type() == "post" ) {
			$prefix = 'blog_';
		} else {
			$prefix = '';
		}
		if ( is_page() || is_single() ) {
			$mtb_no_padding = get_post_meta( get_the_ID(), 'thim_no_padding_content', true );
			if ( $mtb_no_padding ) {
				$class_no_padding = 'no-padding';
			}
		}
		$wrapper_class_col = thim_wrapper_layout();
		if ( is_404() ) {
			$wrapper_class_col = 'col-sm-12 full-width';
		}
		echo '<div class="container site-content ' . $class_no_padding . '"><div class="row">';
		if ( $wrapper_class_col == 'col-sm-6 aligncenter' ) {
			$postid = get_the_ID();
			if ( is_page() ) {
				$get_sidebar_left = get_theme_mod( 'page_layout_sidebar_left' );
				// get sidebar from MTB
				$sidebar_left = get_post_meta( $postid, 'thim_custom_sidebar_left', true );
				if ( $sidebar_left ) {
					$get_sidebar_left = get_post_meta( $postid, 'thim_custom_sidebar_left', true );
				}
			} elseif ( is_single() ) {
				$get_sidebar_left = get_theme_mod( '' . $prefix . 'single_layout_sidebar_left' );
				// get sidebar from MTB
				$sidebar_left = get_post_meta( $postid, 'thim_custom_sidebar_left', true );
				if ( $sidebar_left ) {
					$get_sidebar_left = get_post_meta( $postid, 'thim_custom_sidebar_left', true );
				}
			} else {
				$get_sidebar_left = get_theme_mod( '' . $prefix . 'archive_layout_sidebar_left' );
			}
			echo '<aside id="secondary-left" class="widget-area col-md-3 col-sm-4 sticky-sidebar sidebar-left">';
			dynamic_sidebar( $get_sidebar_left );
			echo '</aside>';
		}
		echo '<main id="main" class="site-main ' . $wrapper_class_col . '" >';
	}
endif;


add_action( 'thim_wrapper_loop_end', 'thim_wrapper_loop_end' );
/**
 * Get wrapper layout end
 *
 * @return string
 */
if ( ! function_exists( 'thim_wrapper_loop_end' ) ) :
	function thim_wrapper_loop_end() {
		$postid = get_the_ID();
		if ( get_post_type() == "product" ) {
			$prefix = 'woocommerce_';
		} elseif ( get_post_type() == "post" ) {
			$prefix = 'blog_';
		} else {
			$prefix = '';
		}
		$wrapper_class_col = thim_wrapper_layout();
		if ( is_404() ) {
			$wrapper_class_col = 'col-sm-12 full-width';
		}
		echo '</main>';
		if ( $wrapper_class_col != 'col-sm-12 full-width' && $wrapper_class_col != 'col-sm-6 aligncenter' ) {
			if ( get_post_type() == "product" ) {
				get_sidebar( 'shop' );
			} elseif ( get_post_type() == "lp_course" ) {
				get_sidebar( 'courses' );
			} else {
				get_sidebar();
			}
		}
		if ( $wrapper_class_col == 'col-sm-6 aligncenter' ) {
			if ( is_page() ) {
				$get_sidebar_right = get_theme_mod( 'page_layout_sidebar_right' );
				// get sidebar from MTB
				$sidebar_right = get_post_meta( $postid, 'thim_custom_sidebar_right', true );
				if ( $sidebar_right ) {
					$get_sidebar_right = get_post_meta( $postid, 'thim_custom_sidebar_right', true );
				}
			} elseif ( is_single() ) {
				$get_sidebar_right = get_theme_mod( '' . $prefix . 'single_layout_sidebar_right' );
				// get sidebar from MTB
				$sidebar_right = get_post_meta( $postid, 'thim_custom_sidebar_right', true );
				if ( $sidebar_right ) {
					$get_sidebar_right = get_post_meta( $postid, 'thim_custom_sidebar_right', true );
				}
			} else {
				$get_sidebar_right = get_theme_mod( '' . $prefix . 'archive_layout_sidebar_right' );
			}
			echo '<aside id="secondary-right" class="widget-area col-md-3 col-sm-4 sticky-sidebar">';
			dynamic_sidebar( $get_sidebar_right );
			echo '</aside>';
		}
		echo '</div></div>';
	}
endif;
