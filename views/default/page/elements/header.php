<?php
/**
 * Elgg page header
 * In the default theme, the header lives between the topbar and main content area.
 */

// link back to main site.
// echo elgg_view('page/elements/header_logo', $vars);

// drop-down login
//echo elgg_view('core/account/login_dropdown');

// insert site-wide navigation
//echo elgg_view_menu('site');

$site_name = elgg_get_site_entity()->name;
$site_url = elgg_get_site_url();

echo elgg_view('output/url', array(
	'text' => elgg_view('output/img', array(
		'src' => $site_url . 'mod/theme_haarlem_intranet/graphics/logo.png', 
		'alt' => 'logo'
	)),
	'href' => $site_url,
	'title' => $site_name
));

echo elgg_view('output/url', array(
	'class' => 'elgg-button elgg-button-action',
	'id' => 'theme-haarlem-intranet-header-help',
	
	'href' => 'help',
	'text' => elgg_echo('theme_haarlem_intranet:header:help')
));