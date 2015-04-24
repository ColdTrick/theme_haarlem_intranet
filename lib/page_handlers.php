<?php

/**
 * The profile page handler
 *
 * @param array $page page elements
 *
 * @return bool
 */
function theme_haarlem_intranet_profile_page_handler($page) {
	$user = false;
	if (isset($page[0])) {
		$username = $page[0];
		$user = get_user_by_username($username);

		if (!empty($user)) {
			elgg_set_page_owner_guid($user->getGUID());
		}
	}

	if (empty($user) && elgg_is_logged_in()) {
		forward(elgg_get_logged_in_user_entity()->getURL());
	}

	// short circuit if invalid or banned username
	if (empty($user) || ($user->isBanned() && !elgg_is_admin_logged_in())) {
		register_error(elgg_echo("profile:notfound"));
		forward();
	}

	$action = false;
	if (isset($page[1])) {
		$action = $page[1];
	}

	if ($action == "edit") {
		// use the core profile edit page
		$base_dir = elgg_get_root_path();
		require $base_dir . "pages/profile/edit.php";
		return true;
	}

	$menu = elgg_trigger_plugin_hook('register', "menu:user_hover", array('entity' => $user), array());
	$builder = new ElggMenuBuilder($menu);
	$menu = $builder->getMenu();
	
	$content = '<table><tr><td>' . elgg_view("profile/owner_block", array("entity" => $user, 'menu' => $menu));
	$content .= '</td><td>' . elgg_view("profile/details", array("entity" => $user, 'menu' => $menu)) . '</td></tr></table>';
	
	$sidebar = elgg_view('theme_haarlem_intranet/profile/group_membership', array('entity' => $user));
	
	// view profile
	$body = elgg_view_layout("one_sidebar", array(
		"content" => $content,
		'menu' => $menu,
		'layout' => 'content',
		'sidebar' => $sidebar
	));
	echo elgg_view_page($user->name, $body);

	return true;
}

/**
 * The dashboard page handler
 *
 * @param array $page page elements
 *
 * @return bool
 */
function theme_haarlem_intranet_dashboard_page_handler($page) {
	
	include(dirname(dirname(__FILE__)) . '/pages/dashboard/index.php');
	return true;
}