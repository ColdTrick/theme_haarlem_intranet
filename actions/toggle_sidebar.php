<?php

$user = elgg_get_logged_in_user_entity();

if (empty($user)) {
	return;
}

if (theme_haarlem_intranet_sidebar_collapsed()) {
	elgg_unset_plugin_user_setting('sidebar_collapsed', $user->guid, 'theme_haarlem_intranet');
} else {
	elgg_set_plugin_user_setting('sidebar_collapsed', true, $user->guid, 'theme_haarlem_intranet');
}