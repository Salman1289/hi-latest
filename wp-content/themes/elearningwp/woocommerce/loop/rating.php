<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;

$rating = $product->get_average_rating();
 
if ($rating == '') {
?>
	<div title="Rated 0 out of 5" class="star-rating"><span style="width:0%"><strong class="rating">0.00</strong> out of 5</span></div>
<?php
} else {
	$rating_html = wc_get_rating_html( $product->get_average_rating() );
	echo ent2ncr($rating_html);
}