<?php
/**
 * Layout of the groups profile page
 *
 * @uses $vars['entity']
 */

if (group_gatekeeper(false)) {
	echo elgg_view('groups/profile/widgets', $vars);
} else {
	echo elgg_view('theme_haarlem_intranet/widgets_fix');
	echo elgg_view('groups/profile/closed_membership');
}
