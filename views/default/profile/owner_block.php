<?php
/**
 * Profile owner block
 */

$user = elgg_get_page_owner_entity();

if (!$user) {
	// no user so we quit view
	echo elgg_echo('viewfailure', array(__FILE__));
	return TRUE;
}

$icon = elgg_view_entity_icon($user, 'large', array(
	'use_hover' => false,
	'use_link' => false,
));

// grab the actions and admin menu items from user hover
$menu = elgg_trigger_plugin_hook('register', "menu:user_hover", array('entity' => $user), array());
$builder = new ElggMenuBuilder($menu);
$menu = $builder->getMenu();
$actions = elgg_extract('action', $menu, array());
$admin = elgg_extract('admin', $menu, array());

$profile_actions = '';
if (elgg_is_logged_in() && $actions) {
	$profile_actions = '<ul class="elgg-menu profile-action-menu mvm">';
	foreach ($actions as $action) {
		$profile_actions .= '<li>' . $action->getContent(array('class' => 'elgg-button elgg-button-action')) . '</li>';
	}
	$profile_actions .= '</ul>';
}

// if admin, display admin links
if (!empty($admin)) {	
	$admin_links = '<ul class="elgg-menu"><li>';
	$admin_links .= elgg_view('output/url', array(
		'class' => 'elgg-button elgg-button-special',
		'href' => '#profile-menu-admin',
		'text' => elgg_echo('admin:options'),
		'rel' => 'toggle' 
	));
	$admin_links .= '</li></ul>';
	$admin_links .= '<ul class="elgg-menu hidden" id="profile-menu-admin">';
	foreach ($admin as $menu_item) {
		$admin_links .= '<li>' . $menu_item->getContent(array('class' => 'elgg-button')) . '</li>';
	}
	$admin_links .= '</ul>';	
}

// content links
// $content_menu = elgg_view_menu('owner_block', array(
// 	'entity' => elgg_get_page_owner_entity(),
// 	'class' => 'profile-content-menu',
// ));

echo <<<HTML

<div id="profile-owner-block">
	$icon
	$profile_actions
	$admin_links
</div>

HTML;
