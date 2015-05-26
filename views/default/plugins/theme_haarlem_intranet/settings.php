<?php

$plugin = elgg_extract('entity', $vars);

// reset mentions notifications
$content = '<div>';
$content .= elgg_view('output/longtext', array('value' => elgg_echo('theme_haarlem_intranet:settings:mentions:reset')));
$content .= elgg_view('output/confirmlink', array(
	'text' => elgg_echo('reset'),
	'href' => 'action/theme_haarlem_intranet/admin/reset_mentions',
	'is_trusted' => true
));
$content .= '</div>';

echo elgg_view_module('inline', elgg_echo('theme_haarlem_intranet:settings:mentions'), $content);
