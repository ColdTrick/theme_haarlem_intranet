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
		2 => 'knowledge',
		3 => 'personnel',
		4 => 'groups',
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
			'href' => "#",
			'section' => 'personal',
			'is_trusted' => true,
			'priority' => 150
		));
		
		// add my groups
		$dbprefix = elgg_get_config('dbprefix');
		$group_options = array(
			'type' => 'group',
			'limit' => false,
			'relationship' => 'member',
			'relationship_guid' => $user->getGUID(),
			'joins' => array("JOIN {$dbprefix}groups_entity ge ON e.guid = ge.guid"),
			'order_by' => 'ge.name ASC'
		);
		$groups = new ElggBatch('elgg_get_entities_from_relationship', $group_options);
		$groups_found = false;
		foreach ($groups as $index => $group) {
			$groups_found = true;
			
			$return_value[] = ElggMenuItem::factory(array(
				'name' => "group_{$group->getGUID()}",
				'text' => $group->name,
				'href' => $group->getURL(),
				'section' => 'personal',
				'is_trusted' => true,
				'priority' => $index,
				'parent_name' => 'groups_member_of'
			));
		}
		
		if ($groups_found) {
			$return_value[] = ElggMenuItem::factory(array(
				'name' => 'groups_member_of',
				'text' => false,
				'href' => false,
				'section' => 'personal',
				'is_trusted' => true,
				'priority' => 8888888,
				'parent_name' => 'groups'
			));
		}
		
		$return_value[] = ElggMenuItem::factory(array(
			'name' => 'my_groups',
			'text' => elgg_echo('groups:yours'),
			'href' => "groups/member/{$user->username}",
			'section' => 'personal',
			'is_trusted' => true,
			'priority' => 9999999,
			'parent_name' => 'groups'
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
		'haarlem_tangram' => 'eye',
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
	
	// replace reply text with icon
	foreach ($return_value as $menu_item) {
		if ($menu_item->getName() !== 'reply') {
			continue;
		}
		
		$menu_item->setTooltip($menu_item->getText());
		$menu_item->setText(elgg_view_icon('reply'));
	}
	
	// add time stamp
	$return_value[] = ElggMenuItem::factory(array(
		'name' => 'friendlytime',
		'text' => elgg_view_friendly_time($entity->time_created),
		'href' => false,
		'priority' => 1
	));
	
	// add likes in widgets (likes doesn't do this)
	if (elgg_in_context('widgets')) {
		// likes button
		$options = array(
			'name' => 'likes',
			'text' => elgg_view('likes/button', array('entity' => $entity)),
			'href' => false,
			'priority' => 1000,
		);
		$return_value[] = ElggMenuItem::factory($options);
		
		// likes count
		$count = elgg_view('likes/count', array('entity' => $entity));
		if ($count) {
			$options = array(
				'name' => 'likes_count',
				'text' => $count,
				'href' => false,
				'priority' => 1001,
			);
			$return_value[] = ElggMenuItem::factory($options);
		}
		
		// tell a friend
		if (elgg_is_active_plugin('tell_a_friend')) {
			elgg_load_js("lightbox");
			elgg_load_css("lightbox");
			elgg_load_js('elgg.userpicker');
			elgg_load_js('jquery.ui.autocomplete.html');
			
			$return_value[] = ElggMenuItem::factory(array(
				"name" => "tell_a_friend",
				"text" => elgg_view_icon("share"),
				"title" => elgg_echo('tell_a_friend:share_title'),
				"href" => "tell_a_friend/share/" . $entity->getGUID(),
				"link_class" => "elgg-lightbox",
				"priority" => 200
			));
		}
	}
	
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
 * Route pages
 *
 * @param string $hook         the name of the hook
 * @param string $type         the type of the hook
 * @param array  $return_value current return value
 * @param array  $params       supplied params
 *
 * @return array|false
 */
function theme_haarlem_intranet_pages_route_handler($hook, $type, $return_value, $params) {
	
	if (empty($return_value) || !is_array($return_value)) {
		return $return_value;
	}
	
	$page = elgg_extract('segments', $return_value);
	switch ($page[0]) {
		case 'group':
		case 'owner':
			$return_value = false;
			
			elgg_push_breadcrumb(elgg_echo('pages'), 'pages/all');
			
			elgg_load_library('elgg:pages');
						
			include(dirname(dirname(__FILE__)) . "/pages/pages/owner.php");
			break;
		case 'view':
			$return_value = false;
			
			elgg_push_breadcrumb(elgg_echo('pages'), 'pages/all');
			
			elgg_load_library('elgg:pages');
			set_input('guid', (int) elgg_extract(1, $page));
			
			include(dirname(dirname(__FILE__)) . "/pages/pages/view.php");
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
 * Add menu items to owner_block menu
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param mixed          $params       supplied params
 *
 * @return ElggMenuItem[]
 */
function theme_haarlem_intranet_quick_nav_menu($hook, $type, $return_value, $params) {
	
	if (empty($params) || !is_array($params)) {
		return $return_value;
	}
	
	$entity = elgg_extract('entity', $params);
	if (empty($entity) || (!elgg_instanceof($entity, 'group') && !elgg_instanceof($entity, 'object', 'widget'))) {
		return $return_value;
	}
	
	$nav = theme_haarlem_intranet_get_quick_nav($entity->getGUID());
	if (!empty($nav)) {
		// show items
		foreach ($nav as $index => $config) {
			$icon = '';
			if (!empty($config['icon'])) {
				$icon = elgg_view_icon($config['icon']);
			}
			
			$return_value[] = ElggMenuItem::factory(array(
				'name' => "quick_nav_{$index}",
				'text' => $icon . $config['text'],
				'href' => $config['href'],
				'target' => elgg_extract('target', $config),
				'section' => 'quick_nav',
				'priority' => $index
			));
		}
	}
	
	// show add button
	if ($entity->canEdit()) {
		elgg_load_js('lightbox');
		elgg_load_css('lightbox');
		
		elgg_load_js('theme_haarlem_intranet_quick_nav');
		
		$return_value[] = ElggMenuItem::factory(array(
			'name' => 'quick_nav_edit',
			'text' => elgg_view_icon('plus') . elgg_echo('theme_haarlem_intranet:quick_nav:edit'),
			'href' => "ajax/view/theme_haarlem_intranet/forms/quick_nav?entity_guid={$entity->getGUID()}",
			'link_class' => 'elgg-lightbox',
			'section' => 'quick_nav',
			'priority' => 9999999
		));
	}
	
	return $return_value;
}

/**
 * Change some menu items to icons
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param mixed          $params       supplied params
 *
 * @return ElggMenuItem[]
 */
function theme_haarlem_intranet_entity_menu_icons($hook, $type, $return_value, $params) {
	
	if (empty($return_value) || !is_array($return_value)) {
		return $return_value;
	}
	
	if (empty($params) || !is_array($params)) {
		return $return_value;
	}
	
	$entity = elgg_extract('entity', $params);
	if (empty($entity) || !elgg_instanceof($entity)) {
		return $return_value;
	}
	
	$site = elgg_get_site_entity();
	$container = $entity->getContainerEntity();
	
	foreach ($return_value as $menu_item) {
		
		switch ($menu_item->getName()) {
			case 'edit':
				if (!$menu_item->getTooltip()) {
					$menu_item->setTooltip($menu_item->getText());
				}
				
				$menu_item->setPriority(1);
				$menu_item->setText(elgg_view_icon('pencil'));
				break;
			case 'access':
				$access_id_string = get_readable_access_level($entity->access_id);
				$access_id_string = htmlspecialchars($access_id_string, ENT_QUOTES, 'UTF-8', false);
				
				$menu_item->setTooltip($access_id_string);
				$menu_item->setHref('#');
				
				switch ($entity->access_id) {
					case ACCESS_PRIVATE:
						$menu_item->setText(elgg_view_icon('minus-circle'));
						break;
					case ACCESS_LOGGED_IN:
						$menu_item->setText(elgg_view_icon('circle-o-notch'));
						break;
					default:
						
						if (($site instanceof Subsite) && ($entity->access_id == $site->getACL())) {
							// subsite
							$menu_item->setText(elgg_view_icon('circle-o'));
						}
						
						if (($container instanceof ElggGroup) && ($entity->access_id == $container->group_acl)) {
							// group
							$menu_item->setText(elgg_view_icon('dot-circle-o'));
						}
						break;
				}
				break;
			case 'history':
				
				$menu_item->setTooltip($menu_item->getText());
				$menu_item->setText(elgg_view_icon('clock-o'));
				
				break;
		}
	}
}

/**
 * Listen to /livesearc for special mentions search
 *
 * @param string $hook         the name of the hook
 * @param string $type         the type of the hook
 * @param array  $return_value current return value
 * @param array  $params       supplied params
 *
 * @return array
 */
function theme_haarlem_intranet_livesearch_route_handler($hook, $type, $return_value, $params) {
	
	$query = get_input('q', get_input('term'));
	if (empty($query)) {
		return $return_value;
	}
	
	$match_on = get_input('match_on');
	if (empty($match_on)) {
		return $return_value;
	}
	
	if (is_array($match_on) && count($match_on) > 1) {
		return $return_value;
	}
	
	if (is_array($match_on)) {
		$match_on = $match_on[0];
	}
	
	$overrule_cases = array(
		'mentions',
		'member_of_site'
	);
	
	if (!in_array($match_on, $overrule_cases)) {
		return $return_value;
	}
	
	// backup search advanced mulitsite search setting
	$mulitsite = elgg_extract('search_advanced:multisite', $_SESSION);
	$_SESSION['search_advanced:multisite'] = false;
	
	$params = array(
		'type' => 'user',
		'limit' => 10,
		'query' => sanitise_string($query)
	);
	
	$users = trigger_plugin_hook('search', 'user', $params, array());
	if (empty($users) || !is_array($users)) {
		header("Content-Type: application/json");
		echo json_encode(array());
		return false;
	}
	
	$count = elgg_extract('count', $users);
	if (empty($count)) {
		header("Content-Type: application/json");
		echo json_encode(array());
		return false;
	}
	
	$users = elgg_extract('entities', $users);
	$results = array();
	foreach ($users as $user) {
		$output = elgg_view_list_item($user, array(
			'use_hover' => false,
			'class' => 'elgg-autocomplete-item',
		));
		
		$icon = elgg_view_entity_icon($user, 'tiny', array(
			'use_hover' => false,
		));
		
		$result = array(
			'type' => 'user',
			'name' => $user->name,
			'desc' => $user->username,
			'guid' => $user->guid,
			'label' => $output,
			'value' => $user->username,
			'icon' => $icon,
			'url' => $user->getURL(),
		);
		$results[$user->name . rand(1, 100)] = $result;
	}
	
	ksort($results);
	header("Content-Type: application/json");
	echo json_encode(array_values($results));
	
	// reset search advanced mulitsite search setting
	$_SESSION['search_advanced:multisite'] = $mulitsite;
	
	return false;
}

/**
 * Custom icon only on this site
 *
 * @param string $hook         the name of the hook
 * @param string $type         the type of the hook
 * @param string $return_value current return value
 * @param array  $params       supplied params
 *
 * @return string
 */
function theme_haarlem_intranet_profile_icon($hook, $type, $return_value, $params) {
	
	if (!elgg_is_logged_in()) {
		return;
	}
	
	if (empty($params) || !is_array($params)) {
		return;
	}
	
	$user = elgg_extract('entity', $params);
	if (empty($user) || !($user instanceof ElggUser)) {
		return;
	}
	
	if (!$user->haarlem_icontime) {
		return;
	}
	
	$size = elgg_extract('size', $params);
	$icon_sizes = elgg_get_config('icon_sizes');
	if (!isset($icon_sizes[$size])) {
		return;
	}
	
	$fh = new ElggFile();
	$fh->owner_guid = $user->getGUID();
	
	$fh->setFilename("haarlem_icon/{$size}.jpg");
	if (!$fh->exists()) {
		return;
	}
	
	return "haarlem_avatar/{$user->getGUID()}/{$size}/{$user->haarlem_icontime}.jpg";
}

/**
 * Change file/folder structure menu
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param mixed          $params       supplied params
 *
 * @return ElggMenuItem[]
 */
function theme_haarlem_intranet_folder_tree_menu($hook, $type, $return_value, $params) {
	
	if (empty($return_value) || !is_array($return_value)) {
		return;
	}
	
	foreach ($return_value as $menu_item) {
		if ($menu_item->getName() !== 'root') {
			continue;
		}
		
		$menu_item->setText(elgg_echo('file'));
		break;
	}
	
	return $return_value;
}

/**
 * Listen to the logout action to disable SimpleSAML SSO force authentication
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param mixed          $params       supplied params
 *
 * @return void
 */
function theme_haarlem_intranet_logout_action_hook($hook, $type, $return_value, $params) {
	
	elgg_register_plugin_hook_handler("forward", "system", "theme_haarlem_intranet_logout_forward_hook");
}

/**
 * Make sure logout has disabled SimpleSAML SSO force authentication
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param mixed          $params       supplied params
 *
 * @return void
 */
function theme_haarlem_intranet_logout_forward_hook($hook, $type, $return_value, $params) {
	
	$_SESSION["simpleaml_disable_sso"] = true;
}
