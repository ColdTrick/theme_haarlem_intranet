<?php

$widget = elgg_extract('entity', $vars);

echo '<div>';
echo elgg_echo('theme_haarlem_intranet:izine:widget:group');
echo elgg_view('input/autocomplete', array(
	'name' => 'params[group_guid]',
	'value' => $widget->group_guid,
	'match_on' => array('groups')
));
echo '</div>';

$num_display = (int) $widget->num_display;
if ($num_display < 1) {
	$num_display = 5;
}

echo '<div>';
echo elgg_echo('widget:numbertodisplay');
echo elgg_view('input/dropdown', array(
	'name' => 'params[num_display]',
	'value' => $num_display,
	'options' => range(1, 10)
));
echo '</div>';