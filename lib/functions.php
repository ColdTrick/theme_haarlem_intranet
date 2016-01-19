<?php
/**
 * All helper functions are bundled here
 */

/**
 * Check if a group is an Afdelings group
 *
 * @param ElggEntity $entity the entity to check
 *
 * @return bool
 */
function theme_haarlem_intranet_is_afdelings_group(ElggEntity $entity) {
	
	if (empty($entity) || !elgg_instanceof($entity, 'group')) {
		return false;
	}
	
	$allowed_values = array(
		'hoofdafdeling',
		'afdeling',
		'bureau',
		'team',
	);
	
	$group_type = theme_haarlem_intranet_get_group_type($entity);
	if (empty($group_type)) {
		return false;
	}
	
	return in_array($group_type, $allowed_values);
}

/**
 * Get the type of the group
 *
 * @param ElggEntity $entity the entity to check
 *
 * @return string|false
 */
function theme_haarlem_intranet_get_group_type(ElggEntity $entity) {
	
	if (empty($entity) || !elgg_instanceof($entity, 'group')) {
		return false;
	}
	
	$profile_field_name = 'group_type';
	if (empty($entity->$profile_field_name)) {
		return 'groep';
	}
	
	return strtolower($entity->$profile_field_name);
}

/**
 * Get the quick nav menu for an entity
 *
 * @param int $entity_guid the guid of the entity to get the quick nav for
 *
 * @return array
 */
function theme_haarlem_intranet_get_quick_nav($entity_guid) {
	
	$settings = get_private_setting($entity_guid, 'quick_nav');
	if (empty($settings)) {
		return array();
	}
	
	return @json_decode($settings, true);
}

/**
 * Find a Profile Manager profile field with the given name
 *
 * @param string $metadata_name the profile field name
 *
 * @return false|ElggObject
 */
function theme_haarlem_intranet_get_profile_manager_profile_field($metadata_name) {
	static $fields;
	
	if (!isset($fields)) {
		$fields = array();
		
		if (elgg_is_active_plugin('profile_manager')) {
			$site = elgg_get_site_entity();
			
			$options = array(
				'type' => 'object',
				'subtype' => ProfileManagerCustomProfileField::SUBTYPE,
				'limit' => false,
				'owner_guid' => $site->getGUID(),
				'site_guid' => $site->getGUID()
			);
			$profile_fields = elgg_get_entities($options);
			if (!empty($profile_fields)) {
				foreach ($profile_fields as $profile_field) {
					$fields[$profile_field->metadata_name] = $profile_field;
				}
			}
		}
	}
	
	return elgg_extract($metadata_name, $fields, false);
}

/**
 * Get a page selector for in widgets
 *
 * @param ElggEntity $container the container to get the pages for
 * @param int        $depth     used for indentation
 *
 * @return array|false
 */
function theme_haarlem_pages_get_widget_selector(ElggEntity $container, $depth = 0) {

	if (empty($container) || !elgg_instanceof($container)) {
		return false;
	}
	if ($depth == 0) {
		$ordered = elgg_get_entities(array(
			'type' => 'object',
			'subtype' => 'page_top',
			'container_guid' => $container->getGUID(),
			'limit' => false,
		));
	} else {
		$ordered = elgg_get_entities_from_metadata(array(
			'type' => 'object',
			'subtype' => 'page',
			'metadata_name' => 'parent_guid',
			'metadata_value' => $container->getGUID(),
			'limit' => false,
		));
	}

	if (empty($ordered)) {
		return false;
	}

	$result = array();

	foreach ($ordered as $order => $page) {
		// add this page
		$result[$page->getGUID()] = trim(str_repeat('-', $depth) . ' ' . $page->title);
		// invalidate cache for OOM
		// @todo find a better way for this
		_elgg_invalidate_cache_for_entity($page->getGUID());

		// append children
		$children = theme_haarlem_pages_get_widget_selector($page, $depth + 1);
		if (!empty($children)) {
			$result += $children;
				
			unset($children);
		}
	}

	unset($ordered);

	return $result;
}

/**
 * Check if the current user wants sidebar collapsed
 *
 * @return bool
 */
function theme_haarlem_intranet_sidebar_collapsed() {

	$user = elgg_get_logged_in_user_entity();
	if (empty($user)) {
		return false;
	}
	
	$setting = elgg_get_plugin_user_setting('sidebar_collapsed', $user->guid, 'theme_haarlem_intranet');
	if (empty($setting)) {
		return false;
	}
	
	return true;
}

/**
 * Check if the site is configured as extranet
 *
 * @return bool
 */
function theme_haarlem_is_extranet() {

	static $result;
	
	if (isset($result)) {
		return $result;
	}
	
	$result = false;
	if (elgg_get_plugin_setting('is_extranet', 'theme_haarlem_intranet') == 'yes') {
		$result = true;
	}
	
	return $result;
}
