<?php

$page_owner = elgg_get_page_owner_entity();

// can we view the current page
if (!elgg_in_context('static') && !$page_owner->canEdit()) {
	// no
	forward();
}
echo elgg_view('search/search_box', array(
	'class' => 'elgg-search-content-header',
	'placeholder' => elgg_echo('theme_haarlem_intranet:search:' . theme_haarlem_intranet_get_group_type($page_owner)),
	'container_entity' => $page_owner,
));

echo '<h1>' . elgg_view_icon('inbox', 'mrm') . "{$page_owner->name}</h1>";

echo elgg_view_menu('kennisbank', array(
	'sort_by' => 'priority',
	'entity' => $page_owner,
	'class' => 'elgg-menu-hz profile-action-menu'
));