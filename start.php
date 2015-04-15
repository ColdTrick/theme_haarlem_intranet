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

function theme_haarlem_intranet_init() {

	// theme specific CSS
	
	elgg_register_css("sourcesanspro", "//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700");
	elgg_load_css("sourcesanspro");
	
	elgg_extend_view('css/elgg', 'css/theme_haarlem_intranet/site');
	elgg_extend_view('css/elgg', 'css/theme_haarlem_intranet/responsive');
	
	elgg_register_plugin_hook_handler("register", "menu:site", "theme_haarlem_intranet_site_menu");
	
	elgg_unregister_plugin_hook_handler('prepare', 'menu:site', 'elgg_site_menu_setup');
	

	elgg_register_page_handler('profile', 'theme_haarlem_intranet_profile_page_handler');
}
