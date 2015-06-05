<?php

if (!elgg_is_logged_in()) {
	header('HTTP/1.0 403 Forbidden');
	exit();
}

$user_guid = (int) elgg_extract('0', $page);
$size = strtolower(elgg_extract('1', $page, 'medium'));
$icon_time = elgg_extract('2', $page);

$icon_sizes = elgg_get_config('icon_sizes');
if (empty($user_guid) || !isset($icon_sizes[$size])) {
	header('HTTP/1.0 400 Bad Request');
	exit();
}

// If is the same ETag, content didn't changed.
$etag = md5($user_guid . $size . $icon_time);
$request_etag = trim(elgg_extract('HTTP_IF_NONE_MATCH', $_SERVER));
if (!empty($request_etag) && strpos($request_etag, "\"{$etag}\"") === 0) {
	header("HTTP/1.1 304 Not Modified");
	exit();
}

$fh = new ElggFile();
$fh->owner_guid = $user_guid;

$fh->setFilename("haarlem_icon/{$size}.jpg");
if (!$fh->exists()) {
	header('HTTP/1.0 404 Not Found');
	exit();
}

$contents = $fh->grabFile();
$filesize = strlen($contents);

header("Content-type: image/jpeg");
header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', strtotime("+6 months")), true);
header("Pragma: public");
header("Cache-Control: public");
header("Content-Length: {$filesize}");
header("ETag: \"{$etag}\"");

echo $contents;
exit();