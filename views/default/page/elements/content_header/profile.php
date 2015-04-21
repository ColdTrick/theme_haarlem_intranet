<?php

$page_owner = elgg_get_page_owner_entity();
$user = elgg_get_logged_in_user_entity();
if (!$page_owner || !$user) {
	return;
}

if ($page_owner->guid !== $user->guid) {
	return;
}

$menu = elgg_trigger_plugin_hook('register', "menu:user_hover", array('entity' => $user), array());
$builder = new ElggMenuBuilder($menu);
$menu = $builder->getMenu();
	
$actions = elgg_extract('action', $menu, array());
if (!$actions) {
	return;	
}

$body = '<ul class="elgg-menu elgg-menu-hz profile-action-menu">';
foreach ($actions as $action) {
	$body .= '<li class="mls">' . $action->getContent(array('class' => 'elgg-button elgg-button-action')) . '</li>';
}
$body .= '</ul>';

echo $body;