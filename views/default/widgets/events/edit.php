<?php

	$widget = $vars["entity"];
	
	$num_display = (int) $widget->num_display;
	$type_to_show = $widget->type_to_show;
	
	// set default value
	if ($num_display < 1) {
		$num_display = 5;
	}
	
?>
<p>
<?php
	echo elgg_echo('event_manager:widgets:events:numbertodisplay').':';
	echo elgg_view('input/text', array('name' => 'params[num_display]', 'value' => $num_display));
?>
</p>
<p>
 <?php

if(in_array($widget->context, array('dashboard', 'profile')))
{
	echo elgg_echo('event_manager:widgets:events:showevents') . ': ';
	echo elgg_view('input/dropdown', array(	'name' => 'params[type_to_show]',
											'value' => $type_to_show,
											'options_values' => array(	'all' => elgg_echo('all'),
			 															'owning' => elgg_echo('event_manager:widgets:events:showevents:icreated'),
			 															'attending' => elgg_echo('event_manager:widgets:events:showevents:attendingto'))));
}
?>
</p>
<p>
<?php
	echo elgg_echo('theme_haarlem_intranet:widgets:events:tag') . ':';
	echo elgg_view('input/tags', array('name' => 'params[tag]', 'value' => $widget->tag));
?>
</p>
<p>
	<?php
	
	$list_type = $widget->list_type;
	if (!in_array($list_type, array('default', 'simple'))) {
		$list_type = 'default';
	}
	
	echo elgg_echo('theme_haarlem_intranet:widgets:events:list_type') . ': ';
	echo elgg_view('input/dropdown', array(
		'name' => 'params[list_type]',
		'value' => $list_type,
		'options_values' => array(
			'default' => elgg_echo('theme_haarlem_intranet:widgets:events:list_type:default'),
			'simple' => elgg_echo('theme_haarlem_intranet:widgets:events:list_type:simple'),
		)
	));
	
	?>
</p>