<?php

$content = elgg_extract('content', $vars);
unset($vars['content']);

$owner = elgg_get_page_owner_entity();

if ($owner instanceof ElggGroup) {
	$content_class = ' theme-intranet-groep';
	$group_type = strtolower($owner->group_type);
	if ($group_type === 'afdeling') {
		$content_class = ' theme-intranet-afdeling';
	}
	$content_header = elgg_view('page/elements/content_header/group', $vars);
} elseif (elgg_in_context('static')) {
	$content_class = ' theme-intranet-kennisbank';
	$content_header = elgg_view('page/elements/content_header/kennisbank', $vars);
} elseif (elgg_in_context('dashboard')) {
	$content_class = ' theme-intranet-dashboard';
	$content_header = elgg_view('page/elements/content_header/dashboard', $vars);
} elseif (elgg_in_context('profile')) {
	$content_class = ' theme-intranet-dashboard';
	$content_header = elgg_view('page/elements/content_header/profile', $vars);
}

echo '<div class="elgg-page-content-header' . $content_class . '">';
if ($content_header) {	
	echo '<div class="elgg-inner">' . $content_header . '</div>';
}
echo '</div>';

echo <<<___BODY
<div class="elgg-page-body{$content_class}">
	<div class="elgg-inner">
		$content
	</div>
</div>
___BODY;
