<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 7/29/14
 * Time: 10:06 AM
 */
$theme_options_data = get_theme_mods();
?>
<ul class="nav navbar-nav menu-main-menu">
	<?php
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
	?>
</ul>
<!--</div>-->