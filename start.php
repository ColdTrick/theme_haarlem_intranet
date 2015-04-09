<?php
/**
 * Haarlem theme plugin
 */

require_once(dirname(__FILE__) . "/lib/hooks.php");
require_once(dirname(__FILE__) . "/lib/page_handlers.php");

define('THEME_GREEN', 'ACC441');
define('THEME_TEAL', '32998E');
define('THEME_BLUE', '00AEEF');
define('THEME_PURPLE', '6C447E');

elgg_register_event_handler('init','system','theme_haarlem_intranet_init');

function theme_haarlem_intranet_init() {

	// theme specific CSS
	elgg_extend_view('css/elgg', 'theme_haarlem_intranet/css');
	
	elgg_register_plugin_hook_handler("register", "menu:site", "theme_haarlem_intranet_site_menu");
	
	elgg_unregister_plugin_hook_handler('prepare', 'menu:site', 'elgg_site_menu_setup');
	

	elgg_register_page_handler('profile', 'theme_haarlem_intranet_profile_page_handler');
}
