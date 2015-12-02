<?php
$widget = $vars['entity'];

if (empty($widget)) {
	return;
}
?>
<script>
	$('#widget-edit-<?php echo $widget->getGUID();?> .elgg-input-longtext').each(function() {
		$(this).after('<div class="elgg-subtext"><?php echo elgg_echo('theme_haarlem_intranet:widgets:longtext_disclaimer'); ?></div>');
	});
</script>