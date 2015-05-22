<?php
/**
 * Default menu
 *
 * @uses $vars['name']                 Name of the menu
 * @uses $vars['menu']                 Array of menu items
 * @uses $vars['class']                Additional CSS class for the menu
 * @uses $vars['item_class']           Additional CSS class for each menu item
 * @uses $vars['show_section_headers'] Do we show headers for each section?
 */

if (empty($vars['menu'])) {
	return;
}

// we want css classes to use dashes
$vars['name'] = preg_replace('/[^a-z0-9\-]/i', '-', $vars['name']);
$headers = elgg_extract('show_section_headers', $vars, false);
$item_class = elgg_extract('item_class', $vars, '');

$class = "elgg-menu elgg-menu-{$vars['name']}";
if (isset($vars['class'])) {
	$class .= " {$vars['class']}";
}

$header_class = 'elgg-state-opened';
$entity = elgg_extract('entity', $vars);
if ($entity instanceof ElggGroup) {
	$header_class = 'elgg-state-closed';
	$class .= ' hidden';
}

echo "<h2 class='{$header_class}'>";
echo elgg_echo('theme_haarlem_intranet:owner_block:content');
echo elgg_view_icon('chevron-circle-right');
echo elgg_view_icon('chevron-circle-down');
echo '</h2>';

foreach ($vars['menu'] as $section => $menu_items) {
	echo elgg_view('navigation/menu/elements/section', array(
		'items' => $menu_items,
		'class' => "$class elgg-menu-{$vars['name']}-$section",
		'section' => $section,
		'name' => $vars['name'],
		'show_section_headers' => $headers,
		'item_class' => $item_class,
	));
}
