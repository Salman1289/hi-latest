<?php

$rand = uniqid();
echo '<ul class="nav nav-tabs" role="tablist">';
//$active = $content_active ='';

$j = $k = 1;
if ( $instance['tab'] ) {
	foreach ( $instance['tab'] as $i => $tab ) {
		if ( $j == '1' ) {
			$active = "class='active'";
		} else {
			$active = '';
		}
		echo '<li role="presentation" ' . $active . '><a href="#thimm-widget-tab-' . $j . $rand . '" aria-controls="' . $tab['title'] . '" role="tab" data-toggle="tab">' . $tab['title'] . '</a></li>';
		$j ++;
	}
}

echo '</ul>';

echo '<div class="tab-content">';
if ( $instance['tab'] ) {
	foreach ( $instance['tab'] as $i => $tab ) {
		if ( $k == '1' ) {
			$content_active = " active";
		} else {
			$content_active = '';
		}
		echo ' <div role="tabpanel" class="tab-pane' . $content_active . '" id="thimm-widget-tab-' . $k . $rand . '">' . $tab['content'] . '</div>';
		$k ++;
	}
}
echo '</div>';
