<?php

$message = elgg_extract('message', $vars);
if (empty($message)) {
	return;
}

if (!elgg_is_active_plugin('mentions')) {
	return;
}

$message = mentions_rewrite(null, null, $message, []);

$vars['message'] = $message;
