<?php

$user = elgg_extract('entity', $vars);
if (empty($user) || !elgg_instanceof($user, 'user')) {
	return;
}

$groups = $user->getGroups('', 6);
if (empty($groups)) {
	return;
}

$title = elgg_view_icon('group', 'prs');
$title .= elgg_echo('groups');

$content = '';
foreach ($groups as $group) {
	$icon = elgg_view_entity_icon($group, 'tiny');
	
	$group_link = elgg_view('output/url', array(
		'text' => $group->name,
		'href' => $group->getURL(),
		'is_trusted' => true
	));
	
	$content .= elgg_view_image_block($icon, $group_link);
}

// more groups
$icon = elgg_view_icon('arrow-circle-o-right');
$link = elgg_view('output/url', array(
	'text' => elgg_echo('groups:all'),
	'href' => 'groups/member/' . $user->username,
	'is_trusted' => true
));
$content .= elgg_view_image_block($icon, $link, array('class' => 'elgg-divide-top'));

echo elgg_view_module('aside', $title, $content, array('class' => 'theme-haarlem-intranet-profile-group-membership'));