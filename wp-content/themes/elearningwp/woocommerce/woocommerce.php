<?php
// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
	return $enqueue_styles;
}
// Remove Description From Single Product
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

/* Reorder */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 20 );

// Override WooCommerce function
if ( !function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {

	function woocommerce_template_loop_product_thumbnail() {
		global $product;
		$theme_options_data = get_theme_mods();
		$attachment_ids = $product->get_gallery_image_ids();
		$image          = "";
		if ( isset( $attachment_ids[0] ) ) {
			$image = wp_get_attachment_image( $attachment_ids[0], apply_filters( 'shop_catalog', 'shop_catalog' ) );
		}
		echo woocommerce_get_product_thumbnail();
		if ( $image != "" ) {
			echo '<div class="product-change-images">' . $image . '</div>';
		}
	}

}

// remove woocommerce_breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

add_filter( 'loop_shop_per_page', 'thim_loop_shop_per_page' );
function thim_loop_shop_per_page() {
	$theme_options_data = get_theme_mods();
 	parse_str( $_SERVER['QUERY_STRING'], $params );
	if ( isset( $theme_options_data['thim_woo_product_per_page'] ) && $theme_options_data['thim_woo_product_per_page'] ) {
		$per_page = $theme_options_data['thim_woo_product_per_page'];
	} else {
		$per_page = 12;
	}
	$pc = !empty( $params['product_count'] ) ? $params['product_count'] : $per_page;
	return $pc;
}

// add button compare before button wishlist in single product
global $yith_woocompare;
if ( isset( $yith_woocompare ) ) {
	remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
	add_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 30 );
}

add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_sharing', 50 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_add_to_cart', 30 );

/* Custom WC_Widget_Cart */
function thim_get_current_cart_info() {
	global $woocommerce;
	$items = count( $woocommerce->cart->get_cart() );

	return array(
		$items,
		get_woocommerce_currency_symbol()
	);
}

function thim_add_to_cart_success_ajax( $count_cat_product ) {
	global $woocommerce;
	list( $cart_items ) = thim_get_current_cart_info();
	if ( $cart_items > 0 ) {

	} else {
		$cart_items = '0';
	}
	$cat_total                                                  = $woocommerce->cart->get_cart_subtotal();
	$count_cat_product['#header-mini-cart #cart-items-number']  = '<span id="cart-items-number">' . $cart_items . '</span>';
	$count_cat_product['#header-mini-cart #cart-total .amount'] = $cat_total;

	return $count_cat_product;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'thim_add_to_cart_success_ajax' );


/* Share Product */
add_action( 'woocommerce_share', 'wooshare' );

function wooshare() {
	global $post;
	$theme_options_data = get_theme_mods();

	echo '<div class="woo-social"><ul class="social_link">';
	if ( isset ( $theme_options_data['thim_woo_sharing_facebook'] ) && $theme_options_data['thim_woo_sharing_facebook'] == 1 ) {
		echo '<li><a class="face" title="Share on Facebook." href="http://www.facebook.com/sharer.php?u=' . get_the_permalink() . '&amp;t=' . get_the_title() . '"><i class="fa fa-facebook"></i></a></li>';
	}
	if ( isset ( $theme_options_data['thim_woo_sharing_twitter'] ) && $theme_options_data['thim_woo_sharing_twitter'] == 1 ) {
		echo '<li><a class="twitter" title="Tweet this!" href="http://twitter.com/home/?status=' . get_the_title() . ' - ' . get_the_permalink() . '"><i class="fa fa-twitter"></i></a></li>';
	}
	if ( isset ( $theme_options_data['thim_woo_sharing_pinterest'] ) && $theme_options_data['thim_woo_sharing_pinterest'] == 1 ) {
		$url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
		echo '<li><a class="pinterest" href="http://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&media=' . $url . '"><i class="fa fa-pinterest"></i></a></li>';
	}
	if ( isset ( $theme_options_data['thim_woo_sharing_google'] ) && $theme_options_data['thim_woo_sharing_google'] == 1 ) {
		echo '<li><a class="google" href="https://plus.google.com/share?url=' . get_the_permalink() . '" onclick="javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;"><i class="fa fa-google-plus"></i></a></li>';
	}
	echo '</ul></div>';
	?>
<?php
}

// Change the breadcrumb separator
add_filter( 'woocommerce_breadcrumb_defaults', 'thim_change_breadcrumb_delimiter' );
function thim_change_breadcrumb_delimiter( $defaults ) {
	$defaults['delimiter'] = '';
	return $defaults;
}



/* PRODUCT QUICK VIEW */
add_action( 'wp_head', 'lazy_ajax', 0, 0 );
function lazy_ajax() {
	?>
	<script type="text/javascript">
		/* <![CDATA[ */
		var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
		/* ]]> */
	</script>
<?php
}

add_action( 'wp_ajax_jck_quickview', 'jck_quickview' );
add_action( 'wp_ajax_nopriv_jck_quickview', 'jck_quickview' );
/** The Quickview Ajax Output **/
function jck_quickview() {
	global $post, $product;
	$prod_id = $_POST["product"];
	$post    = get_post( $prod_id );
	$product = wc_get_product( $prod_id );
	// Get category permalink
	ob_start();
	?>
	<?php wc_get_template( 'content-quickview-product.php' ); ?>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	echo ent2ncr($output);
	die();
}


/* End PRODUCT QUICK VIEW */

//function woo_add_style_yith_compare() {
//	$css_file = get_template_directory_uri() . '/css/yith_compare.css';
//	echo '<link rel="stylesheet" type="text/css" media="all" href="' . esc_url( $css_file ) . '" />';
//}
//
//if ( isset( $_GET['action'], $_GET['iframe'] ) && $_GET['action'] == 'yith-woocompare-view-table' && $_GET['iframe'] == "true" ) {
//	add_action( 'wp_head', 'woo_add_style_yith_compare' );
//}
