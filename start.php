<?php
/**
 * Haarlem theme plugin
 */

require_once(dirname(__FILE__) . "/lib/functions.php");
require_once(dirname(__FILE__) . "/lib/events.php");
require_once(dirname(__FILE__) . "/lib/hooks.php");
require_once(dirname(__FILE__) . "/lib/page_handlers.php");

define('THEME_GREEN', 'ABC340');
define('THEME_TEAL', '32998E');
define('THEME_BLUE', '00ADEF');
define('THEME_PURPLE', '6C447E');
define('THEME_RED', 'EE1124');

elgg_register_event_handler('init','system','theme_haarlem_intranet_init');

/**
 * Called during system init
 *
 * @return void
 */
function theme_haarlem_intranet_init() {

	// theme specific CSS
	elgg_register_css("sourcesanspro", "//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700");
	elgg_load_css("sourcesanspro");

	elgg_register_css("slickmap", elgg_get_site_url() . 'mod/theme_haarlem_intranet/vendors/slickmap/slickmap.css');
	elgg_load_css("slickmap");
	
	elgg_register_js('tinymce', 'mod/theme_haarlem_intranet/vendors/tinymce/js/tinymce/tinymce.min.js');
	
	elgg_register_js('placeholders', elgg_get_site_url() . 'mod/theme_haarlem_intranet/vendors/placeholders/placeholders.jquery.min.js', 'footer');
	elgg_load_js('placeholders');
	
	
	elgg_extend_view('css/elgg', 'css/theme_haarlem_intranet/site');
	elgg_extend_view('css/elgg', 'css/theme_haarlem_intranet/responsive');
	
	elgg_extend_view('js/elgg', 'js/bfa_plugin');
	elgg_extend_view('js/elgg', 'js/theme_haarlem_intranet/site');
	elgg_extend_view('page/elements/foot', 'js/theme_haarlem_intranet/accordion');

	elgg_extend_view('page/layouts/widgets', 'theme_haarlem_intranet/widgets_fix');
	
	// unextend views
	elgg_unextend_view('page/elements/header', 'search/header');
	elgg_extend_view('page/elements/header', 'search/header');
	
	elgg_unextend_view("page/elements/owner_block/extend", "group_tools/owner_block");
	elgg_unextend_view("groups/sidebar/members", "group_tools/group_admins");
	
	// events
	elgg_register_event_handler('pagesetup', 'system', 'theme_haarlem_intranet_pagesetup', 600);
	elgg_register_event_handler('create', 'member_of_site', 'theme_haarlem_intranet_site_join_event');
	elgg_register_event_handler('delete', 'member_of_site', 'theme_haarlem_intranet_site_leave_event');
	elgg_register_event_handler('update_user', 'profile_sync', 'theme_haarlem_intranet_profile_sync_update_user');
	
	// plugin hooks
	elgg_register_plugin_hook_handler("register", "menu:personal", "theme_haarlem_intranet_personal_menu");
	elgg_register_plugin_hook_handler("register", "menu:entity", "theme_haarlem_intranet_entity_menu_icons");
	elgg_register_plugin_hook_handler("register", "menu:entity", "theme_haarlem_intranet_thewire_entity_menu");
	elgg_register_plugin_hook_handler("register", "menu:user_hover", "theme_haarlem_intranet_user_hover_menu");
	elgg_register_plugin_hook_handler("register", "menu:quick_nav", "theme_haarlem_intranet_quick_nav_menu");
	elgg_register_plugin_hook_handler("register", "menu:file_tools_folder_sidebar_tree", "theme_haarlem_intranet_folder_tree_menu");
	
	elgg_register_plugin_hook_handler("prepare", "menu:page", "theme_haarlem_intranet_prepare_page_menu_static");
	elgg_register_plugin_hook_handler("prepare", "menu:page", "theme_haarlem_intranet_prepare_menu_icons");
	elgg_register_plugin_hook_handler("prepare", "menu:owner_block", "theme_haarlem_intranet_prepare_menu_icons");
	elgg_register_plugin_hook_handler("prepare", "menu:site", "theme_haarlem_intranet_prepare_site_menu", 99999);
	
	elgg_register_plugin_hook_handler('route', 'all', 'theme_haarlem_intranet_route_static_handler');
	elgg_register_plugin_hook_handler('route', 'settings', 'theme_haarlem_intranet_route_settings_handler');
	elgg_register_plugin_hook_handler('route', 'avatar', 'theme_haarlem_intranet_route_avatar_handler');
	
	elgg_unregister_plugin_hook_handler("route", "file", "file_tools_file_route_hook");
	elgg_register_plugin_hook_handler("route", "file", "theme_haarlem_intranet_file_route_handler");
	elgg_register_plugin_hook_handler("route", "file", "file_tools_file_route_hook");
	
	elgg_register_plugin_hook_handler("route", "groups", "theme_haarlem_intranet_groups_route_handler");
	
	elgg_register_plugin_hook_handler("route", "livesearch", "theme_haarlem_intranet_livesearch_route_handler");
	
	elgg_register_plugin_hook_handler('config', 'htmlawed', 'theme_haarlem_intranet_htmlawed_config');
	
	elgg_register_plugin_hook_handler("register", "menu:page", "theme_haarlem_intranet_cleanup_menu");
	elgg_register_plugin_hook_handler('register', 'menu:longtext', 'theme_haarlem_intranet_cleanup_menu');
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'theme_haarlem_intranet_cleanup_menu');

	elgg_unregister_plugin_hook_handler("search_multisite", "search", "subsite_manager_search_multisite_search_hook");
	
	elgg_register_plugin_hook_handler('entity:icon:url', 'user', 'theme_haarlem_intranet_profile_icon', 2000); // high prio to overrule subsite_manager
	
	// page handlers
	elgg_register_page_handler('profile', 'theme_haarlem_intranet_profile_page_handler');
	elgg_register_page_handler('dashboard', 'theme_haarlem_intranet_dashboard_page_handler');
	elgg_register_page_handler('haarlem_avatar', 'theme_haarlem_intranet_avatar_page_handler');
	
	// quick nav
	elgg_register_ajax_view('theme_haarlem_intranet/forms/quick_nav');
	
	$js = elgg_get_simplecache_url('js', 'theme_haarlem_intranet/quick_nav');
	elgg_register_js('theme_haarlem_intranet_quick_nav', $js);
	
	elgg_register_widget_type('quick_nav', elgg_echo('theme_haarlem_intranet:quick_nav:widget:title'), elgg_echo('theme_haarlem_intranet:quick_nav:widget:description'), 'index', true);
	
	elgg_register_action('theme_haarlem_intranet/quick_nav', dirname(__FILE__) . '/actions/quick_nav.php');
	elgg_register_action('theme_haarlem_intranet/admin/reset_mentions', dirname(__FILE__) . '/actions/admin/reset_mentions.php', 'admin');
	
	// izine
	elgg_register_widget_type('izine', elgg_echo('theme_haarlem_intranet:izine:widget:title'), elgg_echo('theme_haarlem_intranet:izine:widget:description'), 'index', true);
	elgg_register_widget_type('haarlem_news', elgg_echo('theme_haarlem_intranet:haarlem_news:widget:title'), elgg_echo('theme_haarlem_intranet:haarlem_news:widget:description'), 'index', true);
	
	// increase master icon sizes
	$icon_sizes = elgg_get_config('icon_sizes');
	$icon_sizes['master']['h'] = 1024;
	$icon_sizes['master']['w'] = 1024;
	elgg_set_config('icon_sizes', $icon_sizes);
	
	// don't allow main profile fields to be edited
	$current_url = current_page_url();
	$user = elgg_get_logged_in_user_entity();
	if ((stristr($current_url, 'action/profile/edit') !== false) || (!empty($user) && (stristr($current_url, "profile/{$user->username}/edit") !== false))) {
		elgg_unregister_plugin_hook_handler('profile:fields', 'profile', 'subsite_manager_profile_fields_hook');
		elgg_unregister_plugin_hook_handler('categorized_profile_fields', 'profile_manager', 'subsite_manager_profile_manager_profile_hook');
	}
}

/**
 * Called during pagesetup
 *
 * @return void
 */
function theme_haarlem_intranet_pagesetup() {
	
	// unextend views
	elgg_unextend_view("groups/sidebar/members", "group_tools/group_admins");
	
}
