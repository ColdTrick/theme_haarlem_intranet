<?php

$widget = elgg_extract('entity', $vars);

$num_display = (int) $widget->num_display;
if ($num_display < 1) {
	$num_display = 5;
}

$group_guid = (int) $widget->group_guid;
if (empty($group_guid)) {
	echo elgg_echo('theme_haarlem_intranet:izine:widget:no_group');
	return;
}

$options  = array(
	'type' => 'object',
	'subtype' => 'blog',
	'container_guid' => $group_guid,
	'limit' => $num_display,
	'metadata_name' => 'icontime'
);
$blogs = elgg_get_entities_from_metadata($options);
if (empty($blogs)) {
	echo elgg_echo('theme_haarlem_intranet:izine:widget:no_content');
	return;
}

// randomize the blogs
shuffle($blogs);

$class = '';
foreach ($blogs as $blog) {
	echo "<div class='{$class}'>";
	
	// image + nav
	$attr = array(
		'style' => 'background: url("' . $blog->getIconURL('master') . '"); background-size: cover;',
		'class' => 'theme-haarlem-intranet-izine-image'
	);
	
	echo '<div ' . elgg_format_attributes($attr) . '>';
	echo elgg_view_icon('chevron-left');
	echo elgg_view_icon('chevron-right');
	echo '</div>';
	
	// title
	$title = elgg_view('output/url', array(
		'text' => $blog->title,
		'href' => $blog->getURL(),
		'is_trusted' => true
	));
	// excerpt
	$excerpt = $blog->excerpt;
	if (empty($excerpt)) {
		$excerpt = elgg_get_excerpt($blog->description);
	}
	
	$excerpt .= elgg_view('output/url', array(
		'text' => elgg_echo('theme_haarlem_intranet:izine:widget:more'),
		'href' => $blog->getURL(),
		'class' => 'mls',
		'is_trusted' => true
	));
	
	echo elgg_view_module('izine', $title, $excerpt);
	
	echo '</div>';
	
	if (empty($class)) {
		$class = 'hidden';
	}
}