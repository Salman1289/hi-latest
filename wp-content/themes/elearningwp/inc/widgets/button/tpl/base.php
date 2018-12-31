<?php
// Title
$title					= $instance['title'];
$url			= $instance['url'];
$new_window		= $instance['new_window'];

$icon			= $instance['icon']['icon'];
$icon_size		= $instance['icon']['icon_size'];

$button_size		= $instance['layout']['button_size'];
$rounding		= $instance['layout']['rounding'];

// Icon Size
if ($icon_size) {
	$icon_size = ' style="font-size: '.$icon_size.'px;"';
}
// Open New Window
if ($new_window) {
	$target = ' target="_blank"';
}else {
	$target = '';
}

// Icon
if ($icon) {
	$icon = '<i class="fa fa-' . $icon.'"'.$icon_size.'></i> ';
}

echo '<a class="widget-button ' .$instance['widget-class']. ' '.$rounding.' '.$button_size.'" href="'. $url .'"'.$target.'>'.$icon.$title.'</a>';

