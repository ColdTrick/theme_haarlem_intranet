<?php
/**
 * All event handlers are bundled here
 */

/**
 * Removes the cache for static widgets in groups
 *
 * @param string $event  the name of the event
 * @param string $type   the type of the event
 * @param mixed  $object supplied object
 *
 * @return void
 */
function theme_haarlem_intranet_update_static($event, $type, $object) {
	if ($object->getSubtype() !== 'static') {
		return;
	}
	
	$container = $object->getContainerEntity();
	if (elgg_instanceof($container, 'object', 'static')) {
		while(elgg_instanceof($container, 'object', 'static')) {
			$container = $container->getContainerEntity();
		}
	}
	
	if (!($container instanceof ElggGroup)) {
		return;
	}
	
	$batch = new \ElggBatch('elgg_get_entities_from_private_settings', [
		'type' => 'object',
		'subtype' => 'widget',
		'container_guid' => $container->guid,
		'limit' => false,
		'private_setting_name' => 'static_cache',
	]);
	
	$batch->setIncrementOffset(false);
		
	foreach ($batch as $widget) {
		$widget->static_cache = null;
	}
}

/**
 * Updates time last modified of discussion topic on reply
 *
 * @param string $event  the name of the event
 * @param string $type   the type of the event
 * @param mixed  $object supplied object
 *
 * @return void
 */
function theme_haarlem_intranet_create_group_topic_post($event, $type, $object) {
	if (!$object instanceof \ElggAnnotation) {
		return;
	}
	
	if ($object->name !== 'group_topic_post') {
		return;
	}
	
	$topic = $object->getEntity();
	if (!$topic instanceof \ElggEntity) {
		return;
	}
	if ($topic->getSubtype() !== 'groupforumtopic') {
		return;
	}
	
	$ia = elgg_set_ignore_access(true);
	$topic->save();
	elgg_set_ignore_access($ia);
}

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
 * Make sure the user from profile_sync is a member of the site
 *
 * @param string $event  the name of the event
 * @param string $type   the type of the event
 * @param mixed  $object supplied object
 *
 * @return void
 */
function theme_haarlem_intranet_profile_sync_site_membership($event, $type, $object) {
	
	if (empty($object) || !is_array($object)) {
		return;
	}
	
	$user = elgg_extract('entity', $object);
	if (empty($user) || !elgg_instanceof($user, 'user')) {
		return;
	}
	
	$datasource = elgg_extract('datasource', $object);
	if (empty($datasource) || !elgg_instanceof($datasource, 'object', 'profile_sync_datasource')) {
		return;
	}
	
	if ($datasource->datasource_type !== 'csv') {
		return;
	}
	
	$csv_location = $datasource->csv_location;
	$csv_filename = basename($csv_location);
	
	$site = elgg_get_site_entity();
	$is_member = check_entity_relationship($user->getGUID(), 'member_of_site', $site->getGUID());
	
	if ($csv_filename === 'pleio_removed.csv') {
		if ($is_member) {
			$site->removeUser($user->getGUID());
		}
		return;
	}
	
	if (!$is_member) {
		// not a member, so add
		$site->addUser($user->getGUID());
	}
}
/**
 * Copy a profile_sync field to another profile field
 *
 * @param string $event  the name of the event
 * @param string $type   the type of the event
 * @param mixed  $object supplied object
 *
 * @return void
 */
function theme_haarlem_intranet_profile_sync_zakelijkemail($event, $type, $object) {
	
	if (empty($object) || !is_array($object)) {
		return;
	}
	
	$user = elgg_extract('entity', $object);
	if (empty($user) || !elgg_instanceof($user, 'user')) {
		return;
	}
	
	$site = elgg_get_site_entity();
	
	// handle zakelijkemail
	$source_row = elgg_extract('source_row', $object);
	
	if (empty($source_row)) {
		return;
	}
	
	// duplicate email to profile field
	$email = elgg_extract('zakelijkemail', $source_row);
	$email = profile_sync_filter_var($email);
	if (!empty($email)) {
		
		// new value?
		if ($user->haarlem_email !== $email) {
			// default access
			$access = ACCESS_LOGGED_IN;
			if ($site instanceof Subsite) {
				$access = $site->getACL();
			}
			
			// get the access of existing profile data
			$access = profile_sync_get_profile_field_access($user->getGUID(), 'haarlem_email', $access);
				
			// save new value
			$user->setMetadata('haarlem_email', $email, '', false, $user->getGUID(), $access);
		}
	} elseif(isset($user->haarlem_email)) {
		// only unset if not set
		unset($user->haarlem_email);
	}
}
/**
 * Update the user profile icon based on profile_sync data
 *
 * @param string $event  the name of the event
 * @param string $type   the type of the event
 * @param mixed  $object supplied object
 *
 * @return void
 */
function theme_haarlem_intranet_profile_sync_profile_icon($event, $type, $object) {
	
	if (empty($object) || !is_array($object)) {
		return;
	}
	
	$user = elgg_extract('entity', $object);
	if (empty($user) || !elgg_instanceof($user, 'user')) {
		return;
	}
	
	// handle icons
	$datasource = elgg_extract('datasource', $object);
	$source_row = elgg_extract('source_row', $object);
	
	if (empty($datasource) || empty($source_row)) {
		return;
	}
	
	// handle custom icon
	$fh = new ElggFile();
	$fh->owner_guid = $user->getGUID();
	
	$icon_sizes = elgg_get_config('icon_sizes');
	
	$icon_path = elgg_extract('profielfoto', $source_row);
	$icon_path = profile_sync_filter_var($icon_path);
	if (empty($icon_path)) {
		// remove icon
		foreach ($icon_sizes as $size => $info) {
			$fh->setFilename("haarlem_icon/{$size}.jpg");
			if ($fh->exists()) {
				$fh->delete();
			}
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
	
	// icon exists
	if (!file_exists($icon_path)) {
		return;
	}
	
	// was csv image updated
	$csv_iconsize = @filesize($icon_path);
	if ($csv_iconsize !== false) {
		$csv_iconsize = md5($csv_iconsize);
		$icontime = $user->haarlem_icontime;
		
		if ($csv_iconsize === $icontime) {
			// icons are the same
			return;
		}
	}
	
	// try to get the user icon
	$icon_contents = file_get_contents($icon_path);
	if (empty($icon_contents)) {
		return;
	}
	
	// make sure we have a hash to save
	if ($csv_iconsize === false) {
		$csv_iconsize = strlen($icon_contents);
		$csv_iconsize = md5($csv_iconsize);
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
		$user->haarlem_icontime = $csv_iconsize;
	}
	
	// cleanup
	unlink($tmp_icon);
}

/**
 * Listen to the site join event to cleanup delayed group leave administration
 *
 * @param string           $event        the name of the event
 * @param string           $type         the type of the event
 * @param ElggRelationship $relationship the new relationship
 *
 * @return void
 */
function theme_haarlem_intranet_cleanup_delayed_group_leave($event, $type, $relationship) {
	
	if (!($relationship instanceof ElggRelationship)) {
		return;
	}
	
	$user = get_user($relationship->guid_one);
	if (empty($user)) {
		return;
	}
	
	unset($user->theme_haarlem_site_leave);
}
