<?php
/**
 * Display message about closed membership
 *
 * @package ElggGroups
 */

$group = elgg_get_page_owner_entity();

$content = '';
if (elgg_is_logged_in()) {
	$content = elgg_echo("groups:closedgroup:request");
}

if($group->description) {
	$content .= elgg_view('output/longtext', array('value' => $group->description));
}

echo elgg_view_module('info', elgg_echo("groups:closedgroup"), $content, array('class' => 'theme-haarlem-intranet-owner-block-section'));
