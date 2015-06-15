<?php

$widget = elgg_extract('entity', $vars);
$owner = $widget->getOwnerEntity();


$tabs = array();
$content = '';
$first = true;

$river_options = array(
	'limit' => 5,
	'pagination' => false
);

// my group activity
$my_groups = $owner->getGroups('', false);
if (!empty($my_groups)) {
	$tabs[] = array(
		'text' => elgg_echo('theme_haarlem_intranet:river:widget:my_groups'),
		'href' => '#',
		'selected' => $first,
		'rel' => 'groups'
	);
	$first = false;
	
	$group_guids = array();
	foreach ($my_groups as $group) {
		$group_guids[] = $group->getGUID();
	}
	unset($my_groups);
	
	$dbprefix = elgg_get_config('dbprefix');
	
	$river_options['joins'] = array("INNER JOIN {$dbprefix}entities entities1 ON rv.object_guid = entities1.guid");
	$river_options['wheres'] = array(
		'(entities1.container_guid IN (' . implode(',', $group_guids) . ') OR rv.object_guid IN (' . implode(',', $group_guids) . '))',
		get_access_sql_suffix("entities1")
	);
	
	$content = '<div class="theme-haarlem-intranet-dashboard-river theme-haarlem-intranet-dashboard-river-groups">';
	$content .= elgg_list_river($river_options);
	$content .= '<div class="elgg-widget-more">';
	$content .= elgg_view('output/url', array(
		'text' => elgg_echo('river:all'),
		'href' => 'activity',
		'is_trusted' => true
	));
	$content .= '</div>';
	$content .= '</div>';
	
	unset($river_options['joins']);
	unset($river_options['wheres']);
}

// my activity
$tabs[] = array(
	'text' => elgg_echo('river:mine'),
	'href' => '#',
	'selected' => $first,
	'rel' => 'mine'
);

$river_options['subject_guid'] = $owner->getGUID();

$class = array(
	'theme-haarlem-intranet-dashboard-river',
	'theme-haarlem-intranet-dashboard-river-mine'
);
if (!$first) {
	$class[] = 'hidden';
}
$content .= '<div class="' . implode(' ', $class) . '">';
$content .= elgg_list_river($river_options);
$content .= '<div class="elgg-widget-more">';
$content .= elgg_view('output/url', array(
	'text' => elgg_echo('river:mine'),
	'href' => "activity/owner/{$owner->username}",
	'is_trusted' => true
));
$content .= '</div>';
$content .= '</div>';

unset($river_options['subject_guid']);
$first = false;

// all activity
$tabs[] = array(
	'text' => elgg_echo('river:all'),
	'href' => '#',
	'selected' => $first,
	'rel' => 'all'
);
$first = false;

$class = array(
	'theme-haarlem-intranet-dashboard-river',
	'theme-haarlem-intranet-dashboard-river-all'
);
if (!$first) {
	$class[] = 'hidden';
}

$content .= '<div class="' . implode(' ', $class) . '">';
$content .= elgg_list_river($river_options);
$content .= '<div class="elgg-widget-more">';
$content .= elgg_view('output/url', array(
	'text' => elgg_echo('river:all'),
	'href' => 'activity',
	'is_trusted' => true
));
$content .= '</div>';
$content .= '</div>';

// content
echo elgg_view('navigation/tabs', array('tabs' => $tabs, 'class' => 'theme-haarlem-intranet-dashboard-activity-tabs'));

echo $content;
?>
<script>
	$('#elgg-widget-<?php echo $widget->getGUID(); ?> .elgg-tabs a').live('click', function() {

		var $widget = $('#elgg-widget-<?php echo $widget->getGUID(); ?>');

		$widget.find('li.elgg-state-selected').removeClass('elgg-state-selected');
		$(this).parent('li').addClass('elgg-state-selected');

		$widget.find('.theme-haarlem-intranet-dashboard-river').hide();
		$widget.find('.theme-haarlem-intranet-dashboard-river-' + $(this).attr('rel')).show();
		
		return false;
	});
</script>
<?php
if (elgg_get_page_owner_guid() == elgg_get_logged_in_user_guid()) {
?>
<style type="text/css">
	.elgg-widget-instance-river_widget .elgg-head {
		display: none;
	}
</style>
<?php
}