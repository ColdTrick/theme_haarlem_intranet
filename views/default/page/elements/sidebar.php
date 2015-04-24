<?php
/**
 * Elgg sidebar contents
 *
 * @uses $vars['sidebar'] Optional content that is displayed at the bottom of sidebar
 */
$owner = elgg_get_page_owner_entity();
if ($owner instanceof ElggGroup && theme_haarlem_intranet_get_group_type($owner) === 'kennisbank') {
	return true;
}

echo elgg_view('page/elements/owner_block', $vars);

echo elgg_view_menu('page', array('sort_by' => 'name'));

// optional 'sidebar' parameter
if (isset($vars['sidebar'])) {
	echo $vars['sidebar'];
}
