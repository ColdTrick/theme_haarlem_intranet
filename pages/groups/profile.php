<?php

$guid = (int) get_input('group_guid');
elgg_set_page_owner_guid($guid);

// turn this into a core function
global $autofeed;
$autofeed = true;

elgg_push_context('group_profile');

$group = get_entity($guid);
if (!elgg_instanceof($group, 'group')) {
	forward('', '404');
}

groups_register_profile_buttons($group);

$content = elgg_view('groups/profile/layout', array('entity' => $group));

$params = array(
	'content' => $content,
	'header' => '',
	'filter' => ''
);
$body = elgg_view_layout('content', $params);

echo elgg_view_page($group->name, $body);