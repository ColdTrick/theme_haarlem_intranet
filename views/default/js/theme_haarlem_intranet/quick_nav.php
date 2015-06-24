<?php

?>
//<script>
elgg.provide('elgg.theme_haarlem_intranet');

elgg.theme_haarlem_intranet.quick_nav_remove = function(event) {
	$(this).parent('div').parent('div').remove();
};

elgg.theme_haarlem_intranet.quick_nav_add = function() {
	var $template = $('.elgg-form-theme-haarlem-intranet-quick-nav .theme-haarlem-intranet-quick-nav-template');
	var $clone = $template.clone();
	$clone.removeClass('theme-haarlem-intranet-quick-nav-template');
	$clone.removeClass('hidden');
	$template.before($clone);

	return false;
};

elgg.theme_haarlem_intranet.check_placeholder = function() {
	var placeholder_text = $(this).data('placeholder');
	
	if (placeholder_text) {
		var current_value = $(this).val();
		if (current_value === placeholder_text) {
			$(this).val("");
		}
	}
};

elgg.theme_haarlem_intranet.quick_nav_init = function() {
	$('.elgg-form-theme-haarlem-intranet-quick-nav .elgg-icon-delete').live('click', elgg.theme_haarlem_intranet.quick_nav_remove);
	$('.elgg-form-theme-haarlem-intranet-quick-nav input[type="text"]').live('focus', elgg.theme_haarlem_intranet.check_placeholder);
};

elgg.register_hook_handler('init', 'system', elgg.theme_haarlem_intranet.quick_nav_init);