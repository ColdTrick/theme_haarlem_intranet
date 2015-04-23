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
	
	$profile_field_name = 'group_type';
	$allowed_values = array(
		'afdeling',
	);
	
	if (empty($entity->$profile_field_name)) {
		return false;
	}
	
	return in_array(strtolower($entity->$profile_field_name), $allowed_values);
}