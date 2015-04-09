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
	$return_value[] = ElggMenuItem::factory(array(
		"name" => "dashboard",
		"text" => elgg_echo("mijn pagina"),
		"href" => "dashboard",
		"section" => "personal",
		"is_trusted" => true,
		"priority" => 100
	));
	
	
	return $return_value;
}