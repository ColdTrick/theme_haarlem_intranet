<?php

$plugin = elgg_extract('entity', $vars);


$is_extranet = '<div>';
$is_extranet .= '<label>' . elgg_echo('theme_haarlem_intranet:settings:is_extranet') . '</label>';
$is_extranet .= elgg_view('input/dropdown', array(
	'name' => 'params[is_extranet]',
	'options_values' => array(
		'no' => elgg_echo('option:no'),
		'yes' => elgg_echo('option:yes'),
	),
	'value' => $plugin->is_extranet,
	'class' => 'mls',
));
$is_extranet .= '</div>';

echo $is_extranet;

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
