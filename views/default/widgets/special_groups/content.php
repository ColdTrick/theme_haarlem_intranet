<?php

$widget = $vars["entity"];

$group_guids = $widget->group_guids;
if (empty($group_guids)) {
	return;
}

echo "<ul class='elgg-list elgg-list-entity'>";
foreach ($group_guids as $group_guid) {
	$group = get_entity($group_guid);
	if (!$group) {
		continue;
	}
	echo "<li class='elgg-item'>";
	$link = elgg_view('output/url', [
		'text' => $group->name,
		'href' => $group->getURL(),
	]);
	echo elgg_view_image_block('', $link);
	echo "</li>";
}
echo "<ul>";