<?php
/**
 * Embeddable content list item view
 *
 * @uses $vars['entity'] ElggEntity object
 */

$entity = $vars['entity'];

$title = $entity->title;
if (!$title) {
	$title = $entity->name;
}

// different entity types have different title attribute names.
$title = isset($entity->name) ? $entity->name : $entity->title;
// don't let it be too long
$title = elgg_get_excerpt($title);

$owner = $entity->getOwnerEntity();
if ($owner) {
	$author_text = elgg_echo('byline', array($owner->name));
	$date = elgg_view_friendly_time($entity->time_created);
	$subtitle = "$author_text $date";
} else {
	$subtitle = '';
}

$params = array(
	'title' => $title,
	'entity' => $entity,
	'subtitle' => $subtitle,
	'tags' => FALSE,
);
$body = elgg_view('object/elements/summary', $params);

$link_class = 'embed-insert';
if ($entity instanceof ElggFile) {
	$mime = $entity->getMimeType();
	if (stristr($mime, 'image')) {
		
		$body .= elgg_view('output/url', array(
			'text' => elgg_view('output/img', array(
				'src' => $entity->getIconURL('large'),
				'class' => $link_class,
				'alt' => $entity->title,
			)),
			'href' => "file/download/{$entity->getGUID()}",
			'class' => 'hidden',
			'is_trusted' => true,
		));
		
		$link_class = '';
	}
}

$image = elgg_view_entity_icon($entity, 'small', array('link_class' => $link_class));

echo elgg_view_image_block($image, $body);
