<?php
/**
 * Wrapped for a select input with predefined colors
 *
 * @see input/dropdown
 */

$options_values = array(
	'' => elgg_echo('promo_widget:background:select'),
	'promo-widget-green' => elgg_echo('theme_haarlem_intranet:color:green'),
	'promo-widget-teal' => elgg_echo('theme_haarlem_intranet:color:teal'),
	'promo-widget-blue' => elgg_echo('theme_haarlem_intranet:color:blue'),
	'promo-widget-darkblue' => elgg_echo('theme_haarlem_intranet:color:darkblue'),
	'promo-widget-purple' => elgg_echo('theme_haarlem_intranet:color:purple'),
	'promo-widget-red' => elgg_echo('theme_haarlem_intranet:color:red'),
	'promo-widget-darkred' => elgg_echo('theme_haarlem_intranet:color:darkred'),
	'promo-widget-orange' => elgg_echo('theme_haarlem_intranet:color:orange'),
);

$vars['options_values'] = $options_values;

echo elgg_view('input/dropdown', $vars);
