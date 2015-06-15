<?php
/**
 * Activity widget content view
 */

// over rule dashboard view
if (elgg_in_context('dashboard')) {
	echo elgg_view('widgets/river_widget/dashboard', $vars);
	return;
}

$num = (int) $vars['entity']->num_display;

$options = array(
	'limit' => $num,
	'pagination' => false,
);

if (elgg_in_context('dashboard')) {
	if ($vars['entity']->content_type == 'friends') {
		$options['relationship_guid'] = elgg_get_page_owner_guid();
		$options['relationship'] = 'friend';
	}
} else {
	$options['subject_guid'] = elgg_get_page_owner_guid();
}

$content = elgg_list_river($options);
if (!$content) {
	$content = elgg_echo('river:none');
}

echo $content;
