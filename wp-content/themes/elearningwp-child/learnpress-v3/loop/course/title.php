<?php
/**
 * Template for displaying title of course within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/loop/course/title.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>
<h2 class="entry-title" itemprop="name">
	<a href="<?php echo get_the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
</h2>
