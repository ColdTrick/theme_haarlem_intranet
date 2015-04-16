<?php

/**
 * Hooks for Theme Haarlem
 */

/**
 * Add menu items to the site menu
 *
 * @param string         $hook         'register'
 * @param string         $type         'menu:site'
 * @param ElggMenuItem[] $return_value the menu items
 * @param array          $params       supplied params
 *
 * @return ElggMenuItem[]
 */
function theme_haarlem_intranet_site_menu($hook, $type, $return_value, $params) {
	
	$user = elgg_get_logged_in_user_entity();
	
	if (!empty($user)) {
		$return_value[] = ElggMenuItem::factory(array(
			'name' => 'dashboard',
			'text' => elgg_echo('theme_haarlem_intranet:menu:site:dashboard'),
			'href' => 'dashboard',
			'section' => 'personal',
			'is_trusted' => true,
			'priority' => 100
		));

		if (elgg_is_admin_logged_in()) {
			$return_value[] = ElggMenuItem::factory(array(
				'name' => 'admin',
				'text' => elgg_view_icon('wrench'),
				'title' => elgg_echo('content_redirector:selector:admin'),
				'href' => 'admin',
				'section' => 'personal',
				'is_trusted' => true,
				'priority' => 100
			));
		}
		
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
			$invite_count = 4;
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
			'href' => $user->getURL(),
			'section' => 'personal',
			'is_trusted' => true,
			'priority' => 300
		));
	}
	
	
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
function theme_haarlem_route_static_handler($hook, $type, $return_value, $params) {
	
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
	
	foreach ($return_value as $section => $menu_items) {
		if ($section !== 'static') {
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
