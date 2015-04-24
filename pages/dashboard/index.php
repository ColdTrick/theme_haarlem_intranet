<?php

// Ensure that only logged-in users can see this page
gatekeeper();

// Set context and title
elgg_set_context('dashboard');
elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
$title = elgg_echo('dashboard');

// wrap intro message in a div
$intro_message = elgg_view('dashboard/blurb');

$params = array(
	'title' => ' ',
	'content' => $intro_message,
	'num_columns' => 2,
	'show_access' => false,
);
$widgets = elgg_view_layout('widgets', $params);

$body = elgg_view_layout('one_sidebar', array(
	'title' => ' ',
	'content' => $widgets,
	'layout' => 'content'
));

echo elgg_view_page($title, $body);