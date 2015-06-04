<?php

$page_owner = elgg_get_page_owner_entity();

// can we view the current page
if (!elgg_in_context('static') && !$page_owner->canEdit() && !$page_owner->isMember()) {
	// no
	forward();
}

$extra_input = elgg_view('input/hidden', array('name' => 'search_type', 'value' => 'entities'));
$extra_input .= elgg_view('input/hidden', array('name' => 'entity_type', 'value' => 'object'));
$extra_input .= elgg_view('input/hidden', array('name' => 'entity_subtype', 'value' => 'static'));

echo elgg_view('search/search_box', array(
	'class' => 'elgg-search-content-header',
	'placeholder' => elgg_echo('theme_haarlem_intranet:search:' . theme_haarlem_intranet_get_group_type($page_owner)),
	'container_entity' => $page_owner,
	'show_type_selection' => false,
	'extra_input' => $extra_input
));

echo '<h1>';
echo elgg_view_icon('inbox', 'mrm');
echo elgg_view('output/url', array(
	'text' => $page_owner->name,
	'href' => $page_owner->getURL(),
	'class' => 'theme-link'
));
echo '</h1>';