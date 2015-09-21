<?php
$group = elgg_get_page_owner_entity();

echo elgg_view('search/search_box', array(
	'class' => 'elgg-search-content-header',
	'placeholder' => elgg_echo('theme_haarlem_intranet:search:' . theme_haarlem_intranet_get_group_type($group)),
	'container_entity' => $group,
	'autocomplete' => false,
));
echo '<h1>';
echo elgg_view_entity_icon($group, 'small', array('class' => 'mrm'));
echo elgg_view('output/url', array(
	'text' => $group->name,
	'href' => $group->getURL(),
	'class' => 'theme-link'
));
echo '</h1>';