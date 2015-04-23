<?php

$entity = elgg_extract('entity', $vars);
if (empty($entity) || !elgg_instanceof($entity, 'group')) {
	return;
}

if ($entity->related_groups_enable != "yes") {
	return true;
}

$dbprefix = elgg_get_config('dbprefix');
$options = array(
	"type" => "group",
	"limit" => 6,
	"relationship" => "related_group",
	"relationship_guid" => $entity->getGUID(),
	"full_view" => false,
	"joins" => array("JOIN {$dbprefix}groups_entity ge ON e.guid = ge.guid"),
	"order_by" => "ge.name"
);

$groups = elgg_get_entities_from_relationship($options);
if (empty($groups)) {
	return;
}

$content = '<div id="theme-haarlem-intranet-owner-block-group-related" class="hidden">';
for ($i = 0; $i < 5 && $i < count($groups); $i++) {
	$group = $groups[$i];
	
	$icon = elgg_view_entity_icon($group, 'tiny');
	
	$link = elgg_view('output/url', array(
		'text' => $group->name,
		'href' => $group->getURL(),
		'is_trusted' => true
	));
	
	$content .= elgg_view_image_block($icon, $link);
}

if (count($groups) > $i) {
	$content .= elgg_view("output/url", array(
		"href" => "groups/related/" . $entity->getGUID(),
		"text" => elgg_echo("link:view:all"),
		"is_trusted" => true,
	));
}

$content .= '</div>';

$group_type = theme_haarlem_intranet_get_group_type($entity);
$related_text = elgg_echo("theme_haarlem_intranet:owner_block:group:related:{$group_type}");
$related_text .= elgg_view_icon('chevron-circle-right', 'float-alt');
$related_text .= elgg_view_icon('chevron-circle-down', 'float-alt');

$related_title = elgg_view('output/url', array(
	'text' => $related_text,
	'href' => '#theme-haarlem-intranet-owner-block-group-related',
	'rel' => 'toggle'
));

echo elgg_view_module('info', $related_title, $content, array('class' => 'theme-haarlem-intranet-owner-block-section'));
