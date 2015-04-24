<?php

$entity = elgg_extract('entity', $vars);

$icon = elgg_view_entity_icon($entity, 'tiny');

$owner_link = elgg_view('output/url', array(
	'text' => $entity->name,
	'href' => $entity->getURL(),
	'is_trusted' => true
));

echo elgg_view_image_block($icon, $owner_link);

// short description
if ($entity->briefdescription) {
	echo '<div class="theme-haarlem-intranet-briefdescription">';
	echo elgg_get_excerpt($entity->briefdescription, 90);
	echo '</div>';
}
// open/closed
echo '<div class="theme-haarlem-intranet-status">';
if ($entity->isPublicMembership()) {
	echo elgg_view_icon('unlock-alt');
	echo elgg_echo('groups:open');
} else {
	echo elgg_view_icon('lock-closed');
	echo elgg_echo('groups:closed');
}
echo '</div>';

// more
if (group_gatekeeper(false)) {
	echo elgg_view('page/elements/owner_block/group/more', $vars);
}

// admins
echo elgg_view('group_tools/group_admins', $vars);

// members
if (!theme_haarlem_intranet_is_afdelings_group($entity)) {
	echo elgg_view('groups/sidebar/members', $vars);
}

// sub groups
if (theme_haarlem_intranet_is_afdelings_group($entity)) {
	echo elgg_view('page/elements/owner_block/group/related', $vars);
}

// actions
if (elgg_in_context('group_profile')) {
	echo elgg_view_menu('title', array(
		'sort_by' => 'priority'
	));
}
