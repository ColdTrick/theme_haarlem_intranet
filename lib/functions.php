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