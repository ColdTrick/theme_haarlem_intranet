<?php
/**
 * Reset all mentions settings to enable notifications
 */

// may take a while
set_time_limit(0);

$options = array(
	'type' => 'user',
	'limit' => false,
	'relationship' => 'member_of_site',
	'relationship_guid' => elgg_get_site_entity()->getGUID(),
	'inverse_relationship' => true
);

$counter = 0;
$users = new ElggBatch('elgg_get_entities_from_relationship', $options);
foreach ($users as $user) {
	$counter++;
	elgg_set_plugin_user_setting('notify', '1', $user->getGUID(), 'mentions');
	set_user_notification_setting($user->getGUID(), 'site', true);
}

system_message(elgg_echo('theme_haarlem_intranet:action:mentions:reset', array($counter)));
forward(REFERER);
