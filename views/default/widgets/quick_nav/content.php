<?php

$widget = elgg_extract('entity', $vars);

echo elgg_view_menu('quick_nav', array(
	'entity' => $widget,
	'sort_by' => 'priority',
	'class' => 'elgg-menu-page'
));