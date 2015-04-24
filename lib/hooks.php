<?php

/**
 * Hooks for Theme Haarlem
 */

/**
 * Add menu items to the (theme)site menu
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param array          $params       supplied params
 *
 * @return ElggMenuItem[]
 */
function theme_haarlem_intranet_prepare_site_menu($hook, $type, $return_value, $params) {
	if (elgg_in_context("menu_builder")) {
		return $return_value;
	}
	
	$user = elgg_get_logged_in_user_entity();
	
	$items = elgg_extract('default', $return_value);
	if (empty($items)) {
		return $return_value;
	}
	
	$names = array(
		0 => 'home',
		1 => 'organisation',
		2 => 'groups',
		3 => 'knowledge',
		4 => 'personnel',
		5 => 'extranet',
	);
	
	$i = 0;
	foreach ($items as $item) {
		if (!array_key_exists($i, $names)) {
			break;
		}
		$item->setName($names[$i]);
		$i++;
	}
}

/**
 * Add menu items to the (theme)personal menu
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param array          $params       supplied params
 *
 * @return ElggMenuItem[]
 */
function theme_haarlem_intranet_personal_menu($hook, $type, $return_value, $params) {
	
	$user = elgg_get_logged_in_user_entity();
	
	if (empty($user)) {
		return $return_value;
	}
		
	$return_value[] = ElggMenuItem::factory(array(
		'name' => 'dashboard',
		'text' => elgg_echo('theme_haarlem_intranet:menu:site:dashboard'),
		'href' => 'dashboard',
		'section' => 'personal',
		'is_trusted' => true,
		'priority' => 100
	));

	if (elgg_is_active_plugin('content_redirector')) {
		$return_value[] = ElggMenuItem::factory(array(
			'name' => 'content_redirector',
			'text' => elgg_view_icon('plus'),
			'title' => elgg_echo('content_redirector:selector:add'),
			'href' => 'add',
			'section' => 'personal',
			'is_trusted' => true,
			'priority' => 150
		));
	}
	
	if (elgg_is_active_plugin('groups')) {
		$invited_groups = groups_get_invited_groups($user->getGUID(), true);
		$invite_count = count($invited_groups);

		$postfix = '';
		if ($invite_count) {
			$postfix = "<span class='theme-haarlem-intranet-counter'>{$invite_count}</span>";
		}
		
		$return_value[] = ElggMenuItem::factory(array(
			'name' => 'groups',
			'text' => elgg_view_icon('group') . $postfix,
			'title' => elgg_echo('groups:yours'),
			'href' => "groups/member/{$user->username}",
			'section' => 'personal',
			'is_trusted' => true,
			'priority' => 150
		));
	}
	
	if (elgg_is_active_plugin('messages')) {
		$message_count = messages_count_unread();
			
		$postfix = '';
		if ($message_count) {
			$postfix = "<span class='theme-haarlem-intranet-counter'>{$message_count}</span>";
		}
			
		$return_value[] = ElggMenuItem::factory(array(
			'name' => 'messages',
			'text' => elgg_view_icon('envelope') . $postfix,
			'title' => elgg_echo('messages'),
			'href' => "messages/inbox/{$user->username}",
			'section' => 'personal',
			'is_trusted' => true,
			'priority' => 200
		));
	}
	
	if (elgg_is_active_plugin('quicklinks')) {
		$return_value[] = ElggMenuItem::factory(array(
			'name' => 'quicklinks',
			'text' => elgg_view('page/elements/topbar/quicklinks'),
			'href' => false,
			'section' => 'personal',
			'is_trusted' => true,
			'priority' => 250
		));
	}
	
	$return_value[] = ElggMenuItem::factory(array(
		'name' => 'profile',
		'text' => elgg_view('output/img', array('src' => $user->getIconURL('tiny'))),
		'title' => $user->name,
		'href' => '#',
		'section' => 'personal',
		'is_trusted' => true,
		'priority' => 300
	));
	
	$return_value[] = ElggMenuItem::factory(array(
		'name' => 'profile_mine',
		'text' => elgg_echo('theme_haarlem_intranet:menu:site:profile:mine'),
		'href' => $user->getURL(),
		'section' => 'personal',
		'parent_name' => 'profile',
		'is_trusted' => true,
		'priority' => 100
	));
	$return_value[] = ElggMenuItem::factory(array(
		'name' => 'profile_settings',
		'text' => elgg_echo('theme_haarlem_intranet:menu:site:profile:settings'),
		'href' => "settings/user/{$user->username}",
		'section' => 'personal',
		'parent_name' => 'profile',
		'is_trusted' => true,
		'priority' => 200
	));
	$return_value[] = ElggMenuItem::factory(array(
		'name' => 'profile_logout',
		'text' => elgg_echo('logout'),
		'href' => 'action/logout',
		'section' => 'personal',
		'parent_name' => 'profile',
		'is_trusted' => true,
		'is_action' => true,
		'priority' => 300
	));
	
	return $return_value;
}

/**
 * Handle static pages
 *
 * @param string $hook         the name of the hook
 * @param string $type         the type of the hook
 * @param array  $return_value current return value
 * @param mixed  $params       supplied params
 */
function theme_haarlem_intranet_route_static_handler($hook, $type, $return_value, $params) {
	
	if (empty($return_value) || !is_array($return_value)) {
		return $return_value;
	}
	
	$handler = elgg_extract('handler', $return_value);
	if ($handler !== 'static') {
		return $return_value;
	}
	
	$segments = elgg_extract('segments', $return_value);
	if (empty($segments) || !is_array($segments)) {
		return $return_value;
	}
	
	switch ($segments[0]) {
		case 'view':
			set_input('guid', $segments[1]);
				
			elgg_push_context('static');
			include(dirname(dirname(__FILE__)) . '/pages/static/view.php');
			elgg_pop_context();
			
			$return_value = false;
			break;
	}
	
	return $return_value;
}

/**
 * Remove static menu items
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param mixed          $params       supplied params
 *
 * @return ElggMenuItem[]
 */
function theme_haarlem_intranet_prepare_page_menu_static($hook, $type, $return_value, $params) {
	
	if (elgg_in_context('theme_haarlem_intranet_static_sidebar')) {
		return $return_value;
	}
	
	if (empty($return_value) || !is_array($return_value)) {
		return $return_value;
	}
	
	$remove_sections = array(
		'static_admin',
		'static'
	);
	foreach ($return_value as $section => $menu_items) {
		if (!in_array($section, $remove_sections)) {
			continue;
		}
		
		unset($return_value[$section]);
	}
	
	return $return_value;
}

/**
 * Add icons to some menu items
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param mixed          $params       supplied params
 *
 * @return ElggMenuItem[]
 */
function theme_haarlem_intranet_prepare_menu_icons($hook, $type, $return_value, $params) {
	
	if (empty($return_value) || !is_array($return_value)) {
		return $return_value;
	}
	
	$icons = array(
		'file' => 'folder',
		'blog' => 'pencil-square-o',
		'bookmarks' => 'globe',
		'videolist' => 'film',
		'photos' => 'camera',
		'polls' => 'question-circle',
		'tasks' => 'check-square',
		'todos' => 'check-square',
		'discussion' => 'comments',
		'events' => 'calendar-o',
		'thewire' => 'bullhorn',
		'related_groups' => 'group',
		'activity' => 'list',
		'pages' => 'book',
		'static' => 'file-text-o',
		'messages:inbox' => 'inbox',
		'messages:sentmessages' => 'upload',
		'search' => 'search',
	);
	
	foreach ($return_value as $section => $menu_items) {
		
		if (empty($menu_items) || !is_array($menu_items)) {
			continue;
		}
		
		foreach ($menu_items as $index => $menu_item) {
			$menu_name = $menu_item->getName();
			if (isset($icons[$menu_name])) {
				$prefix = elgg_view_icon($icons[$menu_name]);
				$menu_item->setText($prefix . $menu_item->getText());
			}
		}
	}
	
	return $return_value;
}

/**
 * Add menu items to wire posts
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param mixed          $params       supplied params
 *
 * @return ElggMenuItem[]
 */
function theme_haarlem_intranet_thewire_entity_menu($hook, $type, $return_value, $params) {
	
	if (empty($params) || !is_array($params)) {
		return $return_value;
	}
	
	$entity = elgg_extract('entity', $params);
	if (empty($entity) || !elgg_instanceof($entity, 'object', 'thewire')) {
		return $return_value;
	}
	
	$return_value[] = ElggMenuItem::factory(array(
		'name' => 'friendlytime',
		'text' => elgg_view_friendly_time($entity->time_created),
		'href' => false,
		'priority' => 1
	));
	
	return $return_value;
}

/**
 * Change the htmlawed config
 *
 * @param string $hook         the name of the hook
 * @param string $type         the type of the hook
 * @param array  $return_value current return value
 * @param mixed  $params       supplied params
 *
 * @return array
 */
function theme_haarlem_intranet_htmlawed_config($hook, $type, $return_value, $params) {
	
	if (empty($return_value) || !is_array($return_value)) {
		return $return_value;
	}
	
	$deny_attribute = elgg_extract('deny_attribute', $return_value);
	if (empty($deny_attribute)) {
		return $return_value;
	}
	
	$deny_attributes = explode(',', trim($deny_attribute));
	$allowed = array('class');
	foreach ($deny_attributes as $index => $attr) {
		if (!in_array($attr, $allowed)) {
			continue;
		}
		
		unset($deny_attributes[$index]);
	}
	
	$return_value['deny_attribute'] = implode(',', $deny_attributes);
	return $return_value;
}

/**
 * Change page menu
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param mixed          $params       supplied params
 *
 * @return ElggMenuItem[]
 */
function theme_haarlem_intranet_cleanup_menu($hook, $type, $return_value, $params) {
	
	if (empty($return_value) || !is_array($return_value)) {
		return $return_value;
	}
	
	$remove_items = array(
		'1_account',
		'tinymce_toggler',
		'avatar:edit',
		'edit_avatar'
	);
	foreach ($return_value as $index => $menu_item) {
		if (!in_array($menu_item->getName(), $remove_items)) {
			continue;
		}
		
		unset($return_value[$index]);
	}
	
	return $return_value;
}

/**
 * Route users away from /settings/user
 *
 * @param string $hook         the name of the hook
 * @param string $type         the type of the hook
 * @param array  $return_value current return value
 * @param array  $params       supplied params
 *
 * @return array
 */
function theme_haarlem_intranet_route_settings_handler($hook, $type, $return_value, $params) {
	
	if (empty($return_value) || !is_array($return_value)) {
		return $return_value;
	}
	
	$page = elgg_extract('segments', $return_value);
	switch ($page[0]) {
		case 'user':
			$username = elgg_extract(1, $page);
			
			forward("notifications/personal/{$username}");
			break;
	}
}

/**
 * Route file
 *
 * @param string $hook         the name of the hook
 * @param string $type         the type of the hook
 * @param array  $return_value current return value
 * @param array  $params       supplied params
 *
 * @return array|false
 */
function theme_haarlem_intranet_file_route_handler($hook, $type, $return_value, $params) {
	
	if (empty($return_value) || !is_array($return_value)) {
		return $return_value;
	}
	
	$page = elgg_extract('segments', $return_value);
	switch ($page[0]) {
		case "owner":
		case "group":
			
			if (elgg_is_active_plugin('file_tools') && file_tools_use_folder_structure()) {
				$return_value = false;
					
				include(dirname(dirname(__FILE__)) . "/pages/file/list.php");
			}
			break;
	}
	
	return $return_value;
}

/**
 * Route groups
 *
 * @param string $hook         the name of the hook
 * @param string $type         the type of the hook
 * @param array  $return_value current return value
 * @param array  $params       supplied params
 *
 * @return array|false
 */
function theme_haarlem_intranet_groups_route_handler($hook, $type, $return_value, $params) {
	
	if (empty($return_value) || !is_array($return_value)) {
		return $return_value;
	}
	
	$page = elgg_extract('segments', $return_value);
	switch ($page[0]) {
		case 'profile':
			$return_value = false;
			
			elgg_load_library('elgg:groups');
			set_input('group_guid', (int) elgg_extract(1, $page));
			
			include(dirname(dirname(__FILE__)) . "/pages/groups/profile.php");
			break;
	}
	
	return $return_value;
}

/**
 * Add menu items to user hover menu
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param mixed          $params       supplied params
 *
 * @return ElggMenuItem[]
 */
function theme_haarlem_intranet_user_hover_menu($hook, $type, $return_value, $params) {
	
	if (empty($params) || !is_array($params)) {
		return $return_value;
	}
	
	$user = elgg_extract('entity', $params);
	if (empty($user) || !elgg_instanceof($user, 'user')) {
		return $return_value;
	}
	
	if ($user->canEdit()) {
		$return_value[] = ElggMenuItem::factory(array(
			'name' => 'profile_settings',
			'text' => elgg_echo('theme_haarlem_intranet:menu:site:profile:settings'),
			'href' => "settings/user/{$user->username}",
			'section' => 'action',
			'is_trusted' => true,
		));
	}
	
	return $return_value;
}

/**
 * Route users away from /avatar/edit
 *
 * @param string $hook         the name of the hook
 * @param string $type         the type of the hook
 * @param array  $return_value current return value
 * @param array  $params       supplied params
 *
 * @return array
 */
function theme_haarlem_intranet_route_avatar_handler($hook, $type, $return_value, $params) {
	
	if (empty($return_value) || !is_array($return_value)) {
		return $return_value;
	}
	
	$page = elgg_extract('segments', $return_value);
	switch ($page[0]) {
		case 'edit':
			$username = elgg_extract(1, $page);
				
			forward("profile/{$username}/edit");
			break;
	}
}

/**
 * Add menu items to kennisbank
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param mixed          $params       supplied params
 *
 * @return ElggMenuItem[]
 */
function theme_haarlem_intranet_kennisbank_menu($hook, $type, $return_value, $params) {
	
	if (empty($params) || !is_array($params)) {
		return $return_value;
	}
	
	$entity = elgg_extract('entity', $params);
	if (empty($entity) || !elgg_instanceof($entity, 'group')) {
		return $return_value;
	}
	
	if ($entity->canEdit()) {
		$return_value[] = ElggMenuItem::factory(array(
			'name' => 'edit',
			'text' => elgg_echo('groups:edit'),
			'href' => "groups/edit/{$entity->getGUID()}",
			'priority' => 100,
			'link_class' => 'elgg-button elgg-button-action'
		));
	}
	
	if (elgg_is_active_plugin('static')) {
		if (static_group_enabled($entity) && $entity->canWriteToContainer(0, 'object', 'static')) {
			$return_value[] = ElggMenuItem::factory(array(
				'name' => 'maange',
				'text' => elgg_echo('static:groups:owner_block'),
				'href' => "static/group/{$entity->getGUID()}",
				'priority' => 200,
				'link_class' => 'elgg-button elgg-button-action'
			));
		}
	}
	
	return $return_value;
}
