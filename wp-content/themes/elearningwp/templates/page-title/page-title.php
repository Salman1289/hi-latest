<?php
/**
 * Page Title Bar
 *
 */

global $wp_query, $post;
$prefix               = 'thim_';
$GLOBALS['post']      = @$wp_query->post;
$thim_options         = get_theme_mods();
$thim_heading_top_src = $thim_heading_background_opacity = $custom_title = $subtitle = $text_color = $subtext_color = $sub_color = $bg_color = $front_title = '';
$hide_breadcrumb      = $hide_title = $hide_button = 0;
$cls_layout           = $button_text = $button_link = '';

$cat_obj = $wp_query->get_queried_object();

if ( isset( $cat_obj->term_id ) ) {
	$cat_ID = $cat_obj->term_id;
} else {
	$cat_ID = "";
}

if ( isset( $thim_options['thim_archive_single_hide_title'] ) ) {
	$hide_title = get_theme_mod( 'thim_archive_single_hide_title' );
}

if ( isset( $thim_options['thim_archive_single_hide_breadcrumbs'] ) ) {
	$hide_breadcrumb = get_theme_mod( 'thim_archive_single_hide_breadcrumbs' );
}

$thim_heading_top_src = THIM_URI . 'assets/images/page-title.jpg';

// Get style from metabox
if ( is_page() || is_single() ) {
	$postid               = get_the_ID();
	$using_custom_heading = get_post_meta( $postid, 'thim_enable_custom_title', true );

	if ( $using_custom_heading ) {
		$array_title = get_post_meta( $postid, 'thim_group_custom_title', false );
		$array_bg    = get_post_meta( $postid, 'thim_group_custom_background', false );

		if ( isset( $array_title[0] ) ) {
			if ( isset( $array_title[0]['thim_hide_title'] ) ) {
				$hide_title = $array_title[0]['thim_hide_title'];
			}
			if ( isset( $array_title[0]['thim_hide_breadcrumbs'] ) ) {
				$hide_breadcrumb = $array_title[0]['thim_hide_breadcrumbs'];
			}
			if ( isset( $array_title[0]['thim_custom_title'] ) ) {
				$custom_title = $array_title[0]['thim_custom_title'];
			}
			if ( isset( $array_title[0]['thim_custom_subtitle'] ) ) {
				$subtitle = $array_title[0]['thim_custom_subtitle'];
			}
			if ( isset( $array_title[0]['thim_color_title'] ) ) {
				$text_color_1 = $array_title[0]['thim_color_title'];
				if ( $text_color_1 <> '' ) {
					$text_color = $text_color_1;
				}
			}
			if ( isset( $array_title[0]['thim_color_subtitle'] ) ) {
				$sub_color_1 = $array_title[0]['thim_color_subtitle'];
				if ( $sub_color_1 <> '' ) {
					$subtext_color = $sub_color_1;
				}
			}
		}
		if ( isset( $array_bg[0] ) ) {
			if ( isset( $array_bg[0]['thim_heading_background'] ) ) {
				$bg_color_1 = $array_bg[0]['thim_heading_background'];
				if ( $bg_color_1 <> '' ) {
					$bg_color = $bg_color_1;
				}
			}
			if ( isset( $array_bg[0]['thim_heading_image'] ) ) {
				$thim_heading_top_img = $array_bg[0]['thim_heading_image'];
				$thim_heading_top_src = $thim_heading_top_img[0];

				if ( is_numeric( $thim_heading_top_img[0] ) ) {
					$thim_heading_top_attachment = wp_get_attachment_image_src( $thim_heading_top_img[0], 'full' );
					$thim_heading_top_src        = $thim_heading_top_attachment[0];
				}
			}
			if ( isset( $array_bg[0]['thim_heading_background_opacity'] ) ) {
				$thim_heading_background_opacity = $array_bg[0]['thim_heading_background_opacity'];
			}
		}
	} else {
		if ( ( isset( $thim_options['thim_archive_single_heading_bg_color'] ) && get_theme_mod( 'thim_archive_single_heading_bg_color' ) <> '' ) ) {
			$bg_color = get_theme_mod( 'thim_archive_single_heading_bg_color' );
		}
		if ( ( isset( $thim_options['thim_archive_single_heading_text_color'] ) && get_theme_mod( 'thim_archive_single_heading_text_color' ) <> '' ) ) {
			$text_color = get_theme_mod( 'thim_archive_single_heading_text_color' );
		}
		if ( ( isset( $thim_options['thim_archive_single_sub_heading_text_color'] ) && get_theme_mod( 'thim_archive_single_sub_heading_text_color' ) <> '' ) ) {
			$subtext_color = get_theme_mod( 'thim_archive_single_sub_heading_text_color' );
		}
		if ( ( isset( $thim_options['thim_archive_single_top_image'] ) && get_theme_mod( 'thim_archive_single_top_image' ) <> '' ) ) {
			$thim_heading_top_img = get_theme_mod( 'thim_archive_single_top_image' );
			$thim_heading_top_src = $thim_heading_top_img; // For the default value

			if ( is_numeric( $thim_heading_top_img ) ) {
				$thim_heading_top_attachment = wp_get_attachment_image_src( $thim_heading_top_img, 'full' );
				$thim_heading_top_src        = $thim_heading_top_attachment[0];
			}
		}
	}
} elseif ( is_category() ) {
	$postid = get_the_ID();

	if ( ! empty( $thim_options['thim_archive_cate_hide_breadcrumbs'] ) ) {
		$hide_breadcrumb = get_theme_mod( 'thim_archive_cate_hide_breadcrumbs' );
	}
	if ( ! empty( $thim_options['thim_archive_cate_hide_title'] ) ) {
		$hide_title = get_theme_mod( 'thim_archive_cate_hide_title' );
	}
	if ( ! empty( $thim_options['thim_archive_cate_sub_title'] ) ) {
		$subtitle = get_theme_mod( 'thim_archive_cate_sub_title' );
	}
	if ( ( isset( $thim_options['thim_archive_cate_heading_bg_color'] ) && get_theme_mod( 'thim_archive_cate_heading_bg_color' ) <> '' ) ) {
		$bg_color = get_theme_mod( 'thim_archive_cate_heading_bg_color' );
	}
	if ( ( isset( $thim_options['thim_archive_cate_heading_text_color'] ) && get_theme_mod( 'thim_archive_cate_heading_text_color' ) <> '' ) ) {
		$text_color = get_theme_mod( 'thim_archive_cate_heading_text_color' );
	}
	if ( ( isset( $thim_options['thim_archive_cate_sub_heading_text_color'] ) && get_theme_mod( 'thim_archive_cate_sub_heading_text_color' ) <> '' ) ) {
		$subtext_color = get_theme_mod( 'thim_archive_cate_sub_heading_text_color' );
	}
	if ( ( isset( $thim_options['thim_archive_cate_top_image'] ) && get_theme_mod( 'thim_archive_cate_top_image' ) <> '' ) ) {
		$thim_heading_top_img = get_theme_mod( 'thim_archive_cate_top_image' );
		$thim_heading_top_src = $thim_heading_top_img; // For the default value

		if ( is_numeric( $thim_heading_top_img ) ) {
			$thim_heading_top_attachment = wp_get_attachment_image_src( $thim_heading_top_img, 'full' );
			$thim_heading_top_src        = $thim_heading_top_attachment[0];
		}
	}
} else {
	$hide_breadcrumb      = get_theme_mod( 'thim_archive_cate_hide_breadcrumbs' );
	$hide_title           = get_theme_mod( 'thim_archive_cate_hide_title' );
	$bg_color             = get_theme_mod( 'thim_archive_cate_heading_bg_color' );
	$text_color           = get_theme_mod( 'thim_archive_cate_heading_text_color' );
	$subtext_color        = get_theme_mod( 'thim_archive_cate_sub_heading_text_color' );
	$thim_heading_top_img = get_theme_mod( 'thim_archive_cate_top_image' );
	$thim_heading_top_src = $thim_heading_top_img; // For the default value

	if ( is_numeric( $thim_heading_top_img ) ) {
		$thim_heading_top_attachment = wp_get_attachment_image_src( $thim_heading_top_img, 'full' );
		$thim_heading_top_src        = $thim_heading_top_attachment[0];
	}
}

if ( get_post_type() == 'lp_course' || get_post_type() == 'lp_quiz' || get_post_type() == 'product' || thim_check_is_course() || thim_check_is_course_taxonomy() ) {
	if ( is_tax() || is_archive() ) {
		$ext_prefix = 'learnpress_cate_';
		if ( get_post_type() == 'product' ) {
			$ext_prefix = 'woo_cate_';
		}
		if ( ! empty( $thim_options[ $prefix . $ext_prefix . 'heading_layout' ] ) ) {
			$cls_layout = 'courses_' . $thim_options[ $prefix . $ext_prefix . 'heading_layout' ];
		}
	} elseif ( is_single() ) {
		$ext_prefix = 'learnpress_single_';
		$cls_layout = 'courses_single';
		if ( get_post_type() == 'product' ) {
			$ext_prefix = 'woo_single_';
			$cls_layout = 'woo_single';
		}
	} else {
		$ext_prefix = '';
	}
	if ( ! empty( $thim_options[ $prefix . $ext_prefix . 'hide_breadcrumbs' ] ) ) {
		$hide_breadcrumb = get_theme_mod( $prefix . $ext_prefix . 'hide_breadcrumbs' );
	}
	if ( ! empty( $thim_options[ $prefix . $ext_prefix . 'hide_title' ] ) ) {
		$hide_title = get_theme_mod( $prefix . $ext_prefix . 'hide_title' );
	}
	if ( ! empty( $thim_options[ $prefix . $ext_prefix . 'top_image' ] ) ) {
		$thim_heading_top_src = get_theme_mod( $prefix . $ext_prefix . 'top_image' );
	}
	if ( ! empty( $thim_options[ $prefix . $ext_prefix . 'heading_bg_color' ] ) ) {
		$bg_color = get_theme_mod( $prefix . $ext_prefix . 'heading_bg_color' );
	}
	if ( ! empty( $thim_options[ $prefix . $ext_prefix . 'heading_text_color' ] ) ) {
		$text_color = get_theme_mod( $prefix . $ext_prefix . 'heading_text_color' );
	}
	if ( ! empty( $thim_options[ $prefix . $ext_prefix . 'sub_heading_text_color' ] ) ) {
		$subtext_color = get_theme_mod( $prefix . $ext_prefix . 'sub_heading_text_color' );
	}
	if ( ! empty( $thim_options[ $prefix . $ext_prefix . 'sub_title' ] ) ) {
		$subtitle = get_theme_mod( $prefix . $ext_prefix . 'sub_title' );
	}
}

// Forums and topics page
if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
	if ( get_post_type() === 'forum' ) {
		if ( $thim_options['thim_forum_cate_hide_breadcrumbs'] ) {
			$hide_breadcrumb = $thim_options['thim_forum_cate_hide_breadcrumbs'];
		}

		if ( $thim_options['thim_forum_cate_hide_title'] ) {
			$hide_title = $thim_options['thim_forum_cate_hide_title'];
		}

		if ( $thim_options['thim_forum_cate_sub_title'] ) {
			$subtitle = $thim_options['thim_forum_cate_sub_title'];
		}

		$thim_heading_top_src = ( $thim_options['thim_forum_cate_top_image'] ) ? $thim_options['thim_forum_cate_top_image'] : '';

		if ( $thim_options['thim_forum_cate_bg_color'] ) {
			$bg_color = $thim_options['thim_forum_cate_bg_color'];
		}

		if ( $thim_options['thim_forum_cate_title_color'] ) {
			$text_color = $thim_options['thim_forum_cate_title_color'];
		}

		if ( $thim_options['thim_forum_cate_sub_title_color'] ) {
			$subtext_color = $thim_options['thim_forum_cate_sub_title_color'];
		}
	}

	if ( get_post_type() === 'topic' ) {

	}
}
// End Forums and topics page

// Get style from metabox of tax
if ( is_tax() ) {
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
	$tax_object       = get_queried_object();
	$using_custom_tax = get_term_meta( $tax_object->term_id, $prefix . 'custom_heading', true );
	if ( $using_custom_tax ) {
		if ( get_term_meta( $tax_object->term_id, $prefix . $top_prefix . 'top_image', true ) ) {
			$img_header           = get_term_meta( $tax_object->term_id, 'elearningwp' . $prefix . '_top_image', true );
			$thim_heading_top_src = $img_header['url'];
		}
		if ( get_term_meta( $tax_object->term_id, $prefix . $cate_prefix . 'cate_heading_bg_color', true ) ) {
			$thim_heading_background_opacity = '0.95';
			$bg_color                        = get_term_meta( $tax_object->term_id, $prefix . $cate_prefix . 'cate_heading_bg_color', true );
		}
		if ( get_term_meta( $tax_object->term_id, $prefix . $cate_prefix . 'cate_heading_text_color', true ) ) {
			$text_color = get_term_meta( $tax_object->term_id, $prefix . $cate_prefix . 'cate_heading_text_color', true );
		}
		if ( get_term_meta( $tax_object->term_id, 'elearningwp' . $prefix . $cate_prefix . 'cate_sub_heading_text_color', true ) ) {
			$subtext_color = get_term_meta( $tax_object->term_id, $prefix . $cate_prefix . 'cate_sub_heading_text_color', true );
		}
		if ( get_term_meta( $tax_object->term_id, $prefix . $cate_prefix . 'cate_hide_title', true ) ) {
			$hide_title = get_term_meta( $tax_object->term_id, $prefix . $cate_prefix . 'cate_hide_title', true );
			$hide_title = ( $hide_title == 'on' ) ? '1' : $hide_title;
		}
		if ( get_term_meta( $tax_object->term_id, $prefix . $cate_prefix . 'cate_hide_breadcrumbs', true ) ) {
			$hide_breadcrumb = get_term_meta( $tax_object->term_id, $prefix . $cate_prefix . 'cate_hide_breadcrumbs', true );
			$hide_breadcrumb = ( $hide_breadcrumb == 'on' ) ? '1' : $hide_breadcrumb;
		}
		if ( get_term_meta( $tax_object->term_id, $prefix . $cate_prefix . 'cate_sub_title', true ) ) {
			$subtitle = get_term_meta( $tax_object->term_id, 'elearningwp' . $prefix . '_cate_sub_title', true );
		}
	}
}

$hide_title      = ( $hide_title == '1' ) ? '1' : $hide_title;
$hide_breadcrumb = ( $hide_breadcrumb == '1' ) ? '1' : $hide_breadcrumb;

// style css
$c_css_style = $c_ovelay_bg = $c_title_style = $c_subtitle_style = '';

$c_ovelay_bg  .= ( $bg_color != '' ) ? 'background-color: ' . $bg_color . ';' : '';
$c_ovelay_bg  .= ( $thim_heading_background_opacity != '' ) ? 'opacity: ' . $thim_heading_background_opacity . ';' : '';
$c_ovelay_css = ( $c_ovelay_bg != '' ) ? 'style="' . $c_ovelay_bg . '"' : '';
$c_css_style  .= ( $thim_heading_top_src != '' ) ? 'background-image:url(' . $thim_heading_top_src . ');' : '';

$c_css_sub_color  = ( $sub_color != '' ) ? 'style="color:' . $sub_color . '"' : '';
$c_title_style    .= ( $text_color != '' ) ? 'style="color:' . $text_color . '"' : '';
$c_subtitle_style .= ( $subtext_color != '' ) ? 'style="color:' . $subtext_color . '"' : '';

$c_css = ( $c_css_style != '' ) ? 'style="' . $c_css_style . '"' : '';

$class_icon_default = '';
if ( ( get_theme_mod( 'breadcrumb_icon' ) == '' ) || ( ! isset( $thim_options['breadcrumb_icon'] ) ) ) {
	$class_icon_default = 'icon-default';
}
?>
<?php
$list_grid = '';
if ( ( get_post_type() == "product" || get_post_type() == "post" || get_post_type() == "lpr_course" || get_post_type() == "lp_course" ) && ! is_single() ) {
	$post_type = get_post_type();
	if ( get_post_type() == "lp_course" ) {
		$post_type = 'lpr_course';
	}
	$list_grid = '<div class="display grid-list-switch ' . $post_type . '-switch" data-cookie="' . $post_type . '-switch">
		<a href="javascript:;" class="list switchToGrid">' . __( 'Grid', 'elearningwp' ) . '<i class="fa fa-th-large"></i></a>
		<a href="javascript:;" class="grid switchToList">' . __( 'List', 'elearningwp' ) . '<i class="fa fa-list-ul"></i></a>
	</div>';
}

if ( ( $hide_breadcrumb != '1' ) && ( $hide_title == '1' ) ) {
	?>
	<div class="breadcrumbs">
		<div class="container">
			<?php
			if ( get_post_type() == 'forum' ) {
				bbp_breadcrumb();
			} elseif ( get_post_type() == 'lp_course' || get_post_type() == 'lp_quiz' || thim_check_is_course() || thim_check_is_course_taxonomy() ) {
				thim_learnpress_breadcrumb();
			} elseif ( get_post_type() == 'product' ) {
				woocommerce_breadcrumb();
			} else {
				thim_breadcrumbs();
			}
			?>
		</div>

	</div>
	<?php
	return;
} elseif ( $hide_title == '1' ) {
	return;
}
?>

<div class="page-title <?php echo $cls_layout; ?>">
	<?php if ( get_theme_mod( 'enable_page_title', true ) ) : ?>
		<div class="main-top" <?php echo ent2ncr( $c_css ); ?> data-stellar-background-ratio="0.5">
			<span class="overlay-top-header" <?php echo ent2ncr( $c_ovelay_css ); ?>></span>
			<?php if ( $hide_title != '1' ) : ?>
				<div class="container content">
					<?php
					if ( $hide_breadcrumb != '1' ) { ?>
						<div class="breadcrumbs">
							<?php
							if ( get_post_type() == 'forum' ) {
								bbp_breadcrumb();
							} elseif ( get_post_type() == 'lp_course' || get_post_type() == 'lp_quiz' || thim_check_is_course() || thim_check_is_course_taxonomy() ) {
								thim_learnpress_breadcrumb();
							} elseif ( get_post_type() == 'product' ) {
								woocommerce_breadcrumb();
							} else {
								thim_breadcrumbs();
							}
							?>
						</div>
						<?php
					}
					?>
					<?php
					if ( is_single() ) {
						$typography = 'h2';
					} else {
						$typography = 'h1';
					}

					if ( ( get_post_type() == "product" ) ) {
						echo '<' . $typography . ' ' . $c_title_style . '>';
						woocommerce_page_title();
						echo '</' . $typography . '>';
					} elseif ( ( is_category() || is_archive() || is_search() || is_404() ) ) {
						echo '<' . $typography . ' ' . $c_title_style . '>';
						echo thim_archive_title();
						echo '</' . $typography . '>';

					} elseif ( is_page() || is_single() ) {
						if ( is_single() ) {
							if ( get_post_type() == "post" ) {
								if ( $custom_title ) {
									$single_title = $custom_title;
								} else {
									$category     = get_the_category();
									$category_id  = get_cat_ID( $category[0]->cat_name );
									$single_title = get_category_parents( $category_id, false, " " );
								}
								echo '<' . $typography . ' ' . $c_title_style . '>' . $single_title;
								echo '</' . $typography . '>';
							}

							if ( get_post_type() == "our_team" ) {
								echo '<' . $typography . ' ' . $c_title_style . '>' . esc_html__( 'Our Team', 'elearningwp' );
								echo '</' . $typography . '>';
							}
							if ( get_post_type() == "testimonials" ) {
								echo '<' . $typography . ' ' . $c_title_style . '>' . esc_html__( 'Testimonials', 'elearningwp' );
								echo '</' . $typography . '>';
							}
							if ( get_post_type() == "lp_course" ) {
								echo '<' . $typography . ' ' . $c_title_style . '>';
								the_title();
								echo '</' . $typography . '>';
							}
							if ( get_post_type() == 'forum' ) {
								echo '<' . $typography . ' ' . $c_title_style . '>';
								thim_forum_title();
								echo '</' . $typography . '>';
							}
						} else {
							echo '<' . $typography . ' ' . $c_title_style . '>';
							echo ( $custom_title != '' ) ? $custom_title : get_the_title( get_the_ID() );
							echo '</' . $typography . '>';
						}
					} elseif ( is_front_page() || is_home() ) {
						$front_title = '';
						if ( get_option( 'page_for_posts', true ) ) {
							$front_title = get_the_title( get_option( 'page_for_posts', true ) );
						}
						echo '<h1 ' . $c_title_style . '>';
						echo esc_attr( $front_title );
						echo '</h1>';
					}
					if ( isset( $subtitle ) ) {
						echo '<div class="banner-description" ' . $c_subtitle_style . '>' . esc_attr( $subtitle ) . '</div>';
					}

					if ( get_post_type() == "lp_course" && is_single() ) {
						?>
						<?php learn_press_get_template( 'single-course/header-info.php' ); ?>
						<?php
					}
					?>
				</div><!-- .container -->
			<?php endif; ?>
		</div><!-- .main-top -->
	<?php endif; ?>
	<?php
	// sidebar top of course
	if ( get_post_type() == "lpr_course" || get_post_type() == "lpr_quiz" || get_post_type() == "lp_course" || get_post_type() == "lp_quiz" ) {
		if ( is_active_sidebar( 'top_sidebar_courses' ) && ! is_single() ) :
			echo '<div id="top-sidebar-courses"><div class="container">';
			dynamic_sidebar( 'top_sidebar_courses' );
			echo '</div></div>';
		endif;
	}
	?>
</div><!-- .page-title -->