<?php
/**
 * Elgg owner block
 * Displays page ownership information
 *
 * @package Elgg
 * @subpackage Core
 *
 */

elgg_push_context('owner_block');

// groups and other users get owner block
$owner = elgg_get_page_owner_entity();
if ($owner instanceof ElggGroup || $owner instanceof ElggUser) {
	$body = '';
	
	if ($owner instanceof ElggGroup) {
		$header = elgg_view('page/elements/owner_block/group_header', array('entity' => $owner));
	} elseif (!elgg_in_context('profile') && !elgg_in_context('dashboard')) {
		$header = elgg_view('page/elements/owner_block/user_header', array('entity' => $owner));
	} else {
		// user profile/dashboard page
		if ($owner->getGUID() == elgg_get_logged_in_user_guid()) {
			// own profile
			$body .= elgg_view('profile_manager/profile_completeness/content', array('entity' => $owner));
		} else {
			// other profile
			$menu = elgg_extract('menu', $vars);
			$actions = elgg_extract('action', $menu, array());
			if ($actions) {
				$body .= '<ul class="elgg-menu profile-action-menu">';
				foreach ($actions as $action) {
					$body .= '<li>' . $action->getContent(array('class' => 'elgg-button elgg-button-action')) . '</li>';
				}
				$body .= '</ul>';
			}
		}
	}
	
	if (group_gatekeeper(false)) {
		$owner_block_options = array(
			'entity' => $owner
		);
		if ($owner instanceof ElggGroup) {
			$owner_block_options['show_section_headers'] = true;
		}
		$body .= elgg_view_menu('owner_block', $owner_block_options);
	}
	
	$body .= elgg_view('page/elements/owner_block/extend', $vars);

	echo elgg_view('page/components/module', array(
		'header' => $header,
		'body' => $body,
		'class' => "elgg-owner-block elgg-owner-block-{$owner->getType()}",
	));
}

elgg_pop_context();