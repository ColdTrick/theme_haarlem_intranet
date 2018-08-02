<?php
	$event = $vars["entity"];
	if (!$vars["full_view"]) {
		return;
	}

	if ($event->getRelationshipByUser()) {
		echo elgg_view('output/url', [
			'text' => elgg_echo('theme_haarlem_intranet:event_unsubscribe'),
			'class' => 'elgg-button elgg-button-cancel float-alt',
			'href' => 'action/event_manager/event/rsvp?guid=' . $event->guid . '&type=' . EVENT_MANAGER_RELATION_UNDO,
			'is_action' => true,
		]);
	}
