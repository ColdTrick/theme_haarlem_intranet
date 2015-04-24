<?php

$entity = elgg_extract('entity', $vars);

$icon = elgg_view_entity_icon($entity, 'tiny', array('use_hover' => false));

$owner_link = elgg_view('output/url', array(
	'text' => $entity->name,
	'href' => $entity->getURL(),
	'is_trusted' => true
));

echo elgg_view_image_block($icon, $owner_link);
