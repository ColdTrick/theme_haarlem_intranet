<?php
/**
 * Haarlem theme plugin
 */

require_once(dirname(__FILE__) . "/lib/functions.php");
require_once(dirname(__FILE__) . "/lib/events.php");
require_once(dirname(__FILE__) . "/lib/hooks.php");
require_once(dirname(__FILE__) . "/lib/page_handlers.php");

@include_once(dirname(__FILE__) . '/vendor/autoload.php');

define('THEME_GREEN', 'ABC340');
define('THEME_TEAL', '32998E');
define('THEME_PURPLE', '6C447E');
define('THEME_RED', 'EE1124');
define('THEME_EXTRANET_RED', 'A60F0F');

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
	
	$userpicker_js = elgg_get_simplecache_url('js', 'theme_haarlem_intranet/ui.userpicker');
	elgg_register_js('elgg.userpicker', $userpicker_js);
	
	$grouppicker_js = elgg_get_simplecache_url('js', 'grouppicker.js');
	elgg_register_js('elgg.grouppicker', $grouppicker_js);
	
	elgg_extend_view('css/elgg', 'css/theme_haarlem_intranet/site');
	elgg_extend_view('css/elgg', 'css/theme_haarlem_intranet/responsive');
	elgg_extend_view('css/elgg', 'css/theme_haarlem_intranet/print');
	
	elgg_extend_view('js/elgg', 'js/bfa_plugin');
	elgg_extend_view('js/elgg', 'js/theme_haarlem_intranet/site');
	elgg_extend_view('page/elements/foot', 'js/theme_haarlem_intranet/accordion');

	elgg_extend_view('page/layouts/widgets', 'theme_haarlem_intranet/widgets_fix');

	elgg_extend_view('widgets/free_html/edit', 'theme_haarlem_intranet/longtext_disclaimer');
	elgg_extend_view('widgets/promo_widget/edit', 'theme_haarlem_intranet/longtext_disclaimer');

	elgg_extend_view('event_manager/event/actions', 'theme_haarlem_intranet/event_manager/undo_registration', 400);
	
	elgg_extend_view('river/elements/body', 'theme_haarlem_intranet/river/elements/body', 400);
	
	elgg_extend_view('page/elements/header', 'theme_haarlem_intranet/mobile_forward');

	elgg_extend_view('output/longtext', 'theme_haarlem_intranet/shortcodes', 100);
	
	elgg_extend_view('profile_manager/profile_completeness/content', 'theme_haarlem_intranet/profile/completeness/push', 400);
	elgg_extend_view('profile_manager/profile_completeness/content', 'theme_haarlem_intranet/profile/completeness/pop', 900);
	elgg_register_plugin_hook_handler('categorized_profile_fields', 'profile_manager', 'theme_haarlem_profile_completeness_fields', 99999);
	
	// unextend views
	elgg_unextend_view('page/elements/header', 'search/header');
	if (!theme_haarlem_is_extranet()) {
		define('THEME_BLUE', '00ADEF');
		
		elgg_extend_view('page/elements/header', 'search/header');
	} else {
		define('THEME_BLUE', 'A60F0F');
		elgg_extend_view('css/elgg', 'css/theme_haarlem_intranet/extranet');
	}
	
	elgg_unextend_view("page/elements/owner_block/extend", "group_tools/owner_block");
	elgg_unextend_view("groups/sidebar/members", "group_tools/group_admins");
	
	elgg_set_view_location('plugins/simplesaml/usersettings', 'nonexisting');
	
	// events
	elgg_register_event_handler('pagesetup', 'system', 'theme_haarlem_intranet_pagesetup', 600);
	elgg_register_event_handler('create', 'member_of_site', 'theme_haarlem_intranet_site_join_event');
	elgg_register_event_handler('delete', 'member_of_site', 'theme_haarlem_intranet_site_leave_event');
	elgg_register_event_handler('update_user', 'profile_sync', 'theme_haarlem_intranet_profile_sync_site_membership');
	elgg_register_event_handler('update_user', 'profile_sync', 'theme_haarlem_intranet_profile_sync_zakelijkemail');
	elgg_register_event_handler('update_user', 'profile_sync', 'theme_haarlem_intranet_profile_sync_profile_icon');
	
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
	elgg_register_plugin_hook_handler("prepare", "menu:site", "theme_haarlem_intranet_responsive_toggle_links", 99999);
	
	elgg_register_plugin_hook_handler('route', 'all', 'theme_haarlem_intranet_route_static_handler');
	elgg_register_plugin_hook_handler('route', 'settings', 'theme_haarlem_intranet_route_settings_handler');
	elgg_register_plugin_hook_handler('route', 'avatar', 'theme_haarlem_intranet_route_avatar_handler');
	
	elgg_unregister_plugin_hook_handler("route", "file", "file_tools_file_route_hook");
	elgg_register_plugin_hook_handler("route", "file", "theme_haarlem_intranet_file_route_handler");
	elgg_register_plugin_hook_handler("route", "file", "file_tools_file_route_hook");
	
	elgg_register_plugin_hook_handler("route", "groups", "theme_haarlem_intranet_groups_route_handler");

	elgg_register_plugin_hook_handler('route', 'pages', 'theme_haarlem_intranet_pages_route_handler');
	
	elgg_register_plugin_hook_handler("route", "livesearch", "theme_haarlem_intranet_livesearch_route_handler");
	
	elgg_register_plugin_hook_handler('config', 'htmlawed', 'theme_haarlem_intranet_htmlawed_config');
	
	elgg_register_plugin_hook_handler("register", "menu:page", "theme_haarlem_intranet_cleanup_menu");
	elgg_register_plugin_hook_handler('register', 'menu:longtext', 'theme_haarlem_intranet_cleanup_menu');
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'theme_haarlem_intranet_cleanup_menu');

	elgg_unregister_plugin_hook_handler("search_multisite", "search", "subsite_manager_search_multisite_search_hook");
	
	elgg_register_plugin_hook_handler('entity:icon:url', 'user', 'theme_haarlem_intranet_profile_icon', 2000); // high prio to overrule subsite_manager
	
	elgg_register_plugin_hook_handler("action", "logout", "theme_haarlem_intranet_logout_action_hook");
	
	// static widgets cache
	elgg_register_plugin_hook_handler('action', 'admin/site/flush_cache', 'theme_haarlem_intranet_static_widgets_flush_cache_hook');
	elgg_register_plugin_hook_handler('widget_settings', 'static_groups', 'theme_haarlem_intranet_static_widget_flush_cache_hook');
	elgg_register_event_handler('create', 'annotation', 'theme_haarlem_intranet_create_group_topic_post');
	elgg_register_event_handler('create', 'object', 'theme_haarlem_intranet_update_static');
	elgg_register_event_handler('update', 'object', 'theme_haarlem_intranet_update_static');
	elgg_register_event_handler('delete', 'object', 'theme_haarlem_intranet_update_static');
	
	elgg_register_plugin_hook_handler("access:default", "user", "theme_haarlem_intranet_access_default");
	
	// page handlers
	elgg_register_page_handler('profile', 'theme_haarlem_intranet_profile_page_handler');
	elgg_register_page_handler('dashboard', 'theme_haarlem_intranet_dashboard_page_handler');
	elgg_register_page_handler('haarlem_avatar', 'theme_haarlem_intranet_avatar_page_handler');
	
	elgg_register_plugin_hook_handler("route", "livesearch", "theme_haarlem_intranet_route_livesearch_handler");
	
	// quick nav
	elgg_register_ajax_view('theme_haarlem_intranet/forms/quick_nav');
	
	$js = elgg_get_simplecache_url('js', 'theme_haarlem_intranet/quick_nav');
	elgg_register_js('theme_haarlem_intranet_quick_nav', $js);
	
	elgg_register_widget_type('quick_nav', elgg_echo('theme_haarlem_intranet:quick_nav:widget:title'), elgg_echo('theme_haarlem_intranet:quick_nav:widget:description'), 'index', true);
	elgg_register_widget_type('pages', elgg_echo('pages'), elgg_echo('pages:widget:description'), 'all', true);
	
	elgg_register_action('theme_haarlem_intranet/quick_nav', dirname(__FILE__) . '/actions/quick_nav.php');
	elgg_register_action('theme_haarlem_intranet/admin/reset_mentions', dirname(__FILE__) . '/actions/admin/reset_mentions.php', 'admin');
	
	// izine
	elgg_register_widget_type('izine', elgg_echo('theme_haarlem_intranet:izine:widget:title'), elgg_echo('theme_haarlem_intranet:izine:widget:description'), 'index', true);
	elgg_register_widget_type('haarlem_news', elgg_echo('theme_haarlem_intranet:haarlem_news:widget:title'), elgg_echo('theme_haarlem_intranet:haarlem_news:widget:description'), 'index', true);
	elgg_register_widget_type('special_groups', elgg_echo('theme_haarlem_intranet:special_groups:widget:title'), elgg_echo('theme_haarlem_intranet:special_groups:widget:description'), 'index', true);
	
	// increase master icon sizes
	$icon_sizes = elgg_get_config('icon_sizes');
	$icon_sizes['master']['h'] = 1024;
	$icon_sizes['master']['w'] = 1024;
	elgg_set_config('icon_sizes', $icon_sizes);
	
	// don't allow main profile fields to be edited
	$current_url = current_page_url();
	$user = elgg_get_logged_in_user_entity();
	if (!theme_haarlem_is_extranet()) {
		if ((stristr($current_url, 'action/profile/edit') !== false) || (!empty($user) && (stristr($current_url, "profile/{$user->username}/edit") !== false))) {
			elgg_unregister_plugin_hook_handler('profile:fields', 'profile', 'subsite_manager_profile_fields_hook');
			elgg_unregister_plugin_hook_handler('categorized_profile_fields', 'profile_manager', 'subsite_manager_profile_manager_profile_hook');
		}
	}
	
	elgg_register_page_handler('search', 'theme_haarlem_intranet_search_page_handler');
	
	// restore tags search
	elgg_register_plugin_hook_handler('search_advanced_types', 'get_types', 'search_custom_types_tags_hook');
	elgg_register_plugin_hook_handler('search', 'tags', 'search_tags_hook');
	elgg_register_plugin_hook_handler('search_types', 'get_types', 'search_custom_types_tags_hook');
	
	elgg_register_extender_url_handler('annotation', 'group_topic_post', 'theme_haarlem_intranet_annotation_url_handler');
	
	// actions
	elgg_register_action('messages/send', dirname(__FILE__) . '/actions/messages/send.php');
	elgg_register_action('theme_haarlem_intranet/toggle_sidebar', dirname(__FILE__) . '/actions/toggle_sidebar.php');
	
	// overrule outgoing email
// 	register_notification_handler("email", "theme_haarlem_intranet_notification_handler");
// 	elgg_unregister_plugin_hook_handler("email", "system", "html_email_handler_email_hook");
// 	elgg_register_plugin_hook_handler("email", "system", "theme_haarlem_intranet_notification_handler");

	elgg_register_plugin_hook_handler("setting", "plugin", "theme_haarlem_intranet_invalidate_cache");
	
	// delayed group leave
	elgg_register_plugin_hook_handler('leave:group_membership', 'site', 'theme_haarlem_intranet_prevent_group_leave');
	elgg_register_plugin_hook_handler('cron', 'daily', 'theme_haarlem_intranet_delayed_group_leave');
	elgg_register_event_handler('create', 'member_of_site', 'theme_haarlem_intranet_cleanup_delayed_group_leave');
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

function theme_haarlem_intranet_notification_handler() {
	return true;
}

function theme_haarlem_intranet_annotation_url_handler($annotation) {
	if (empty($annotation)) {
		return;
	}
	
	$entity_guid = $annotation->entity_guid;
	$entity = get_entity($entity_guid);

	if ($entity) {
		return $entity->getURL();
	}
}

/**
 * Handles search advanced pages
 *
 * @param array $page page segments
 *
 * @return boolean
 */
function theme_haarlem_intranet_search_page_handler($page){
	// if there is no q set, we're being called from a legacy installation
	// it expects a search by tags.
	// actually it doesn't, but maybe it should.
	// maintain backward compatibility
	if (!get_input('q', get_input('tag', NULL)) && isset($page[0])) {
		set_input('q', $page[0]);
		//set_input('search_type', 'tags');
	}

	// as there is no tags search any more, replace it with ALL search
// 	if (get_input("search_type") == "tags") {
// 		set_input("search_type", "all");
// 	}

	$base_dir = elgg_get_plugins_path() . 'theme_haarlem_intranet/pages/search';

	include_once("$base_dir/index.php");
	return true;
}

function theme_haarlem_intranet_invalidate_cache($hook, $type, $return, $params){
	if(isset($params["plugin"]) && ($params["plugin"]->getID() == "theme_haarlem_intranet")){
		elgg_invalidate_simplecache();
	}
}

/**
 * Take over the livesearch pagehandler in case of group search
 *
 * @param string $hook         'route'
 * @param string $type         'livessearch'
 * @param array  $return_value the current params for the pagehandler
 * @param null   $params       null
 *
 * @return bool|void
 */
function theme_haarlem_intranet_route_livesearch_handler($hook, $type, $return_value, $params) {
	
	// only return results to logged in users.
	if (!$user = elgg_get_logged_in_user_entity()) {
		exit;
	}
	
	if (!$q = get_input("term", get_input("q"))) {
		exit;
	}
	
	$input_name = get_input("name", "groups");
	
	$q = sanitise_string($q);
	
	// replace mysql vars with escaped strings
	$q = str_replace(array("_", "%"), array("\_", "\%"), $q);
	
	$match_on = get_input("match_on", "all");
	
	if (!is_array($match_on)) {
		$match_on = array($match_on);
	}
	
	// only take over groups search
	if (count($match_on) > 1 || !in_array("groups", $match_on)) {
		return $return_value;
	}
	
	if (get_input("match_owner", false)) {
		$owner_guid = $user->getGUID();
	} else {
		$owner_guid = ELGG_ENTITIES_ANY_VALUE;
	}
	
	$limit = sanitise_int(get_input("limit", 10));
	
	// grab a list of entities and send them in json.
	$results = array();
	
	$options = array(
		"type" => "group",
		"limit" => $limit,
		"owner_guid" => $owner_guid,
		"joins" => array("JOIN " . elgg_get_config("dbprefix") . "groups_entity ge ON e.guid = ge.guid"),
		"wheres" => array("(ge.name LIKE '%" . $q . "%' OR ge.description LIKE '%" . $q . "%')")
	);
	
	$entities = elgg_get_entities($options);
	if (!empty($entities)) {
		foreach ($entities as $entity) {
			$output = elgg_view_list_item($entity, array(
				"use_hover" => false,
				"class" => "elgg-autocomplete-item",
				"full_view" => false,
			));
			
			$icon = elgg_view_entity_icon($entity, "tiny", array(
				"use_hover" => false,
			));
			
			$result = array(
				"type" => "group",
				"name" => $entity->name,
				"desc" => $entity->description,
				"guid" => $entity->getGUID(),
				"label" => $output,
				"value" => $entity->getGUID(),
				"icon" => $icon,
				"url" => $entity->getURL(),
				"html" => elgg_view("input/grouppicker/item", array(
					"entity" => $entity,
					"input_name" => $input_name,
				)),
			);
			
			$results[$entity->name . rand(1, 100)] = $result;
		}
	}
	
	ksort($results);
	header("Content-Type: application/json");
	echo json_encode(array_values($results));
	exit;
}
