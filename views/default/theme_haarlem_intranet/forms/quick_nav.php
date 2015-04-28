<?php

$entity_guid = (int) get_input('entity_guid');
if (empty($entity_guid)) {
	return;
}

$nav = theme_haarlem_intranet_get_quick_nav($entity_guid);

$form_vars = array();
$body_vars = array(
	'values' => $nav,
	'entity_guid' => $entity_guid
);

$form = elgg_view_form('theme_haarlem_intranet/quick_nav', $form_vars, $body_vars);

echo elgg_view_module('info', elgg_echo('theme_haarlem_intranet:quick_nav:title'), $form, array('class' => 'theme-haarlem-intranet-quick-nav-wrapper'));
?>
<script>
	$('.elgg-form-theme-haarlem-intranet-quick-nav > fieldset').sortable({
		items: '.elgg-discover',
		handle: '.elgg-icon-cursor-drag-arrow'
	});
</script>