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

/**
 * Adds a toggle link for use in responsive
 *
 * @param \ElggMenuItem $item
 */
function theme_haarlem_add_toggle_link(\ElggMenuItem &$item) {
	$children = $item->getChildren();
	if (empty($children)) {
		return;
	}
	$item->setText($item->getText() . elgg_view_icon('angle-right', 'elgg-menu-site-toggle'));
	
	foreach ($children as $child) {
		theme_haarlem_add_toggle_link($child);
	}
}


/**
 * custom function to search for events. Used in events widget. Needed to be able to filter on metadata
 * @param array $options
 * @return unknown[]
 */
function theme_intranet_haarlem_search_events($options = array()){
	$defaults = array(	'past_events' 		=> false,
						'count' 			=> false,
						'offset' 			=> 0,
						'limit'				=> EVENT_MANAGER_SEARCH_LIST_LIMIT,
						'container_guid'	=> null,
						'query'				=> false,
						'meattending'		=> false,
						'owning'			=> false,
						'friendsattending' 	=> false,
						'region'			=> null,
						'latitude'			=> null,
						'longitude'			=> null,
						'distance'			=> null,
						'event_type'		=> false,
						'past_events'		=> false,
						'search_type'		=> "list"
						
	);
	
	$options = array_merge($defaults, $options);
	
	$entities_options = array(
		'type' 			=> 'object',
		'subtype' 		=> 'event',
		'offset' 		=> $options['offset'],
		'limit' 		=> $options['limit'],
		'joins' => array(),
		'wheres' => array(),
		'order_by_metadata' => array("name" => 'start_day', "direction" => 'ASC', "as" => "integer")
	);
	
	if (isset($options['entities_options'])) {
		$entities_options = array_merge($entities_options, $options['entities_options']);
	}
	
	if($options["container_guid"]){
		// limit for a group
		$entities_options['container_guid'] = $options['container_guid'];
	}
	
	if($options['query']) {
		$entities_options["joins"][] = "JOIN " . elgg_get_config("dbprefix") . "objects_entity oe ON e.guid = oe.guid";
		$entities_options['wheres'][] = event_manager_search_get_where_sql('oe', array('title', 'description'), $options, false);
	}
				
	if(!empty($options['start_day'])) {
		$entities_options['metadata_name_value_pairs'][] = array('name' => 'start_day', 'value' => $options['start_day'], 'operand' => '>=');
	}
	
	if(!empty($options['end_day'])) {
		$entities_options['metadata_name_value_pairs'][] = array('name' => 'start_day', 'value' => $options['end_day'], 'operand' => '<=');
	}
	
	if(!$options['past_events']) {
		// only show from current day or newer
		$entities_options['metadata_name_value_pairs'][] = array('name' => 'start_day', 'value' => mktime(0, 0, 1), 'operand' => '>=');
	}
	
	if($options['meattending']) {
		$entities_options['joins'][] = "JOIN " . elgg_get_config("dbprefix") . "entity_relationships e_r ON e.guid = e_r.guid_one";
		
		$entities_options['wheres'][] = "e_r.guid_two = " . elgg_get_logged_in_user_guid();
		$entities_options['wheres'][] = "e_r.relationship = '" . EVENT_MANAGER_RELATION_ATTENDING . "'";
	}
	
	if($options['owning']) {
		$entities_options['owner_guids'] = array(elgg_get_logged_in_user_guid());
	}
	
	if($options["region"]){
		$entities_options['metadata_name_value_pairs'][] = array('name' => 'region', 'value' => $options["region"]);
	}
	
	if($options["event_type"]){
		$entities_options['metadata_name_value_pairs'][] = array('name' => 'event_type', 'value' => $options["event_type"]);
	}
	
	if($options['friendsattending']){
		$friends_guids = array();
		
		if($friends = elgg_get_logged_in_user_entity()->getFriends("", false)) {
			foreach($friends as $user) {
				$friends_guids[] = $user->getGUID();
			}
			$entities_options['joins'][] = "JOIN " . elgg_get_config("dbprefix") . "entity_relationships e_ra ON e.guid = e_ra.guid_one";
			$entities_options['wheres'][] = "(e_ra.guid_two IN (" . implode(", ", $friends_guids) . "))";
		} else	{
			// return no result
			$entities_options['joins'] = array();
			$entities_options['wheres'] = array("(1=0)");
		}
	}
	
	if(($options["search_type"] == "onthemap") && !empty($options['latitude']) && !empty($options['longitude']) && !empty($options['distance'])){
		$entities_options["latitude"] = $options['latitude'];
		$entities_options["longitude"] = $options['longitude'];
		$entities_options["distance"] = $options['distance'];
		$entities = elgg_get_entities_from_location($entities_options);
			
		$entities_options['count'] = true;
		$count_entities = elgg_get_entities_from_location($entities_options);
		
	} else {
		
		$entities = elgg_get_entities_from_metadata($entities_options);
		
		$entities_options['count'] = true;
		$count_entities = elgg_get_entities_from_metadata($entities_options);
	}
	
	$result = array(
		"entities" 	=> $entities,
		"count" 	=> $count_entities
		);
		
	return $result;
}
