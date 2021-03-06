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
		
		if (theme_haarlem_is_extranet()) {
			echo elgg_view('search/search_box', array(
				'class' => 'elgg-search-content-header',
				'placeholder' => elgg_echo('theme_haarlem_intranet:search:' . theme_haarlem_intranet_get_group_type($owner)),
				'container_entity' => $owner,
				'autocomplete' => false,
			));
		}
		
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
			$body .= '<ul class="elgg-menu profile-action-menu"><li>';
			$body .= elgg_view('output/url', array(
				'text' => elgg_echo('messages:sendmessage'),
				'href' => 'messages/compose?send_to=' . $owner->guid,
				'class' => 'elgg-button elgg-button-action'
			));
			$body .= '</li>';
			
			$actions = elgg_extract('action', elgg_extract('menu', $vars));
			if ($actions) {
				foreach ($actions as $action) {
					if (!in_array($action->getName(), array('add_friend', 'remove_friend', 'friend_request'))) {
						continue;
					}

					$action->setLinkClass('elgg-button elgg-button-action');
					
					$body .= elgg_view('navigation/menu/elements/item', array('item' => $action));
				}
			}
			
			$body .= '</ul>';
		}
	}
	
	if (group_gatekeeper(false)) {
		if ($owner instanceof ElggGroup) {
			$body .= elgg_view_menu('quick_nav', array(
				'entity' => $owner,
				'sort_by' => 'priority',
				'class' => 'elgg-menu-page'
			));
		}
		
		$body .= elgg_view_menu('owner_block', array(
			'entity' => $owner
		));
	}
	
	$body .= elgg_view('page/elements/owner_block/extend', $vars);

	echo elgg_view('page/components/module', array(
		'header' => $header,
		'body' => $body,
		'class' => "elgg-owner-block elgg-owner-block-{$owner->getType()}",
	));
}

elgg_pop_context();