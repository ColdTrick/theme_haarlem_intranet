<?php
/**
 * show all group admins
 */

// check plugin settings
if (elgg_get_plugin_setting("multiple_admin", "group_tools") !== "yes") {
	return;
}

$group = elgg_extract("entity", $vars);
if (empty($group) || !elgg_instanceof($group, "group")) {
	return;
}

$options = array(
	"relationship" => "group_admin",
	"relationship_guid" => $group->getGUID(),
	"inverse_relationship" => true,
	"type" => "user",
	"limit" => false,
	"list_type" => "gallery",
	"gallery_class" => "elgg-gallery-users",
	"wheres" => array("e.guid <> " . $group->getOwnerGUID())
);

$users = elgg_get_entities_from_relationship($options);
if (empty($users)) {
	return;
}

// add owner to the beginning of the list
array_unshift($users, $group->getOwnerEntity());

$body = '<div id="theme-haarlem-intranet-owner-block-group-admins" class="hidden">';
$body .= elgg_view_entity_list($users, $options);
$body .= '</div>';

$title = elgg_view('output/url', array(
	'text' => elgg_echo("group_tools:multiple_admin:group_admins") . elgg_view_icon('chevron-circle-right', 'float-alt') . elgg_view_icon('chevron-circle-down', 'float-alt'),
	'href' => '#theme-haarlem-intranet-owner-block-group-admins',
	'rel' => 'toggle'
));
echo elgg_view_module("info", $title, $body, array('class' => 'theme-haarlem-intranet-owner-block-section'));
