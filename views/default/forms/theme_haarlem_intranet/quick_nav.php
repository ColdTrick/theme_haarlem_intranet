<?php

$entity_guid = elgg_extract('entity_guid', $vars);
$values = elgg_extract('values', $vars);

if (!empty($values)) {
	foreach ($values as $nav) {
		echo '<div class="elgg-discover">';
		echo '<div class="float-alt elgg-discoverable">';
		echo elgg_view_icon('cursor-drag-arrow');
		echo '<br />';
		echo elgg_view_icon('delete');
		echo '</div>';
		echo elgg_view('input/fa_icon', array('name' => 'icons[]', 'value' => $nav['icon']));
		echo elgg_view('input/text', array(
			'name' => 'texts[]',
			'value' => $nav['text'],
			'placeholder' => elgg_echo('theme_haarlem_intranet:quick_nav:text')
		));
		echo '<br />';
		echo elgg_view('input/url', array(
			'name' => 'hrefs[]',
			'value' => $nav['href'],
			'placeholder' => elgg_echo('theme_haarlem_intranet:quick_nav:href')));
		echo '</div>';
	}
}

echo '<div class="theme-haarlem-intranet-quick-nav-template elgg-discover hidden">';
echo '<div class="float-alt elgg-discoverable">';
echo elgg_view_icon('cursor-drag-arrow');
echo '<br />';
echo elgg_view_icon('delete');
echo '</div>';
echo elgg_view('input/fa_icon', array('name' => 'icons[]'));
echo elgg_view('input/text', array('name' => 'texts[]', 'data-placeholder' => elgg_echo('theme_haarlem_intranet:quick_nav:text'), 'value' => elgg_echo('theme_haarlem_intranet:quick_nav:text')));
echo '<br />';
echo elgg_view('input/url', array('name' => 'hrefs[]', 'data-placeholder' => elgg_echo('theme_haarlem_intranet:quick_nav:href'), 'value' => elgg_echo('theme_haarlem_intranet:quick_nav:href')));
echo '</div>';

echo '<div>';
echo elgg_view('output/url', array(
	'text' => elgg_echo('theme_haarlem_intranet:quick_nav:add_link'),
	'href' => '#',
	'onclick' => 'return elgg.theme_haarlem_intranet.quick_nav_add();'
));
echo '</div>';

echo '<div class="elgg-foot">';
echo elgg_view('input/hidden', array('name' => 'entity_guid', 'value' => $entity_guid));
echo elgg_view('input/submit', array('value' => elgg_echo('save')));
echo '</div>';