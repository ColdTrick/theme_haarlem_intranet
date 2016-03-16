<?php

if (theme_haarlem_is_extranet()) {
	echo '<div class="theme-haarlem-intranet-extranet-logo">';
	echo elgg_view('output/img', array(
		'src' => elgg_get_site_url() . 'mod/theme_haarlem_intranet/graphics/logo_extranet.png',
		'alt' => 'extranet logo',
		'title' => elgg_get_site_entity()->name,
	));
	echo '</div>';
}
