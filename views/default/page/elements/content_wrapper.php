<?php

$content = elgg_extract('content', $vars);
unset($vars['content']);

$owner = elgg_get_page_owner_entity();
$content_header = '';

if ($owner instanceof ElggGroup) {
	if (theme_haarlem_intranet_get_group_type($owner) === 'kennisbank') {
		$content_class = ' theme-intranet-kennisbank';
		$content_header = elgg_view('page/elements/content_header/kennisbank', $vars);
	} else {
		$content_class = ' theme-intranet-groep';
		if (theme_haarlem_intranet_is_afdelings_group($owner)) {
			$content_class = ' theme-intranet-afdeling';
		}
		$content_header = elgg_view('page/elements/content_header/group', $vars);
	}
} elseif (elgg_in_context('dashboard')) {
	$content_class = ' theme-intranet-dashboard';
	$content_header = elgg_view('page/elements/content_header/dashboard', $vars);
} elseif (elgg_in_context('profile')) {
	$content_class = ' theme-intranet-dashboard';
	$content_header = elgg_view('page/elements/content_header/profile', $vars);
}

if ($content_header) {
	$content_header = '<div class="elgg-inner">' . $content_header . '</div>';
}

echo <<<___BODY
<div class="elgg-page-content-header{$content_class}">
	$content_header
</div>

<div class="elgg-page-body{$content_class}">
	<div class="elgg-inner">
		$content
	</div>
</div>
___BODY;
