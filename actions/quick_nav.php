<?php

$entity_guid = (int) get_input('entity_guid');
$icons = get_input('icons');
$texts = get_input('texts');
$hrefs = get_input('hrefs');

$entity = get_entity($entity_guid);
if (empty($entity) || !$entity->canEdit()) {
	register_error(elgg_echo('InvalidParameterException:NoEntityFound'));
	forward(REFERER);
}

$new_values = array();

foreach ($hrefs as $index => $href) {
	// check if value matches placeholder text
	if ($texts[$index] == elgg_echo('theme_haarlem_intranet:quick_nav:text')) {
		$texts[$index] = '';
	}
	if ($href == elgg_echo('theme_haarlem_intranet:quick_nav:href')) {
		continue;
	}
	
	if (empty($href)) {
		continue;
	}
	
	$new_values[] = array(
		'icon' => $icons[$index],
		'text' => $texts[$index],
		'href' => $href
	);
}

if (empty($new_values)) {
	remove_private_setting($entity_guid, 'quick_nav');
} else {
	set_private_setting($entity_guid, 'quick_nav', json_encode($new_values));
}

system_message(elgg_echo('theme_haarlem_intranet:action:quick_nav:success'));
forward(REFERER);