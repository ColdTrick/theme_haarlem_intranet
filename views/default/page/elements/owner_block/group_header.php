<?php

$entity = elgg_extract('entity', $vars);

$icon = elgg_view_entity_icon($entity, 'small');

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
	$more_title = elgg_view('output/url', array(
		'text' => elgg_echo('theme_haarlem_intranet:owner_block:group:more') . elgg_view_icon('chevron-circle-right', 'float-alt') . elgg_view_icon('chevron-circle-down', 'float-alt'),
		'href' => '#theme-haarlem-intranet-owner-block-group-more',
		'rel' => 'toggle'
	));
	
	$more_content = '<div id="theme-haarlem-intranet-owner-block-group-more" class="hidden">';
	
	// owner
	$owner = $entity->getOwnerEntity();
	$more_content .= '<div>';
	$more_content .= elgg_view_icon('user');
	$more_content .= '<b>' . elgg_echo('groups:owner') . ': </b>';
	$more_content .= elgg_view('output/url', array(
		'text' => $owner->name,
		'href' => $owner->getURL(),
		'is_trusted' => true
	));
	$more_content .= '</div>';
	
	// description
	if ($entity->description) {
		$more_content .= '<div>';
		$more_content .= elgg_view('output/longtext', array('value' => $entity->description));
		$more_content .= '</div>';
	}
	
	$more_content .= '</div>';
	echo elgg_view_module('info', $more_title, $more_content, array('class' => 'theme-haarlem-intranet-owner-block-section'));
}

// admins
echo elgg_view('group_tools/group_admins', $vars);

// members
echo elgg_view('groups/sidebar/members', $vars);

// actions
if (elgg_in_context('group_profile')) {
	echo elgg_view_menu('title', array(
		'sort_by' => 'priority'
	));
}