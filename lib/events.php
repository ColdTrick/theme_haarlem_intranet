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
	
	$user_guid = (int) $object->guid_one;
	
	// enable site notifications for the new user
	set_user_notification_setting($user_guid, 'site', true);
	
	// enable mentions notifications for the new user
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

/**
 * Update a user based on information from profile sync
 *
 * @param string $event  the name of the event
 * @param string $type   the type of the event
 * @param mixed  $object supplied object
 *
 * @return void
 */
function theme_haarlem_intranet_profile_sync_update_user($event, $type, $object) {
	
	if (empty($object) || !is_array($object)) {
		return;
	}
	
	$user = elgg_extract('entity', $object);
	if (empty($user) || !elgg_instanceof($user, 'user')) {
		return;
	}
	
	$site = elgg_get_site_entity();
	
	if (!check_entity_relationship($user->getGUID(), 'member_of_site', $site->getGUID())) {
		// not a member, so add
		$site->addUser($user->getGUID());
	}
	
	// handle icons
	$datasource = elgg_extract('datasource', $object);
	$source_row = elgg_extract('source_row', $object);
	
	if (empty($datasource) || empty($source_row)) {
		return;
	}
	
	$fh = new ElggFile();
	$fh->owner_guid = $user->getGUID();
	
	$icon_sizes = elgg_get_config('icon_sizes');
	
	$icon_path = elgg_extract('ICON', $source_row);
	if (empty($icon_path)) {
		// remove icon
		foreach ($icon_sizes as $size => $info) {
			$fh->setFilename("haarlem_icon/{$size}.jpg");
			$fh->delete();
		}
		
		unset($user->haarlem_icontime);
		return;
	}
	
	$csv_location = $datasource->csv_location;
	if (empty($csv_location)) {
		return;
	}
	
	$csv_filename = basename($csv_location);
	$base_location = rtrim(str_ireplace($csv_filename, "", $csv_location), DIRECTORY_SEPARATOR);
	
	$icon_path = sanitise_filepath($icon_path, false); // prevent abuse (like ../../......)
	$icon_path = ltrim($icon_path, DIRECTORY_SEPARATOR); // remove beginning /
	$icon_path = $base_location . DIRECTORY_SEPARATOR . $icon_path; // concat base location and rel path
	
	// try to get the user icon
	$icon_contents = file_get_contents($icon_path);
	if (empty($icon_contents)) {
		return;
	}
		
	// write icon to a temp location for further handling
	$tmp_icon = tempnam(sys_get_temp_dir(), $user->getGUID());
	file_put_contents($tmp_icon, $icon_contents);
		
	// resize icon
	$icon_updated = false;
	foreach ($icon_sizes as $size => $icon_info) {
		$icon_contents = get_resized_image_from_existing_file($tmp_icon, $icon_info["w"], $icon_info["h"], $icon_info["square"], 0, 0, 0, 0, $icon_info["upscale"]);
	
		if (empty($icon_contents)) {
			continue;
		}
	
		$fh->setFilename("haarlem_icon/{$size}.jpg");
		$fh->open("write");
		$fh->write($icon_contents);
		$fh->close();
	
		$icon_updated = true;
	}
		
	// did we have a successfull icon upload?
	if ($icon_updated) {
		$user->haarlem_icontime = time();
	}
		
	// cleanup
	unlink($tmp_icon);
	unset($fh);
}