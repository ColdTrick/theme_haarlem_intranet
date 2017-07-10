<?php

$widget = elgg_extract('entity', $vars);

$num_display = (int) $widget->num_display;
if ($num_display < 1) {
	$num_display = 5;
}

$group_guid = $widget->group_guid;
if (empty($group_guid)) {
	echo elgg_echo('theme_haarlem_intranet:haarlem_news:widget:no_group');
	return;
}

$options  = array(
	'type' => 'object',
	'subtype' => 'blog',
	'container_guid' => $group_guid,
	'limit' => 1,
	'metadata_name' => 'featured'
);
$featured = elgg_get_entities_from_metadata($options);
if (!empty($featured)) {
	$featured = $featured[0];
	
	$options['wheres'] = array("e.guid <> {$featured->getGUID()}");
	$num_display--;
}

$options['limit'] = $num_display;
unset($options['metadata_name']);

$blogs = elgg_get_entities_from_metadata($options);
if (empty($blogs) && empty($featured)) {
	echo elgg_echo('theme_haarlem_intranet:haarlem_news:widget:no_content');
	return;
}

echo '<table>';

if (!empty($featured)) {
	$timestamp = htmlspecialchars(date(elgg_echo('friendlytime:date_format'), $featured->time_created));
	$date = date('d-m-Y', $featured->time_created);
	
	echo '<tr class="theme-haarlem-news-featured">';
	echo "<td><acronym title='{$timestamp}'>{$date}</acronym></td>";
	echo '<td><h3>';
	echo elgg_view('output/url', array(
		'text' => elgg_view_icon('arrow-circle-o-right', 'float-alt') . $featured->title,
		'href' => $featured->getURL(),
		'is_trusted' => true
	));
	echo '</h3></td>';
	echo '</tr>';
}

if (!empty($blogs)) {
	foreach ($blogs as $blog) {
		$timestamp = htmlspecialchars(date(elgg_echo('friendlytime:date_format'), $blog->time_created));
		$date = date('d-m-Y', $blog->time_created);
		
		echo '<tr>';
		echo "<td><acronym title='{$timestamp}'>{$date}</acronym></td>";
		echo '<td>';
		echo elgg_view('output/url', array(
			'text' => $blog->title,
			'href' => $blog->getURL(),
			'is_trusted' => true
		));
		echo '</td>';
		echo '</tr>';
	}
}

echo '</table>';

echo '<div class="elgg-widget-more">';
echo elgg_view('output/url', array(
	'text' => elgg_echo('theme_haarlem_intranet:haarlem_news:widget:more'),
	'href' => "blog/group/{$group_guid}/all",
	'is_trusted' => true
));
echo '</div>';
