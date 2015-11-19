<?php

$text = elgg_view_icon('exchange');

if (theme_haarlem_intranet_sidebar_collapsed()) {
	$text .= elgg_echo('theme_haarlem_intranet:sidebar_toggle:toggle');
} else {
	$text .= elgg_echo('theme_haarlem_intranet:sidebar_toggle:collapse');
}

$link = elgg_view('output/url', array(
	'href' => '#',
	'text' => $text,
));
echo "<div class='theme-haarlem-intranet-sidebar-toggle'>{$link}</div>";
