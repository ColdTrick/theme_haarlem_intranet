<?php

$content = elgg_extract('content', $vars);

$owner = elgg_get_page_owner_entity();

if ($owner instanceof ElggGroup) {
	$content_class = ' theme-intranet-groep';
	$content_header = 'groep';
} elseif (elgg_in_context('static')) {
	$content_class = ' theme-intranet-kennisbank';
	$content_header = 'kennisbank';
} elseif (elgg_in_context('dashboard')) {
	$content_class = ' theme-intranet-dashboard';
	$content_header = 'dashboard';	
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
