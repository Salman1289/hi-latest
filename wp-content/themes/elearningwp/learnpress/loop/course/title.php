<?php
/**
 * @author        ThimPress
 * @package       LearnPress/Templates
 * @version       1.0
 */

defined( 'ABSPATH' ) || exit();
?>
<h2 class="entry-title" itemprop="name">
	<a href="<?php echo get_the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
</h2>