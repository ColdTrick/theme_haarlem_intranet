<?php
/**
 * File renderer.
 *
 * @package ElggFile
 */

$full = elgg_extract('full_view', $vars, false);
$message = elgg_extract('entity', $vars, false);

if (!$message) {
	return true;
}

$recieved = false;

if ($message->toId == elgg_get_page_owner_guid()) {
	$recieved = true;
	
	// received
	$user = get_entity($message->fromId);
	if ($user) {
		$icon = elgg_view_entity_icon($user, 'tiny');
		$user_link = elgg_view('output/url', array(
			'href' => "messages/compose?send_to=$user->guid",
			'text' => $user->name,
			'is_trusted' => true,
		));
	} else {
		$icon = '';
		$user_link = elgg_echo('messages:deleted_sender');
	}

	if ($message->readYet) {
		$class = 'message read';
	} else {
		$class = 'message unread';
	}

} else {
	// sent
	$user = get_entity($message->toId);

	if ($user) {
		$icon = elgg_view_entity_icon($user, 'tiny');
		$user_link = elgg_view('output/url', array(
			'href' => "messages/compose?send_to=$user->guid",
			'text' => elgg_echo('messages:to_user', array($user->name)),
			'is_trusted' => true,
		));
	} else {
		$icon = '';
		$user_link = elgg_echo('messages:deleted_sender');
	}

	$class = 'message read';
}

$timestamp = elgg_view_friendly_time($message->time_created);

$subject_info = '';
if (!$full) {
	$subject_info .= "<input type='checkbox' name=\"message_id[]\" value=\"{$message->guid}\" />";
}
$subject_info .= elgg_view('output/url', array(
	'href' => $message->getURL(),
	'text' => $message->title,
	'is_trusted' => true,
));
// check for reply
if ($recieved) {
	$replies = $message->getEntitiesFromRelationship('reply', true, 1);
	if (!empty($replies)) {
		
		$reply_time = elgg_view_friendly_time($replies[0]->time_created);
		
		$subject_info .= '<div>' . elgg_echo('theme_haarlem_intranet:messages:reply:timestamp', array($reply_time)) . '</div>';
	}
}


$delete_link = elgg_view("output/confirmlink", array(
	'href' => "action/messages/delete?guid=" . $message->getGUID(),
	'text' => elgg_view_icon('delete', 'float-alt'),
	'confirm' => elgg_echo('deleteconfirm'),
	'encode_text' => false,
));

$body = <<<HTML
<div class="messages-owner">$user_link</div>
<div class="messages-subject">$subject_info</div>
<div class="messages-timestamp">$timestamp</div>
<div class="messages-delete">$delete_link</div>
HTML;

if ($full) {
	echo elgg_view_image_block($icon, $body, array('class' => $class));
	echo elgg_view('output/longtext', array('value' => $message->description));
} else {
	$body .= elgg_view("output/longtext", array(
		"value" => elgg_get_excerpt($message->description),
		"class" => "elgg-subtext clearfloat"
	));
	echo elgg_view_image_block($icon, $body, array('class' => $class));
}