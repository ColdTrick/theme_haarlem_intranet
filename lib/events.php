<?php
/**
 * All event handlers are bundled here
 */

/**
 * Listen to the join site event
 *
 * @param string $event  the name of the event
 * @param string $type   the type of the event
 * @param mixed  $object supplied object
 *
 * @return void
 */
function theme_haarlem_intranet_site_join_event($event, $type, $object) {
	
	if (empty($object) || !($object instanceof ElggRelationship)) {
		return;
	}
	
	// enable site notifications for the new user
	set_user_notification_setting($user->getGUID(), 'site', true);
	
	// enable mentions notifications for the new user
	$user_guid = (int) $object->guid_one;
	
	elgg_set_plugin_user_setting('notify', '1', $user_guid, 'mentions');
}

/**
 * Listen to the leave site event
 *
 * @param string $event  the name of the event
 * @param string $type   the type of the event
 * @param mixed  $object supplied object
 *
 * @return void
 */
function theme_haarlem_intranet_site_leave_event($event, $type, $object) {
	
	if (empty($object) || !($object instanceof ElggRelationship)) {
		return;
	}
	
	// disable mentions notifications for the leaving user
	$user_guid = (int) $object->guid_one;
	
	elgg_set_plugin_user_setting('notify', '0', $user_guid, 'mentions');
}
