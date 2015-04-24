<?php
$group = elgg_get_page_owner_entity();

echo elgg_view('search/search_box', array(
	'class' => 'elgg-search-content-header',
	'placeholder' => elgg_echo('theme_haarlem_intranet:search:' . theme_haarlem_intranet_get_group_type($group)),
	'container_entity' => $group,
));
echo '<h1>' . elgg_view_entity_icon($group, 'small', array('class' => 'mrm')) . $group->name . "</h1>";