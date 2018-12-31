<?php
/**
 * Template for displaying price of course within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/loop/course/price.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$course = LP_Global::course();
?>

<?php if ( $price_html = $course->get_price_html() ) : ?>

	<span class="price"><?php echo $price_html; ?></span>
	<?php
	if ( $course->get_origin_price() != $course->get_price() ) {
		$origin_price_html = $course->get_origin_price_html();
		?>
		<span class="origin-price"><?php echo $origin_price_html; ?></span>
		<?php
	}
	?>
<?php endif; ?>

