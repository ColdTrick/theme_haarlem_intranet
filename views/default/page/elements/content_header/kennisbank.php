<?php

$page_owner = elgg_get_page_owner_entity();

// can we view the current page
if (!elgg_in_context('static') && !$page_owner->canEdit()) {
	// no
	forward();
}

echo '<h1>' . elgg_view_icon('inbox', 'mrm') . "{$page_owner->name}</h1>";

echo elgg_view_menu('kennisbank', array(
	'sort_by' => 'priority',
	'entity' => $page_owner,
	'class' => 'elgg-menu-hz profile-action-menu'
));