<?php
/**
 * Group members sidebar
 *
 * @package ElggGroups
 *
 * @uses $vars["entity"] Group entity
 * @uses $vars["limit"]  The number of members to display
 */

$group = elgg_extract("entity", $vars);
if (empty($group) || !elgg_instanceof($group, "group")) {
	return;
}

if ($group->getPrivateSetting("group_tools:cleanup:members") === "yes") {
	return;
}

if (!elgg_in_context('owner_block')) {
	return;
}

$limit = elgg_extract("limit", $vars, 14);
$options = array(
	"relationship" => "member",
	"relationship_guid" => $group->getGUID(),
	"inverse_relationship" => true,
	"type" => "user",
	"limit" => $limit,
	"list_type" => "gallery",
	"gallery_class" => "elgg-gallery-users",
	"pagination" => false,
	"count" => true
);

$member_count = elgg_get_entities_from_relationship($options);
$title = elgg_view('output/url', array(
	'text' => elgg_echo("groups:members") . " ({$member_count})" . elgg_view_icon('chevron-circle-right', 'float-alt') . elgg_view_icon('chevron-circle-down', 'float-alt'),
	'href' => '#theme-haarlem-intranet-owner-block-group-members',
	'rel' => 'toggle'
));

$all_link = elgg_view("output/url", array(
	"href" => "groups/members/" . $group->getGUID(),
	"text" => elgg_echo("groups:members:more"),
	"is_trusted" => true,
));

$body = '<div id="theme-haarlem-intranet-owner-block-group-members" class="hidden">';
$body .= elgg_list_entities_from_relationship($options);
$body .= "<div class='center mts'>$all_link</div>";
$body .= '</div>';

echo elgg_view_module("info", $title, $body, array('class' => 'theme-haarlem-intranet-owner-block-section'));
