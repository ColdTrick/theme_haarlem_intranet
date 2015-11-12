<?php
/**
 * Elgg pages widget edit
 *
 * @package ElggPages
 */
$page_owner = elgg_get_page_owner_entity();

if (!($page_owner instanceof ElggGroup)) {
	// set default value
	if (!isset($vars['entity']->pages_num)) {
		$vars['entity']->pages_num = 4;
	}
	
	$params = array(
		'name' => 'params[pages_num]',
		'value' => $vars['entity']->pages_num,
		'options' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10),
	);
	$dropdown = elgg_view('input/dropdown', $params);
	
	echo '<div>';
	echo elgg_echo('pages:num') . ':';
	echo $dropdown;
	echo '</div>';
} else {
	$widget = elgg_extract('entity', $vars);
	
	$page_selector = theme_haarlem_pages_get_widget_selector($widget->getOwnerEntity());
	$page_selector = array_reverse($page_selector, true);
	$page_selector[''] = elgg_echo('theme_haarlem_intranet:widgets:pages:edit:main_page:select');
	$page_selector = array_reverse($page_selector, true);
	
	echo '<div>';
	echo elgg_echo('theme_haarlem_intranet:widgets:pages:edit:main_page');
	echo elgg_view('input/dropdown', array(
		'name' => 'params[main_page]',
		'options_values' => $page_selector,
		'value' => $widget->main_page,
		'class' => 'mls'
	));
	echo '</div>';
}