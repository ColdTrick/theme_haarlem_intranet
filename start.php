<?php
/**
 * Haarlem theme plugin
 */

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
	
	elgg_register_js('tinymce', 'mod/theme_haarlem_intranet/vendors/tinymce/js/tinymce/tinymce.min.js');
	
	elgg_extend_view('css/elgg', 'css/theme_haarlem_intranet/site');
	elgg_extend_view('css/elgg', 'css/theme_haarlem_intranet/responsive');
	
	elgg_extend_view('js/elgg', 'js/bfa_plugin');
	elgg_extend_view('page/elements/foot', 'js/theme_haarlem_intranet/accordion');

	elgg_extend_view('page/layouts/widgets', 'theme_haarlem_intranet/widgets_fix');
	
	// unextend views
	elgg_unextend_view('page/elements/header', 'search/header');
	elgg_extend_view('page/elements/header', 'search/header');
	
	elgg_unextend_view("page/elements/owner_block/extend", "group_tools/owner_block");
	elgg_unextend_view("groups/sidebar/members", "group_tools/group_admins", 400);
	
	// events
	elgg_register_event_handler('pagesetup', 'system', 'theme_haarlem_intranet_pagesetup', 600);
	
	// plugin hooks
	elgg_register_plugin_hook_handler("register", "menu:personal", "theme_haarlem_intranet_personal_menu");
	elgg_register_plugin_hook_handler("register", "menu:entity", "theme_haarlem_intranet_thewire_entity_menu");
	elgg_register_plugin_hook_handler("register", "menu:user_hover", "theme_haarlem_intranet_user_hover_menu");
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
	
	elgg_register_plugin_hook_handler('config', 'htmlawed', 'theme_haarlem_intranet_htmlawed_config');
	
	elgg_register_plugin_hook_handler("register", "menu:page", "theme_haarlem_intranet_cleanup_menu");
	elgg_register_plugin_hook_handler('register', 'menu:longtext', 'theme_haarlem_intranet_cleanup_menu');
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'theme_haarlem_intranet_cleanup_menu');

// 	elgg_unregister_plugin_hook_handler('prepare', 'menu:site', 'elgg_site_menu_setup');
	
	// page handlers
	elgg_register_page_handler('profile', 'theme_haarlem_intranet_profile_page_handler');
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
