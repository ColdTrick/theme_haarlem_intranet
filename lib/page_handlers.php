<?php

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

	// view profile
	$body = elgg_view_layout("one_column", array(
		"content" => elgg_view("profile/wrapper", array("entity" => $user))
	));
	echo elgg_view_page($user->name, $body);

	return true;
}