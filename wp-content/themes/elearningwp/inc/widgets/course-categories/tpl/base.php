<?php
$show_count   = $instance['show_counts'];
$hierarchical = $instance['hierarchical'];
$taxonomy     = 'course_category';

$args_cat = array(
	'show_count'   => $show_count,
	'hierarchical' => $hierarchical,
	'taxonomy'     => $taxonomy,
	'title_li'     => ''
);
?>
<?php if ( $instance['title'] ) {
	echo ent2ncr($args['before_title'] . $instance['title'] . $args['after_title']);
} ?>
<ul><?php wp_list_categories( $args_cat ); ?> </ul>