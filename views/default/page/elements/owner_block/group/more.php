<?php

$entity = elgg_extract('entity', $vars);
if (empty($entity) || !elgg_instanceof($entity, 'group')) {
	return;
}

$group_type = theme_haarlem_intranet_get_group_type($entity);
$more_text = elgg_echo("theme_haarlem_intranet:owner_block:group:more:{$group_type}");
$more_text .= elgg_view_icon('chevron-circle-right', 'float-alt');
$more_text .= elgg_view_icon('chevron-circle-down', 'float-alt');

$more_title = elgg_view('output/url', array(
	'text' => $more_text,
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