<?php
/**
 * Mobile users need to be forwarded to /dashboard after login
 */

if (!elgg_is_logged_in()) {
	return;
}

if (isset($_SESSION['theme_haarlem_mobile_forward'])) {
	// already forwarded once
	return;
}

// don't check again this session
$_SESSION['theme_haarlem_mobile_forward'] = true;

if (elgg_in_context('dashboard')) {
	// already on dashboard
	return;
}

// check if mobile user
$mobile = new Mobile_Detect();
if (!$mobile->isMobile()) {
	// not a mobile user
	return;
}

forward('dashboard');
