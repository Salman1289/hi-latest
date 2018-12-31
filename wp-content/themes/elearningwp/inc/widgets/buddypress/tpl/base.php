<?php //bp_nav_menu();

if ( !function_exists( 'bp_get_nav_menu_items' ) ) {
	return;
}
$nav_menus = bp_get_nav_menu_items();
if ( !$nav_menus ) {
	return;
}

echo '<span>' . $instance['label'] . '</span>';
$menus = array();
foreach ( $nav_menus as $key => $item ) {
	if ( $item->class[0] == 'menu-child' ) {
		if ( !isset( $menus[$item->parent] ) ) {
			$menus[$item->parent] = $item->link;
		}
	}
}

echo '<ul>';
foreach ( $menus as $name => $link ) {
	echo '<li><a href="' . $link . '">' . $name . '</a></li>';
}
echo '</ul>';