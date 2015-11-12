<?php

$container = elgg_extract('container', $vars);

if (empty($container)) {
	return;
}
$items = '';

if ($container instanceof ElggGroup) {
	
	$entities = elgg_get_entities(array(
		'type' => 'object',
		'subtype' => 'page_top',
		'container_guid' => $container->getGUID(),
		'limit' => false,
	));
	
	if ($entities) {
		foreach ($entities as $entity) {
			$items .= '<li><a href="' . $entity->getURL() . '"><span>' . $entity->title . '</span></a></li>';
		}
	}
} else {

	$entities = elgg_get_entities_from_metadata(array(
		'type' => 'object',
		'subtype' => 'page',
		'metadata_name' => 'parent_guid',
		'metadata_value' => $container->getGUID(),
		'limit' => false,
	));
	
	if ($entities) {
		foreach ($entities as $entity) {
			$children = elgg_view('widgets/pages/items', array('container' => $entity));
			
			$url_options = array(
				'text' => '<span>' . $entity->title . '<span>',
				'href' => $entity->getURL(),
				'is_trusted' => true,
			);
			
			if ($children) {
				$url_options['class'] = 'elgg-menu-closed elgg-menu-parent';
			}
			
			$items .= '<li>';
			$items .= elgg_view('output/url', $url_options);
			if ($children) {
				$items .= '<ul class="elgg-menu elgg-child-menu">' . $children . '</ul>';
			}
			$items .= '</li>';
		}
	}
}

echo $items;