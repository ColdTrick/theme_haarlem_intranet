<?php
/**
 * Elgg footer
 * The standard HTML footer that displays across the site
 *
 * @package Elgg
 * @subpackage Core
 *
 */

echo elgg_view_menu('footer', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));

echo '<div class="float-alt">';
echo elgg_view('output/img', array(
	'src' => elgg_get_site_url() . 'mod/theme_haarlem_intranet/graphics/logo_footer.png',
	'alt' => 'footer logo'
));
echo '</div>';
