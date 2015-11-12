<?php
/**
 * Elgg pages widget
 *
 * @package ElggPages
 */

$page_owner = elgg_get_page_owner_entity();

if (!($page_owner instanceof ElggGroup)) {
	$num = (int) $vars['entity']->pages_num;
	
	$options = array(
		'type' => 'object',
		'subtype' => 'page_top',
		'container_guid' => $vars['entity']->owner_guid,
		'limit' => $num,
		'full_view' => FALSE,
		'pagination' => FALSE,
	);
	$content = elgg_list_entities($options);
	
	echo $content;
	
	if ($content) {
		$url = "pages/owner/" . elgg_get_page_owner_entity()->username;
		$more_link = elgg_view('output/url', array(
			'href' => $url,
			'text' => elgg_echo('pages:more'),
			'is_trusted' => true,
		));
		echo "<span class=\"elgg-widget-more\">$more_link</span>";
	} else {
		echo elgg_echo('pages:none');
	}
} else {
	$widget = elgg_extract("entity", $vars);
	$group = $widget->getOwnerEntity();
	if (empty($group) || !elgg_instanceof($group, "group")) {
		return;
	}
		
	$container = false;
	$main_page = (int) $widget->main_page;
	if (!empty($main_page)) {
		$container = get_entity($main_page);
		if (empty($container) || !(elgg_instanceof($container, 'object', 'page_top') || elgg_instanceof($container, 'object', 'page'))) {
			unset($container);
		}
	}
	
	if (empty($container)) {
		$container = $group;
	}
	
	$items = elgg_view('widgets/pages/items', array('container' => $container));
	
	if (empty($items)) {
		$list = elgg_echo("pages:none");
	} else {
		$list = '<ul class="elgg-menu elgg-menu-page elgg-menu-page-static">' . $items . '</ul>';
	}
	echo $list;
}
